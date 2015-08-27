<?php

namespace App\Actions;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Random
 * @package App\Actions
 */
class Random implements ActionInterface
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
     * Choose a random item from the specified options
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function execute(Request $request, Response $response, array $args)
    {
        $options = explode(',', $request->getParam('text'));

        $this->data->text = sprintf("I choose you, %s!", trim($options[array_rand($options)]));
    }
}