<?php

namespace App\Authenticators;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Basic
 *
 * Basic token-based authentication.
 *
 * @package App
 */
class Basic implements AuthenticatorInterface
{
    /**
     * @var mixed the required auth token
     */
    private $token = false;

    /**
     * Apply authentication settings
     *
     * @param array $settings the authenticator settings
     */
    public function __construct(array $settings)
    {
        $this->token = isset($settings['token']) ? $settings['token'] : false;
    }

    /**
     * Given a request, check authentication
     *
     * @param Request $request the application request
     * @param Response $response the application response
     * @param callable $next the next action
     * @throws \Exception if request can't be authenticated
     * @return void
     */
    public function __invoke($request, $response, $next)
    {
        if ($this->token && $request->getParam('token') != $this->token) {
            throw new \Exception('Authentication failed; tokens do not match.');
        }

        return $response = $next($request, $response);
    }
}