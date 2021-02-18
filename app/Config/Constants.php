<?php
//--------------------------------------------------------------------
// App Namespace
//--------------------------------------------------------------------
// This defines the default Namespace that is used throughout
// CodeIgniter to refer to the Application directory. Change
// this constant to change the namespace that all application
// classes should use.
//
// NOTE: changing this will require manually modifying the
// existing namespaces of App\* namespaced-classes.
//
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
|--------------------------------------------------------------------------
| Composer Path
|--------------------------------------------------------------------------
|
| The path that Composer's autoload file is expected to live. By default,
| the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
|--------------------------------------------------------------------------
| Timing Constants
|--------------------------------------------------------------------------
|
| Provide simple ways to work with the myriad of PHP functions that
| require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR') || define('HOUR', 3600);
defined('DAY') || define('DAY', 86400);
defined('WEEK') || define('WEEK', 604800);
defined('MONTH') || define('MONTH', 2592000);
defined('YEAR') || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
 */
defined('EXIT_SUCCESS') || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| API Version
|--------------------------------------------------------------------------
 */
defined('API_VERSION') || define('API_VERSION', 1);
defined('API_PATH') || define('API_PATH', 'api/v' . API_VERSION);

/*
|--------------------------------------------------------------------------
| USER STATUS
|--------------------------------------------------------------------------
 */
defined('USER_INACTIVE') || define('USER_INACTIVE', 1);
defined('USER_ACTIVE') || define('USER_ACTIVE', 2);
defined('USER_SUSPEND') || define('USER_SUSPEND', 3);

/*
|--------------------------------------------------------------------------
| IMAGE SIZE
|--------------------------------------------------------------------------
 */
defined('UPLOAD_IMAGE_SIZE') || define('UPLOAD_IMAGE_SIZE', 2);

/*
|--------------------------------------------------------------------------
| ITEM LOAD
|--------------------------------------------------------------------------
 */
defined('QUERY_LIMIT') || define('QUERY_LIMIT', null);
defined('QUERY_OFFSET') || define('QUERY_OFFSET', 0);

/*
|--------------------------------------------------------------------------
| PAYMENT CHANNEL
|--------------------------------------------------------------------------
 */
defined('CHILLPAY') || define('CHILLPAY', "CHILLPAY");
defined('MPAY') || define('MPAY', "MPAY");

/*
|--------------------------------------------------------------------------
| ORDER STATUS
|--------------------------------------------------------------------------
 */
defined('ORDER_SUCCESS') || define('ORDER_SUCCESS', 0);
defined('ORDER_FAILED') || define('ORDER_FAILED', 1);
defined('ORDER_CANCEL') || define('ORDER_CANCEL', 2);
defined('ORDER_PENDING') || define('ORDER_PENDING', 9);

/*
|--------------------------------------------------------------------------
| CHILLPAY PAYMENT STATUS
|--------------------------------------------------------------------------
 */
defined('CHILLPAY_SUCCESS') || define('CHILLPAY_SUCCESS', 0);
defined('CHILLPAY_FAILED') || define('CHILLPAY_FAILED', 1);
defined('CHILLPAY_CANCEL') || define('CHILLPAY_CANCEL', 2);
defined('CHILLPAY_ERROR') || define('CHILLPAY_ERROR', 3);
defined('CHILLPAY_TIMEOUT') || define('CHILLPAY_TIMEOUT', 4);
defined('CHILLPAY_PENDING') || define('CHILLPAY_PENDING', 9);
defined('CHILLPAY_VOID_SUCCESS') || define('CHILLPAY_VOID_SUCCESS', 20);
defined('CHILLPAY_REFUND_SUCCESS') || define('CHILLPAY_REFUND_SUCCESS', 21);
defined('CHILLPAY_REFUND_REQUEST') || define('CHILLPAY_REFUND_REQUEST', 22);
defined('CHILLPAY_SETTLEMENT_SUCCESS') || define('CHILLPAY_SETTLEMENT_SUCCESS', 23);
defined('CHILLPAY_VOID_FAILED') || define('CHILLPAY_VOID_FAILED', 24);
defined('CHILLPAY_REFUND_FAILED') || define('CHILLPAY_REFUND_FAILED', 25);