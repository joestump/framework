<?php

/**
 * Framework_Session
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @filesource
 */

/**
 * Framework_Session
 *
 * Our base session class as a singleton. Handles creating the session,
 * writing to the session variable (via overloading) and destroying the
 * session.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 */
class Framework_Session
{
    /**
     * $instance
     *
     * Instance variable used for singleton pattern. Stores a single instance
     * of Framework_Session.
     *
     * @access private
     * @var mixed $instance
     */
    private static $instance;

    /**
     * $sessionID
     *
     * The session ID assigned by PHP (usually a 32 character alpha-numeric
     * string).
     *
     * @access public
     * @var string $sessionID
     */
    public $sessionID = '';

    /**
     * __construct
     *
     * Starts the session and sets the sessionID for the class.
     *
     * @access private
     * @return void
     */
    private function __construct()
    {
        if (ini_get('session.auto_start') == 0) {
            session_start();
        }

        $this->sessionID = session_id();
    }

    /**
     * singleton
     *
     * Implementation of the singleton pattern. Returns a sincle instance
     * of the session class.
     *
     * @author Joe Stump <joe@joestump.net>
     * @return mixed Instance of session
     */
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    /**
     * destroy
     *
     * Destroys the session
     *
     * @author Joe Stump <joe@joestump.net>
     * @access public
     * @return void
     */
    public function destroy()
    {
        foreach ($_SESSION as $var => $val) {
            session_unregister($var);
        }

        session_destroy();
    }

    /**
     * __clone
     *
     * Disable PHP5's cloning method for session so people can't make copies
     * of the session instance.
     *
     * @author Joe Stump <joe@joestump.net>
     * @access public
     * @return void
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed for ' . __CLASS__, E_USER_ERROR);
    }

    /**
     * __get($var)
     *
     * Returns the requested session variable.
     *
     * @access public
     * @return mixed Returns the value of $_SESSION[$var]
     * @see Framework_Session::__set()
     */
    public function __get($var)
    {
        if (!isset($_SESSION[$var])) {
            $_SESSION[$var] = null;
        }

        return $_SESSION[$var];
    }

    /**
     * __set
     *
     * Using PHP5's overloading for setting and getting variables we can
     * use $session->var = $val and have it stored in the $_SESSION
     * variable. To set an email address, for instance you would do the
     * following:
     *
     * <code>
     * $session->email = 'user@example.com';
     * </code>
     *
     * This doesn't actually store 'user@example.com' into $session->email,
     * rather it is stored in $_SESSION['email'].
     *
     * @param string $var
     * @param mixed $val
     * @see Framework_Session::__get()
     * @link http://us3.php.net/manual/en/language.oop5.overloading.php
     * @return boolean
     */
    public function __set($var,$val)
    {
        return ($_SESSION[$var] = $val);
    }

    /**
     * __isset()
     *
     * @param   string   $var  Variable to check
     * @return  boolean  true if $_SESSION[$var] or $this->$var is
     *                   set, false otherwise
     */
    public function __isset($var)
    {
        return isset($_SESSION[$var]) || isset($this->$var);
    }

    /**
     * __destruct()
     *
     * Writes the current session.
     *
     * @access public
     * @return void
     */
    public function __destruct()
    {
        session_write_close();
    }
}

?>
