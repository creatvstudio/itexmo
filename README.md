# iTexmo

[![Latest Stable Version](https://poser.pugx.org/creatvstudio/itexmo/v/stable)](https://packagist.org/packages/creatvstudio/itexmo)
[![Total Downloads](https://poser.pugx.org/creatvstudio/itexmo/downloads)](https://packagist.org/packages/creatvstudio/itexmo)
[![License](https://poser.pugx.org/creatvstudio/itexmo/license)](https://packagist.org/packages/creatvstudio/itexmo)

<!--
[![Build Status](https://img.shields.io/travis/creatvstudio/itexmo/master.svg?style=flat-square)](https://travis-ci.org/creatvstudio/itexmo)

[![Quality Score](https://img.shields.io/scrutinizer/g/creatvstudio/itexmo.svg?style=flat-square)](https://scrutinizer-ci.com/g/creatvstudio/itexmo)
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
use \CreatvStudio\Itexmo\Itexmo::class;

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

### Laravel

Add ItexmoServiceProvider to your config.

```php
# config/app.php

'providers' => [
    ...

    /*
     * Package Service Providers...
     */

    ...

    CreatvStudio\Itexmo\ItexmoServiceProvider::class,
]
```

Add your Itexmo credentials to `config/services.php` and `.env` file.

```php
# config/services.php

...

'ses' => [
    'key' => env('AWS_ACCESS_KEY_ID'),
    'secret' => env('AWS_SECRET_ACCESS_KEY'),
    'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
],

'itexmo' => [
    'code' => env('ITEXTMO_CODE'),
    'password' => env('ITEXMO_PASSWORD'),
    'sender_id' => env('ITEXMO_SENDER_ID'),
]
```

If you want to use the `Itexmo` Facade you can also add the alias to your config.

```php
# config/app.php

'aliases' => [
    ...

    'Itexmo' => CreatvStudio\Itexmo\Facades\Itexmo::class,

]
```

Now you can just use the Facade to send SMS. Your `API Code` and `API Password` will be automatically injected to the `Itexmo` object.

```php
Itexmo::to('09171234567')->content('Hello fellow humans!')->send();
```

### Dependency Injection

You can also use Laravel's dependecy injection to your controllers or commands.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CreatvStudio\Itexmo\Itexmo;

class SmsController extends Controller
{
    /**
     * Send an sms message
     *
     * @param  Request  $request
     * @param  Itexmo   $itexmo
     * @return Response
     */
    public function store(Request $request, Itexmo $itexmo)
    {
        $itexmo->to($request->to)
            ->content($request->content)
            ->send();

        //
    }
}
```

### Error Codes

| Command | Description |
| --- | --- |
| 1 | Invalid Number. |
| 2 | Number prefix not supported. Please contact us so we can add. |
| 3 | Invalid ApiCode. |
| 4 | Maximum Message per day reached. This will be reset every 12MN. |
| 5 | Maximum allowed characters for message reached. |
| 6 | System OFFLINE. |
| 7 | Expired ApiCode. |
| 8 | iTexMo Error. Please try again later. |
| 9 | Invalid Function Parameters. |
| 10 | Recipient's number is blocked due to FLOODING, message was  |ignored.
| 11 | Recipient's number is blocked temporarily due to HARD sending  |(after 3 retries of sending and message still failed to send) and the message was ignored.
| 12 | Invalid request. You can't set message priorities on non  |corporate apicodes.
| 13 | Invalid or Not Registered Custom Sender ID. |
| 14 | Invalid preferred server number. |
| 15 | IP Filtering enabled - Invalid IP. |
| 16 | Authentication error. Contact support at itexmo@yahoo.com |
| 17 | Telco Error. Contact Support itexmo@yahoo.com |
| 18 | Message Filtering Enabled. Contact Support itexmo@yahoo.com |

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