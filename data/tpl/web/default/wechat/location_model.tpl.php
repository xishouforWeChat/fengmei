<?php defined('IN_IA') or exit('Access Denied');?><div class="clearfix user-browser">
	<div class="form-horizontal">
		<table class="table tb" style="min-width:568px;">
			<thead>
			<tr>
				<th style="width: 35px;" class="text-center">选择</th>
				<th style="width: 100px;">门店名称</th>
				<th style="width: 100px;">地址</th>
			</tr>
			</thead>
			<tbody class="location-list">
			<?php  if(!empty($location)) { ?>
				<?php  if(is_array($location)) { foreach($location as $row) { ?>
					<tr id="loca-<?php  echo $row['id'];?>">
						<td class="text-center"><input type="checkbox" id="chk_loca_<?php  echo $row['id'];?>" name="locationids[]" data-id="<?php  echo $row['id'];?>" value="<?php  echo $row['location_id'];?>"></td>
						<td><label for="chk_loca_<?php  echo $row['id'];?>" style="font-weight:normal;" class="name"><?php  echo $row['business_name'];?></label></td>
						<td><label class="label label-info address"><?php  echo $row['address'];?></label></td>
					</tr>
				<?php  } } ?>
			<?php  } else { ?>
				<tr>
					<td align="center" colspan="3">没有有效的门店。你可以 <a href="<?php  echo url('wechat/manage/location_post');?>" target="_blank">添加门店</a> 或 <a href="<?php  echo url('wechat/manage/export');?>" target="_blank">更新门店</a></td>
				</tr>
			<?php  } ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	var selected = $('#form4 input[name="location-select"]').val();
	if(selected) {
		selected = selected.split('-');
		for(var j=0;j<selected.length;j++) {
			$('.location-list :checkbox[value='+selected[j]+']').prop('checked', true);
		}
	}
</script>