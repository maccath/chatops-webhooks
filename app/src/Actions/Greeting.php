<?php

namespace App\Actions;

use App\Formatters\FormatterInterface;

use stdClass;

/**
 * Class Greeting
 * @package App\Actions
 */
class Greeting implements ActionInterface
{
    /**
     * @var FormatterInterface data formatter
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
     * Greet a named user
     *
     * @param $request
     * @param $response
     * @param $args
     */
    public function greet($request, $response, $args)
    {
        $data = $this->setupData();
        $data->icon_emoji = ':birthday:';
        $data->text = sprintf('*Hello, %s!* And a very happy unbirthday to you.', $request->getParam('text'));

        $response->withJson($this->formatter->getFormattedResponse($data, $this->settings));
    }

    /**
     * Return a basic data object setup
     *
     * @return stdClass
     */
    protected function setupData()
    {
        $data = new stdClass();

        return $data;
    }
}