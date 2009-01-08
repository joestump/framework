<?php

/**
 * Framework_Presenter_Smarty
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Presenter
 * @filesource
 */

/**
 * Framework_Presenter_Smarty
 *
 * By default we use Smarty as our websites presentation layer (view). Smarty
 * is a robust compiling template engine with an active community.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Presenter
 * @link        http://smarty.php.net
 */
class Framework_Presenter_Smarty extends Framework_Presenter_Common
{
    /**
     * $template
     *
     * @access      protected
     * @var         object      $template       Instance of Smarty
     */
    protected $template = null;

    /**
     * __construct
     *
     * @access      public
     * @param       object      $module         Instance of Framework_Module
     * @return      void
     */
    public function __construct(Framework_Module $module)
    {
        parent::__construct($module);
        $this->template = Framework_Template::factory('Smarty', Framework::$request->module, Framework::$site->template);
    }

    /**
     * display
     *
     * @access public
     * @return void
     */
    public function display()
    {
        $path = Framework_Template::getPath($this->module->tplFile, Framework::$request->module);
        $this->template->assign('modulePath', $path);
        $this->template->assign('site',Framework::$site);
        $this->template->assign('tplFile',$this->module->tplFile);
        $this->template->assign('user',$this->user);
        $this->template->assign('session',$this->session);

        foreach ($this->module->getData() as $var => $val) {
            if (!in_array($var,array('path','tplFile'))) {
                $this->template->assign($var,$val);
            }
        }

        if ($this->module->pageTemplateFile == null) {
            $pageTemplateFile = 'page.tpl';
        } else {
            $pageTemplateFile = $this->module->pageTemplateFile;
        }

        $this->template->display($pageTemplateFile);
    }
}

?>
