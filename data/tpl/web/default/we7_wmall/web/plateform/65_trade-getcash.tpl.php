<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/nav', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/trade-nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/trade-nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'getcashlog') { ?>
<div class="clearfix">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form" id="getcashlog">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="we7_wmall">
				<input type="hidden" name="do" value="ptftrade"/>
				<input type="hidden" name="op" value="getcashlog"/>
				<input type="hidden" name="sid" value="<?php  echo $sid;?>"/>
				<input type="hidden" name="status" value="<?php  echo $status;?>"/>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">门店</label>
					<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
						<select name="sid" class="form-control" style="width:213px">
							<option value="0" <?php  if(!$sid) { ?>selected<?php  } ?>>所有门店</option>
							<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
							<option value="<?php  echo $store['id'];?>" <?php  if($store['id'] == $sid) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-2 control-label">申请时间</label>
					<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
						<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
					<div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="alert alert-info">
		<h4>
			<i class="fa fa-info-circle"></i>
			说明: 支付宝提现申请,需要平台管理员手动打款,打款后标记对应的提现申请处理成功<br>
		</h4>
		<h4>
			<i class="fa fa-info-circle"></i>
			说明: 微信提现申请,平台管理员可直接点击"打款按钮", 系统会直接把对应的提现金额打到提现人的微信. 此操作需要上传微信支付证书,<a href="<?php  echo $this->createWebUrl('ptfconfig', array('op' => 'pay'));?>" target="_blank">点我去设置</a><br>
		</h4>
	</div>
	<form class="form-horizontal" action="" method="post" id="">
		<ul class="order-nav order-nav-tabs">
			<li <?php  if($status == 0) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:0');?>">全部</a></li>
			<li <?php  if($status == 2) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:2');?>">申请中</a></li>
			<li <?php  if($status == 1) { ?>class="active"<?php  } ?>><a href="<?php  echo filter_url('status:1');?>">提现成功</a></li>
		</ul>
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
					<tr>
						<th>申请时间|订单号</th>
						<th>门店</th>
						<th>账户类型</th>
						<th>账户</th>
						<th>提现金额</th>
						<th>手续费</th>
						<th>到账金额</th>
						<th>交易状态</th>
						<th width="170">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($records)) { foreach($records as $record) { ?>
					<tr>
						<td>
							<?php  echo date('Y-m-d H:i', $record['addtime']);?>
							<br>
							<?php  echo $record['trade_no'];?>
						</td>
						<td><?php  echo $stores[$record['sid']]['title'];?></td>
						<td>
							<?php  if($record['account_type'] == 'alipay') { ?>
							<span class="label label-success">支付宝</span>
							<?php  } else { ?>
							<span class="label label-danger">微信</span>
							<?php  } ?>
						</td>
						<td>
							<?php  if($record['account_type'] == 'alipay') { ?>
							<span class="label label-info label-br">账号:<?php  echo $record['account']['account'];?></span>
							<br>
							<span class="label label-info label-br">姓名:<?php  echo $record['account']['realname'];?></span>
							<?php  } else { ?>
							<img src="<?php  echo $record['account']['avatar'];?>" width="50" alt=""/>
							<br>
							<span class="label label-info label-br">昵称:<?php  echo $record['account']['nickname'];?></span>
							<br>
							<span class="label label-info label-br">姓名:<?php  echo $record['account']['realname'];?></span>
							<?php  } ?>
						</td>
						<td><?php  echo $record['get_fee'];?>元</td>
						<td><?php  echo $record['take_fee'];?>元</td>
						<td><?php  echo $record['final_fee'];?>元</td>
						<td>
							<?php  if($record['status'] == 2) { ?>
								<span class="label label-danger">申请中</span>
							<?php  } else { ?>
								<span class="label label-success">提现成功</span>
								<br>
								<span class="label label-info label-br">完成时间: <?php  echo date('Y-m-d H:i', $record['endtime'])?></span>
							<?php  } ?>
						</td>
						<td>
							<?php  if($record['status'] != 1) { ?>
								<?php  if($record['account_type'] == 'wechat') { ?>
									<a href="<?php  echo $this->createWebUrl('ptftrade', array('op' => 'transfers', 'id' => $record['id']));?>" onclick="if(!confirm('确定变更提现状态吗')) return false;" class="btn btn-success btn-sm">微信打款</a>
								<?php  } ?>
								<a href="<?php  echo $this->createWebUrl('ptftrade', array('op' => 'gatcashstatus', 'id' => $record['id'], 'status' => 1));?>" onclick="if(!confirm('确定变更提现状态吗')) return false;" class="btn btn-default btn-sm">设为已处理</a>
							<?php  } ?>
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
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>