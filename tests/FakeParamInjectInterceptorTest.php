<?php

namespace Ray\FakeContextParam;

use BEAR\Resource\Uri;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use Ray\Aop\Arguments;
use Ray\Aop\ReflectiveMethodInvocation;
use Ray\FakeContextParam\Annotation\Fake;

class FakeParamInjectInterceptorTest extends \PHPUnit_Framework_TestCase
{
    private function factory($obj, $method, $annotation, $args = [])
    {
        $invocation = new ReflectiveMethodInvocation(
            $obj,
            new \ReflectionMethod($obj, $method),
            new Arguments($args),
            [
                new FakeContextParamInterceptor(
                    new AnnotationReader,
                    new ArrayCache,
                    new FakeContext,
                    $annotation
                )
            ]
        );

        return $invocation;
    }

    public function testFakeRequest()
    {
        // User Resource
        $obj = new UserResource;
        $invocation = $this->factory($obj, 'onGet', new Fake, [null]);
        $invocation->proceed();
        // Fake User Resource return fake true.
        $expected = true;
        $this->assertSame($expected, $obj->body['fake']);
    }
}
