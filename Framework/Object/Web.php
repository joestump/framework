<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Object_Web
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Object
 * @filesource
 */

/**
 * Framework_Object_Web
 *
 * This is the base class for web applications extended from Framework_Module,
 * which includes all module classes. Sets up a current user and session.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Object
 */
abstract class Framework_Object_Web extends Framework_Object_DB
{
    /**
     * $user
     *
     * This is the current user. If the user is not logged in then the
     * information defaults to the special anonymous user (userID = 0).
     *
     * @access      protected
     * @var         mixed $user Instnace of Framework_User of current user
     */
    protected $user = null;

    /**
     * $session
     *
     * A simple wrapper class around PHP's $_SESSION variable.
     *
     * @access      protected
     * @var         mixed $session Instance of Framework_Session
     */
    protected $session = null;

    /**
     * __construct
     *
     * @access      public
     * @return      void
     */
    public function __construct()
    {
        parent::__construct();
        if (!is_null($this->db)) {
            $this->user = Framework_User::singleton();
        }

        $this->session = Framework_Session::singleton();
    }
}

?>
