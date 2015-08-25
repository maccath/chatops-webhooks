<?php

namespace App\Formatters\Slack;

use App\Formatters\FormatterInterface;
use App\Responses\ResponseInterface;
use App\Responses\Slack;

/**
 * Class Basic
 * @package App\Formatters\Slack
 */
class Basic implements FormatterInterface
{
    /**
     * @var Slack response
     */
    protected $response;

    protected $fields = array(
        'title',
        'text',
        'icon_url',
        'icon_emoji',
        'username'
    );

    /**
     * @param ResponseInterface $response a Slack response
     * @throws \Exception
     */
    public function __construct(ResponseInterface $response)
    {
        if (!($response instanceof Slack)) {
            throw new \Exception(sprintf(
                'Formatters\Slack\BasicFormatter expects Responses\Slack, received %s.',
                get_class($response)
            ));
        }

        $this->response = $response;
    }

    /**
     * @param mixed $data input
     * @param array $settings settings
     * @return mixed formatted response
     */
    public function getFormattedResponse($data, $settings = array())
    {
        foreach ($this->fields as $field) {
            $value = false;
            $funcName = str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));

            // Use the value set in data as a preference, settings otherwise
            if (isset($data->{$field})) {
               $value = $data->{$field};
            } else if (isset($settings[$field])) {
               $value = $settings[$field];
            }

            if ($value) {
                call_user_func(array($this->response, 'set' . $funcName), $value);
            }
        }

        return $this->response->getResponseData();
    }
}