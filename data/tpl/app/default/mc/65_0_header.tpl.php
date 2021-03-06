<?php defined('IN_IA') or exit('Access Denied');?><style>
body{background:#d2e6e9; padding-bottom:63px;}
/*个人中心*/
.pcenter-main .head{position:relative; height:170px; width:100%; background:url(<?php  if(!empty($ucpage['params'][0]['params']['bgImage'])) { ?>'<?php  echo $ucpage['params'][0]['params']['bgImage'];?>'<?php  } else { ?>'resource/images/head-bg.png'<?php  } ?>) no-repeat center center; background-size:100% auto; -moz-background-size:100% auto; -webkit-background-size:100% auto;}
.pcenter-main .head .ptool{float:right; display:inline-block; text-decoration:none; height:50px; line-height:50px; width:50px; text-align:center;font-size:25px; color:#749caa;}
.pcenter-main .head .pdetail{height:120px; padding:30px 0 0 20px; -webkit-box-sizing:border-box;}
.pcenter-main .head .pdetail .img-circle{float:left; width:66px; height:66px; overflow:hidden; margin-right:10px; border:1px rgba(255,255,255,0.2) solid;}
.pcenter-main .head .pdetail .img-circle img{width:66px;}
.pcenter-main .head .pdetail .pull-left span{display:block; color:#FFF; line-height:20px;}
.pcenter-main .head .pdetail .pull-left span.name{font-size:20px; display:inline-block; max-width:150px; height:25px; line-height:25px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; word-break:keep-all;}
.pcenter-main .head .pdetail .pull-left span.type{font-size:14px;}
.pcenter-main .head .head-nav{height:50px; line-height:20px; padding-top:7px; background:rgba(0,0,0,0.2);}
.pcenter-main .head .head-nav .head-nav-list{display:inline-block; float:left; text-decoration:none; color:#FFF;  width:25%; text-align:center; font-size:16px; background:-webkit-gradient(linear, 0 0, 0 100, from(rgba(255,255,255,0.5)), to(rgba(255,255,255,0.5)) ) no-repeat left center; -webkit-background-size:1px 75%;}
.pcenter-main .head .head-nav .head-nav-list:first-child{background:none;}
.pcenter-main .head .head-nav .head-nav-list > span{font-weight:bold; display:block; font-size:14px;}
/*竖排导航条 通用*/
.mnav-box ul{padding:10px 15px 0 15px;font-family:Helvetica, Arial, sans-serif;}
.mnav-box ul li{padding:10px 15px;}
.pcenter-main .profile{width:100%;background:transparent url('resource/images/home-bg.jpg') no-repeat; background-size:cover;}
.pcenter-main .profile .tabbable>ul{padding:10px 15px 0px 15px;}
.pcenter-main .profile .tabbable .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{color:#5ac5d4;background-color:#E9F7F8;}
.pcenter-main .profile label{color:#555; font-weight:lighter; margin-top:5px;}
</style>
<div class="pcenter-main">
	<div class="head">
		<a class="ptool" href="<?php  echo url('mc/profile')?>"><i class="fa fa-cog fa-spin"></i></a>
		<div class="pdetail">
			<div class="img-circle"><img src="<?php  echo tomedia($profile['avatar']);?>" onerror="this.src='resource/images/heading.jpg'"></div>
			<div class="pull-left">
				<span class="name"><?php  if(!empty($profile['nickname'])) { ?><?php  echo $profile['nickname'];?><?php  } else { ?><a href="<?php  echo url('mc/profile')?>" style="color:red;">设置昵称</a><?php  } ?></span>
				<span class="type"><i class="fa fa-certificate"></i> <?php  echo $profile['group']['title'];?></span>
				<span class="type"><i class="fa fa-flag-o"></i> 会员UID: <?php  echo $profile['uid'];?></span>
			</div>
		</div>
		<div class="head-nav">
			<a class="head-nav-list" href="<?php  echo url('activity/coupon/mine');?>">折扣券<span><?php  echo $coupons['total'];?></span></a>
			<a class="head-nav-list" href="<?php  echo url('activity/token/mine');?>">代金券<span><?php  echo $tokens['total'];?></span></a>
			<a class="head-nav-list" href="<?php  echo url('mc/bond/credits', array('credittype' => $behavior['activity']));?>"><?php  echo $creditnames[$behavior['activity']]['title'];?><span><?php  echo $credits[$behavior['activity']];?></span></a>
			<a class="head-nav-list" href="<?php  echo url('mc/bond/credits', array('credittype' => $behavior['currency']));?>"><?php  echo $creditnames[$behavior['currency']]['title'];?><span><?php  echo $credits[$behavior['currency']];?></span></a>
		</div>
	</div>
	<div class="clearfix">