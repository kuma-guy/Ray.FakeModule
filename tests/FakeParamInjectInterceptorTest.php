<?php

namespace Ray\FakeContextParam;

use BEAR\Resource\FakeSchemeModule;
use BEAR\Resource\Uri;
use BEAR\Resource\Module\ResourceModule;
use BEAR\Resource\ResourceInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use FakeVendor\Sandbox\Resource\App\User;
use Ray\Aop\Arguments;
use Ray\Aop\ReflectiveMethodInvocation;
use Ray\Di\Injector;
use Ray\FakeContextParam\Annotation\Fake;

class FakeParamInjectInterceptorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    protected function setUp()
    {
        $this->resource = (
        new Injector(
            new FakeSchemeModule(new ResourceModule('FakeVendor\Sandbox')), $_ENV['TMP_DIR']
        )
        )->getInstance(ResourceInterface::class);
    }

    private function factory($obj, $method, $annotation, $args = [], $resource)
    {
        $invocation = new ReflectiveMethodInvocation(
            $obj,
            new \ReflectionMethod($obj, $method),
            new Arguments($args),
            [
                new FakeContextParamInterceptor(
                    new AnnotationReader,
                    new ArrayCache,
                    $resource,
                    new FakeContext,
                    $annotation
                )
            ]
        );

        return $invocation;
    }

    public function testFakeRequest()
    {
        $obj = new User;
        // User Resource
        $invocation = $this->factory($obj, 'onGet', new Fake, ['id' => 1], $this->resource);
        $invocation->proceed();

        var_dump($obj);
        die();

        // Fake User Resource Return
        $expected = true;
        $this->assertSame($expected, $obj->body['fake']);

    }
}
