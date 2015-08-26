<?php

namespace App\Actions;

use App\AuthenticatorInterface;
use App\Formatters\FormatterInterface;
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
     * @param FormatterInterface $formatter
     * @param AuthenticatorInterface $authenticator
     * @param $settings
     */
    function __construct(FormatterInterface $formatter, AuthenticatorInterface $authenticator, $settings);

    /**
     * Invoke the action
     *
     * @param $request
     * @param $response
     * @param $args
     */
    function __invoke($request, $response, $args);
}