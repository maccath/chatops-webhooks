<?php

namespace App\Actions;

/**
 * Class Greet
 * @package App\Actions
 */
class Greet extends Action
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
        $this->data->icon_emoji = ':birthday:';
        $this->data->text = sprintf('*Hello, %s!* And a very happy unbirthday to you.', $request->getParam('text'));
    }
}