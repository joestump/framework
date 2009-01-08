<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Template
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Template
 * @filesource
 */

/**
 * Framework_Template
 *
 * The Framework_Template classes are a driver based templating system which
 * allows you to load various types of templates based on module names. A good
 * use of this is loading multiple templates in a single request or for
 * templating emails sent out.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Template
 */
abstract class Framework_Template
{
    /**
     * factory
     *
     * If you would like to load a template from a specific module this is
     * where you will want to load it from.
     *
     * <code>
     * $template = Framework_Template('Smarty', 'Blog');
     * if (PEAR::isError($template)) {
     *     echo $template->getMessage();
     * }
     * </code>
     *
     * @access      public
     * @param       string      $type       Type of template to load
     * @param       string      $module     Module where templates are
     * @param       string      $template   Site template to pull from
     * @return      mixed
     */
    static public function factory($type, $module, $template = 'Default')
    {
        $file = 'Framework/Template/'.$type.'.php';
        if (!include_once($file)) {
            throw new Framework_Exception('Invalid template file: ' . $file);
        }

        $class = 'Framework_Template_'.$type;
        if (!class_exists($class)) {
            throw new Framework_Exception('Invalid template class: ' . $class);
        }

        $instance = new $class($module, $template);
        return $instance;
    }

    /**
     * getPath
     *
     * @access      public
     * @param       string      $tplFile    Template file to find
     * @return      string
     * @todo        Add include_path checking as a failsafe
     */
    static public function getPath($tplFile, $module = null, $template = null)
    {
        $sitePath    = Framework::$site->getPath();
        $siteTplPath = $sitePath . '/Templates/';

        if (is_null($template)) {
            $template = Framework::$site->template;
        }

        $paths = array();
        $paths[] = $siteTplPath . $template . '/templates';

        if ($template != 'Default') {
            $paths[] = $siteTplPath . '/Default/templates';
        }

        if (!is_null($module)) {
            $paths[] = $sitePath . '/Framework/Module/' . $module .
                       '/Templates/' . $template;

            $paths[] = FRAMEWORK_BASE_PATH . '/Framework/Module/' . $module .
                       '/Templates/' . $template;

            $paths[] = FRAMEWORK_BASE_PATH . '/Framework/Module/' . $module .
                       '/Templates/Default';

            $dirs = explode(PATH_SEPARATOR, get_include_path());
            foreach ($dirs as $dir) {
                $paths[] = $dir . '/Framework/Module/' . $module .
                                  '/Templates/' . $template;
            }
        }

        $paths = array_unique($paths);
        foreach ($paths as $path) {
            if (file_exists($path . '/' . $tplFile)) {
                return realpath($path);
            }
        }
    }
}

?>
