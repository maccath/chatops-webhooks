<?php

namespace App\Actions;

use App\Authenticators\AuthenticatorInterface;
use App\Responses\ResponseInterface;

/**
 * Class Action
 *
 * Abstract class with basic action implementation
 *
 * @package App\Actions
 */
abstract class Action implements ActionInterface
{
    /**
     * @var ResponseInterface response class
     */
    protected $response;

    /**
     * @var array action settings
     */
    protected $settings;

    /**
     * @var AuthenticatorInterface authentication class
     */
    protected $authenticator;

    /**
     * @var \stdClass the action data
     */
    public $data;

    /**
     * Constructs the action object, setting formatter and settings and creating an authenticator
     *
     * @param ResponseInterface $response
     * @param AuthenticatorInterface $authenticator
     * @param $settings
     * @internal param FormatterInterface $formatter
     */
    public function __construct(ResponseInterface $response, AuthenticatorInterface $authenticator, $settings)
    {
        $this->response = $response;
        $this->settings = $settings;
        $this->authenticator = $authenticator;
        $this->data = new \stdClass();

        $this->authenticator->applySettings($this->settings['authentication']);
    }

    /**
     * Invoke the action
     *
     * @param $request
     * @param $response
     * @param $args
     * @throws \Exception
     */
    public function __invoke($request, $response, $args)
    {
        $this->authenticator->check($request);
        $this->execute($request, $response, $args);
        $this->render($response);
    }

    /**
     * Execute the actual action logic
     *
     * @param $request
     * @param $response
     * @param $args
     */
    protected function execute($request, $response, $args)
    {
        // Do stuff
    }

    /**
     * Render the appropriate response
     *
     * @param $response
     */
    protected function render($response)
    {
        $this->response->hydrate($this->data, $this->settings);
        $this->response->getFormattedResponse($response);
    }
}