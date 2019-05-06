# cakephp-manifest
[![LICENSE](https://img.shields.io/github/license/smartsolutionsitaly/cakephp-manifest.svg)](LICENSE)
[![packagist](https://img.shields.io/badge/packagist-smartsolutionsitaly%2Fcakephp--manifest-brightgreen.svg)](https://packagist.org/packages/smartsolutionsitaly/cakephp-manifest)
[![issues](https://img.shields.io/github/issues/smartsolutionsitaly/cakephp-manifest.svg)](https://github.com/smartsolutionsitaly/cakephp-manifest/issues)
[![CakePHP](https://img.shields.io/badge/CakePHP-3.6%2B-brightgreen.svg)](https://github.com/cakephp/cakephp)

Manifest support for [CakePHP](https://github.com/cakephp/cakephp)

## Installation

You can install _cakephp-manifest_ into your project using [Composer](https://getcomposer.org).

``` bash
composer require smartsolutionsitaly/cakephp-manifest
```

## Setup

You can load this plugin running following command in terminal:

``` bash
bin/cake plugin load SmartSolutionsItaly\CakePHP\Manifest -r
```

or editing your _config/bootstrap.php_ adding this line at the end of the file:

```php
Plugin::load('SmartSolutionsItaly\CakePHP\Manifest', ['routes' => true]);
```

## License
Licensed under The MIT License
For full copyright and license information, please see the [LICENSE](LICENSE)
Redistributions of files must retain the above copyright notice.

## Copyright
Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
