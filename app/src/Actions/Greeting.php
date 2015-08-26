<?php

namespace App\Actions;

/**
 * Class Greeting
 * @package App\Actions
 */
class Greeting extends Action
{
    /**
     * Greet a named user
     *
     * @param $request
     * @param $response
     * @param $args
     */
    protected function execute($request, $response, $args)
    {
        $data = $this->setupData();
        $data->icon_emoji = ':birthday:';
        $data->text = sprintf('*Hello, %s!* And a very happy unbirthday to you.', $request->getParam('text'));

        $response->withJson($this->formatter->getFormattedResponse($data, $this->settings));
    }
}