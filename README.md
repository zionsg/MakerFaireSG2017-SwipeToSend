# MakerFaire SG 2017 - Swipe To Send

## Requirements
- PHP >= 7.0
- [Node.js](https://nodejs.org/) >= 4.2.6
- [Composer](https://getcomposer.org/)
- [Yarn](https://yarnpkg.com/)

## Installation
- Clone this repo.
- Run `composer install` to install PHP dependencies.
- Run `yarn install` to install client-side dependencies such as Javascript and CSS libraries.
- Copy `config/autoload/local.php.dist` to `config/autoload/local.php` and update values accordingly.
- Run `node server.js &` in terminal. The `&` will run it in the background and return the user to the prompt.
- Run `index.html` in browser. To debug, check console output in browser.
