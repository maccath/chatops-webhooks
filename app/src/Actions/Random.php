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
     * @throws \Exception
     */
    public function execute(Request $request, Response $response, array $args)
    {
        $optionString = $request->getParam('text');

        if (!$optionString) {
            throw new \Exception("Please give me some options to choose from!");
        }

        $options = explode(',', $optionString);

        if (count($options) < 2) {
            throw new \Exception("I need at least two options to make a random selection!");
        }

        $this->data->text = sprintf("I choose you, %s!", trim($options[array_rand($options)]));
    }
}