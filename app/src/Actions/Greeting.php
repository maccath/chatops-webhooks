<?php

namespace App\Actions;

use App\Formatters\FormatterInterface;

/**
 * Class Greeting
 * @package App\Actions
 */
class Greeting
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    /**
     * @param FormatterInterface $formatter
     */
    public function __construct(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param $request
     * @param $response
     * @param $args
     */
    public function greet($request, $response, $args)
    {
        $data = new \stdClass();

        $data->title = sprintf("Hello, %s!", $request->getParam('text'));
        $data->text = 'And a very happy unbirthday to you.';

        $response->withJson($this->formatter->getFormattedResponse($data));
    }
}