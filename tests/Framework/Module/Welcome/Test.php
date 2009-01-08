<?php

class Framework_Module_Welcome_Test extends Framework_Auth_No
{
    public function __default()
    {
        $this->setData('baz', 'boo');
    }

    public function anotherTest()
    {
        $this->setData('foo', 'bar');
    }
}

?>
