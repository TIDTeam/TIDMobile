<?php
function isMobile(){
	$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match("/(iphone|ipod|ipad|android|blackberry|phone)/", $userAgent)){
		return true;
	}else{
		return false;
	}
}
function initTidMobile(){
	if(true || isMobile()){
		require_once (ROOT . DS . 'config' . DS . 'config.php');
		require_once (ROOT . DS . 'library' . DS . 'tidinit.php');
	}
}
initTidMobile();
