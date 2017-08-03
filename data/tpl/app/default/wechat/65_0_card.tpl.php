<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<style>
		ul,li {padding:0; margin:0; border:0;}
		body{background:#d2e6e9; padding-bottom:63px;}
		.btn-group-top-box{padding:10px 0; border-bottom:1px solid #a5d7de; font-family:Helvetica, Arial, sans-serif; text-align:center; width:100%;}
		.btn-group-top{overflow:hidden;}
		.btn-group-top .btn{ -webkit-box-shadow:none; box-shadow:none; border-color:#5ac5d4; color:#5ac5d4; background:#d1e5e9; padding:6px;}
		.btn-group-top .btn:hover{color:#FFF; background:#addbe1;}
		.btn-group-top .btn.active{color:#FFF; background:#5ac5d4;}
		.btn.use{background:#56c6d6; color:#FFF; border:0; border-radius:4px;}

		.card-container{width:100%;max-width:640px;margin:0px auto;border-bottom:1px solid #a5d7de;}
		.card-list{width:100%;margin:10px 0;padding:0 13px}
		.card-list .top{height:60px;line-height:60px;background:#a9d92d url(./resource/images/card_tpl.png) repeat-x 0 bottom;border-top-left-radius:5px;border-top-right-radius:5px;}
		.card-list .top .img{float:left;padding:0 10px}
		.card-list .top .img img{width:40px;height:40px;border-radius:35px;}
		.card-list .top .title{float:left;color:#FFF;font-weight:bold;font-size:16px;letter-spacing:1px}
		.card-list .bottom{color:#b7b7b7;height:30px;line-height:30px;background:#FFF;padding:0 6px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;}
		.card-list .bottom .left-info{float:left;width:50%;overflow:hidden;}
		.card-list .bottom .right-info{float:right;width:50%;overflow:hidden;text-align:right;}
		.no-info{width:100%;padding:0 20px;text-align:center;height:40px;line-height:40px;color:#5ac5d4}
		.page{width:100%;margin:0 auto;text-align:center;}
		.page .pagination{padding:0;margin:0;}
		.page .pagination a{color:#5ac5d4;background:#d2e6e9;border:1px solid #a5d7de;}
		.page .pagination a:hover{color:#FFF;background:#addbe1;border:1px solid #a5d7de;}

		.card-info .card-top{ position:relative; width:100%; color:#fff; background-color:#a9d92d; padding:21px 12px 12px;}
		.card-top .logo img{width:38px; height:38px; border-radius:100%; margin-right:10px;}
		.card-top .title{font-size:24px; margin-bottom:10px;}
		.card-top .sub-title{margin-bottom:10px;}
		.card-top .border-img{position: absolute; bottom: -1px; left: 0; width: 100%; height: 5px; background: url(./resource/images/card_tpl.png) repeat-x;}
		.card-bottom{background:#fff; margin-bottom:15px; text-align:center; padding:15px 0;}
		.card-bottom .bar-code img{width:100%; height:auto; margin-bottom:5px;}
		.card-bottom .tips{margin:10px 0;}
		.wx-card .operate{background:#fff; padding:15px 10px;}
		.wx-card .operate input{margin-bottom:5px;}
	</style>
	<?php  if($do == 'display') { ?>
	<div class="btn-group-top-box">
		<div class="btn-group btn-group-top">
			<a href="<?php  echo url('wechat/card/display', array('type' => 'discount'))?>" class="btn btn-default <?php  if($type == 'discount') { ?>active<?php  } ?>">折扣券</a>
			<a href="<?php  echo url('wechat/card/display', array('type' => 'cash'))?>" class="btn btn-default <?php  if($type == 'cash') { ?>active<?php  } ?>">代金券</a>
			<a href="<?php  echo url('wechat/card/display', array('type' => 'groupon'))?>" class="btn btn-default <?php  if($type == 'groupon') { ?>active<?php  } ?>">团购券</a>
			<a href="<?php  echo url('wechat/card/display', array('type' => 'gift'))?>" class="btn btn-default <?php  if($type == 'gift') { ?>active<?php  } ?>">礼品券</a>
			<a href="<?php  echo url('wechat/card/display', array('type' => 'general_coupon'))?>" class="btn btn-default <?php  if($type == 'general_coupon') { ?>active<?php  } ?>">优惠券</a>
		</div>
	</div>
	<div class="clearfix card-container">
		<?php  if(!empty($data)) { ?>
			<?php  if(is_array($data)) { foreach($data as $da) { ?>
				<div class="card-list" data-id="<?php  echo $da['id'];?>">
					<div class="top" style="background:<?php  echo $colors[$da['color']];?>">
						<div class="img">
							<img src="<?php  echo $logo;?>"/>
						</div>
						<div class="title"><?php  echo $da['title'];?></div>
					</div>
					<div class="bottom">
						<div class="left-info"><?php  echo $da['brand_name'];?></div>
						<div class="right-info"><?php  echo $da['endtime'];?></div>
					</div>
				</div>
			<?php  } } ?>
			<div class="page"><?php  echo $pager;?></div>
		<?php  } else { ?>
			<div class="no-info"><i class="fa fa-info-circle"></i> 没有符合条件的优惠券</div>
		<?php  } ?>
	</div>
	<script>
		require(['util'], function(u){
			$('.card-list').click(function(){
				var id = parseInt($(this).attr('data-id'));
				if(!id) return false;
				$.post("<?php  echo url('wechat/card/detail')?>", {'id' : id}, function(data) {
					var data = $.parseJSON(data);
					if(data.errno) {
						u.message(data.error, '', 'error');
					} else {
						eval(data.error);
					}
					return false;
				});
			});
		});
	</script>
<?php  } else if($do == 'use') { ?>
<form action="" method="post" id="form1">
	<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
	<div class="wx-card">
		<div class="card-info">
			<div class="card-top" style="background: <?php  echo $colors[$card['color']];?>">
				<div class="logo">
					<img src="<?php  echo $card['logo_url'];?>" alt="" class="img-circle">
					<span><?php  echo $card['brand_name'];?></span>
				</div>
				<div class="title text-center"><?php  echo $card['title'];?></div>
				<div class="sub-title text-center"><?php  echo $card['sub_title'];?></div>
				<div class="date text-center">
					<?php  if($card['date_info']['time_type'] == 1) { ?>
					有效期:<?php  echo $card['date_info']['time_limit_start'];?>~<?php  echo $card['date_info']['time_limit_end'];?>
					<?php  } else { ?>
					有效期:领取后<?php  echo $card['date_info']['deadline'];?>天后生效,<?php  echo $card['date_info']['limit'];?>天有效
					<?php  } ?>
				</div>
				<div class="border-img"></div>
			</div>
			<div class="card-bottom">
				<?php  if($error_code == 1) { ?>
				<div class="text-muted">code码错误</div>
				<?php  } else { ?>
				<img src="<?php  echo url('wechat/card/qr', array('id' => $record['id'], 'code' => $code['code']));?>" alt=""/>
				<div class="text-muted">店员可使用微信扫描上面二维码进行核销</div>
				<div class="text-muted">code码：<?php  echo $code['code'];?></div>
				<?php  } ?>
				<div class="tips hide"><?php  echo $card['notice'];?></div>
			</div>
		</div>
		<div class="operate">
			<?php  if($error_code == 1) { ?>
			<a class="btn btn-danger btn-block" disabled>code码错误</a>
			<?php  } else if($error_signature == 1) { ?>
			<a class="btn btn-danger btn-block" disabled>签名错误</a>
			<?php  } else { ?>
			<input type="password" id="password" name="password" class="form-control" placeholder="请输入店员密码" style="margin-bottom:20px">
			<input type="submit" class="btn btn-success btn-block" name="submit" value="确定核销"/>
			<?php  } ?>
		</div>
	</div>
</form>
<script>
	require(['util'], function(u){
		$('#form1').submit(function(){
			if(!$.trim($('#password').val())) {
				u.message('请输入店员密码');
				return false;
			}
			return true;
		});
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>