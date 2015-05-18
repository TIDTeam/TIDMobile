var Article = {
		postResult : function(data){
			console.log(data);
		},
		postComments : function(data){
			var option = {
					type : "post",
					url : G_HOST + "tid-comments-post.php",
					dataType : "json",
					data : data,
					success : Article.postResult
			};
			$.ajax(option);
		},
		addLikeArticle : function(articleid){
			var option = {
					type : "get",
					url : G_HOST + "?tjson=1&liketype=1&postid=" + articleid,
					dataType : "json",
					success :  function(){}
			};
			$.ajax(option);
		},
		bindEvent : function(){
			var _this = this;
			$("#post_comment").on("click",function(e){
				e.preventDefault();
				var formData = $('#commentform').serialize();
				console.log(formData);
				_this.postComments(formData);
			});
			$("#like_it").on("click",function(e){
				var current = $(e.currentTarget);
                var postid = current.data("postid");
                var count = parseInt(current.html() || "0");
                _this.addLikeArticle(postid);
			});
		},
		init : function(){
				this.bindEvent();
		}
};
Article.init();