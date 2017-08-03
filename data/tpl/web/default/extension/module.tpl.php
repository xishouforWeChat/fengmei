<?php defined('IN_IA') or exit('Access Denied');?><?php  $newUI = true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
require(['domReady'], function(dom){
	dom(function(){
		$('.module').delegate('.media-description-button', 'click', function(){ //控制模块详细信息
			$(this).parents('.item').find('.media-description').toggle();
			return false;
		});	
	});
});
</script>
<style type="text/css">
small a{color:#999;}
.form h4{margin-bottom:0;}
#upgradelog {line-height: 25px;max-height:150px;overflow: auto;padding: 15px;}
/*模块列表样式*/
.module .item{border-bottom:1px #DDD dotted;margin-bottom:10px; padding-bottom:5px;}
.module .media .pull-right{margin-bottom:0;width:140px;overflow:hidden;}
.module .media .pull-right .input-prepend{float:right;}
.module .media .pull-right .input-prepend .add-on{padding:0 5px; height:23px; line-height:23px;}
.module .media .pull-right .input-prepend select{padding:1px; height:25px; line-height:25px;}
.module .module-set{text-align:right; margin-top:6px;float:right;height:25px}
.module .module-set a{margin-left:5px;}
.module .media-body{position:relative;}
.module .media-body .edit-info{margin-left:10px; color:rgb(255, 143, 0); display:none;}
.module .media-body span{margin-top:6px; display:inline-block;}
.module .media-object{display:inline-block; float:left; margin-right:10px; width:48px; height:48px; overflow:hidden;}
.module .media-heading{font-weight:normal; font-size:16px;}
.module .media-description{display:none; margin-top:5px; overflow:hidden; background:#EEE; padding:5px; color:#666;}
.module div.alert{font-size:14px; font-weight:600; margin-bottom:10px;}
</style>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('extension/module-tabs', TEMPLATE_INCLUDEPATH)) : (include template('extension/module-tabs', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix">
	<?php  if($do == 'installed') { ?>
	<div class="form">
		<h5 class="page-header">已安装的模块</h5>
	</div>
	<nav role="navigation" class="navbar navbar-default" style="margin-bottom:20px;">
		<div class="container-fluid">
			<div class="navbar-header"><a href="" class="navbar-brand">模块类型</a></div>
			<ul class="nav navbar-nav nav-btns">
				<li class="active"><a href="">全部</a></li>
				<?php  if(is_array($modtypes)) { foreach($modtypes as $type) { ?>
				<li><a href="#" data-type=<?php  echo $type['name'];?> class="type"><?php  echo $type['title'];?></a></li>
				<?php  } } ?>
				<div class="navbar-form navbar-right" role="search">
						<div id="search-menu">
							<input type="text" name="keyword" class="form-control" placeholder="搜索模块">
						</div>
				</div>
			</ul>
		</div>
	</nav>
	<div class="module form-horizontal">
		<?php  if(is_array($modules)) { foreach($modules as $row) { ?>
		<div class="item" data-title=<?php  echo $row['title'];?> data-type=<?php  echo $row['type'];?>>
			<div class="media">
				<div class="pull-right" style="width:500px;">
					<div class="input-prepend">
					</div>
					<div class="module-set">
						<?php  if($row['istrade']) { ?>
							<span class="label label-danger">行业模块,仅限 <?php  echo $row['uniacid_name'];?> 使用</span>
						<?php  } ?>
						<span class="hide-form" id="<?php  echo $row['name'];?>" style="display:none"></span>
						<?php  if($row['version_error']) { ?>
							版本不兼容 <a href="<?php  echo url('extension/module/convert', array('id' => strtolower($row['name'])))?>" style="color:red;">转换版本</a>
						<?php  } else { ?>
							<?php  if(!$row['issystem']) { ?>
								<a onclick="return confirm('卸载模块会删其相关数据，确定吗？'); return false;" href="<?php  echo url('extension/module/uninstall', array('id' => $row['name']))?>">卸载</a>
							<?php  } ?>
						<?php  } ?>
						&nbsp;
						<a href="<?php  echo url('extension/module/permission', array('id' => $row['name']))?>">访问权限</a>
						&nbsp;
						<span class="upgrade-label" module="<?php  echo $row['name'];?>" version="<?php  echo $row['version'];?>">
						<?php  if($row['upgrade']) { ?><a href="<?php  echo url('extension/module/upgrade', array('m' => $row['name']));?>" onclick="return confirm('确认更新吗？');" style="color:red;" title="来自本地文件更新">更新</a><?php  } ?>
						</span>
					</div>
				</div>
				<img class="media-object img-rounded" src="<?php  echo $row['imgsrc'];?>" onerror="this.src='../web/resource/images/nopic-small.jpg'">
				<div class="media-body">
					<h4 class="media-heading">
						<?php  echo $row['title'];?><small>（标识：<?php  echo $row['name'];?>&nbsp;&nbsp;&nbsp;版本：<?php  echo $row['version'];?>&nbsp;&nbsp;&nbsp;作者：<?php  echo $row['author'];?>）</small>
						<em class="upgrade-label-tips" module="<?php  echo $row['name'];?>" style="color:red;display:none;">New</em>
						<?php  if($row['official']) { ?>
						<i class="official" style="position:absolute;"><img src="resource/images/module/official.png"/></i>
						<?php  } ?>
					</h4>
					<span>
						<?php  echo $row['ability'];?>&nbsp;<a href="#" class="media-description-button">详细介绍</a>
						<a href="javascript:;" class="edit-info" data-module="<?php  echo $row['name'];?>"><i class="fa fa-pencil"></i> 点我编辑</a>
					</span>
				</div>
			</div>
			<div class="media-description">
				<b>功能介绍：</b>
				<span><?php  echo $row['description'];?></span>
			</div>
		</div>
		<?php  } } ?>
	</div>
	<script type="text/javascript">
		require(['bootstrap'],function(){
			$('#search-menu input').keyup(function() {
				var a = $(this).val();
				$('.item').hide();
				$('.item').each(function() {
					if(a.length > 0 && $(this).attr('data-title').indexOf(a) >= 0) {
						$(this).show();
					}
				});
				if(a.length ==0) {
					$('.item').show();
				}
			});
			$('.type').click(function() {
				var b = $(this).attr('data-type');
				$('.active').attr('class','');
				$(this).parent('li').attr('class','active');
				$('.item').hide();
				$('.item').each(function() {
					if($(this).attr('data-type')==b) {
						$(this).show();
					}
				});
			});
		})
	</script>
	<div class="modal fade" id="module-info"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:800px">
			<div class="modal-content">
				<form action="<?php  echo url('extension/module/info');?>" method="post" enctype="multipart/form-data" class="form-horizontal form" id="form-info">
					<input type="hidden" name="m" value=""/>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4>编辑模块信息</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 模块标题</label>
							<div class="col-sm-9 col-xs-12">
								<input type="text" name="title" value="" class="form-control">
								<span class="help-block">模块的名称, 显示在用户的模块列表中. 不要超过10个字符</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 模块简述</label>
							<div class="col-sm-9 col-xs-12">
								<input type="text" name="ability" value="" class="form-control">
								<span class="help-block">模块功能描述, 使用简单的语言描述模块的作用, 来吸引用户</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 模块介绍</label>
							<div class="col-sm-9 col-xs-12">
								<textarea type="text" name="description" class="form-control" rows="5"></textarea>
								<span class="help-block">模块详细描述, 详细介绍模块的功能和使用方法</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 模块缩略图</label>
							<div class="col-sm-9 col-xs-12">
								<input type="file" name="icon" value="">
								<span class="help-block">用 48*48 的图片来让你的模块更吸引眼球吧。仅支持jpg格式</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 模块封面</label>
							<div class="col-sm-9 col-xs-12">
								<input type="file" name="preview" value="">
								<span class="help-block">模块封面, 大小为 600*350, 更好的设计将会获得官方推荐位置。仅支持jpg格式</span>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<input type="submit" class="btn btn-primary" name="submit" value="保存">
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">模块更新说明</h4>
				</div>
				<div class="modal-body" id="errorinfo"></div>
				<div class="modal-body" id="moduleinfo">
					<div class="form-group">
						模块名称：<span id="modulename"></span>
					</div>
					<div class="form-group">
						更新版本：<span id="modulenewversion"></span>
					</div>
					<div class="form-group">
						模块作者：<span id="moduleauthor"></span>
					</div>
					<div class="form-group">
						模块更新日期：<span id="upgradetime"></span>
					</div>
					<div class="form-group">
						模块更新日志：<div id="upgradelog" class="help-block"></div>
					</div>
					<div class="form-group">
						模块更新价格：<span id="upgradeprice" class="label label-info"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消更新</button>
					<a href="<?php  echo url('extension/module/upgrade');?>" id="confirm" class="btn btn-success">确认更新</a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		require(['filestyle'], function($){
			$.post('<?php  echo url('extension/module/check');?>', {foo: 'upgrade'},function(dat){
				try {
					var ret = $.parseJSON(dat);
					var sys = ['<?php  echo $sysmodules;?>'];
					$('.upgrade-label').each(function(){
						var n = $(this).attr('module');
						var v = $(this).attr('version');
						if(ret[n]) {
							$('.hide-form[id="' + n + '"]').html('<span class="label label-warning">来自云平台安装</span>').show();
							if(ret[n].version > v) {
								var tips = '';
								tips = '来自【10:10】云服务更新';
								$(this).html('<a href="javascript:;" onclick=\'setModuleInfo("' + ret[n].name + '");\' style="color:red;" title="' + tips + '">更新</a>');
								$('.upgrade-label-tips[module=' + n + ']').show();
							}
						} else {
							if($.inArray(n, sys) == -1) {
								$('.hide-form[id="' + n + '"]').html('<span class="label label-success">来自本地安装</span>').show();
							}
						}
					});
				} catch(err) {}
			});
			
			window.setModuleInfo = function(modulename) {
				$.post('<?php  echo url("extension/module/upgrade");?>', {m : modulename, type : 'getinfo'},function(response){
					if (typeof response.message.version != 'object') {
						$('#moduleinfo').hide();
						$('#errorinfo').show();
						$('#upgrade').modal('show');
						$('#errorinfo').html('<div class="alert alert-danger">' + response.message.message + '</div>');
						$('#confirm').attr('href', 'javascript:;').text('无法更新').removeClass('btn-success').addClass('btn-danger');
					} else {
						$('#moduleinfo').show();
						$('#errorinfo').hide();
						$('#modulename').text(response.message.title);
						$('#modulenewversion').text(response.message.version.version);
						$('#moduleauthor').text(response.message.username);
						$('#upgradelog').html(response.message.version.description);
						$('#upgradetime').text(response.message.version.createtime);
						$('#upgradeprice').text(response.message.version.upgradeprice);
						var upgradelink = $('#confirm').attr('href') + '&m=' + modulename + '&type=getinfo';
						$('#upgrade').modal('show');
						$('#confirm').unbind();
						if (response.message.version.upgradeprice > '0') {
							$('#confirm').click(function() {
								return confirm('更新此版本需要花费 ' + response.message.version.upgradeprice + ' 个交易币，您确认要升级到此版本吗？');
							});
						}
						$('#confirm').attr('href', upgradelink).text('确认更新').removeClass('btn-danger').addClass('btn-success');;
					}
				}, 'json');
			}

			$('.module .item').hover(function(){
				$(this).find('.edit-info').show();
			},function(){
				$(this).find('.edit-info').hide();
			});
			//编辑模块信息
			$(".form-group").find(':file').filestyle({buttonText: '上传图片'});
			$('.edit-info').click(function(){
				var m = $(this).attr('data-module');
				$.post("<?php  echo url('extension/module/info')?>", {'m':m}, function(data){
					var info = $.parseJSON(data);
					$('#form-info input[name="m"]').val(m);
					$('#form-info :text[name="title"]').val(info.title);
					$('#form-info :text[name="ability"]').val(info.ability);
					$('#form-info textarea[name="description"]').val(info.description);
					$('#module-info').modal('show');
				});
				return false;
			});
		});
	</script>
	<?php  } ?>
	<?php  if($do == 'prepared') { ?>
	<div class="form">
		<h5 class="page-header">已购买的模块</h5>
	</div>
	<div class="module form-horizontal ng-cloak" ng-controller="listInstallModules">
		<div class="item" ng-repeat="m in modules">
			<div class="media">
				<div class="pull-right" style="width:230px;">
					<div class="module-set">
						<a href="<?php  echo url('extension/module/install')?>m={{m.name.toLowerCase()}}">安装</a>
						<a href="http://v2.addons.we7.cc/web/index.php?c=store&a=application&id={{m.id}}" target="_blank">查看详情</a>
						&nbsp;
					</div>
				</div>
				<img class="media-object img-rounded gray" ng-src="http://v2.addons.we7.cc/resource/attachment/{{m.thumb}}" onerror="this.src='../web/resource/images/nopic-small.jpg'">
				<div class="media-body">
					<h4 class="media-heading">
						{{m.title}}<small>（标识：{{m.name}}&nbsp;&nbsp;&nbsp;版本：{{m.version}}&nbsp;&nbsp;&nbsp;作者：{{m.author}}）</small>
					</h4>
					<span>{{m.ability}}&nbsp;<a href="#" class="media-description-button">详细介绍</a></span >
				</div>
			</div>
			<div class="media-description">
				<b>功能介绍：</b>
				<span>
					{{m.description}}
				</span>
			</div>
		</div>
	</div>
	<?php  if($localUninstallModules) { ?>
		<div class="form">
			<h5 class="page-header">未安装的模块(本地模块)</h5>
		</div>
	
		<div class="alert alert-info form-horizontal" style="display:none" id="install-info">
			<dl class="dl-horizontal">
				<dt>整体进度</dt>
				<dd id="pragress"></dd>
				<dt>正在安装的模块</dt>
				<dd id="m_name"></dd>
			</dl>
			<dl class="dl-horizontal" style="display:none">
				<dt>安装失败的模块</dt>
				<dd>
					<p class="text-danger" id="fail" style="margin:0;"></p>
				</dd>
			</dl>
		</div>
	
		<div class="module form-horizontal">
			<?php  if(is_array($localUninstallModules)) { foreach($localUninstallModules as $row) { ?>
			<div class="item" module-name="<?php  echo $row['name'];?>" id="module-<?php  echo $row['name'];?>">
				<div class="media">
					<div class="pull-right" style="width:230px;">
						<div class="module-set">
							<?php  if($row['version_error']) { ?>
							版本不兼容 <a href="<?php  echo url('extension/module/convert', array('id' => strtolower($row['name'])))?>" style="color:red;">转换版本</a>
							<?php  } else { ?>
							<a href="<?php  echo url('extension/module/install', array('m' => strtolower($row['name'])))?>">安装</a>
							<?php  } ?>
							<a href="<?php  echo url('extension/module/permission', array('id' => strtolower($row['name']), 'title' => $row['title']))?>">访问权限</a>
							&nbsp;
						</div>
					</div>
					<img class="media-object img-rounded gray" src="../addons/<?php  echo strtolower($row['name']);?>/icon.jpg" onerror="this.src='../web/resource/images/nopic-small.jpg'">
					<div class="media-body">
						<h4 class="media-heading"><?php  echo $row['title'];?><small>（标识：<?php  echo $row['name'];?>&nbsp;&nbsp;&nbsp;版本：<?php  echo $row['version'];?>&nbsp;&nbsp;&nbsp;作者：<?php  echo $row['author'];?>）</small></h4>
						<span><?php  echo $row['ability'];?>&nbsp;<a href="#" class="media-description-button">详细介绍</a></span >
					</div>
				</div>
				<div class="media-description">
					<b>功能介绍：</b>
					<span>
						<?php  echo $row['description'];?>
					</span>
				</div>
			</div>
			<?php  } } ?>
			<div>
				<span class="btn btn-primary" id="batch-install">一键安装所有本地模块</span>
			</div>
		</div>
	<?php  } else { ?>
		<div class="form">
			<h5 class="page-header">未安装的模块(本地模块)</h5>
			<div class="alert alert-danger">
				目前没有未安装的本地模块
			</div>
		</div>
	<?php  } ?>
	
	<script type="text/javascript">
		require(['angular'], function(angular){
			angular.module('app', []).controller('listInstallModules', function($scope, $http) {
				$.post('<?php  echo url('extension/module/check');?>', {foo: 'install'},function(dat){
					try {
						var ret = $.parseJSON(dat);
						if(!$.isArray(ret)) {
							return;
						}
						$.each(ret, function(){
							$('div.item[module-name=' + this.name + ']').remove();
						});
						$scope.$apply(function(){
							$scope.modules = ret;
						});
					} catch(err) {}
				});
			});
			angular.bootstrap(document, ['app']);
			//处理批量安装模块
			var module = <?php  echo $prepare_module;?>;
			var module_title = <?php  echo $prepare_module_title;?>;
			var total = module.length;
			
			var i = 1;
			var fail = [];
			var success = [];
					
			var insta = function(){
				var m_name = module.pop();
				if(!m_name) {
					util.message('本次成功安装' + success.length + '个模块.<br>安装失败' + fail.length + '个模块', "<?php  echo url('extension/module/installed')?>", 'info');
					return;
				}
				var pragress = i + '/' + total;
				$('#m_name').html(module_title[m_name]);
				$('#pragress').html(pragress);
			
				$.post("<?php  echo url('extension/module/batch-install')?>", {'m_name' : m_name}, function(data){
					if(data == 'success') {
						i++;
						$('#module-' + m_name).slideUp();
						success.push(module_title[m_name]);
						setTimeout(function(){insta()}, 2000);
					} else {
						i++;
						fail.push(module_title[m_name]);
						$('#fail').html(fail.join('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;')).parent().parent().show();
						setTimeout(function(){insta()}, 2000);
					}
				});

			} 
			
			$('#batch-install').click(function(){
				if(!confirm('批量安装仅安装本地模块,不能安装行业模块,确定安装？')) {
					return false;
				}
				$('#install-info').show();
				insta();
			});
		});
	</script>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
