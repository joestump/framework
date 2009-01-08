<?php

/**
 * Framework_Object_DB
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @subpackage Object
 * @filesource
 */

/**
 * Framework_Object_DB
 *
 * Extends the base Framework_Object class to include a database connection. If
 * your class requires a database connection you will want to extend from this
 * class.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @subpackage Object
 * @see Framework_Object
 */
abstract class Framework_Object_DB extends Framework_Object
{
    /**
     * $db
     *
     * @access protected
     * @var object $db Instance of PEAR DB connection
     * @see DB
     */
    protected $db = null;

    /**
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->db = & self::createDB();
    }

    /**
     * createDB
     *
     * @access  private
     * @return  reference
     * @static
     */
    static private function &createDB()
    {
        if (is_null(Framework::$db)) {
            if (!isset(Framework::$site->config->db)) {
                Framework::$db = null;
            } else {
                $gen = Framework_DB::factory(Framework::$site->config->db);
                Framework::$db = $gen->singleton();
            }
        }

        return Framework::$db;
    }

    /**
     * __sleep
     *
     * @access  public
     * @return  void
     */
    public function __sleep()
    {
        $this->db = null;
    }

    /**
     * __wakeup
     *
     * @access  public
     * @return  void
     */
    public function __wakeup()
    {
        $this->db = & self::createDB();
    }
}

?>
