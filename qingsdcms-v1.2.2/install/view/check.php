<?php defined('IN_CMS') or die();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<title>轻站在线安装程序_环境检测</title>
<link rel="stylesheet" href="../public/css/ui.css">
<link rel="stylesheet" href="css/app.css">
<script src="../public/js/jquery.js"></script>
<script src="../public/js/base.js"></script>
<script src="../public/js/ui.js"></script>
</head>

<body>

    <div class="width inner_container">
        <div class="install">
            <div id="step"></div>
            <div class="subject">
                <b>服务器环境</b>
            </div>
            <table class="ui-table ui-table-border ui-table-hover ui-mb-20">
                <thead class="ui-thead-gray">
                    <tr>
                        <th>项目名称</th>
                        <th width="20%">结果</th>
                        <th width="20%">帮助</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach($data as $key=>$rs) { ?>
                    <tr>
                        <td class="ui-text-left"><?php echo $key;?></td>
                        <td><?php echo $rs['result'];?></td>
                        <td><?php echo $rs['help'];?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="subject">
                <b>目录权限</b>
            </div>
            <table class="ui-table ui-table-border ui-table-hover">
                <thead class="ui-thead-gray">
                    <tr>
                        <th>项目名称</th>
                        <th width="20%">结果</th>
                        <th width="20%">帮助</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($file as $key=>$rs) { ?>
                    <tr>
                    	<td class="ui-text-left"><?php echo $key;?></td>
                        <td><?php echo $rs['result'];?></td>
                        <td><?php echo $rs['help'];?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div class="ui-text-center ui-mt-30"><button class="ui-btn ui-mr" onClick="location.href='./'">上一步</button><button class="ui-btn ui-btn-blue" onClick="location.href='?act=config'" <?php if (!$result) { ?>disabled<?php }?>><?php if (!$result) { ?>请检查不符合的项目<?php } else { ?>下一步<?php }?></button></div>
        </div>
        
    </div>
    
    
    <!--[if lt IE 9]>
    <div class="notsupport">
        <h1>:( 非常遗憾</h1>
        <h2>您的浏览器版本太低，请升级您的浏览器</h2>
    </div>
    <![endif]-->
    <script>
    $(function()
    {
        $("#step").step({data:['安装协议','环境检测','参数配置','安装结果'],index:2});
    })
    </script>
</body>
</html>