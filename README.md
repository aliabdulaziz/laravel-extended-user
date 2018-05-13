# laravel-extended-user
This Laravel package adds profile page, account page, and extra features to Laravel's built-in Auth system

## Requirements
- Bootstrap 4
- Laravel 5.3+



## Screenshots
![Profile page](https://raw.githubusercontent.com/Aliabdulaziz/laravel-extended-user/master/screenshots/01.PNG "Profile Page (/profile)")

![Account page](https://raw.githubusercontent.com/Aliabdulaziz/laravel-extended-user/master/screenshots/02.PNG "Profile Page (/account)")

![Delete account page](https://raw.githubusercontent.com/Aliabdulaziz/laravel-extended-user/master/screenshots/03.PNG "Profile Page (/account/delete)")



## Installation

> It is recommended to install this package in a fresh installation of Laravel.

### Laravel's built-in Auth System

This package is integrated with Laravel's built-in Auth System, 
so you must first run this command if you have not run it yet:

```shell
php artisan make:auth
```
Now go to your (env) file and make sure that you have selected your database. 

### Install the package using composer

Now install the package using composer by running the following command:

```shell
composer require aliabdulaziz/laravel-extended-user
```

### Add the service provider (for Laravel < 5.5)

Go to: (Your Laravel App) --> config --> app.php

and add the following line under 'Package Service Providers' comment:

```php
Aliabdulaziz\LaravelExtendedUser\LaravelExtendedUserServiceProvider::class
```

### Publish the config file

Run the following command to publish the package config file:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelExtendedUser\LaravelExtendedUserServiceProvider" --tag=config
```

The config file is named (laravelextendeduser.php) and will be located in the 'config' folder.


### Publish the assets (CSS and JS files)

Run the following command to publish the package assets:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelExtendedUser\LaravelExtendedUserServiceProvider" --tag=assets
```

### Migrate

Run the artisan migrate command to create the users table:

> this command will also migrate the package migration file by which the profile field is added to the users table.

```shell
php artisan migrate
```

### Create the symbolic link

The following command will create a symbolic link from 'public/storage' to  'storage/app/public'.
This is neccessary to access the user profile image (avatar).

```shell
php artisan storage:link
```

## Access 'Profile' and 'Account' pages

Now you can access the 'profile' and the 'account' pages by visiting the following routes:

- /profile
- /account



## Customization

To customize the package default views publish them to your views folder by running the following command:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelExtendedUser\LaravelExtendedUserServiceProvider" --tag=views
```

Now make whatever customization you want on the published views.

> you can also publish the assets source files (sass and js files) by running the following command:

```shell
php artisan vendor:publish --provider="Aliabdulaziz\LaravelExtendedUser\LaravelExtendedUserServiceProvider" --tag=src
```

these files will be located in (Your Laravel app) --> resources --> assets --> vendor --> laravelextendeduser.

