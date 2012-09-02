Acne
====

Acne is simple DI Container for PHP < 5.2

Heavily inspired by [fabpot/Pimple](https://github.com/fabpot/Pimple)

Usage
-----

### Defining parameters

You can use `Acne_Container` like an associative array.

Just set  value with key.

```php
<?php
$container = new Acne_Container;

$container['session.cookie_name'] = 'PHPSESSID';
```

### Defining service providers

Service provider is factory which constructs an object.

`Closure` can be a service provider and it is the most prefferable way for PHP >= 5.3

```php
<?php
$container['session'] = function ($c) {
    return new Session($c['session.cookie_name']);
};
$container['session.cookie_name'] = 'PHPSESSID';

```

But if you're using PHP < 5.3, you can't use `Closure`.

This is why I create `Acne`.

Also the other `callable` values can be set as service provider.  
But notice that `string` can't be a service provider.

```php
<?php
class ServiceProviderCollection
{
    public function provideSession($c)
    {
        return new Session($c['session.cookie_name']);
    }
}

$providerCollection = new ServiceProviderCollection;

$container['session'] = array($providerCollection, 'provideSession');
$container['session.cookie_name'] = 'PHPSESSID';
```

### Getting object from container

After you defined service provider, you can get object which the provider constructed.

```php
<?php
$session = $container['session'];
$name = $session->get('name');
```

### Defining shared service providers

If you want to share objects like Singleton pattern, you can use shared service provider.

Shared service provider constructs object only once.

```php
<?php
$container->share('session', function ($c) {
    return new Session($c['session.cookie_name']);
});
```

Pimple-like way is also available.

```php
$container['session'] = $container->share(function ($c) {
    return new Session($c['session.cookie_name']);
});
```

Author
------

Yuya Takeyama
