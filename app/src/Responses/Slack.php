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
    protected $icon;

    /**
     * Emoticon to display in place of an icon
     *
     * @var
     */
    protected $emoji;

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
    final public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    final public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    final public function getEmoji()
    {
        return $this->emoji;
    }

    /**
     * @param mixed $emoji
     */
    final public function setEmoji($emoji)
    {
        $this->emoji = $emoji;
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

        if ($icon = $this->getIcon()) {
            $response->icon = $icon;
        }

        if ($emoji = $this->getEmoji()) {
            $response->emoji = $emoji;
        }

        return $response;
    }
}