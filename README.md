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
Annotate target resource, which you want to fake, with `@FakeResource` annotation. Then, 'Fake' prefixed resource in same namespace will be called via interceptor when original resource method called.

*this feature heavily depends on BEAR.Resource [https://github.com/bearsunday/BEAR.Resource]*

Real resource
```php
namespace FakeVendor\Sandbox\Resource\App;

use BEAR\Resource\ResourceObject;
use Ray\FakeModule\Annotation\FakeResource;

/**
 * @FakeResource
 */
class User extends ResourceObject
{
    public function onGet($id)
    {
        // ...
    }
}
```

Fake resource
```php
namespace FakeVendor\Sandbox\Resource\App;

use BEAR\Resource\ResourceObject;

class FakeUser extends ResourceObject
{
    public function onGet($id)
    {
        // ...
    }
}
```

### Fake a class method.

@FakeClass annotation work as same as @FakeResource.

Real class.

```php
namespace FakeVendor\Sandbox\Module;

use Ray\FakeModule\Annotation\FakeClass;

/**
 * @FakeClass
 */
class TestClass
{
    public function output() {
        return  "test class output";
    }
}
```

Fake class.

```php
namespace FakeVendor\Sandbox\Module;

class FakeTestClass
{
    public function output() {
        return "fake class output";
    }
}
```

### Requirements

 * PHP 5.5+
 * hhvm
