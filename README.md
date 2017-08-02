# MakerFaire SG 2017 - Swipe To Send

## Requirements
- [Node.js](https://nodejs.org/) >= 4.2.6
- [Yarn](https://yarnpkg.com/)

## Installation
- Clone this repo.
- Go into the application root directory.
- Run `yarn install` to install client-side dependencies such as Javascript, CSS and NodeJS libraries.
- Copy `public/js/config.js.dist` to `public/js/config.js` and update values accordingly.
- Run `sudo chmod 0700 .git` to prevent its access via the web.
- Run `nohup node server.js &` in terminal. `nohup` ensures that the script continues to run after you exit the shell. The `&` will run it in the background and return the user to the prompt. Output and errors will be sent to `nohup.out` in the same directory.
- Run `index.html` in browser. To debug, check console output in browser.
