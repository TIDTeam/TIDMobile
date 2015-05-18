<?php

class SQLQuery {
	function queryArticleList($begin){
		global $wpdb;
		if(!$begin){
			$begin = 0;
		}
		$result = $wpdb->get_results("SELECT post.id as id,post.comment_count as ccount, post.post_author AS author,post.post_title AS post_title, post.post_date AS post_date FROM wp_posts as post where post.post_parent=0 and  post_status='publish' and post_type='post' order by post.post_date desc limit $begin, 10",ARRAY_A);
		return $result;
	}
	/**
	 * 根据用户id获取用户头像
	 * @param unknown $userId
	 * @return unknown
	 */
   function queryUserPhoto($userId){
   	 	global $wpdb;
   	 	global $wp_object_cache;
   	 	if(!$userId){
   	 		return "http://1.gravatar.com/avatar/?s=48&d=mm&r=g";
   	 	}
   	 	$photourl = wp_cache_get($userId,'tidmobile');
   	 	if(!$photourl){
	   	 		$result = $wpdb->get_results("SELECT meta_value FROM wp_usermeta where meta_key = 'simple_local_avatar' and user_id=$userId ",OBJECT);
	   	 		$str=serialize($result);
	   	 		preg_match("/http:\/\/.*?\.jpg/m", $str,$matches);
	   	 		if(!$matches){
	   	 			$photourl =  "http://1.gravatar.com/avatar/?s=48&d=mm&r=g";
	   	 		}else{
	   	 			$photourl = $matches[0];
	   	 		}
	   	 		wp_cache_add($userId, $photourl, 'tidmobile' );
   	 	}
   	 	return $photourl;
   }
   /**
    * 根据用户id获取用户名
    * @param unknown $userId
    * @return string
    */
   function queryUserName($userId){
   		global $wpdb;
   		$user_name = $wpdb->get_results("SELECT display_name FROM wp_users where  id=$userId",ARRAY_A);
   		if(empty($user_name)){
   			return "匿名";
   		}
   		return $user_name[0]['display_name'];
   }
   function queryArticleType($articleId){
	   	global $wpdb;
	   	$articleType = $wpdb->get_results("SELECT term_id FROM wp_term_relationships left join wp_term_taxonomy using(term_taxonomy_id) WHERE object_id=$articleId",ARRAY_A);
	   	if(!$articleType){
	   		return "";
	   	}
	   	return $articleType[0]['term_id'];
   }
   function queryArticleLogo($articleId){
	   	global $wpdb;
	   	$sql = $wpdb->prepare( "select guid from wp_posts where post_parent=%d and post_type='attachment' order by post_author, post_date limit 0,1",$articleId);
	   	$result = $wpdb->get_results($sql,ARRAY_A);
	   	if(!$result){
	   		return "";
	   	}
   		return ($result[0]['guid']);
   }
   public function queryArticleCommCount($articleId){
	   	global $wpdb;
	   	$sql = $wpdb->prepare( "select like_count from tid_ext_like where post_id=%d",$articleId);
	   	$result = $wpdb->get_results($sql,ARRAY_A);
	   	if(!$result){
	   		return 0;
	   	}
	   	return $result[0]['like_count'];
   }
   /**
    * 点赞
    */
   function likeTheArticle($postId,$ip){
   	    global $wpdb;
	   	$likeCount = $this->queryArticleCommCount($postId);
	   	if($likeCount == 0){
	   		$sql = $wpdb->prepare( "INSERT INTO tid_ext_like(post_id, like_count,user_ip) VALUES (%d, 1, %s)",$postId,$ip);
	   	}else{
	   		$likeCount++;
	   		$sql = $wpdb->prepare( "UPDATE tid_ext_like SET like_count = %d WHERE post_id=%d",$likeCount,$postId);
	   	}
	   	$result = $wpdb->get_results($sql,ARRAY_A);
   }
   function queryArticleById($postId){
   		global $wpdb;
   		$sql = $wpdb->prepare( "select id,comment_count, post_title, post_content,  post_date FROM wp_posts where id=%d",$postId);
   		$result = $wpdb->get_results($sql,ARRAY_A);
   		if(!$result){
   			return "";
   		}
   		return $result[0];
   }
   function queryCommentById($postId){
	   	global $wpdb;
	   	$sql = $wpdb->prepare( "select comment_author, comment_date, comment_content, user_id from wp_comments where comment_approved = 1 and comment_post_id = %d  ",$postId);
	   	$result = $wpdb->get_results($sql,ARRAY_A);
	   	if(!$result){
	   		return "";
	   	}
	   	return $result;
   }
}
