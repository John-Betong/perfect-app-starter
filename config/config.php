<?php declare(strict_types=1);
/**
 * Application Configuration
 *
 * @version 3.0.0
 * @author Kevin Rubio
 * @copyright 2019 Galaxy Internet
 *
 * @license Proprietary - No Licence Granted
 *
 * @see http://galaxyinternet.us
 *
 */

//----------------------------------------------------------------------------------------
// Set LOCALHOST 
//----------------------------------------------------------------------------------------
define('LOCALHOST', 'localhost'===$_SERVER['SERVER_NAME']);

//----------------------------------------------------------------------------------------
// Set App Name & Admin Email
//----------------------------------------------------------------------------------------

define('APP_NAME', 'Perfect App Starter - JB - modifications');
define('VERSION', 'v.3.0');

define('ADMIN_EMAIL_TO',   'ajrutherford@gmail.com');
define('ADMIN_EMAIL_FROM', 'john.betong@gmail.com');

//----------------------------------------------------------------------------------------
// Application Url
//----------------------------------------------------------------------------------------

define('APPLICATION_URL', "https://{$_SERVER['HTTP_HOST']}");

//----------------------------------------------------------------------------------------
// Database
//----------------------------------------------------------------------------------------

define('DB_CONNECTION', 'dev-mysql'); // dev-mysql or prod-mysql

//----------------------------------------------------------------------------------------
// Dates & Times
//----------------------------------------------------------------------------------------

date_default_timezone_set('Asia/Bangkok');

// MySQL Datetime. Format: 2010-07-15 16:33:56
define('MYSQL_DATETIME_TODAY', date('Y-m-d H:i:s'));

//----------------------------------------------------------------------------------------
// Errors
//----------------------------------------------------------------------------------------

define('EMAIL_ERROR', 0); // Email errors to ADMIN_EMAIL_TO
define('LOG_ERROR', 1); // Log errors to file

//----------------------------------------------------------------------------------------
// Main Logo
//----------------------------------------------------------------------------------------

define('IMAGE_FILENAME', 'logo.png');
define('IMAGE_WIDTH',   320);
define('IMAGE_HEIGHT',  220);
define('IMAGE_ALT', APP_NAME);

//----------------------------------------------------------------------------------------
// Debugging
//----------------------------------------------------------------------------------------

define('DEBUG', 1); // Toggle Debugging
define('SHOW_DEBUG_PARAMS', DEBUG); // Display Sql & Sql Parameters
define('SHOW_SESSION_DATA', DEBUG); // Display Session Data
define('SHOW_POST_DATA',    DEBUG); // Display Post Data
define('SHOW_GET_DATA',     DEBUG); // Display Get Data
define('SHOW_COOKIE_DATA',  0); // Display Cookie Data
define('SHOW_REQUEST_DATA', 0); // Display Request Data

//----------------------------------------------------------------------------------------
// Actions
//----------------------------------------------------------------------------------------

define('ACTIONS_ARRAY',
    [
        'insert' => ['status' => 'success', 'message' => 'Record Inserted']
        //TODO:  , 'admin-error' => ['status' => 'danger', 'message' => 'Cannot Delete Super Admin']
        , 'user-delete-error' => ['status' => 'danger', 'message' => 'You cannot delete user you are logged in as.']
        , 'update' => ['status' => 'success', 'message' => 'Record Updated']
        , 'delete' => ['status' => 'success', 'message' => 'Record Deleted']
        , 'reset' => ['status' => 'success', 'message' => 'Your password has been reset.']
        , 'logout' => ['status' => 'success', 'message' => 'You have been successfully logged out.']
        , 'confirm' => ['status' => 'success', 'message' => 'Email confirmation instructions have been sent. Check your spam folder.']
        , 'noconfirm' => ['status' => 'danger', 'message' => 'Email has not been confirmed.']
        , 'verified' => ['status' => 'success', 'message' => 'Your email has been verified. You may login now.']
        , 'registered' => ['status' => 'success', 'message' => 'Email sent with instructions to confirm your email.']
        , 'reset_sent' => ['status' => 'info', 'message' => 'If your email is in our system you will receive reset instructions.']
        , 'failed_login' => ['status' => 'danger', 'message' => 'Invalid Login']
        , 'inactive' => ['status' => 'danger', 'message' => 'Inactive Account']
        , 'failed_reset' => ['status' => 'danger', 'message' => 'Password Reset Failed']
        , 'failed_confirmation' => ['status' => 'danger', 'message' => 'Invalid/Expired Token']
    ]
);

//----------------------------------------------------------------------------------------
//  DO NOT EDIT BELOW HERE
//----------------------------------------------------------------------------------------

if (version_compare(PHP_VERSION, '7.4') < 0)
{
    die('Your PHP version must be 7.4 or higher. Your version: ' . phpversion());
}

//----------------------------------------------------------------------------------------
// Required files
//----------------------------------------------------------------------------------------

define('BASEDIR', dirname(__DIR__));

require BASEDIR . '/app/actions/actions.php';
# require BASEDIR . '/app/debug/debug.php';

//----------------------------------------------------------------------------------------
// Path To error log
//----------------------------------------------------------------------------------------

define('ERROR_LOG_PATH', BASEDIR . '/logs/error.log');

//----------------------------------------------------------------------------------------
// Custom exception handler function (functions.php)
//----------------------------------------------------------------------------------------

set_exception_handler('custom_exception');
