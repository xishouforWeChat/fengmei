<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'account') { ?>
<div class="page register">
	<header class="bar bar-nav common-bar-nav">
		<h1 class="title">商户入驻</h1>
	</header>
	<div class="content">
		<form action="" method="post" id="form-account">
			<div class="list-block">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">账号</div>
								<div class="item-input">
									<input type="text" name="username" placeholder="由4-16位字母、数字、下划线组成">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">密码</div>
								<div class="item-input">
									<input type="password" name="password" placeholder="1-8位密码">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">确认密码</div>
								<div class="item-input">
									<input type="password" name="repassword" placeholder="1-8位密码">
								</div>
							</div>
						</div>
					</li>
					<?php  if($settle_config['mobile_verify_status'] == 1) { ?>
						<li>
							<div class="item-content verify-code">
								<div class="item-inner">
									<div class="item-title label">手机</div>
									<div class="item-input">
										<input type="text" name="mobile" placeholder="手机号">
									</div>
									<div class="item-button">
										<a class="button button-danger" href="javascript:;" id="btn-code">获取验证码</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">验证码</div>
									<div class="item-input">
										<input type="text" name="code" placeholder="输入手机收到的验证码">
									</div>
								</div>
							</div>
						</li>
					<?php  } else { ?>
						<li>
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">手机</div>
									<div class="item-input">
										<input type="text" name="mobile" placeholder="手机号">
									</div>
								</div>
							</div>
						</li>
					<?php  } ?>
				</ul>
			</div>
			<div class="content-padded color-danger hide">*手机号仅做账号真实性验证,请认真填写</div>
			<div class="content-padded">
				<a href="javascript:;" class="button bg-danger button-big btn-sub" id="btn-account">下一步</a>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	var $mobile_verify_status = "<?php  echo $settle_config['mobile_verify_status'];?>";
	if($mobile_verify_status == 1) {
		$('#btn-code').click(function(){
			if($(this).hasClass('disabled')) {
				return false;
			}
			var mobile = $.trim($(':text[name="mobile"]').val());
			if(!mobile) {
				$.toast('请输入手机号');
				return false;
			}
			var reg = /^1[34578][0-9]{9}/;
			if(!reg.test(mobile)) {
				$.toast('手机号格式错误');
				return false;
			}
			var $this = $(this);
			$this.addClass("disabled");
			var downcount = 60;
			$this.html(downcount + "秒后重新获取");
			var timer = setInterval(function(){
				downcount--;
				if(downcount <= 0){
					clearInterval(timer);
					$this.html("重新获取验证码");
					$this.removeClass("disabled");
					downcount = 60;
				}else{
					$this.html(downcount + "秒后重新获取");
				}
			}, 1000);

			$.post("<?php  echo $this->createMobileUrl('cmncode', array('sid' => 0, 'product' => $_W['we7_wmall']['config']['title'] . '商户入驻'))?>", {mobile: mobile}, function(data){
				if(data != 'success') {
					$.toast(data);
				} else {
					$.toast('验证码发送成功, 请注意查收');
				}
			});
			return false;
		});
	}

	$('#btn-account').click(function(){
		var username = $.trim($('#form-account :text[name="username"]').val());
		if(!username) {
			$.toast('用户名不能为空');
			return false;
		}
		var password = $.trim($('#form-account :password[name="password"]').val());
		if(!password) {
			$.toast('密码不能为空');
			return false;
		}
		var repassword = $.trim($('#form-account :password[name="repassword"]').val());
		if(repassword != password) {
			$.toast('两次密码输入不一致');
			return false;
		}

		var mobile = $.trim($('#form-account :text[name="mobile"]').val());
		var reg = /^1[34578][0-9]{9}$/;
		if(!reg.test(mobile)) {
			$.toast("手机号格式错误");
			return false;
		}
		var code = '';
		if($mobile_verify_status == 1) {
			code = $.trim($('#form-account :text[name="code"]').val());
			if(!code) {
				$.toast("验证码不能为空");
				return false;
			}
		}
		var params = {
			username: username,
			password: password,
			mobile: mobile,
			code: code
		}

		$.post("<?php  echo $this->createMobileUrl('settle', array('op' => 'account'))?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				return false;
			} else {
				$.toast('注册成功,跳转中...', "<?php  echo $this->createMobileUrl('settle', array('op' => 'store'))?>");
				return false;
			}
		});
	});
});
</script>
<?php  } ?>

<?php  if($op == 'store') { ?>
<div class="page business-enter">
	<header class="bar bar-nav common-bar-nav">
		<h1 class="title">商户信息</h1>
	</header>
	<div class="content">
		<form action="" method="post" id="form-store">
			<div class="list-block">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">商户名称</div>
								<div class="item-input">
									<input type="text" name="title" placeholder="店铺名称">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">商户地址</div>
								<div class="item-input">
									<input type="text" name="address" placeholder="店铺详细地址">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">联系电话</div>
								<div class="item-input">
									<input type="text" name="telephone" placeholder="店铺负责人电话">
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title label">商户简介</div>
								<div class="item-input">
									<textarea rows="3" name="content" placeholder="选填"></textarea>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<?php  if(!empty($settle_config['agreement'])) { ?>
				<div class="content-padded text-right color-gray">
					我已阅读并同意 <a href="javascript:;" class="color-danger open-popup" data-popup=".popup-settle-agreement">《商户入驻协议》</a>
				</div>
			<?php  } ?>
			<div class="content-padded">
				<a href="javascript:;" class="button bg-danger button-big btn-sub" id="btn-submit">提交</a>
			</div>
		</form>
	</div>
</div>
<div class="popup popup-settle-agreement">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">入驻协议</h1>
			<button class="button button-link button-nav pull-right close-popup">关闭</button>
		</header>
		<div class="content" style="background: #FFF">
			<div class="content-padded">
				<?php  echo $settle_config['agreement'];?>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$('#btn-submit').click(function(){
		var title = $.trim($('#form-store :text[name="title"]').val());
		if(!title) {
			$.toast('商户名称不能为空');
			return false;
		}
		var address = $.trim($('#form-store :text[name="address"]').val());
		if(!title) {
			$.toast('商户地址不能为空');
			return false;
		}
		var telephone = $.trim($('#form-store :text[name="telephone"]').val());
		if(!title) {
			$.toast('商户电话不能为空');
			return false;
		}
		var content = $.trim($('#form-store textarea[name="content"]').val());
		if(!title) {
			$.toast('商户简介不能为空');
			return false;
		}

		var params = {
			title: title,
			address: address,
			telephone: telephone,
			content: content
		}
		$.post("<?php  echo $this->createMobileUrl('settle', array('op' => 'store'))?>", params, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				return false;
			} else {
				$.toast('申请成功,跳转中...', "<?php  echo $this->createMobileUrl('settle', array('op' => 'store'))?>");
				return false;
			}
		});
	});
});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>