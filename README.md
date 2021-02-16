# ADVANTA AFRICA SMS PHP SDK

[![Latest Stable Version](https://img.shields.io/packagist/v/philipnjuguna/advanta)](https://packagist.org/packages/philipnjuguna/advanta)
<a href="https://packagist.org/packages/philipnjuguna/advanta"><img src="https://img.shields.io/github/issues/philipnjuguna66/advanta" alt="Total Downloads"></a>
[![Total Downloads](https://img.shields.io/packagist/dt/philipnjuguna/advanta.svg?style=flat-square)](https://packagist.org/packages/philipnjuguna/advanta)
<a href="https://packagist.org/packages/philipnjuguna/advanta"><img src="https://img.shields.io/packagist/dt/philipnjuguna/advanta?color=green" alt="Total Downloads"></a>

> This SDK provides convenient access to the Advanta Africa sms API for applications written in PHP.

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
At your project root, create a .env file and in it set the PARTNER ID , API KEY and SHORT CODE as follows
```.dotenv
ADVANTA_PARTNER_ID=
ADVANTA_API_KEY=
ADVANTA_SHORT_CODE=
```

## Usage

The SDK needs to be instantiated using API key, which you can get from the [dashboard](https://www.advantasms.com/bulksms-api).

```php
use PhilipNjuguna\Advanta\AdvantaSMS;

$advanta       = (new AdvantaSMS())->sendMessage($mobile, $message);


// Use the service
$result   =  (new AdvantaSMS())->sendMessage('2XXYYYOOO',"message");

// Use the service for laravel
$result   =  \PhilipNjuguna\Advanta\AdvantaFacade::sendMessage("254700123456","message");


// For scheduled message add time as the third variable
$result   =  \PhilipNjuguna\Advanta\AdvantaFacade::sendMessage("254700123456","message", \Carbon\Carbon::now()->addRealMinutes(10));





print_r($result);
```

## Delivery Report

To read delivery report for a sent message use;
```php
(new AdvantaSMS())->getDelivery("Message id");
```
### Result
```json
{
"response-code": 200,
"message-id": "89999",
"response-description": "Success",
"delivery-status": 32,
"delivery-description": "DeliveredToTerminal",
"delivery-tat": "6s",
"delivery-networkid": 1,
"delivery-time": "2020-02-16 10:15:13"
}
```
## Balance Report

To read delivery report for a sent message use;
```php
(new AdvantaSMS())->getBalance();
```
### Result
```json
{
  "response-code": 200,
  "credit": "800.00",
  "partner-id": "XXXX"
}
```

## Issues

If you find a bug, please file an issue on [our issue tracker on GitHub](https://github.com/philipnjuguna66/advnata/issues).
