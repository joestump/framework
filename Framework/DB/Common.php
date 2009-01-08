<?php

/**
 * Common class for DB generators
 * 
 * @author      Joe Stump <joe@joestump.net>  
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  DB
 * @filesource
 */

require_once 'Framework/Object.php';
require_once 'Framework/DB/Exception.php';


/**
 * Common class for DB generators
 * 
 * All DB generators should extend from this class. They should assign a 
 * singleton to the $db variable and implement a singleton method. 
 * 
 * @author      Joe Stump <joe@joestump.net>  
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  DB
 */
abstract class Framework_DB_Common extends Framework_Object
{
    /**
     * Instance of DB class
     * 
     * Your class should check to see if this is null before returning an
     * instance of your database class.
     * 
     * @access      protected
     * @var         object      $db
     * @static
     */
    static protected $db = null;

    /**
     * The DSN to connect to the database
     *
     * @access      protected
     * @var         string      $dsn
     */
    protected $dsn = '';

    /**
     * Options passed from config.xml
     * 
     * @access      protected
     * @var         object      $options        Instance of SimpleXmlElement
     */
    protected $options = null;

    /**
     * Constructor
     *
     * @access      public
     * @param       string      $dsn        DSN to pass to DB class
     * @param       object      $options    Options from config.xml
     */
    public function __construct($dsn, SimpleXmlElement $options = null)
    {
        $this->dsn = $dsn;
        $this->options = $options;
    }

    /**
     * Returns an instance of the DB
     *
     * Implement this function in the child driver. It should check the 
     * singleton parent::$db before instantiating / connecting to the DB and
     * then return that instance.
     *
     * @abstract
     * @access      public
     * @return      object      Instance of whatever DB is requested
     * @see         Framework_Object_DB
     */
    abstract public function singleton();
}

?>
