<?php
/**
 * This file is part of the Ray.FakeModule
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeModule;

use Doctrine\Common\Annotations\Reader;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;
use Ray\Di\InjectorInterface;

class FakeClassInterceptor implements MethodInterceptor
{
    /**
     * @var InjectorInterface
     */
    private $injector;

    /**
     * @var Reader
     */
    private $reader;

    public function __construct(
        InjectorInterface $injector,
        Reader $reader
    ) {
        $this->injector = $injector;
        $this->reader = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(MethodInvocation $invocation)
    {
        // Get class name.
        $fullClassName  = $invocation->getMethod()->class;
        $reflectClass   = new \ReflectionClass($fullClassName);
        $shortClassName = $reflectClass->getShortName();

        // Get full faker class name.
        $fakeClassName = str_replace($shortClassName, 'Fake' . $shortClassName, $fullClassName);

        // If exists fake class, then invoke its method. otherwise invoke original method.
        if (class_exists($fakeClassName)) {
            $fakeObj = $this->injector->getInstance($fakeClassName);
            $method = $invocation->getMethod()->name;
            $arguments = (array) $invocation->getArguments();

            return call_user_func_array([$fakeObj, $method], $arguments);
        }

        return $invocation->proceed();
    }
}
