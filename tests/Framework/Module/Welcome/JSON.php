<?php

class Framework_Module_Welcome_JSON extends Framework_Auth_No
{
    public $controllers = array('JSON');
    public function __default()
    {
        $this->setData('foo', 'bar');
        $this->setData('bar', 'baz');
        $this->setData('baz', 'foo');
        $this->setData('me', 'joestump');
    }
}

?>
