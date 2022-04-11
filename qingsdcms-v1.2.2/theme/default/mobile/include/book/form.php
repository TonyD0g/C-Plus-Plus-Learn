<?php if(!defined('IN_CMS')) exit;?><form class="ui-form-book ui-mt-30" method="post" action="{N('book')}" data-backurl="{THIS_LOCAL}">
{if cms[state_name]==1}
<div class="ui-form-group">
	<input type="text" name="name" maxlength="10" class="ui-form-ip" placeholder="请输入姓名" data-rule="姓名:required;">
</div>
{/if}
{if cms[state_mobile]==1}
<div class="ui-form-group">
	<input type="text" name="mobile" maxlength="11" class="ui-form-ip" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;">
</div>
{/if}
{if cms[state_email]==1}
<div class="ui-form-group">
	<input type="text" name="email" maxlength="50" class="ui-form-ip" placeholder="请输入邮箱" data-rule="邮箱:required;email;">
</div>
{/if}
{if cms[state_qq]==1}
<div class="ui-form-group">
	<input type="text" name="qq" maxlength="20" class="ui-form-ip" placeholder="请输入QQ号码" data-rule="QQ:required;qq;">
</div>
{/if}
{if cms[state_message]==1}
<div class="ui-form-group">
    <textarea name="message" class="ui-form-ip ui-form-limit" data-max="255" rows="4" placeholder="请输入留言内容" data-rule="留言内容:required;"></textarea>
    <div class="ui-form-limit-text"><span>0</span>/255</div>
</div>
{/if}
{if cms[state_code]==1}
<div class="ui-form-group">
    <div class="ui-input-group">
        <input type="text" name="code" id="code" class="ui-form-ip radius-right-none" placeholder="请输入验证码" data-rule="验证码:required;">
        <div class="code"><img src="{U('other/code')}" height="40" id="verify_code" title="点击更换验证码"></div>
    </div>
</div>
{/if}
<div class="ui-form-group">
    <input type="hidden" name="token" value="{$token}">
    <input type="submit" class="ui-btn ui-btn-blue ui-btn-block" value="提交">
</div>
</form>