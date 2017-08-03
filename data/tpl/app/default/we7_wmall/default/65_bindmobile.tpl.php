<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>

<style type="text/css">
    .page_topbar {    position: relative;height:45px; background:#fff; border-bottom:1px solid #e8e8e8; font-size:16px; line-height:45px; text-align:center; }
    .page_topbar .title {height:45px;;line-height:45px; color:#666; text-align: center;}
    .page_topbar a.back {position:absolute;left:15px;height:45px;line-height:45px;display:block;color:#999; font-size:24px;}
    .page_topbar a.btn { position: absolute;right:10px;height:45px;line-height:45px;display:block;color:#999; font-size:24px; }
	.info_main {height:auto;  background:#fff; margin-top:14px; border-bottom:1px solid #e8e8e8; border-top:1px solid #e8e8e8;}
    .info_main .line {margin:0 10px; height:40px; border-bottom:1px solid #e8e8e8; line-height:40px; color:#999;position: relative;}
    .info_main .line .title {height:40px; width:80px; line-height:40px; color:#444; float:left; font-size:16px;}
    .info_main .line .info { width:100%;float:right;margin-left:-80px; }
    .info_main .line .inner { margin-left:80px; }
    .info_main .line .inner input {height:40px; display:block; padding:0px; margin:0px; border:0px; float:left; font-size:16px;}
    .info_main .line .inner .user_sex {line-height:40px;}
    .info_sub {height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .register {float:right;width:46%;height:44px; margin:14px 5px; background:#31cd00; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .nobindmobile {clear:both;height:44px; margin:14px 5px; background:#ccc; border-radius:4px; text-align:center; font-size:16px; line-height:44px; color:#fff;}
    .select { border:1px solid #ccc;height:25px;}
    .hide {display: none;}

</style>

<div class="page address" >
	 <div class="page_topbar">
        <a href="javascript:;" class="back" onclick="history.back()"><i class="fa fa-angle-left"></i></a>
        <div class="title">绑定手机</div>
    </div>
    <div class="info_main">
        <div class="line"><div class="title">手机号码</div><div class='info'><div class='inner'><input type="text" id='mobile' placeholder="请输入您的手机号码"  value="" /></div></div></div>

        <div class="line"><div class="title">验证码</div><div class='info'><div class='inner'><input type="text" id='code' placeholder="请输入验证码"  value="" /><input id="btnSendCode" style="position: absolute;right: 0;top: 0;background:##31cd00" type="button" value="发送验证码"  /></div></div></div>

        <!--div class="hide">
          <div class="line"><div class="title">设置密码</div><div class='info'><div class='inner'><input type="password" id='password' placeholder="请输入您的密码"  value="" /></div></div></div>
          <div class="line"><div class="title">确认密码</div><div class='info'><div class='inner'><input type="password" id='cpassword' placeholder="请确认密码"  value="" /></div></div></div>
        </div-->


    </div>
    <div class="info_sub">绑定</div>
    <div class="nobindmobile">返回</div>
</div>

<script type="text/javascript">
$(function() {
    $('.nobindmobile').click(function() {
        location.href = "<?php  echo $this->createMobileUrl('mine')?>";
    });

    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var curCount; //当前剩余秒数
    var hasmobile = false;
    $('#btnSendCode').click(function() {
    	var reg = /^1[0-9]{10}$/;
    	var phoneNum = $('#mobile').val();
        if (!reg.test(phoneNum)) {
            alert('请输入正确手机号码!');
            return;
        }
        $.post("<?php  echo $this->createMobileUrl('bindmobile')?>", {
            'mobile': $('#mobile').val(),
            'op': 'ismobile'
        },
        function(json) {
            if (json.status == 1) {
                hasmobile = true;
            }
        },
        'json');

        curCount = count;

        　　 //向后台发送处理数据 
        $.post("<?php  echo $this->createMobileUrl('bindmobile')?>", {
            'mobile': $('#mobile').val(),
            'op': "bindmobilecode"
        },
        function(json) {
            if (json.status == 1) {
                //设置button效果，开始计时
                $("#btnSendCode").attr("disabled", "true");
                $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
                InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
            } else {
                alert(json.result);
            }

        },
        'json');

        //timer处理函数
        function SetRemainTime() {
            if (curCount == 0) {
                window.clearInterval(InterValObj); //停止计时器
                $("#btnSendCode").removeAttr("disabled"); //启用按钮
                $("#btnSendCode").val("重新发送验证码");
            } else {
                curCount--;
                $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
            }
        }

    });

	
    $('.info_sub').click(function() {
        var reg = /^1[0-9]{10}$/;
    	var phoneNum = $('#mobile').val();
        if (!reg.test(phoneNum)) {
            alert('请输入正确手机号码!');
            return;
        }
        if (!$('#code').val()) {
            alert('请输验证码!');
            return;
        }

        $.post("<?php  echo $this->createMobileUrl('bindmobile')?>", {
            'code': $('#code').val(),
            'op': 'checkcode'
        },
        function(json) {
            if (json.status == 0) {
                alert(json.result);
                return;
            }
            
            $.post("<?php  echo $this->createMobileUrl('bindmobile')?>", {
                'mobile': $('#mobile').val(),
                'op': 'bindmobile'
            },
            function(json) {
                if (json.status == 1) {
                    alert('绑定成功');
                    location.href = "<?php  echo $this->createMobileUrl('mine')?>";
                } else {
                    alert('绑定失败!');
                }

            },
            'json');
        },
        'json');

    });
})
</script>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>