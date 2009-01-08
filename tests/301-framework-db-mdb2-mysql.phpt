--TEST--
Framework_DB_MDB2 (MySQL)
--SKIPIF--
<?php

require_once 'tests-config.php';

if (!defined('TST_DB_MYSQL') || TST_DB_MYSQL !== true) {
    echo "skip TST_DB_MYSQL is not enabled.\n";
}

?>
--FILE--
<?php

require_once 'tests-config.php';
require_once 'Framework.php';
require_once 'Framework/DB.php';

$config = simplexml_load_file('301-framework-db-mdb2-mysql.xml');
$gen = Framework_DB::factory($config->db);
$db = $gen->singleton();

$sql = "SELECT * 
        FROM users
        WHERE username = 'joestump'";

$result = $db->query($sql);
if (PEAR::isError($result)) {
    echo $result->getMessage() . "\n";
    echo $db->last_query . "\n";
    exit;
}

while ($row = $result->fetchRow()) {
    echo $row['username'] . "\n";
}

try {
    $db->query('SELECT * FROM foo');
} catch (Framework_DB_Exception $e) {
    echo $e->getMessage() . "\n";
}

?>
--EXPECT--
joestump
MDB2 Error: no such table
