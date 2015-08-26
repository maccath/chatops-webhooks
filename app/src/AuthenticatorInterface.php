<?php

namespace App;

/**
 * Interface AuthenticatorInterface
 * @package App
 */
interface AuthenticatorInterface
{
    /**
     * Set up the authenticator with the given settings array
     *
     * @param mixed $settings
     * @return mixed
     */
    function applySettings($settings);

    /**
     * Given a request, check authentication
     *
     * @param $request
     * @return boolean
     */
    function check($request);
}