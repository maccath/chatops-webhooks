<?php

namespace App\Actions;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Interface ActionInterface
 * @package App\Actions
 */
interface ActionInterface
{
    /**
     * Get the action data
     *
     * @return \stdClass
     */
    function getData();

    /**
     * Execute the action
     *
     * @param Request $request the application request
     * @param Response $response the application response
     * @param array $args the route arguments
     * @return void
     */
    function execute(Request $request, Response $response, array $args);
}