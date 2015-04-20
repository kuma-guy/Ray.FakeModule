<?php

namespace Ray\FakeModule;

class FakeModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FakeModule
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new FakeModule;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\Ray\FakeModule\FakeModule', $actual);
    }

    public function testException()
    {
        $this->setExpectedException('\Ray\FakeModule\Exception\LogicException');
        throw new Exception\LogicException;
    }
}
