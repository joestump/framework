<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Controller
 * @filesource
 */

/**
 * Base class for Controller framework
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 */
abstract class Framework_Controller
{
    /**
     * Create an instance of a Controller
     *
     * @access      public
     * @param       string      $type
     * @return      object      Instance of a Controller
     * @throws      Framework_Exception
     */
    static public function factory($type)
    {
        $file = 'Framework/Controller/' . $type . '.php';
        $object = 'Framework_Controller_' . $type;
        if (!include_once($file)) {
            throw new Framework_Exception('Controller file not found: ' . $file);
        }

        if (!class_exists($object)) {
            throw new Framework_Exception('Controller class not found: ' . $object);
        }

        $instance = new $object();
        if (!$instance instanceof Framework_Controller_Common) {
            throw new Framework_Exception('Framework_Controller_' . $type . ' does not extend from Framework_Controller_Common');
        }

        return $instance;
    }
}

?>
