<?php

namespace Ray\FakeModule;

use Ray\Di\AbstractModule;

class TestModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(TestClass::class);
        $this->install(new FakeModule);
    }
}