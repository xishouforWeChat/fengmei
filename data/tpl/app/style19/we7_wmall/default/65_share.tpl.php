<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<div class="page share-page" id="page-app-share">
	<header class="bar bar-nav">
		<h1 class="title"><a href="javascript:;" class="back"><i class="fa fa-close"></i></a><span>邀请好友 各赢红包</span></h1>
	</header>
	<div class="content">
		<div class="init-area">
			<img src="<?php echo MODULE_URL;?>resource/app/img/init_pic.png" alt="">
		</div>
		<div class="init-info">
			<img src="<?php echo MODULE_URL;?>resource/app/img/init_bg.png" alt="">
			<div class="init-con">
				<div class="init-text">送好友最高<span>15元</span>红包，TA首次下单您也得</div>
				<div class="init-money"><i>¥</i>10</div>
				<div class="init-btn"><a href="javascript:;">发红包</a></div>
				<div class="init-active">活动规则&gt;</div>
			</div>
		</div>
		<div class="init-status">
			<div class="init-title">
				<div class="init-tab">
					<p class="init-tab-h"><i class="fa fa-selection"></i>成功邀请</p>
					<p class="init-tab-c">0<span>人</span></p>
				</div>
				<div class="init-tab">
					<p class="init-tab-h"><i class="fa fa-sponsorfill"></i>赚取红包</p>
					<p class="init-tab-c">0<span>元</span></p>
				</div>
			</div>
			<!-- 有人领取 start-->
			<div class="init-friend">
				共有<span>2</span>人接受了我的邀请
			</div>
			<div class="list-block media-list">
				<ul>
					<li>
						<div class="item-content">
							<div class="item-media"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg"></div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title">姓名</div>
								</div>
								<div class="item-subtitle">领取了您的红包</div>
								<div class="init-wait">等待下单</div>
							</div>
						</div>
					</li>
					<li>
						<div class="item-content">
							<div class="item-media"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i3/TB10LfcHFXXXXXKXpXXXXXXXXXX_!!0-item_pic.jpg_250x250q60.jpg"></div>
							<div class="item-inner">
								<div class="item-title-row">
									<div class="item-title">姓名</div>
								</div>
								<div class="item-subtitle">领取了您的红包</div>
								<div class="init-wait">等待下单</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<!-- 有人领取 end-->
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>