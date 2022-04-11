<?php if(!defined('IN_CMS')) exit;?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>错误提示</title>
    <style>
       *{margin:0;padding:0}
       html{font-size:10px;display:flex;justify-content:center;align-items:center;height:100%;}
       body{font-family:Microsoft YaHei;background:#f0f1f3;font-size:1.4rem;display:flex;justify-content:center;align-items:center;height:100%;}
	   a{color:#428bca;text-decoration:none}
	   a:hover{text-decoration:underline}
	   .page-main{background:#f9f9f9;margin:0 auto;min-width:520px;padding:50px;box-shadow:0 10px 30px 0 #ccc}
	   .page-main h1{font-size:2.4rem;font-weight:400;border-bottom:1px solid #ddd;padding-bottom:20px;}
	   .page-actions{font-size:0;z-index:100}
	   .page-actions div{font-size:16px;display:block;padding:30px 0 0 0;box-sizing:border-box;color:#333}
	   .page-actions b{color:#f30;}
	   .page-actions .go{color:#999;font-size:14px;}
	   @media screen and (max-width:640px){
		   .page-main{min-width:96%;max-width:96%;padding:30px;}
           .page-main h1{font-size:2rem;}
		}
    </style>
</head>
<body>

    <div class="page-main">
        <h1>抱歉，出错啦！</h1>
        <div class="page-actions">
            <div><?php echo $e['msg'];?></div>
            <div class="go">
                <b id="wait">10</b> 后页面自动跳转　<a id="href" href="<?php echo $e['url'];?>">立即跳转</a>
            </div>
        </div>
    </div>

<script>
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
    var time = --wait.innerHTML;
    if(time <= 0)
    {
        location.href = href;
        clearInterval(interval);
    };
}, 1000);
})();
</script>
</body>
</html>