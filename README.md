# iTexmo

<!--
[![Latest Version on Packagist](https://img.shields.io/packagist/v/creatvstudio/itexmo.svg?style=flat-square)](https://packagist.org/packages/creatvstudio/itexmo)
[![Build Status](https://img.shields.io/travis/creatvstudio/itexmo/master.svg?style=flat-square)](https://travis-ci.org/creatvstudio/itexmo)
[![Quality Score](https://img.shields.io/scrutinizer/g/creatvstudio/itexmo.svg?style=flat-square)](https://scrutinizer-ci.com/g/creatvstudio/itexmo)
[![Total Downloads](https://img.shields.io/packagist/dt/creatvstudio/itexmo.svg?style=flat-square)](https://packagist.org/packages/creatvstudio/itexmo)
-->

iTexMo API client for PHP.

## Requirements

To use the client library you'll need to have created an iTexmo account.

## Installation

You can install the package via composer:

```bash
composer require creatvstudio/itexmo
```

## Usage

``` php
$itexmo = new Itexmo($apiCode);

// Send with our expressive API
$itexmo->to('09171234567')->content('Hello fellow humans!')->send();

// or just use a plain array
$itexmo->send([
    'to' => '09171234567',
    'content' => 'Hello fellow humans!',
]);

// Custom Sender ID
$itexmo->sender('MY-SENDER')->send();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jeff@creatvstudio.ph instead of using the issue tracker.

## Credits

- [Jeffrey Naval](https://github.com/creatvstudio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).