<?php
/**
 * This file is part of the Ray.FakeContextParam package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeContextParam;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Ray\FakeContextParam\Annotation\FakeResource;

class FakeContextParamModule extends AbstractModule
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
        $this->bind(Reader::class)->to(AnnotationReader::class)->in(Scope::SINGLETON);
    }
}
