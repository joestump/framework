<?php

/**
 * Framework_Request_Common
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Request_Common
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @see         Framework::$request
 * @abstract
 */
abstract class Framework_Request_Common
{
    /**
     * $module
     *
     * @access  public
     * @var     string
     */
    public $module = '';

    /**
     * $class
     *
     * @access  public
     * @var     string
     */
    public $class = '';

    /**
     * $event
     *
     * @access  public
     * @var     string
     */
    public $event = '__default';

    /**
     * $presenter
     *
     * @access  public
     * @var     string
     */
    public $presenter = null;
}

?>
