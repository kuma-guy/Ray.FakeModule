<?php
namespace FakeVendor\Sandbox;
use BEAR\Resource\Module\HalModule;
use BEAR\Resource\Module\ResourceModule;
use Ray\Di\AbstractModule;
use Ray\FakeContextParam\FakeContextParamModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new FakeContextParamModule());
        $this->install(new ResourceModule('FakeVendor\Sandbox'));
        $this->install(new HalModule());
    }
}