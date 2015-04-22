<?php
/**
 * This file is part of the Ray.FakeContextParam
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam;

use BEAR\Resource\FactoryInterface;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\Cache;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\FakeContextParam\Annotation\Fake;


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
     * @var
     */
    private $FakeContext;

    public function __construct(
        Reader $reader,
        Cache $cache,
        FakeContext $FakeContext,
        FactoryInterface $factory
    ) {
        $this->factory = $factory;
        $this->reader = $reader;
        $this->cache = $cache;
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
        $annotation = $this->reader->getMethodAnnotation($method, Fake::class);
        $ro = $this->factory->newInstance($annotation->uri);
        return call_user_func_array(array($ro, $method->name), $arguments);
    }
}
