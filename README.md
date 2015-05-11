# Ray.FakeModule 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/shingo-kumagai/Ray.FakeModule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/shingo-kumagai/Ray.FakeModule/?branch=master) [![Build Status](https://travis-ci.org/shingo-kumagai/Ray.FakeModule.svg)](https://travis-ci.org/shingo-kumagai/Ray.FakeModule)

## Installation

### Composer install

    $ composer require ray/fake-module
    
### Module install

```php
use Ray\Di\AbstractModule;
use Ray\FakeModule\FakeModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new FakeModule);
    }
}
```
### Usage


### Fake a resource uri.

@FakeResource annotation fake uri for building mock feature.
Annotate target method, which you want to fake, with `@FakeResource` annotation and specify fake uri as shown below.

*this feature heavily depends on BEAR.Resource [https://github.com/bearsunday/BEAR.Resource]*

```php
use Ray\FakeModule\Annotation\FakeResource;

class User
{
    /**
     * @FakeResource(uri="app://self/fake/user")
     */
    public function onGet($id)
    {
        // ...
    }
}
```

### Fake a class method.

@FakeClass annotation will be used to specify fake class that you want to proceed instead of real class

Real class.

```php
namespace FakeVendor\Sandbox\Module;

use Ray\FakeModule\Annotation\FakeClass;
use Ray\FakeModule\Annotation\FakeMethod;

/**
 * @FakeClass(class="Fake\TestClass")
 */
class TestClass 
{
    /**
     * @FakeMethod
     */
    public function output() {
        return  "test class output";
    }
}
```

Fake class.

```php
namespace FakeVendor\Sandbox\Module\Fake;
class TestClass 
{
    public function output() {
        return "fake class output";
    }
}
```

### Requirements

 * PHP 5.5+
 * hhvm
