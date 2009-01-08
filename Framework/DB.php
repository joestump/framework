<?php

/**
 * DB generator for Framework
 * 
 * @author      Joe Stump <joe@joestump.net>  
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  DB
 * @filesource
 */

/**
 * DB generator for Framework
 * 
 * This class generates DB instances and connections for the Framework_Object_DB
 * class. It always returns a singleton (in theory). 
 * 
 * @author      Joe Stump <joe@joestump.net>  
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  DB
 * @see         Framwork_Object_DB
 */
abstract class Framework_DB
{
    /**
     * DB types supported
     *
     * @access      private
     * @var         array       $dbTypes
     * @static
     */
    static private $dbTypes = array(
        'DB', 'MDB2'
    );

    /**
     * Create a DB instance
     *
     * @access      public
     * @param       object      $config     DB config from config.xml
     * @return      object      Instance of DB requested
     * @throws      Framework_DB_Exception
     */
    static public function factory(SimpleXmlElement $config)
    {
        if (!isset($config->type) || 
            !in_array((string)$config->type, self::$dbTypes)) {
            $type = 'None';
        } else {
            $type = (string)$config->type;
        }

        $file = 'Framework/DB/' . $type . '.php';
        require_once $file;
        $class = 'Framework_DB_' . $type;
        if (!class_exists($class)) {
            throw new Framework_DB_Exception('Unknown database type: ' . $db);
        }

        $options = null;
        if (isset($config->options)) {
            $options = $config->options;
        }

        $instance = new $class((string)$config->dsn, $options);
        if (!$instance instanceof Framework_DB_Common) {
            throw new Framework_DB_Exception('Invalid Framework_DB class');
        }

        return $instance;
    }
}

?>
