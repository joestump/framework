<?php

/**
 * Framework_Presenter_Debug
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @subpackage Presenter
 * @filesource
 */

/**
 * Framework_Presenter_Debug
 *
 * Having problems with your application? Why not switch your module's
 * presenter to 'debug' to view a bunch of useful output.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @subpackage Presenter
 */
class Framework_Presenter_Debug extends Framework_Presenter_Common
{
    /**
     * Dislay debug output
     *
     * This function displays debugging information for our module. It's a
     * good place to start when things go bonkers with your application.
     *
     * @author Joe Stump <joe@joestump.net>
     * @return void
     * @todo Add calls to display module, reflection as well.
     */
    public function display()
    {
        $vars = array('_POST','_GET','_COOKIE','_SESSION','_SERVER');
        foreach ($vars as $var) {
            $array = $$var;
            if (isset($array) && is_array($array) && count($array)) {
                  echo '<h2>$'.$var.'</h2>'."\n";
                  echo '<pre>';
                  var_dump($array);
                  echo '</pre>';
            }
        }
    }
}

?>
