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
     * @param array $settings
     * @return void
     */
    public function applySettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @param \stdClass $data
     * @return void
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
        $data = new \stdClass();

        foreach ($this->fields as $field) {
            $value = false;

            // Use the value set in data as a preference, settings otherwise
            if (isset($this->data->{$field})) {
                $value = $this->data->{$field};
            } else if (isset($this->settings[$field])) {
                $value = $this->settings[$field];
            }

            if ($value) {
                $data->{$field} = $value;
            }
        }

        return $response->withJson($data);
    }
}