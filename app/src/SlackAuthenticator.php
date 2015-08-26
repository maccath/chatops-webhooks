<?php

namespace App;

/**
 * Class SlackAuthenticator
 *
 * @package App
 */
class SlackAuthenticator implements AuthenticatorInterface
{
    /**
     * @var string the stored auth token
     */
    protected $token;

    /**
     * Apply authentication settings
     *
     * @param $settings
     * @return void
     */
    public function applySettings($settings)
    {
        $this->setToken($settings['token']);
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Check auth based on token in request parameters
     *
     * @param $request
     * @return boolean
     */
    public function check($request)
    {
        return ($request->getParam('token') == $this->token || !$this->token);
    }
}