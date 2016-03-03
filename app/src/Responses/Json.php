<?php

namespace App\Responses;

use Slim\Http\Response;

/**
 * Class Json
 * @package App\Responses
 */
class Json implements ResponseInterface
{
    /**
     * @var \stdClass action data
     */
    private $data;

    /**
     * @var array action settings
     */
    private $settings;

    /**
     * Apply the response settings
     *
     * @param array $settings the settings
     * @return void
     */
    public function applySettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Set the response data
     *
     * @param \stdClass $data the data
     * @return void
     */
    public function setData(\stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * Get the formatted response
     *
     * @param Response $response the application response
     * @return Response a JSON formatted response
     */
    public function getFormattedResponse(Response $response)
    {
        return $response->withJson($this->data);
    }
}