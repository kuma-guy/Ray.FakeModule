<?php
/**
 * This file is part of the Ray.FakeModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeModule;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Ray\FakeModule\Annotation\FakeMethod;
use Ray\FakeModule\Annotation\FakeResource;

class FakeModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(FakeResource::class),
            [FakeResourceInterceptor::class]
        );

        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(FakeMethod::class),
            [FakeMethodInterceptor::class]
        );

        $this->bind(Reader::class)->to(AnnotationReader::class)->in(Scope::SINGLETON);
    }
}
