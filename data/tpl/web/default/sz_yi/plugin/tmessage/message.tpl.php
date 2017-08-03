<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li class="active"><a href="javascript:;">会员群发</a></li>
</ul>
<?php  if($operation == 'post') { ?>

<div class="main">
    <form <?php if( ce('tmessage' ,$list) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form" enctype="multipart/form-data">
        <div class='panel panel-default'>
            <div class='panel-heading'>
                会员群发
            </div>
            <div class='panel-body'>
                
                <input type="hidden" name="tp_id" value="<?php  echo $list['id'];?>" />
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span> 模版名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('tmessage' ,$list) ) { ?>
                        <input type="text" name="tp_title" class="form-control" value="<?php  echo $list['title'];?>" placeholder="模版名称，例：新品上市通知群发（自定义）" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $list['title'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span> 模版消息ID</label>
                    <div class="col-sm-9 col-xs-12">
                            <?php if( ce('tmessage' ,$list) ) { ?>
                        <input type="text" name="tp_template_id" class="form-control" value="<?php  echo $list['template_id'];?>" placeholder="模版消息ID，例：P8MxRKmW7wdejmZl14-swiGmsJVrFJiWYM7zKSPXq4I" />
                             <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $list['template_id'];?></div>
                        <?php  } ?>
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span>first.DATA(头部标题)</label>  
                    
                    <?php if( ce('tmessage' ,$list) ) { ?>
                    <div class="col-sm-6" >
                            
                        <input type="text" name="tp_first" class="form-control" value="<?php  echo $list['first'];?>" placeholder="" />
                       
                    </div>
                       <div class="col-sm-3" style="width:30%; ">
                          
                           <?php  echo tpl_form_field_color('firstcolor', $list['firstcolor'])?>
                        
                    </div>
                       <?php  } else { ?>
                       <div class="col-sm-9 col-xs-12">
                             <div class='form-control-static'><?php  echo $list['first'];?> 颜色: <?php  echo $list['firstcolor'];?></div>
                             </div>
                        <?php  } ?>
                        
                </div>
                  
                <?php  if(is_array($data)) { foreach($data as $list2) { ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('message_type', TEMPLATE_INCLUDEPATH)) : (include template('message_type', TEMPLATE_INCLUDEPATH));?>
                <?php  } } ?>
                  <?php if( ce('tmessage' ,$list) ) { ?>
                <div id="type-items"></div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                    <div class="col-sm-9 col-xs-12">
                        <a class="btn btn-default btn-add-type" href="javascript:;" onclick="addType();"><i class="fa fa-plus" title=""></i> 增加一条键</a>
                    </div>
                </div>
                <?php  } ?>
                
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" >remark.DATA(尾部描述)</label>
                       <?php if( ce('tmessage' ,$list) ) { ?>
                    <div class="col-sm-6">
                        <input type="text" name="tp_remark" class="form-control" value="<?php  echo $list['remark'];?>" placeholder="" />
                     
                    </div>
                    <div class="col-sm-3" style="width:30%; ">
                           <?php  echo tpl_form_field_color('remarkcolor', $list['remarkcolor'])?>
                    </div>
                    
                        <?php  } else { ?>
                       <div class="col-sm-9 col-xs-12">
                             <div class='form-control-static'><?php  echo $list['remark'];?> 颜色: <?php  echo $list['remarkcolor'];?></div>
                             </div>
                        <?php  } ?>
                        
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span>消息链接</label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('tmessage' ,$list) ) { ?>
                        <input type="text" name="tp_url" class="form-control" value="<?php  echo $list['url'];?>" placeholder="" />
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $list['url'];?></div>
                        <?php  } ?>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('tmessage' ,$list) ) { ?>
                       <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
	       <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('tmessage.add|tmessage.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
                </div>
                
            </div>
        </div>
     
    </form>
</div>
<script language='javascript'>
    var kw = 1;
    function addType() {
        $(".btn-add-type").button("loading");
        $.ajax({
            url: "<?php  echo $this->createPluginWebUrl('tmessage',array('op'=>'addtype'))?>&kw="+kw,
            cache: false
        }).done(function (html) {
            $(".btn-add-type").button("reset");
            $("#type-items").append(html);
        });
        kw++;
    }
    function removeType(obj) {
        $(obj).parent().parent().remove();
    } 
 

        $('form').submit(function(){
    
            if($(':input[name=tp_title]').isEmpty()){
                Tip.focus($(':input[name=tp_title]'),'请输入模板名称!');
                return false;
            }
            if($(':input[name=tp_template_id]').isEmpty()){
                Tip.focus($(':input[name=tp_template_id]'),'请输入模版消息ID!');
                return false;
            }
            
            if($(':input[name=tp_first]').isEmpty()){
                Tip.focus($(':input[name=tp_first]'),'请输入first.DATA!');
                return false;
            }
            if($('.key_item').length<=0){
                Tip.focus(   $(".btn-add-type") ,'请添加一条键!','right');
                return false;
            }
            var checkkw = true;
            $(":input[name='tp_kw[]']").each(function(){
                if ( $.trim( $(this).val() ) ==''){ 
                    checkkw = false;
                    Tip.focus(   $(this) ,'请输入键名!');    
                    return false;
                }
            })
            return checkkw;
      });
 
    </script>

<?php  } else if($operation == 'display') { ?>

               <form action="" method="post" onsubmit="return formcheck(this)">
     <div class='panel panel-default'>
            <div class='panel-heading'>
                会员消息群发模版列表
            </div>
         <div class='panel-body'>

            <table class="table">
                <thead>
                    <tr>
                        <th>群发消息模版名称</th>
                        <th>发送次数</th>
                        <th>发送人数</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <tr>
                        <td><?php  echo $row['title'];?></td>
                        <td><?php  echo number_format($row['sendtimes'])?></td>
                        <td><?php  echo number_format($row['sendcount'])?></td>
                        <td>
                            <?php if(cv('tmessage.edit|tmessage.view')) { ?><a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('tmessage', array('op' => 'post', 'id' => $row['id']))?>" title="<?php if(cv('tmessage.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class='fa fa-edit'></i></a><?php  } ?>
                            <?php if(cv('tmessage.edit')) { ?><a class='btn btn-default'  href="<?php  echo $this->createPluginWebUrl('tmessage', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此模版吗？');return false;" title='删除'><i class='fa fa-remove'></i></a><?php  } ?>
                            <?php if(cv('tmessage.send')) { ?><a class='btn btn-default' style="background: #428bca; border: 0px; color: #fff;" href="<?php  echo $this->createPluginWebUrl('tmessage', array('op' => 'send', 'id' => $row['id']))?>" title='发送'><i class='fa fa-send'></i></a></td><?php  } ?>
                    </tr>
                    <?php  } } ?>
                 
                </tbody>
            </table>
  
         </div>
         <?php if(cv('tmessage.add')) { ?>
           <div class='panel-footer'>
                            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('tmessage', array('op' => 'post'))?>"><i class="fa fa-plus"></i> 添加新模版</a>
         </div>
         <?php  } ?>
     </div>
       </form>
 
<?php  } else if($operation == 'addtype') { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label" ><span style='color:red'>*</span></label>
                    <div class="col-sm-9 col-xs-12" style="width:5%">
                        <a class="btn btn-default" href='javascript:;' onclick='removeType(this)'><i class='icon icon-remove fa fa-times'></i> 删除</a>
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:15%">
                        <input type="text" name="tp_kw[]" class="form-control" value="<?php  echo $group['groupname'];?>" placeholder="键值，例：keywords<?php  echo $kw;?>" />
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:40%">
                        <input type="text" name="tp_value[]" class="form-control" value="<?php  echo $group['groupname'];?>" placeholder="请在此输入对应的值" />
                    </div>
                    <div class="col-sm-9 col-xs-12" style="width:30%; ">
                        <?php  echo tpl_form_field_color('tp_color[]', $value=$settings['maincolor'])?>
                    </div>
                </div>
<?php  } else if($operation == 'send') { ?>
 
        <div class="main">
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">

                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        会员消息群发
                    </div>
                
                    <div class='panel-body'>
                         <div class="alert alert-info">
                             <p>根据选择的用户群体不同，发送时间会不相同，发送期间请耐心等待! </p>
                             <p>模板消息群发有风险，请谨慎使用，大用户量建议使用公众平台推送!</p>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" >模版名称</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="tp_title" class="form-control" value="<?php  echo $send['title'];?>(ID:<?php  echo $send['id'];?>)" placeholder="" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" >发送类型</label>
                            <div class="col-sm-9 col-xs-12">
                                <label class="radio-inline"><input type="radio" name="send1" value="1"  checked /> 按openid发送</label>
                                <label class="radio-inline"><input type="radio" name="send1" value="2"    /> 按用户等级发送</label>
                                <label class="radio-inline"><input type="radio" name="send1" value="3"  /> 按用户分组等级发送</label>
                                <?php  if(p('commission')) { ?>
                                <label class="radio-inline"><input type="radio" name="send1" value="5"  /> 按分销商等级发送</label>
                                <?php  } ?>
                                <label class="radio-inline"><input type="radio" name="send1" value="4" />全部发送</label>
                            </div>
                        </div>
                         <div class="form-group choose choose_1">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" >会员openid</label>
                            <div class="col-sm-9 col-xs-12">
                                <textarea name="send_openid" class="form-control" style="height:250px;" placeholder="请用半角逗号隔开OPENID, 如 aaa,bbb" id="value_1"></textarea>
                            </div>
                        </div>
           
                        <div class="form-group choose choose_2" style='display: none' >
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" >选择会员等级</label>
                            <div class="col-sm-8 col-lg-9 col-xs-12">
                                <select name="send_level" class="form-control" id="value_2" >
                                            <option value="0">全部</option>
                                            <?php  if(is_array($list)) { foreach($list as $type) { ?>
                                            <option value="<?php  echo $type['id'];?>"><?php  echo $type['levelname'];?></option>
                                            <?php  } } ?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group choose choose_3" style='display:none '>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" >选择会员分组</label>
                            <div class="col-sm-8 col-lg-9 col-xs-12">
                                    <select name="send_group" class="form-control"  id="value_3">
                                            <option value="0">全部</option>
                                            <?php  if(is_array($list2)) { foreach($list2 as $type2) { ?>
                                            <option value="<?php  echo $type2['id'];?>"><?php  echo $type2['groupname'];?></option>
                                            <?php  } } ?>
                                    </select>
                            </div>
                        </div>
                          <?php  if(p('commission')) { ?>
                         <div class="form-group choose choose_5" style='display:none '>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" >选择分销商等级</label>
                            <div class="col-sm-8 col-lg-9 col-xs-12">
                                    <select name="send_agentlevel" class="form-control"  id="value_5">
                                            <option value="0">全部</option>
                                            <?php  if(is_array($list3)) { foreach($list3 as $type3) { ?>
                                            <option value="<?php  echo $type3['id'];?>"><?php  echo $type3['levelname'];?></option>
                                            <?php  } } ?>
                                    </select>
                            </div>
                        </div>
                          <?php  } ?>
                        
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" ></label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="help-block">       
                                    <input type="button" name="button" value="发送" class="btn btn-primary col-lg-4"  onclick="send()"/>
                                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /></div>
                            </div>
                        </div>
 
                </div>
           
                    <script>
                        $(function(){
                            $(':radio[name=send1]').click(function(){
                                var v = $(this).val();
                                 $(".choose").hide();
                                 $(".choose_"+v).show();
                            })
                        })
                      
                         var openids = [];
                        function send(){
                              var btn = $('input[type=button]');
                            if(btn.attr('sending')=='1'){
                                return;
                            }
                            
                            var c = $('input[name=send1]:checked').val();
                            var v = $('#value_'+c).val();
                            if(c==1 && v==''){
                                alert('请输入要群发的用户Openid!');
                                return;
                            }
             
                            btn.removeClass('btn-primary').val('正在获取发送的用户Openid...').attr('sending',1);
                            $.ajax({
                                url: "<?php  echo $this->createPluginWebUrl('tmessage')?>",
                                type:'post',
                                dataType:'json',
                                data: {'op':'fetch',class1:c,value1:v,id:"<?php  echo $send['id'];?>"},
                                success:function(result){
                                    openids = result.openids;
                                    btn.val('共要发送给 ' + openids.length + " 个用户，准备发送!");
                                    sendmessage();
                                }
                            });
                        }
                        var current = 0;
                        var failed = [];
                        var failmsg = "";
                        var succeed = 0;
                        function sendmessage(){
                           var btn = $('input[type=button]');
                              
                            if(current>openids.length-1){
                                if(failed.length>0){
                                    var msg = '发送成功 ' + succeed + ' 个用户，失败 ' + failed.length + " 个用户:\r\n";
                                    msg+=failmsg;
                                    msg+="\r\n 是否继续发送失败的用户? ";
                                   if(confirm(msg)) {
                                       current = 0 ;succeed=0;
                                       openids = failed;
                                       failed=[];
                                       failmsg= "";
                                       btn.val('共要发送给 ' + openids.length + " 个用户，准备发送!");
                                       sendmessage();
                                       return;
                                   }
                                   location.reload();
                                   
                                } else{
                                    alert('发送成功 ' + succeed + ' 个用户!' );
                                    location.reload();
                                }
                            }
                            var openid = openids[current];
                            $.ajax({
                                url: "<?php  echo $this->createPluginWebUrl('tmessage')?>",
                                type:'post',
                                data: {'op':'sendmessage','openid':openid, id:"<?php  echo $send['id'];?>"},
                                dataType:'json',
                                success:function(result2){
                                  if(result2.result=='1'){
                                       succeed++;
                                  }
                                  else{
                                      failmsg+= result2.openid + "\r\n(错误信息: " + result2.message + ")\r\n\r\n";
                                      failed.push(result2.openid);
                                  }
                                  btn.val('已经发送 ' + current + " / " + openids.length + " 个用户...");
                                  current++;
                                  sendmessage();
                              }
                            });
                        }
                    </script>
            </form>
        </div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
