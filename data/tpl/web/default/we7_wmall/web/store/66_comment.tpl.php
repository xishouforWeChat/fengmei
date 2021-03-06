<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('store/nav', TEMPLATE_INCLUDEPATH)) : (include template('store/nav', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
	.table td p{margin-bottom:0;}
</style>
<div class="main">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="we7_wmall">
				<input type="hidden" name="do" value="comment"/>
				<input type="hidden" name="op" value="list"/>
				<input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>"/>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">审核状态</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<div class="btn-group">
							<a href="<?php  echo filter_url('status:-1');?>" class="btn <?php  if($status == -1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">不限</a>
							<a href="<?php  echo filter_url('status:0');?>" class="btn <?php  if($status == 0) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">待审核</a>
							<a href="<?php  echo filter_url('status:1');?>" class="btn <?php  if($status == 1) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">审核通过</a>
							<a href="<?php  echo filter_url('status:2');?>" class="btn <?php  if($status == 2) { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">审核未通过</a>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">订单id</label>
					<div class="col-sm-9 col-xs-9 col-md-9">
						<input class="form-control" name="oid" placeholder="输入订单id" type="text" value="<?php  echo $_GPC['oid'];?>">
					</div>	
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-3 col-md-1 control-label">评论时间</label>
					<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
						<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
					<div class="col-xs-12 col-sm-3 col-md-2 col-lg-1">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<form class="form-horizontal" action="" method="post">
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>评论用户/手机号</th>
							<th style="width:350px;">评价</th>
							<th></th>
							<th>状态</th>
							<th>评论时间</th>
							<th style="width:300px; text-align:right;">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($data)) { foreach($data as $dca) { ?>
						<tr>
							<td>
								<b><?php  echo $dca['username'];?></b>
								<br>
								<b><?php  echo $dca['mobile'];?></b>
							</td>
							<td>
								<p>商品质量: 
									<?php 
										for($i = 0; $i < $dca['goods_quality']; $i++) {
											echo '<i class="fa fa-star"></i>';
										}
										for($i = $dca['goods_quality']; $i < 5; $i++) {
											echo '<i class="fa fa-star-o"></i>';
										}
									?>
								</p>
								<p>配送服务: 
									<?php 
										for($i = 0; $i < $dca['delivery_service']; $i++) {
											echo '<i class="fa fa-star"></i>';
										}
										for($i = $dca['delivery_service']; $i < 5; $i++) {
											echo '<i class="fa fa-star-o"></i>';
										}
									?>
								</p>
								<p class="note" data-title="<?php  echo $dca['note'];?>">
									评价:
									<?php  echo cutstr($dca['note'], 15, '...');?>
								</p>
							</td>
							<td>
								<?php  if(!empty($dca['thumbs'])) { ?>
								<span class="label label-info">有回复图片,可在订单详情里查看</span>
								<?php  } ?>
							</td>
							<td>
								<?php  if($dca['status'] == 1) { ?>
									<span class="label label-success">审核通过</span>
								<?php  } else if($dca['status'] == 2) { ?>
									<span class="label label-danger">审核未通过</span>
								<?php  } else { ?>
									<span class="label label-default">审核中</span>
								<?php  } ?>
							</td>
							<td><?php  echo date('Y-m-d H:i', $dca['addtime'])?></td>
							<td style="text-align:right; overflow:visible;">
								<div class="btn-group">
									<a href="javascript:;" class="btn btn-default btn-sm js-reply-comment" title="回复评价" data-id="<?php  echo $dca['oid'];?>" data-reply="<?php  echo $dca['reply'];?>"  data-toggle="tooltip" data-placement="top">回复</a>
									<a href="javascript:;" class="btn btn-default btn-sm js-detail-comment hide" title="评价详情" data-id="<?php  echo $dca['id'];?>" data-toggle="tooltip" data-placement="top">评价</a>
									<a href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $dca['oid']))?>" class="btn btn-default btn-sm" title="订单详情" data-toggle="tooltip" data-placement="top">订单详情</a>
									<a href="<?php  echo $this->createWebUrl('comment', array('op' => 'status', 'id' => $dca['id'], 'status' => 1))?>" class="btn btn-success btn-sm" title="审核通过" data-toggle="tooltip" data-placement="top">通过</a>
									<a href="<?php  echo $this->createWebUrl('comment', array('op' => 'status', 'id' => $dca['id'], 'status' => 2))?>" class="btn btn-danger btn-sm" title="审核未通过" data-toggle="tooltip" data-placement="top">未通过</a>
								</div>
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php  echo $pager;?>
	</form>
</div>

<div class="modal fade" id="order-reply-comment-container" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">评价回复</h4>
			</div>
			<div class="modal-body">
				<div class="input-group">
					<textarea  name="reply" class="form-control" placeholder="请填写/选择回复" rows="4"></textarea>
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="height:94px"><span class="caret"></span></button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu" style="width:850px">
							<?php  if(is_array($store_['comment_reply'])) { foreach($store_['comment_reply'] as $reply) { ?>
								<li><a href="javascript:;"><?php  echo $reply;?></a></li>
							<?php  } } ?>
						</ul>
					</div>
				</div>
				<span class="help-block">
					<a href="<?php  echo $this->createWebUrl('store', array('op' => 'post', 'id' => $sid, 'type' => 'comment'));?>" target="_blank"><i class="fa fa-plus-circle"></i> 添加评价回复</a>
				</span>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-primary js-reply-submit">确定</a>&nbsp;&nbsp;<a class="btn btn-default js-reply-cancel">取消</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="order-detail-comment-container" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">评价详情</h4>
			</div>
			<div class="modal-body">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.note').hover(function(){
		$(this).popover({
			html : true,
			placement : 'bottom',
			trigger : 'manual',
			title : '',
			content : $(this).attr('data-title')
		});
		$(this).popover('toggle');
	});

	$('.js-reply-comment').click(function(){
		var id = $(this).data('id')
		$container = $('#order-reply-comment-container');
		$container.modal('show');
		var reply =  $(this).data('reply');
		$container.find('textarea[name="reply"]').val(reply);
		$container.find('.dropdown-menu li').click(function(){
			var reply = $(this).text();
			$container.find('textarea[name="reply"]').val(reply);
		});
		$container.find('.js-reply-submit').click(function(){
			var content = $container.find('textarea[name="reply"]').val();
			if(!content) {
				util.message('请填写回复内容', '', 'info');
				return false;
			}
			$.post("<?php  echo $this->createWebUrl('comment', array('op' => 'reply'));?>", {id: id, content: content}, function(data){
				var data = $.parseJSON(data);
				if(data.message.errno != 0) {
					util.message(data.message.message, '', 'info');
					return false;
				} else {
					$container.modal('hide');
					location.reload();
				}
			});
		});
		$container.find('.js-reply-cancel').click(function(){
			$container.modal('hide');
		});
	});

	$('.js-detail-comment').click(function(){
		var id = $(this).data('id')
		$container = $('#order-detail-comment-container');
		$.post("<?php  echo $this->createWebUrl('comment', array('op' => 'detail'));?>", {id: id}, function(data){
			var data = $.parseJSON(data);
			if(data.message.errno != 0) {
				util.message(data.message.message, '', 'info');
				return false;
			} else {
				$container.find('.modal-body').html(data.message.message);
				$container.modal('show');
			}
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>
