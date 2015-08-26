<?php

namespace App\Responses;

use Slim\Http\Response;

/**
 * Class Slack
 * @package App\Responses
 */
class Json implements ResponseInterface
{
    protected $data;

    /**
     * @param \stdClass $data
     * @param array $settings
     * @return void
     */
    public function hydrate(\stdClass $data, array $settings)
    {
        $this->data = $data;
    }

    /**
     * @param Response $response
     * @return Response
     */
    public function getFormattedResponse(Response $response)
    {
        return $response->withJson($this->data);
    }
}