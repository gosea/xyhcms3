<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>后台</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" href="/Data/static/bootstrap/3.3.5/css/bootstrap.min.css" media="screen">	
	<link rel='stylesheet' type="text/css" href="/App/Manage/View/Public/css/main.css" />
	<!-- 头部css文件|自定义  -->
	

	<script type="text/javascript" src="/Data/static/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/Data/static/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		<script src="/Data/static/js/html5shiv.min.js"></script>
		<script src="/Data/static/js/respond.min.js"></script>
    <![endif]-->
	
	<script type="text/javascript" src="/App/Manage/View/Public/js/jquery.form.min.js"></script>
	<script type="text/javascript" src="/Data/static/jq_plugins/layer/layer.js"></script>
	<script language="JavaScript">
	    <!--
	    var URL = '/xyhai.php?s=/System';
	    var APP	 = '/xyhai.php?s=';
	    var SELF='/xyhai.php?s=/System/url';
	    var PUBLIC='/App/Manage/View/Public';
	    var data_path = "/Data";
		var tpl_public = "/App/Manage/View/Public";
	    //-->
	</script>
	<script type="text/javascript" src="/App/Manage/View/Public/js/common.js"></script> 
	<!-- 头部js文件|自定义 -->
	
	<script language="JavaScript">
    $(function(){
        $("input:radio[name='config[HOME_URL_MODEL]']").click(function(){

            if ( $(this).prop('checked')) {
            	var val = $(this).val();
            	if (val == 1 || val ==2 ) {
					$('#UrlRouter1').show();
            	}else {
					$('#UrlRouter1').hide();

            	}
            }
            
        });

      
    });
    //-->
</script>

</head>
<body>
	<div class="xyh-content">
		
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><em class="glyphicon glyphicon-cloud-upload"></em> 
			伪静态与静态缓存
		    </h3>
		</div>
		
	</div>


	<div class="row">
		<div class="col-lg-12">
			<form method='post' class="form-horizontal" id="form_do" name="form_do" action="<?php echo U('url');?>">
				<div class="panel panel-default">
					<div class="panel-heading">伪静态</div>
					<div class="panel-body">

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">URL模式</label>
							<div class="col-sm-9">
								<label class="radio-inline"><input type="radio" name="config[HOME_URL_MODEL]" value="0" <?php if($vo['HOME_URL_MODEL'] == 0): ?>checked="checked"<?php endif; ?>>普通模式</label>
								<div>URL参数模式：http://www.xyhcms.com/index.php?m=List&a=index&id=1</div> 
								<label class="radio-inline"><input type="radio" name="config[HOME_URL_MODEL]" value="1" <?php if($vo['HOME_URL_MODEL'] == 1): ?>checked="checked"<?php endif; ?>>PATHINFO模式</label>
								<div>PATHINFO模式：http://www.xyhcms.com/index.php/List/index/id/1</div> 
								<label class="radio-inline"><input type="radio" name="config[HOME_URL_MODEL]" value="2" <?php if($vo['HOME_URL_MODEL'] == 2): ?>checked="checked"<?php endif; ?>>REWRITE模式(需要URL_REWRITE支持)</label>
								<div>REWRITE模式和PATHINFO模式功能一样,需开启URL_REWRITE模块(隐藏index.php),如：<br/>http://www.xyhcms.com/List/index/id/1/</div>
								<label class="radio-inline"><input type="radio" name="config[HOME_URL_MODEL]" value="3" <?php if($vo['HOME_URL_MODEL'] == 3): ?>checked="checked"<?php endif; ?>>兼容模式</label>
								<div>兼容模式：http://www.xyhcms.com/index.php?s=/List/index/id/1</div> 
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">参数分割符</label>
							<div class="col-sm-9">
								<input type="text" name="config[HOME_URL_PATHINFO_DEPR]" value="<?php echo ($vo["HOME_URL_PATHINFO_DEPR"]); ?>" class="form-control" />
								<div>针对PATHINFO模式,默认为"/",如改为"-"：http://www.xyhcms.com/index.php/List-index-id-1</div> 
							</div>
						</div>	

					</div>
				</div>

				<div class="panel panel-default" id="UrlRouter1" <?php if($vo['HOME_URL_MODEL'] != 1 && $vo['HOME_URL_MODEL'] != 2): ?>style="display:none;"<?php endif; ?>>
					<div class="panel-heading">开启URL路由(路由规则不熟悉的不要乱改)</div>
					<div class="panel-body">

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">开启路由</label>
							<div class="col-sm-9">
								<label class="checkbox-inline"><input type="checkbox" name="config[HOME_URL_ROUTER_ON]" value="1" <?php if($vo['HOME_URL_ROUTER_ON'] == 1): ?>checked="checked"<?php endif; ?> />开启</label>
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">路由规则</label>
							<div class="col-sm-9">
								<textarea name="config[HOME_URL_ROUTE_RULES]" class="form-control" rows="5"><?php echo ($vo["HOME_URL_ROUTE_RULES"]); ?></textarea>
							</div>

						</div>
										
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">静态缓存(缓解服务器压力)</div>
					<div class="panel-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">开启静态缓存</label>
							<div class="col-sm-9">
								<label class="checkbox-inline"><input type="checkbox" name="config[HOME_HTML_CACHE_ON]" value="1" <?php if($vo['HOME_HTML_CACHE_ON'] == 1): ?>checked="checked"<?php endif; ?> />开启电脑版缓存</label>
								<label class="checkbox-inline"><input type="checkbox" name="config[MOBILE_HTML_CACHE_ON]" value="1" <?php if($vo['MOBILE_HTML_CACHE_ON'] == 1): ?>checked="checked"<?php endif; ?> />开启手机版缓存</label>
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">缓存规则</label>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-3">
										<label class="checkbox-inline"><input type="checkbox" name="config[HTML_CACHE_INDEX_ON]" value="1" <?php if($vo['HTML_CACHE_INDEX_ON'] == 1): ?>checked="checked"<?php endif; ?> />首页缓存</label>
									</div>

									<div class="col-sm-9 input-group">
										<span class="input-group-addon">缓存时间</span>
										<input type="text" name="config[HTML_CACHE_INDEX_TIME]" class="form-control" value="<?php echo ($vo["HTML_CACHE_INDEX_TIME"]); ?>" />
										<span class="input-group-addon">秒</span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<label class="checkbox-inline"><input type="checkbox" name="config[HTML_CACHE_LIST_ON]" value="1" <?php if($vo['HTML_CACHE_LIST_ON'] == 1): ?>checked="checked"<?php endif; ?> />栏目缓存</label>
									</div>

									<div class="col-sm-9 input-group">
										<span class="input-group-addon">缓存时间</span>
										<input type="text" name="config[HTML_CACHE_LIST_TIME]" class="form-control" value="<?php echo ($vo["HTML_CACHE_LIST_TIME"]); ?>" />
										<span class="input-group-addon">秒</span>
									</div>

								</div>
								<div class="row">
									<div class="col-sm-3">
										<label class="checkbox-inline"><input type="checkbox" name="config[HTML_CACHE_SHOW_ON]" value="1" <?php if($vo['HTML_CACHE_SHOW_ON'] == 1): ?>checked="checked"<?php endif; ?> />文章缓存</label>
									</div>

									<div class="col-sm-9 input-group">
										<span class="input-group-addon">缓存时间</span>
										<input type="text" name="config[HTML_CACHE_SHOW_TIME]" class="form-control" value="<?php echo ($vo["HTML_CACHE_SHOW_TIME"]); ?>" />
										<span class="input-group-addon">秒</span>
									</div>

								</div>
								<div class="row">
									<div class="col-sm-3">
										<label class="checkbox-inline"><input type="checkbox" name="config[HTML_CACHE_SPECIAL_ON]" value="1" <?php if($vo['HTML_CACHE_SPECIAL_ON'] == 1): ?>checked="checked"<?php endif; ?> />专题缓存</label>
									</div>

									<div class="col-sm-9 input-group">
										<span class="input-group-addon">缓存时间</span>
										<input type="text" name="config[HTML_CACHE_SPECIAL_TIME]" class="form-control" value="<?php echo ($vo["HTML_CACHE_SPECIAL_TIME"]); ?>" />
										<span class="input-group-addon">秒</span>
									</div>

								</div>

							</div>
						</div>	

					</div>
				</div>

				

				



					
			

				<div class="row margin-botton-large">
					<div class="col-sm-offset-2 col-sm-9">
						<div class="btn-group">							
							<button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-saved"></i>
								保存
							</button>
						</div>
					</div>
				</div>
			</form>
	
		</div>
	</div>

		



			
	</div>	
</body>
</html>