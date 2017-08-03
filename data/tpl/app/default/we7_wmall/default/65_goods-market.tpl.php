<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<div class="page store shopping shopcategory" id="page-app-goods">
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
	<div class="content infinite-scroll" data-distance="50" data-min="<?php  echo $min;?>" style="z-index: 10199">
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
		<div class="goods-category">
			<div class="goods-category-title">商品分类</div>
			<div class="goods-category-con row no-gutter">
				<?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
					<?php  $i++?>
					<a href="javascript:;" data-id="<?php  echo $category['id'];?>" class="col-33 category-row <?php  if($i >= 6) { ?>hide<?php  } ?>"><?php  echo $category['title'];?></a>
				<?php  } } ?>
				<?php  if($i > 5) { ?>
				<a href="javascript:;" class="col-33" id="category-toggle">更多 <i class="fa fa-arrow-down"></i></a>
				<?php  } ?>
			</div>
		</div>
		<div class="selection-goods" id="category-container">
			<form action="<?php  echo $this->createMobileUrl('submit', array('sid' => $sid, 'op' => 'goods'), true);?>" method="post" id="goods-form">
			<div class="selection-goods-title">精选商品</div>
			<div class="selection-goods-con row no-gutter">
				<?php  if(is_array($dish)) { foreach($dish as $ds) { ?>
				<div class="col-33 goods-item" id="goods-<?php  echo $ds['id'];?>">
					<a href="javascript:;">
						<div class="goods-img">
							<img src="<?php  echo tomedia($ds['thumb']);?>" class="goods-popup" data-id="<?php  echo $ds['id'];?>" alt="" />
							<span class="badge hide">0</span>
						</div>
						<div class="goods-title"><?php  echo $ds['title'];?></div>
						<div class="sales">月售<?php  echo $ds['sailed'];?><?php  echo $ds['unitname'];?></div>
						<div class="price">￥<span class="fee"><?php  echo $ds['price'];?></span></div>
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
									<span class="fa fa-plus no-init" data-is-options="0" data-num="<?php  echo $cart['data'][$ds['id']][0]['num'];?>" data-img="<?php  echo tomedia($ds['thumb']);?>"></span>
									<input autocomplete="off" class="h_num_0" type="hidden" name="goods[<?php  echo $ds['id'];?>][options][0]" value="0">
								</div>
							<?php  } ?>
						<?php  } else if($ds['is_options'] == 1) { ?>
							<div class="operate-num operate-goods hide" data-goods-id="<?php  echo $ds['id'];?>"  data-title="<?php  echo $ds['title'];?>" data-max="<?php  echo $ds['total'];?>" data-option-id="0" data-price="<?php  echo $ds['price'];?>">
								<span class="minus">
									<span class="fa fa-minus"></span>
									<span class="num">0</span>
								</span>
								<span class="fa fa-plus no-init" data-is-options="1" data-img="<?php  echo tomedia($ds['thumb']);?>"></span>
								<?php  if(is_array($ds['options'])) { foreach($ds['options'] as $option) { ?>
									<input autocomplete="off" class="h_num_<?php  echo $option['id'];?>" type="hidden" name="goods[<?php  echo $ds['id'];?>][options][<?php  echo $option['id'];?>]" value="0">
									<span class="options-num" data-goods-id="<?php  echo $ds['id'];?>" data-option-id="<?php  echo $option['id'];?>" data-price="<?php  echo $option['price'];?>" data-max="<?php  echo $option['total'];?>" data-option-name="<?php  echo $option['name'];?>" data-num="<?php  echo $cart['data'][$ds['id']][$option['id']]['num'];?>"></span>
								<?php  } } ?>
							</div>
							<div class="operate-goods">
								<span class="select-spec goods-option" data-id="<?php  echo $ds['id'];?>">可选规格</span>
							</div>
						<?php  } ?>
					<?php  } ?>
				</div>
				<?php  } } ?>
			</div>
			<div class="infinite-scroll-preloader hide">
				<div class="preloader"></div>
			</div>
			<div class="all-goods hide"><a href="javascript:;">已加载全部商品</a></div>
			</form>
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
			<div class="sell-info">已售<?php  echo $store['sailed'];?>份&nbsp;&nbsp;营业时间:<?php  echo $store['business_hours_cn'];?></div>
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
				<a class="searchbar-arrow close-popup" data-popup=".popup-search"><i class="fa fa-arrow-left"></i></a>
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
<script id="goods-init-list" type="text/html">
<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="col-33 goods-item" id="goods-<{d[i].id}>">
		<a href="javascript:;">
			<div class="goods-img">
				<img src="<{d[i].thumb_cn}>" class="goods-popup" data-id="<{d[i].id}>" alt="" />
				<span class="badge hide">0</span>
			</div>
			<div class="goods-title"><{d[i].title}></div>
			<div class="sales">月售<{d[i].sailed}><{d[i].unitname}></div>
			<div class="price">￥<span class="fee"><{d[i].price}></span></div>
		</a>
		<{# var cart = <?php  echo json_encode($cart['data']);?>;}>
		<{#if(d[i].is_in_business_hours == 1){ }>
			<{#if(d[i].is_options == 0){ }>
				<div class="operate-num operate-goods" data-goods-id="<{d[i].id}>" data-title="<{d[i].title}>" data-max="<{d[i].total}>" data-option-id="0" data-price="<{d[i].price}>">
					<span class="hide minus">
						<span class="fa fa-minus"></span>
						<span class="num">0</span>
					</span>
					<{#if(typeof cart[d[i].id] != 'undefined'){ }>
						<{# var num = cart[d[i].id]['0']['num'];}>
					<{# } else { }>
						<{# var num = 0;}>
					<{# } }>
					<span class="fa fa-plus no-init" data-is-options="0" data-num="<{num}>" data-img="<{d[i].thumb_cn}>"></span>
					<input autocomplete="off" class="h_num_0" type="hidden" name="goods[<{d[i].id}>][options][0]" value="0">
				</div>
			<{# } else { }>
				<div class="operate-num operate-goods hide" data-goods-id="<{d[i].id}>" data-title="<{d[i].title}>" data-max="<{d[i].total}>" data-option-id="0" data-price="<{d[i].price}>">
					<span class="minus">
						<span class="fa fa-minus"></span>
						<span class="num">0</span>
					</span>
					<span class="fa fa-plus no-init" data-is-options="1" data-img="<{d[i].thumb_cn}>"></span>
					<{# for(var j = 0, leng = d[i].options.length; j < leng; j++){ }>
						<{#if(typeof cart[d[i].id] != 'undefined'){ }>
							<{#if(typeof cart[d[i].id][d[i].options[j]] != 'undefined'){ }>
								<{# var num = cart[d[i].id][d[i].options[j]]['num'];}>
							<{# } else { }>
								<{# var num = 0;}>
							<{# } }>
						<{# } else { }>
							<{# var num = 0;}>
						<{# } }>
						<input autocomplete="off" class="h_num_<{d[i].options[j].id}>" type="hidden" name="goods[<{d[i].id}>][options][<{d[i].options[j].id}>]" value="0">
						<span class="options-num" data-goods-id="<{d[i].id}>" data-option-id="<{d[i].options[j].id}>" data-price="<{d[i].options[j].price}>" data-max="<{d[i].options[j].total}>"  data-num="<{num}>"></span>
					<{# } }>
				</div>
				<div class="operate-goods">
					<span class="select-spec goods-option" data-id="<{d[i].id}>">可选规格</span>
				</div>
			<{# } }>
		<{# } }>
	</div>
<{# } }>
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

<script id="goods-detail" type="text/html">
	<div class="popup popup-goods-detail">
		<div class="content-block">
			<div class="goods-img">
				<img src="<{d.thumb_}>" width= alt=""/>
				<a href="#" class="close-popup"><span class="fa fa-close"></span></a>
			</div>
			<div class="goods-name"><{d.title}></div>
			<div class="sell-info">已售<{d.sailed}>&nbsp;&nbsp;好评<{d.comment_good}></div>
			<div class="row no-gutter goods-num <{# if(d.is_options == 1){ }> hide<{# } }>">
				<div class="col-50 price">￥<span class="fee"><{d.price}></span></div>
				<div class="col-50 text-right operate-num <?php  if(!$store['is_in_business_hours']) { ?>hide<?php  } ?>">
					<span class="fa fa-minus goods-detail-minus" data-id="<{d.id}>"></span>
					<span class="num"><{d.hasNum}></span>
					<span class="fa fa-plus goods-detail-plus" data-id="<{d.id}>" data-max="<{d.total}>" data-option-id="0"></span>
				</div>
			</div>
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
				<a href="#" class="close-popup"><span class="fa fa-close"></span></a>
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

<script type="text/javascript" src="../addons/we7_wmall/resource/app/js/jquery.fly.min.js"></script>
<script>
$(function(){
	$(document).on('click', '.category-row', function(){
		$.showIndicator();
		var cid = $(this).data('id');
		var action = "<?php  echo $this->createMobileUrl('goods', array('sid' => $sid, 'op' =>'cate'), true);?>" + '&cid=' + cid + '#' + cid;
		$('#goods-form').attr('action', action);
		$('#goods-form').submit();
	});

	$('#category-toggle').click(function(){
		if($(this).find('i').hasClass('fa-arrow-down')) {
			$('.goods-category-con a').removeClass('hide');
			$(this).html('收起 <i class="fa fa-arrow-up"></i>');
		} else {
			$('.goods-category-con a:gt(4)').addClass('hide');
			$(this).removeClass('hide').html('更多 <i class="fa fa-arrow-down"></i>');
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
				$('#category-container span.minus .num').html(0);
				$('#category-container span.minus').addClass('hide');
				$('#category-container input[class^="h_num_"]').val(0);
				$('#category-container .goods-img .badge').html(0).addClass('hide');
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
		$('#goods-form').submit();
	});

	var left = 0, notice = $(this).find('.js-scroll-notice');
	setInterval(function(){
		left--;
		0 > left + notice.width() && (left = notice.width());
		notice.css({
			'left': left
		});
	}, 25);

	<?php  if(!$store['is_in_business_hours']) { ?>
		$.alert("<?php  echo $store['business_hours_cn'];?>", '店铺休息中!');
		setTimeout(function () {
			$.hidePreloader();
		}, 5000);
	<?php  } ?>

	$(document).on("pageInit", "#page-app-goods", function(e, id, page) {
		var loading = false;
		$(page).on('infinite', '.infinite-scroll',function() {
			var $this = $(this);
			var id = $this.data('min');
			if(!id) return;
			if (loading) return;

			loading = true;
			$this.find('.infinite-scroll-preloader').removeClass('hide');
			$.post("<?php  echo $this->createMobileUrl('goods', array('sid' => $sid, 'op' => 'more'))?>", {id: id, time: timeStamp}, function(data){
				var result = $.parseJSON(data);
				$this.attr('data-min', result.message.min);

				if(!result.message.min) {
					$.detachInfiniteScroll($('.infinite-scroll'));
					$('.infinite-scroll-preloader').remove();
					$('.all-goods').removeClass('hide');
					return;
				}

				$this.find('.infinite-scroll-preloader').removeClass('hide');
				var gettpl = $('#goods-init-list').html();
				loading = false;
				laytpl(gettpl).render(result.message.message, function(html){
					$this.find('.selection-goods-con').append(html);
				});
				__init();
			});
		});

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
					for(var i = 0; i < result.message.message.options.length; i++){
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
			var goods_id = $parent.data('goods-id');
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
			$parent.parents('#goods-' + goods_id).find('.badge').removeClass('hide').html(curNum);
			if(curNum > 0){
				//$(this).prev().removeClass('hide');
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
					top: event.pageY,
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
			var goods_id = $parent.data('goods-id');
			var option_id = $parent.data('option-id');
			var curNum = parseInt($parent.find(".h_num_" + option_id).val());
			if(curNum >= 1) {
				$num.text(--curNum);
				$parent.find(".h_num_" + option_id).val(curNum);
				$parent.parents('#goods-' + goods_id).find('.badge').html(curNum);
			}
			if(curNum < 1) {
				$(this).parent().addClass('hide');
				$parent.parents('#goods-' + goods_id).find('.badge').addClass('hide');
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
			$('#category-container .fa-plus.no-init').each(function(){
				flag = 1;
				var is_options = $(this).data('is-options');
				if(is_options == 0) {
					var num = $(this).data('num');
					for(var i = 0, num = parseInt(num); i < num; i++){
						$(this).trigger('click');
					}
					$(this).removeClass('no-init');
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
						$('#goods-' + goods_id + ' .fa-plus').removeClass('no-init');
					});
				}
			});
			flag = 0;
		}
		__init();
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
				$.toast(result.message.errno);
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