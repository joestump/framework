<?php

/**
 * Framework_Auth_ACL
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2006 Joseph C. Stump. All rights reserved.
 * @package     Framework
 * @subpackage  Auth
 * @filesource
 */

/**
 * Framework_Auth_ACL
 *
 * The Framework_Auth_ACL class utilizes the <acl> section located in a
 * site's config.xml. A user must have the accessLevel field set in order for
 * this to work as well. If the accessLevel in the config.xml for the given
 * module/event pair being requested is higher than the accessLevel set in the
 * user class then the user is blocked. If either there is no acl or the
 * variable accessLevel is not present in the user instance this will return
 * true.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Auth
 */
abstract class Framework_Auth_ACL extends Framework_Auth
{
    /**
     * authenticate
     *
     * @access  public
     * @return  boolean
     */
    public function authenticate()
    {
        if (!method_exists($this->user, 'getAccessLevel')) {
            throw new Framework_Exception('User class does not implement getAccessLevel()', FRAMEWORK_ERROR_AUTH_PERMISSIONS);
        }

        if (isset(Framework::$site->config->acl)) {
            foreach (Framework::$site->config->acl->class as $class) {
                if ($class['name'] == get_class($this)) {
                    if ($class['event'] == Framework::$request->event) {
                        if ((int)$this->user->getAccessLevel() < $class['accessLevel']) {
                            throw new Framework_Exception('The user does not have permissions to run this request', FRAMEWORK_ERROR_AUTH_PERMISSIONS);
                        }
                    }
                }
            }
        }

        return true;
    }
}

?>
