<?php

namespace App;

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
     * Construct the Slack Incoming Webhook with settings
     *
     * @param $settings
     */
    public function __construct($settings)
    {
        $this->url = $settings['url'];
    }

    /**
     * Send prepared response data to Slack Incoming Webhook integration
     *
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function send($request, $response, $next)
    {
        $response = $next($request, $response);

        $data = "payload=" . $response->getBody();

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        //Todo: do something with $result (error handling etc.?)

        return $response;
    }
}