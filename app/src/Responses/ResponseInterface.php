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
     * @param \stdClass $data
     * @param array $settings
     * @return mixed
     */
    public function hydrate(\stdClass $data, array $settings);

    /**
     * @param Response $response
     * @return mixed
     */
    public function getFormattedResponse(Response $response);
}