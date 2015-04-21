<?php
/**
 * This file is part of the Ray.FakeContextParam
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam;

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
     * @var
     */
    private $FakeContext;

    public function __construct(
        Reader $reader,
        Cache $cache,
        FakeContext $FakeContext
    ) {
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
        $annotations = $this->reader->getMethodAnnotations($method);

        $fakeUri = '';
        foreach ($annotations as $annotation) {
            if ($annotation instanceof AbstractFakeContextParam) {
                $fakeUri = $annotation->uri;
            }
        }

        // TODO: request fakeUri and return body?

        return $invocation->proceed();
    }
}
