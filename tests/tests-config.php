<?php

// Set up the path information
$path = ini_get('include_path');
ini_set('include_path', realpath('../') . ':' . $path);

// Once you've set up the test database you MUST set TST_DB to true. See 
// tests-db-mysql.sql for more information.  Only tests for MySQL are 
// supported at this time.
define('TST_DB_MYSQL', true);

// DO NOT EDIT! Unless you know what you're doing anyways.
define('FRAMEWORK_BASE_PATH', dirname(__FILE__));

?>
