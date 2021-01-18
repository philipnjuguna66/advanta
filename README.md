# ADVANTA AFRICA SMS PHP SDK

[![Latest Stable Version](https://img.shields.io/packagist/v/philipnjuguna/advanta)](https://packagist.org/packages/philipnjuguna/advanta)

> This SDK provides convenient access to the Africa's Talking API for applications written in PHP.

## Documentation
Take a look at the [API docs here](https://www.advantasms.com/bulksms-api).

## Install

You can install the PHP SDK via composer or by downloading the source

#### Via Composer

The recommended way to install the SDK is with [Composer](http://getcomposer.org/).

```bash
composer require philipnjuguna/advanta
```

Configuration
At your project root, create a .env file and in it set the consumer key and consumer secret as follows
ADVANTA_PARTNER_ID=
ADVANTA_API_KEY=
ADVANTA_SHORT_CODE=

For Laravel users, open the Config/App.php file and add \PhilipNjuguna\Advanta\AdvantaFacade::class under providers and 'Advanta'=> \PhilipNjuguna\Advanta\AdvantaServiceProvider::class under aliases.

## Usage

The SDK needs to be instantiated using your username and API key, which you can get from the [dashboard](https://www.advantasms.com/bulksms-api).

```php
use PhilipNjuguna\Advanta\AdvantaSMS;

$advanta       = (new AdvantaSMS())->sendMessage($mobile, $message);


// Use the service
$result   =  (new AdvantaSMS())->sendMessage('2XXYYYOOO',"message");

// Use the service for laravel
$result   =  \PhilipNjuguna\Advanta\AdvantaFacade::sendMessage([
    'to'      => '+2XXYYYOOO',
    'message' => 'Hello World!'
]);



print_r($result);
```


## Issues

If you find a bug, please file an issue on [our issue tracker on GitHub](https://github.com/philipnjuguna66/advnata/issues).
