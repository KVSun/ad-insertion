[issues]: [https://github.com/KVSun/ad-insertion/issues/]
[dev-email]: [mailto:editor@kvsun.com]
[gitter]: [https://gitter.im/KVSun/ad-insertion]
[travis-ci]: [https://travis-ci.org/KVSun/ad-insertion]
[gitter-icon]: [https://badges.gitter.im/KVSun/ad-insertion.svg]
# ad-insertion
[![Build Status](https://travis-ci.org/KVSun/ad-insertion.svg?branch=master)][travis-ci]
[![Gitter](https://badges.gitter.im/KVSun/ad-insertion.svg)][gitter]
- - -
## Contributing
Write access to the GitHub repository is restricted, so make a fork and clone that. All work should be done on its own branch, named according to the issue number (*e.g. `42` or `bug/23`*). When you are finished with your work, push your feature branch to your fork, preserving branch name (*not to master*), and create a pull request.

This project uses several submodules, so please be sure to keep everything updated and not make changes to any submodules (*unless you are contributing directly to those projects*).

**Update using:**

- `git pull upstream master`  
- `git submodule update --init --recursive`

**Bundle/package/minify resources using:**

- **JavaScript** - `webpack`
- **CSS** - `myth stylesheets/styles/import.css -c stylesheets/styles/styles.css`

## Contact
- [Issues][issues]
- [Chat][gitter]
- [Email][dev-email]

## PHP developer notes
> This project uses PHP's native [autoloader](https://secure.php.net/manual/en/function.spl-autoload.php), which is configured via `.travis.yml` and `.htaccess` environment variables. Apache will automatically include the autoloader script using `php_value auto_prepend_file`, but since this uses relative paths, it will only work correctly in the project's root directory. To use in other directories, place a `.htacces` and set the relative path accordingly.

## JavaScript developer notes
> Due to Content-Security-Policy, use of `eval` and inline scripts are **prohibited** Further, this project uses ECMAScript 2015  [modules](http://www.2ality.com/2014/09/es6-modules-final.html), so be sure to familiarize yourself with the syntax.
![Code sample](https://i.imgur.com/7YLOJ8n.png)

## Git submodules
- [shgysk8zer0/core_api](https://github.com/shgysk8zer0/core_api/)
- [shgysk8zer0/core](https://github.com/shgysk8zer0/core/)
- [shgysk8zer0/dom](https://github.com/shgysk8zer0/dom/)
- [shgysk8zer0/std-js](https://github.com/shgysk8zer0/std-js/)
- [shgysk8zer0/core-css](https://github.com/shgysk8zer0/core-css/)
- [shgysk8zer0/fonts](https://github.com/shgysk8zer0/fonts/)
- [shgysk8zer0/svg-icons](https://github.com/shgysk8zer0/svg-icons/)
- [shgysk8zer0/logos](https://github.com/shgysk8zer0/logos/)
- [github/octicons](https://github.com/github/octicons/)
- [necolas/normalize.css](https://github.com/necolas/normalize.css/)

## Dev dependencies
- [Myth](http://www.myth.io/)
- [Babel](https://babeljs.io/)
- [Webpack](https://webpack.github.io/)
- [ESLint](http://eslint.org/)

```
npm install "myth" "babel-loader" "babel-core" "babel-preset-es2015" "webpack" "eslint"
```
