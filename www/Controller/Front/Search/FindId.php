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
		
		$userInfo = $FindId->get($in['userId']);
		
		if($result === false) {
			msg("유저 아이디가 존재하지 않습니다.", -1);
			return;
		}
		
		App::render("Search/findId", $userInfo);
		
		$userId = $userInfo['name'];
		$match = $FindId->getMatch($userInfo['puuid']);
		if($match === false){
			App::render("Search/noMatchData");
			return;
		}
		$Rank = App::load(\Component\Search\RankSummary::class);
		$rankInfo = $Rank->getRankInfo($userInfo['id']);
		//debug($rankInfo);
		if($result === false) {
		}else{
			App::render("Search/rank", $rankInfo);
		}
		
		$Match = App::load(\Component\Search\MatchSummary::class);
		
		for($i =0; $i<1; $i++){
			$matchInfo = $Match->getMatchInfo($match[$i], $userId);
			//debug($matchInfo);
			if($matchInfo === false ) {
				msg("데이터에 접근할 수 없습니다.", -1);
			}
			$pos = $matchInfo['pos'];
			App::render("Search/match", $matchInfo);
		}
		
	}
}