<?php
/**
 * This file is part of the Ray.FakeModule
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeModule;

use BEAR\Resource\FactoryInterface;
use Doctrine\Common\Annotations\Reader;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\FakeModule\Annotation\FakeResource;

class FakeResourceInterceptor implements MethodInterceptor
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
        // Get fake uri for mocking the resource.
        $annotation = $this->reader->getMethodAnnotation($method, FakeResource::class);
        // Create a instance of fake resource.
        $ro = $this->factory->newInstance($annotation->uri);
        // Invoke.
        return call_user_func_array(array($ro, $method->name), $arguments);
    }
}
