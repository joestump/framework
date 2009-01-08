<?php

/**
 * Framework_Presenter_JSON
 *
 * @deprecated
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @package     Framework
 * @subpackage  Presenter
 * @filesource
 */

/**
 * Framework_Presenter_JSON
 *
 * <b>NOTE:</b> This is deprecated. You should be using the JSON controller
 * for your JSON modules instead.
 *
 * @deprecated
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Presenter
 */
class Framework_Presenter_JSON extends Framework_Presenter_Common
{
    /**
     * Display JSON output
     *
     * @access      public
     * @return      void
     */
    public function display()
    {
        header('Content-type: application/json; charset=utf-8');
        if (!function_exists('json_encode')) {
            echo <<< EOT
{
    "msg"     : "json_encode() not found",
    "info"    : "It appears php-json is not installed"
}
EOT;
        } else {
            echo json_encode($this->module->getData());
        }
    }
}

?>
