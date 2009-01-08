<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Base class for Site framework
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Site
 * @filesource
 */

require_once 'PEAR.php';

/**
 * Base class for Site framework
 *
 * This code creates an instance of the site driver. Each site driver defines
 * site paths, names, database connections, etc. From there you can load
 * various templates. It also resets the include_path so modules in the site's
 * directory will override standard modules.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Site
 */
abstract class Framework_Site
{
    /**
     * Create an instance of a Site
     *
     * @access      public
     * @param       string      $site       Name of site to load
     * @return      mixed       Instance of Framework_Site driver on success
     * @throws      Framework_Exception
     * @static
     */
    static public function factory($site)
    {
        $file = 'Framework/Site/'.$site.'.php';
        if (!include_once($file)) {
            throw new Framework_Exception('Could not load site file: '.$file);
        }

        $class = 'Framework_Site_'.$site;
        if (!class_exists($class)) {
            throw new Framework_Exception('Could not find site class: '.$class);
        }

        $instance = new $class();
        if (!$instance instanceof Framework_Site_Common) {
            throw new Framework_Exception('Site class must extend from Framework_Site_Common');
        }

        $path = get_include_path();
        $path = $instance->getPath() . PATH_SEPARATOR . $path;
        set_include_path($path);

        return $instance;
    }
}

?>
