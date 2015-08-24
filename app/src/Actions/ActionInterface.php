<?php

namespace App\Actions;

use App\Formatters\FormatterInterface;

/**
 * Interface ActionInterface
 * @package App\Actions
 */
interface ActionInterface
{
    /**
     * Construct an action with a formatter and settings
     *
     * @param FormatterInterface $formatter
     * @param $settings
     */
    function __construct(FormatterInterface $formatter, $settings);
}