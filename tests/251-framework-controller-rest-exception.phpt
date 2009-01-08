--TEST--
Framework_Controller_REST::output()
--GET--
module=Welcome&class=XML&event=foo
--FILE--
<?php

require_once 'tests-config.php';

try {
    require_once 'Framework.php';
    Framework::start('Tests', 'REST');
    Framework::stop();
} catch (Framework_Exception $error) {
    echo $error;
}

?>
--EXPECT--
<?xml version="1.0"?>
<response _type="array">
    <error _type="string">Invalid event: Framework_Module_Welcome_XML::foo()</error>
    <code _type="integer">8</code>
</response>
