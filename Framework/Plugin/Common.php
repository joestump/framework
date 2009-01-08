<?php

/**
 * Framework_Plugin_Common
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @package Framework
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @filesource
 */

/**
 * Framework_Plugin_Common
 *
 * This is the base class for all framework plugins. Your plugin must extend
 * from this class in order to be properly registered within the plugin
 * framework.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @see Framework_Plugin_Example
 */
class Framework_Plugin_Common extends Framework_Object_DB
{
    /**
     * $name
     *
     * @access protected
     * @var string $name The name of your plugin (e.g. Example)
     */
    protected $name;

    /**
     * $title
     *
     * @access public
     * @var string $title A human readable title for your plugin
     */
    public $title;

    /**
     * $description
     *
     * @access public
     * @var string $title A brief human readable description of your plugin
     */
    public $description;

    /**
     * $hooks
     *
     * @access private
     * @var $hooks The hooks a plugin is registered for and the methods to run
     */
    private $hooks = array();

    /**
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $required = array('name','title','description');
        foreach ($required as $var) {
            if (!isset($this->$var) || !strlen($this->$var)) {
                throw new Framework_Exception("You must set a $var for your plugin");
            }
        }
    }

    /**
     * Register method for a hook
     *
     * @access protected
     * @param string $hook The hook you want to register a method for
     * @param mixed $method Name of method or array of method names
     * @return boolean
     */
    protected function register($hook,$method)
    {
        return ($this->hooks[$hook] = $method);
    }

    /**
     * Run methods associated with given hook
     *
     * Plugins are ran arbitrarily by the plugin framework. This means that
     * there is little error checking or error handling within the plugin
     * framework. Rather than put in error handling and checking the plugin
     * framework favors silencing improper plugins to avoid breaking the
     * actual code being ran. The idea behind this is that you'd rather have
     * your application work, but your plugin fail than having a failed plugin
     * bring the whole application down.
     *
     * @access public
     * @param string $hook Name of hook being ran
     * @param object $module Module hook is being ran from
     * @return void
     */
    public function run($hook,Framework_Module $module = null)
    {
        if (isset($this->hooks[$hook])) {
            if (is_array($this->hooks[$hook])) {
                foreach ($this->hooks[$hook] as $method) {
                    if (method_exists($this,$method)) {
                        $this->$method($module);
                    }
                }
            } else {
                $method = $this->hooks[$hook];
                if (method_exists($this,$method)) {
                    $this->$method($module);
                }
            }
        }
    }

    /**
     * Get plugin name
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

?>
