<?php

namespace App\Actions;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Greet
 * @package App\Actions
 */
class Greet implements ActionInterface
{
    /**
     * @var \stdClass $data
     */
    private $data;

    /**
     * @return \stdClass
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \stdClass $data
     */
    public function setData(\stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * Construct with empty data object
     */
    public function __construct()
    {
        $this->data = new \stdClass();
    }

    /**
     * Greet a named user
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @throws \Exception
     */
    public function execute(Request $request, Response $response, array $args)
    {
        $name = $request->getParam('text');

        if (!$name) {
            throw new \Exception("I can't greet someone without a name!");
        }

        $this->data->icon_emoji = ':birthday:';
        $this->data->text = sprintf('*Hello, %s!* And a very happy unbirthday to you.', $name);
    }
}