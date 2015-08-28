<?php

/**
 * Class RandomTest
 */
class RandomTest extends PHPUnit_Framework_TestCase
{
    private $action;
    private $request;
    private $response;

    /**
     * Set up test objects
     */
    public function setUp()
    {
        $this->action = new \App\Actions\Random();
        $this->request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder('\Slim\HTTP\Response')->getMock();
    }

    /**
     * Test successful setting and getting of data
     */
    public function testSetData()
    {
        $data = new stdClass();

        $this->action->setData($data);
        $this->assertEquals($this->action->getData(), $data);
    }

    /**
     * Test that some response data is returned
     */
    public function testRandom()
    {
        $this->request->method('getParam', 'text')->willReturn('one, two, three');

        $this->action->execute($this->request, $this->response, []);

        $this->assertObjectHasAttribute('text', $this->action->getData());
    }

    /**
     * Test that random throws an error when no options specified
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp #.some options.#
     */
    public function testRandomNoOptions()
    {
        $this->request->method('getParam', 'text')->willReturn(null);

        $this->action->execute($this->request, $this->response, []);
    }

    /**
     * Test that random throws an error when no options specified
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp #.at least two options.#
     */
    public function testRandomOneOption()
    {
        $this->request->method('getParam', 'text')->willReturn('hi');

        $this->action->execute($this->request, $this->response, []);
    }
}
