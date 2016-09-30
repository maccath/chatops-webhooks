<?php

namespace App\Authenticators;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Interface AuthenticatorInterface
 * @package App
 */
interface AuthenticatorInterface
{
    /**
     * Apply authentication settings
     *
     * @param array $settings the authenticator settings
     */
    public function __construct(array $settings);

    /**
     * Given a request, check authentication
     *
     * @param Request $request the application request
     * @param Response $response the application response
     * @param callable $next the next action
     * @throws \Exception if request can't be authenticated
     * @return void
     */
    public function __invoke($request, $response, $next);
}