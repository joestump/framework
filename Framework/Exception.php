<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Exception
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @filesource
 */

require_once 'PEAR/Exception.php';

/**
 * Framework_Exception
 *
 * A small layer above PEAR_Exception that allows you to pass PEAR_Error
 * as the message to your exceptions.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 */
class Framework_Exception extends PEAR_Exception
{

}

?>
