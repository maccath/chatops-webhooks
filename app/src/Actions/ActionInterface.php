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
     * @return \stdClass
     */
    function getData();

    /**
     * @param \stdClass $data
     * @return void
     */
    function setData(\stdClass $data);

    /**
     * Execute the action
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    function execute(Request $request, Response $response, array $args);
}