<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Request_CLI
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php 
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Request_CLI
 *
 * Parses the $_GET request and then sets the module, class and event that
 * needs to be set. 
 * 
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @see         Framework::$request
 */
class Framework_Request_CLI extends Framework_Request_Common
{
    /**
     * __construct
     *
     * Parses the $_GET request and throws Exceptions if there are any 
     * problems with the request.
     *
     * @access      public
     * @return      void
     * @throws      Framework_Exception
     */
    public function __construct()
    {
        $_GET = getopt('m:c:e:'); 

        $args = array('m' => 'module',
                      'c' => 'class',
                      'e' => 'event');

        foreach ($args as $key => $val) {
            if (isset($_GET[$key])) {
                $_GET[$val] = $_GET[$key];
                unset($_GET[$key]);
            }
        }

        if (!isset($_GET['module']) || 
            !is_string($_GET['module']) || 
            !preg_match('/^[A-Z0-9]+$/i',$_GET['module'])) {
            throw new Framework_Exception('No/Invalid module provided');
        }     

        $this->module = $_GET['module'];
        if (isset($_GET['class'])) {
            $this->class = $_GET['class'];
        }

        if (isset($_GET['event'])) {
            $this->event = $_GET['event'];
        }

        if (!preg_match('/^([_A-Z]+)([A-Z0-9]+)$/i',$this->event)) {
            throw new Framework_Exception('Invalid event handler requested');
        }
    }
}

?>
