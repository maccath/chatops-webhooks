<?php

use App\SlackIncomingWebhook;

class SlackIncomingWebhookTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructionWithEmptySettings()
    {
        new SlackIncomingWebhook([]);
    }

    public function testConstructionWithSettings()
    {
        new SlackIncomingWebhook([
            'url' => 'http://some.fake.url'
        ]);
    }

    public function testSend()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $response = $this->getMockBuilder('\Slim\HTTP\Response')->getMock();
        $next = function($request, $response) { return $response; };

        $slackIncomingWebhook = new SlackIncomingWebhook([
            'url' => 'http://some.fake.url'
        ]);

        $slackIncomingWebhook->send($request, $response, $next);
    }

    /**
     * @expectedException \Exception
     */
    public function testSendNoUrl()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $response = $this->getMockBuilder('\Slim\HTTP\Response')->getMock();
        $next = function($request, $response) { return $response; };

        $slackIncomingWebhook = new SlackIncomingWebhook([]);

        $slackIncomingWebhook->send($request, $response, $next);
    }
}
