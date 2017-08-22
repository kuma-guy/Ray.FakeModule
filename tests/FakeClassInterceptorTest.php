<?php

namespace Ray\FakeModule;

use Ray\Di\Injector;

class FakeClassInterceptorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Injector
     */
    private $injector;

    protected function setUp()
    {
        $this->injector = (new Injector(new TestModule));
    }

    public function testFakeRequest()
    {
        $fakeClass = $this->injector->getInstance(TestClass::class);
        $output = $fakeClass->output();

        $expected = "fake class output";
        $this->assertSame($expected, $output);
    }
}
