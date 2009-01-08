--TEST--
Framework_Controller_REST::output()
--GET--
module=Welcome&class=XML
--FILE--
<?php

require_once 'tests-config.php';

try {
    require_once 'Framework.php';
    Framework::start('Tests', 'REST');
    Framework::stop();
} catch (Framework_Exception $error) {
    echo $error->getMessage();
}

?>
--EXPECT--
<?xml version="1.0"?>
<response _type="array">
    <foo _type="string">bar</foo>
    <bar _type="string">baz</bar>
    <baz _type="string">foo</baz>
    <me _type="string">joestump</me>
</response>
