<?php

/**
 * Class GreetTest
 */
class GreetTest extends PHPUnit_Framework_TestCase
{
    private $action;
    private $request;
    private $response;

    /**
     * Set up test objects
     */
    public function setUp()
    {
        $this->action = new \App\Actions\Greet();
        $this->request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder('\Slim\HTTP\Response')->getMock();
    }

    /**
     * Test that some response data is returned and that it contains the passed name
     */
    public function testGreet()
    {
        $this->request->method('getParam', 'text')->willReturn('Katy');

        $this->action->execute($this->request, $this->response, []);

        $this->assertObjectHasAttribute('text', $this->action->getData());
        $this->assertContains('Katy', $this->action->getData()->text);
    }

    /**
     * Test that greeting throws an error when no name specified
     *
     * @expectedException \Exception
     */
    public function testGreetNoName()
    {
        $this->request->method('getParam', 'text')->willReturn(null);

        $this->action->execute($this->request, $this->response, []);
    }
}
