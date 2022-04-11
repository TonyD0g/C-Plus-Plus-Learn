<?php defined('IN_CMS') or die(); if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>内容管理</title>
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/css/ui.css">
<link rel="stylesheet" href="<?php echo WEB_ROOT;?>public/admin/css/layout.css">
<script src="<?php echo WEB_ROOT;?>public/js/jquery.js"></script>
<script src="<?php echo WEB_ROOT;?>public/js/ui.js"></script>
</head>
<body>
    <div class="position">当前位置：内容管理 > <a href="<?php echo U('lists');?>">内容列表</a><?php if ($classid>0) {  echo $position; }?></div>
    <div class="border">
        <div class="navbar">
            <div class="lefter">
                <a href="<?php echo U('add','classid='.$classid.'');?>" class="ui-btn ui-btn-info ui-mr-sm"><i class="ui-icon-plus"></i>添加内容</a>
                <a href="javascript:;" class="ui-btn ui-btn-info ui-dropdown-show ui-mr-sm" data-target="#dropdown-1"><i class="ui-icon-Batchfolding"></i>批量操作</a>
                <div class="ui-dropdown" id="dropdown-1">
                    <a href="javascript:;" class="ui-dropdown-item btach" type="1">批量启用</a>
                    <a href="javascript:;" class="ui-dropdown-item btach" type="2">批量锁定</a>
                    <div class="ui-dropdown-line"></div>
                    <a href="javascript:;" class="ui-dropdown-item btach" type="3">设为推荐</a>
                    <a href="javascript:;" class="ui-dropdown-item btach" type="4">取消推荐</a>
                    <div class="ui-dropdown-line"></div>
					<a href="javascript:;" class="ui-dropdown-item move">批量移动</a>
                    <a href="javascript:;" class="ui-dropdown-item btach" type="99">批量删除</a>
                </div>
                <span class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                    <a class="ui-btn-group-item<?php if ($type==0) { ?> active<?php }?>" href="<?php echo U('lists','type=0');?>">全部</a>
                    <a class="ui-btn-group-item<?php if ($type==1) { ?> active<?php }?>" href="<?php echo U('lists','type=1');?>">启用</a>
                    <a class="ui-btn-group-item<?php if ($type==2) { ?> active<?php }?>" href="<?php echo U('lists','type=2');?>">锁定</a>
                </span>
            </div>
            <div class="righter">
                <form action="<?php echo THIS_LOCAL;?>">
                    <div class="ui-form-group ui-form-group-sm">
                        <div class="ui-input-group">
							<?php if (!isempty(C(strtoupper('pathinfo'))) && C(strtoupper('url_mode'))>1) { ?><input type="hidden" name="s" value="<?php echo PATH_URL;?>" /><?php }?>
                            <?php if (C(strtoupper('url_mode'))==1) { ?>
                                <input type="hidden" name="m" value="<?php echo C('ADMIN');?>" />
                                <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>" />
                                <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>" />
                            <?php }?>
                            <input type="text" name="keyword" class="ui-form-ip radius-right-none" value="<?php echo $keyword;?>" placeholder="请输入关键字">
                            <button type="submit" class="after"><div class="ui-icon-search"></div></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form method="post" class="ui-form">
        <div class="ui-table-wrap">
    	<table class="ui-table ui-table-border ui-table-hover ui-table-striped ui-mb ui-mt">
            <thead class="ui-thead-gray">
                <tr>
                    <th width="30" height="30"><label class="ui-checkbox ui-tips" data-align="right-top" data-title="全选/取消"><input type="checkbox" class="checkall" value=""><i></i></label></th>
                    <th width="100">排序</th>
                    <th>标题</th>
                    <th width="150">栏目</th>
                    <th width="80">人气</th>
                    <th width="80">缩略图</th>
                    <th width="80">外链</th>
                    <th width="150">发布日期</th>
                    <th width="80">推荐</th>
                    <th width="80">状态</th>
                    <th width="120">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php $total_rs=$this->db->count("select count(1) from cms_show a left join cms_class b on a.classid=b.cateid  where $where ");$pagesize=20;$totalpage=ceil($total_rs/$pagesize);if($page>$totalpage){
$page=1;}$offset=($page-1)*$pagesize;$way=0;if($offset>1000 && $total_rs>2000 && $offset>$total_rs/2){	$offset=$total_rs-$offset-$pagesize;	$way=1;}if($offset<0){	$pagesize+=$offset;	$offset=0;}$key_="id";$table_="cms_show a left join cms_class b on a.classid=b.cateid";$join_="";$where_="where $where";$group_="";$order_="order by ordnum desc,id desc";$field_="*";$type_="0";$keylist=$this->db->getkeylist($key_,$table_,$join_,$where_,$order_,$offset,$pagesize,$way,$type_);$array_rs=$this->db->load("select $field_ from $table_ $join_ $keylist $group_ $order_");$pg=new cms_page($total_rs,$totalpage,$pagesize,$page);$showpage=$pg->showpage(5);if($total_rs==0){ ?>
            <tr>
                <td colspan="11">暂无资料</td>
            </tr>
            <?php } else{  $i=0;} foreach($array_rs as $rs){ $i++;?>
            <tr>
                <td><label class="ui-checkbox"><input type="checkbox" name="id" value="<?php echo $rs['id'];?>"><i></i></label></td>
                <td><input type="hidden" name="mid[]" value="<?php echo $rs['id'];?>"><input type="text" class="ui-form-ip" name="ordnum[]" id="ordnum_<?php echo $rs['id'];?>" value="<?php echo $rs['ordnum'];?>" data-rule="required;int;"></td>
                <td class="ui-text-left"><a href="<?php echo link_url($rs['id'],$rs['alias'],$rs['classid']);?>" target="_blank"><?php echo $rs['title'];?></a><?php if ($rs['isauto']==1) { ?> <span class="ui-icon-reloadtime ui-text-yellow" title="定时发布：<?php echo date('Y-m-d H:i:s',$rs['createdate']);?>"></span><?php }?></td>
                <td><a href="<?php echo U('lists','classid='.$rs['classid'].'');?>"><?php echo $rs['cate_name'];?></a></td>
                <td><?php echo $rs['hits'];?></td>
                <td><?php echo iif($rs['ispic']==1,'是','<em>否</em>');?></td>
                <td><?php echo iif($rs['isurl']==1,'是','<em>否</em>');?></td>
                <td><?php echo date('Y-m-d H:i',$rs['createdate']);?></td>
                <td><label class="ui-switch ui-switch-info"><input type="checkbox" <?php if ($rs['isnice']==1) { ?> checked<?php }?> data-url="<?php echo U('switchs','type=1&id='.$rs['id'].'');?>"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
                <td><label class="ui-switch ui-switch-info"><input type="checkbox" <?php if ($rs['isshow']==1) { ?> checked<?php }?> data-url="<?php echo U('switchs','type=2&id='.$rs['id'].'');?>"><span class="ui-switch-checkbox ui-switch-text"></span></label></td>
                <td><a href="javascript:;" class="copy" data-url="<?php echo U('copy',"id=".$rs['id']."");?>" title="复制"><span class="ui-icon-file-copy"></span></a>　<a href="<?php echo U('edit',"id=".$rs['id']."&classid=".$classid."");?>" title="编辑"><span class="ui-icon-edit"></span> </a>　<a href="javascript:;" class="del" data-url="<?php echo U('del','id='.$rs['id'].'');?>" title="删除"><span class="ui-icon-delete"></span> </a></td>
            </tr>
            <?php } if($total_rs>0){  }?>
            </tbody>
        </table>
        </div>
        <?php if ($total_rs!=0) { ?>
		<div class="ui-page ui-page-right ui-page-info">
			<div class="ui-page-other"><input type="hidden" name="token" value="<?php echo $token;?>"><button type="submit" class="ui-btn ui-btn-yellow">保存排序</button></div>
			<div class="ui-page-list"><ul><?php echo $showpage;?></ul></div>
		</div>
		<?php }?>
        </form>
    </div>
<script>
$(function()
{
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
	$(".btach").click(function()
	{
		var type=$(this).attr("type");
		var data=[];
		$(".ui-form").find("input[type=checkbox]:checked").each(function()
		{
			if($(this).attr("class")!='checkall' && !$(this).closest("label").hasClass("ui-switch"))
			{
				data.push($(this).val());
			}
		});
        if(data.length==0)
        {
            sdcms.error('至少选择一条内容');
        }
        else
        {
			if(type==99)
			{
				$.dialog(
				{
					title:"操作提示",
					text:"确定要删除？不可恢复！",
					ok:function(e)
					{
						e.close();
						$.ajax(
						{
							type:'post',
							cache:false,
							dataType:'json',
							url:'<?php echo U("btach");?>',
							data:'token=<?php echo $token;?>&id='+data.join(",")+'&type='+type,
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
			}
			else
			{
				$.ajax(
				{
					type:'post',
					cache:false,
					dataType:'json',
					url:'<?php echo U("btach");?>',
					data:'token=<?php echo $token;?>&id='+data.join(",")+'&type='+type,
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
        }
    });
	$(".move").click(function()
	{
        var type=$(this).attr("type");
		var data=[];
		$(".ui-form").find("input[type=checkbox]:checked").each(function()
		{
			if($(this).attr("class")!='checkall' && !$(this).closest("label").hasClass("ui-switch"))
			{
				data.push($(this).val());
			}
		});
        if(data.length==0)
        {
            sdcms.error('至少选择一条内容');
        }
        else
        {
			var list=data.join(",");
			$.dialogbox(
			{
				title:"批量移动",
				text:"<?php echo U('tree','token='.$token.'&classid='.$classid.'');?>",
				width:'500px',
				height:'370px',
				type:3,
				oktheme:'ui-btn-info',
				ok:function(e)
				{
					var t0=e.iframe().contents().find("#go").val();
					var token=e.iframe().contents().find("#token").val();
					if(t0=='')
                    {
                        sdcms.error('请选择目标栏目');
                        return false;
                    }
					$.ajax(
					{
                         type:'post',
                         url:'<?php echo U("move");?>',
                         dataType:'json',
                         data:'token='+token+'&id='+list+'&classid='+t0,
                         error:function(e){alert(e.responseText);},
                         success:function(d)
						 {
                            if(d.state=='success')
                            {
								e.close();
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
        }
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
                url:'<?php echo U("order","classid=".$classid."");?>',
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
    $(".copy").click(function()
	{
		var url=$(this).data("url");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要复制此内容？",
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