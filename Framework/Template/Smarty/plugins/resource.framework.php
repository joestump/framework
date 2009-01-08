<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * resource.framework.php
 *
 * To include files do {include file="framework:Module+template.tpl"}
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Template
 * @filesource
 */

function smarty_resource_framework_source($tpl_name, &$tpl_source, &$smarty)
{
    $file = smarty_resource_framework_get_file($tpl_name);
    if (is_file($file)) {
        $tpl_source = $smarty->_read_file($file);
        return true;
    }

    return false;
}

function smarty_resource_framework_timestamp($tpl_name, &$tpl_timestamp, &$smarty)
{
    $file = smarty_resource_framework_get_file($tpl_name);
    if (is_file($file)) {
        $tpl_timestamp = filemtime($file);
        return true;
    }

    return false;
}

function smarty_resource_framework_secure($tpl_name, &$smarty)
{
  return true;
}

function smarty_resource_framework_trusted($tpl_name, &$smarty)
{
  return true;
}

function smarty_resource_framework_get_file($tpl_name)
{
    $module = null;
    if (preg_match('/\+/', $tpl_name)) {
        list($module, $tpl_name) = explode('+', $tpl_name);
    }

    return Framework_Template::getPath($tpl_name, $module) . '/' .$tpl_name;
}

?>
