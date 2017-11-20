<?php namespace App\Libraries\Pagination;

class GroupUserPaginator {

	/**
	 * The items being paginated.
	 *
	 * @var array
	 */
	protected $items;

	/**
	 * The total number of items.
	 *
	 * @var int
	 */
	protected $total;

	/**
	 * The amount of items to show per page.
	 *
	 * @var int
	 */
	protected $perPage;

	/**
	 * Get the current page for the request.
	 *
	 * @var int
	 */
	protected $currentPage;

	/**
	 * Get the last available page number.
	 *
	 * @return int
	 */
	protected $lastPage;

	/**
	 * The number of the first item in this range.
	 *
	 * @var int
	 */
	protected $from;

	/**
	 * The number of the last item in this range.
	 *
	 * @var int
	 */
	protected $to;

	/**
	 * All of the additional query string values.
	 *
	 * @var array
	 */
	protected $query = array();

	/**
	 * The fragment to be appended to all URLs.
	 *
	 * @var string
	 */
	protected $fragment;

    protected $class = "pagination pagination-sm no-margin pull-right";
    protected $currentUrl = '?';
	/**
	 * Create a new Paginator instance.
	 *
	 * @param  array  $items
	 * @param  int    $total
	 * @param  int    $perPage
	 * @return void
	 */
	public function __construct(array $items, $total, $perPage, $page)
	{
		$this->items = $items;
		$this->total = (int) $total;
		$this->perPage = (int) $perPage;
		$this->currentPage = (int) $page;
	}

    public function createLinks($numberLinks) {
        $this->lastPage       = ceil( $this->total / $this->perPage );
        $this->from      = (( $this->currentPage-$numberLinks  ) > 0 ) ? $this->currentPage-$numberLinks : 1;
        $this->to        = (($this->currentPage+$numberLinks) < $this->lastPage) ? $this->currentPage+$numberLinks : $this->lastPage;

        $html       = "<ul class='{$this->class}'>";

        $class      = ( $this->currentPage == 1 ) ? "disabled" : "";
        $html       .= '<li class="prev ' . $class . '">'.$this->getCurrentLink($this->currentPage - 1, '&laquo;').'</li>';

        if ( $this->from > 1 ) {
            $html   .= '<li><a href="?limit=' . $this->perPage . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }

        for ( $i = $this->from ; $i <= $this->to; $i++ ) {
            $class  = ( $this->currentPage == $i ) ? "active" : "";
            $html   .= '<li class="' . $class . '">'.$this->getCurrentLink($i, $i).'</li>';
        }

        if ( $this->to < $this->lastPage  ) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li>'.$this->getCurrentLink($this->lastPage, $this->lastPage).'</li>';
        }

        $class      = ( $this->currentPage == $this->lastPage  ) ? "disabled" : "";
        $html       .= '<li class="next ' . $class . '">' . $this->getCurrentLink($this->currentPage + 1, '&raquo;') . '</li>';

        $html       .= '</ul>';

        return $html;
    }

    public function getCurrentLink($currentPage, $linkText) {
        $this->currentUrl = http_build_query(array_merge($_GET,array("limit"=>$this->perPage, "page"=>$currentPage,"active_tab"=>1)));
        $this->currentUrl = htmlspecialchars("?$this->currentUrl");
        return "<a href='{$this->currentUrl}'>{$linkText}</a>";
    }

    public function getItems() {
        return $this->items;
    }
}
