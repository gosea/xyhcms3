<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ($title); ?>-我的网站</title>
<script type="text/javascript" src="/Data/static/js/jquery-1.12.4.min.js" ></script>
<link href="/Public/Home/default/css/css.css?2017" rel="stylesheet" type="text/css" />
</head>

<body>
<!--top -->
<div id="top">
<script type="text/javascript">
$(function(){
	var $chkurl = "<?php echo U('Public/loginChk');?>";
	$.get($chkurl,function(data){
		//alert(data);
		if (data.status == 1) {
			$('#top_login_ok').show();
			$('#top_login_no').hide();
			//$('#top_login_ok').find('span');
			$('#top_login_ok>span').html('欢迎您，'+data.nickname);
		}else {			
			$('#top_login_ok').hide();
			$('#top_login_no').show();
		}
	},'json');	
});
</script>
<div class="warp" id="herd">
	<div id="top_fla">
	</div>
	<div id="top_member">
		<!--<a href="<?php echo U(MODULE_NAME.'/Product/basket');?>">购物车</a>-->
		<div id="top_login_no">
		<a href="<?php echo U(MODULE_NAME.'/Public/register');?>">会员注册</a>	
		<a href="<?php echo U(MODULE_NAME.'/Public/login');?>">会员登录</a>	
		<span>欢迎您，游客！您可以选择</span>	
		</div>
		<div id="top_login_ok" style="display:none;">
		<a href="<?php echo U(MODULE_NAME.'/Member/index');?>">会员中心</a>	
		<a href="<?php echo U(MODULE_NAME.'/Public/logout');?>">安全退出</a>
		<span>欢迎您， </span>
		</div>
			
	</div>
	<div id="top_logo"><a href="http://t.com"></a></div>
</div>
<!--menu -->
<div id="menu">
	<ul>
		<li><a href="http://t.com">首 页</a></li>
		<?php
 $_typeid = intval('0'); if($_typeid == -1) $_typeid = I('cid', 0, 'intval'); $_navlist = get_category(1); if($_typeid == 0) { $_navlist = \Common\Lib\Category::toLayer($_navlist); }else { $_navlist = \Common\Lib\Category::toLayer($_navlist, 'child', $_typeid); } foreach($_navlist as $autoindex => $navlist): $navlist['url'] = get_url($navlist); ?><li><a href='<?php echo ($navlist["url"]); ?>'><?php echo ($navlist["name"]); ?></a>
			<?php if(!empty($navlist['child'])): ?><div class="sub-menu">
					<?php if(is_array($navlist['child'])): $i = 0; $__LIST__ = $navlist['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href='<?php echo (get_url($vo)); ?>'><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div><?php endif; ?>
		</li><?php endforeach;?>
	</ul>
</div>

<div class="warp1 mt">
<div id="ggao"><b>最新公告：</b><span><marquee><?php
 $where = array('end_time' => array('gt',date('Y-m-d H:i:s'))); if (0 > 0) { $count = M('announce')->where($where)->count(); $thisPage = new \Common\Lib\Page($count, 0); $thisPage->rollPage = 5; $thisPage->setConfig('theme'," %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%"); $limit = $thisPage->firstRow. ',' .$thisPage->listRows; $page = $thisPage->show(); }else { $limit = "1"; } $_announcelist = M('announce')->where($where)->order("start_time DESC")->limit($limit)->select(); if (empty($_announcelist)) { $_announcelist = array(); } foreach($_announcelist as $autoindex => $announcelist): if(0) $announcelist['title'] = str2sub($announcelist['title'], 0, 0); if(100) $announcelist['content'] = str2sub(strip_tags($announcelist['content']), 100, 0); echo ($announcelist["content"]); endforeach;?></marquee></span></div>
</div>
<div class="clear"></div>

</div>

<div class="content">
	<div class="warp1 mt">

<div class="left f_l">


	<div class="mt">
	<h3 class="left_bt">最新专题</h3>
	<div class="xbox left_box" id="abt">
	<ul class="sywz">
	
	<?php
 $_typeid = '0'; $_keyword = ''; $where = array('special.delete_status' => 0, 'cate_status' => array('LT',2)); if (!empty($_typeid)) { $_typeid_arr = explode(',',$_typeid); $ids_arr = array(); foreach($_typeid_arr as $_typeid_key => $_typeid_val) { $_typeid_val = intval($_typeid_val); if (empty($_typeid_val)) { continue; } $_typeid_ids = \Common\Lib\Category::getChildsId(get_category(10), $_typeid_val, true); $ids_arr = array_merge($ids_arr,$_typeid_ids); } $ids_arr = array_unique($ids_arr); if (!empty($ids_arr)) { $where['special.cid'] = array('IN',$ids_arr); } } if (0 > 0 && 0 > 0) { $where['special.point'] = array('between',array(0,0)); }else if (0 > 0) { $where['special.point'] = array('EGT', 0); }else if (0 > 0) { $where['special.point'] = array('ELT', 0); } if ($_keyword != '') { $where['special.title'] = array('like','%'.$_keyword.'%'); } if (0 > 0) { $where['_string'] = 'special.flag & 0 = 0 '; } if (0 > 0) { $count = D('SpecialView')->where($where)->count(); $ename = I('e', '', 'htmlspecialchars,trim'); if (!empty($ename) && C('URL_ROUTER_ON') == true) { $param['p'] = I('p', 1, 'intval'); $param_action = '/'.$ename; }else { $param = array(); $param_action = ''; } $thisPage = new \Common\Lib\Page($count, 0, $param, $param_action); $thisPage->rollPage = 5; $thisPage->setConfig('theme'," %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%"); $limit = $thisPage->firstRow. ',' .$thisPage->listRows; $page = $thisPage->show(); }else { $limit = "10"; } $_spelist = D('SpecialView')->nofield('content')->where($where)->order("point DESC,id DESC")->limit($limit)->select(); if (empty($_spelist)) { $_spelist = array(); } foreach($_spelist as $autoindex => $spelist): if (($spelist['flag'] & B_JUMP) && !empty($spelist['jump_url'])) { $spelist['url'] = $spelist['jump_url']; }else { if(C('URL_ROUTER_ON') == true) { $spelist['url'] = U('Special/'.$spelist['id'],''); }else { $spelist['url'] = U('Special/shows', array('id'=> $spelist['id'])); } } if(16) $spelist['title'] = str2sub($spelist['title'], 16, 0); if(0) $spelist['description'] = str2sub($spelist['description'], 0, 0); ?><li><a href="<?php echo ($spelist["url"]); ?>"><?php echo ($spelist["title"]); ?></a></li><?php endforeach;?>
	</ul>
	</div>
	</div>

	<div class="mt">
	<h3 class="left_bt">联系我们</h3>
	<div class="xbox left_contactbox">
	  <p>联系地址：昆明北京路<br />
	  电话：0871-66666</p>
	</div>
	</div>	
</div>

<div class="right f_r">
	<h3 class="nybt"><i>您当前的位置：<?php
 $_sname = ''; $_surl = ''; $_hname = ''; $_typeid = intval('-1'); if($_typeid == -1) $_typeid = I('cid', 0, 'intval'); if ($_typeid == 0 && $_sname == '') { $_sname = isset($title) ? $title : ''; } echo get_position($_typeid, $_sname, $_surl, 0, "",$_hname); ?> </i><span><?php echo ($title); ?></span></h3>
	<!---->
	<div class="wzzw xbox" style="width:699px; overflow:hidden;">
		<ul class="speli">
		<?php
 $_typeid = '0'; $_keyword = ''; $where = array('special.delete_status' => 0, 'cate_status' => array('LT',2)); if (!empty($_typeid)) { $_typeid_arr = explode(',',$_typeid); $ids_arr = array(); foreach($_typeid_arr as $_typeid_key => $_typeid_val) { $_typeid_val = intval($_typeid_val); if (empty($_typeid_val)) { continue; } $_typeid_ids = \Common\Lib\Category::getChildsId(get_category(10), $_typeid_val, true); $ids_arr = array_merge($ids_arr,$_typeid_ids); } $ids_arr = array_unique($ids_arr); if (!empty($ids_arr)) { $where['special.cid'] = array('IN',$ids_arr); } } if (0 > 0 && 0 > 0) { $where['special.point'] = array('between',array(0,0)); }else if (0 > 0) { $where['special.point'] = array('EGT', 0); }else if (0 > 0) { $where['special.point'] = array('ELT', 0); } if ($_keyword != '') { $where['special.title'] = array('like','%'.$_keyword.'%'); } if (0 > 0) { $where['_string'] = 'special.flag & 0 = 0 '; } if (10 > 0) { $count = D('SpecialView')->where($where)->count(); $ename = I('e', '', 'htmlspecialchars,trim'); if (!empty($ename) && C('URL_ROUTER_ON') == true) { $param['p'] = I('p', 1, 'intval'); $param_action = '/'.$ename; }else { $param = array(); $param_action = ''; } $thisPage = new \Common\Lib\Page($count, 10, $param, $param_action); $thisPage->rollPage = 5; $thisPage->setConfig('theme'," %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%"); $limit = $thisPage->firstRow. ',' .$thisPage->listRows; $page = $thisPage->show(); }else { $limit = "10"; } $_spelist = D('SpecialView')->nofield('content')->where($where)->order("point DESC,id DESC")->limit($limit)->select(); if (empty($_spelist)) { $_spelist = array(); } foreach($_spelist as $autoindex => $spelist): if (($spelist['flag'] & B_JUMP) && !empty($spelist['jump_url'])) { $spelist['url'] = $spelist['jump_url']; }else { if(C('URL_ROUTER_ON') == true) { $spelist['url'] = U('Special/'.$spelist['id'],''); }else { $spelist['url'] = U('Special/shows', array('id'=> $spelist['id'])); } } if(0) $spelist['title'] = str2sub($spelist['title'], 0, 0); if(0) $spelist['description'] = str2sub($spelist['description'], 0, 0); ?><li>
			<a href="<?php echo ($spelist["url"]); ?>" class="preview"><img src="<?php echo ($spelist["litpic"]); ?>"></a>
			<a href="<?php echo ($spelist["url"]); ?>" class="title"><?php echo ($spelist["title"]); ?></a>
			<span class="info">
				<small>日期：</small><?php echo ($spelist["publish_time"]); ?>	
			</span>
			<p class="intro">
				<?php echo ($spelist["description"]); ?>
			</p>
		</li><?php endforeach;?>
		</ul>
		<div class="clear"></div>
		<!--分页 -->
		<div class="scott mt"> <?php echo ($page); ?><div class="clear"></div></div>
	</div>
</div>


<div class=" clear"></div>
</div>
</div>

<div class="warp1 mt" id="bottom">
	<a href="http://t.com">我的网站</a>版权所有
	<br />
	联系地址：昆明北京路  电话：0871-66666<br />
	Copyright © 2014-2014 XYHCMS. 行云海软件 版权所有 <a href="http://www.0871k.com" target="_blank">Power by XYHCMS</a>
</div>
<?php
 echo '<script type="text/javascript" src="'.U(MODULE_NAME. '/Public/online').'"></script>'; ?>


</body>
</html>