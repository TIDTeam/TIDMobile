$.fn.template =  function tmpl() {
    	var START = '<%',
        END = '%>',
        cache = {};
        var args = Array.prototype.slice.call(arguments),
            str = $(this).html(),
            selector = $(this).selector, // 以选择符作缓存
            data,
            s, e;
        
        if (args.length == 2 && $.type(args[0]) == 'string' && $.type(args[1]) == 'string' && args[0].length == 2 && args[1].length == 2) { // 自定义开始结束标签, 并且开始结束符必须为两位(不要使用正则敏感符号)
            s = args[0];
            e = args[1];
            data = args[2];
        } else {
            s = START;
            e = END;
            data = args[0];
        }

        // 提取开始结束符的分界符, <% -- %;  %> -- %
        var s_sep = s.substr(s.length - 1),
            e_sep = e.substr(0, 1);

        // 正则匹配
        var reg = new RegExp(s + "=(.+?)" + e , "g"), // /<%=(.+?)%>/g
            reg_e = new RegExp("'(?=[^" + e_sep + "]*" + e + ")", "g"); // /'(?=[^%]*%>)/g
  

        var fn = cache[selector] ||
            // generator (and which will be cached).
            new Function("obj", "var p=[],print=function(){p.push.apply(p,arguments);};" +
            
            // Introduce the data as local variables using with(){}
            "with(obj){p.push('" +
             str.replace(/[\r\t\n]/g, " ")
                .replace(reg_e, "\t")
                .split("'").join("\\'")
                .split("\t").join("'")
                .replace(reg, "',$1,'")
                .split(s).join("');")
                .split(e)
                .join("p.push('") +
            "');}return p.join('');");
        // cache
        cache[selector] = fn;

        // Provide some basic currying to the user
        return data ? fn(data) : fn;
    };
var Index = {
		article_list_tpl :  $("#article_list_tpl").template(),
		current_index : 11,
		queryResult : function(data){
			var result = data || [];
			var html = [];
			var len = result.length,item;
			for(var i = 0 ; i < len; i++){
				item = result[i];
				html.push(Index.article_list_tpl(item));
			}
			debugger;
			$("#main_content").append(html.join(""));
			Index.current_index += 10;
		},
		queryArticleList : function(){
				var option = {
						type : "get",
						url : G_HOST + "?tjson=1&begin=" + Index.current_index,
						dataType : "json",
						success :  Index.queryResult
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
		likeTest : function(articleid){
			var option = {
					type : "get",
					url : G_HOST + "?tjson=1&liketype=1&postid=6351",
					dataType : "json",
					success :  function(){}
			};
			$.ajax(option);
		},
		
		bindEvent : function(){
			var i = 0;
			$("#query_more").on("click",function(e){
				e.preventDefault();
				Index.queryArticleList();
			});
			
			$("#main_content .btn-like").on("click",function(e){
				e.preventDefault();
				var current = $(e.currentTarget);
                var postid = current.data("postid");
                var count = parseInt(current.html() || "0");
                current.html(++count);
				Index.addLikeArticle(postid);
			});
			
		},
		init : function(){
				this.bindEvent();
		}
};
Index.init();