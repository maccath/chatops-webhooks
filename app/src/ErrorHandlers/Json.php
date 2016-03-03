<?php

namespace App\ErrorHandlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Body;
use \Slim\Handlers\Error;

/**
 * Class Json
 *
 * @package App\ErrorHandlers
 */
final class Json extends Error
{
    /**
     * Render the error in a JSON format
     *
     * @param ServerRequestInterface $request the application request
     * @param ResponseInterface $response the application response
     * @return ResponseInterface the response containing the error
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Exception $exception)
    {
        $data = new \stdClass();
        $data->message = $exception->getMessage();
        $data->code = $exception->getCode();

        // Todo: alternative statuses?
        return $response
            ->withStatus(500)
            ->withHeader('Content-type', 'application/json')
            ->withBody(new Body(fopen('php://temp', 'r+')))
            ->withJson($data);
    }
}