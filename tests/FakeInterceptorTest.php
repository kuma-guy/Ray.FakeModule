<?php
/**
 * This file is part of the Ray.FakeModule package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\FakeModule;

use Ray\Di\Injector;

class FakeInterceptorTest extends \PHPUnit_Framework_TestCase
{
    public function testFakeRequest()
    {
        $fake = (new Injector(new TestModule))->getInstance(TestClass::class);
        $acutual = $fake->output();
        $expected = 'fake class output';
        $this->assertSame($expected, $acutual);
    }
}
