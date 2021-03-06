<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/nav', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('plateform/config-nav', TEMPLATE_INCLUDEPATH)) : (include template('plateform/config-nav', TEMPLATE_INCLUDEPATH));?>
<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
	<div class="main">
		<div class="panel panel-default">
			<div class="panel-heading">配送员申请设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>是否短信验证手机号</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline"><input type="radio" name="mobile_verify_status" value="1" <?php  if($config['mobile_verify_status'] == 1) { ?>checked<?php  } ?>> 验证手机号</label>
						<label class="radio-inline"><input type="radio" name="mobile_verify_status" value="2" <?php  if($config['mobile_verify_status'] == 2 || !$config['mobile_verify_status']) { ?>checked<?php  } ?>> 不验证</label>
						<div class="help-block">开启验证手机号,需要配置短信参数.<a href="<?php  echo $this->createWebUrl('ptfsms', array('op' => 'set'));?>" target="_blank">现在去配置</a></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>入驻协议</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_ueditor('agreement', $config['agreement']);?>
						<div class="help-block">不填写时，配送员申请页面将不显示：我已阅读并同意 《配送员入驻协议》</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">配送设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>配送员模式</label>
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline">
							<input type="radio" value="1" name="delivery_type" <?php  if($config['delivery_type'] == 1 || !$config['delivery_type']) { ?>checked<?php  } ?>> 店内配送员
						</label>
						<label class="radio-inline">
							<input type="radio" value="2" name="delivery_type" <?php  if($config['delivery_type'] == 2) { ?>checked<?php  } ?>> 平台配送员
						</label>
						<div class="help-block"><strong class="text-danger">门店只能选择一个配送方式, 不能同时使用"平台配送员"和"店内配送员".</strong>如需单独设置某个门店可已使用自己门店的配送员, 请到"<a href="<?php  echo $this->createWebUrl('ptftrade', array('op' => 'account'));?>" target="_blank">财务中心-门店账户</a>"进行设置.</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>平台配送费</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<div class="input-group-addon">每单</div>
							<input type="text" name="plateform_delivery_fee" value="<?php  echo $config['plateform_delivery_fee'];?>" class="form-control"/>
							<div class="input-group-addon">元</div>
						</div>
						<div class="help-block">
							<strong class="text-danger">
								此项设置: 商家使用平台配送模式后, 下单人需要支付的配送费.使用平台配送模式后, 商家将不能自己变更配送费, 只能由平台管理员设置配送费.
							</strong>
							如需单独设置某个门店的配送费, 请到"<a href="<?php  echo $this->createWebUrl('ptftrade', array('op' => 'account'));?>" target="_blank">财务中心-门店账户</a>"进行设置.
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>将配送模式和配送费同步到所有门店</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<label class="checkbox-inline">
								<input type="checkbox" name="delivery_sync" value="1"/> 将配送模式和配送费同步到所有门店
							</label>
						</div>
						<div class="help-block">同步后,所有门店的配送员模式都会被设置为这个规则</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">* </span>平台给配送员每单支付金额</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<label class="input-group-addon">
								<input type="radio" name="delivery_fee_type" value="1" <?php  if($config['delivery_fee_type'] == 1 || !$config['delivery_fee_type']) { ?>checked<?php  } ?>>
							</label>
							<span class="input-group-addon">每单固定</span>
							<input type="text" class="form-control" name="delivery_fee_1" <?php  if($config['delivery_fee_type'] == 1) { ?>value="<?php  echo $config['delivery_fee'];?>"<?php  } ?>>
							<span class="input-group-addon">元</span>
						</div>
						<br>
						<div class="input-group">
							<label class="input-group-addon">
								<input type="radio" name="delivery_fee_type" value="2" <?php  if($config['delivery_fee_type'] == 2) { ?>checked<?php  } ?>>
							</label>
							<span class="input-group-addon">每单按照订单价格提成</span>
							<input type="text" class="form-control" name="delivery_fee_2" <?php  if($config['delivery_fee_type'] == 2) { ?>value="<?php  echo $config['delivery_fee'];?>"<?php  } ?>>
							<span class="input-group-addon">%</span>
						</div>
						<div class="help-block text-danger"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">配送员提现设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>最低提现金额</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="get_cash_fee_limit" value="<?php  echo $config['get_cash_fee_limit'];?>" class="form-control"/>
							<span class="input-group-addon">元</span>
						</div>
						<div class="help-block">只能填写整数，不填写为不限制</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费率</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<input type="text" name="get_cash_fee_rate" value="<?php  echo $config['get_cash_fee_rate'];?>" class="form-control"/>
							<span class="input-group-addon">%</span>
						</div>
						<div class="help-block">
							配送员申请提现时，每笔申请提现扣除的费用，默认为空，即提现不扣费，支持填写小数
							<br>
							<strong clas="text-danger">配送员入驻时的默认提现费率</strong>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="require">*</span>提现费用</label>
					<div class="col-sm-9 col-xs-12">
						<div class="input-group">
							<span class="input-group-addon">最低</span>
							<input type="text" name="get_cash_fee_min" value="<?php  echo $config['get_cash_fee_min'];?>" class="form-control"/>
							<span class="input-group-addon">元</span>
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon">最高</span>
							<input type="text" name="get_cash_fee_max" value="<?php  echo $config['get_cash_fee_max'];?>" class="form-control"/>
							<span class="input-group-addon">元</span>
						</div>
						<div class="help-block">
							配送员提现时，提现费用的上下限，最高为空时，表示不限制扣除的提现费用
							<br>
							例如：提现100元，费率5%，最低1元，最高2元，配送员最终提现金额=100-2=98
							<br>
							例如：提现100元，费率5%，最低1元，最高10元，配送员最终提现金额=100-100*5%=95
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-9 col-md-9">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
				<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary col-lg-1">
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
$(function(){
	$('#form1').submit(function(){
		return true;
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>