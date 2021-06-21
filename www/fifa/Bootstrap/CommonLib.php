<?php
function debug($v = null)
{
	echo "<xmp style='background-color: black; color: yellow; font-size: 12px; padding: 10px; font-weight: bold;'>";
	print_r($v);
	echo "</xmp>";
}
function getConfig()
{	
	$config = [];
	$path = __DIR__ . "/../config.ini";
	if (file_exists($path)) {
		$config = parse_ini_file($path);
	}
	return $config;
}
