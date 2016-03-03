<?php

namespace App\Responses;

use Slim\Http\Response;

/**
 * Class Plain
 * @package App\Responses
 */
class Plain implements ResponseInterface
{
    /**
     * @var \stdClass response data
     */
    private $data;

    /**
     * @var array response settings
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
     * @return Response a plaintext response
     */
    public function getFormattedResponse(Response $response)
    {
        return $response->write((isset($this->data->title) ? $this->data->title . ': ' : '') .  $this->data->text);
    }
}