<?php

use App\SlackIncomingWebhook;

class SlackIncomingWebhookTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \Exception
     */
    public function testConstructionWithEmptySettings()
    {
        new SlackIncomingWebhook([]);
    }

    public function testConstructionWithSettings()
    {
        $slackIncomingWebhook = new SlackIncomingWebhook([
            'url' => 'http://some.fake.url'
        ]);

        $this->assertEquals('http://some.fake.url', $slackIncomingWebhook->getUrl());
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
}
