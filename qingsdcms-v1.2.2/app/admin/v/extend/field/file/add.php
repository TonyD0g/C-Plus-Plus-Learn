<?php if(!defined('IN_CMS')) exit;?>
{foreach $field as $rs}
<div class="ui-form-group ui-row"{if $rs['field_type']==7} style="display:none;"{/if}>
    <label class="col-left ui-col-form-label">{$rs['field_title']}：</label>
    <div class="col-right {if in_array($rs['field_type'],[12,13,15])}col-right-full{/if}{if $rs['field_type']==9} col-form-label{/if}">
        {switch $rs['field_type']}
        {case 1}
        <input type="text" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}" {deal_rule($rs['field_rule'],$rs['field_title'])}>
        {/case}
        {case 2}<input type="text" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip datepick"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}" {deal_rule($rs['field_rule'],$rs['field_title'])}>{/case}
        {case 3}<input type="text" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}" {deal_rule($rs['field_rule'],$rs['field_title'])}>{/case}
        {case 4}<input type="text" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}" {deal_rule($rs['field_rule'],$rs['field_title'])}>{/case}
        {case 5}
        <div class="ui-input-group">
        <input type="text" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip radius-right-none"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}" {deal_rule($rs['field_rule'],$rs['field_title'])}>
        <a class="after fm-choose ui-icon-cloud-upload radius-none" data-name="{$rs['field_key']}" data-url="{U('upload/imageupload','type='.$rs['field_upload_type'].'&multiple=0&islocal=1')}" data-type="{$rs['field_upload_type']}" data-multiple="0" title="上传">上传</a>
        <a class="after fm-choose ui-icon-select radius-none" data-name="{$rs['field_key']}" data-url="{U('upload/imagelist','type='.$rs['field_upload_type'].'&multiple=0&islocal=1')}" data-type="{$rs['field_upload_type']}" data-multiple="0" title="选择">选择</a>
        <a class="after ui-lightbox ui-icon-zoomin" data-id="{$rs['field_key']}"{if $rs['field_upload_type']==2} data-mode="video"{/if} data-name="ui-lightbox-pic" title="{$rs['field_title']}">预览</a>
        </div>
        {/case}
        {case 6}<input type="password" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}" {deal_rule($rs['field_rule'],$rs['field_title'])}>{/case}
        {case 7}<input type="text" name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip"{if $rs['field_length']!=0} maxlength="{$rs['field_length']}"{/if} value="{deal_default($rs['field_default'])}">{/case}
        {case 8}<textarea name="{$rs['field_key']}" class="ui-form-ip" id="{$rs['field_key']}" rows="3" cols="50" {deal_rule($rs['field_rule'],$rs['field_title'])}>{deal_default($rs['field_default'])}</textarea>{/case}
        {case 9}
            {php $arr=explode(",",$rs['field_list'])}
            {foreach $arr as $j=>$key}
            {php $data=explode("|",$key)}
                {if $rs['field_radio']==2}<div class="ui-input-group-check">{/if}
                <label class="ui-radio"><input type="radio" name="{$rs['field_key']}" value="{$data[1]}" {deal_rule($rs['field_rule'],$rs['field_title'],1)} {if $rs['field_default']=="".$data[1].""} checked{/if}><i></i>{$data[0]}</label>
                 {if $rs['field_radio']==2}</div>{/if}
            {/foreach}
        {/case}
        {case 10}
        {php $arr=explode(",",$rs['field_list'])}
        {foreach $arr as $j=>$key}
        {php $data=explode("|",$key)}
        <label class="ui-checkbox"><input type="checkbox" name="{$rs['field_key']}[]"  value="{$data[1]}" {deal_rule($rs['field_rule'],$rs['field_title'],1)} {if stristr(",".$rs['field_default'].",",",".$data[1].",")} checked{/if}><i></i>{$data[0]}</label>
        {/foreach}
        {/case}
        {case 11}
        <select name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip" {deal_rule($rs['field_rule'],$rs['field_title'])}>
        <option value="">请选择{$rs['field_title']}</option>
        {php $arr=explode(",",$rs['field_list'])}
        {foreach $arr as $j=>$key}
        {php $data=explode("|",$key)}
        <option value="{$data[1]}" {if $rs['field_default']=="".$data[1].""} selected{/if}>{$data[0]}</option>
        {/foreach}
        </select>
        {/case}
        {case 12}<script id="{$rs['field_key']}" name="{$rs['field_key']}" type="text/plain" style="height:260px;"></script>
        <script>UE.getEditor('{$rs['field_key']}',{serverUrl:'{U('upload/index')}'{if $rs['field_editor']==1},toolbars:editorOption{/if}});</script>
        {/case}
        {case 13}
        <div class="ui-btn-group mt-sm">
            <a class="ui-btn-group-item fm-choose ui-icon-cloud-upload" data-name="{$rs['field_key']}" data-url="{U('upload/imageupload','type=3&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'')}" data-type="{$rs['field_upload_type']}" data-multiple="1" title="上传">上传</a>
            <a class="ui-btn-group-item fm-choose ui-icon-select" data-name="{$rs['field_key']}" data-url="{U('upload/imagelist','type=1&multiple=1&thumb='.C('thumb_piclist').'&water='.C('water_piclist').'')}" data-type="{$rs['field_upload_type']}" data-multiple="1" title="选择">选择</a>
        </div>
        <div class="imagelist">
            <ul id="list_{$rs['field_key']}"></ul>
        </div>
        {/case}
        {case 14}
        <select name="{$rs['field_key']}" id="{$rs['field_key']}" class="ui-form-ip" {deal_rule($rs['field_rule'],$rs['field_title'])}>
        {php $table=$rs['field_table']}
        {php $join=$rs['field_join']}
        {php $where=$rs['field_where']}
        {php $order=$rs['field_order']}
        {php $value=$rs['field_value']}
        {php $label=$rs['field_label']}
        {php $default=$rs['field_default']}
        {if $where==''}
        {php $where='1=1'}
        {/if}
        {if $order==''}
        {php $order="$value desc"}
        {/if}
        <option value="">请选择{$rs['field_title']}</option>
        {cms:ra top="0" table="$table" join="$join" where="$where" order="$order"}
        <option value="{$ra['.$value.']}"{if $default==$ra['.$value.']} selected{/if}>{$ra['.$label.']}</option>
        {/cms:ra}
        </select>
        {/case}
        {case 15}
        <div class="ui-btn-group mt-sm">
            <a class="ui-btn-group-item ui-icon-plus downlistadd" data-name="{$rs['field_key']}">添加</a>
            <a class="ui-btn-group-item fm-choose ui-icon-cloud-upload" data-name="{$rs['field_key']}" data-url="{U('upload/imageupload','type='.$rs['field_upload_type'].'&multiple=1&iseditor='.C('water_piclist').'')}" data-type="{$rs['field_upload_type']}" data-multiple="2" title="上传">上传</a>
            <a class="ui-btn-group-item fm-choose ui-icon-select" data-name="{$rs['field_key']}" data-url="{U('upload/imagelist','type='.$rs['field_upload_type'].'&multiple=1&iseditor='.C('water_piclist').'')}" data-type="{$rs['field_upload_type']}" data-multiple="2" title="选择">选择</a>
        </div>
        <table class="ui-table ui-table-border ui-mt ui-w-auto">
            <thead class="ui-thead-gray">
                <tr>
                    <th width="150">名称</th>
                    <th width="400">下载地址</th>
                    <th width="200">操作</th>
                </tr>
            </thead>
            <tbody id="downlist_{$rs['field_key']}"></tbody>
        </table>
        <div class="downlist">
            <ul id="list_{$rs['field_key']}"></ul>
        </div>
        {/case}
        {/switch}
        {if $rs['field_tips']<>''}<span class="input-tips">{$rs['field_tips']}</span>{/if}
    </div>
</div>
{/foreach}