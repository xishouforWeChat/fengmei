<?php defined('IN_IA') or exit('Access Denied');?><div id="uploader">
	<div class="queueList">
		<div id="dndArea" class="placeholder">
			<div id="filePicker"></div>
		</div>
	</div>
</div>

<script>
require(['jquery', 'webuploader', 'util' ], function($, WebUploader, u) {
	$(function() {
		var callback = <?php  echo $_GPC['callback'];?>;
		var uploader = WebUploader.create({
			pick: {
				id: '#filePicker',
				label: '点击选择图片',
				multiple : false
			},
			auto: true,
			swf: '<?php  echo $_W['siteroot'];?>app/resource/componets/webuploader/Uploader.swf',
			server: '<?php  echo $_W['siteroot'];?>app/<?php  echo str_replace('./','',url('utility/file',array('do'=>'upload', 'type'=>'image'), true))?>',
			chunked: true,
			fileNumLimit: 1,
			fileSizeLimit: 4 * 1024 * 1024, // 4M
			fileSingleSizeLimit: 4 * 1024 * 1024 // 4M
		});
		
		uploader.on( 'fileQueued', function( file ) {
			u.loading();
		});
		
		uploader.on('uploadSuccess', function(file, result) {
			if(result.error && result.error.message){
				require(['util'], function(u){
					u.message(result.error.message);
				});
			} else {
				if(callback){
					callback(result.result);
				}
			}
			uploader.reset();
		});
		uploader.onError = function( code ) {
			alert('Eroor: ' + code );
		};
	});
});
</script>
