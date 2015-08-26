<?php

namespace App\Actions;

use App\AuthenticatorInterface;
use App\Formatters\FormatterInterface;
use Psr\Http\Message\ResponseInterface;

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
     * @var FormatterInterface formatter class
     */
    protected $formatter;

    /**
     * @var array action settings
     */
    protected $settings;

    /**
     * @var AuthenticatorInterface authentication class
     */
    protected $authenticator;

    /**
     * Constructs the action object, setting formatter and settings and creating an authenticator
     *
     * @param FormatterInterface $formatter
     * @param AuthenticatorInterface $authenticator
     * @param $settings
     */
    public function __construct(FormatterInterface $formatter, AuthenticatorInterface $authenticator, $settings)
    {
        $this->formatter = $formatter;
        $this->settings = $settings;
        $this->authenticator = $authenticator;

        $this->authenticator->applySettings($this->settings['authentication']);
    }

    /**
     * The invoked method
     *
     * @param $request
     * @param $response
     * @param $args
     */
    public function __invoke($request, $response, $args)
    {
        if ($this->authenticator->check($request)) {
            $this->execute($request, $response, $args);
        } else {
            $response->write('Authentication failed');
        }
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
     * Set up response data
     *
     * @return stdClass
     */
    protected function setupData()
    {
        $data = new \stdClass();

        return $data;
    }
}