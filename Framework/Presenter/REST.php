<?php

/**
 * Framework_Presenter_REST
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @subpackage Presenter
 * @filesource
 */

require_once('XML/Serializer.php');

/**
 * Framework_Presenter_REST
 *
 * Want to display your module's data in valid XML rather than HTML? This
 * presenter will automatically take your data and output it in valid XML.
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 * @subpackage Presenter
 */
class Framework_Presenter_REST extends Framework_Presenter_Common
{
    /**
     * display
     *
     * Output our data array using the PEAR package XML_Serializer. This may
     * not be the optimal output you want for your REST API, but it should
     * display valid XML that can be easily consumed by anyone.
     *
     * @access public
     * @return void
     * @link http://pear.php.net/package/XML_Serializer
     */
    public function display()
    {

        $options = array(
            XML_SERIALIZER_OPTION_XML_DECL_ENABLED => true,
            XML_SERIALIZER_OPTION_XML_ENCODING => 'UTF-8',
            XML_SERIALIZER_OPTION_ROOT_NAME => 'result',
            XML_SERIALIZER_OPTION_TYPEHINTS => true,
            XML_SERIALIZER_OPTION_DEFAULT_TAG => 'item',
            XML_SERIALIZER_OPTION_INDENT => '    ');

        $xml = new XML_Serializer($options);
        $xml->serialize($this->module->getData());

        header("Content-Type: text/xml");
        echo '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
        echo $xml->getSerializedData();
    }
}

?>
