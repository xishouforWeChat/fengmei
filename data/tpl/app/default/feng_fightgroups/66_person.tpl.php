<?php defined('IN_IA') or exit('Access Denied');?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<avalon ms-skip="" class="avalonHide">
<style id="avalonStyle">
.avalonHide{ display: none!important }
</style>
</avalon>
    <title>个人中心</title>
    <?php  echo register_jssdk();?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Pragma" content="no-cache">   
    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Expires" content="0">
    <LINK  href="../addons/feng_fightgroups/template/css/style_366c9ef.css" rel="stylesheet">    
    <LINK  href="../addons/feng_fightgroups/template/css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body avalonctrl="root">
    <div class="container">
        <section class="main-view">
            <div class="my">
                <div class="my_head">
                    <div class="my_head_pic">
                        <img id="uinLogo" class="my_head_img" width="130" height="130" alt="" src="<?php  if(empty($profile['avatar'])) { ?>../addons/feng_fightgroups/template/image/logo.jpg<?php  } else { ?><?php  echo $profile['avatar'];?><?php  } ?>">
                    </div>
                    <div class="my_head_info">
                        <h4 id="nickname" class="my_head_name "><?php  echo $profile['nickname'];?></h4>
                    </div>
                </div>
                <ul class="my_transaction my_transaction2" style="<?php  if(empty($modules['feng_recharge'])) { ?>display: none;<?php  } ?>">
				<li>
					<a href="#" ptag="12478.4.1">
						<div class="my_transaction_num" id="fav_shop_total_count"><?php  echo $result['credit1'];?></div>
						<div class="my_transaction_txt">我的积分</div>
					</a>
				</li>
				<li>
					<a href="#" ptag="12478.7.1">
						<div class="my_transaction_num" id="fav_item_total_count"><?php  echo $result['credit2'];?></div>
						<div class="my_transaction_txt">我的余额</div>
					</a>
				</li>
				</ul>
            </div>
            <div class="nav">
                <ul class="nav_list">
                    <li class="nav_item nav_order">
                        <a  href="<?php  echo $this->createMobileUrl('myorder')?>">
                            <div class="nav_item_hd">我的订单</div>
                        </a>
                        <div class="nav_item_bd">
                            <a  href="<?php  echo $this->createMobileUrl('myorder')?>"><span class="nav_item_txt">全部</span></a>
                            <a  href="<?php  echo $this->createMobileUrl('myorder',array('op' => '1'))?>">
                                <span class="nav_item_txt">待付款<i class="nav_item_num" id="need_pay_count" style="display:none">0</i></span>
                            </a>
                            <a  href="<?php  echo $this->createMobileUrl('myorder',array('op' => '2'))?>">
                                <span class="nav_item_txt">待收货<i class="nav_item_num" id="need_recv_count" style="display:none">0</i></span>
                            </a>
                        </div>
                    </li>
                    <li class="nav_item nav_cheap" >
                        <div class="nav_item_hd"><a href="<?php  echo $this->createMobileUrl('mygroup');?>"> 我的拼团 </a></div>
                    </li>
                    <li class="nav_item nav_cart" >
                        <div class="nav_item_hd">
                          <a href="<?php  echo $this->createMobileUrl('AddManage');?>">我的地址</a>
                        </div>
                    </li>
                    <?php  if($this->module['config']['mode'] == 2) { ?>
                    <li class="nav_item nav_red" >
                        <div class="nav_item_hd">
                          <a href="<?php  echo $this->createMobileUrl('favorite');?>">我的收藏</a>
                        </div>
                    </li>
                    <?php  } ?>
                </ul>
            </div>
            <div class="nav my_mod_mt" style="<?php  if(empty($modules['feng_recharge'])) { ?>display: none;<?php  } ?>">
            <ul class="nav_list">
                <li class="nav_item nav_money" ptag="12478.20.1">
                    <div class="nav_item_hd">
                        <a class="list_item" href="./index.php?i=<?php  echo $_W['uniacid']?>&j=<?php  echo $_W['uniacid']?>&c=entry&do=index&m=feng_recharge&wxref=mp.weixin.qq.com#wechat_redirect" ptag="12478.20.1">
                            余额充值
                        </a>
                    </div>
                </li>
            </ul>
        	</div>
        </section>
        <?php  if($this->module['config']['mode'] == 1) { ?>
        <!-- <footer class="footer">
            <nav>
                <ul>
                    <li><a href="<?php  echo $this->createMobileUrl('index')?>" class="nav-controller"><i class="fa fa-home"></i>首页</a></li>
                     <li><a href="<?php  echo $this->createMobileUrl('mygroup',array('op'=>0));?>" class="nav-controller"><i class="fa fa-group"></i>我的团</a></li>
                    <li><a href="<?php  echo $this->createMobileUrl('myorder')?>" class="nav-controller"><i class="fa fa-list"></i>我的订单</a></li>
                    <li><a href="<?php  echo $this->createMobileUrl('person')?>" class="nav-controller active"><i class="fa fa-user"></i>个人中心</a></li>
                </ul>
            </nav>
        </footer> -->
        <?php  } else { ?>
        <!-- <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?> -->
        <?php  } ?>
    </div>
</body>
<script>
	wx.ready(function (){
	var shareData = {
		title: "<?php  echo $share_data['share_title'];?>",
		desc: "<?php  echo $share_data['share_desc'];?>",
		link: "<?php  echo $to_url;?>",
		imgUrl: "<?php  echo $_W['attachurl'];?><?php  echo $share_data['share_image'];?>",
	};
//分享朋友
	wx.onMenuShareAppMessage({
	    title: shareData.title,
	  	desc: shareData.desc,
	  	link: shareData.link,
	  	imgUrl:shareData.imgUrl,
	  	trigger: function (res) {
	  	},
	  	success: function (res) {
	    	window.location.href ="http://www.baidu.com";
	  	},
	  	cancel: function (res) {
	  	},
	  	fail: function (res) {
	    	alert(JSON.stringify(res));
	  	}
	});
//朋友圈
	wx.onMenuShareTimeline({
	  	title: shareData.title,
	  	link: shareData.link,
	  	imgUrl:shareData.imgUrl,
	  	trigger: function (res) {
	  	},
	  	success: function (res) {
	    	window.location.href ="http://www.baidu.com";
	  	},
	  	cancel: function (res) {
	  	},
	  	fail: function (res) {
	    	alert(JSON.stringify(res));
	  	}
	});
});
</script>
</html>