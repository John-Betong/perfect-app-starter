# Perfect App CRUD Framework Starter
App starter for Perfect App CRUD Framework

#### Features

* User Registration
* User Login
* Forgot Password/Password Reset
* Secure Token Generator for Password Reset and Email Verification
* Admin: Add/Edit/View/Delete Users and set Roles
* Admin: View/Delete Error Log
* Admin: Theme Changer
* Admin: View User Logins data
* Admin: View Settings
Admin: Change Password

License: Proprietary - No Licence Granted

## Requirements

 * PHP Version <=7.4
* Apache2 with mod_rewrite enabled
* Composer
* HTTPS
* Ability to send/receive mail from PHP mail function - TODO: Include mail test script


## Initial Installation
1. Clone this repository to the project root of your new website. Must run from server root or subdomain, not from subdirectory
2. Run `composer install` to install Perfect App Framework source code dependency

## Basic website config
* Import SQL to MySQL Database
  * Open `/app/Core/Database/dbConfig.php`
  * Set Connection Parameters for your MySQL Server
  
  ```
  return [
            'charset' =>'utf8mb4'
          , 'dbname' =>'perfect-app-starter'
          , 'username' =>'root'
          , 'password' =>''
          , 'host' => 'localhost'
          //, 'connection'=>'mysql:host=127.0.0.1'
          , 'options'  =>[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
              , PDO::ATTR_EMULATE_PREPARES => false
          ]
  ];
  ```

* Open `config.php`
  * Set `'ADMIN_EMAIL_TO` to your Admin email address
  * Set you TimeZone in `date_default_timezone_set('America/Los_Angeles');`
  * Default is to not send error emails to admin. Change parameter to 1 to send them
  * Errors are logged by default to `/logs/error.log`. This file must be writable on Linux
  * To display debugging info set `DEBUG` to 1. This will show various data helpful for debugging


## To Run Locally Using PHP
From this directory, run the following command:
```
php -S localhost:8080 -t public
```

## Bootstrap and Document Root
Set the website document root to `/public`
* The central point of entry is `/public/index.php`
* There is a file `.htaccess` that controls URL rewriting
* If you are using *nginx* you will need to incorporate the same logic into your primary config file
* `/public/index.php` first loads the Composer auto-load file to load all the Classes and then the *bootstrap* file `/app/Core/bootstrap.php`
  * `bootstrap.php` starts a session, gathers required files and makes a PDO database connection
  * If you add your own classes be sure to update `composer.json` and refresh Composer autoloading:
```
composer dump-autoload
```


## Super Admin Login
* Username: user
* Password: pass

## Views (Templates)
Views are stored in `/resources/views`.

### Admin Layout
The overall website look-and-feel is in a single HTML file, by default in `/resources/views/layouts/layout-admin.php`.
* `layout-admin.php` brings together the Admin header, content, and footer & nav bar.
* The header,footer and nav bar and is in `/resources/views/partials/`

### Routing
The routes file is at `/app/routes/php`. 
* The format is `requestMethod(get or post)->UrlPath->ControllerPathAndName->ControllerMethod`
* Example: Add User form -  `yourdomain.com/add-user` 
* `$router->get('add-user', 'Admin\UsersController@create');`
* This example responds to a GET Request from /add-user and calls the Controller in `app/Http/Controllers/Admin/UsersController.php` and calls the `create` method which calls the view.

  * Last Revised 12-14-21