<?php declare(strict_types=1);

/* Page Routes */

$router->get('', 'Pages\PagesController@index');

$router->get('admin', 'Pages\PagesController@adminHome');
$router->get('about', 'Pages\PagesController@about');
$router->get('contact', 'Pages\PagesController@contact');

//----------------------------------------------------------------------------------------
//  Registration Routes
//----------------------------------------------------------------------------------------

$router->get('register', 'Auth\RegisterController@create');
$router->post('register', 'Auth\RegisterController@store');

//----------------------------------------------------------------------------------------
//  User Routes
//----------------------------------------------------------------------------------------

/* Add User */
$router->get('add-user', 'Admin\UsersController@create');
$router->post('add-user', 'Admin\UsersController@store');

/* Edit User */
$router->get('edit-user', 'Admin\UsersController@edit');
$router->post('edit-user', 'Admin\UsersController@update');

/* Delete User */
$router->get('delete-user', 'Admin\UsersController@destroy');

/* List Users */
$router->get('list-users', 'Admin\UsersController@index');

//----------------------------------------------------------------------------------------
//  Password Routes
//----------------------------------------------------------------------------------------

$router->get('forgot', 'Auth\ForgotPasswordController@create');
$router->POST('forgot', 'Auth\ForgotPasswordController@update');

$router->get('reset', 'Auth\ResetPasswordController@create');
$router->POST('reset', 'Auth\ResetPasswordController@update');

$router->get('change-password', 'Auth\ChangePasswordController@create');
$router->post('change-password', 'Auth\ChangePasswordController@update');

$router->get('activate', 'Auth\ActivationController@activate');

//----------------------------------------------------------------------------------------
// Authentication Routes...
//----------------------------------------------------------------------------------------

$router->get('login', 'Auth\LoginController@showlogin');
$router->post('login', 'Auth\LoginController@dologin');
$router->get('logout', 'Auth\LoginController@logout');

//----------------------------------------------------------------------------------------
//  Admin Routes
//----------------------------------------------------------------------------------------

$router->get('dashboard', 'Pages\PagesController@dashboard');
$router->get('settings', 'Pages\PagesController@settings');
$router->get('errors', 'Pages\PagesController@errors');
$router->get('list-logins', 'Admin\ListLoginsController@index');

//----------------------------------------------------------------------------------------
// API Routes
//----------------------------------------------------------------------------------------

$router->get('v1', 'ApiUsers@index');



