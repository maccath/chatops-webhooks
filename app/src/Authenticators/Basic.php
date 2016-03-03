<?php

namespace App\Authenticators;

use Slim\Http\Request;

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
     * @param array $settings
     */
    public function applySettings(array $settings)
    {
        if (isset($settings['token'])) {
            $this->token = $settings['token'];
        }
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
            throw new \Exception("Authentication failed; tokens do not match.");
        }
    }
}