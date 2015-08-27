<?php

/**
 * Class SlackAuthenticatorTest
 */
class SlackAuthenticatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that authentication fails when request token doesn't match authenticator token
     *
     * @expectedException \Exception
     */
    public function testCheckAuthNoMatchWithToken()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $request->method('getParam')->willReturn('badtoken');

        $authenticator = new \App\Authenticators\Slack();
        $authenticator->applySettings(['token' => 'validtoken']);

        $authenticator->check($request);
    }

    /**
     * Test that authentication passes when request token matches authenticator token
     */
    public function testCheckAuthMatchWithToken()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $request->method('getParam')->willReturn('validtoken');

        $authenticator = new \App\Authenticators\Slack();
        $authenticator->applySettings(['token' => 'validtoken']);

        $authenticator->check($request);
    }

    /**
     * Test that authentication passes when authenticator token is false regardless of request token value
     */
    public function testCheckAuthMatchWithoutToken()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $request->method('getParam')->willReturn('validtoken');

        $authenticator = new \App\Authenticators\Slack();
        $authenticator->applySettings([]);

        $authenticator->check($request);
    }
}
