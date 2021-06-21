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
		
		$this->addCss(["match"])
			  ->addScript(["match"]);
	}
	public function index()
	{	
		$in = request()->all();
		
		$FindId = App::load(\Component\Search\FindId::class);
		
		$result = $FindId->get($in['userId']);
		
		App::render("Search/findId", $result);
		
		$userId = $result['name'];
		$match = $FindId->getMatch($result['puuid']);
		
		$Match = App::load(\Component\Search\MatchSummary::class);
		
		for($i =0; $i<sizeof($match); $i++){
			$matchInfo = $Match->getMatchInfo($match[$i], $userId);
			$pos = $matchInfo['pos'];
			App::render("Search/match", $matchInfo);
		}
	}
}