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
     * @throws \Exception
     */
    public function execute(Request $request, Response $response, array $args)
    {
        $dateString = $request->getParam('text');

        if (!$dateString) {
            throw new \Exception("Please send me a date to calculate!");
        }

        $date = strtotime($dateString);

        if (!$date) {
            throw new \Exception(sprintf(
                "I am a moron and I don't know when *%s* is. :sob: Please try again!",
                $dateString)
            );
        }

        $this->data->text = sprintf("*%s* is: %s",
            $dateString,
            date('d/m/Y', $date)
        );
    }
}