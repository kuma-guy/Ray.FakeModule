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

    public function __construct(
        FactoryInterface $factory,
        Reader $reader
    ) {
        $this->factory = $factory;
        $this->reader = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        // The resource object's method will be called.
        $method = $invocation->getMethod();

        // Get parameters.
        $arguments = $invocation->getArguments();
        $arguments = (array) $arguments;

        // Get the fake resource uri.
        $resourceObject = $invocation->getThis();
        $resourceObject->uri->path = str_replace('/', '/Fake', $resourceObject->uri->path);

        // Create a instance of the fake resource.
        $ro = $this->factory->newInstance($resourceObject->uri);

        // Invoke.
        return call_user_func_array(array($ro, $method->name), $arguments);
    }
}
