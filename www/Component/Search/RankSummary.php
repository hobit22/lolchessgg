<?php

namespace Component\Search;

use App;


class RankSummary
{	
	public function getRankInfo($summonerId){
		$config = getConfig();
		$api_key = "{$config['api_key']}";
		

        $url = "https://kr.api.riotgames.com/tft/league/v1/entries/by-summoner/".$summonerId."?api_key=".$api_key;

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
		//debug($data);
		
		return $data[0];
	}
}