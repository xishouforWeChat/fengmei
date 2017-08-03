<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<div class="page coupon" id="page-app-coupon">
	<header class="bar bar-nav common-bar-nav">
		<a class="pull-left icon fa fa-arrow-left back" href="javascript:;"></a>
		<h1 class="title">平台管理员</h1>
		<button class="button button-link button-nav pull-right hide">新增</button>
	</header>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('nav', TEMPLATE_INCLUDEPATH)) : (include template('nav', TEMPLATE_INCLUDEPATH));?>	
<div style="margin-top:40px;overflow:scroll">
	<table style="border-collapse:separate; border-spacing:0px 25px;">
		<tr>
			<td>选供应商：</td>
			<td>
			<select name="gaver_id" id='gaver_id' class="">
				<option>请选择</option>
				<?php  if(is_array($gavername)) { foreach($gavername as $item) { ?>
				<option value="<?php  echo $item['id'];?>"><?php  echo $item['gavername'];?></option>
				<?php  } } ?>
			</select>
			</td>
		</tr>
		<tr>
			<td>选择水果：</td>
			<td>
			<select name="goods_id" id='goods_id'>
			<option>请选择</option>
			</select>
			</td>
		</tr>
		
		<tr>
			<td>输入价格：</td>
			<td><input type="text" id="price"></td>
		</tr>
		
		<tr>
			<td>输入分量：</td>
			<td><input type="text" id="num"></td>
		</tr>
	</table>
</div>
<div style="text-align:center">
<button id='sub' style="width:71%">提交</button>
</div>

		<div style="text-align:center">
			<?php  
				if($adminer){
					$riqi=array();
					foreach($adminer as $key){
						if(!isset($riqi[$key['riqi']])){
							$riqi[$key['riqi']]=$key['riqi'];
						}
					}
					foreach($riqi as $k){
				?>
					<a href="<?php  echo $this->createMobileUrl('adminer',array('riqi'=>$k))?>"><?php  echo $k?></a>
					<?php  }}?>
		</div>
<script>
	$('#gaver_id').change(function(e){
		var gaver_id=$('option:selected').val();
		$.ajax({
			url:"<?php  echo $this->createMobileUrl('adminer');?>",
			type:'post',
			data:{gaver_id:gaver_id},
			dataType:'json',
			success:function(res){
				var html="<option>"+"请选择"+"</option>";
				$.each(res.message.data,function(i,v){
					html+="<option value="+v.id+">"+v.goods+"</option>";
				})
				$("#goods_id").html(html);
			}
		})
	})

	$('#sub').click(function(){
		var gaver_id= $('#gaver_id option:selected').val();
		var goods_id= $('#goods_id option:selected').val();
		var price=$('#price').val();
		var num=$('#num').val();
			if(gaver_id==''){
				$.toast('请选择供应商');
				return false;
			}
			if(goods_id==''){
				$.toast('请选择商品');
				return false;
			}
			if(price==''){
				$.toast('请填写价格');
				return false;
			}
			if(num==''){
				$.toast('请填写分量');
				return false;
			}
		$.post("<?php  echo $this->createMobileUrl('adminer');?>",{gaver_id:gaver_id,goods_id:goods_id,price:price,num:num},function(data){
			var result = $.parseJSON(data);
				if(result.message.error ==-1) {
					$.toast(result.message.message);
					return false;
				}else{
					location.reload();
				}
		})
	
	})

</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>