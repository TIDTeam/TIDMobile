<?php
class IndexController extends Controller {
	function getArtileTypeById($articleType){
		switch ($articleType){
			case 3 : //交互设计
				$articleTypeTxt = "ID";
				$articleTypeTitle = "交互设计文章";
				break;
			case 4 : //前端开发
				$articleTypeTxt = "FD";
				$articleTypeTitle = "前端开发文章";
				break;
			case 5 : //视觉设计
				$articleTypeTxt = "VD";
				$articleTypeTitle = "视觉设计文章";
				break;
			case 6 : //页面重构
				$articleTypeTxt = "RD";
				$articleTypeTitle = "页面重构文章";
				break;
			case 7 : //团队生活
				$articleTypeTxt = "FD";
				$articleTypeTitle = "团队生活文章";
				break;
			case 8 ://用户研究
				$articleTypeTxt = "FD";
				$articleTypeTitle = "用户研究文章";
				break;
			default:
				$articleTypeTxt = "FD";
				$articleTypeTitle = "用户研究文章";
		}
		return $articleTypeTitle;
	}
	function fileterXSS($val){
		    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed  
		   // this prevents some character re-spacing such as <java\0script>  
		   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs  
		   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);  
		      
		   // straight replacements, the user should never need these since they're normal characters  
		   // this prevents like <IMG SRC=@avascript:alert('XSS')>  
		   $search = 'abcdefghijklmnopqrstuvwxyz'; 
		   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  
		   $search .= '1234567890!@#$%^&*()'; 
		   $search .= '~`";:?+/={}[]-_|\'\\'; 
		   for ($i = 0; $i < strlen($search); $i++) { 
		      // ;? matches the ;, which is optional 
		      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars 
		     
		      // @ @ search for the hex values 
		      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ; 
		      // @ @ 0{0,7} matches '0' zero to seven times  
		      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ; 
		   } 
		     
		   // now the only remaining whitespace attacks are \t, \n, and \r 
		   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base'); 
		   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload'); 
		   $ra = array_merge($ra1, $ra2); 
		     
		   $found = true; // keep replacing as long as the previous round replaced something 
		   while ($found == true) { 
		      $val_before = $val; 
		      for ($i = 0; $i < sizeof($ra); $i++) { 
		         $pattern = '/'; 
		         for ($j = 0; $j < strlen($ra[$i]); $j++) { 
		            if ($j > 0) { 
		               $pattern .= '(';  
		               $pattern .= '(&#[xX]0{0,8}([9ab]);)'; 
		               $pattern .= '|';  
		               $pattern .= '|(&#0{0,8}([9|10|13]);)'; 
		               $pattern .= ')*'; 
		            } 
		            $pattern .= $ra[$i][$j]; 
		         } 
		         $pattern .= '/i';  
		         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag  
		         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags  
		         if ($val_before == $val) {  
		            // no replacements were made, so exit the loop  
		            $found = false;  
		         }  
		      }  
		   }  
		   return $val;
	}
	function index($begin) {
		$sql =  new SQLQuery();
		$result = $sql->queryArticleList($begin);
		$datainfo = array();
		foreach ($result as $item){
			$user_avatar = $sql->queryUserPhoto($item['author']);
			$user_name = $sql->queryUserName($item['author']);
			$articleType = $sql->queryArticleType($item['id']);
			$articleImg = $sql->queryArticleLogo($item['id']);
			$like_count = $sql->queryArticleCommCount($item['id']);
			switch ($articleType){
				case 3 : //交互设计
					$articleTypeTxt = "ID";
					$articleTypeTitle = "交互设计文章";
					break;
				case 4 : //前端开发
					$articleTypeTxt = "FD";
					$articleTypeTitle = "前端开发文章";
					break;
				case 5 : //视觉设计
					$articleTypeTxt = "VD";
					$articleTypeTitle = "视觉设计文章";
					break;
				case 6 : //页面重构
					$articleTypeTxt = "RD";
					$articleTypeTitle = "页面重构文章";
					break;
				case 7 : //团队生活
					$articleTypeTxt = "FD";
					$articleTypeTitle = "团队生活文章";
					break;
				case 8 ://用户研究
					$articleTypeTxt = "FD";
					$articleTypeTitle = "用户研究文章";
					break;
				default:
					$articleTypeTxt = "FD";
					$articleTypeTitle = "用户研究文章";
			}
			$item['user_avatar'] = $user_avatar;
			$item['user_name'] = $user_name;
			$item['article_type'] = $articleTypeTxt;
			$item['article_title'] = $articleTypeTitle;
			$item['guid'] = $articleImg;
			$item['like_count'] = $like_count;
			$item['atype_index'] = $articleType;
			array_push($datainfo, $item);
		}
		$this->set('data', $datainfo);
	}
	function likeit($postId, $ip){
		if(!$postId){
			return true;
		}
		$sql =  new SQLQuery();
		$sql->likeTheArticle($postId, $ip);
	}
	function article($postId,$atype,$username){
		if(!$postId){
			return true;
		}
		$articleType = $this->getArtileTypeById($atype);
		$sql =  new SQLQuery();
		$result = $sql->queryArticleById($postId);
		$comments = $sql->queryCommentById($postId);
		$commlist = array();
		foreach ($comments as $item){
				$item['user_avatar'] = $sql->queryUserPhoto($item['user_id']);
				$item['user_name']  = $sql->queryUserName($item['user_id']);
				array_push($commlist, $item);
		}
		$result['atype'] = $articleType;
		$result['username'] = $this->fileterXSS($username);
		$this->set('data', $result);
		$this->set('comments',$commlist);
	}
}
