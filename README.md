# [PROJECT TITLE]

[PROJECT BADGES]

[PROJECT ABSTRACT, Describe the purpose and intent]

### Aliases

In order to ease development, ensure you have following Aliases setup
```shell
alias sail="./vendor/bin/sail"
alias stan="./vendor/bin/phpstan"
alias phpunit="./vendor/bin/phpunit"
```

## Installation
Copy over `.env` file and populate it with your environment's variables. You will also want to verify/change a few variables for your environment.
```
cp -p .env.example .env
```

Install composer dependencies by running (this assumes you have a $GITHUB_TOKEN environment variable)

```shell
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    /bin/bash -c \
    "composer self-update; composer config --global github-oauth.github.com $GITHUB_TOKEN; composer install"
```
    

Run sail containers:
```shell
sail up -d
```

Generate the app key by running:
```shell
sail artisan key:generate
```

## Usage

### With Sail

[PROJECT TITLE] supports [Laravel Sail](https://laravel.com/docs/9.x/sail) as a local development environment.

To get started, simply run `sail up -d` and the application will be served on [`http://localhost`](http://localhost)

To run artisan commands, simply run `sail artisan migrate`

To run compose commands, simply run `sail composer install`

Stop the application by running `sail down`

[Read more about how to use Laravel Sail in the official documentation here](https://laravel.com/docs/8.x/sail)

## Documentation
You can access the API documentation at the `api/documentation` endpoint.

When you changes to the documentation you have to re-generate the documentation page using `php artisan l5-swagger:generate`

## Testing
You can find tests in the `/tests` folder, and you can run them by using `phpunit --testdox`.

If you need to quickly run the entire testsuite, just to ensure, that no test are failing, you can run them in parallel by running `php artisan test --parallel`

## Static analysis
You can run [Larastan](https://github.com/nunomaduro/larastan) (a wrapper for [PHPStan](https://phpstan.org/)), by executing `stan analyse`

## IDE Helpers
Laravel uses facades, so that implementations of, for instance, loggers can be changed without needing to change code, and models can be quite empty, because of the way Laravel uses magic methods and getters.

This, in turn, makes it hard for IDE's to assist in showing what classes contain.

To help with that, the composer package [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper) is installed as a dev-dependency.

This package will generate files for your IDE, to better understand what is contained in the Laravel classes and models.

**These files are excluded from the repository**

Generating the IDE helper files:
```
# Run the artisan commands:
$ php artisan ide-helper:eloquent
$ php artisan ide-helper:generate
$ php artisan ide-helper:meta
$ php artisan ide-helper:models --nowrite
# or run all of them with:
$ composer run ide-helper
```

## License
MIT
