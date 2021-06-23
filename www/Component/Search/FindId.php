<?php

namespace Component\Search;

use App;
use Component\Exception\Member\MemberRegisterException;
use Component\Exception\Member\MemberException;

class FindId
{
	private $params = []; // 처리할 데이터 
	private $exception = "";
	
	/** 회원 필수 데이터 컬럼 */
	private $requiredColumns = [
		'userId' => '유저 아이디',
	];
	
	
	/**
	* 처리할 데이터 설정 
	*
	* @param Array $params 
	* @return $this
	*/
	public function data($params = [])
	{
		$this->params = $params;
		//debug($this);
		return $this;
	}
	
	/**
	* 회원정보 조회
	*
	* @param Integer|String 숫자 - 회원번호, 문자 - 아이디 
	* @return Array
	*/
	public function get($userId)
	{
		$userInfo = $this->byId($userId);
		if($userInfo === false) return false;
		$data = $userInfo;
		/**
		$puuid = $userInfo['puuid'];
		$match = $this->getMatch($puuid);
		debug($match);
		$data ['matchData']= $match;
		*/
		
		return $data;
	
	}
	/** 
		유저 정보 아이디로 조회
		
		@param String 유저아이디
		@return Array
	*/
	public function byId($userId){
		$config = getConfig();
		$api_key = "{$config['api_key']}";
		
		$summoner_name = urlencode($userId);
        
        $url = "https://kr.api.riotgames.com/lol/summoner/v4/summoners/by-name/".$summoner_name."?api_key=".$api_key;
        $is_post = false;
        $ch = curl_init();
		
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status_code == 200){
			curl_close($ch);
			
			$result = json_decode($response, true);
			return $result;
		}
		return false;
		
	}
	/** 
		유저 정보 puuid로 조회
		
		@param String puuid
		@return Array
	*/
	public function byPuuid($userId){
		$config = getConfig();
		$api_key = "{$config['api_key']}";
		
		$puuId = urlencode($userId);
        
        $url ="https://kr.api.riotgames.com/tft/summoner/v1/summoners/by-puuid/".$puuId."?api_key=".$api_key;
        $is_post = false;
        $ch = curl_init();
		
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status_code == 200){
			curl_close($ch);
			
			$result = json_decode($response, true);
			return $result;
		}
		return false;
		
	}
	
	
	/** 
		매치 기록 조회
		
		@param String 	유저 puuid
		@param Integer 	count 
		@return Array
	*/
	public function getMatch($puuid , $count = 20){
        $config = getConfig();
		$api_key = "{$config['api_key']}";
		
        $url = "https://asia.api.riotgames.com/tft/match/v1/matches/by-puuid/".$puuid."/ids?count=".$count."&api_key=".$api_key;
        $is_post = false;
        $ch = curl_init();
		
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($status_code == 200){
			curl_close($ch);
			
			$result = json_decode($response, true);
			foreach( $result as $a ){
				if( substr($a,3,1) != 5) {
					array_shift($result);
				}
			}
			
			if ( !empty($result) ) return $result;
			return false;
		}
		return false;
		
	}
	
	
}