<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
require(['filestyle', 'util'], function($, u){
	$(".form-group").find(':file').filestyle({buttonText: '上传图片'});
	$('.form-control').blur(function(){
		var identifie = $('input[name="template[identifie]"]').val();
		$(".identifie").html(identifie);
	});
	/*表单数据检测*/
	$("#form1").submit(function(){
		var msg = '';
		var m = $.trim($(':text[name="template[name]"]').val());
		if(m == '') {
			msg += '必须输入模板名称. <br />';
		}
		if((/\*\/|\/\*|eval|\$\_/i).test(m)) {
			msg += '必须输入有效的模板名称. <br />';
		}
		var identifie = $.trim($(':text[name="template[identifie]"]').val());
		if(identifie == '' || !(/^[a-z][a-z\d_]+$/i).test(identifie)) {
			msg += '必须输入模板标识(只能包括字母和数字, 且只能以字母开头). <br />';
		}
		var author = $.trim($(':text[name="template[author]"]').val());
		if(author == '' || (/\*\/|\/\*|eval|\$\_/i).test(author)) {
			msg += '必须输入有效的作者. <br />';
		}
		var url = $.trim($(':text[name="template[url]"]').val());
		if(url == '' || (/\*\/|\/\*|eval|\$\_/i).test(url)) {
			msg += '必须输入有效的模板发布页. <br />';
		}
		if($(':checkbox[name="versions[]"]:checked').length == 0) {
			msg += '必须选择模板支持的【10:10】版本. <br />';
		}
		if(msg != '') {
			u.message(msg, '', 'error');
			return false;
		}
		if($(':hidden[name=do]').val() == '') {
			return false;
		}
		return true;
	});
});

/*添加配置项节点*/
function addOption(point, title) {
	var html = '<div class="form-group">' +
					'<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">' + title +'</label>' +
					'<div class="col-sm-10">' +
						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' +
							'<div class="input-group" style="margin-left:-15px;margin-bottom:10px">' +
								'<span class="input-group-addon">变量名</span>' +
								'<input class="form-control" name="settings[variables][]" type="text" placeholder="请输入配置变量"> ' +
							'</div>' +
						'</div>' +
						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' +
							'<div class="input-group" style="margin-left:-15px;margin-bottom:10px">' +
								'<span class="input-group-addon">变量描述</span>' +
								'<input class="form-control" name="settings[description][]" type="text" placeholder="请输入变量描述"> ' +
							'</div>' +
						'</div>' +
						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' +
							'<div class="input-group" style="margin-left:-15px;margin-bottom:10px">' +
								'<span class="input-group-addon">值</span>' +
								'<input class="form-control" name="settings[values][]" type="text" placeholder="请输入配置值"> ' +
							'</div>' +
						'</div>' + 
						'<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">' + 
							'<label class="checkbox-inline"> ' +
								'<a href="javascript:;" onclick="deleteOption(this)" class="fa fa-times-circle" title="删除此操作"></a> ' +
							'</label> ' +
						'</div>' +
					'</div>' +
				'</div>';
	$('#settings').append(html);
}

/*删除配置项节点*/
function deleteOption(o) {
	$(o).parent().parent().parent().parent().remove();
}
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('extension/theme-tabs', TEMPLATE_INCLUDEPATH)) : (include template('extension/theme-tabs', TEMPLATE_INCLUDEPATH));?>

<div class="clearfix">
	<form class="form-horizontal form" id="form1" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $rule['rule']['id'];?>">
		<h5 class="page-header">模板基本信息 <small>这里来定义你自己模板的基本信息</small></h5>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模板名称</label>
			<div class="col-sm-10 col-xs-12">
				<input type="text" class="form-control" placeholder="" name="template[name]"/>
				<span class="help-block">模板的名称, 由于显示在用户的模板列表中. 不要超过10个字符 </span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模板标识</label>
			<div class="col-sm-10 col-xs-12">
					<input type="text" class="form-control" placeholder="" name="template[identifie]" />
					<span class="help-block">模板标识符, 应对应模板文件夹的名称, 【10:10】系统按照此标识符查找模板定义, 只能由字母数字下划线组成 </span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模板类型</label>
			<div class="col-sm-10 col-xs-12">
				<select name="template[type]" class="form-control">
					<?php  if(is_array($temtypes)) { foreach($temtypes as $type) { ?>
						<option value="<?php  echo $type['name'];?>"><?php  echo $type['title'];?></option>
					<?php  } } ?>
				</select>
				<span class="help-block">模板的类型, 用于分类展示和查找你的模板</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模板介绍</label>
			<div class="col-sm-10 col-xs-12">
					<textarea class="form-control" name="template[description]" rows="4"></textarea>
					<span class="help-block">模板详细描述, 详细介绍模板的功能和使用方法 </span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">作者</label>
			<div class="col-sm-10 col-xs-12">
					<input type="text" class="form-control" placeholder="" name="template[author]"/>
					<span class="help-block">模板的作者, 留下你的大名吧</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">发布页</label>
			<div class="col-sm-10 col-xs-12">
					<input type="text" class="form-control" placeholder="" name="template[url]" value="http://bbs.we7.cc/" />
					<span class="help-block">模板的发布页, 用于发布模板更新信息的页面, 推荐使用【10:10】模板版块</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模板支持位置数</label>
			<div class="col-sm-10 col-xs-12">
				<select name="template[sections]" class="form-control">
				<option value="0">不设置位置</option>
					<?php  for ($i=1; $i<=10; $i++) {?>
					<option <?php  if($item['section'] == $i) { ?> selected<?php  } ?> value="<?php  echo $i;?>">位置<?php  echo $i;?></option>
					<?php  }?>
				</select>
				<span class="help-block">此设置为指定模板支持导航链接显示在模板中的位置选项，管理员可添加导航链接到相应的位置中。不设置位置则表示不支持导航位置显示。</span>
			</div>
		</div>
		
		<h5 class="page-header">模板发布 <small>这里来定义模板发布时需要的配置项<span class="text-danger">(说明：变量名用于设置不同的变量,只能是字母数字组成.变量描述可方便用户识别对应变量的作用,不能为空)</span></small></h5>
		<div id="settings">
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">配置项</label>
				<div class="col-sm-10 col-xs-12">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="input-group" style="margin-left:-15px;margin-bottom:10px">
							<span class="input-group-addon">变量名</span>
							<input class="form-control" name="settings[variables][]" type="text" placeholder="请输入配置变量">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="input-group" style="margin-left:-15px;margin-bottom:10px">
							<span class="input-group-addon">变量描述</span>
							<input class="form-control" name="settings[description][]" type="text" placeholder="请输入变量描述">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
						<div class="input-group" style="margin-left:-15px;margin-bottom:10px">
						  <span class="input-group-addon">值</span>
						  <input class="form-control" name="settings[values][]" type="text" placeholder="请输入配置值">
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
						<label class="checkbox-inline">
							<a href="javascript:;" onclick="deleteOption(this)" class="fa fa-times-circle" title="删除此操作"></a>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
			<div class="col-sm-10 col-xs-12">
				<div class="well well-sm">
					<a href="javascript:;" onclick="addOption('<?php  echo $point;?>', '<?php  echo $row['title'];?>');">添加操作 <i class="fa fa-plus-circle" title="添加菜单"></i></a>
				</div>
				<span class="help-block"><?php  echo $row['desc'];?></span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">兼容的【10:10】版本</label>
			<div class="col-sm-10 col-xs-12">
				<?php  if(is_array($versions)) { foreach($versions as $v) { ?>
					<label class="checkbox-inline">
						<input type="checkbox" name="versions[]" value="<?php  echo $v;?>" />WeEngine <?php  echo $v;?>
					</label>
				<?php  } } ?>
				<span class="help-block">当前模板兼容的【10:10】系统版本, 安装时会判断版本信息, 不兼容的版本将无法安装</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">模板背景</label>
			<div class="col-sm-10 col-xs-12">
				<input type="file" name="preview" value="<?php  echo $m['preview'];?>">
				<span class="help-block">模板封面, 大小为 145*225, 更好的设计将会获得官方推荐位置</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
			<div class="col-sm-10 col-xs-12">
					<input name="method" type="hidden" value="download"/>
					<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
					<?php  if($available['create']) { ?>
					<input type="submit" class="btn btn-primary" name="submit" onclick="$(':hidden[name=method]').val('create');" value="直接生成模板文件" />
					<?php  } else { ?>
					<input type="submit" class="btn btn-primary disabled" disabled="disabled" name="submit" value="直接生成模板文件" />
					<div class="alert-warning alert" style="width:auto;margin-top:5px;">需要 addons 目录具有可写权限</div>
					<?php  } ?>
					<span class="help-block">点此直接在源码目录 <span class="identifie">app/themes/</span> 处生成模板开发的模板文件, 方便快速开发</span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
			<div class="col-sm-10 col-xs-12">
					<?php  if($available['download']) { ?>
					<input type="submit" class="btn btn-primary span3" name="submit" onclick="$(':hidden[name=method]').val('download');" value="下载模板文件" />
					<?php  } else { ?>
					<input type="submit" class="btn btn-primary span3 disabled" disabled="disabled" name="submit" value="下载模板文件" />
					<div class="alert-warning alert">需要启用 Zip 模板</div>
					<?php  } ?>
					<span class="help-block">如果您的服务器不能直接读写文件, 请下载后上传至服务器目录 <span class="identifie">app/themes/</span> 下来编辑开发 </span>
			</div>
		</div>
		
	</form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
