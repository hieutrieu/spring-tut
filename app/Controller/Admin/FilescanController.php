<?php

namespace App\Controller\Admin;

use App\Libraries\Pagination\Paginator;
use App\Models\FileScan;
use Framework\Input;

class FilescanController extends AdminController
{
	public function __construct()
	{
		parent::__construct(); // TODO: Change the autogenerated stub
		$this->setTitle('File scans');
	}

	public function index()
	{
		$page = intval(Input::get('page', 0));
		$conditions = array();
		$search = Input::get("search");
		if ($search != '') {
			$conditions[] = "( status LIKE '%{$search}%' OR name LIKE '%{$search}%' )";
		}
		$condition = implode(" AND ", $conditions);
		$items = FileScan::getInstance()->getAll($condition, $page, 50, "FIELD(status,'processing','waiting','failed'), id ASC");
		$pager = new Paginator($items['items'], $items['total'], 50, $page);
		return $this->render('admin.filescan.index')->with(['pager' => $pager, 'search' => $search]);
	}
}