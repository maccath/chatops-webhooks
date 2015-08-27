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
     * Display the date given a date string
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return void
     */
    public function execute(Request $request, Response $response, array $args)
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