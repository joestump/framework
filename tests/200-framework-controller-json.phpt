--TEST--
Framework_Controller_JSON::output()
--GET--
module=Welcome&class=JSON
--FILE--
<?php

require_once 'tests-config.php';

try {
    require_once 'Framework.php';
    Framework::start('Tests', 'JSON');
    Framework::stop();
} catch (Framework_Exception $error) {
    echo $error->getMessage();
}

?>
--EXPECT--
{"foo":"bar","bar":"baz","baz":"foo","me":"joestump"}
