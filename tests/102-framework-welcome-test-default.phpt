--TEST--
Framework_Module_Welcome_Test::__default()
--GET--
module=Welcome&class=Test
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
boo
