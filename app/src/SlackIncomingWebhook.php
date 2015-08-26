<?php

namespace App;

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
    protected $url;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Construct the Slack Incoming Webhook with settings
     *
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        if (isset($settings['url'])) {
            $this->setUrl($settings['url']);
        }
    }

    /**
     * Send prepared response data to Slack Incoming Webhook integration
     *
     * @param $request
     * @param $response
     * @param $next
     * @return Response
     * @throws \Exception
     */
    public function send($request, $response, $next)
    {
        $response = $next($request, $response);

        if (!$this->url) {
            throw new \Exception("No incoming webhook URL configured.");
        }

        $data = "payload=" . $response->getBody();

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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