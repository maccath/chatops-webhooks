<?php

namespace App\ErrorHandlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Body;
use \Slim\Handlers\Error;

/**
 * Class Json
 * @package App\ErrorHandlers
 */
final class Json extends Error
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param \Exception $exception
     * @return mixed
     */
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