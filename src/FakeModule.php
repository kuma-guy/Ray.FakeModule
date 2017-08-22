<?php
/**
 * This file is part of the Ray.FakeModule package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeModule;

use Ray\Di\AbstractModule;
use Ray\FakeModule\Annotation\Fakeable;

class FakeModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bindInterceptor(
            $this->matcher->annotatedWith(Fakeable::class),
            $this->matcher->any(),
            [FakeInterceptor::class]
        );
    }
}
