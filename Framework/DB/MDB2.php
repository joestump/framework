<?php

require_once 'Framework/DB/Common.php';
require_once 'MDB2.php';

class Framework_DB_MDB2 extends Framework_DB_Common
{
    /**
     */
    static private $fetchModes = array(
        'MDB2_FETCHMODE_DEFAULT' => MDB2_FETCHMODE_DEFAULT,
        'MDB2_FETCHMODE_ORDERED' => MDB2_FETCHMODE_ORDERED,
        'MDB2_FETCHMODE_ASSOC'   => MDB2_FETCHMODE_ASSOC,
        'MDB2_FETCHMODE_OBJECT'  => MDB2_FETCHMODE_OBJECT,
        'MDB2_FETCHMODE_FLIPPED' => MDB2_FETCHMODE_FLIPPED
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
        if (!is_null(parent::$db) && 
            parent::$db instanceof MDB2_Driver_Common) {
            return parent::$db;
        }

        parent::$db = MDB2::connect($this->dsn);
        if (PEAR::isError(parent::$db)) {
            throw new Framework_DB_Exception(parent::$db->getMessage(), parent::$db->getCode());
        } 

        $fetchMode = MDB2_FETCHMODE_ASSOC;
        if (isset($this->options->fetchMode) && 
            isset(self::$fetchModes[(string)$this->options->fetchMode])) {
            $fetchMode = self::$fetchModes[(string)$this->options->fetchMode];
        }

        parent::$db->setFetchMode($fetchMode);
        return parent::$db;
    }
}

?>
