--TEST--
Framework_Controller_JSON w/ Exception
--GET--
module=Welcome&class=JSON&event=foo
--FILE--
<?php

require_once 'tests-config.php';

require_once 'Framework.php';
Framework::start('Tests', 'JSON');
Framework::stop();

?>
--EXPECT--
{"error":"Invalid event: Framework_Module_Welcome_JSON::foo()","code":8}
