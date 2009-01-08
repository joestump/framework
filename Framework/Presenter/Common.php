<?php

/**
 * Framework_Presenter_Common
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Presenter
 * @filesource
 */

/**
 * Framework_Presenter_Common
 *
 * A common base class for our presenters (views). All of our presenters must
 * extend from this class. If they do not then Presenter::factory() will
 * return an error.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Presenter
 */
abstract class Framework_Presenter_Common extends Framework_Object_Web
{
    /**
     * $module
     *
     * @access      protected
     * @var         object      $module         Instance of Framework_Module 
     * @see         Framework_Module
     */
    protected $module = null;

    /**
     * __construct
     *
     * @access      public
     * @param       object      $module         Instance of Framework_Module 
     * @return      void
     * @see         Framework_Presenter_Common::$module
     */
    public function __construct(Framework_Module $module)
    {
        parent::__construct();
        $this->module = $module;
    }

    /**
     * Display the module
     *
     * Define this function in your presenter driver and use it to actually
     * render the given module. This function is ran by Framework::run() once
     * the module's event handler has been ran and verified.
     *
     * @abstract
     * @access      public
     * @return      mixed
     * @see         Framework::run()
     */
    abstract public function display();
}

?>
