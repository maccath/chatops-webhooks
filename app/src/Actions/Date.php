<?php

namespace App\Actions;

use App\Formatters\FormatterInterface;
use stdClass;

class Date implements ActionInterface
{
    /**
     * @var FormatterInterface response formatter
     */
    protected $formatter;

    /**
     * @var array settings
     */
    protected $settings;

    /**
     * @param FormatterInterface $formatter
     * @param $settings
     */
    public function __construct(FormatterInterface $formatter, $settings)
    {
        $this->formatter = $formatter;
        $this->settings = $settings;
    }

    /**
     * Get the date specified by text parameter
     *
     * @param $request
     * @param $response
     * @param $args
     */
    public function getDate($request, $response, $args)
    {
        $dateString = $request->getParam('text');
        $date = strtotime($dateString);

        $data = $this->setupData();

        if ($date) {
            $data->text = sprintf("*%s* is: %s",
                $dateString,
                date('d/m/Y', $date)
            );
        } else {
            $data->text = sprintf("I am a moron and I don't know when *%s* is. :sob:", $dateString);
        }


        $response->withJson($this->formatter->getFormattedResponse($data));
    }

    /**
     * Set up response data
     *
     * @return stdClass
     */
    protected function setupData()
    {
        $data = new stdClass();

        $data->username = isset($this->settings['username']) ? $this->settings['username'] : 'Date Bot';
        $data->icon_emoji = isset($this->settings['icon_emoji']) ? $this->settings['icon_emoji'] : ':calendar:';

        return $data;
    }
}