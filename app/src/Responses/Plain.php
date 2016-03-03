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
        return $response->write(sprintf(
            "%s%s",
            isset($this->data->title) ? $this->data->title . ': ' : '',
            $this->data->text
        ));
    }
}