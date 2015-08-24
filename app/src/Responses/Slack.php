<?php

namespace App\Responses;

/**
 * Class Slack
 * @package App\Responses
 */
class Slack implements ResponseInterface
{
    /**
     * Title to display on the chat message
     *
     * @var
     */
    protected $title;

    /**
     * Text to display in the chat message
     *
     * @var
     */
    protected $text;

    /**
     * Icon to display next to the chat message
     *
     * @var
     */
    protected $icon_url;

    /**
     * Emoticon to display in place of an icon
     *
     * @var
     */
    protected $icon_emoji;

    /**
     * Username to display as sender
     *
     * @var
     */
    protected $username;

    /**
     * @return mixed
     */
    final public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    final public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    final public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    final public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    final public function getIconUrl()
    {
        return $this->icon_url;
    }

    /**
     * @param mixed $icon_url
     */
    final public function setIconUrl($icon_url)
    {
        $this->icon_url = $icon_url;
    }

    /**
     * @return mixed
     */
    final public function getIconEmoji()
    {
        return $this->icon_emoji;
    }

    /**
     * @param mixed $icon_emoji
     */
    final public function setIconEmoji($icon_emoji)
    {
        $this->icon_emoji = $icon_emoji;
    }

    /**
     * @return mixed
     */
    final public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    final public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return \stdClass response data
     */
    final public function getResponseData()
    {
        $response = new \stdClass();

        if ($title = $this->getTitle()) {
            $response->title = $title;
        }

        if ($text = $this->getText()) {
            $response->text = $text;
        }

        if ($icon_url = $this->getIconUrl()) {
            $response->icon_url = $icon_url;
        }

        if ($icon_emoji = $this->getIconEmoji()) {
            $response->icon_emoji = $icon_emoji;
        }

        if ($username = $this->getUsername()) {
            $response->username = $username;
        }

        return $response;
    }
}