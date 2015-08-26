<?php

namespace App;

use Slim\Http\Request;

/**
 * Interface AuthenticatorInterface
 * @package App
 */
interface AuthenticatorInterface
{
    /**
     * Set up the authenticator with the given settings array
     *
     * @param array $settings
     */
    function applySettings(array $settings);

    /**
     * Given a request, check authentication
     *
     * @param Request $request
     * @return boolean
     */
    function check(Request $request);
}