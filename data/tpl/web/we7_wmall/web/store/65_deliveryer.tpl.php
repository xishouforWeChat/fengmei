<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('store/nav', TEMPLATE_INCLUDEPATH)) : (include template('store/nav', TEMPLATE_INCLUDEPATH));?>
<?php  if($op == 'list') { ?>
<div class="mian">
	<form class="form-horizontal" action="" method="post">
		<div class="form-group" style="margin-bottom:10px;margin-left:-35px">
			<div class="col-sm-12">
				<a href="javascript:;" class="btn btn-success btn-add" style="margin-left:20px">添加配送员</a>
				<!-- <a href="javasript:;" class="btn btn-primary" id="show-login-modal">注册/登录</a> -->
				<a href="<?php  echo $this->createWebUrl('deliveryer',array('op'=>'pranter'));?>" class="btn btn-primary">导出配送信息</a>
			</div>
		</div>
		<div class="alert alert-info">
			添加平台配送员之前, 你需要新增一个配送员账户, 然后通过搜索"手机号"把他添加进来.
		</div>
		<div class="panel panel-default">
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
					<tr>
						<th>配送员名称</th>
						<th>微信昵称</th>
						<th>手机号</th>
						<th>性别/年龄</th>
						<th>添加时间</th>
						<th>今日配送</th>
						<th>本月配送</th>
						<th>总配送</th>
						<th style="width:150px; text-align:right;">操作</th>
					</tr>
					</thead>
					<tbody>
					<?php  if(is_array($data)) { foreach($data as $item) { ?>
						<tr>
							<td><?php  echo $item['deliveryer']['title'];?></td>
							<td><?php  echo $item['deliveryer']['nickname'];?></td>
							<td><?php  echo $item['deliveryer']['mobile'];?></td>
							<td><?php  echo $item['deliveryer']['sex'];?> /<?php  echo $item['deliveryer']['age'];?></td>
							<td><?php  echo date('Y-m-d H:i', $item['deliveryer']['addtime']);?></td>
							<td><?php  echo $item['stat']['today_num'];?></td>
							<td><?php  echo $item['stat']['month_num'];?></td>
							<td><?php  echo $item['stat']['total_num'];?></td>
							<td style="text-align:right;">
								<a href="<?php  echo $this->createWebUrl('deliveryer', array('op' => 'stat', 'id' => $item['deliveryer_id']))?>" class="btn btn-default btn-sm" title="配送统计" data-toggle="tooltip" data-placement="top"><i class="fa fa-bar-chart"> </i></a>
								<a href="<?php  echo $this->createWebUrl('deliveryer', array('op' => 'del', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="取消店内配送权限" data-toggle="tooltip" data-placement="top" onclick="if(!confirm('确定取消该配送员的店内配送权限吗?')) return false;"><i class="fa fa-times"> </i></a>
							</td>
						</tr>
					<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>
<script>
	$(function(){
		$(document).on('click', '.btn-add', function(){
			$('#add-container').modal('show');
			$(document).on('click', '.btn-submit', function(){
				var mobile = $('#mobile').val();
				if(!mobile) {
					util.message('手机号不能为空');
					return false;
				}
				$.post("<?php  echo $this->createWebUrl('deliveryer', array('op' => 'add'));?>", {mobile: mobile}, function(data){
					var result = $.parseJSON(data);
					if(result.message.errno == -1) {
						util.message(result.message.message);
						return false;
					} else {
						location.reload();
					}
				});
			});
		});
	});
</script>
<div class="modal fade" id="add-container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">添加平台配送员</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-info">
					添加平台配送员之前, 你需要新增一个配送员账户, 然后通过搜索"手机号"把他添加进来
					<br>
					你可以点击"注册/登录",用微信扫一扫进行注册.
				</div>
				<form>
					<div class="form-group">
						<label for="">配送员手机号</label>
						<input type="text" class="form-control" id="mobile" name="mobile" placeholder="请输入配送员手机号">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary btn-submit">添加</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="qrcode-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">二维码</h3>
			</div>
			<div class="modal-body">
				<div class="qrcode clearfix">
					<div class="panel panel-default" style="margin-right:35px;">
						<div class="panel-heading">注册二维码</div>
						<div class="panel-body">
							<img src="<?php  echo $_W['siteroot'] . 'web/' . url('utility/wxcode/qrcode', array('text' => murl('entry', array('m' => 'we7_wmall', 'do' => 'dyregister'), true, true)));?>">
						</div>
					</div>
					<div class="panel panel-default" style="margin-left:35px;">
						<div class="panel-heading">登陆二维码</div>
						<div class="panel-body">
							<img src="<?php  echo $_W['siteroot'] . 'web/' . url('utility/wxcode/qrcode', array('text' => murl('entry', array('m' => 'we7_wmall', 'do' => 'dyindex'), true, true)));?>">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>
<?php  } ?>

<?php  if($op == 'pranter') { ?>

<form action="./index.php">
	<input type="hidden" name="c" value="site">
	<input type="hidden" name="a" value="entry">
	<input type="hidden" name="m" value="we7_wmall">
	<input type="hidden" name="do" value="ptforder"/>
	<input type="hidden" name="op" value="export"/>
	<input type="hidden" name="peisong" value="1"/>
	<input type="hidden" name="sid" value="<?php  echo $sid;?>"/>
	<div class="panel panel-default tab-pane <?php  if($_GPC['type'] == 'basic' || !$_GPC['type']) { ?>active<?php  } ?>" role="tabpanel" id="basic">
		<div class="panel-heading">打印信息</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>配送员</label>
				<div class="col-sm-9 col-xs-12">
					<select class="form-control" name="dev_id">
						<option value="0">==选择全部==</option>
						<?php  if(is_array($devs)) { foreach($devs as $dev) { ?>
						<option value="<?php  echo $dev['id'];?>"><?php  echo $dev['title'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>配送时间</label>
				<div class="col-sm-7 col-lg-8 col-md-8 col-xs-12">
					<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', time()-86400), 'end' => date('Y-m-d', time())));?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-xs-9 col-md-9">
		<input name="submit" id="submit" value="导出" class="btn btn-primary col-lg-1" data-original-title="" title="" type="submit">
		
		<a href="<?php  echo $this->createWebUrl('deliveryer');?>"><input style="margin-left:10px;" value="返回" class="btn btn-primary col-lg-1" data-original-title="" title="" type="button"></a>
	</div>
</form>

<?php  } ?>
<?php  if($op == 'stat') { ?>
<div class="clearfix">
	<div class="panel panel-default" id="scroll">
		<div class="panel-heading">
			<h4>配送员: <?php  echo $deliveryer['deliveryer']['title'];?></h4>
		</div>
		<div class="account-stat">
			<div class="account-stat-btn">
				<div>今日配送<span><?php  echo $stat['today_num'];?></span></div>
				<div>昨日配送<span><?php  echo $stat['yesterday_num'];?></span></div>
				<div>本月配送<span><?php  echo $stat['month_num'];?></span></div>
				<div>总配送<span><?php  echo $stat['total_num'];?></span></div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			详细数据统计
		</div>
		<div class="panel-body">
			<div class="pull-left">
				<form action="" id="trade">
					<?php  echo tpl_form_field_daterange('time', array('start' => date('Y-m-d', $start),'end' => date('Y-m-d', $end)), '')?>
				</form>
			</div>
			<div style="margin-top:20px" id="chart-container">
				<canvas id="myChart" width="1200" height="300"></canvas>
			</div>
		</div>
	</div>
</div>
<?php  } ?>
<script>
require(['chart', 'daterangepicker'], function(c, $) {
	$('#show-login-modal').click(function(){
		$('#qrcode-modal').modal('show');
	});

	$('.daterange').on('apply.daterangepicker', function(ev, picker) {
		refresh();
	});

	var chart = null;
	var templates = {
		flow1: {
			label: '配送(单)',
			fillColor : "rgba(36,165,222,0.1)",
			strokeColor : "rgba(36,165,222,1)",
			pointColor : "rgba(36,165,222,1)",
			pointStrokeColor : "#fff",
			pointHighlightFill : "#fff",
			pointHighlightStroke : "rgba(36,165,222,1)",
		}
	};

	function refresh() {
		$('#chart-container').html('<canvas id="myChart" width="1200" height="300"></canvas>');
		var url = location.href + '&#aaaa';
		var params = {
			'start': $('#trade input[name="time[start]"]').val(),
			'end': $('#trade input[name="time[end]"]').val()
		};
		$.post(url, params, function(data){
			var data = $.parseJSON(data)
			var datasets = data.datasets;
			var label = data.label;
			var ds = $.extend(true, {}, templates);
			ds.flow1.data = datasets.flow1;
			var lineChartData = {
				labels : label,
				datasets : [ds.flow1]
			};
			var ctx = document.getElementById("myChart").getContext("2d");
			chart = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});
		});
	}
	refresh();
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/footer', TEMPLATE_INCLUDEPATH)) : (include template('public/footer', TEMPLATE_INCLUDEPATH));?>