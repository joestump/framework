<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Controller_JSON
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 * @filesource
 */

/**
 * Framework_Controller_JSON
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 * @subpackage  Controller
 */
class Framework_Controller_JSON extends Framework_Controller_Web
{
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
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
            parent::stop();
        } catch (Exception $e) {
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
     * Outputs the given $data into JSON
     *
     * @access      public
     * @param       mixed       $data       Datat to serialize into XML
     * @return      mixed
     */
    private function output($data)
    {
        header('Content-type: application/json; charset=utf-8');
        if (!function_exists('json_encode')) {
            $data = new Framework_Exceptoin('json_encode() not found');
        } 

        if ($data instanceof Exception) {
            header("HTTP/1.1 500 Internal Server Error");
            $data = array('error' => $data->getMessage(),
                          'code'  => $data->getCode());
        }

        echo json_encode($data);
        exit;
    }
}

?>
