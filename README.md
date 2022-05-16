<h1 align="center">Docus Assignment</h1>

## About Assignment

This is a web application with user authentication and authorization based on roles and permissions and implemented on Laravel 8.

## How to run

`git clone <repository>`

`cd <new created directory>`

`composer install`

`php artisan breeze:install`

`open config/app.php file and add service provider and aliase`

```
'providers' => [

	....

	Spatie\Permission\PermissionServiceProvider::class,

],
```

`php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`

`php artisan migrate`

`open config/app.php file and add service provider and aliase`

`npm install`

`npm run dev`

##### You will need also run CLI commands for `permission,role,user` creation

##### Make sure you running commands in right order


## Custom CLI Commands

`1. php artisan create:permission`

`2. php artisan create:role`

`3. php artisan create:user`
