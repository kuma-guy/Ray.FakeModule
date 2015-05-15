<?php

namespace Ray\FakeModule;

use Ray\Di\Injector;
use FakeVendor\Sandbox\AppModule;
use FakeVendor\Sandbox\Module\TestClass;

class FakeClassInterceptorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Injector
     */
    private $injector;

    protected function setUp()
    {
        $this->injector = (new Injector(new AppModule()));
    }

    public function testFakeRequest()
    {
        $fakeClass = $this->injector->getInstance(TestClass::class);
        $output = $fakeClass->output();

        $expected = "fake class output";
        $this->assertSame($expected, $output);
    }
}
