<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<script src="<?php  echo $_W['siteroot'];?>addons/we7_wmall/resource/web/js/echarts.common.js"></script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/nav', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/trade-nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/trade-nav', TEMPLATE_INCLUDEPATH));?>
<div class="alert alert-info">
	<h3>温馨提示: 订单数据统计只统计已付款并且订单状态为已完成的订单.</h3>
</div>

<?php  if($op == 'list') { ?>
<div class="clearfix">
	<div class="panel panel-default" id="scroll">
		<div class="panel-heading">
			<strong class="text-danger">(门店: <?php  echo $stores[$sid]['title'];?>)</strong> 今日关键指标
		</div>
		<div class="account-stat">
			<div class="account-stat-btn">
				<div>今日总下单数<span><?php  echo $stat['today_total'];?></span></div>
				<div>今日总营业额<span><?php  echo $stat['today_price'];?></span></div>
				<div>本月总下单数<span><?php  echo $stat['month_total'];?></span></div>
				<div>本月总营业额<span><?php  echo $stat['month_price'];?></span></div>
			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form" id="list">
				<input type="hidden" name="c" value="site">
				<input type="hidden" name="a" value="entry">
				<input type="hidden" name="m" value="we7_wmall">
				<input type="hidden" name="do" value="ptffinance"/>
				<input type="hidden" name="op" value="list"/>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">下单时间</label>
					<div class="col-sm-7 col-lg-2 col-md-2 col-xs-12">
						<?php  echo tpl_form_field_daterange('addtime', array('start' => date('Y-m-d', $starttime), 'end' => date('Y-m-d', $endtime)));?>
					</div>
				</div>
				<div class="form-group clearfix">
					<label class="col-xs-12 col-sm-2 col-md-1 control-label">门店</label>
					<div class="col-sm-7 col-lg-2 col-md-2 col-xs-12">
						<select name="sid" class="form-control">
							<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
							<option value="<?php  echo $store['id'];?>" <?php  if($store['id'] == $sid) { ?>selected<?php  } ?>><?php  echo $store['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>

			</form>
		</div>
	</div>
	<div class="clearfix">
		<div class="col-lg-6" style="padding: 0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><?php  echo date('Y-m-d', $starttime)?> ~ <?php  echo date('Y-m-d', $endtime)?>营业额比例图</h4>
				</div>
				<div class="panel-body">
					<div id="order_price-holder" style="width: 100%;height:400px;">
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6" style="padding-left:20px; padding-right: 0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><?php  echo date('Y-m-d', $starttime)?> ~ <?php  echo date('Y-m-d', $endtime)?>下单比例图</h4>
				</div>
				<div class="panel-body">
					<div id="order_num-holder" style="width: 100%;height:400px;">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<div class="panel panel-default" id="order_num">
			<div class="panel-heading">
				下单数增长趋势图(单位:单)
			</div>
			<div class="panel-body">
				<div style="margin-top:20px" class="chart-container">
					<canvas class="myChart" width="1200" height="300"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<div class="panel panel-default" id="order_price">
			<div class="panel-heading">
				营业额增长趋势图(单位:元)
			</div>
			<div class="panel-body">
				<div style="margin-top:20px" class="chart-container">
					<canvas class="myChart" width="1200" height="300"></canvas>
				</div>
			</div>
		</div>
	</div>
	<form class="form-horizontal" action="" method="post" onkeydown="if(event.keyCode == 13) return false;">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered table-text-center">
						<thead class="navbar-inner">
						<tr>
							<th width="300">时间</th>
							<th>营业额</th>
							<th>订单数</th>
							<th>现金支付</th>
							<th>微信支付</th>
							<th>支付宝支付</th>
							<th>余额支付</th>
							<th>货到支付</th>
						</tr>
						</thead>
						<tbody>
						<?php  if(is_array($return)) { foreach($return as $k => $dca) { ?>
						<tr>
							<th><?php  echo $k;?></th>
							<td><?php  echo sprintf('%.2f', $dca['price']);?> 元</td>
							<td><?php  echo intval($dca['count']);?> 单</td>
							<td><?php  echo sprintf('%.2f', $dca['cash']);?> 元</td>
							<td><?php  echo sprintf('%.2f', $dca['wechat']);?> 元</td>
							<td><?php  echo sprintf('%.2f', $dca['alipay']);?> 元</td>
							<td><?php  echo sprintf('%.2f', $dca['credit']);?> 元</td>
							<td><?php  echo sprintf('%.2f', $dca['delivery']);?> 元</td>
						</tr>
						<?php  } } ?>
						<tr>
							<th class="info">
								<?php  echo date('Y-m-d', $starttime);?>
								~~
								<?php  echo date('Y-m-d', $endtime);?>
							</th>
							<td class="info"><?php  echo sprintf('%.2f', $total['total_price']);?> 元</td>
							<td class="info"><?php  echo intval($total['total_count']);?> 单</td>
							<td class="info"><?php  echo sprintf('%.2f', $total['total_cash']);?> 元</td>
							<td class="info"><?php  echo sprintf('%.2f', $total['total_wechat']);?> 元</td>
							<td class="info"><?php  echo sprintf('%.2f', $total['total_alipay']);?> 元</td>
							<td class="info"><?php  echo sprintf('%.2f', $total['total_credit']);?> 元</td>
							<td class="info"><?php  echo sprintf('%.2f', $total['total_delivery']);?> 元</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>
<?php  } ?>

<script type="text/javascript">
	require(['jquery', 'daterangepicker', 'chart'], function($) {
		$('#list .daterange').on('apply.daterangepicker', function(ev, picker) {
			$('#list')[0].submit();
		});
		$('#list select').on('change', function() {
			$('#list')[0].submit();
		});

		var chart = null;
		var template = {
			flow1: {
				label: '',
				fillColor : "rgba(36,165,222,0.1)",
				strokeColor : "rgba(36,165,222,1)",
				pointColor : "rgba(36,165,222,1)",
				pointStrokeColor : "#fff",
				pointHighlightFill : "#fff",
				pointHighlightStroke : "rgba(36,165,222,1)"
			}
		};

		function refresh(type) {
			$('#'+ type+ ' .chart-container').html('<canvas class="myChart" width="1200" height="300"></canvas>');
			var url = "<?php  echo $this->createWebUrl('ptffinance');?>&op=" + type;
			var params = {
				'start': $('#list input[name="addtime[start]"]').val(),
				'end': $('#list input[name="addtime[end]"]').val(),
				'sid': $('#list select[name="sid').val()
			};
			$.post(url, params, function(data){
				var data = $.parseJSON(data)
				var datasets = data.datasets;
				var label = data.label;
				var ds = $.extend(true, {}, template);
				ds.flow1.data = datasets.flow1;
				var lineChartData = {
					labels : label,
					datasets : [ds.flow1]
				};
				var ctx = $('#' + type + ' .myChart')[0].getContext("2d");
				chart = new Chart(ctx).Line(lineChartData, {
					responsive: true
				});
			});
		}
		refresh('order_num');
		refresh('order_price');

		var templates = {
			order_num: {
				title: {
					text: '各种支付方式下单比例',
					subtext: '只统计已付款并且订单状态为已完成的订单',
					name: '各种支付方式下单比例'
				},
				series: [{
					name: '各种支付方式下单比例',
					data: []
				}]
			},
			order_price: {
				title: {
					text: '各种支付方式收入比例',
					subtext: '只统计已付款并且订单状态为已完成的订单',
					name: '各种支付方式收入下单比例'
				},
				series: [{
					name: '各种支付方式收入下单比例',
					data: []
				}]
			}
		};
		var option = {
			title : {
				text: '',
				x:'center'
			},
			tooltip : {
				trigger: 'item',
				formatter: "{a} <br/>{b} : {c} ({d}%)"
			},
			legend: {
				orient: 'vertical',
				left: 'left',
				data: ['微信支付','支付宝支付','余额支付','现金支付','货到付款']
			},
			series : [
				{
					name: '',
					type: 'pie',
					radius : '55%',
					center: ['50%', '60%'],
					data:[],
					itemStyle: {
						emphasis: {
							shadowBlur: 10,
							shadowOffsetX: 0,
							shadowColor: 'rgba(0, 0, 0, 0.5)'
						}
					}
				}
			]
		};

		var GetChartData = function(type) {
			$('#'+ type+ '-holder').html('');
			var url = "<?php  echo $this->createWebUrl('ptffinance');?>&op=day_" + type;
			var params = {
				'start': $('#list input[name="addtime[start]"]').val(),
				'end': $('#list input[name="addtime[end]"]').val(),
				'sid': $('#list select[name="sid').val()
			};
			$.post(url, params, function(data){
				var data = $.parseJSON(data);
				var ds = $.extend(true, {}, option, templates[type]);
				ds.series[0].data = data.message.message;
				var myChart = echarts.init($('#'+ type+ '-holder')[0]);
				myChart.setOption(ds);
			});
		}
		GetChartData('order_price');
		GetChartData('order_num');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
