<?php

/**
 * Framework_Controller_CLI
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved. 
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Controller_CLI
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved. 
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */
class Framework_Controller_CLI extends Framework_Controller_Common
{
    /**
     * $requester
     *
     * @access      public
     * @var         string      $requester      Framework_Request type to use
     */    
    public $requester = 'CLI';

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

    }

    /**
     * run  
     *
     * @access      protected
     * @return      mixed
     */
    protected function run()
    {
        $result = Framework_Module::start(Framework::$module, 
                                          Framework::$request);
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
