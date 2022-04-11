<?php if(!defined('IN_CMS')) exit;?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $close_title;?></title>
    <style>
       *{margin:0;padding:0}
	   html{font-size:10px;display:flex;justify-content:center;align-items:center;height:100%;}
	   body{font-family:Microsoft YaHei;background:#f0f1f3;font-size:1.4rem;display:flex;justify-content:center;align-items:center;height:100%;}
	   .page-main{background:#f9f9f9;margin:0 auto;min-width:520px;padding:50px;box-shadow:0 10px 30px 0 #ccc}
	   .page-main h1{font-size:2.2rem;font-weight:400;border-bottom:1px solid #ddd;padding-bottom:20px;}
	   .page-text{font-size:15px;display:block;padding:20px 0 0 0px;box-sizing:border-box;color:#888;min-height:40px;}
	   @media screen and (max-width:640px){
		   .page-main{min-width:70%;max-width:96%;padding:30px;}
           .page-main h1{font-size:1.8rem;}
		}
    </style>
</head>
<body>

    <div class="page-main">
        <h1><?php echo $close_title;?></h1>
        <div class="page-text">
            <?php echo $close_why;?>
        </div>
    </div>


</body>
</html>