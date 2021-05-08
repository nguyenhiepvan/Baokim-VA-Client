# Installation

Add the following into your config part of your composer.json file:

```json
"repositories": [
{
"type": "vcs",
"url": "git@gitlab.com:colombo-group/baokim-va-client.git"
}
```

`baokim-va-client` may be installed via the Composer package manager:
```shell
composer require nguyenhiep/baokim-va-client
```

# Configuration

To configure the package you need to publish settings first:

```shell
php artisan vendor:publish --provider="Nguyenhiep\BaoKimVaClient\BaoKimVaClientServiceProvider"
```

# Reference

- [baokim va document](https://thuchiho.baokim.vn/docs/api#introduction)
- [Laravel package tools](https://github.com/spatie/laravel-package-tools)
