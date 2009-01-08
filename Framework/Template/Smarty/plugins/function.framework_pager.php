<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * function.framework_pager.php
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @package     Framework
 * @subpackage  Template
 * @filesource
 */

/**
 * smarty_function_framework_pager
 *
 * @author      Joe Stump <joe@joestump.net>
 * @param       array       $params
 * @param       object      $smarty
 * @package     Framework
 * @subpackage  Template
 */
function smarty_function_framework_pager($params, &$smarty)
{
    $required = array('start', 'limit', 'total');
    foreach ($required as $r) {
        if (!isset($params[$r])) {
            $smarty->trigger_error("framework_pager: missing '$r' parameter");
        }
    }

    extract($params);
    if ($total <= $imit) {
        return true;
    }

    $pageTotal = ($pages > 0) ? $pages : 10;

    // Prep the URL string we use. We can't keep "start" in the URL because
    // it will confuse scripts.
    if ($params['url']) {
        $url = $params['url'];
    } else {
        $url  = $_SERVER['SCRIPT_NAME'].$_SERVER['PATH_INFO'];
    }

    $sets = array();
    foreach ($_GET as $key => $val) {
        if ($key == 'start') {
            continue;
        }

        if (strlen($key) && strlen($val)) {
            if(!ereg($key."=",$_SERVER['PATH_INFO']) && !eregi('\?',$val)) {
                if (is_array($val)) {
                    for($i = 0 ; $i < count($val) ; ++$i) {
                        $sets[] = $key.'[]='.$val[$i];
                    }
                } else {
                    $sets[] = $key.'='.$val;
                }
            }
        }
    }

    $s = '?';
    if (count($sets)) {
        $url .= '?'.implode('&amp;',$sets);
        $s = '&amp;';
    }

    // Only output if we have more than one page to show
    $nav = & new Framework_Pager();
    $nav->start = $start;
    $nav->limit = $limit;
    $nav->total = $total;
    $nav->pages = $pageTotal;

    if (($start + $limit) > $total) {
        $stop = $total;
    } else {
        $stop = ($start + $limit);
    }

    $tpl = Framework_Template::factory('Smarty', 'Framework');
    $tpl->assign('nav', $nav);
    $tpl->assign('params', $params);
    $tpl->assign('stop', $stop);
    $tpl->assign('s', $s);
    $tpl->assign('url', $url);
    $tpl->display('framework_pager.tpl');
}

?>
