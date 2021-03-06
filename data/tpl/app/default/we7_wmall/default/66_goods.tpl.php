<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<script type='text/javascript' src='../addons/we7_wmall/resource/app/js/iscroll-probe.js' charset='utf-8'></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6yAoynmTPNlTBa8z1X4LfwGE"></script>

<input type="hidden" id="baidu_lng" value="0">
<input type="hidden" id="baidu_lat" value="0">

<div class="page store shopcategory" id="page-app-goods">
	<nav class="bar bar-tab no-gutter shop-cart-bar">
		<div class="" id="cartEmpty">
			<div class="left empty">
				<span class="fa fa-shopping-cart"></span>购物车是空的
			</div>
			<div class="right text-center bg-grey"><?php  echo $store['send_price'];?>元起送</div>
		</div>
		<div class="hide" id="cartNotEmpty">
			<div class="left">
			<span class="cart">
				<span class="fa fa-shopping-cart"></span>
				<span class="badge bg-danger" id="cartNum">0</span>
			</span>
				共<span class="sum">￥<span id="totalPrice">0</span>元</span>
			</div>
			<div class="right text-center bg-grey">还差￥<span id="sendCondition"><?php  echo $store['send_price'];?></span>元起送</div>
			<div class="right text-center bg-danger hide" id="btnSubmit">选好了</div>
		</div>
	</nav>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>
	<header class="bar bar-nav common-bar-nav">
		<a class="icon fa fa-arrow-left pull-left back" href="javascript:;"></a>
		<h1 class="title open-popup" data-popup=".popup-privilege"><?php  echo $store['title'];?></h1>
		<a class="icon fa pull-right fa-search" href="javascript:;" style="margin-left: 5px"></a>
		<a class="icon fa pull-right <?php  if(!empty($is_favorite)) { ?>fa-favor-fill<?php  } else { ?>fa-favor<?php  } ?>" href="javascript:;" id="btn-favorite" data-id="<?php  echo $store['id'];?>" data-uid="<?php  echo $_W['member']['uid'];?>"></a>
	</header>
	<div class="store-notice open-popup" data-popup=".popup-privilege">
		<span class="js-scroll-notice">
			<span class="fa fa-voice"></span>
			<?php  if(!empty($store['notice'])) { ?>
				<?php  echo $store['notice'];?>
			<?php  } else { ?>
				营业时间: <?php  echo $store['business_hours_cn'];?>
			<?php  } ?>
		</span>
	</div>
	<div class="buttons-tab">
		<a href="<?php  echo $this->createMobileUrl('goods', array('sid' => $store['id']));?>" class="button active">商品</a>
		<a href="<?php  echo $this->createMobileUrl('store', array('sid' => $store['id'], 'op' => 'comment'));?>" class="button">评价</a>
		<a href="<?php  echo $this->createMobileUrl('store', array('sid' => $store['id']));?>" class="button">商家</a>
	</div>
	<div class="parent-category-wrapper">
		<div class="parent-category">
			<div id="cateMenu">
			<ul class="category-list">
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<?php  if(!empty($cate_dish[$category['id']])) { ?>
						<?php  $i++;?>
						<li <?php  if($i == 1) { ?>class="active"<?php  } ?> style="width: 100%">
							<a href="javascript:;">
								<?php  echo $category['title'];?>
							</a>
						</li>
					<?php  } ?>
				<?php  } } ?>
			</ul>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="category-container row no-gutter" style="padding-left: 20%">
				<?php  if(!empty($tokens)) { ?>
				<div class="coupon-show-container">
					<div class="coupon-show">
						<div class="coupon-sum">
							<span>￥</span><?php  echo $token['discount'];?>
						</div>
						<div class="division">
							<img src="<?php echo MODULE_URL;?>resource/app/img/division.png" alt="" />
						</div>
						<div class="coupon-info">
							<div class="coupon-title"><?php  echo $token['title'];?></div>
							<?php  if($token_nums > 1) { ?>
							<div class="condition">内含<?php  echo $token_nums;?>张券</div>
							<?php  } else { ?>
						<div class="condition">满<?php  echo $token['condition'];?>元可用</div>
							<?php  } ?>
						</div>
						<div class="get">
							<span class="btn-get" id="get-coupon">领券</span>
						</div>
					</div>
				</div>
				<?php  } ?>
			</div>
			<div class="category-container row no-gutter" id="category-container">
				<div class="children-category col-100">
					<form action="<?php  echo $this->createMobileUrl('submit', array('sid' => $sid, 'op' => 'goods'), true);?>" method="post" id="goods-form">
						<?php  if(is_array($categorys)) { foreach($categorys as $cate_row) { ?>
						<?php  if(!empty($cate_dish[$cate_row['id']])) { ?>
						<div class="children-category-wrapper">
							<div class="heading"><?php  echo $cate_row['title'];?></div>
							<ul class="list-block media-list">
								<?php  if(is_array($cate_dish[$cate_row['id']])) { foreach($cate_dish[$cate_row['id']] as $ds) { ?>
								<li id="goods-<?php  echo $ds['id'];?>">
									<a class="item-link item-content" data-id="<?php  echo $ds['id'];?>" href="javascript:;">
										<div class="item-media">
										<?php  if(!empty($ds['label'])) { ?>
										<span class="sale-badge bg-danger"><?php  echo $ds['label'];?></span>
										<?php  } ?>
										<img class="goods-popup" data-id="<?php  echo $ds['id'];?>" src="<?php  echo tomedia($ds['thumb']);?>" alt=""/>
									</div>
									<div class="item-inner">
										<div class="item-title-row">
											<div class="item-title"><?php  echo $ds['title'];?></div>
										</div>
										<div class="item-text">
											<div class="sell-info">已售<?php  echo $ds['sailed'];?><?php  echo $ds['unitname'];?>&nbsp;&nbsp; 好评<?php  echo $ds['comment_good'];?></div>
											<div class="price">￥<span class="fee"><?php  echo $ds['price'];?></span></div>
										</div>
									</div>
								</a>
								<?php  if($store['is_in_business_hours']) { ?>
									<?php  if(!$ds['is_options']) { ?>
										<?php  if(!$ds['total']) { ?>
											<div class="goods-tips">已售完</div>
										<?php  } else { ?>
											<div class="operate-num operate-goods" data-goods-id="<?php  echo $ds['id'];?>"  data-title="<?php  echo $ds['title'];?>" data-max="<?php  echo $ds['total'];?>" data-option-id="0" data-price="<?php  echo $ds['price'];?>">
												<span class="hide minus">
													<span class="fa fa-minus"></span>
													<span class="num">0</span>
												</span>
												<span class="fa fa-plus" data-is-options="0" data-num="<?php  echo $cart['data'][$ds['id']][0]['num'];?>"></span>
												<input autocomplete="off" class="h_num_0" type="hidden" name="goods[<?php  echo $ds['id'];?>][options][0]" value="0">
											</div>
										<?php  } ?>
									<?php  } else if($ds['is_options'] == 1) { ?>
										<div class="operate-num operate-goods hide" data-goods-id="<?php  echo $ds['id'];?>"  data-title="<?php  echo $ds['title'];?>" data-max="<?php  echo $ds['total'];?>" data-option-id="0" data-price="<?php  echo $ds['price'];?>">
											<span class="minus">
												<span class="fa fa-minus"></span>
												<span class="num">0</span>
											</span>
											<span class="fa fa-plus" data-is-options="1"></span>
											<?php  if(is_array($ds['options'])) { foreach($ds['options'] as $option) { ?>
												<input autocomplete="off" class="h_num_<?php  echo $option['id'];?>" type="hidden" name="goods[<?php  echo $ds['id'];?>][options][<?php  echo $option['id'];?>]" value="0">
												<span class="options-num" data-goods-id="<?php  echo $ds['id'];?>" data-option-id="<?php  echo $option['id'];?>" data-price="<?php  echo $option['price'];?>" data-max="<?php  echo $option['total'];?>" data-option-name="<?php  echo $option['name'];?>" data-num="<?php  echo $cart['data'][$ds['id']][$option['id']]['num'];?>"></span>
											<?php  } } ?>
										</div>
										<div class="operate-goods">
											<span class="select-spec goods-option" data-id="<?php  echo $ds['id'];?>">可选规格</span>
										</div>
									<?php  } ?>
								<?php  } else { ?>
									<div class="goods-tips">店铺休息中</div>
								<?php  } ?>
							</li>
							<?php  } } ?>
						</ul>
					</div>
					<?php  } ?>
					<?php  } } ?>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="popup popup-privilege">
	<div class="popup-opacity">
		<div class="content-block">
			<div class="store-name"><?php  echo $store['title'];?></div>
			<div class="star-rank">
				<span class="star-rank-outline">
					<span class="star-rank-active" style="width:<?php  echo $store['score_cn'];?>%"></span>
					<span class="star-rank-value"><?php  echo $store['score'];?></span>
				</span>
			</div>
			<div class="sell-info">已售<?php  echo $store['sailed'];?>份&nbsp;&nbsp;营业时间: <?php  echo $store['business_hours_cn'];?></div>
			<div class="evaluate">优惠活动</div>
			<?php  if($activity['first_order_status'] == 1) { ?>
			<div class="xin text-left">
				新用户在线支付
				<?php  if(is_array($activity['first_order_data'])) { foreach($activity['first_order_data'] as $first) { ?>
				满<?php  echo $first['condition'];?>元减<?php  echo $first['back'];?>元,
				<?php  } } ?>
			</div>
			<?php  } ?>
			<?php  if($activity['discount_status'] == 1) { ?>
			<div class="minus text-left">
				在线支付
				<?php  if(is_array($activity['discount_data'])) { foreach($activity['discount_data'] as $discount) { ?>
				满<?php  echo $discount['condition'];?>元减<?php  echo $discount['back'];?>元,
				<?php  } } ?>
			</div>
			<?php  } ?>
			<?php  if($activity['grant_status'] == 1) { ?>
			<div class="zeng text-left">
				在线支付
				<?php  if(is_array($activity['grant_data'])) { foreach($activity['grant_data'] as $grant) { ?>
				满<?php  echo $grant['condition'];?>元赠<?php  echo $grant['back'];?>,
				<?php  } } ?>
			</div>
			<?php  } ?>
			<?php  if($store['collect_coupon_status'] == 1) { ?>
			<div class="coupon text-left">
				进店可领取代金券
			</div>
			<?php  } ?>
			<?php  if($store['delivery_free_price'] > 0) { ?>
			<div class="free text-left">
				满<?php  echo $store['delivery_free_price'];?>元免配送费
			</div>
			<?php  } ?>
			<div class="announcement">商家公告</div>
			<div class="announcement-con">
				<?php  if(!empty($store['notice'])) { ?>
				<?php  echo $store['notice'];?><br>
				<?php  } ?>
				本店欢迎您下单，用餐高峰请提前下单，谢谢！
			</div>
			<p><a href="#" class="close-popup"><span class="fa fa-close"></span></a></p>
		</div>
	</div>
</div>

<div class="popup popup-search" id="popop-search-goods">
	<div class="page search-result search-goods">
		<div class="bar bar-header-secondary">
			<div class="searchbar">
				<a class="searchbar-arrow close-popup" data-popup=".popup-search" ><i class="fa fa-arrow-left"></i></a>
				<a class="searchbar-cancel">搜索</a>
				<div class="search-input">
					<label class="icon fa fa-search" for="search"></label>
					<input type="search" id='search' name="key" value="<?php  echo $_GPC['key'];?>" placeholder="搜索<?php  echo $store['title'];?>的商品"/>
				</div>
			</div>
		</div>
		<div class="content">
			<ul class="list-block media-list">
				<div class="common-no-con hide">
					<img src="<?php echo MODULE_URL;?>/resource/app/img/search_no_con.png" alt="">
					<p>没有符合条件的搜索结果!</p>
				</div>
				<div class="search-result-container"></div>
			</ul>
		</div>
	</div>
</div>

<script id="goods-detail" type="text/html">
	<div class="popup popup-goods-detail">
		<div class="content-block">
			<div class="goods-img">
				<img src="<{d.thumb_}>" width= alt=""/>
				<a href="#" class="close-popup" data-popup=".popup-goods-detail"><span class="fa fa-close"></span></a>
			</div>
			<div class="goods-name"><{d.title}></div>
			<div class="sell-info">已售<{d.sailed}>&nbsp;&nbsp;好评<{d.comment_good}></div>
			<{# if(d.is_options == 0){ }>
				<div class="row no-gutter goods-num">
					<div class="col-50 price">￥<span class="fee"><{d.price}></span></div>
					<div class="col-50 text-right operate-num <?php  if(!$store['is_in_business_hours']) { ?>hide<?php  } ?>">
						<span class="fa fa-minus goods-detail-minus" data-id="<{d.id}>"></span>
						<span class="num"><{d.hasNum}></span>
						<span class="fa fa-plus goods-detail-plus" data-id="<{d.id}>" data-max="<{d.total}>" data-option-id="0"></span>
					</div>
				</div>
			<{# } }>
			<div class="goods-evaluate">商品评价</div>
			<div class="praise text-center">好评率 <span class="rate"><{d.comment_good_percent}></span><span class="num">(共<{d.comment_total}>人评价)</span></div>
			<div class="progress">
				<div class="progress-bar">
					<div class="progress-active" style="width:<{d.comment_good_percent}>;"></div>
				</div>
			</div>
			<div class="goods-desc">商品描述</div>
			<div class="goods-desc-con">
				<{d.description}><br>
				温馨提示: 图片仅供参考,请以实物为准;<br>
				高峰时段及恶劣天气,请提前下单
			</div>
		</div>
	</div>
</script>
<script id="goods-option" type="text/html">
	<div class="popup popup-spec specs goods-option">
		<div class="content-block">
			<div class="goods-title">
				<{d.title}>
				<a href="#" class="close-popup" data-popup=".popup-spec.goods-option"><span class="fa fa-close"></span></a>
			</div>
			<div class="sell-info">已售<{d.sailed}>&nbsp;&nbsp;好评<{d.comment_good}></div>
			<dl class="standard-con">
				<dt>规格</dt>
				<{# for(var i = 0, len = d.options.length; i < len; i++){ }>
				<{# if(i == 0){ }>
				<{# var price = d.options[i].price; var value = d.options[i].value;}>
				<{# } }>
				<dd data-price="<{d.options[i].price}>" data-option-name="<{d.options[i].name}>" data-max="<{d.options[i].total}>" data-value="<{d.options[i].value}>" data-id="<{d.options[i].id}>" data-goods-id="<{d.id}>" class="goods-option-dd <{# if(i == 0){ }> selected<{# } }>" ><{d.options[i].name}></dd>
				<{# } }>
			</dl>
			<div class="parting-line"></div>
			<div class="row no-gutter">
				<div class="col-50 price">￥<{price}></div>
				<div class="col-50 text-right operate-num">
					<span class="fa fa-minus goods-option-minus" data-id="<{d.id}>"></span>
					<span class="num"><{value}></span>
					<span class="fa fa-plus goods-option-plus" data-id="<{d.id}>"></span>
				</div>
			</div>
		</div>
	</div>
</script>
<script id="goods-cart" type="text/html">
	<div class="popup popup-shop-cart">
		<div class="shop-cart-list">
			<div class="row no-gutter popup-shop-cart-header">
				<div class="col-50"><span><?php  echo $store['title'];?></span></div>
				<div class="col-50 text-right shop-cart-truncate"><img src="<?php echo MODULE_URL;?>resource/app/img/icon-trash.png" alt="" /><span class="color-gray">清空购物车</span></div>
			</div>
			<{# for(var i = 0, len = d.length; i < len; i++){ }>
			<div class="row no-gutter list-item" id="shop-cart-list-item-<{d[i].goods_id}>-<{d[i].option_id}>">
				<div class="col-42 goods-title"><{d[i].title}></div>
				<div class="col-25 color-orange text-right goods-price">￥<{d[i].total_price}></div>
				<div class="col-33 text-right">
					<div class="operate-num" data-price="<{d[i].price}>" data-option-name="<{d[i].option_name}>" data-max="<{d[i].total}>" data-option-id="<{d[i].option_id}>" data-goods-id="<{d[i].goods_id}>" >
						<span class="fa fa-minus"></span>
						<span class="num"><{d[i].num}></span>
						<span class="fa fa-plus"></span>
					</div>
				</div>
			</div>
			<{# } }>
		</div>
	</div>
</script>
<script id="goods-list" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<li>
		<a class="item-link item-content" href="javascript:;">
			<div class="item-media">
				<{# if(d[i].label != ''){ }>
					<span class="sale-badge bg-danger"><{d[i].label}></span>
				<{# } }>
				<img class="goods-popup" data-id="<{d[i].id}>" src="<{d[i].thumb_cn}>" alt=""/>
			</div>
			<div class="item-inner">
				<div class="item-title-row">
					<div class="item-title"><{d[i].title}></div>
				</div>
				<div class="item-text">
					<div class="sell-info">已售<{d[i].sailed}><{d[i].unitname}>&nbsp;&nbsp; 好评<{d[i].comment_good}></div>
					<div class="price">￥<span class="fee"><{d[i].price}></span></div>
				</div>
			</div>
		</a>
		<{# if(d[i].is_in_business_hours){ }>
			<{# if(d[i].is_options != 1){ }>
				<div class="operate-num operate-goods">
					<span class="minus <{# if(d[i].num == 0){ }>hide<{# } }>">
						<span class="fa fa-minus goods-search-minus" data-id="<{d[i].id}>"></span>
						<span class="num"><{d[i].num}></span>
					</span>
					<span class="fa fa-plus goods-search-plus" data-id="<{d[i].id}>" data-max="<{d[i].total}>" data-option-id="0"></span>
				</div>
			<{# } else { }>
				<div class="operate-goods">
					<span class="select-spec goods-option" data-id="<{d[i].id}>">可选规格</span>
				</div>
			<{# } }>
		<{# } else { }>
			<div class="goods-tips">店铺休息中</div>
		<{# } }>
	</li>
	<{# } }>
</script>
<script type="text/javascript" src="../addons/we7_wmall/resource/app/js/jquery.fly.min.js"></script>
<script>
$(function(){

	//定位
	var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function (r)
    {
        if (this.getStatus() == BMAP_STATUS_SUCCESS) {
            var mk = new BMap.Marker(r.point);
            currentLat = r.point.lat;
            currentLon = r.point.lng;
            $("#baidu_lng").val(currentLon);
            $("#baidu_lat").val(currentLat);
        }
    });


	$(document).on('click', '.shop-cart-list .fa-plus', function(){
		var $parent = $(this).parents('.operate-num');
		var goods_id = $parent.data('goods-id');
		var option_id = $parent.data('option-id');
		if(!option_id) {
			return false;
		}
		var option_name = $parent.data('option-name');
		var price = $parent.data('price');
		var max = $parent.data('max');
		var curNum = parseInt($parent.find('.num').html());
		if(null != max && max != "" && max != "-1" && curNum >= max) {
			$.toast('抱歉,库存不足');
			return false;
		}
		$parent.find('.num').html(++curNum);
		$parent.parent().prev().html('￥' + (curNum * price).toFixed(2));
		$('#goods-' + goods_id).find('.operate-num').attr('data-option-id', option_id).attr('data-option-name', option_name).attr('data-price', price).attr('data-max', max);
		$('#goods-' + goods_id + ' .fa-plus').trigger('click');
		return false;
	});

	$(document).on('click', '.shop-cart-list .fa-minus', function(){
		var $parent = $(this).parents('.operate-num');
		var goods_id = $parent.data('goods-id');
		var option_id = $parent.data('option-id');
		if(!option_id) {
			return false;
		}
		var option_name = $parent.data('option-name');
		var price = $parent.data('price');
		var curNum = parseInt($parent.find('.num').html());
		if(curNum <= 0) {
			return false;
		}
		$parent.find('.num').html(--curNum);
		$parent.parent().prev().html('￥' + (curNum * price).toFixed(2));
		if(curNum <= 0) {
			$('#shop-cart-list-item-' + goods_id + '-' + option_id).remove();
		}
		if($('.popup-shop-cart .shop-cart-list .row.list-item').length == 0) {
			$.closeModal('.popup-shop-cart');
		}
		$('#goods-' + goods_id).find('.operate-num').attr('data-option-id', option_id).attr('data-option-name', option_name).attr('data-price', price);
		$('#goods-' + goods_id + ' .fa-minus').trigger('click');
		return false;
	});

	var cart = new Array();
	$(document).on('click', '.shop-cart-truncate', function(){
		$.post("<?php  echo $this->createMobileUrl('goods', array('op' => 'cart_truncate', 'sid' => $sid));?>", {}, function(data){
			var result = $.parseJSON(data);
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				return false;
			} else {
				var send_price = "<?php  echo $store['send_price'];?>";
				cart = new Array();
				$('.children-category-wrapper span.minus .num').html(0);
				$('.children-category-wrapper span.minus').addClass('hide');
				$('.children-category-wrapper input[class^="h_num_"]').val(0);
				$('#popop-search-goods .minus').addClass('hide');
				$('#popop-search-goods .minus .num').html(0);

				$('#cartNotEmpty').addClass('hide');
				$('#cartNotEmpty #totalPrice, #cartNotEmpty #cartNum').html(0);
				$('#cartNotEmpty #sendCondition').html(send_price);
				$('#cartEmpty').removeClass('hide');
				$.closeModal('.popup-shop-cart');
				return false;
			}
		});
	});

	$('#btnSubmit').click(function(){

		var lat = $("#baidu_lat").val();
		var lng = $("#baidu_lng").val();
		// var lat = 22;
		// var lng = 114;
		// if(lat == 0 || lng == 0)
		// {
		// 	$.toast('定位失败，无法计算配送距离！');
		// 	return;
		// }
		//判断距离
		$.post("<?php  echo $this->createMobileUrl('goods', array('op' => 'ajax_distance', 'sid' => $sid));?>", {lng:lng,lat:lat}, function(data){
			if(data.status==1)
			{
				$('#goods-form').submit();
			}

			console.log(data.status);
			if(data.status==2)
			{
				$.toast(data.msg);
				return;
			}

			if(data.status==3)
			{
				$.toast(data.msg);
				$('#goods-form').submit();
			}

		},"json");
	});

	<?php  if(!empty($store['notice'])) { ?>
		var left = 0, notice = $('.js-scroll-notice');
		setInterval(function(){
			left--;
			0 > left + notice.width() && (left = notice.width());
			notice.css({
				'left': left
			});
		}, 25);
	<?php  } ?>

	<?php  if(!$store['is_in_business_hours']) { ?>
		$.alert("<?php  echo $store['business_hours_cn'];?>营业", '店铺休息中!');
		setTimeout(function () {
			$.hidePreloader();
		}, 5000);
	<?php  } ?>

	$(document).on("pageInit", "#page-app-goods", function(e, id, page) {
		$(document).on('click', '.bar-nav .fa-search', function(){
			$('.search-input input').val('');
			$('.search-result-container').html('');
			$.popup('.popup-search');
		});

		$(document).on('click', '#popop-search-goods .searchbar-cancel', function(){
			var key = $('.search-input input').val();
			if(!key) {
				return false;
			}
			$('.search-result-container').html('');
			$.showIndicator();
			$.post("<?php  echo $this->createMobileUrl('goods', array('op' => 'search', 'sid' => $sid));?>", {key: key}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno == -1) {
					$.toast(result.message.message);
					return false;
				} else {
					if(result.message.message.length <= 0) {
						$.hideIndicator();
						$('#popop-search-goods .common-no-con').removeClass('hide');
						return false;
					}
					$('#popop-search-goods .common-no-con').addClass('hide');
					$.each(result.message.message, function(i, v){
						var goods_id = v.id;
						if(v.is_options == 0) {
							result.message.message[i].num = goodsNum(goods_id, 0);
						} else {
							$.each(v.options, function(j, d){
								result.message.message[i].options[j].num = goodsNum(goods_id, d.id);
							});
						}
					});
					var gettpl = $('#goods-list').html();
					laytpl(gettpl).render(result.message.message, function(html){
						$.hideIndicator();
						$('#popop-search-goods').find('.search-result-container').html(html);
					});
				}
			});
			return false;
		});

		$(document).on('click', '#cartNotEmpty .cart', function(){
			if(!$(this).hasClass('show')) {
				$(this).addClass('show');
				var gettpl = $('#goods-cart').html();
				laytpl(gettpl).render(cart, function(html){
					$.popup(html);
				});
			} else {
				$(this).removeClass('show')
				$.closeModal('.popup-shop-cart');
			}
		});

		$(document).on('click', '.goods-option-plus', function(){
			var $parent = $(this).parents('.goods-option');
			var id = $(this).data('id');
			var option_id = $parent.find('.standard-con dd.selected').data('id');
			if(!option_id) {
				return false;
			}
			var option_name = $parent.find('.standard-con dd.selected').data('option-name');
			var price = $parent.find('.standard-con dd.selected').data('price');
			var max = $parent.find('.standard-con dd.selected').data('max');
			var curNum = parseInt($parent.find('.operate-num .num').html());
			if(null != max && max != "" && max != "-1" && curNum >= max) {
				$.toast('抱歉,库存不足');
				return false;
			}
			$parent.find('.operate-num .num').html(++curNum);
			$('#goods-' + id).find('.operate-num').attr('data-option-id', option_id).attr('data-option-name', option_name).attr('data-price', price).attr('data-max', max);
			$('#goods-' + id + ' .fa-plus').trigger('click');
			return false;
		});

		$(document).on('click', '.goods-option-minus', function(){
			var $parent = $(this).parents('.goods-option');
			var id = $(this).data('id');
			var option_id = $parent.find('.standard-con dd.selected').data('id');
			if(!option_id) {
				return false;
			}
			var option_name = $parent.find('.standard-con dd.selected').data('option-name');
			var price = $parent.find('.standard-con dd.selected').data('price');
			var curNum = parseInt($parent.find('.operate-num .num').html());
			if(curNum <= 0) {
				return false;
			}
			$parent.find('.operate-num .num').html(--curNum);
			$('#goods-' + id).find('.operate-num').attr('data-option-id', option_id).attr('data-option-name', option_name).attr('data-price', price);
			$('#goods-' + id + ' .fa-minus').trigger('click');
			return false;
		});

		$(document).on('click', '.goods-option-dd', function(){
			var goods_id = $(this).data('goods-id');
			var options_id = $(this).data('id');
			var price = $(this).data('price');
			$(this).siblings().removeClass('selected');
			$(this).addClass('selected');
			$('.goods-option .no-gutter .price').html('¥ ' + price);
			$('.goods-option .no-gutter .num').html($('#goods-' + goods_id + ' .h_num_' + options_id).val());
		});

		$(document).on('click', '#category-container .goods-option, #popop-search-goods .goods-option', function(){
			var id = $(this).data('id');
			$.showIndicator();
			$.post("<?php  echo $this->createMobileUrl('goods', array('op' => 'detail', 'sid' => $sid));?>", {id: id}, function(data) {
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					$.hideIndicator();
					$.toast(result.message.message);
				} else {
					var val = {};
					for(var i = 0; i < result.message.message['options'].length; i++){
						val = result.message.message.options[i];
						result.message.message.options[i].value = parseInt($('#goods-' + id + ' .h_num_' + val.id).val());
					};
					var gettpl = $('#goods-option').html();
					laytpl(gettpl).render(result.message.message, function(html){
						$.hideIndicator();
						$.popup(html);
					});
				}
				return false;
			});
		});

		$(document).on('click', '.goods-popup', function(){
			var _this = $(this);
			var id = $(this).data('id');
			var num = goodsNum(id, 0);
			$.showIndicator();
			$.post("<?php  echo $this->createMobileUrl('goods', array('op' => 'detail', 'sid' => $sid));?>", {id: id}, function(data) {
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					$.hideIndicator();
					$.toast(result.message.message);
				} else {
					result.message.message.hasNum = num;
					var gettpl = $('#goods-detail').html();
					laytpl(gettpl).render(result.message.message, function(html){
						$.hideIndicator();
						$.popup(html);
					});
				}
				return false;
			});
		});

		$(document).on('click', '.goods-search-plus', function(){
			var id = $(this).data('id');
			var $minus = $(this).prev();
			var curNum = parseInt($minus.find('.num').html());
			var max = $(this).data('max');
			if(null != max && max != "" && max != "-1" && curNum >= max) {
				$.toast('抱歉,库存不足');
				return false;
			}
			$minus.removeClass('hide');
			$minus.find('.num').html(++curNum);
			$('#goods-' + id + ' .fa-plus').trigger('click');
			return false;
		});

		$(document).on('click', '.goods-search-minus', function(){
			var id = $(this).data('id');
			$('#goods-' + id + ' .fa-minus').trigger('click');
			var $num = $(this).next();
			var curNum = parseInt($num.html());
			if(curNum <= 0) {
				return false;
			}
			$num.html(--curNum);
			if(curNum == 0) {
				$(this).parent().addClass('hide');
			}
			return false;
		});

		$(document).on('click', '.goods-detail-plus', function(){
			var id = $(this).data('id');
			var $num = $(this).prev();
			var curNum = parseInt($num.html());
			var max = $(this).data('max');
			if(null != max && max != "" && max != "-1" && curNum >= max) {
				$.toast('抱歉,库存不足');
				return false;
			}
			$num.html(++curNum);
			$('#goods-' + id + ' .fa-plus').trigger('click');
			return false;
		});

		$(document).on('click', '.goods-detail-minus', function(){
			var id = $(this).data('id');
			$('#goods-' + id + ' .fa-minus').trigger('click');
			var $num = $(this).next();
			var curNum = parseInt($num.html());
			if(curNum >= 1) {
				$num.html(--curNum);
			}
			return false;
		});

		$(document).on('click', '#category-container .fa-plus', function(){
			var $parent = $(this).parent();
			var $num = $(this).prev().find('.num');
			var option_id = $parent.data('option-id');
			var max = $parent.data('max');
			var curNum = parseInt($parent.find(".h_num_" + option_id).val());
			if(null != max && max != "" && max != "-1" && curNum >= max) {
				if(!flag) {
					$.toast('抱歉,库存不足');
				}
				return false;
			}
			$num.text(++curNum);
			$parent.find(".h_num_" + option_id).val(curNum);
			if(curNum > 0){
				$(this).prev().removeClass('hide');
			}
			//计算购物车
			count($parent, '+');
			goodsCart($parent, '+');
			if(flag) {
				return false;
			}
			var flyer = $('<div class="u-flyer"></div>');
			flyer.fly({
				start: {
					left: event.pageX,
					top: event.pageY
				},
				end: {
					left: 25,
					top: $(window).height() - 20,
					width: 0,
					height: 0
				},
				onEnd: function(){}
			});
		});

		$(document).on('click', '#category-container .fa-minus', function(){
			var $parent = $(this).parent().parent();
			var $num = $(this).next();
			var option_id = $parent.data('option-id');
			var curNum = parseInt($parent.find(".h_num_" + option_id).val());
			if(curNum >= 1) {
				$num.text(--curNum);
				$parent.find(".h_num_" + option_id).val(curNum);
			}
			if(curNum < 1) {
				$(this).parent().addClass('hide');
			}
			//计算购物车
			count($parent, '-');
			goodsCart($parent, '-');
		});

		var goodsCart = function(obj, sign) {
			var goods_id = obj.data('goods-id');
			var option_id = obj.data('option-id');
			if(goods_id) {
				var marks = 0;
				for (var n in cart) {
					if (cart[n].goods_id == goods_id) {
						if(cart[n].option_id == option_id) {
							if (sign == '+') {
								cart[n].num += 1;
							} else {
								cart[n].num -= 1;
							}
							if(cart[n].num < 1) {
								cart.splice(n, 1);
							} else {
								cart[n].total_price = (cart[n].num * cart[n].price).toFixed(2);
							}
							marks = 1;
							break;
						}
					}
				}
				var detail = new Object();
				if (!marks) {
					detail.num = 1;
					detail.goods_id = goods_id;
					detail.option_id = option_id;
					detail.option_name = obj.data('option-name');
					detail.max = obj.data('max');
					if(option_id > 0) {
						detail.title = obj.data('title') + '(' + obj.data('option-name') + ')';
					} else {
						detail.title = obj.data('title');
					}
					detail.price = obj.data('price');
					detail.total_price = obj.data('price');
					cart.push(detail);
				}
			}
		}

		//获取某个商品的数量
		var goodsNum = function(goods_id, option_id) {
			if(cart.length == 0) {
				return 0;
			}
			var num = 0;
			for (var n in cart) {
				if (cart[n].goods_id == goods_id) {
					if(cart[n].option_id == option_id) {
						num = cart[n].num;
						break;
					}
				}
			}
			return num;
		}

		var count = function(obj, sign) {
			var $condition = $('#sendCondition'),
					$total = $('#totalPrice'),
					$cartNum = $('#cartNum'),
					$cartEmpty = $('#cartEmpty'),
					$cartNotEmpty = $('#cartNotEmpty'),
					sendCondition = parseFloat($condition.text()).toFixed(3),
					totalPrice = parseFloat($total.text()) || 0,
					disPrice = parseFloat(sign + 1) * parseFloat(obj.data('price')),
					price = totalPrice + disPrice,
					price = parseFloat(price.toFixed(3)),
					number = $cartNum.text() == '' ? 0 : parseInt($cartNum.text()),
					disNumber = number + parseInt(sign + 1);
			$total.text(price);
			$condition.text(parseFloat((sendCondition - disPrice).toFixed(3)));
			$cartNum.text(disNumber);
			if(sendCondition - disPrice <= 0){
				$condition.parent().hide().next().show();
			}else{
				$condition.parent().show().next().hide();
			}
			if(disNumber > 0){
				$cartEmpty.addClass('hide');
				$cartNotEmpty.removeClass('hide');
			}else{
				$cartEmpty.removeClass('hide');
				$cartNotEmpty.addClass('hide');
			}
			return false;
		}

		var flag = 0;
		function __init() {
			$('.children-category .fa-plus').each(function(){
				flag = 1;
				var is_options = $(this).data('is-options');
				if(is_options == 0) {
					var num = $(this).data('num');
					for(var i = 0, num = parseInt(num); i < num; i++){
						$(this).trigger('click');
					}
				} else {
					var $parent = $(this).parent();
					$parent.find('span.options-num').each(function(){
						var option_id = $(this).data('option-id');
						var goods_id = $(this).data('goods-id');
						if(!option_id) {
							return false;
						}
						var price = $(this).data('price');
						var max = $(this).data('max');
						var num = $(this).data('num');
						var option_name = $(this).data('option-name');
						$('#goods-' + goods_id).find('.operate-num').attr('data-option-id', option_id).attr('data-price', price).attr('data-option-name', option_name).attr('data-max', max);
						for(var i = 0, num = parseInt(num); i < num; i++){
							$('#goods-' + goods_id + ' .fa-plus').trigger('click');
						}
					});
				}
			});
			flag = 0;
		}

		__init();

		var menu = {
			offsetAry: [0],
			_is_left_menu_addclass: true,
			init: function(){
				var _this = this;
				var windowHeight = $(window).height();
				var maxLeftHeight = windowHeight - 200;
				$('#cateMenu').height(maxLeftHeight);
				if($('.parent-category ul').height() > maxLeftHeight) {
					if($.device.iphone) {
						new IScroll('#cateMenu', {probeType: 3, mouseWheel: true, click: false, tap: true})
					} else {
						new IScroll('#cateMenu', {probeType: 3, mouseWheel: true, click: true})
					}
				}

				$(document).on('click', '.parent-category li', function(){
					$('.parent-category li').removeClass('active');
					$(this).addClass('active');
					_this._is_left_menu_addclass = false;
					var t = $('.content').scrollTop();
					var t1 = _this.offsetAry[$('.parent-category li').index(this) + 1] - 125;
					var _t = Math.abs(t1-t);
					var _time =parseInt( Math.round(_t/3));
					$('.content').scrollTop(t1);
					setTimeout(function(){
						_this._is_left_menu_addclass=true;
					}, 300);
				});
				$('.children-category-wrapper .heading').each(function(){
					_this.offsetAry.push($(this).offset().top);
				});
				$('.content').bind('scroll', function(){
					_this.scroll.call(_this);
				});
			},

			getIndex: function(ary, value){
				var i = 0;
				for(; i < ary.length; i++){
					if(value >= ary[i] && value < ary[i + 1]){
						return i;
					}
				}
				return ary.length -1;
			},

			scroll: function(){
				var st = $('.content').scrollTop() + 125;
				var index = this.getIndex(this.offsetAry, st);
				var i = index - 1;
				if(this.curIndex !== index){
					if(this._is_left_menu_addclass) {
						$('.parent-category li').removeClass('active');
					}
					if(i >= 0){
						$('#category-container .parent-category').addClass('fixed');
						if(this._is_left_menu_addclass) {
							$('.parent-category li').eq(i).addClass('active');
						}
					} else {
						$('.parent-category li').eq(0).addClass('active');
						$('#category-container .parent-category').removeClass('fixed');
					}
					this.curIndex = index;
				}
			}
		};
		menu.init();
		<?php  if(!empty($_GPC['key'])) { ?>
			$('#popop-search-goods .searchbar-cancel').trigger('click');
			$.popup('.popup-search');
		<?php  } ?>
	});

	//领取优惠券
	$(document).on('click', '#get-coupon', function(){
		$.showIndicator();
		$.post("<?php  echo $this->createMobileUrl('coupon', array('op' => 'get', 'sid' => $sid))?>", {}, function(data){
			var result = $.parseJSON(data);
			$.hideIndicator();
			if(result.message.errno != 0) {
				$.toast(result.message.message);
				return false;
			} else {
				$('.coupon-show-container').hide();
				$.toast('领取优惠券成功');
				return false;
			}
		});
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>