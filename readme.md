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

The repository itself will soon get updates for Laravel 7 and Laravel 8.

---

## Documentation and more

The [wiki](https://github.com/stefanzweifel/screeenly/wiki) holds the documentation.

- [API specification](https://github.com/stefanzweifel/screeenly/wiki/Use-the-API)
- [Read about the code structure](https://github.com/stefanzweifel/screeenly/wiki/Read-the-Code)


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

If you discover a security vulnerability within this package, please e-mail us at hello@stefanzweifel.io. All security vulnerabilities will be promptly addressed.

# LICENSE

MIT
