<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Request
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @package     Framework
 * @subpackage  Request
 * @filesource
 */

/**
 * Base class for Request framework
 *
 * The Request framework handles parsing requests so that the controller can
 * figure out what module to load and how to load it.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Request
 * @see         Framework::$request
 */
abstract class Framework_Request
{
    /**
     * Create an instance of a Request 
     *
     * @access      public
     * @param       string      $type
     * @return      mixed       PEAR_Error on failure, request on success
     */
    static public function factory($type)
    {
        $file = 'Framework/Request/' . $type . '.php';
        $object = 'Framework_Request_' . $type;
        if (!include_once($file)) {
            throw new Framework_Exception('Invalid request file: ' . $file);
        }

        if (!class_exists($object)) {
            throw new Framework_Exception('Invalid request class: ' . $object);
        }

        $instance = new $object();
        if (!$instance instanceof Framework_Request_Common) {
            throw new Framework_Exception('Framework_Request_' . $type . ' does not extend from Framework_Request_Common');
        }

        return $instance;
    }
}

?>
