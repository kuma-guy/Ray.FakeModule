# Ray.FakeModule

## Installation

### Composer install

WIP

### Module install

```php
use Ray\Di\AbstractModule;
use Ray\FakeModule\FakeModuleModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new FakeModuleModule);
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

WIP

### Requirements

 * PHP 5.4+
 * hhvm
