# Dependency Injection for PHP
Library that provides ways to use DI for PHP developers.

## Install
Install the library like this `composer require fabs/di` 

## Quick Start

Set a service with lazy loading
```php
$di = DI::getDefault();

$di->set('function_example',function(){
    return new MyCustomService();
});
// or
$di->set('class_name_example', MyCustomService::class);
// or
$di->set('parameter_example',function($first,$second){
    return new MyCustomService($first, $second);
})->setParameters([1,'second']);

```

Set a service without lazy loading
```php
$di = DI::getDefault();

$di->set('test_service', new MyCustomService());
```

Set a shared service
```php
$di = DI::getDefault();

$di->setShared('test_service', new MyCustomService());
// or
$di->set('test_service', new MyCustomService(), true);
```

Get a service
```php
$di = DI::getDefault();

$service = $di->get('test_service');
// or
$service = $di['test_service'];
// or
$service = $di->get('parameter_example',[8,'example']);
```
