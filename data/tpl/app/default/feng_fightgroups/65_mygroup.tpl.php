<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <title>我的团</title>
	<?php  echo register_jssdk();?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Pragma" content="no-cache">   
    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="../addons/feng_fightgroups/template/css/style_366c9ef.css?v=<?php echo TIMESTAMP;?>">
    <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <!--控制导航栏的样式-->
   	<style type="text/css">
   		.mod_nav_lk a:visited{
   			color: black;
   		}
   		.line_bottom{
   			position: relative;
   			top: -3px;
   			display: block;
   			width: 100%;
   			height: 3px;
   			background-color: red;
   		}
   	</style>

   <script type="text/javascript">
	$(document).ready(function(){
	  var op = "<?php  echo $op;?>";
	  if(op=="0"){
	  	$("#s1").addClass("line_bottom");
	  }else if(op=="1"){
	  	$("#s2").addClass("line_bottom");
	  }else if(op=="2"){
	  	$("#s3").addClass("line_bottom");
	  }else {
	  	return false;
	  }
	});
	</script>

	<!--没有对应状态订单的提示-->
	 <script type="text/javascript">
	$(document).ready(function(){

	  $(".mod_nav_lk #a1").click(function(){

	  	var order_num = "<?php  echo $orders_num_0['num']?>";

	  	if(order_num<=0){

	  		$("#dealliststatus1").html("没有订单").css('text-align','center').css('display','none').slideDown();

	  		$("#s1").addClass("line_bottom");

	  		$("#s2").removeClass("line_bottom");

	  		$("#s3").removeClass("line_bottom");

	  		return false; //阻止默认事件

	  	}

	  });

	  $(".mod_nav_lk #a2").click(function(){

	  	var order_num = "<?php  echo $orders_num_1['num']?>";

	  	if(order_num<=0){

	  		$("#dealliststatus1").html("没有待付款订单").css('text-align','center').css('display','none').slideDown();

	  		$("#s2").addClass("line_bottom");

	  		$("#s1").removeClass("line_bottom");

	  		$("#s3").removeClass("line_bottom");

	  		return false; //阻止默认事件

	  	}

	  });

	  $(".mod_nav_lk #a3").click(function(){
	  	var order_num = "<?php  echo $orders_num_2['num']?>";
	  	if(order_num<=0){
	  		$("#dealliststatus1").html("没有待收货订单").css('text-align','center').css('display','none').slideDown();
	  		$("#s3").addClass("line_bottom");
	  		$("#s1").removeClass("line_bottom");
	  		$("#s2").removeClass("line_bottom");
	  		return false; //阻止默认事件
	  	}
	  });
	});
	</script>
	<!--end没有对应状态订单的提示-->

</head>

<body>

  <div ms-controller="root">
  <?php  if(empty($orders)) { ?>
  <div class="mod_nav nav">
      <div class="mod_nav_lk" style="text-align:center">
          <a  href="<?php  echo $this->createMobileUrl('index')?>" >
          <span><b>您还没有参加过任何团购哦，赶快去首页火拼吧！</b></span>
          </a>
      </div>

  </div>
  <?php  } ?>
    	<?php  if(is_array($orders)) { foreach($orders as $order) { ?>
            <!--<div class="order_hd">
            	<?php  echo date('Y-m-d H:i:s', $order['ptime']);?>
            </div>-->
            <div class="order_bd" style=" margin-bottom: 10px;">
                <div class="order_glist">
                    <a href="<?php  echo $this->createMobileUrl('gooddetails', array('id'=>$order['gid']));?>">
                        <div class="order_goods" data-url="" style="border-bottom-color: rgb(215, 215, 215);border-bottom-width: 1px;border-bottom-style: solid;padding: 15px 0px 0px 75px;">
							<div style="position: absolute;right: 10px;top:10px;width:60px;height: 60px;z-index: 999;">
                                <?php  if($order['itemnum'] == $order['groupnum']) { ?>
                                    <img  alt="" width="130" height="130" src="../addons/feng_fightgroups/template/image/success.png"/>
                                <?php  } else { ?>
                                    <?php  if($order['lasttime']< 0) { ?>
                                    <img  alt="" width="130" height="130" src="../addons/feng_fightgroups/template/image/fail.png"/>
                                    <?php  } ?>
                                <?php  } ?>
                            </div>
                            <div class="order_goods_img">
                                <img alt="" src="<?php  echo tomedia($order['gimg']);?>">
                            </div>
                            <div class="order_goods_info">
                                <div class="order_goods_name"><?php  echo $order['gname'];?></div>
                                <div class="order_goods_attr">
                                    <div class="order_goods_attr_item" style="padding: 5px;">
                                        <!-- <div class="order_goods_price"><i>￥</i><?php  echo $order['price'];?><i>/件</i></div>数量：1 -->
                                        <div class="tuan_g_core" >
                                            <div class="tuan_g_price">
                                                <span><?php  echo $order['groupnum'];?>人团价</span>
                                                <span>
                                                </span>
                                                <b>¥<?php  echo $order['gprice'];?></b>
                                            </div>
                                            <div class="tuan_g_btn"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                        <div class="order_opt" style="padding: 0px 0px 0px;">
                            <span class="order_status">
                  				<?php  if($order['lasttime'] >0) { ?>
    								<?php  if(intval($order['status'])==0) { ?>  
    									【未支付】 
    								<?php  } else if($order['itemnum'] < $order['groupnum']) { ?>  
      								【团购进行中】
      								<?php  } else if($order['itemnum'] == $order['groupnum'] ) { ?>  
    								【团购结束】【团购成功】
    								<?php  } ?>
                  				<?php  } else { ?>
                  					<?php  if(intval($order['status'])==0) { ?>  
    								【团购过期】【未支付】 
    								<?php  } else if($order['itemnum'] < $order['groupnum']) { ?>  
      								【 团购过期】【团购失败】
      								<?php  } else if($order['itemnum'] == $order['groupnum'] ) { ?>  
    								【团购过期】【团购成功】
    								<?php  } ?>
                  				<?php  } ?>
                            </span>
                            <?php  if($order['lasttime'] <0 && $order['itemnum'] < $order['groupnum'] && $order['transid']!='') { ?>
                            	<?php  if($order['status']==1 ) { ?>
                            <div class="order_btn" ms-visible="order.total_status==3" style="margin: 5px;">
                                <a ms-click="orderCancel(order.order_id)" class="state_btn_2" href="<?php  echo $this->createMobileUrl('user_refund', array('transid'=>$order['transid']));?>" style="line-height: 25px;height: 25px;">点击退款</a>
                           </div>
                          		<?php  } else if($order['status']==4) { ?>
                           		<div class="order_btn" ms-visible="order.total_status==3" style="margin: 5px;">
                                		<a style="line-height: 25px;height: 25px;">已退款</a>
                          		</div>
                           		<?php  } ?>
                           <?php  } ?>
                        </div>
                   <!--  </div> -->
					<div class="mt_status" style="height: 38px;">
		 			<a href="<?php  echo $this->createMobileUrl('group', array('tuan_id'=>$order['tuan_id']));?>" class="mt_status_lk" style="height: 27px;margin-top: 0px;line-height: 25px;">查看团详情</a>
					</div>
                </div>
            </div>
        <?php  } } ?>
  	</div>
    <div style="height:58px;visibility:hidden "></div>
	<?php  if($this->module['config']['mode'] == 1) { ?>
    <!-- <footer class="footer" style="z-index: 1000;">
        <nav>
            <ul>
                <li><a href="<?php  echo $this->createMobileUrl('index')?>" class="nav-controller"><i class="fa fa-home"></i>首页</a></li>
                <li><a href="<?php  echo $this->createMobileUrl('mygroup',array('op'=>0));?>" class="nav-controller active"><i class="fa fa-group"></i>我的团</a></li>
                <li><a href="<?php  echo $this->createMobileUrl('myorder')?>" class="nav-controller"><i class="fa fa-list"></i>我的订单</a></li>
                <li><a href="<?php  echo $this->createMobileUrl('person')?>" class="nav-controller"><i class="fa fa-user"></i>个人中心</a></li>
            </ul>
        </nav>
    </footer> -->
	<?php  } else { ?>
    	<!-- <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?> -->
    <?php  } ?>
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
	    	window.location.href =adurl;
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
	    	window.location.href =adurl;
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

