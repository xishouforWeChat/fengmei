<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('manage/header', TEMPLATE_INCLUDEPATH)) : (include template('manage/header', TEMPLATE_INCLUDEPATH));?>
<div class="page" id="page-manage-goods">
	<header class="bar bar-nav common-buttons-nav">
		<div class="row">
			<div class="col-10 align-left">
				<a class="back" href="javascript:;"><i class="fa fa-arrow-left"></i></a>
			</div>
			<div class="col-80">
				<div class="buttons-row align-center">
					<a href="<?php  echo $this->createMobileUrl('mggoods', array('op' => 'list'));?>" class="button">商品列表</a>
					<a href="<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category_list'));?>" class="active button">商品分组</a>
				</div>
			</div>
			<div class="col-10 align-right">
				<a class="pull-right goods-category-edit" href="javascript:;"><i class="fa fa-plus"></i></a>
			</div>
		</div>
	</header>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('manage/nav', TEMPLATE_INCLUDEPATH)) : (include template('manage/nav', TEMPLATE_INCLUDEPATH));?>
	<div class="content">
		<div class="buttons-tab">
			<a href="<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category', 'status' => -1));?>" class="button <?php  if($status == -1) { ?>active<?php  } ?>">所有分组</a>
			<a href="<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category', 'status' => 1));?>" class="button <?php  if($status == 1) { ?>active<?php  } ?>">上架中</a>
			<a href="<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category', 'status' => 0));?>" class="button <?php  if($status == 0) { ?>active<?php  } ?>">已下架</a>
		</div>
		<?php  if(empty($lists)) { ?>
			<div class="no-data">
				<div class="bg"></div>
				<p>暂无商品分组～</p>
			</div>
		<?php  } else { ?>
			<?php  if(is_array($lists)) { foreach($lists as $list) { ?>
				<div class="group-item">
					<div class="group-item-title"><?php  echo $list['title'];?><span>共 <?php  echo intval($nums[$list['id']]['num'])?> 件</span>
						<?php  if($list['status'] == 1) { ?>
							<p class="color-success">上架中</p>
						<?php  } else { ?>
							<p class="color-danger">下架中</p>
						<?php  } ?>
					</div>
					<div class="group-item-operate">
						<a href="javascript:;" class="goods-category-del" data-id="<?php  echo $list['id'];?>"f>删除</a>
						<a href="javascript:;" class="goods-category-edit" data-id="<?php  echo $list['id'];?>" data-title="<?php  echo $list['title'];?>" data-displayorder="<?php  echo $list['displayorder'];?>">编辑</a>
						<a href="javascript:;" class="goods-category-status" data-id="<?php  echo $list['id'];?>" data-status="<?php  echo $list['status'];?>"><?php  if($list['status'] == 1) { ?>下架<?php  } else { ?>上架<?php  } ?></a>
						<a href="javascript:;">商品</a>
					</div>
				</div>
			<?php  } } ?>
		<?php  } ?>
	</div>
</div>
<div class="popup popup-goods-category">
	<div class="page">
		<header class="bar bar-nav common-bar-nav">
			<h1 class="title">商品分组</h1>
			<a href="javascript:;" class="pull-right close-popup">关闭</a>
		</header>
		<div class="content">
			<form action="" method="post" id="goods-category-form">
				<div class="list-block">
					<ul>
						<li>
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">分组名称</div>
									<div class="item-input">
										<input type="text" name="title" class="category-title" placeholder="输入分组名称">
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-inner">
									<div class="item-title label">分组排序</div>
									<div class="item-input">
										<input type="text" name="displayorder" class="category-displayorder" placeholder="输入分组排序">
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="content-padded">
					<a href="javascript:;" class="button button-big button-fill button-danger button-submit">保存</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
$(function(){
	$('.goods-category-edit').click(function(){
		var id = parseInt($(this).data('id'));
		if(id > 0) {
			$('#goods-category-form .category-title').val($(this).data('title'));
			$('#goods-category-form .category-displayorder').val($(this).data('displayorder'));
		}
		$.popup('.popup-goods-category');
		$('#goods-category-form .button-submit').click(function(){
			var title = $.trim($('.category-title').val());
			if(!title) {
				$.toast('分组名称不能为空');
				return false;
			}
			var displayorder = parseInt($.trim($('.category-displayorder').val()));
			if(isNaN(displayorder)) {
				$.toast('排序只能是数字');
				return false;
			}
			var params = {
				id: id,
				title: title,
				displayorder: displayorder
			};
			$.post("<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category_post'));?>", params, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					$.toast(result.message.message);
					return false;
				}
				$.toast('编辑商品分组成功', location.href, 1000);
			});
		});
	});

	$('.goods-category-status').click(function(){
		var id = parseInt($(this).data('id'));
		var status = $(this).data('status') == 1 ? 0 : 1;
		var type = (status == 1 ? '上架' : '下架');
		$.confirm('确定' + type + '该分组吗?', function() {
			$.post("<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category_status'))?>", {id: id, status: status}, function(data){
				$.toast(type + '成功', location.href);
			});
		});
	});

	$('.goods-category-del').click(function(){
		var id = parseInt($(this).data('id'));
		$.confirm('删除分组后, 分组下面的商品也会被删除, 确定删除?', function() {
			$.post("<?php  echo $this->createMobileUrl('mggoods', array('op' => 'category_del'))?>", {id: id}, function(data){
				$.toast('删除分组成功', location.href);
			});
		});
	});

});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('manage/common', TEMPLATE_INCLUDEPATH)) : (include template('manage/common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('manage/footer', TEMPLATE_INCLUDEPATH)) : (include template('manage/footer', TEMPLATE_INCLUDEPATH));?>