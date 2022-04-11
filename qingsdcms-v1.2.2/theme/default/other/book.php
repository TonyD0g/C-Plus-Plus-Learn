<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}

    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color ui-mb-30">
                    <div class="ui-menu-name">{$page_name}</div>
                </div>
                <!--留言列表部分开始-->
                {include file="include/book/list.php"}
                <!--留言列表部分结束-->
                
				<!--留言提交部分开始-->
                {include file="include/book/form.php"}
				<!--留言提交部分结束-->
            </div>
        </div>
        <!--左侧结束-->
        
        <!--右侧开始-->
        <div class="container-right">
            {include file="include/right.php"}
        </div>
        <!--右侧结束-->
    </div>

	{include file="include/foot.php"}
</body>
</html>