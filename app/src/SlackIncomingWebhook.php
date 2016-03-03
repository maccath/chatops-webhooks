<?php

namespace App;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class SlackIncomingWebhook
 *
 * Sends data to a Slack Incoming Webhook integration
 *
 * @package App
 */
class SlackIncomingWebhook
{
    /**
     * @var string incoming webhook URL
     */
    private $url;

    /**
     * Construct the Slack Incoming Webhook with settings
     *
     * @param $settings
     */
    public function __construct($settings)
    {
        if (isset($settings['url'])) {
            $this->url = $settings['url'];
        }
    }

    /**
     * Send prepared response data to Slack Incoming Webhook integration
     *
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     * @throws \Exception
     */
    public function send(Request $request, Response $response, callable $next)
    {
        $response = $next($request, $response);

        if ( ! $this->url) {
            throw new \Exception('No incoming webhook URL configured.');
        }

        $data = 'payload=' . $response->getBody();

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        //Todo: do something with $result (error handling etc.?)

        $response = new Response();
        $response->write('');
        return $response;
    }
}