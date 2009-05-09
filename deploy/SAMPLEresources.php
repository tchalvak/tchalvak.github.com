<?php
/*
* resources.php template. Copy this into your deployment root and change the necessary constants
*/

// *******************************
// *** Absolute Path Constants ***

define('SERVER_ROOT', '/var/www/netrunner/trunk/deploy/');
define('WEB_ROOT', 'http://netrunner.localhost.com/');
define('LOGIN_PAGE', WEB_ROOT.'login.php');
define('WEB_CSS_ROOT', WEB_ROOT.'_lib/css/');
define('WEB_JS_ROOT', WEB_ROOT.'_lib/js');

// *** End Absolute Path Constants ***
// ***********************************

// **************************
// *** Database Constants ***

define('DATABASE_NAME', 'netrunner');
define('DATABASE_USER', 'tchalvak');
define('DATABASE_HOST', 'localhost');
define('DATABASE_PASSWORD', 'test');
define('CONNECTION_STRING', 'pgsql:dbname='.DATABASE_NAME.';user='.DATABASE_USER.';password='.DATABASE_PASSWORD);

// *** End Database Constants ***
// ******************************

// ***************************
// *** Debugging Constants ***

define('ERROR_ECHOING', TRUE);

// *** End Debugging Constants ***
// *******************************
?>
