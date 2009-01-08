<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller_REST
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Social Platform, LLC. All rights reserved.
 * @package     Framework
 * @subpackage  Controller
 * @filesource
 */

require_once 'XML/Serializer.php';

/**
 * Framework_Controller_REST
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 */
class Framework_Controller_REST extends Framework_Controller_Web
{
    /**
     * $options
     *
     * @access      protected
     * @var         array       $options
     * @link        http://pear.php.net/package/XML_Serializer
     */
    protected $options = array(
        XML_SERIALIZER_OPTION_INDENT => '    ',
        XML_SERIALIZER_OPTION_RETURN_RESULT => true,
        XML_SERIALIZER_OPTION_TYPEHINTS => true,
        XML_SERIALIZER_OPTION_XML_DECL_ENABLED => true,
        XML_SERIALIZER_OPTION_DEFAULT_TAG => 'node',
        XML_SERIALIZER_OPTION_INDENT_ATTRIBUTES => true,
        XML_SERIALIZER_OPTION_ROOT_NAME => 'response'
    );

    /**
     * $serializer
     *
     * An instance of XML_Serializer, which is used to serialize the module
     * data and errors into XML.
     *
     * @access      protected
     * @var         object      $serlializer
     * @link        http://pear.php.net/package/XML_Serializer
     */
    protected $serializer = null;

    /**
     * __construct
     *
     * @access      public
     * @return      void
     */
    public function __construct()
    {
        parent::__construct();
        $this->serializer = new XML_Serializer($this->options);
    }

    /**
     * module
     *
     * @access      public
     * @return      mixed
     */
    public function module()
    {
        try {
            return parent::module();
        } catch (Framework_Exception $e) {
            $this->output($result);
        }
    }

    /**
     * authenticate
     *
     * @access      public
     * @return      mixed
     */
    public function authenticate()
    {
        try {
            return parent::authenticate();
        } catch (Framework_Exception $e) {
            $this->output($result);
        }
    }

    /**
     * start
     *
     * @access      public
     * @return      mixed
     */
    public function start()
    {
        try {
            return parent::start();
        } catch (Framework_Exception $e) {
            $this->output($result);
        }
    }

    /**
     * stop
     *
     * @access      public
     * @return      mixed
     */
    public function stop()
    {
        try {
            return parent::stop();
        } catch (Framework_Exception $e) {
            $this->output($result);
        }
    }

    /**
     * display
     *
     * @access      public
     * @return      mixed
     */
    public function display()
    {
        try {
            $this->run();
            $result = Framework::$module->getData();
        } catch (Framework_Exception $result) {

        }

        $this->output($result);
    }

    /**
     * Outputs the given $data into XML using XML_Serializer
     *
     * @access      public
     * @param       mixed       $data       Datat to serialize into XML
     * @return      mixed
     * @see         Framework_Controller_REST::$serializer
     */
    private function output($data)
    {
        header("Content-Type: text/xml");
        if ($data instanceof Framework_Exception) {
            $data = array('error' => $data->getMessage(),
                          'code'  => $data->getCode());
        }

        echo $this->serializer->serialize($data);
        exit;
    }
}

?>
