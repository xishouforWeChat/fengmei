<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/nav', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li<?php  if($op == 'set') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('ptfsettle', array('op' => 'set'));?>">商户入驻参数设置</a></li>
	<li<?php  if($op == 'list') { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('ptfsettle', array('op' => 'list'));?>">入驻列表</a></li>
</ul>
<?php  if($op == 'list') { ?>
<div class="main">
	<div class="main table-responsive">
		<form method="post" class="form-horizontal" id="form1">
			<ul class="order-nav order-nav-tabs">
				<li <?php  if($status == -1) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:-1');?>">全部</a></li>
				<li <?php  if($status == 2) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:2');?>">待审核</a></li>
				<li <?php  if($status == 1) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:1');?>">审核通过</a></li>
				<li <?php  if($status == 3) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:3');?>">审核未通过</a></li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead>
						<tr>
							<th>商户名称</th>
							<th>商户地址</th>
							<th>申请人</th>
							<th>申请人手机号</th>
							<th>审核状态</th>
							<th>申请时间</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody id="list">
						<?php  if(is_array($lists)) { foreach($lists as $item) { ?>
						<tr>
							<td><?php  echo $item['title'];?></td>
							<td><?php  echo $item['address'];?></td>
							<td><?php  echo $item['user']['nickname'];?></td>
							<td><?php  echo $item['user']['mobile'];?></td>
							<td>
								<span class="<?php  echo $store_status[$item['status']]['css'];?>"><?php  echo $store_status[$item['status']]['text'];?></span>
							</td>
							<td><?php  echo date('Y-m-d H:i', $item['addtime']);?></td>
							<td>
								<a href="javascript:;" data-id="<?php  echo $item['id'];?>" title="审核" class="btn btn-default btn-audit">审核</a>
								<a href="<?php  echo $this->createWebUrl('store', array('op' => 'post', 'id' => $item['id']));?>" title="编辑" target="_blank" class="btn btn-default">编辑</a>
								<a href="<?php  echo $this->createWebUrl('store', array('op' => 'del', 'id' => $item['id']));?>" class="btn btn-default" onclick="return confirm('此操作不可恢复，确认删除？');return false;" title="删除">删除</a>
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
</div>
<?php  } ?>
<div class="modal fade" id="store-audit-container" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">审核入驻申请</h4>
			</div>
			<div class="modal-body">
				<form action="" class="form-horizontal form">
					<div class="form-group">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<label class="radio-inline"><input type="radio" name="status" value="1" checked> 通过</label>
								<label class="radio-inline"><input type="radio" name="status" value="3"> 不通过</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">备注</label>
							<div class="col-sm-9 col-xs-9 col-md-9">
								<textarea name="remark" class="form-control" cols="30" rows="5"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-primary js-reply-submit">确定</a>&nbsp;&nbsp;
				<a class="btn btn-default" data-dismiss="modal">取消</a>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$('.btn-audit').click(function(){
		var id = $(this).data('id');
		if(!id) {
			return false;
		}
		$('#store-audit-container').modal('show');
		$('.js-reply-submit').click(function(){
			var status = $('#store-audit-container :radio[name="status"]:checked').val();
			var remark = $('#store-audit-container textarea[name="remark"]').val();
			$.post("<?php  echo $this->createWebUrl('ptfsettle', array('op' => 'audit'));?>", {id: id, status: status, remark: remark}, function(data){
				var result = $.parseJSON(data);
				if(result.message.errno != 0) {
					util.message(result.message.message);
					return;
				} else {
					location.reload();
				}
			});
		});
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>