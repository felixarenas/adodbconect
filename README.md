# adodbconect
ADODBCONECT Facilitates the use of adodb php in laravel

## Install

Via Composer

``` bash
$ composer require felixarenas/adodbconect
```

## Providers

``` php
farenas\AdodbConect\Providers\AdodbConectServiceProvider::class,

'AdodbConect' => farenas\AdodbConect\Facades\AdodbConectFacade::class,
```

## Publish

``` php
php artisan vendor:publish --provider="farenas\AdodbConect\Providers\AdodbConectServiceProvider"
```

## Usage

``` php
use AdodbConect;

$paramAdoDb = [
    'cursor' => true,
    'plsql'  => 'PackageOracle.function_package(:codUser, :codCompany);',
    'datos'  => [
        'codUser' => 2222,
        'codCompany' => 6655
    ]
];

AdodbConect::param($paramAdoDb)->run();
```
