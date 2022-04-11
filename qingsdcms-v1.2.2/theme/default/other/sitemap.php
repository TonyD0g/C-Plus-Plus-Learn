<?php if(!defined('IN_CMS')) exit;?>{include file="include/head.php"}

	{include file="include/bread.php"}
    
    <div class="container width ui-mt-20">
    	<!--左侧开始-->
    	<div class="container-left">
        	<div class="box">
            	<div class="ui-menu ui-menu-color">
                    <div class="ui-menu-name">{$page_name}</div>
                </div>
                <div class="ui-pt-20">
                	<!--网站地图开始-->
                    <div class="ui-timeline">
                        {cms:rp top="0" table="cms_class" where="followid=0 and ismenu=1" order="cate_order,cateid"}
                        {php $map_sonid=$rp[cateid]}
                        <div class="ui-timeline-item">
                            <div class="ui-timeline-dot"></div>
                            <div class="ui-timeline-title"><a href="{cateurl($rp[cateid])}" title="{$rp[cate_name]}" target="_blank">{$rp[cate_name]}</a></div>
                            <div class="ui-timeline-text">
                                {cms:rs top="0" table="cms_class" where="followid=$map_sonid and ismenu=1" order="cate_order,cateid"}
                                <a href="{cateurl($rs[cateid])}" title="{$rs[cate_name]}" target="_blank" class="ui-btn ui-mr ui-mb">{$rs[cate_name]}</a>
                                {/cms:rs}
                            </div>
                        </div>
                        {/cms:rp}
                    </div>
                    <!--网站地图结束-->
                </div>
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