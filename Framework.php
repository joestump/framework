<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006, 2007 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @link        http://bugs.joestump.net/trac.cgi/framework
 * @filesource
 */

if (!function_exists('__autoload')) {
    /**
     * __autoload
     *
     * Autoload is ran by PHP when it can't find a class it is trying to load.
     * By naming our classes intelligently we should be able to load most
     * classes dynamically.
     *
     * @author      Joe Stump <joe@joestump.net>
     * @param       string      $class Class name we're trying to load
     * @return      void
     * @package     Framework
     */
    function __autoload($class)
    {
        $file = str_replace('_','/',$class.'.php');
        include_once($file);
    }
}

define('FRAMEWORK_ERROR_MODULE_INIT', 1);
define('FRAMEWORK_ERROR_MODULE_EVENT', 2);
define('FRAMEWORK_ERROR_MODULE_STATUS', 2);
define('FRAMEWORK_ERROR_AUTH', 4);
define('FRAMEWORK_ERROR_AUTH_PERMISSIONS', 5);
define('FRAMEWORK_ERROR_PRESENTER', 6);
define('FRAMEWORK_ERROR_REQUEST', 7);
define('FRAMEWORK_ERROR_SITE', 8);
define('FRAMEWORK_ERROR_CONTROLLER', 9);

require_once 'Log.php';

// Switch our PEAR_Error's into Framework_Exception's.
PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, array(
    'Framework', 'raiseException'
));

/**
 * Framework
 *
 * This is the base controller of the framework. It handles incoming requests
 * and loads the appropriate modules, presenters, etc.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @link        http://bugs.joestump.net/trac.cgi/framework
 */
abstract class Framework
{
    /**
     * $module
     *
     * @access public
     * @var object $module Instance of Framework_Module being loaded/ran
     * @static
     */
    static public $module = null;

    /**
     * $site
     *
     * @access public
     * @var object $site Instance of Framework_Site being loaded/ran
     * @static
     */
    static public $site = null;

    /**
     * $request
     *
     * @access public
     * @var object $request Instance of Framework_Request
     * @static
     */
    static public $request = null;

    /**
     * $db
     *
     * @access public
     * @var object $db Instance of PEAR DB
     * @static
     * @link http://pear.php.net/package/DB
     */
    static public $db = null;

    /**
     * $log
     *
     * @access public
     * @var object $log Instance of PEAR Log
     * @static
     * @link http://pear.php.net/package/Log
     */
    static public $log = null;

    /**
     * $controller
     *
     * @access      private
     * @var         object      $controller
     * @see         Framework_Controller, Framework_Controller_Common
     */
    static private $controller = null;

    /**
     * Start up the framework
     *
     * @access      public
     * @param       string      $site       The site to load
     * @param       string      $controller Which controller to use
     * @return      boolean     True on success
     * @throws      Framework_Exception
     */
    static public function start($site = 'Default', $controller = 'Web')
    {
        self::$site = Framework_Site::factory($site);

        if (is_null(Framework::$log)) {
            $logFile = (string) Framework::$site->config->logFile;
            Framework::$log = Log::factory('file', $logFile);
        }

        self::$site->prepare();
        self::$controller = Framework_Controller::factory($controller);
        self::$request = Framework_Request::factory(self::$controller->requester);
        self::$module = & self::$controller->module();

        if (!in_array($controller, self::$module->controllers)) {
            throw new Framework_Exception('Invalid controller requested', FRAMEWORK_MODULE_ERROR_INVALID_CONTROLLER);
        }

        self::$controller->authenticate();
        $result = self::$controller->start();
        return self::$controller->display();
    }

    /**
     * Log a message
     *
     * @param   string  $message  Message to log
     * @param   int     $priority Log message priority
     * @see     Log::log()
     * @return  boolean  true if message was logged, false otherwise
     */
    static public function log()
    {
        $args = func_get_args();
        return call_user_func_array(array(self::$log, 'log'), $args);
    }

    /**
     * Log a message to the browser
     *
     * @param   string   $message  Message to log
     * @param   int      $priority Log message priority
     * @return  boolean  true if message was logged, false otherwise
     * @see     Log_firebug::log()
     */
    static public function rlog()
    {
        static $log;
        if (!isset($log)) {
            $log =& Log::singleton('firebug', '', '',
                                   array('buffering' => true));
        }
        $args = func_get_args();
        return call_user_func_array(array($log, 'log'), $args);
    }

    /**
     * stop
     *
     * @access public
     * @return mixed True on success, PEAR_Error on failure
     */
    static public function stop()
    {
        self::$controller->stop();
        self::$site->stop();

        if (DB::isConnection(self::$db)) {
            self::$db->disconnect();
        }

        if (self::$log instanceof Log) {
            self::$log->close();
        }

        return true;
    }

    /**
     * Exception handler for PEAR_Error's
     * 
     * This is the default handler for PEAR_Error's. When enabled in config.xml
     * it will convert all PEAR_Error's to exceptions. 
     * 
     * @access      public
     * @param       object      $error      Instance of PEAR_Error    
     * @static
     */
    static public function raiseException(PEAR_Error $error) 
    {
        switch (get_class($error)) {
        case 'DB_Error':
        case 'MDB2_Error':
            throw new Framework_DB_Exception($error->getMessage(), $error);
        default:
            throw new Framework_Exception($error->getMessage(), $error);
        }
    }
}

?>
