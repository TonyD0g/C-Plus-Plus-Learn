@if(!defined('__CONFIG_COPYRIGHT_HIDE__'))
    {!! \ModStart\ModStart::js('vendor/Tecmz/entry/versionCheck.js') !!}
    <div class="row">
        <div class="col-md-6">
            <div class="ub-panel">
                <div class="head">
                    <div class="title">应用概况</div>
                </div>
                <div class="body">
                    <div class="tw-py-1">
                        <span class="tw-font-mono">{{strtoupper(\App\Constant\AppConstant::APP)}}</span> <span class="tw-font-mono">V{{\App\Constant\AppConstant::VERSION}}</span>
                    </div>
                    <div class="tw-py-1" style="height:27px;" data-admin-type="{{\App\Constant\AppConstant::APP}}" data-admin-version="{{\App\Constant\AppConstant::VERSION}}">
                        <span class="ub-text-muted">正在检测最新版本...</span>
                    </div>
                    <div class="tw-py-1" style="height:27px;" data-admin-auth></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="ub-panel">
                <div class="head">
                    <div class="title">版权说明</div>
                </div>
                <div class="body">
                    <div class="tw-py-1">
                        使用遇到问题请
                        <a href="javascript:;" data-dialog-title="在线问题反馈"
                           data-dialog-request="https://tecmz.com/product/{{\App\Constant\AppConstant::APP}}/feedback/dialog?version={{\App\Constant\AppConstant::VERSION}}">
                            <i class="iconfont icon-comment"></i>
                            反馈给我们
                        </a>，如需定制请
                        <a href="https://www.tecmz.com/product/{{\App\Constant\AppConstant::APP}}"
                           target="_blank"><i class="iconfont icon-phone"></i> 联系我们</a>
                    </div>
                    <div class="tw-py-1">
                        请您在使用过程中始终保留版权，如需商业使用请联系我们 <a
                                href="https://tecmz.com/product/{{\App\Constant\AppConstant::APP}}"
                                target="_blank">
                            <i class="iconfont icon-sign"></i>
                            商业授权
                        </a>
                    </div>
                    <div class="tw-py-1 lg:tw-block tw-hidden">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
