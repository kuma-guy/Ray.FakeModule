# Ray.FakeModule 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/shingo-kumagai/Ray.FakeModule/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/shingo-kumagai/Ray.FakeModule/?branch=master) [![Build Status](https://travis-ci.org/kuma-guy/Ray.FakeModule.svg?branch=1.x)](https://travis-ci.org/kuma-guy/Ray.FakeModule)

A TestDobule suite for Ray.Di DI framework

## Installation

### Composer install

    $ composer require ray/fake-module --dev
    
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

## Fake a class method


Annotate `@Fabkeable` annotation for the target. Then, 'Fake' prefixed class in same namespace will be called instead of original class.

Actual class

```php
namespace FakeVendor\Sandbox\Module;

use Ray\FakeModule\Annotation\FakeClass;

/**
 * @Fakeable
 */
class TestClass
{
    public function output() {
        return  "test class output";
    }
}
```

Fake class

```php
namespace FakeVendor\Sandbox\Module;

class FakeTestClass
{
    public function output() {
        return "fake class output";
    }
}
```

