<?php

namespace App\ErrorHandlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Body;
use \Slim\Handlers\Error;

final class Json extends Error
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Exception $exception)
    {
        $data = new \stdClass();
        $data->message = $exception->getMessage();
        $data->code = $exception->getCode();

        return $response
            ->withStatus(500)
            ->withHeader('Content-type', 'application/json')
            ->withBody(new Body(fopen('php://temp', 'r+')))
            ->withJson($data);
    }
}