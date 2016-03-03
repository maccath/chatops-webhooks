<?php

namespace App\Tests\Actions;

/**
 * Class ActionExecutorTest
 */
class ActionExecutorTest extends \PHPUnit_Framework_TestCase
{
    private $action;
    private $authenticator;
    private $response;
    private $slimRequest;
    private $slimResponse;

    /**
     * Set up test objects
     */
    public function setUp()
    {
        $this->action = $this->getMockBuilder('\App\Actions\ActionInterface')->disableOriginalConstructor()->getMock();
        $this->authenticator = $this->getMockBuilder('\App\Authenticators\AuthenticatorInterface')->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder('\App\Responses\ResponseInterface')->getMock();
        $this->slimRequest = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $this->slimResponse = $this->getMockBuilder('\Slim\HTTP\Response')->disableOriginalConstructor()->getMock();
    }

    /**
     * Test that the executor constructs when empty settings array passed
     */
    public function testConstructNoSettings()
    {
        $this->response->expects($this->once())
            ->method('applySettings');

        new \App\Actions\ActionExecutor($this->action, $this->response, $this->authenticator, []);
    }

    /**
     * Test that the executor constructs and sets up authenticator when authentication settings passed
     */
    public function testConstructWithAuthenticationSettings()
    {
        $this->authenticator->expects($this->once())
            ->method('applySettings');

        $this->response->expects($this->once())
            ->method('applySettings');

        $settings = [
            'authentication' => [
                'test'
            ]
        ];

        new \App\Actions\ActionExecutor($this->action, $this->response, $this->authenticator, $settings);
    }

    /**
     * Test that the executor checks auth, executes and renders when invoked
     */
    public function testExecutorInvokation()
    {
        $this->action->method('getData')->willReturn(new \stdClass());

        // Check auth
        $this->authenticator->expects($this->once())
            ->method('check');

        // Execute action
        $this->action->expects($this->once())
            ->method('execute');

        // Render
        $this->action->expects($this->once())
            ->method('getData');

        $this->response->expects($this->once())
            ->method('setData');

        $this->response->expects($this->once())
            ->method('getFormattedResponse');

        $actionExecutor = new \App\Actions\ActionExecutor($this->action, $this->response, $this->authenticator, []);

        $actionExecutor->__invoke($this->slimRequest, $this->slimResponse, []);
    }

}
