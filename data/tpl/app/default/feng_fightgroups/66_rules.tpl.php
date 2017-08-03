<?php defined('IN_IA') or exit('Access Denied');?><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>拼团规则</title>
    <?php  echo register_jssdk();?>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link href="../addons/feng_fightgroups/template/css/rules.css" rel="stylesheet" combofile="qqpai/tuan/index_v2.shtml">
</head><body>
    <div class="help">
        <div id="common" class="help_tit" style="display: block;" data-unuse="1">拼团流程：</div>
        <div id="common_step" style="display: block;" class="help_step" data-unuse="1">
            <span class="help_i">1</span>
            <span class="help_t">选择心仪商品</span>
            <i></i>
            <span class="help_i">2</span>
            <span class="help_t">支付开团或参团</span>
            <i></i>
            <span class="help_i">3</span>
            <span class="help_t">邀请好友参团</span>
            <i></i>
            <span class="help_i">4</span>
            <span class="help_t">达到人数团购成功</span>
        </div>
    </div>
    <div style="display: block;" id="common_rule" class="rule">
    	<?php  if(empty($share_data['content'])) { ?>
    		<p class="rule_row"><span class="rule_num">(1)</span>选择商品开团：选择拼团商品下单，团即刻开启，但团长完成支付，方能获取转发链接，并在团开启24小时内邀请到相应人数的好友支付，此团方能成功；</p>
        <p class="rule_row"><span class="rule_num">(2)</span>团长：开团且该团第一位支付成功的人；</p>
        <p class="rule_row"><span class="rule_num">(3)</span>参团成员：通过分享出去的该团入口进入并完成付款加入该团的团员，参团成员也可以将该团分享出去邀约更多团员参团；</p>
        <p class="rule_row"><span class="rule_num">(4)</span>团购成功：从团长开团24小时内找到相应开团人数的好友参团，则该团成功，卖家发货；</p>
        <p class="rule_row"><span class="rule_num">(5)</span>团购失败：从团长开团24小时内未能找到相应开团人数的好友参团，则该团失败，系统会在1-2个工作日内自动原路退款至你的支付账户；</p>
        <p class="rule_row"><span class="rule_num">(6)</span>拼团，是基于好友的转发扩散，获取团购优惠，为了保证广大消费者的权益，<?php  echo $share_data['sname'];?>有权将判定为黄牛倒货的团解散并取消订单。</p>
        <?php  } else { ?>
        <?php  echo $share_data['content'];?>
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