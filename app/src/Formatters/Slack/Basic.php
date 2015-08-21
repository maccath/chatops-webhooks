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
        if (isset($data->title)) {
            $this->response->setTitle($data->title);
        }

        if (isset($data->text)) {
            $this->response->setText($data->text);
        }

        if (isset($data->icon)) {
            $this->response->setIcon($data->icon);
        }

        if (isset($data->emoji)) {
            $this->response->setEmoji($data->emoji);
        }

        return $this->response->getResponseData();
    }
}