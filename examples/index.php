<?php

/**
 * index.php
 *
 * An example controller to use with Framework. Copy this file into your
 * website's document root to use.
 *
 * @author Joe Stump <joe@joestump.net>
 * @filesource
 */

/**
 * FRAMEWORK_BASE_PATH
 *
 * Dynamically figure out where in the filesystem we are located.
 *
 * @author Joe Stump <joe@joestump.net>
 * @global string FRAMEWORK_BASE_PATH Absolute path to our framework
 */
define('FRAMEWORK_BASE_PATH', dirname(__FILE__));

try {
    require_once 'Framework.php';

    // Load the Framework_Site_Example class and initialize modules, run
    // events, etc. You could create an array based on $_SERVER['SERVER_NAME']
    // that loads up different site drivers depending on the server name. For
    // instance, www.foo.com and foo.com load up Framework_Site_Foo, while
    // www.bar.com, www.baz.com, baz.com, and bar.com load up Bar
    // (Framework_Site_Bar).
    //
    // The second argument is the controller. Not all modules will support all
    // controllers. If that's the case an appropriate error will be output.
    Framework::start('Example', $_GET['controller']);

    // Run shutdown functions and stop the Framework
    Framework::stop();
} catch (Framework_Exception $error) {
    switch ($error->getCode()) {
    case FRAMEWORK_ERROR_AUTH:
        // Redirect to your login page here?
        // $pg = urlencode($_SERVER['REQUEST_URI']);
        // header("Location: /Web/Login?pg=$pg");
        // break;
    default:
        // If a PEAR error is returned usually something catastrophic
        // happend like an event returning a PEAR_Error or throwing an
        // exception of some sort.
        echo $error->getMessage();
    }

} catch (Exception $error) {
    echo $error->getMessage();
}

?>
