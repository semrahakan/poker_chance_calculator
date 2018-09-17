## TO RUN THE PROJECT

composer,laravel,mysql and PHP required. If your environment has not got these, please see the links below.

Before these please make sure you have 'homebrew' on your MAC environment. You can download from https://brew.sh/

install composer from https://getcomposer.org/download/

install mysql 'brew install mysql', 'brew tap homebrew/services', 'brew services start mysql', 'brew services list' and to check 'mysql -V' as explained from https://gist.github.com/nrollr/3f57fc15ded7dddddcc4e82fe137b58e

install laravel ' composer global require "laravel/installer" ' from https://laravel.com/docs/5.7
I used 'composer create-project --prefer-dist laravel/laravel poker_chance_calculator' to setup this project.

Replace the .env file with .env.example. We need to do this since .env file is under .gitignore. Laravel needs configuration files under .env file.

'php artisan migrate' run this command to populate database tables.
'php artisan serve' => this command produces Laravel development server started: <http://127.0.0.1:8000>
After this you will be abled to see the project on browser.

Environment Versions:
PHP 7.1.21 - Laravel Framework 5.7.3 - mySQL 5.7.23

## To RUN TEST 

vendor/bin/phpunit


<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

