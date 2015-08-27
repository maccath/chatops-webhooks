<?php

namespace App\Actions;

use App\Authenticators\AuthenticatorInterface;
use App\Responses\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ActionExecutor
 *
 * @package App\Actions
 */
class ActionExecutor
{
    /**
     * @var ActionInterface action
     */
    private $action;

    /**
     * @var ResponseInterface response
     */
    private $response;

    /**
     * @var array settings
     */
    private $settings;

    /**
     * @var AuthenticatorInterface authenticator
     */
    private $authenticator;

    /**
     * Constructs the action, response and auth objects with given settings
     *
     * @param ActionInterface $action
     * @param ResponseInterface $response
     * @param AuthenticatorInterface $authenticator
     * @param $settings
     */
    public function __construct(ActionInterface $action, ResponseInterface $response, AuthenticatorInterface $authenticator, $settings)
    {
        $this->action = $action;
        $this->response = $response;
        $this->authenticator = $authenticator;
        $this->settings = $settings;

        $this->authenticator->applySettings($this->settings['authentication']);
        $this->response->applySettings($this->settings);
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
        $this->checkAuthentication($request);
        $this->executeAction($request, $response, $args);
        $this->render($response);
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    private function checkAuthentication(Request $request)
    {
        $this->authenticator->check($request);
    }

    /**
     * Execute the actual action logic
     *
     * @param $request
     * @param $response
     * @param $args
     */
    private function executeAction(Request $request, Response $response, array $args)
    {
        $this->action->execute($request, $response, $args);
    }

    /**
     * Render the appropriate response
     *
     * @param $response
     */
    private function render($response)
    {
        $this->response->setData($this->action->getData());
        $this->response->getFormattedResponse($response);
    }
}