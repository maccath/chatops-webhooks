<?php

namespace App\Responses;

use Slim\Http\Response;

/**
 * Class Slack
 * @package App\Responses
 */
class Slack implements ResponseInterface
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
     * @var array response fields
     */
    private $fields = array(
        'title',
        'text',
        'icon_url',
        'icon_emoji',
        'username'
    );

    /**
     * Apply the response settings
     *
     * @param array $settings
     * @return void
     */
    public function applySettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Set the response data
     *
     * @param \stdClass $data
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
     * @return Response a slack response
     */
    public function getFormattedResponse(Response $response)
    {
        $data = new \stdClass();

        foreach ($this->fields as $field) {

            // Use the value in settings if it exists...
            if (isset($this->settings[$field])) {
                $data->{$field} = $this->settings[$field];
            }

            // ...but if data value exists, then use that
            if (isset($this->data->{$field})) {
                $data->{$field} = $this->data->{$field};
            }
        }

        return $response->withJson($data);
    }
}