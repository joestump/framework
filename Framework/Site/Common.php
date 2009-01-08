<?php

/**
 * Framework_Site_Common
 *
 * @author Joe Stump <joe@joestump.net>
 * @copyright Joe Stump <joe@joestump.net>
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @package Framework
 * @filesource
 */

/**
 * Framework_Site_Common
 *
 * @author Joe Stump <joe@joestump.net>
 * @package Framework
 */
abstract class Framework_Site_Common
{
    /**
     * $name
     *
     * @access public
     * @var string $name Name of site, used for paths
     */
    public $name;

    /**
     * $template
     *
     * @access public
     * @var string $template Name of template to use
     */
    public $template = 'Default';

    /**
     * $options
     *
     * @access protected
     * @var array $options An array to hold various options
     */
    protected $options = array();

    /**
     * $config
     *
     * @access  public
     * @var     object Instance of SimpleXMLElement of site config
     */
    public $config = null;

    /**
     * __construct
     *
     * @access  public
     * @return  void
     */
    public function __construct()
    {
        if (file_exists($this->getPath().'/config.xml')) {
            $this->config = simplexml_load_file($this->getPath().'/config.xml');
            if (!$this->config instanceof SimpleXmlElement) {
                throw new Framework_Exception("Could not parse config.xml");
            }
        } else {
            throw new Framework_Exception("Could not load config: ".$this->getPath().'/config.xml');
        }
    }

    /**
     * Prepare the site to be ran
     *
     * @access      public
     * @return      boolean     True on success
     * @throws      Framework_Exception
     * @abstract
     */
    abstract public function prepare();

    /**
     * stop
     *
     * @access public
     * @return mixed PEAR_Error on failure, true on success
     */
    public function stop()
    {
        return true;
    }

    /**
     * __set
     *
     * @access public
     * @param string $var Variable to set in $options
     * @param mixed $val Value of $var
     * @return void
     */
    public function __set($var,$val)
    {
        $this->options[$var] = $val;
    }

    /**
     * __get
     *
     * @access public
     * @param string $var Variable to get from $options
     * @return void
     */
    public function __get($var)
    {
        if (!isset($this->options[$var])) {
            $this->options[$var] = null;
        }

        return $this->options[$var];
    }

    /**
     * getPath
     *
     * @access public
     * @return string The file system path to the templates
     */
    public function getPath()
    {
        return FRAMEWORK_BASE_PATH . '/Framework/Site/' . $this->name;
    }

    /**
     * getUriPath
     *
     * @access public
     * @return string The URI path to the sites templates directory
     */
    public function getUriPath()
    {
        $file = str_replace($_SERVER['DOCUMENT_ROOT'], '',
                            $_SERVER['SCRIPT_FILENAME']);

        $base = dirname($file);
        if ($base == '\\') {
            $base = '/';
        }

        return $base . 'Framework/Site/' . $this->name . '/Templates/' .
               $this->template;
    }
}

?>
