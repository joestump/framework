<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Framework_Pager
 *
 * @author      Joe Stump <joe@joestump.net>
 * @copyright   (c) 2005 2006 Joseph C. Stump. All rights reserved.
 * @package     Framework
 * @filesource
 */

/**
 * Framework_Pager
 *
 * @author      Joe Stump <joe@joestump.net>
 * @package     Framework
 */
class Framework_Pager
{
    /**
     * $start
     *
     * @access      public
     * @var         int             $start
     */
    public $start = 0;

    /**
     * $limit
     *
     * @access      public
     * @var         int             $limit
     */
    public $limit = 20;

    /**
     * $total
     *
     * @access      public
     * @var         int             $total
     */
    public $total = 0;

    /**
     * $pages
     *
     * The number of pages to return. If you only want to show 5 pages in your
     * listing set this to 5. You can set this as the 4th parameter in the
     * constructor
     *
     * @access      public
     * @var         int             $pages
     */
    public $pages = 5;

    /**
     * $totalPages
     *
     * The total number of pages for the given listing. For instance if your
     * query has a total of 150 records and your limit is 10 then this variable
     * would hold 15.
     *
     * @access      protected
     * @var         int             $totalPages
     * @var         int             $totalPages
     */
    protected $totalPages = 0;

    /**
     * getNextPage
     *
     * Returns the $start value for your LIMIT clause for the next page.
     *
     * @access      public
     * @return      int
     */
    public function getNextPage()
    {
        if (($this->start + $this->limit) > $this->total) {
            $nextPage = 0;
        } else {
            $nextPage = ($this->start + $this->limit);
        }

        return $nextPage;
    }

    /**
     * getPrevPage
     *
     * Returns the $start value for your LIMIT clause for the previous page.
     *
     * @access      public
     * @return      int
     */
    public function getPrevPage()
    {
        if ($this->start == 0) {
            $prevPage = 0;
        } else {
            $prevPage = ($this->start - $this->limit);
        }

        return $prevPage;
    }

    /**
     * getPageList
     *
     * Returns the page list as an array keyed by the page number with the
     * value of the $start variable.
     *
     * @access      public
     * @return      array
     */
    public function getPageList()
    {
        $totalPages = $this->totalPages = (int)ceil(($this->total / $this->limit));
        $startPage  = (ceil(($this->start / $this->limit)) + 1);
        $endPage    = $totalPages;
        $listStart  = ceil($startPage - ($this->pages / 2));
        $listEnd    = floor($startPage + ($this->pages / 2));

        if ($listEnd > $totalPages) {
            $listStart = ($totalPages - ($this->pages - 1));
            $listEnd = $totalPages;
        }

        if (($listEnd - abs($listStart)) < ($this->pages - 1)) {
            $listEnd = $this->pages;
        }

        if($listStart < 1) {
            $listStart = 1;
        }

        $arr = array();
        for ($i = $listStart ; $i <= $listEnd ; ++$i) {
            if ($i > $totalPages) {
                break;
            }

            $arr[$i] = (($i - 1) * $this->limit);
        }

        return $arr;
    }

    /**
     * getBeginning
     *
     * Returns the $start for the very first page.
     *
     * @access      public
     * @return      int
     */
    public function getBeginning()
    {
        return 0;
    }

    /**
     * getEnd
     *
     * Returns the $start for the very last page.
     *
     * @access public
     * @return int
     */
    public function getEnd()
    {
        return (($this->totalPages * $this->limit) - $this->limit);
    }
}

?>
