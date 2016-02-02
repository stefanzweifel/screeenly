# Screeenly - Screenshot as a service

[![Build Status](https://travis-ci.org/stefanzweifel/screeenly.svg?branch=master)](https://travis-ci.org/stefanzweifel/screeenly)
[![Code Climate](https://codeclimate.com/github/stefanzweifel/screeenly/badges/gpa.svg)](https://codeclimate.com/github/stefanzweifel/screeenly)
[![Test Coverage](https://codeclimate.com/github/stefanzweifel/screeenly/badges/coverage.svg)](https://codeclimate.com/github/stefanzweifel/screeenly/coverage)

![Screeenly Logo](https://raw.githubusercontent.com/stefanzweifel/screeenly/master/readme-image.png)

Screeenly is an Open Source Webapp which lets you create screenshots from websites through a simple intuitive API. Screeenly was built with [Laravel](http://laravel.com), a PHP framework. This is a sideproject and is maintained by [stefanzweifel](http://stefanzweifel.io).

You can checkout the live site at [http://screeenly.com](http://screeenly.com), read the [documentation](https://github.com/stefanzweifel/screeenly/wiki) or follow us on [Twitter](http://twitter.com/screeenly).

## Features and "Things to know"

- Create screenshots through JSON API with a valid API key
- Screenshots are stored 1 hour
- Screenshot is returned as a path or as base64 encoded string

If you're a PHP Developer and want to use our API in your project, checkout [screeenly-client](https://github.com/stefanzweifel/ScreeenlyClient) for more information.

## Note from the author

Screeenly is a never ending sideproject. I use it to apply learned PHP patterns and to try out new things. If you're reading through the code, you might think that some parts are "overengineered" or "too complicated". If you think something is bad designed or should be improved, please **[let me know](http://github.com/stefanzweifel/screeenly/issues/new)**.

## Run Screeenly on your local machine

*I highly recommend [Homestead](http://github.com/laravel/homestead) for your local PHP / Laravel environment!*
Your environment must fullfill the following requirements:

- PHP: 5.6 or higher
- Composer must be installed
- MySQL must be installed
- CURL must be installed
- node.js must be installed
- Gulp.js must be installed

Clone the project:

```
$ git clone https://github.com/stefanzweifel/screeenly.git && cd screeenly
```

Copy the environment file:

```
$ cp .env.example .env
```

Install PHP dependencies:

```
$ composer install --dev
```

Install node dependencies:

```
$ sudo npm install
```

### CSS and Javascript asset management

Screeenly uses [Laravel Elixir](http://github.com/laravel/elixir) to manage CSS and Javascript assets. We use [basscss](http://basscss.com) as our CSS-Toolkit. Checkout our [gulpfile.js](https://github.com/stefanzweifel/screeenly/blob/master/gulpfile.js) for more information

Local development (auto-compile everything when files chagne):

```
$ gulp watch
```

Get ready for production:

```
$ gulp --production
```

# LICENSE

MIT
