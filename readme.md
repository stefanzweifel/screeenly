<p align="center"><img width="295" src="https://raw.githubusercontent.com/stefanzweifel/screeenly/master/readme-image.png" alt=""></p>

<p align="center">
<a href="https://github.com/stefanzweifel/screeenly/actions?query=workflow%3ATests">
<img src="https://github.com/stefanzweifel/screeenly/workflows/Tests/badge.svg" alt="">
</a>
<a href="https://github.com/stefanzweifel/screeenly/blob/master/LICENSE" title="License">
    <img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="License">
</a>
<a href="https://github.com/stefanzweifel/screeenly/releases" title="Releases">
    <img src="https://img.shields.io/github/release/stefanzweifel/screeenly.svg?style=flat-square" alt="Releases">
</a>
</p>


screeenly is an open source web application which lets users create website screenshots through a simple API.
It's built with [Laravel](http://laravel.com).

The latest version is hosted on [screeenly.com](http://screeenly.com). You can follow us on [Twitter](https://twitter.com/screeenly)

---

☝️ A completely new version of screeenly has recently been released: [https://3.screeenly.com](https://3.screeenly.com).

The app has been rebuilt from the ground up. Its API now can also convert websites into PDFs, return the rendered HTML of a website. This now also works for your own provided HTML code. 
In addition, you can now update a lot more settings; like pixel density or wether images should be loaded.

**The new app requires a paid subscription. The subscription covers server costs and maintenance.**

The open source version of screeenly (this repo right here) which is hosted on [http://screeenly.com](http://screeenly.com) will remain available for the forseeable future. If anything should change and you've registered on screeenly.com, you will receive a notice. 

The repository runs on Laravel 13.

---

## Documentation and more

The [wiki](https://github.com/stefanzweifel/screeenly/wiki) holds the documentation.

- [API specification](https://github.com/stefanzweifel/screeenly/wiki/Use-the-API)
- [Read about the code structure](https://github.com/stefanzweifel/screeenly/wiki/Read-the-Code)


## Requirements

- PHP 8.5 or newer
- Composer 2
- Node.js 20 or newer, with `puppeteer` installed (`npm install`)
- A Chrome binary for Puppeteer: `npx puppeteer browsers install chrome-headless-shell`
- MySQL, PostgreSQL or SQLite

Run the tests with `vendor/bin/phpunit`.
Format the code with `composer format`.

If you build the frontend assets on Node.js 17 or newer, run `NODE_OPTIONS=--openssl-legacy-provider npm run prod`. The compiled assets are committed, so you only need this when you change `resources/js` or `resources/sass`.

## Upgrading from Laravel 8 (PHP 8.0)

1. Switch the server to PHP 8.5 or newer.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Run `npm install` and `npx puppeteer browsers install chrome-headless-shell`. Puppeteer 24 needs this separate download.
4. Update `.env`:
   - `CACHE_DRIVER` is now `CACHE_STORE`. The old name still works.
   - `FILESYSTEM_DRIVER` is now `FILESYSTEM_DISK`. The old name still works.
   - `MAIL_ENCRYPTION` is replaced by `MAIL_SCHEME`. Use `smtps` for implicit TLS (port 465). Leave it empty for STARTTLS (port 587).
   - `BROADCAST_DRIVER` is no longer used. Remove it.
5. Run `php artisan migrate --force`, then `php artisan optimize`.
6. Restart queue workers and PHP-FPM.

## Self Hosting

screeenly is quite a simple PHP app. Therefore, it's quite easy to self host the application on your own server.

### Self Hosting on your own Server

If you're comfortable running your own server follow your self-hosting guide [here](https://github.com/stefanzweifel/screeenly/wiki/Requirements-and-Install).


### Deploy to Zeet


[![Deploy](https://deploy.zeet.co/screeenly.svg)](https://deploy.zeet.co/?url=https://github.com/stefanzweifel/screeenly)

Otherwise, Zeet makes deploying Screeenly dead simple, just click the button above. [This guide](https://github.com/stefanzweifel/screeenly/wiki/Deploy-to-Heroku) will walk you through the configuration needed.


### Deploy to Heroku

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/stefanzweifel/screeenly/tree/master)


If managing servers is not your thing, we've also written [a guide](https://github.com/stefanzweifel/screeenly/wiki/Deploy-to-Heroku) on how to deploy the app to Heroku.   
By using Heroku, you can run your own version of screeenly basically for free. 

## Docker Images

If you're interested in a Docker version of screeenly, you can use the daily built images created by [Jacek Szafarkiewicz](https://github.com/hadogenes).

- [Dockerfile](https://gitlab.com/_hadogenes_/docker/screeenly)
- [Docker Image](https://hub.docker.com/r/hadogenes/screeenly)

**Please note**: We do not provide any support for these Docker Images.

# Security

If you discover a security vulnerability within this package, please e-mail us at stefan@stefanzweifel.dev. All security vulnerabilities will be promptly addressed.

# LICENSE

MIT
