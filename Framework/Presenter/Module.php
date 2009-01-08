<?php

/**
 * Framework_Presenter_Module
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Presenter
 * @filesource
 */

require_once 'HTML/Template/Smarty/Smarty.class.php';

/**
 * Framework_Presenter_Module
 *
 * With the default Smarty presenter your module's template is wrapped in the
 * page.tpl template. With the Module presenter your module's template is NOT
 * wrapped in the page.tpl template.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Presenter
 * @link        http://smarty.php.net
 */
class Framework_Presenter_Module extends Framework_Presenter_Common
{
    /**
     * $template
     *
     * @access private
     * @var object $template Instance of Smarty
     */
    private $template = null;

    /**
     * __construct
     *
     * @access public
     * @param object $module Instance of Framework_Module to be displayed
     * @return void
     */
    public function __construct(Framework_Module $module)
    {
        parent::__construct($module);
        $this->template = Framework_Template::factory('Smarty', Framework::$request->module);
    }

    /**
     * display
     *
     * The Framework_Presenter_Module class only renders the module's template
     * file and not the page template that the Framework_Presenter_Smarty
     * presenter renders as well.
     *
     * @access public
     * @return void
     */
    public function display()
    {
        $this->template->assign('modulePath', $path);
        $this->template->assign('site', Framework::$site);
        $this->template->assign('tplFile', $tplFile);
        $this->template->assign('user', $this->user);
        $this->template->assign('session', $this->session);

        foreach ($this->module->getData() as $var => $val) {
            if (!in_array($var,array('path', 'tplFile'))) {
                $this->template->assign($var,$val);
            }
        }

        $this->template->display($this->module->tplFile);
    }
}

?>
