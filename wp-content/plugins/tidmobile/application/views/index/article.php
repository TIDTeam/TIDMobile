<style type="text/css">
	
		.btn-like:before, .btn-comment:before, .btn-forwarding:before{url(<?php echo $static_url?>img/ico.png) no-repeat;background-size:auto 100%;display:inline-block;vertical-align:top;margin-right:3px;overflow:hidden;content:'';width:14px;height:14px;background-color:#8F8D8D;}
		.btn-like, .btn-comment, .btn-forwarding{display:inline-block;line-height:16px;font-size:1.166rem;color:#707070;}
		.btn-comment:before{background-position:-15px 0;}
		.btn-forwarding:before{background-position:-30px 0;}
		.on-btn-like:before, .on-btn-comment:before, .on-btn-forwarding:before{background-color:#F36700;}
		
		.main{width:94%;margin:0 auto;}
		
		.article{padding:6.25% 0;}
		.article-title{font-size:1.5rem;color:#333333;}
		.article-related{font-size:1.166rem;color:#7D7D7D;padding:5px 0 10px;}
		.article-main{font-size:1.166rem;line-height:1.5;overflow:hidden;}
		.article-opt{margin-top:10px;}
		.article-opt .btn{margin-right:26px;}
		
		
		.comment-title{font-size:1.166rem;margin-bottom:12px;}
		.comment-item:after{content:".";clear:both;display:block;height:0;visibility:hidden;}
		.comment-item{zoom:1;font-size:1rem;margin-bottom:24px;}
		.comment-avatar{float:left;width:12%;overflow:hidden;-webkit-border-radius:5px;border-radius:5px;}
		.comment-info{float:right;width:85%;}
		.comment-username{float:left;}
		.comment-time{float:right;color:#999999;}
		.comment-cnt{clear:both;padding-top:5px;}
		.comment-form{border-top:1px solid #C3C3C3;}
		.comment-form .name-text, .comment-form .cnt-textarea{border:1px solid #C3C3C3;padding:2px 6px;width:100%;-webkit-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:3px;border-radius:3px;font-size:1rem;}
		.comment-form .name-text{height:28px;margin-top:24px;}
		.comment-form .cnt-textarea{height:90px;margin:6px 0;}
		.comment-form .post-button{width:100%;height:40px;background-color:#FFB141;color:#FFFFFF;-webkit-border-radius:3px;border-radius:3px;}
		
		
		.linklist-title{font-size:1.166rem;margin-bottom:12px;}
		.linklist-main .link{display:block;line-height:1.8;color:#666666;}
		
		.readmore-linklist{margin-top:24px;padding-top:24px;border-top:1px solid #C3C3C3;}
		.links-linklist{margin-top:35px;}
	
	strong{display:block;}
	img{width:100%;margin:0 auto;height:auto}
</style>
<main class="main">
	<article class="article">
		<h1 class="article-title"><?php echo $data['post_title']?></h1>
		<div class="article-related"><time><?php echo date("Y/m/d",strtotime($data['post_date']))?></time>&nbsp;&nbsp;/&nbsp;&nbsp;<span><?php echo $data['atype']?></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span><?php echo $data['username']?></span></div>
		<div class="article-main">
			<p><?php echo $data['post_content']?></p>
		</div>
		<div class="article-opt">
			<!--
				交互说明：
				1. on-btn-like | 赞，高亮状态 
				2. on-btn-comment | 评论，高亮状态 
				3. on-btn-forwarding | 转发，高亮状态 
			-->
			<a class="btn btn-comment on-btn-comment" href="#none">评论</a>
			<a class="btn btn-like" href="#none"   data-postid="<?php echo $data['id']?>" id="like_it">赞</a>
			<a class="btn btn-forwarding" href="#none">转发</a>
		</div>
	</article>


	<aside class="comment">
		<h2 class="comment-title">评论：</h2>
		<div class="comment-main">
			<?php foreach ($comments as $item) : ?>
			<div class="comment-item">
				<div class="comment-avatar"><img src="<?php echo $item['user_avatar']?>" width="100%" /></div>
				<div class="comment-info">
					<p class="comment-username"><?php echo $item['user_name']?></p>
					<p class="comment-time"><?php echo date("Y/m/d",strtotime($item['comment_date']))?></p>
					<p class="comment-cnt"><?php echo $item['comment_content']?></p>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="comment-form">
			<form action="#none" method="post" id="commentform" class="comment-form">
				<input type="text"  class="name-text"  id="comment_author" name="comment_author" placeholder="Name" />
				<textarea class="cnt-textarea"  placeholder="Leave a reply"   id="comment" name="comment"></textarea>
				<input type="hidden" name="comment_parent" id="comment_parent" value="0">
				 <input type="hidden" name="comment_post_ID" value="<?php echo $data['id']?>" id="comment_post_ID">
				 <input type="hidden" id="ak_js" name="ak_js" value='<?php echo time()?>'>
				<button class="post-button" type="submit"   id="post_comment">Post Comment</button>
			</form>
		</div>
	</aside>
<?php 
include (ROOT . DS . 'application' . DS . 'views' . DS . 'asidelink.php');
?>
</main>
<script type="text/template" id="comments_tpl">
<div class="comment-item">
		<div class="comment-avatar"><img src="<%=guid %>" width="100%" /></div>
			<div class="comment-info">
					<p class="comment-username"><%=guid %></p>
					<p class="comment-time"><%=guid %></p>
					<p class="comment-cnt"><%=guid %></p>
			</div>
</div>
</script>
<script  type="text/javascript" >
	var G_HOST = "<?php echo G_HOST?>";
</script>
<script type="text/javascript" src="<?php echo $static_url ?>js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo $static_url ?>js/article.js"></script>