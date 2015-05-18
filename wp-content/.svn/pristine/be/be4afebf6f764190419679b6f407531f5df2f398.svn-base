<div id="main_content">
<?php foreach ($data as $item) : ?>
	<section class="section">
			<div class="section-hd">
				<a class="article-cover" href="<?php echo G_HOST?>?p=<?php echo $item['id']?>&atype=<?php echo $item['atype_index']?>&username=<?php echo urldecode($item['user_name'])?>"><img src="<?php echo $item['guid']?>" width="100%" alt="<?php echo $item['post_title']?>"></a>
				<a class="author" href="#none">
					<span class="author-avatar"><img src="<?php echo $item['user_avatar']?>" width="100%" /></span>
					<span class="author-name"><?php echo $item['user_name']?></span>
				</a>
				<a class="article-sort article-sort-<?php echo strtolower($item['article_title'])?> href="#none" title="<?php echo $item['article_title']?>"><span class="txt"><?php echo $item['article_type']?></span></a>
			</div>
			<div class="section-ft">
				<div class="article-title">
					<h1><?php echo $item['post_title']?></h1>
					<time><?php echo date("Y/m/d",strtotime($item['post_date']))?></time>
				</div>
				<div class="article-opt">
					<a class="btn-like js_btn_like" href="#none"  data-postid="<?php echo $item['id']?>"><?php echo $item['like_count']?></a>
					<a class="btn-comment" href="#none"><?php echo $item['ccount']?></a>
				</div>
			</div>
	</section>
<?php endforeach ?>
</div>
<section class="section">
			<div class="section-ft">
				<div id="query_more">更多</div>
			</div>
	</section>
<script type="text/template" id="article_list_tpl">
	<section class="section">
			<div class="section-hd">
				<a class="article-cover" href="#none"><img src="<%=guid %>" width="100%" alt="<%=post_title %>"></a>
				<a class="author" href="#none">
					<span class="author-avatar"><img src="<%=user_avatar %>" width="100%" /></span>
					<span class="author-name"><%=user_name %></span>
				</a>
				<a class="article-sort article-sort-<%=article_title %> href="#none" title="<%=article_title %>"><span class="txt"><%=article_type %></span></a>
			</div>
			<div class="section-ft">
				<div class="article-title">
					<h1><%=post_title %></h1>
					<time><%=post_date %></time>
				</div>
				<div class="article-opt">
					<a class="btn-like js_btn_like" href="#none" data-postid="<%=id %>"><%=like_count %></a>
					<a class="btn-comment" href="#none"><%=ccount %></a>
				</div>
			</div>
	</section>
</script>
<script  type="text/javascript" >
	var G_HOST = "<?php echo G_HOST?>";
</script>
<script type="text/javascript" src="<?php echo $static_url ?>js/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo $static_url ?>js/index.js"></script>