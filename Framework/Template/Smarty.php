<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Template_Smarty
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Template
 * @filesource
 */

require_once 'HTML/Template/Smarty/Smarty.class.php';

/**
 * Framework_Template_Smarty
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Template
 */
class Framework_Template_Smarty
extends Smarty
implements Framework_Template_Interface
{
    /**
     * $module
     *
     * @access      private
     * @var         string      $module
     */
    protected $module = '';

    /**
     * $template
     *
     * @access      private
     * @var         string      $template
     */
    protected $template = '';

    /**
     * __construct
     *
     * @access      public
     * @param       string      $module
     * @param       string      $template
     * @return      void
     */
    public function __construct($module, $template = 'Default')
    {
        $this->module   = $module;
        $this->template = $template;
    }

    /**
     * display
     *
     * @access      public
     * @param       string      $template
     * @param       string      $cache_id
     * @param       string      $compile_id
     * @return      void
     */
    public function display($template, $cache_id = '', $compile_id = '')
    {
        $this->setPaths($template);
        $compile_id = $this->getCompileID($template, $compile_id);
        parent::display($template, $cache_id, $compile_id);
    }

    /**
     * fetch
     *
     * @access      public
     * @param       string      $template
     * @param       string      $cache_id
     * @param       string      $compile_id
     * @return      string
     */
    public function fetch($template, $cache_id = '', $compile_id = '', $display = false)
    {
        $this->setPaths($template);
        $compile_id = $this->getCompileID($template, $compile_id);
        return parent::fetch($template, $cache_id, $compile_id, $display);
    }

    /**
     * setPaths
     *
     * @access      public
     * @param       string      $template
     * @return      void
     */
    protected function setPaths($template)
    {
        $this->template_dir = Framework_Template::getPath($template, $this->module, $this->template);
        $path = realpath(Framework::$site->getPath() . '/Templates/'. $this->template);
        $this->compile_dir = $path . '/templates_c';
        $this->cache_dir = $path . '/cache';
        $this->config_dir = $path . '/config';
        $this->plugins_dir = array_merge($this->plugins_dir, array('Framework/Template/Smarty/plugins','plugins', $path.'/plugins'));

        if (!is_writeable($this->compile_dir) ||
            !is_writeable($this->cache_dir)) {
            throw new Framework_Exception('Cannot write to template cache/compile dirs: ' . $path);
        }
    }

    /**
     * getCompileID
     *
     * Creates a unique compile_id for a given template.
     *
     * @author      Joe Stump <joe@joestump.net>
     * @access      private
     * @param       string      $template       Name of template
     * @param       string      $compile_id     Old $compile_id
     * @return      string
     */
    private function getCompileID($template, $compile_id)
    {
        if (strlen($compile_id)) {
            return $compile_id;
        }

        $compile_id = $this->template_dir . $this->template . $template;
        return sha1($compile_id);
    }
}

?>
