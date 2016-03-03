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
     * Apply the response settings
     *
     * @param array $settings
     * @return void
     */
    public function applySettings(array $settings);

    /**
     * Set the response data
     *
     * @param \stdClass $data
     * @return void
     */
    public function setData(\stdClass $data);

    /**
     * Get the formatted response
     *
     * @param Response $response the application response
     * @return Response a correctly formatted response
     */
    public function getFormattedResponse(Response $response);
}