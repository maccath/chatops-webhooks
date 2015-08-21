<?php

namespace App\Formatters;

use App\Responses\ResponseInterface;

/**
 * Interface FormatterInterface
 * @package App\Formatters
 */
interface FormatterInterface
{
    /**
     * @param ResponseInterface $response a compatible ResponseInterface
     */
    public function __construct(ResponseInterface $response);

    /**
     * @param mixed $data input
     * @return mixed formatted response
     */
    public function getFormattedResponse($data);
}