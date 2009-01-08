<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Site_Tests
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @filesource
 */


/**
 * Framework_Site_Tests
 *
 * Framework allows you to run multiple sites with multiple templates and
 * modules. Each site needs it's own site driver. You can use this to house
 * centrally located/needed information and such.
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   Joe Stump <joe@joestump.net>
 * @package     Framework
 * @filesource
 */
class Framework_Site_Tests extends Framework_Site_Common
{
    /**
     * $name
     *
     * @access      public
     * @var         string      $name       Name of site driver
     */
    public $name = 'Tests';

    /**
     * prepare
     *
     * This function is ran by Framework right after loading up the site
     * driver. It's a good place to put initialization type code that is
     * globally required throughout your site.
     *
     * @access      public
     * @return      mixed
     */
    public function prepare()
    {

    }
}

?>
