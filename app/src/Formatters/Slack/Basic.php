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
     * @return mixed formatted response
     */
    public function getFormattedResponse($data)
    {
        foreach ($this->fields as $field) {
            if (isset($data->{$field})) {
                $funcName = str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
                call_user_func(array($this->response, 'set'.$funcName), $data->{$field});
            }
        }

        return $this->response->getResponseData();
    }
}