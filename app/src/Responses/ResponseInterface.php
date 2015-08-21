<?php

namespace App\Responses;

/**
 * Interface ResponseInterface
 * @package App\Responses
 */
interface ResponseInterface
{
    /**
     * @return \stdClass response data
     */
    public function getResponseData();
}