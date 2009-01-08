<?php

/**
 * Framework_Plugin_Example
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @filesource
 */

/**
 * Framework_Plugin_Example
 *
 * This example plugin changes the module's presenter, sets a variable and
 * also echos out "Hello World!".
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 */
class Framework_Plugin_Example extends Framework_Plugin_Common
{
    protected $name = 'Example';
    public $title = 'An Example Plugin';
    public $description = 'Sets foo to bar, changes presenter, etc.';

    public function __construct()
    {
        // This registers the method 'exampleHook' with the hook 'welcome'.
        // When Framework_Plugin::run('welcome',$this); is ran the plugin
        // framework will run Framework_Plugin_Example::exampleHook() and pass
        // a reference to the module.
        $this->register('welcome','exampleHook');
    }

    public function exampleHook($module)
    {
        $module->presenter = 'None';
        $module->setData('foo','bar');
        echo 'Hello World! <br />';
        echo $_SERVER['HTTP_HOST'].' ('.$_SERVER['SERVER_NAME'].')';
        echo '<pre>'; print_r($_SERVER); echo '</pre>';
    }
}

?>
