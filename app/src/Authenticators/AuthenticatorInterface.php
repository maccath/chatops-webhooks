<?php

namespace App\Authenticators;

use Slim\Http\Request;

/**
 * Interface AuthenticatorInterface
 * @package App
 */
interface AuthenticatorInterface
{
    /**
     * Set up the authenticator with the given settings
     *
     * @param array $settings the authentication settings
     */
    function applySettings(array $settings);

    /**
     * Given a request, check authentication
     *
     * @param Request $request the application request
     * @throws \Exception if request can't be authenticated
     * @return void
     */
    function check(Request $request);
}