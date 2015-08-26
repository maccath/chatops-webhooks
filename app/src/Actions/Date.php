<?php

namespace App\Actions;

/**
 * Class Date
 * @package App\Actions
 */
class Date extends Action
{
    /**
     * Display the date given a date string
     *
     * @param $request
     * @param $response
     * @param $args
     */
    protected function execute($request, $response, $args)
    {
        $dateString = $request->getParam('text');
        $date = strtotime($dateString);

        if ($date) {
            $this->data->text = sprintf("*%s* is: %s",
                $dateString,
                date('d/m/Y', $date)
            );
        } else {
            $this->data->text = sprintf("I am a moron and I don't know when *%s* is. :sob:", $dateString);
        }
    }
}