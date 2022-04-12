@extends('modstart::admin.frame')

@section('pageTitle')手动升级@endsection

@section('bodyContent')
    <div class="ub-alert ub-alert-warning">
        <i class="iconfont icon-warning"></i>
        升级前请您确定已经完成系统的备份（文件和数据库）
    </div>
    <div class="ub-panel">
        <div class="head">
            <div class="title">
                手动升级
            </div>
        </div>
        <div class="body">
            <form action="{{\ModStart\Core\Input\Request::currentPageUrl()}}" data-ajax-form method="post">
                <div class="ub-form">
                    <div class="line">
                        <div class="label">
                            当前版本：
                        </div>
                        <div class="field">
                            v{{\App\Constant\AppConstant::VERSION}}
                        </div>
                    </div>
                    <div class="line">
                        <div class="label">差量升级包：</div>
                        <div class="field">
                            <div data-file-filename></div>
                            <input type="hidden" name="upgradeZip" value="" />
                            <div data-file-uploader style="max-width:10em;"></div>
                            <div class="help">
                                请上传后缀名为zip的差量升级包，错误的升级包将导致您的系统不可用。
                            </div>
                        </div>
                    </div>
                    <div class="line tw-hidden" data-submit-box>
                        <div class="field">
                            <button type="submit" class="btn btn-primary">
                                开始升级
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('adminPageMenu')
    <a href="{{modstart_admin_url('')}}">
        系统概况
    </a>
    <a href="javascript:;" class="active">
        手动升级
    </a>
@endsection

{!! \ModStart\ModStart::js('asset/common/uploadButton.js') !!}
@section('bodyAppend')
    @parent
    <script>
        $(function () {
            window.api.uploadButton('[data-file-uploader]', {
                text: '<div style="line-height:1.5rem;height:1.5rem;padding:0 1rem;font-size:12px;background:#EEE;color:#999;"><span class="iconfont icon-plus" style="display:inline;line-height:1.5rem;height:1.5rem;"></span> 上传ZIP文件</div>',
                server: window.__selectorDialogServer + '/file',
                extensions: window.__dataConfig.category.file.extensions,
                sizeLimit: 1024 * 1024 * 2014,
                chunkSize: window.__dataConfig.chunkSize,
                callback: function (file, me) {
                    console.log('file',file);
                    $('[data-file-filename]').html(file.name);
                    $('[name="upgradeZip"]').val(file.path);
                    $('[data-submit-box]').show();
                },
                start:function(){
                    window.api.dialog.loadingOn('正在上传');
                },
                finish: function () {
                    window.api.dialog.loadingOff();
                    window.api.dialog.tipSuccess('上传完成');
                }
            });
        })
    </script>
@endsection
