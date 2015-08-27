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
     * @param array $settings
     */
    function applySettings(array $settings);

    /**
     * Given a request, check authentication
     *
     * @param Request $request
     * @throws \Exception
     * @return void
     */
    function check(Request $request);
}