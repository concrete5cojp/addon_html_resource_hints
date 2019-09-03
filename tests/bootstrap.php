<?php
// Define test constants
define('DIR_TESTS', str_replace(DIRECTORY_SEPARATOR, '/', __DIR__));
define('DIR_BASE', dirname(DIR_TESTS) . '/../../');

// Define concrete5 constants
require DIR_BASE . '/concrete/bootstrap/configure.php';

// Include all autoloaders.
require DIR_BASE_CORE . '/bootstrap/autoload.php';

// Begin concrete5 startup.
$app = require DIR_BASE_CORE . '/bootstrap/start.php';
/* @var Concrete\Core\Application\Application $app */

// Configure error reporting (test more strictly than core settings)
error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
\PHPUnit\Framework\Error\Notice::$enabled = false;

// Unset variables, so that PHPUnit won't consider them as global variables.
unset($app);
