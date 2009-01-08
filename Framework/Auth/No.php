<?php

/**
 * Framework_Auth_No
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @subpackage Auth
 * @filesource
 */

/**
 * Framework_Auth_No
 *
 * If your module class does not require any authentication then it should
 * extend from this authentication module.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @subpackage Auth
 */
abstract class Framework_Auth_No extends Framework_Auth
{
    /**
     * authenticate
     *
     * Since this is the Framework_Auth_No class this will always return true.
     * If you want more robust authentication you might want to check out the
     * Framework_Auth_User class.
     *
     * @access public
     * @return boolean
     */
    public function authenticate()
    {
        return true;
    }
}

?>
