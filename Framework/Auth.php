<?php

/**
 * Framework_Auth
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Auth
 * @filesource
 */

/**
 * Framework_Auth
 *
 * Base class of authentication classes. The controller will check to make
 * sure your module is an instance of Framework_Auth. Any auth class you create
 * should have a simple function named authenticate that returns a boolean
 * value. Based on the return value the controller will either load the
 * request or run Framework_Redirect_User().
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Auth
 * @see         Framework_Module
 */
abstract class Framework_Auth extends Framework_Module
{
    /**
     * authenticate
     *
     * Define this in your own Auth classes and have them return a boolean
     * value. The controller will then appropriately validate the request.
     *
     * @abstract
     * @access public
     * @return boolean
     * @see Framework::run()
     */
    abstract public function authenticate();
}

?>
