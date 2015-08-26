<?php

namespace App\ErrorHandlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Body;
use \Slim\Handlers\Error;

final class Slack extends Error
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Exception $exception)
    {
        $body = sprintf("An error occurred: %s",
            $exception->getMessage()
        );

        return $response
            ->withStatus(500)
            ->withHeader('Content-type', 'text/plain')
            ->withBody(new Body(fopen('php://temp', 'r+')))
            ->write($body);
    }
}