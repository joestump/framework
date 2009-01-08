<?php

class Framework_Module_Welcome_XML extends Framework_Auth_No
{
    public $controllers = array('REST');
    public function __default()
    {
        $this->setData('foo', 'bar');
        $this->setData('bar', 'baz');
        $this->setData('baz', 'foo');
        $this->setData('me', 'joestump');
    }
}

?>
