<?php
/**
 * This file is part of the Ray.FakeContextParam
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam;

use BEAR\Resource\FactoryInterface;
use Doctrine\Common\Annotations\Reader;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\FakeContextParam\Annotation\Fake;

class FakeContextParamInterceptor implements MethodInterceptor
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var FakeContext
     */
    private $FakeContext;

    public function __construct(
        FactoryInterface $factory,
        Reader $reader,
        FakeContext $FakeContext
    ) {
        $this->factory = $factory;
        $this->reader = $reader;
        $this->FakeContext = $FakeContext;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        // Resource object's method will be called.
        $method = $invocation->getMethod();
        // Get parameters.
        $arguments = $invocation->getArguments();
        $arguments = (array) $arguments;
        // Get fake uri for the resource.
        $annotation = $this->reader->getMethodAnnotation($method, Fake::class);
        // Create fake resource instance and invoke the method.
        $ro = $this->factory->newInstance($annotation->uri);

        return call_user_func_array(array($ro, $method->name), $arguments);
    }
}
