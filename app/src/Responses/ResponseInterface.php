<?php

namespace App\Responses;

use Slim\Http\Response;

/**
 * Interface ResponseInterface
 * @package App\Responses
 */
interface ResponseInterface
{
    /**
     * @param array $settings
     * @return mixed
     */
    public function applySettings(array $settings);

    /**
     * @param \stdClass $data
     * @return void
     */
    public function setData(\stdClass $data);

    /**
     * @param Response $response
     * @return Response
     */
    public function getFormattedResponse(Response $response);
}