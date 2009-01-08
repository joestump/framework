<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Auth_User
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @subpackage Auth
 * @filesource
 */

/**
 * Framework_Auth_User
 *
 * If your module requires someone other than the default user to be logged in
 * then extend from this authentication class.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @subpackage Auth
 */
abstract class Framework_Auth_User extends Framework_Auth
{
    /**
     * authenticate
     *
     * @access public
     * @return boolean If user is default user return false
     */
    public function authenticate()
    {
        if ($this->user->isDefault() == false) {
            throw new Framework_Exception('User must be logged in for this request', FRAMEWORK_ERROR_AUTH);
        }
    }
}

?>
