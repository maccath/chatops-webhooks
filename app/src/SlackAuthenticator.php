<?php

namespace App;

use Slim\Http\Request;

/**
 * Class SlackAuthenticator
 *
 * @package App
 */
class SlackAuthenticator implements AuthenticatorInterface
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
     * Check auth based on token in request parameters
     *
     * @param Request $request
     * @return boolean
     */
    public function check(Request $request)
    {
        return ($request->getParam('token') == $this->getToken() || !$this->getToken());
    }
}