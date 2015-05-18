<?php

/** Check if environment is development and display errors **/

function setReporting() {
if (DEVELOPMENT_ENVIRONMENT == true) {
	error_reporting(E_ALL);
	ini_set('display_errors','On');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
	$_GET    = stripSlashesDeep($_GET   );
	$_POST   = stripSlashesDeep($_POST  );
	$_COOKIE = stripSlashesDeep($_COOKIE);
}
}

/** Check register globals and remove them **/

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}


/**
 *  添加worpress返回监听事件
 */
function initWordPress(){
	add_action('template_redirect', 'callHook');
}

function initJsonType(){
	global $queryString;
	global $jsonType;
	global $tjson;
	$urlArray = array();
	parse_str($queryString,$urlArray);
	if(array_key_exists($tjson, $urlArray)){
		$jsonType = true;
	}
}

/** Main Call Function **/

function callHook() {
	global $queryString;
	parse_str($queryString,$urlArray);
	$begin = 0;
	$like_type = '';
	$p_id = '';
	if($urlArray){
		$begin =isset($urlArray['begin']) ? $urlArray['begin'] : '' ;
		$like_type =isset($urlArray['liketype']) ? $urlArray['liketype'] : '';
		$p_id = isset($urlArray['p']) ? $urlArray['p'] : '';
	}
	if(!$p_id){ //文章列表
		$indexControl = new indexcontroller("", "index", "index");
		if($like_type){
			$postId = $urlArray['postid'];
			$ip=$_SERVER["REMOTE_ADDR"];
			$indexControl->likeit($postId, $ip);
		}else{
			$indexControl->index($begin);
		}
	}
	if($p_id){
		$atype = isset($urlArray['atype']) ? $urlArray['atype'] : '';
		$username = isset($urlArray['username']) ? $urlArray['username'] : '';
		$indexControl = new indexcontroller("", "index", "article");
		$indexControl->article($p_id,$atype,$username);
	}
	
	exit;
}

/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
initJsonType();
initWordPress();
