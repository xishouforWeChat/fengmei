<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php  if($mission!=7) { ?>
<div style="width:14rem;background-color:#FFF;margin:0 auto;border-radius:6px;opacity:0.5;color:#000 ;">

	<div style="margin:10rem auto;">
		<form action="#" method="get">

			<div style="margin:0.5rem auto;width:10rem"><span>请输入收货码（4位数字）</span></div>
			<div style="margin:0 auto 0.5rem auto;width:12rem"><input type="text" id="code" style="border-radius:5px;width:12rem;height:1.5rem" name="code"/></div>
			
			<input type="hidden" name="i" id="i" value="<?php  echo $_GET['i'];?>">
			<input type="hidden" name="c" id="c" value="<?php  echo $_GET['c'];?>">
			<input type="hidden" name="do" id="do" value="<?php  echo $_GET['do'];?>">
			<input type="hidden" name="m" id="m" value="<?php  echo $_GET['m'];?>">
			<input type="hidden" name="oid" id="oid" value="<?php  echo $_GET['oid'];?>">
			<div style="width: 14rem">
				<div style="float:left;width: 7rem;height: 2rem ;"><input type="submit" style="width: 7rem;height: 2rem;border-radius:0 0 0 5px;color: green" value="取消" ></div>
				<div style="float:right;width: 7rem;height: 2rem ;"><input type="submit" style="width: 7rem;height: 2rem;border-radius:0 0 5px 0;color: green" value="收货"  ></div>
				<!-- <div style="float:left;margin-top:0.2rem;"><input type="submit" style="width: 5rem;height: 2rem;border-radius:0 0 5px 0;" value="确认收货"><div/>
				<div style="margin-left:6rem;margin-top:0.2rem;width:5rem"><div/> -->
				<div style="clear:both"></div>
			</div>
			<div style="clear:both"></div>
		</form>
	</div>
<?php  } ?>

<script type="text/javascript">
	wx.config({
    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: 'wx827cca45aecf0366', // 必填，公众号的唯一标识
    timestamp:"<?php  echo $timestamp?>" , // 必填，生成签名的时间戳
    nonceStr: "<?php  echo $wxnonceStr?>", // 必填，生成签名的随机串
    signature: "<?php  echo $wxSha1?>",// 必填，签名，见附录1
    jsApiList: ['scanQRCode'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});    
</script>
<!-- <script type="text/javascript">

 	var btn=document.getElementById('btn');
	btn.onclick=function(){	
		alert("取货成功");
	wx.scanQRCode({
    	desc: 'scanQRCode desc',
    	needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
    	scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
    	success: function (res) {
    		var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
			}
 		});
	}

</script> -->
<script type="text/javascript">
	wx.config({
    debug: false, 
    appId: 'wx827cca45aecf0366', 
    timestamp:"<?php  echo $timestamp?>" , 
    nonceStr: "<?php  echo $wxnonceStr?>", 
    signature: "<?php  echo $wxSha1?>",
    jsApiList: ['scanQRCode'] 
});    
</script>
<script type="text/javascript">
function dianji(){	
	alert("<?php  echo $mes?>");
	wx.scanQRCode({
    	desc: 'scanQRCode desc',
    	needResult: 0, 
    	scanType: ['qrCode','barCode'],
    	success: function (res) {
    		var result = res.resultStr;
			}
 		});
	};

var safdsa="<?php  echo $mission;?>";
	if(safdsa==7){
		setTimeout(dianji,2000);

}
if(safdsa==2){
	//setTimeout(dianji,2000);
	alert("<?php  echo $mes;?>");
}
</script>



