<?php
namespace FakeVendor\Sandbox;

use BEAR\Resource\Module\ResourceModule;
use Ray\Di\AbstractModule;
use Ray\FakeModule\FakeModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new ResourceModule('FakeVendor\Sandbox'));
        $this->install(new FakeModule);
    }
}