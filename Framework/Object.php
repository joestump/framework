<?php

/**
 * Framework_Object
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @filesource
 */

/**
 * Framework_Object
 *
 * The base object class for most of the classes that we use in our framework.
 * Provides basic logging and set/get functionality.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 */
abstract class Framework_Object
{
    /**
     * $log
     *
     * @var mixed $log Instance of PEAR Log
     */
    protected $log;

    /**
     * $me
     *
     * @var mixed $me Instance of ReflectionClass
     */
    protected $me;

    /**
     * __construct
     *
     * @author Joe Stump <joe@joestump.net>
     * @access public
     */
    public function __construct()
    {
        $this->log =& Framework::$log;
        $this->me = new ReflectionClass($this);
    }

    /**
     * setFrom
     *
     * Takes the object's class vars and sets any found in $data to the value
     * found in $data. If Class::$foo exists and $data['foo'] is set to 'bar'
     * then your instance of Class's $foo will be set to 'bar'.
     *
     * @author Joe Stump <joe@joestump.net>
     * @access public
     * @param mixed $data Array of variables to assign to instance
     * @return void
     */
    public function setFrom($data)
    {
        if (is_array($data) && count($data)) {
            $valid = get_class_vars(get_class($this));
            foreach ($valid as $var => $val) {
                if (isset($data[$var])) {
                    $this->$var = $data[$var];
                }
            }
        }
    }

    /**
     * toArray
     *
     * Return the object's member variables as an associative array.
     *
     * @access public
     * @return mixed Array of member variables keyed by variable name
     */
    public function toArray()
    {
        $defaults = $this->me->getDefaultProperties();
        $return = array();
        foreach ($defaults as $var => $val) {
            if ($this->$var instanceof Framework_Object) {
                $return[$var] = $this->$var->toArray();
            } else {
                $return[$var] = $this->$var;
            }
        }

        return $return;
    }
}

?>
