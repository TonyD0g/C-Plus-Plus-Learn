<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>后台用户</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body>
<div class="position">当前位置：网站管理 > <a href="<?php echo THIS_LOCAL;?>">后台用户</a></div>
<div class="border">
    <a href="javascript:;" data-url="<?php echo U('add');?>" class="add-iframe ui-btn ui-btn-info"><i class="ui-icon-plus"></i>添加用户</a>
    <form method="post" class="ui-form">
    <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
        <thead class="ui-thead-gray">
            <tr>
                <th width="80">ID</th>
                <th>用户名</th>
                <th width="120">登录次数</th>
                <th width="180">最后登录日期</th>
                <th width="120">部门</th>
                <th width="100">状态</th>
                <th width="100">只读模式</th>
                <th width="150">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php $array_rs=$this->db->load("select * from cms_admin a left join cms_part b on a.pid=b.id  where 1=1  order by adminid ",0,false,0);$total_rs=count($array_rs);if($total_rs==0){ ?>
        <tr>
            <td colspan="8">暂无资料</td>
        </tr>
<?php } else{ ?>
<?php $i=0;} foreach($array_rs as $rs){ $i++;?>
        <tr>
            <td><?php echo $rs['adminid'];?></td>
            <td class="ui-text-left"><?php echo $rs['adminname'];?></td>
            <td><?php echo $rs['logintimes'];?></td>
            <td><?php echo date('Y-m-d H:i:s',$rs['lastlogindate']);?></td>
            <td><?php if ($rs['pid']==0) { ?>超级管理员<?php } else {  echo $rs['title']; }?></td>
            <td><label class="ui-switch ui-switch-info"><input type="checkbox" <?php if ($rs['isshow']==1) { ?> checked<?php }?> data-url="<?php echo U('switchs','type=1&id='.$rs['adminid'].'');?>"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
            <td><label class="ui-switch ui-switch-info"><input type="checkbox" <?php if ($rs['readonly']==1) { ?> checked<?php }?> data-url="<?php echo U('switchs','type=2&id='.$rs['adminid'].'');?>"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
            <td class="text-right"><a href="javascript:;" data-url="<?php echo U('edit',"id=".$rs['adminid']."");?>" class="edit-iframe"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="<?php echo U('del','id='.$rs['adminid'].'');?>"><span class="ui-icon-delete"></span> 删除</a></td>
        </tr>
        <?php } if($total_rs>0){ ?>
<?php }?>
        </tbody>
    </table>
    </div>
    </form>
</div>
<script>
$(function()
{
	$(".add-iframe").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"添加用户",
			text:url,
			width:'560px',
			height:'430px',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			},
			cancel:function(){location.href=location.href;}
		});
	});
	$(".edit-iframe").click(function()
	{
		var url=$(this).data("url");
		$.dialogbox(
		{
			title:"编辑用户",
			text:url,
			width:'560px',
			height:'460px',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			},
			cancel:function(){location.href=location.href;}
		});
	});
	$('.ui-switch input[type=checkbox]').on('click',function()
	{
		var url=$(this).data("url");
		var result=($(this).is(':checked'))?1:0;
		$.ajax(
		{
			url:url,
			type:"post",
			dataType:'json',
			data:"token=<?php echo $token;?>&state="+result,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					sdcms.success(d.msg);
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		});
	});
	$(".ui-form").form(
	{
		type:2,
		result:function(form)
		{
			$.ajax(
			{
                type:'post',
                cache:false,
                dataType:'json',
                url:'<?php echo THIS_LOCAL;?>',
                data:$(form).serialize(),
                error:function(e){alert(e.responseText);},
                success:function(d)
                {
                    if(d.state=='success')
                    {
                        sdcms.success(d.msg);
                        setTimeout(function(){location.href='<?php echo THIS_LOCAL;?>';},1500);
                    }
                    else
                    {
                        sdcms.error(d.msg);
                    }
                }
            });
		}
	});
	$(".del").click(function()
	{
		var url=$(this).data("url");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要删除？不可恢复！",
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				$.ajax(
				{
                    url:url,
					type:'post',
					dataType:'json',
					data:'token=<?php echo $token;?>',
					error:function(e){alert(e.responseText);},
                    success:function(d)
                    {
                        e.close();
                        if(d.state=='success')
                        {
                            sdcms.success(d.msg);
                            setTimeout(function(){location.href='<?php echo THIS_LOCAL;?>';},1000);
                        }
                        else
                        {
                            sdcms.error(d.msg);
                        }
                    }
                });
			}
		});
    });
})
</script>
</body>
</html>