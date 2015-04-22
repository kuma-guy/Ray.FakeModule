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
use FakeVendor\Sandbox\AppModule;

class FakeParamInjectInterceptorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    protected function setUp()
    {
        $this->resource = (new Injector(new AppModule()))->getInstance(ResourceInterface::class);
    }

    public function testFakeRequest()
    {
        // Real User Resource with annotation @Fake(uri="app://self/fake/user")
        $response = $this->resource
            ->get
            ->uri('app://self/User')
            ->withQuery(['id' => 2])
            ->eager
            ->request()
            ->body;

        // Fake User Resource Body
        $expected = [];
        $expected['id']      = 2;
        $expected['name']    = 'fake';
        $expected['age']     = 16;
        $expected['blog_id'] = 12;

        $this->assertSame($expected['id'], $response['id']);
        $this->assertSame($expected['name'], $response['name']);
        $this->assertSame($expected['age'], $response['age']);
        $this->assertSame($expected['blog_id'], $response['blog_id']);
    }
}
