<?php

namespace App\Tests\Actions;

/**
 * Class DateTest
 */
class DateTest extends \PHPUnit_Framework_TestCase
{
    private $action;
    private $request;
    private $response;

    /**
     * Set up test objects
     */
    public function setUp()
    {
        $this->action = new \App\Actions\Date();
        $this->request = $this->getMockBuilder('\Slim\HTTP\Request')->disableOriginalConstructor()->getMock();
        $this->response = $this->getMockBuilder('\Slim\HTTP\Response')->getMock();
    }

    /**
     * Test that error is returned when no date string given
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp #Please send.#
     */
    public function testNoDateString()
    {
        $this->request->method('getParam')->willReturn(null);

        $this->action->execute($this->request, $this->response, []);
    }

    /**
     * Test that error is returned given bad date string
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp #.don't know.#
     */
    public function testBadDateString()
    {
        $this->request->method('getParam')->willReturn('bad date');

        $this->action->execute($this->request, $this->response, []);
    }

    /**
     * Test that date is returned given valid date string
     */
    public function testGoodDateString()
    {
        $this->request->method('getParam', 'text')->willReturn('today');

        $this->action->execute($this->request, $this->response, []);

        $data = $this->action->getData();
        $date = date('d/m/Y');

        $this->assertEquals($data->text, "*today* is: " . $date);
    }
}
