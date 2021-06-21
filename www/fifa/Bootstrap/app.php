<?php
/**
	App 클래스 

*/
$singleTons = [];

class App {
	public static function load($nsp, ... $args){
		debug("A");
		return;
		$class= new ReflectionClass($nsp);
		$singleTons[$nsp]= isset($singleTons[$nsp])?$singleTons[$nsp]:"";
		
		if(!$singleTons[$nsp]){
			$singleTons[$nsp] = $class->newInstanceArgs($args);
			// 동적 인수를 처리하면서 생성자 생성
		}
		
		return $singleTons[$nsp];
	}
	
	/**
		지정된 경로의 파일 및 디렉토리를 재귀적으로 전부 가져오는 함수
		
		@param	String $dir 경로
		@return Array 파일 경로
	*/
	public static function getFiles($dir){
		$list =[];
		$files = glob($dir ."/*");
		//debug($files);
		
		foreach($files as $f){
			if(is_dir($f)){
				$list2= App::getFiles($f);
				if($list2){
					$list = array_merge($list, $list2);
				}
			}else {
				$pi = pathinfo($f);
				//debug($pi);
				if(strtolower($pi['extension']) == 'php') $list[]=$f;
			}
		}
		return $list;
	}
	
	/**
	Request URI에 따른 라우팅 처리
	*/
	public static function routes(){
		debug("A");
		$URI = $_SERVER['REQUEST_URI'];
		$nsp = "\\Main\\indexController";
		/*
		if($URI != '/'){
			$pos = strpos($URI, "?");
			if($pos !== false){
				$URI = substr($URI, 0 , $pos);				
			}
			$URI = explode("/", $URI);
			//debug($URI);
			if(count($URI) == 4){
				$folder = ucfirst($URI[2]);
				$className = ucfirst($URI[3])."Controller";
			}else if (count($URI) == 3){
				$folder = ucfirst($URI[2]);
				$className = "IndexController";
			}
			$nsp = "\\{$folder}\\{$className}";
		}
		if(!class_exists($nsp)) {
			header("Location:/error");
			exit;
		}
		*/
		/** 컨트롤러 페이지 렌더링 */
		/*
		$controller = self::load($nsp);
		$controller->header();
		$controller->index();
		$controller->footer();
		*/
	}// end routes
	
	/**
		view 출력 
		Board/list 가 uri로 들어오면 Views/Board/list.php 가 index에 출력됨
	*/
	public static function render($viewFile, $params=[]){
		$path = __DIR__ . "/../Views/".$viewFile.".php";
		//debug($path);
		if(!file_exists($path)) return;
		
		extract($params); // extract가 머지?
		
		// 버퍼 시작
		ob_start();
		include $path;		
		$content = ob_get_clean();
		echo $content;
		
	}
	
}