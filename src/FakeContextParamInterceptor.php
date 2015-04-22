<?php
/**
 * This file is part of the Ray.FakeContextParam
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam;

use BEAR\Resource\ResourceInterface;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\Cache;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\FakeContextParam\Annotation\AbstractFakeContextParam;


class FakeContextParamInterceptor implements MethodInterceptor
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * @var
     */
    private $FakeContext;

    public function __construct(
        Reader $reader,
        Cache $cache,
        ResourceInterface $resource,
        FakeContext $FakeContext
    ) {
        $this->reader = $reader;
        $this->cache = $cache;
        $this->resource = $resource;
        $this->FakeContext = $FakeContext;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        $method = $invocation->getMethod();
        $arguments = $invocation->getArguments();
        $arguments = (array) $arguments;
        $annotations = $this->reader->getMethodAnnotations($method);

        $fakeUri = '';
        foreach ($annotations as $annotation) {
            if ($annotation instanceof AbstractFakeContextParam) {
                $fakeUri = $annotation->uri;
            }
        }

        // TODO Refactoring WithQuery Parameter and Resource Chaining?
        $res = $this->resource
            ->get
            ->uri($fakeUri)
            ->withQuery(['id' => 1])
            ->eager
            ->request()
            ->body;

        return $res;
    }
}
