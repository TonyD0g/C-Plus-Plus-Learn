<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>区块管理</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body>
    <div class="position">当前位置：模板插件 > <a href="<?php echo U('index');?>">区块管理</a></div>
    <div class="border">
        <a href="<?php echo U('add');?>" class="ui-btn ui-btn-info"><i class="ui-icon-plus"></i>添加区块</a>
        <div class="ui-table-wrap">
        <table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt-20">
            <thead class="ui-thead-gray">
                <tr>
                    <th>区块说明</th>
                    <th width="300">关键字</th>
                    <th width="180">修改时间</th>
                    <th width="300">调用标签</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($file)==0) { ?>
            <tr>
                <td colspan="5">暂无区块</td>
            </tr>
            <?php }?>
            <?php foreach($file as $key=>$val) { ?>
            <?php $n=$dir.'/'.$val[0];?>
            <tr>
                <td class="ui-text-left"><?php if (isset($name[$n])) {  echo $name[$n]; }?></td>
                <td><?php echo str_replace('.php','',$val[0]);?></td>
                <td><?php echo date('Y-m-d H:i:s',$val[1]);?></td>
                <td><input type="text" class="block ui-form-ip" config="<?php echo str_replace('.php','',$val[0]);?>" value="" onFocus="this.select()"></td>
                <td><a href="<?php echo U('edit','root='.$val[2].'');?>"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="<?php echo U('del','key='.$val[2].'');?>"><span class="ui-icon-delete"></span> 删除</a></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
        </div>
    </div>
<script>
$(function()
{
	$(".block").each(function(e)
	{
		var key=$(this).attr("config");
		var html='{';
		html+='block("';
		html+=key;
		html+='")}';
		$(this).attr("value",html);
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