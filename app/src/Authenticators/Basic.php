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
     * @var mixed the stored auth token
     */
    protected $token = false;

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Apply authentication settings
     *
     * @param array $settings
     */
    public function applySettings(array $settings)
    {
        if (isset($settings['token'])) {
            $this->setToken($settings['token']);
        }
    }

    /**
     * Checks authentication
     *
     * @param Request $request
     * @throws \Exception
     * @return void;
     */
    public function check(Request $request)
    {
        if (!($request->getParam('token') == $this->getToken() || !$this->getToken()))
        {
            throw new \Exception("Authentication failed; tokens do not match.");
        }
    }
}