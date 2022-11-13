<?php
class  ABCFSL_Paginator
{
    const NUM_PLACEHOLDER = '(:num)';

    protected $totalItems;
    protected $maxPgNo;
    protected $itemsPerPage;
    protected $currentPage;
    protected $urlPattern;    
    protected $maxPgsToShow = 10; 
    protected $pgnationSize = 'SM';
    protected $justify = 'R';
    protected $activeBkgColor = 'B';
    protected $pfix;
    protected $ajax;
    //sr-only screen reader


    /**
     * param string $urlPattern A URL for each page, with (:num) as a placeholder for the page number. Ex. '/foo/page/(:num)'
     */
    public function __construct( $par ) {

        $this->pfix = $par['pfix'];
        $this->ajax = $par['ajax'];
        $this->totalItems = $par['totalQty'];
        $this->itemsPerPage = $par['pgQty'];
        $this->urlPattern = $par['urlPattern'];
        $this->justify = $this->pfix . 'Justify_' . $par['justify'];
        $this->pgnationSize = $this->pfix . 'Pagination_' . $par['pgnationSize'];
        $this->activeBkgColor = $this->pfix . 'PageLink_' . $par['pgnationColor'];

        $this->setMaxPgNo();
        $this->setCurrentPage( $par['currentPage'] );
        $this->setMaxPagesToShow( $par['maxPgsToShow'] );
    }

    public function __toString() {
        return $this->toHtml();
    }

    //==================================================
    public function toHtml() {

        if ( $this->maxPgNo <= 1 ) {  return ''; }
        $ulCls = trim( $this->pfix . 'Pagination ' . $this->pgnationSize . ' ' . $this->justify );

        $html = '<nav><ul class="' . $ulCls . '">';

        if( $this->ajax > 0 ){
            $html .= $this->html_prev_ajax();
            $html .= $this->html_pgs_ajax();
            $html .= $this->html_next_ajax();
        }
        else {
            $html .= $this->html_prev();
            $html .= $this->html_pgs();
            $html .= $this->html_next();
        }
        $html .= '</ul></nav>';

        return $html;
    }

    //<a class="abcfslPageLink abcfslPageLink_B" href="#" data-pgno="2">2</a>
    //<a class="abcfslPageLink abcfslPageLink_B" href="http://localhost:8080/blog/template-6336-menu-mfp-7302-custom-cbo-no-ajax/?page=2">2</a>

//============================================================
    public function html_prev(){

        $html = '';
        if ( $this->getPrevUrl() ) {

            $html .= '<li class="' . $this->pfix . 'PageItem">' .
                '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $this->getPrevUrl() . '" aria-label="Previous">' .
                '<span aria-hidden="true">&laquo;</span>' .
                '<span class="sr-only">Previous</span>' .
                '</a></li>';
        }
        return $html;
    }

    public function html_next(){

        $html = '';
        if ( $this->getNextUrl() ) {

            $html .= '<li class="' . $this->pfix . 'PageItem">' .
                '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $this->getNextUrl() . '" aria-label="Next">' .
                '<span aria-hidden="true">&raquo;</span>' .
                '<span class="sr-only">Next</span>' .
                '</a></li>';
        }
        return $html;
    }

    public function html_pgs(){
        $html = '';

        foreach ( $this->getPages() as $page ) {

            if ( $page['isCurrent']  ) {
                $html .= '<li class="' . $this->pfix . 'PageItem ' . $this->pfix . 'Active">' .
                            '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $page['url'] . '">' . $page['num'] . '<span class="sr-only">(current)</span></a>' .
                        '</li>';
            }
            else {
                if ( $page['url'] ) {
                        $html .= '<li class="' . $this->pfix . 'PageItem">' .
                                    '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="' . $page['url'] . '">' . $page['num'] . '</a>' .
                                '</li>';
                    } else {
                        $html .= '<li class="' . $this->pfix . 'PageItem ' . $this->pfix . 'Disabled"><span class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '">' . $page['num'] . '</span></li>';
                }
            }
        }
        return $html;
    }
    //=== AJAX START ============================
    public function html_prev_ajax(){

        $html = '';
        if ( $this->getPrevUrl() ) {

            $html .= '<li class="' . $this->pfix . 'PrevPg">' .
                '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="#"' .
                    ' aria-label="Previous"' .
                    ' data-pgno = "' . $this->prevPgNo() . '">' .
                '<span aria-hidden="true">&laquo;</span>' .
                '<span class="sr-only">Previous</span>' .
                '</a></li>';
        }
        return $html;
    }

    public function html_next_ajax(){

        $html = '';
        if ( $this->getNextUrl() ) {

            $html .= '<li class="'  . $this->pfix . 'NextPg">' .
                '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="#"' .
                    ' aria-label="Next"' .
                    ' data-pgno = "' . $this->nextPgNo() . '">' .
                '<span aria-hidden="true">&raquo;</span>' .
                '<span class="sr-only">Next</span>' .
                '</a></li>';
        }
        return $html;
    }

    public function html_pgs_ajax(){
        $html = '';

        foreach ( $this->getPages() as $page ) {

            if ( $page['isCurrent']  ) {
                $html .=  $this->html_pgs_ajax_number_current( $page );
            }
            else {
                    if ( $page['url'] ) {
                        $html .=  $this->html_pgs_ajax_number_not_current( $page );
                    } 
                    else {
                        $html .=  $this->html_pgs_ajax_number_ellipsis( $page );
                    }
                }
        }
        return $html;
    }

    public function html_pgs_ajax_number_current( $page ){

        return '<li class="' . $this->pfix . 'PageItem ' . $this->pfix . 'Active">' .
                    '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="#"' .
                            ' data-pgno = "' . $page['num'] . '">' .
                            $page['num'] .
                            '<span class="sr-only">(current)</span>' .
                    '</a>' .
                '</li>';
    }

    public function html_pgs_ajax_number_not_current( $page ){

        return '<li class="' . $this->pfix . 'PageItem">' .
                    '<a class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '" href="#"' .
                        ' data-pgno = "' . $page['num'] . '">' .
                        $page['num'] .
                    '</a>' .
                '</li>';
    }

    public function html_pgs_ajax_number_ellipsis( $page ){

        return '<li class="' . $this->pfix . 'PageItem ' . $this->pfix . 'Disabled">' . 
                    '<span class="' . $this->pfix . 'PageLink ' . $this->activeBkgColor . '">' 
                        . $page['num'] . 
                    '</span>' . 
                '</li>';
    }
    //=== AJAX END =====================================================

    protected function setCurrentPage( $currentPage ) {

        if( empty( $currentPage ) ){
             $this->currentPage = 1;
             return;
        }

        if( !is_numeric( $currentPage ) ){
             $this->currentPage = 1;
             return;
        }

        if( !ctype_digit( (string)$currentPage ) ){
             $this->currentPage = 1;
             return;
        }

        if( $currentPage > $this->maxPgNo ){
             $this->currentPage = 1;
             return;
        }

        $this->currentPage = $currentPage;
    }

    protected function setMaxPgNo() {
        $this->maxPgNo = ($this->itemsPerPage == 0 ? 0 : (int) ceil($this->totalItems/$this->itemsPerPage));
    }
    //----------------------------------------

    public function setMaxPagesToShow( $maxPgsToShow ) {
        if ($maxPgsToShow < 3) { $maxPgsToShow = 3; }
        $this->maxPgsToShow = $maxPgsToShow;
    }

    public function getPageUrl( $pageNum ) {
        return str_replace( self::NUM_PLACEHOLDER, $pageNum, $this->urlPattern );
    }

    public function getNextPage() {
        if ($this->currentPage < $this->maxPgNo) {
            return $this->currentPage + 1;
        }
        return null;
    }

    public function getPrevPage()
    {
        if ($this->currentPage > 1) {
            return $this->currentPage - 1;
        }

        return null;
    }

    public function getNextUrl()    {
        if (!$this->getNextPage()) {
            return null;
        }
        return $this->getPageUrl( $this->getNextPage() );
    }

    public function getPrevUrl()  {

        if (!$this->getPrevPage()) { return null; }
        return $this->getPageUrl( $this->getPrevPage() );
    }

    public function nextPgNo() {
        if (!$this->getNextPage()) { return null; }
        return $this->getNextPage();
    }

    public function prevPgNo() {
        if (!$this->getPrevPage()) { return null; }
        return $this->getPrevPage();
    }

    /**
     * Get an array of paginated page data. Returns array. Example:
     * array(
     *     array ('num' => 1,     'url' => '/example/page/1',  'isCurrent' => false),
     *     array ('num' => '...', 'url' => NULL,               'isCurrent' => false),
     *     array ('num' => 3,     'url' => '/example/page/3',  'isCurrent' => false),
     *     array ('num' => 4,     'url' => '/example/page/4',  'isCurrent' => true ),
     *     array ('num' => 5,     'url' => '/example/page/5',  'isCurrent' => false),
     *     array ('num' => '...', 'url' => NULL,               'isCurrent' => false),
     *     array ('num' => 10,    'url' => '/example/page/10', 'isCurrent' => false),
     * )
     */
    public function getPages() {

        $pages = array();

        if ($this->maxPgNo <= 1) {
            return array();
        }

        if ( $this->maxPgNo <= $this->maxPgsToShow ) {
            for ($i = 1; $i <= $this->maxPgNo; $i++) {
                $pages[] = $this->createPage( $i, $i == $this->currentPage);
            }
            return $pages;
        }

        if ( $this->maxPgsToShow < 5 ) {

            $pages[] = $this->createPage(1, $this->currentPage == 1);

            $smallStart = $this->maxPgsToShow - 2;
            $smallEnd = $this->maxPgNo - 1;

            if( $smallStart > 0 ) {
                for ($is = 2; $is <= $smallEnd; $is++) {
                    $pages[] = $this->createPage($is, $is == $this->currentPage);
                }
            }

            $pages[] = $this->createPage($this->maxPgNo, $this->currentPage == $this->maxPgNo);  
            return $pages;
        }

        // Determine the sliding range, centered around the current page.
        $numAdjacents = (int) floor(($this->maxPgsToShow - 3) / 2);

        if ($this->currentPage + $numAdjacents > $this->maxPgNo) {
            $slidingStart = $this->maxPgNo - $this->maxPgsToShow + 2;
        } else {
            $slidingStart = $this->currentPage - $numAdjacents;
        }

        if ($slidingStart < 2) { $slidingStart = 2; }

        $slidingEnd = $slidingStart + $this->maxPgsToShow - 3;
        if ($slidingEnd >= $this->maxPgNo) { $slidingEnd = $this->maxPgNo - 1; }

        // Create list of pages.
        $pages[] = $this->createPage(1, $this->currentPage == 1);

        if ($slidingStart > 2) {
            $pages[] = $this->createPageEllipsis();
        }

        for ($i = $slidingStart; $i <= $slidingEnd; $i++) {
            $pages[] = $this->createPage($i, $i == $this->currentPage);
        }

        if ($slidingEnd < $this->maxPgNo - 1) {
            $pages[] = $this->createPageEllipsis();
        }

        $pages[] = $this->createPage($this->maxPgNo, $this->currentPage == $this->maxPgNo);
        

        return $pages;
    }

        /**
     * Create a page data structure.
     *
     * @param int $pageNum
     * @param bool $isCurrent
     * @return Array
     */
    protected function createPage( $pageNum, $isCurrent = false )
    {
        return array(
            'num' => $pageNum,
            'url' => $this->getPageUrl($pageNum),
            'isCurrent' => $isCurrent,
        );
    }

    /**
     * @return array
     */
    protected function createPageEllipsis()
    {
        return array(
            'num' => '...',
            'url' => null,
            'isCurrent' => false,
        );
    }
}