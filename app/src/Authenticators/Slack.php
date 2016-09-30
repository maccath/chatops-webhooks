<?php

namespace App\Authenticators;

use Slim\Http\Request;

/**
 * Class Slack
 *
 * @package App
 */
class Slack implements AuthenticatorInterface
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
     * @throws \Exception if request can't be authenticated
     * @return void
     */
    public function check(Request $request)
    {
        if ($this->token && $request->getParam('token') != $this->token) {
            throw new \Exception('Authentication failed; tokens do not matchsssss.');
        }
    }

    /**
     * Authenticate
     *
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($request, $response, $next)
    {
        $this->check($request);

        return $response = $next($request, $response);
    }
}