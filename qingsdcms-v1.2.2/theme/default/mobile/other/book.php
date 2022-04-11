<?php if(!defined('IN_CMS')) exit;?>{include file="mobile/include/head.php"}

    <div class="ui-mwidth box">
        <div class="ui-menu ui-menu-color ui-mb-30">
            <div class="ui-menu-name">{$page_name}</div>
        </div>
        <!--留言列表部分开始-->
        {include file="mobile/include/book/list.php"}
        <!--留言列表部分结束-->
        
        <!--留言提交部分开始-->
        {include file="mobile/include/book/form.php"}
        <!--留言提交部分结束-->
    </div>

	{include file="mobile/include/foot.php"}
</body>
</html>