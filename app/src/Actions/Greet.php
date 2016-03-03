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
     * @var \stdClass $data the data to be used by the action
     */
    private $data;

    /**
     * Get the action data
     *
     * @return \stdClass
     */
    public function getData()
    {
        return $this->data;
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
     * @param Request $request the application request
     * @param Response $response the application response
     * @param array $args the route arguments
     * @throws \Exception if a name is not supplied
     * @return void
     */
    public function execute(Request $request, Response $response, array $args)
    {
        $name = $request->getParam('text');

        if ( ! $name) {
            throw new \Exception('I can\'t greet someone without a name!');
        }

        $this->data->icon_emoji = ':birthday:';
        $this->data->text = sprintf('*Hello, %s!* And a very happy unbirthday to you.', $name);
    }
}