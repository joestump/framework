--TEST--
Framework_DB_DB (MySQL)
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
require_once 'Framework/DB.php';

$config = simplexml_load_file('300-framework-db-db-mysql.xml');
$gen = Framework_DB::factory($config->db);
$db = $gen->singleton();

$sql = 'SELECT * 
        FROM users
        WHERE username = ?';

$result = $db->query($sql, array('joestump'));
if (PEAR::isError($result)) {
    echo $result->getMessage() . "\n";
    echo $db->last_query . "\n";
}

while ($row = $result->fetchRow()) {
    echo $row['username'] . "\n";
}

?>
--EXPECT--
joestump
