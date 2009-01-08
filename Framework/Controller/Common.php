<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller_Common
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Controller_Common
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 * @abstract
 */
abstract class Framework_Controller_Common extends Framework_Object_DB
{
    /**
     * start
     *
     * @access      public
     * @return      mixed
     * @abstract
     */
    abstract public function start();

    /**
     * stop
     *
     * @access      public
     * @return      mixed
     * @abstract
     */
    abstract public function stop();

    /**
     * module
     *
     * The value of this is returned and assigned to Framework::$module.
     *
     * @access      public
     * @return      mixed
     * @see         Framework::$module
     */
    abstract public function module();

    /**
     * authenticate
     *
     * @access      public
     * @return      mixed
     */
    abstract public function authenticate();

    /**
     * run
     *
     * This is where the module's event should be ran. This function is called
     * by display, which then renders the output as necessary.
     *
     * @access      protected
     * @return      mixed
     */
    abstract protected function run();

    /**
     * display
     *
     * This function is used to output the module. The default controller, Web,
     * uses this to load and render a Framework_Presenter.
     *
     * @access      public
     * @return      void
     */
    abstract public function display();
}

?>
