<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller_Web
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006, 2007 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Controller_Web
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */
class Framework_Controller_Web extends Framework_Controller_Common
{
    /**
     * $requester
     *
     * @access      public
     * @var         string      $requester      Framework_Request type to use
     */
    public $requester = 'Web';

    /**
     * module
     *
     * @access      public
     * @param       object      $request
     */
    public function module()
    {
        return Framework_Module::factory(Framework::$request);
    }

    /**
     * start
     *
     * @access      public
     * @return      mixed
     */
    public function start()
    {
        return true;
    }

    /**
     * authenticate
     *
     * @access      public
     * @return      mixed
     */
    public function authenticate()
    {
        Framework::$module->authenticate();
    }

    /**
     * run
     *
     * @access      protected
     * @return      mixed
     */
    protected function run()
    {
        Framework_Module::start(Framework::$module, Framework::$request);
    }

    /**
     * display
     *
     * @access      public
     * @return      void
     */
    public function display()
    {
        $this->run();
        $presenter = Framework_Presenter::factory(Framework::$module->presenter,
                                                  Framework::$module);
        $presenter->display();
    }

    /**
     * stop
     *
     * @access      public
     * @return      mixed
     */
    public function stop()
    {
        Framework_Module::stop(Framework::$module);
    }
}

?>
