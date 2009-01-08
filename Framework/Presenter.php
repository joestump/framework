<?php

/**
 * Framework_Presenter
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Presenter
 * @filesource
 */

/**
 * Framework_Presenter
 *
 * Presenter factory class. This is used by the controller file, in
 * conjunction with the Framework_Module::$presenter variable to produced the
 * desired presenter class.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Presenter
 * @see         Framework_Module::$presenter, Framework_Presenter_common
 */
abstract class Framework_Presenter
{
    /**
     * Create an instance of a presenter
     *
     * @access      public
     * @param       string      $type       Presentation type (our view)
     * @param       mixed       $module     Module to present
     * @return      object      Instance of presenter
     * @throws      Framework_Exception
     * @static
     */
    static public function factory($type,Framework_Module $module)
    {
        $file = 'Framework/Presenter/' . $type . '.php';
        if (!include($file)) {
            throw new Framework_Exception('Presenter file not found: ' . $type);
        }

        $class = 'Framework_Presenter_'.$type;
        if (!class_exists($class)) {
            throw new Framework_Exception('Invalid presentation class for type: ' . $type);
        }

        $presenter = new $class($module);
        if (!$presenter instanceof Framework_Presenter_common) {
            throw new Framework_Exception('Invalid presentation class: ' . $class);
        }

        return $presenter;
    }
}

?>
