<?php

namespace App\Actions;

use App\Authenticators\AuthenticatorInterface;
use App\Responses\ResponseInterface;

/**
 * Interface ActionInterface
 * @package App\Actions
 */
interface ActionInterface
{
    /**
     * Construct an action with a formatter, settings and authenticator
     *
     * @param ResponseInterface $response
     * @param AuthenticatorInterface $authenticator
     * @param $settings
     */
    function __construct(ResponseInterface $response, AuthenticatorInterface $authenticator, $settings);

    /**
     * Invoke the action
     *
     * @param $request
     * @param $response
     * @param $args
     */
    function __invoke($request, $response, $args);
}