<?php

/**
 * Framework_Template_Interface
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Template
 * @filesource
 */

/**
 * Framework_Template_Interface
 *
 * All Framework_Template drivers must implement this so they all behave in
 * the same basic manner.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Template
 */
interface Framework_Template_Interface
{
    /**
     * assign
     *
     * Assigns a variable to the template.
     *
     * @access      public
     * @param       string      $var        Name of variable
     * @param       mixed       $val        Value of variable
     * @return      void
     */
    public function assign($var, $val = null);

    /**
     * fetch
     *
     * Should return the compiled/rendered template as a string. Usually used
     * to assign into another template or store/cache somewhere.
     *
     * @access      public
     * @param       string      $template   Name of template file
     * @return      string
     */
    public function fetch($template, $cacheID = '', $compileID = '', $display = false);

    /**
     * display
     *
     * Outputs the rendered template to the output buffer.
     *
     * @access      public
     * @param       string      $template   Name of template file
     * @return      void
     */
    public function display($template, $cacheID = '', $compileID = '');
}

?>
