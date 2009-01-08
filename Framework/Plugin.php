<?php

/**
 * Framework_Plugin
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 */

/**
 * Framework_Plugin
 *
 * The plugin framework allows you to create plugins, load them and then have
 * modules run "hooks" that will, in turn, run various methods from the plugins
 * you create. This is especially useful if you want one module to talk to
 * another module without polluting either module's code.
 *
 * For instance, you could have your Discussion Board module load its own
 * plugin which attaches itself to your Blog module's hooks and then adds
 * extra data (ie. number of comments) to your Blog module's entries.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 */
abstract class Framework_Plugin
{
    /**
     * $plugins
     *
     * @access private
     * @static
     * @var array $plugins List of registered plugins
     */
    static private $plugins = array();

    /**
     * Register a plugin
     *
     * @access public
     * @param object $plugin Plugin to register within Framework
     * @return boolean
     * @static
     */
    static public function register(Framework_Plugin_Common $plugin)
    {
        return (self::$plugins[$plugin->getName()] = $plugin);
    }

    /**
     * Unregister a plugin
     *
     * @access public
     * @param object $plugin Plugin to unregister from Framework
     * @return boolean
     * @static
     */
    static public function unregister(Framework_Plugin_Common $plugin)
    {
        if (isset(self::$plugins[$plugin->getName()])) {
            unset(self::$plugins[$plugin->getName()]);
        }

        return true;
    }

    /**
     * Run a hook
     *
     * Use this function to run arbitrary code within your module. Any plugin
     * that is registered will be ran when the hook is fired, but only methods
     * registered for the given hook will be ran.
     *
     * <code>
     * // Run the myHook plugin from within your module
     * Framework::plugin('myHook',$this);
     * </code>
     *
     * @access public
     * @param string $hook Name of hook to run
     * @param object $module Module class to pass on to plugin
     * @return void
     * @static
     */
    static public function run($hook,Framework_Module &$module = null)
    {
        foreach (self::$plugins as $plugin) {
            $result = $plugin->run($hook,$module);
        }
    }

    /**
     * Create a plugin
     *
     * <code>
     * $plugin = Framework_Plugin::factory('Example');
     * if (PEAR::isError($plugin)) {
     *     echo $plugin->getMessage();
     * } else {
     *     Framework_Plugin::register($plugin);
     * }
     * </code>
     *
     * @access public
     * @param string $plugin Name of plugin to load
     * @return mixed object|PEAR_Error
     */
    static public function factory($plugin) {
        $file = 'Framework/Plugin/'.$plugin.'.php';
        if (!include_once($file)) {
            return PEAR::raiseError('Plugin file not found: '.$file);
        }

        $class = 'Framework_Plugin_'.$plugin;
        if (!class_exists($class)) {
            return PEAR::raiseError('Plugin class not found: '.$class);
        }

        try {
            $instance = new $class();
            return $instance;
        } catch (Framework_Exception $error) {
            return PEAR::raiseError($error->getMessage());
        }
    }
}

?>
