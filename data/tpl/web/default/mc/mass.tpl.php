<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	.panel-body .add{display:block;border:3px dotted #b8b8b8; height:72px; line-height:72px; text-align:center; cursor:pointer; border-radius:5px;}
	.panel-group img{position:absolute; left:0; top:0; display:inline-block; width:100%; height:100%;}
	.panel-group{position:relative; cursor:pointer;}
	.panel-group .mask{position:absolute; width:100%; height:100%; left:0; top:0; z-index:10; background-color:rgba(0,0,0,0.6 ) !important; text-align:center; display:none; border-radius:4px;}
	.panel-group:hover .mask,.panel-group.selected .mask{display:block;}
	.panel-group>i{display:none; width:46px; height:46px; color:#fff; text-align:center; line-height:46px; z-index:20; position:absolute; top:50%; left:50%; margin-top:-23px; margin-left:-23px; font-size:46px; font-weight:200;}
	.panel-group.selected>i{display:inline-block}
	input[name="time"]{width:200px}
</style>

<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo url('mc/mass')?>"> 微信群发</a></li>
	<li><a href="<?php  echo url('mc/mass/send')?>"> 已发送</a></li>
</ul>
<?php  echo tpl_ueditor('');?>
<div class="clearfix" ng-controller="massNotice">
	<div class="alert alert-danger" style="margin-bottom:10px">
		使用微信群发,首先确定您的公众号为"认证服务号"或"认证订阅号"。确定后,在 <a href="<?php  echo url('mc/fangroup')?>">粉丝分组</a> 拉取您的粉丝分组。
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			选择群发对象
		</div>
		<div class="panel-body">
			<form action=""  class="form-horizontal" role="form">
				<div class="form-group">
					<div class="col-sm-9 col-xs-12">
						<label class="radio-inline"><input type="radio" value="1" ng-model="send_type">全部粉丝</label>
						<label class="radio-inline"><input type="radio" value="2" ng-model="send_type">分组群发</label>
						<label class="radio-inline" ng-show="account.level == 4"><input type="radio" value="3" ng-model="send_type">指定粉丝【至少选择两个粉丝】</label>
					</div>
				</div>
				<div class="form-group init_hide" ng-show="send_type == 2" style="display: none">
					<div class="col-sm-9 col-xs-12">
						<?php  if(is_array($groups)) { foreach($groups as $group) { ?>
						<label class="radio-inline"><input type="radio" value="<?php  echo $group['id'];?>" ng-model="send_group"><?php  echo $group['name'];?>【<?php  echo $group['count'];?>人】</label>
						<?php  } } ?>
					</div>
				</div>
				<div class="init_hide" ng-show="send_type == 3" style="display: none">
					<div class="form-group">
						<div class="col-sm-12 col-xs-12">
							<a href="javascript:;" ng-click="fans.selectFans()" style="margin-right:20px"><i class="fa fa-plus-circle"></i> 选择粉丝 <span>【已选{{fans.selected.length}}人】</span></a>
							<a href="javascript:;" ng-click="fans.removeAllfans()"><i class="fa fa-trash"></i> 清空</a>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-9 col-xs-12">
							<span style="display:inline-block;width:150px;overflow:hidden;text-overflow:ellipsis;line-height:20px;white-space:nowrap; word-break:break-all;position:relative;padding-right:30px;" ng-repeat="fan in fans.selected">{{fan.nickname}} <i ng-click="fans.removeFan(fan)" class="fa fa-times-circle pull-right" style="position:absolute;right:15px;top:3px;cursor:pointer;"></i></span>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading" style="padding:0">
			<nav class="navbar navbar-default" style="border:none;margin-bottom:0;">
				<div class="container-fluid" style="padding-left:0">
					<ul class="nav navbar-nav">
						<li class="active" data-value="mpnews" ng-click="toggleMsgType('mpnews')"><a href="">图文消息</a></li>
						<li data-value="text" ng-click="toggleMsgType('text')"><a href="">文字</a></li>
						<li data-value="image" ng-click="toggleMsgType('image')"><a href="">图片</a></li>
						<li data-value="voice" ng-click="toggleMsgType('voice')"><a href="">语音</a></li>
						<li data-value="video" ng-click="toggleMsgType('video')"><a href="">视频</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="panel-body">
			<form action=""  class="form-horizontal" role="form" id="form0">
				<!-- 消息类型表单开始 -->
				<div class="form-group init_hide" ng-show="msg_type == 'text'" style="display:none">
					<div class="col-sm-12 col-xs-12">
						<textarea ng-model="text_content" id="text_content" class="form-control" cols="20" rows="3" placeholder="添加要回复的内容"></textarea>
						<div class="help-block">设置用户添加公众帐号好友时，发送的欢迎信息。<a href="javascript:;" ng-init="selectEmotion()" id="emotion"><i class="fa fa-github-alt"></i> 表情</a></div>
					</div>
				</div>
				<div class="form-group init_hide" ng-show="msg_type == 'image'" style="display:none">
					<div class="col-sm-12 col-xs-12">
						<?php  echo tpl_form_field_wechat_image('image_media', '', '', array('extras' => array('text' => 'ng-model="image_media"')));?>
						<span class="help-block">请上传所要回复的图片</span>
					</div>
				</div>
				<div class="form-group init_hide" ng-show="msg_type == 'voice'" style="display:none">
					<div class="12 col-xs-12">
						<?php  echo tpl_form_field_wechat_voice('voice_media', '', array('extras' => array('text' => 'ng-model="voice_media"')));?>
						<span class="help-block">请上传所要回复的语音，上传语音必须是MP3类型</span>
					</div>
				</div>
				<div ng-show="msg_type == 'video'" class="init_hide" style="display:none">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">视频标题</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" placeholder="添加视频消息的标题" ng-model="video_title">
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">上传视频</label>
						<div class="col-sm-9 col-xs-12">
							<?php  echo tpl_form_field_wechat_video('video_media', '', array('extras' => array('text' => 'ng-model="video_media"')));?>
							<span class="help-block">请上传所要回复的视频，上传视频必须是MP4类型</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">描述</label>
						<div class="col-sm-9 col-xs-12">
							<textarea style="height:80px;" class="form-control" cols="70"  ng-model="video_description" placeholder="添加视频消息的简短描述" ></textarea>
							<span class="help-block">描述内容将出现在视频名称下方，建议控制在20个汉字以内最佳</span>
						</div>
					</div>
				</div>
				<div class="form-group init_hide" ng-show="msg_type == 'mpnews'" style="display:none">
					<div class="col-sm-12 col-xs-12" ng-show="mpnews.id == ''">
						<div class="col-sm-6">
							<a class="add" ng-click="mpnews.selectNews()"><i class="fa fa-search"></i> 选择混合图文回复</a>
						</div>
						<div class="col-sm-6">
							<a class="add" href="<?php  echo url('platform/reply', array('m'=> 'news'));?>" target="_blank"><i class="fa fa-plus"></i> 添加混合图文回复</a>
						</div>
					</div>
					<div id="mpnews" class="init_hide reply" ng-show="mpnews.id != ''" style="display: none">
						<div class="col-xs-6 col-sm-3 col-md-3 panel-group">
							<div class="panel panel-default" ng-repeat="item in mpnews.items.replies">
								<div class="panel-body" ng-if="$index == 0">
									<div class="img">
										<i class="default">封面图片</i>
										<img src="" ng-src="{{item.thumb}}">
										<span class="text-left">{{item.title}}</span>
									</div>
								</div>
								<div class="panel-body" ng-if="$index != 0">
									<div class="text">
										<h4>{{item.title}}</h4>
									</div>
									<div class="img">
										<img src="" ng-src="{{item.thumb}}">
										<i class="default">缩略图</i>
									</div>
								</div>
							</div>
						</div>
						<div>
							<a href="javascript:;" ng-click="mpnews.removeNews();">删除</a>
						</div>
					</div>
				</div>
				<!-- 消息类型表单结束 -->
			</form>
		</div>
	</div>
	<div class="form-group">
		<span class="btn btn-primary" id="submit" ng-click="submitForm()">立即发送</span>
	</div>
	<!-- 粉丝选择模态框开始 -->
	<div class="modal fade" id="fans-select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3>
						<ul role="tablist" class="nav nav-pills" style="font-size:14px; margin-top:-20px;">
							<li role="presentation" class="active">
								<a data-toggle="tab" role="tab" aria-controls="fanslist" href="#fanslist">选择粉丝</a>
							</li>
						</ul>
					</h3>
				</div>
				<div class="modal-body">
					<div class="clearfix" id="fanslist" style="width:100%;max-width:900px;position: relative">
						<table class="table table-hover">
							<thead class="navbar-inner">
							<tr>
								<th style="width:15%;">头像</th>
								<th style="width:35%;">昵称</th>
								<th style="width:20%">创建时间</th>
								<th style="width:30%; text-align:right">
									<div class="input-group input-group-sm">
										<input type="text" id="keyword" placeholder="粉丝昵称" name="keyword" value="" class="form-control">
										<span class="input-group-btn">
											<button class="btn btn-default search-fans" type="button" ng-click="fans.selectFans();"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</th>
							</tr>
							</thead>
							<tbody>
							<tr ng-repeat="fan in fans.lists">
								<td><img ng-src="{{fan.avatar}}" width="40"></td>
								<td><a href="#" title="{{fan.nickname}}">{{fan.nickname}}</a></td>
								<td>{{fan.followtime}}</td>
								<td class="text-right">
									<button class="btn btn-default js-btn-select" ng-class="{{fan.selected == 1}} ? 'btn-primary' : ''" id="fan-{{fan.fanid}}" ng-click="fans.toggleSelected(fan)">选取</button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left" id="pager"></div>
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<span class="btn btn-primary" data-dismiss="modal">确定</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 粉丝选择模态框结束 -->

	<!-- 图文选择模态框开始 -->
	<div class="modal fade" id="mpnews-select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:800px">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3>
						<ul role="tablist" class="nav nav-pills" style="font-size:14px; margin-top:-20px;">
							<li role="presentation" class="active">
								<a data-toggle="tab" role="tab" aria-controls="mpnewslist" href="#newslist">选择图文</a>
							</li>
						</ul>
					</h3>
				</div>
				<div class="modal-body">
					<div class="clearfix reply" id="mpnewslist" style="width:100%;max-width:900px;position: relative">
						<div class="col-xs-6 col-sm-6 col-md-6 water" ng-repeat="news in mpnews.rules">
							<div class="panel-group" data-id="{{news.id}}">
								<div class="panel panel-default" ng-repeat="item in news.replies">
									<div class="panel-body" ng-if="$index == 0">
										<div class="clearfix">
											<h4>{{news.name}}<span class="date pull-right"></span></h4>
										</div>
										<div class="img">
											<i class="default">封面图片</i>
											<img src="" ng-src="{{item.thumb}}">
											<span class="text-left">{{item.title}}</span>
										</div>
									</div>
									<div class="panel-body" ng-if="$index != 0">
										<div class="text">
											<h4>{{item.title}}</h4>
										</div>
										<div class="img">
											<img src="" ng-src="{{item.thumb}}">
											<i class="default">缩略图</i>
										</div>
									</div>
								</div>
								<div class="mask"></div>
								<i class="fa fa-check"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left" id="pager"></div>
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<button type="button" class="btn btn-primary">确定</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 图文选择模态框结束 -->
</div>
<script>
	require(['angular.sanitize', 'bootstrap', 'underscore', 'jquery.wookmark'], function(angular, $, _, wookmark){
		angular.module('app', ['ngSanitize']).controller('massNotice', function($scope, $http){
			$scope.account = <?php  echo json_encode($_W["account"])?>;
			$scope.send_type = 3;
			$scope.msg_type = 'mpnews';
			$scope.send_group = 0;
			$scope.mpnews = {
				'id' : 0,
				'rules' : {}
			};
			$scope.fans = {
				selected : [],
				selectedfanids : []
			};

			$('.init_hide').show();

			$scope.toggleMsgType = function(type){
				$scope.msg_type = type;
				$('ul.navbar-nav li').removeClass('active');
				$('ul.navbar-nav li[data-value="'+type+'"]').addClass('active');
			};

			$scope.mpnews.removeNews = function(){
				$scope.mpnews.id = '';
				$scope.mpnews.rules = {};
			};

			$scope.mpnews.selectNews = function(page){
				page = page || 1;
				$http.get('./index.php?c=mc&a=mass&do=news' + '&page=' + page).success(function(result, status, headers, config){
					if (result.message.list) {
						$scope.mpnews.rules = result.message.list;
						$('#mpnews-select #mpnewslist').data('news', result.message.list);;
						$('#mpnews-select #pager').html(result.message.pager);
						$('#mpnews-select #pager .pagination li[class!=\'active\'] a').click(function(){
							$scope.mpnews.selectNews($(this).attr('page'));
							return false;
						});
						$('#mpnewslist .water').wookmark({
							align: 'center',
							autoResize: false,
							container: $('#mpnews-select #mpnewslist')
						});

						$('#mpnewslist').on('click', '.panel-group', function(){
							$('#mpnewslist .panel-group').removeClass('selected');;
							$(this).addClass('selected');
						});

						$('.btn-primary').click(function(){
							$scope.mpnews.id = $('#mpnewslist .panel-group.selected').attr('data-id');
							if(!$scope.mpnews.id) return false;
							console.dir($scope.mpnews.id);
							$scope.mpnews.items = $('#mpnewslist').data('news')[$scope.mpnews.id];
							$scope.$apply();
							$scope.mpnews.modalobj.modal('hide');
						});
						$('#mpnews-select .modal-body').css({'height':'600px','overflow-y':'auto' });
						$scope.mpnews.modalobj = $('#mpnews-select').modal({'show' : true});
					}
				})
			}

			$scope.fans.selectFans = function(page){
				var keyword = $.trim($('#fans-select #keyword').val());
				page = page || 1;
				$http.get('./index.php?c=mc&a=mass&do=fans' + '&page=' + page + '&keyword=' + keyword).success(function(result, status, headers, config){
					if(result.message.list) {
						_.forEach(result.message.list, function(v){
							if($.inArray(v.fanid, $scope.fans.selectedfanids) != -1) {
								v.selected = 1;
							} else {
								v.selected = 0;
							}
						})
						$scope.fans.lists = result.message.list;
						$('#fans-select #pager').html(result.message.pager);
						$('#fans-select #pager .pagination li[class!=\'active\'] a').click(function(){
							$scope.fans.selectFans($(this).attr('page'));
							return false;
						});
						$scope.fans.modalobj = $('#fans-select').modal({'show' : true});
					}
					return true;
				})
			}

			$scope.fans.toggleSelected = function(fan) {
				var index = $.inArray(fan.fanid, $scope.fans.selectedfanids);
				if(index != -1) {
					$('#fans-select #fan-' + fan.fanid).removeClass('btn-primary');
					$scope.fans.selected = $scope.myremove($scope.fans.selected, fan, 'fanid');
					$scope.fans.selectedfanids = _.without($scope.fans.selectedfanids, fan.fanid);
				} else {
					$('#fans-select #fan-' + fan.fanid).addClass('btn-primary');
					$scope.fans.selected.push(fan);
					$scope.fans.selectedfanids.push(fan.fanid);
				}
				return true;
			}

			$scope.fans.removeFan = function(fan) {
				$scope.fans.selected = _.without($scope.fans.selected, fan);
				$scope.fans.selectedfanids = _.without($scope.fans.selectedfanids, fan.fanid);
			}

			$scope.fans.removeAllfans = function() {
				$scope.fans.selected = [];
				$scope.fans.selectedfanids = [];
			};

			//自定义的删除数组元素的函数
			$scope.myremove = function(items, item, keyname) {
				var items_backup = items;
				items = [];
				_.forEach(items_backup, function(v, k){
					if(v[keyname] != item[keyname]) {
						items.push(v);
					}
				})
				return items;
			}

			//选择表情
			$scope.selectEmotion = function() {
				var elm = $('#emotion');
				util.emotion(elm[0], elm.parent().parent().find('#text_content')[0], function(txt, elm, target){
					$scope.text_content = $(target).val();
					$scope.$digest();
				});
			};

			//提交表单
			$scope.submitForm = function(){
				var msg_type = $scope.msg_type;
				var send_type = $scope.send_type;
				if(send_type == 3 && !$scope.fans.selectedfanids.length) {
					util.message('请选择粉丝', '', 'info');
					return false;
				}
				if(msg_type == 'text' && $.trim($scope.text_content) == '') {
					util.message('文本消息不能为空', '', 'info');
					return false;
				}
				$scope.image_media = $(':text[name="image_media"]').val();
				if(msg_type == 'image' && $.trim($scope.image_media) == '') {
					util.message('请上传或选择图片', '', 'info');
					return false;
				}
				$scope.voice_media = $(':text[name="voice_media"]').val();
				if(msg_type == 'voice' && $.trim($scope.voice_media) == '') {
					util.message('请上传或选择语音', '', 'info');
					return false;
				}
				if(msg_type == 'video') {
					$scope.video_media = $(':text[name="video_media"]').val();
					if($.trim($scope.video_media) == '') {
						util.message('请上传或选择视频', '', 'info');
						return false;
					}
					if($.trim($scope.video_title) == '') {
						util.message('请填写视频标题', '', 'info');
						return false;
					}
					if($.trim($scope.video_description) == '') {
						util.message('请填写视频描述', '', 'info');
						return false;
					}
				}
				if(msg_type == 'mpnews' && !$scope.mpnews.id) {
					util.message('请上传或选择图文回复', '', 'info');
					return false;
				}

				var params = {};
				params.send_type = send_type;
				params.msg_type = msg_type;
				if(send_type == 3) {
					params.openids = [];
					_.forEach($scope.fans.selected, function(fans){
						if(fans.openid) {
							params.openids.push(fans.openid);
						}
					});
				} else if(send_type == 2) {
					params.send_group = $scope.send_group;
				}
				if(msg_type == 'text') {
					params.data = $scope.text_content;
				}
				if(msg_type == 'image') {
					params.data = $scope.image_media;
				}
				if(msg_type == 'voice') {
					params.data = $scope.voice_media;
				}
				if(msg_type == 'video') {
					params.data = {
						'title' : $scope.video_title,
						'media' : $scope.video_media,
						'description' : $scope.video_description
					};
					console.dir(params.data);
				}
				if(msg_type == 'mpnews') {
					params.data = $scope.mpnews.id;
				}
				$('#submit').addClass('disabled');
				$('#submit').html('发送中');
				$http.post("<?php  echo url('mc/mass/post');?>", params).success(function(dat, status){
					var data = dat.message;
					if(data.errno < 0) {
						util.message(data.message, '', 'info');
						$('#submit').removeClass('disabled');
						$('#submit').html('重新发送');
						return false;
					} else {
						util.message('群发成功', '', 'success');
						$('#submit').removeClass('disabled');
						$('#submit').html('立即发送');
						return false;
					}
				});
			};
		});
		angular.bootstrap(document, ['app']);
	})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
