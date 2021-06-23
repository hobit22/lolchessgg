<?php

namespace Component\Search;

use App;


class MatchSummary
{	
	public function getMatchInfo($matchId, $userId){
		$config = getConfig();
		$api_key = "{$config['api_key']}";
		
        $url = "https://asia.api.riotgames.com/tft/match/v1/matches/".$matchId."?api_key=".$api_key;

        $is_post = false;
        $ch = curl_init();
		
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status_code != 200) return false;
        curl_close($ch);
		
        $result = json_decode($response, true);
		$data = $result;
		
		$FindId = App::load(\Component\Search\FindId::class);
		$pos = 0;
		for($i =0; $i<8; $i++){
			$userInfo = $FindId->byPuuid($data['metadata']['participants'][$i]);
			$data['metadata']['participants'][$i] = $userInfo['name'];
			$data['info']['participants'][$i]['name'] = $userInfo['name'];
			if($userId == $userInfo['name']) $pos = $i;
		}
		
		for($i=0;$i<8;$i++){
			$data['info']['participants'][$i]['traits'] = array_sort( $data['info']['participants'][$i]['traits'], 'tier_current', SORT_DESC) ;
			$data['info']['participants'][$i]['units'] = array_sort( $data['info']['participants'][$i]['units'], 'tier', SORT_DESC) ;
			$data['info']['participants'] = array_sort( $data['info']['participants'], 'placement', SORT_ASC);
		}
		
		
		$data['pos']= $pos;
		
		return $data;
	}
}