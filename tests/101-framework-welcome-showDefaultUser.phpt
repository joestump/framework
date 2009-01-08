--TEST--
Framework_Module_Welcome::showDefaultUser()
--GET--
module=Welcome&event=showDefaultUser
--FILE--
<?php

require_once 'tests-config.php';

try {
    require_once 'Framework.php';
    Framework::start('Tests', 'Web');
    Framework::stop();
} catch (Framework_Exception $error) {
    echo $error->getMessage();
}

?>
--EXPECT--
joestump
