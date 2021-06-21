<?php

namespace Controller\Front\Search;

use App;
/**
* 전적 검색
*
*/
class FindIdController extends \Controller\Front\Controller
{
	public function __construct()
	{
		$this->layoutBlank = true;
	}
	public function index()
	{
		
		$in = request()->all();
		
		$FindId = App::load(\Component\Search\FindId::class);
		
		$result = $FindId->get($in['userId']);
		
		App::render("/Search/FindId", $data);
	}
}