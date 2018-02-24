# adodbconect
ADODBCONECT Facilitates the use of adodb php in laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** ```Felix Arenas Lourido``` ```felixarenas7@gmail.com``` ```felixarenas``` ```adodbconect ``` ```Facilitates the use of adodb php in laravel``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

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

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Felix Arenas Lourido][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.