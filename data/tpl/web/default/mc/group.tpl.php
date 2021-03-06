<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo url('mc/group/display');?>">会员组列表</a></li>
	<li <?php  if($do == 'post' && empty($groupid)) { ?>class="active"<?php  } ?>><a href="<?php  echo url('mc/group/post');?>">添加会员组</a></li>
	<?php  if($do == 'post' && !empty($groupid)) { ?><li class="active"><a href="<?php  echo url('mc/group/post', array('id' => $groupid));?>">编辑会员组</a></li><?php  } ?>
</ul>
<div class="alert alert-info">
	<i class="fa fa-info-circle"></i> 默认会员组的积分需设置为 0 <br>
	<i class="fa fa-info-circle"></i> 系统会根据会员的积分多少自动对会员的分组进行调整 <br>
</div>
<?php  if($do == 'display') { ?>
<form action="" method="post" id="form1"  class="form-horizontal">
	<div class="panel panel-default">
		<div class="panel-heading">会员组变更设置</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label">会员组变更设置</label>
				<div class="col-sm-9 col-xs-12">
					<label class="radio-inline">
						<input type="radio" name="grouplevel" value="1" <?php  if($setting['grouplevel'] == 1 || !$setting['grouplevel']) { ?>checked<?php  } ?>/>根据积分多少自动升降
					</label>
					<label class="radio-inline">
						<input type="radio" name="grouplevel" value="2" <?php  if($setting['grouplevel'] == 2) { ?>checked<?php  } ?>/>根据积分多少只升不降
					</label>
					<span class="help-block">根据积分多少自动升降：<strong class="text-danger">系统根据当前会员的积分，按照每个会员组所需积分的设置进行变更。可自动升降会员组</strong></span>
					<span class="help-block">根据积分多少只升不降：<strong class="text-danger">系统根据当前会员的积分，如果会员的积分达到更高一级的会员组，则变更会员组，如果积分少于当前所在会员组所需积分，保持当前会员组不变，不会降级。</strong></span>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th style="width:250px">会员组名称</th>
						<th style="width:200px"></th>
						<th style="width:100px">所需积分</th>
						<th style="width:200px;text-align: right">会员数</th>
						<th style="text-align:right">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<td>
							<input type="text" name="title[<?php  echo $item['groupid'];?>]" class="form-control" value="<?php  echo $item['title'];?>" />
						</td>
						<td>
							<?php  if($item['isdefault'] == '1') { ?>
							<span class="label label-info">默认组</span>
							<?php  } ?>
						</td>
						<td>
							<input type="text" class="form-control" name="credit[<?php  echo $item['groupid'];?>]"  value="<?php  echo $item['credit'];?>" />
						</td>
						<td align="right">
							<?php  echo intval($count[$item['groupid']]['num']);?> 人
						</td>
						<td style="text-align:right">
							<a href="<?php  echo url('mc/group/post', array('id' => $item['groupid']));?>" title="编辑">编辑</a>&nbsp;-&nbsp;
							<a href="<?php  echo url('mc/group/delete', array('id' => $item['groupid']));?>" onclick="return confirm('确认删除吗？');return false;" title="删除">删除</a>
							<?php  if($item['isdefault'] != '1') { ?>
							&nbsp;-&nbsp;
							<a href="<?php  echo url('mc/group/set', array('id' => $item['groupid']));?>" onclick="return confirm('每个公众号只能设置一个默认组，确定设置吗？');return false;">设为默认组</a>
							<?php  } ?>
						</td>
					</tr>
					<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
			<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
		</div>
	</div>
</form>
<?php  } ?>
<?php  if($do == 'post') { ?>
<script>
	$("#form2").submit(function(){
		if($.trim($(':text[name="title"]').val()) == '') {
			util.message('没有输入用户组名称.', '', 'error');
			return false;
		}
		return true;
	});
</script>
<div class="main">
	<form class="form-horizontal form" id="form2" action="" method="post">
		<div class="panel panel-default">
			<div class="panel-heading">
				会员组参数
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">组名称</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="title" value="<?php  echo $item['title'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">所需积分</label>
					<div class="col-sm-8 col-xs-12">
						<input type="text" class="form-control" name="credit" value="<?php  echo $item['credit'];?>" />
						<div class="help-block">此项设置升级到该会员组所需积分.如果会员的积分达到该会员组所设置的积分,会员等级会自动提升</div>
						<div class="help-block"><strong class="text-danger">默认会员组的积分需设置为 0</strong></div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
			<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
		</div>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>