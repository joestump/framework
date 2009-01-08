<?php

/**
 * PEAR DB driver for Framework_DB
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  DB
 * @link        http://pear.php.net/package/DB
 * @filesource
 */

require_once 'DB.php';
require_once 'Framework/DB/Common.php';

/**
 * PEAR DB driver for Framework_DB
 *
 * The generator driver that handles building up a connection to the DB using
 * PEAR's DB package.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  DB
 * @link        http://pear.php.net/package/DB
 */
class Framework_DB_DB extends Framework_DB_Common
{
    /**
     * Fetchmode map
     *
     * @access      private
     * @var         array       $fetchModes     Map of names to values
     * @static
     */
    static private $fetchModes = array(
        'DB_FETCHMODE_DEFAULT' => DB_FETCHMODE_DEFAULT,
        'DB_FETCHMODE_ORDERED' => DB_FETCHMODE_ORDERED,
        'DB_FETCHMODE_ASSOC'   => DB_FETCHMODE_ASSOC,
        'DB_FETCHMODE_OBJECT'  => DB_FETCHMODE_OBJECT,
        'DB_FETCHMODE_FLIPPED' => DB_FETCHMODE_FLIPPED,
        'DB_GETMODE_ORDERED'   => DB_GETMODE_ORDERED,
        'DB_GETMODE_ASSOC'     => DB_GETMODE_ASSOC,
        'DB_GETMODE_FLIPPED'   => DB_GETMODE_FLIPPED
    );

    /**
     * Create a singleton of PEAR's DB 
     *
     * @access      public
     * @return      object      Instance of PEAR DB connected to the DB
     * @throws      Framework_DB_Exception
     */
    public function singleton()
    {
        if (!is_null(parent::$db) && parent::$db instanceof DB_common) {
            return parent::$db;
        }

        parent::$db = DB::connect($this->dsn);
        if (PEAR::isError(parent::$db)) {
            throw new Framework_DB_Exception(parent::$db->getMessage(), parent::$db->getCode());
        }

        $fetchMode = DB_FETCHMODE_ASSOC;
        if (isset($this->options->fetchMode) && 
            isset(self::$fetchModes[(string)$this->options->fetchMode])) {
            $fetchMode = self::$fetchModes[(string)$this->options->fetchMode];
        }

        parent::$db->setFetchMode($fetchMode);
        return parent::$db;
    }
}

?>
