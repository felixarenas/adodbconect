# adodbconect
ADODBCONECT Facilitates the use of adodb php in laravel

- [README.md](README.md)
- [CHANGELOG.md](CHANGELOG.md)
- [CONTRIBUTING.md](CONTRIBUTING.md)
- [LICENSE.md](LICENSE.md)
- [composer.json](composer.json) 

## Install

Via Composer

``` bash
$ composer require felixarenas/adodbconect
```

## Providers

``` php
'providers' => [
    farenas\AdodbConect\Providers\AdodbConectServiceProvider::class,
]
```

## Aliases

``` php
'aliases' => [
    'AdodbConect' => farenas\AdodbConect\Facades\AdodbConectFacade::class,
]
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

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email felixarenas7@gmail.com instead of using the issue tracker.

## Credits

- [Felix Arenas Lourido]
- [All Contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.