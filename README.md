# adodbconect
ADODBCONECT Facilitates the use of adodb php in laravel

- [README.md](README.md)
- [CHANGELOG.md](CHANGELOG.md)
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
    Yajra\Oci8\Oci8ServiceProvider::class,
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

php artisan vendor:publish --tag=oracle
```

## Config

This will copy the configuration file to ``` php config/oracle.php ```

``` php
return [
    'oracle' => [
        'driver'         => config('dbConfig.DB_DRIVER'),
        'tns'            => config('dbConfig.DB_TNS'),
        'host'           => config('dbConfig.DB_HOST'),
        'port'           => config('dbConfig.DB_PORT'),
        'database'       => config('dbConfig.DB_DATABASE'),
        'username'       => config('dbConfig.DB_USERNAME'),
        'password'       => config('dbConfig.DB_PASSWORD'),
        'charset'        => config('dbConfig.DB_CHARSET'),
        'prefix'         => config('dbConfig.DB_PREFIX'),
        'prefix_schema'  => config('dbConfig.DB_SCHEMA_PREFIX'),
        'server_version' => config('dbConfig.DB_SERVER_VERSION'),
    ],
];
```

and copy the configuration file to ``` php config/dbConfig.php ```

``` php
return [
    'DB_DRIVER' => 'oracle',
    'DB_CONNECTION' => 'oracle',
    'DB_HOST' => 'localhost',
    'DB_PORT' => '1070',
    'DB_DATABASE' => 'name_db',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => 'password',
    'DB_TNS' => 'tns_names',
    'DB_CHARSET' => 'AL32UTF8',
    'DB_PREFIX' => '',
    'DB_SCHEMA_PREFIX' => '',
    'DB_SERVER_VERSION' => '11g',
    'STRIP_TAGS' => true,
    'EXCEP_TAGS' => '', //'<p><a><h1>'
];
```

``` php
php artisan vendor:publish --provider="farenas\AdodbConect\Providers\AdodbConectServiceProvider"

php artisan vendor:publish --tag=oracle
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