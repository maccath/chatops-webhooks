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
     * @var ActionInterface action the action to be executed
     */
    private $action;

    /**
     * @var AuthenticatorInterface authenticator the authentication to be performed
     */
    private $authenticator;

    /**
     * @var ResponseInterface response the response to be given
     */
    private $response;

    /**
     * @var array settings the action settings
     */
    private $settings;

    /**
     * Constructs the action, response and auth objects with given settings
     *
     * @param ActionInterface $action the action to be executed
     * @param ResponseInterface $response the response to be given
     * @param array $settings the action settings
     */
    public function __construct(
        ActionInterface $action,
        ResponseInterface $response,
        $settings
    ) {
        $this->action = $action;
        $this->response = $response;
        $this->settings = $settings;

        $this->response->applySettings($this->settings);
    }

    /**
     * Invoke the action - check auth, execute the action, then render the response
     *
     * @param Request $request the application request
     * @param Response $response the application response
     * @param array $args route arguments
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        $next($request, $response);

        $this->executeAction($request, $response, []);
        $this->render($response);
    }

    /**
     * Execute the actual action logic
     *
     * @param Request $request the application request
     * @param Response $response the application response
     * @param array $args route arguments
     */
    private function executeAction(Request $request, Response $response, array $args)
    {
        $this->action->execute($request, $response, $args);
    }

    /**
     * Render the appropriate response
     *
     * @param $response Response the application response
     */
    private function render(Response $response)
    {
        $this->response->setData($this->action->getData());
        $this->response->getFormattedResponse($response);
    }
}