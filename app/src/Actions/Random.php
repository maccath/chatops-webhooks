<?php

namespace App\Actions;

class Random extends Action
{
    /**
     * Choose a random item from the specified options
     *
     * @param $request
     * @param $response
     * @param $args
     */
    protected function execute($request, $response, $args)
    {
        $options = explode(',', $request->getParam('text'));

        $data = $this->setupData();

        $data->text = sprintf("I choose you, %s!", trim($options[array_rand($options)]));

        $response->withJson($this->formatter->getFormattedResponse($data, $this->settings));
    }
}