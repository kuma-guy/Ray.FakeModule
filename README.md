# Ray.FakeModule

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

Annotate target method of resource object with `@FakeResource` annotation.

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
```

### Fake a class method.

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

 * PHP 5.4+
 * hhvm
