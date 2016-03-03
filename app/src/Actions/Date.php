<?php

namespace App\Actions;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Date
 * @package App\Actions
 */
class Date implements ActionInterface
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
     * Display the date given a date string
     *
     * @param Request $request the application request
     * @param Response $response the application response
     * @param array $args the route arguments
     * @throws \Exception if a date is not supplied, or the date cannot be parsed
     * @return void
     */
    public function execute(Request $request, Response $response, array $args)
    {
        $dateString = $request->getParam('text');

        if ( ! $dateString) {
            throw new \Exception('Please send me a date to calculate!');
        }

        $date = strtotime($dateString);

        if ( ! $date) {
            throw new \Exception(sprintf(
                'I am a moron and I don\'t know when *%s* is. :sob: Please try again!',
                $dateString
            ));
        }

        $this->data->text = sprintf(
            '*%s* is: %s',
            $dateString,
            date('d/m/Y', $date)
        );
    }
}