<?php
/**
 * Slim+RedBean Demo
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 */

// TIMEZONE
date_default_timezone_set('Asia/Manila');

// APPLICATION MODE
define('APP_MODE', 'dev');

// INITIATE SESSION
session_cache_limiter(false);
session_start();

// APPLICATION URL PATHS
define('BASE_URL','http://demo.local:10088/'); // always include the trailing slash at the end

// DATABASE SETTINGS
define('DB_HOST', 'localhost');
define('DB_NAME', 'demo');
define('DB_USER', 'root');
define('DB_PASS', '');

// CORE APPLICATION URLS
define('ASSET_URL', BASE_URL . 'assets/');
define('CSS_PATH', ASSET_URL . 'css/');
define('JS_PATH', ASSET_URL . 'js/');
define('IMAGES_PATH', ASSET_URL . 'images/');

// MVC PATHS
define('MODEL_PATH', 'models/');
define('VIEWS_PATH', 'views');
define('CONTROLLER_PATH','controllers/');

// REDBEAN ORM CONFIG
require 'models/rb.php';
R::setup("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);

// SLIM MICROFRAMEWORK
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('mode'=>APP_MODE, 'templates.path'=>VIEWS_PATH));

// SLIM CSRF GUARD
require 'Slim/Extras/Middleware/CsrfGuard.php';
$app->add(new \Slim\Extras\Middleware\CsrfGuard());

// SESSION KEEP
$app->flashKeep();

include "modules/Application.php";
// AUTO LOAD MODELS
spl_autoload_register(function ($class) {
	if (file_exists("models/{$class}.php")) 
		include "models/{$class}.php";
	if (file_exists("modules/{$class}.php"))
		include "modules/{$class}.php";	
});