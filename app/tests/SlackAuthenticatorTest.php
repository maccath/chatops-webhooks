<?php

/**
 * Class SlackAuthenticatorTest
 */
class SlackAuthenticatorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that settings apply when no token specified
     */
    public function testApplySettingsNoToken()
    {
        $authenticator = new \App\SlackAuthenticator();
        $authenticator->applySettings([]);

        $this->assertEquals(false, $authenticator->getToken());
    }

    /**
     * Test that settings apply when a token is specified
     */
    public function testApplySettingsWithToken()
    {
        $authenticator = new \App\SlackAuthenticator();
        $authenticator->applySettings(['token' => 'testtoken']);

        $this->assertEquals('testtoken', $authenticator->getToken());
    }

    /**
     * Test that authentication fails when request token doesn't match authenticator token
     */
    public function testCheckAuthNoMatchWithToken()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $request->method('getParam')->willReturn('badtoken');

        $authenticator = new \App\SlackAuthenticator();
        $authenticator->applySettings(['token' => 'validtoken']);

        $this->assertEquals(false, $authenticator->check($request));
    }

    /**
     * Test that authentication passes when request token matches authenticator token
     */
    public function testCheckAuthMatchWithToken()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $request->method('getParam')->willReturn('validtoken');

        $authenticator = new \App\SlackAuthenticator();
        $authenticator->applySettings(['token' => 'validtoken']);

        $this->assertEquals(true, $authenticator->check($request));
    }

    /**
     * Test that authentication passes when authenticator token is false regardless of request token value
     */
    public function testCheckAuthMatchWithoutToken()
    {
        $request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $request->method('getParam')->willReturn('validtoken');

        $authenticator = new \App\SlackAuthenticator();
        $authenticator->applySettings([]);

        $this->assertEquals(true, $authenticator->check($request));
    }
}
