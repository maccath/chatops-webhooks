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
     * @param array $settings
     * @return void
     */
    public function applySettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param \stdClass $data
     */
    public function setData(\stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function getFormattedResponse(Response $response)
    {
        return $response->withJson($this->data);
    }
}