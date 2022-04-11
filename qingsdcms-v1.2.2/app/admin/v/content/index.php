<?php if(!defined('IN_CMS')) exit;?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<title>管理页面</title>
<link rel="stylesheet" href="{WEB_ROOT}public/css/ui.css">
<link rel="stylesheet" href="{WEB_ROOT}public/admin/css/iframe.css">
<link rel="stylesheet" href="{WEB_ROOT}public/ztree/css/zTreeStyle.css">
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/admin/js/jquery-ui.js"></script>
<script src="{WEB_ROOT}public/admin/js/jquery.layout.js"></script>
<script src="{WEB_ROOT}public/ztree/jquery.ztree.core-3.5.min.js"></script>
<script>
var myLayout;
$(function()
{ 
	myLayout=$("body").layout(
	{
		closable:					true,
		resizable:					true,
		maskContents:               true,
		north__spacing_open:		0,
		south__spacing_open:		0,
		west__minSize:				200,
		west__maxSize:				500,
		west__slidable:	            false,
		west__animatePaneSizing:	false,
		west__fxSpeed_size:			"slow",
		west__fxSpeed_open:			1000,
		west__fxSettings_open:		{easing:"easeOutBounce"},
		west__fxName_close:			"none",
		stateManagement__enabled:	false,
		showDebugMessages:			false 
	}); 
	{if ismobile()}myLayout.toggle("west");{/if}  
});

var zNodes=[{$str}]
var setting={view:{dblClickExpand:false,showLine:true},data:{simpleData:{enable:true}},callback:{beforeExpand:beforeExpand,onExpand:onExpand,onClick:onClick}};
var curExpandNode=null;
function beforeExpand(treeId,treeNode)
{
	var pNode=curExpandNode?curExpandNode.getParentNode():null;
	var treeNodeP=treeNode.parentTId?treeNode.getParentNode():null;
	var zTree=$.fn.zTree.getZTreeObj("tree");
	for(var i=0,l=!treeNodeP?0:treeNodeP.children.length;i<l;i++)
	{
		if(treeNode!==treeNodeP.children[i])
		{
			zTree.expandNode(treeNodeP.children[i],false);
		}
	};
	while(pNode)
	{
		if(pNode===treeNode){break;}
		pNode=pNode.getParentNode();
	};
	if(!pNode)
	{
		singlePath(treeNode);
	}
};
function singlePath(newNode)
{
	if(newNode===curExpandNode) return;
	if(curExpandNode && curExpandNode.open==true)
	{
		var zTree=$.fn.zTree.getZTreeObj("tree");
		if (newNode.parentTId===curExpandNode.parentTId)
		{
			zTree.expandNode(curExpandNode,false);
		}
		else
		{
			var newParents=[];
			while(newNode)
			{
				newNode=newNode.getParentNode();
				if(newNode===curExpandNode)
				{
					newParents=null;
					break;
				}
				else if(newNode)
				{
					newParents.push(newNode);
				}
			}
			if (newParents!=null)
			{
				var oldNode=curExpandNode;
				var oldParents=[];
				while(oldNode)
				{
					oldNode=oldNode.getParentNode();
					if(oldNode)
					{
						oldParents.push(oldNode);
					}
				}
				if(newParents.length>0)
				{
					zTree.expandNode(oldParents[Math.abs(oldParents.length-newParents.length)-1],false);
				}
				else
				{
					zTree.expandNode(oldParents[oldParents.length-1],false);
				}
			}
		}
	}
	curExpandNode = newNode;
};
function onExpand(event,treeId,treeNode)
{
	curExpandNode=treeNode;
};
function onClick(e,treeId,treeNode)
{
	var zTree=$.fn.zTree.getZTreeObj("tree");
	zTree.expandNode(treeNode,null,null,null,true);
};
$(function()
{
	$.fn.zTree.init($("#tree"),setting,zNodes);
});
</script>
</head>
<body>
<div class="ui-layout-west"><div id="tree" class="ztree"></div></div>
<div class="ui-layout-center"><iframe name="content_body" id="content_body" src="{U('lists')}" width="100%" height="100%" frameborder="0"></iframe></div>
</body>
</html>