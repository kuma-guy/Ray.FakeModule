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
use Ray\FakeModule\Annotation\FakeClass;
use Ray\FakeModule\Annotation\FakeResource;

class FakeModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bindInterceptor(
            $this->matcher->annotatedWith(FakeResource::class),
            $this->matcher->any(),
            [FakeResourceInterceptor::class]
        );

        $this->bindInterceptor(
            $this->matcher->annotatedWith(FakeClass::class),
            $this->matcher->any(),
            [FakeClassInterceptor::class]
        );

        $this->bind(Reader::class)->to(AnnotationReader::class)->in(Scope::SINGLETON);
    }
}
