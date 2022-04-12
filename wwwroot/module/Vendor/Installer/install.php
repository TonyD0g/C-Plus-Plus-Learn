<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ use ModStart\Core\Util\EnvUtil; use ModStart\Core\Util\FileUtil; goto UY6MZ; oiNyt: echo base64_encode('<?xml version="1.0" encoding="UTF-8"?><svg width="100" height="100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><text x="50%" y="50%" font-size="10" fill="#EEEEEE" style="transform:rotate(-45deg);transform-origin:center;" font-family="system-ui,sans-serif" text-anchor="middle" dominant-baseline="middle">' . INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION . '</text></svg>'); goto arwey; QNC1g: echo INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION; goto EWVa8; KHtmC: echo base64_encode('<?xml version="1.0" encoding="UTF-8"?><svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><text x="50%" y="50%" font-size="16" fill="#444444" style="transform:rotate(-45deg);transform-origin:center;" font-family="system-ui,sans-serif" text-anchor="middle" dominant-baseline="middle">' . INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION . '</text></svg>'); goto x4zZ3; EWVa8: ?>
 安装助手</title>
    <style type="text/css">
        body, html {
            min-height: 100%;
        }
        body {
            background-image:url("data:image/svg+xml;base64,<?php  goto KHtmC; arwey: ?>
");
        }
        .license-content p {
            font-size: 14px;
            line-height: 1.8em;
            margin: 0;
        }
    </style>
</head>
<body style="background-color:#333;padding:40px 0;">
<div style="width:600px;min-height:100vh;margin:0 auto;">

    <?php  goto VZNr2; x4zZ3: ?>
");
        }
        .ub-panel {
            background-image:url("data:image/svg+xml;base64,<?php  goto oiNyt; D8Era: ?>
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <script src="/asset/vendor/jquery.js"></script>
    <script src="/asset/common/base.js"></script>
    <script src="/asset/layui/layui.js"></script>
    <link rel="stylesheet" href="/asset/layui/css/layui.css">
    <link rel="stylesheet" href="/asset/theme/default/style.css">
    <title><?php  goto QNC1g; UY6MZ: include __DIR__ . '/function.php'; goto D8Era; VZNr2: if (file_exists(APP_PATH . '/storage/install.lock')) { ?>
        <div class="ub-alert ub-alert-danger ub-text-center">系统无需重复安装</div>
    <?php  } else { goto yABd1; yxYxK: ?>
                <?php  goto rhZTi; ZGlGm: if (error_counter(0) > 0) { goto txaFW; TIDnK: ?>
 个问题再进行安装</div>
        <?php  goto BYzjd; txaFW: ?>
            <div class="ub-alert ub-alert-danger ub-text-center">请解决以上 <?php  goto AAT3c; AAT3c: echo error_counter(0); goto TIDnK; BYzjd: } else { if (!env_writable()) { ?>
            <div class="ub-alert ub-alert-danger ub-text-center">/.env文件不可写，请手动配置安装</div>
        <?php  } else { goto qlH3r; jUAGy: echo htmlspecialchars(get_env_config('admin_username')); goto exmow; w3pem: ?>
"/>
                        </div>
                    </div>
                </div>
                <div class="ub-panel" style="margin-top:20px;">
                    <div class="head">
                        <div class="title">
                            安装操作
                        </div>
                    </div>
                    <div class="body">
                        <?php  goto yzU7o; JJwgp: if (!empty($p1Hv_)) { goto YP7UT; vdgPH: if (!empty($p1Hv_['envs'])) { goto cEBz4; Uu3c0: foreach ($p1Hv_['envs'] as $bFIeY) { goto v_m9j; lOEQ9: ?>
" value="<?php  goto WcsAz; Xxc6D: echo $bFIeY['name']; goto lOEQ9; yXl9k: ?>
</div>
                                        <div class="field">
                                            <input class="form" type="text" name="<?php  goto Xxc6D; v_m9j: ?>
                                    <div class="line">
                                        <div class="label"><span class="ub-text-danger">*</span> <?php  goto bNSUl; okTIL: ?>
</div>
                                        </div>
                                    </div>
                                <?php  goto Oyd9_; bNSUl: echo htmlspecialchars($bFIeY['label']); goto yXl9k; uJgxw: ?>
" />
                                            <div class="help"><?php  goto e6u3f; e6u3f: echo $bFIeY['desc']; goto okTIL; WcsAz: echo htmlspecialchars($bFIeY['default']); goto uJgxw; Oyd9_: } goto vq229; cEBz4: ?>
                                <?php  goto Uu3c0; vq229: ?>
                            <?php  goto XAzv0; XAzv0: } goto CTv6P; YP7UT: ?>
                    <div class="ub-panel">
                        <div class="head">
                            <div class="title">系统配置</div>
                        </div>
                        <div class="body">
                            <?php  goto vdgPH; CTv6P: ?>
                        </div>
                    </div>
                <?php  goto BL4Cq; BL4Cq: } goto J_Y9n; M37d0: ?>
" />
                            <button type="button" onclick="doSubmit();" style="width:40%;" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php  goto NX4hg; X3gGL: ?>
"/>
                        </div>
                    </div>
                </div>
                <?php  goto JJwgp; ar5b3: echo htmlspecialchars(json_encode(isset($p1Hv_) ? $p1Hv_ : null)); goto M37d0; qlH3r: ?>
            <div style="display:none;" class="ub-form ub-form-stacked">
                <div class="ub-panel" style="background:#FFF;">
                    <div class="head">
                        <div class="title">MySQL数据库信息</div>
                    </div>
                    <div class="body">
                        <div class="line">
                            <label class="label"><span class="ub-text-danger">*</span> 主机</label>
                            <input type="text" style="width:100%;" name="db_host"
                                   value="<?php  goto VFl24; wW9Ek: ?>
"/>
                        </div>
                        <div class="line">
                            <label class="label"><span class="ub-text-danger">*</span> 用户名</label>
                            <input type="text" style="width:100%;" name="db_username"
                                   value="<?php  goto sMIDD; NBeJp: ?>
"/>
                        </div>
                        <div class="line">
                            <label class="label"><span class="ub-text-danger">*</span> 数据库名</label>
                            <input type="text" style="width:100%;" name="db_database"
                                   value="<?php  goto GvXx0; Z3nRL: ?>
                        <div style="text-align:center;">
                            <input type="hidden" name="INSTALL_CONFIG" value="<?php  goto ar5b3; sMIDD: echo htmlspecialchars(get_env_config('db_username')); goto h5ogn; BNruZ: echo htmlspecialchars(get_env_config('db_password')); goto NOxFs; J_Y9n: ?>
                <div class="ub-panel">
                    <div class="head">
                        <div class="title">管理信息</div>
                    </div>
                    <div class="body">
                        <div class="line">
                            <label class="label"><span class="ub-text-danger">*</span> 用户</label>
                            <input type="text" style="width:100%;" name="username"
                                   value="<?php  goto jUAGy; y2DGY: echo htmlspecialchars(get_env_config('db_prefix')); goto X3gGL; xF7_D: echo htmlspecialchars(get_env_config('admin_password')); goto w3pem; yzU7o: if (defined('DEMO_DATA') || defined('LICENSE_URL')) { goto rz61v; xCIHw: if (defined('DEMO_DATA')) { ?>
                                        <div>
                                            <label style="border:none;margin-top:-10px;">
                                                <input type="checkbox" name="installDemo" value="1"/>
                                                安装演示数据
                                            </label>
                                        </div>
                                    <?php  } goto O0YwN; rz61v: ?>
                            <div class="line">
                                <div class="field">
                                    <?php  goto xCIHw; O0YwN: ?>
                                    <?php  goto eeul4; uxpAw: ?>
                                </div>
                            </div>
                        <?php  goto bR9u9; eeul4: if (defined('LICENSE_URL')) { goto masrf; masrf: ?>
                                        <div>
                                            <label style="border:none;margin-top:-10px;margin-right:0;padding-right:0;">
                                                <input type="checkbox" name="installLicense" value="1"/>
                                                同意
                                            </label>
                                            <a href="<?php  goto rcbZ2; UGGWD: ?>
" target="_blank">《软件安装许可协议》</a>
                                        </div>
                                    <?php  goto SUB6r; rcbZ2: echo LICENSE_URL; goto UGGWD; SUB6r: } goto uxpAw; bR9u9: } goto Z3nRL; NOxFs: ?>
"/>
                        </div>
                        <div class="line">
                            <label class="label">数据表前缀</label>
                            <input type="text" style="width:100%;" name="db_prefix"
                                   value="<?php  goto y2DGY; exmow: ?>
"/>
                        </div>
                        <div class="line">
                            <label class="label"><span class="ub-text-danger">*</span> 密码</label>
                            <input type="text" style="width:100%;" name="password"
                                   placeholder="<?php  goto xF7_D; GvXx0: echo htmlspecialchars(get_env_config('db_name')); goto wW9Ek; h5ogn: ?>
"/>
                        </div>
                        <div class="line">
                            <label class="label"><span class="ub-text-danger">*</span> 密码</label>
                            <input type="text" style="width:100%;" name="db_password"
                                   value="<?php  goto BNruZ; VFl24: echo htmlspecialchars(get_env_config('db_host')); goto NBeJp; NX4hg: } } goto JEaKp; wDS_v: function_exists('exif_read_data') ? text_success('Exif PHP 扩展') : text_error('缺少 Exif PHP 扩展'); goto FA01G; im0i4: is_dir_really_writable(APP_PATH . '/bootstrap/') ? text_success('/bootstrap/目录可写') : text_error('/bootstrap/目录不可写'); goto ws9Nn; iz0cL: is_dir_really_writable(APP_PATH . '/public/') ? text_success('/public/目录可写') : text_error('/public/目录不可写'); goto iP3TI; PIqGM: class_exists('pdo') ? text_success('PDO PHP 扩展') : text_error('缺少 PDO PHP 扩展'); goto JAzGQ; ZBZaI: function_exists('proc_open') ? text_success('proc_open 函数') : text_error('缺少 proc_open 函数'); goto x_bKE; ZYWDw: function_exists('mb_internal_encoding') ? text_success('缺少 Mbstring PHP 扩展') : text_error('Mbstring PHP 扩展'); goto yxYxK; JEaKp: ?>
    <?php  goto MKgSR; W8MGB: ?>
                <?php  goto PIqGM; ex4bz: ?>
                <?php  goto Z20P_; cgYqa: ?>
                <?php  goto MSg66; pQ4vt: ?>
                <div data-rewrite-check>
                    <div class="status loading"><div class="ub-alert">Rewrite规则检测中...</div></div>
                    <div class="status success" style="display:none;"><?php  goto osMlo; x_bKE: ?>
                <?php  goto Ri_Lr; CEZ0n: ?>
</div>
                    <div class="status error" style="display:none;"><?php  goto hqzWT; wXNHA: echo INSTALL_APP_NAME . ' V' . INSTALL_APP_VERSION; goto K7PEf; e072F: function_exists('bcmul') ? text_success('bcmath 扩展') : text_error('缺少 PHP bcmath 扩展'); goto W8MGB; RAAmX: class_exists('pdo') && in_array('mysql', PDO::getAvailableDrivers()) ? text_success('PDO Mysql 驱动正常') : text_error('缺少 PDO Mysql 驱动'); goto ri2it; yABd1: ?>
        <h1 class="ub-text-center" style="color:#FFF;">
            <?php  goto wXNHA; JAzGQ: ?>
                <?php  goto RAAmX; ri2it: ?>
                <?php  goto ZYWDw; Ri_Lr: function_exists('putenv') ? text_success('putenv 函数') : text_error('缺少 putenv 函数'); goto oHzcf; ea_gv: function_exists('proc_get_status') ? text_success('proc_get_status 函数') : text_error('缺少 proc_get_status 函数'); goto MMyv1; MSg66: function_exists('finfo_file') ? text_success('缺少 PHP Fileinfo 扩展') : text_error('PHP Fileinfo 扩展'); goto rZqJN; rZqJN: ?>
                <?php  goto Wnncx; rhZTi: function_exists('token_get_all') ? text_success('缺少 Tokenizer PHP 扩展') : text_error('Tokenizer PHP 扩展'); goto cgYqa; Wnncx: if (version_compare(PHP_VERSION, '5.6.0', 'ge') && version_compare(PHP_VERSION, '5.7.0', 'lt')) { goto ObM3D; EOUxk: ?>
                <?php  goto ayhxl; mdgxZ: EnvUtil::iniFileConfig('always_populate_raw_post_data') == '-1' ? text_success('验证 always_populate_raw_post_data=-1') : text_error('请配置 always_populate_raw_post_data=-1'); goto EOUxk; ObM3D: ?>
                <?php  goto mdgxZ; ayhxl: } goto ioOKZ; MMyv1: ?>
                <?php  goto e072F; Y30NG: ?>
                <?php  goto bhjdn; YT59q: ?>
                <?php  goto iz0cL; oHzcf: ?>
                <?php  goto ea_gv; bhjdn: text_success('最大上传：' . FileUtil::formatByte(EnvUtil::env('uploadMaxSize'))); goto ex4bz; iQjsA: is_dir_really_writable(APP_PATH . '/bootstrap/cache/') ? text_success('/bootstrap/cache/目录可写') : text_error('/bootstrap/cache/目录不可写'); goto pQ4vt; osMlo: text_success('Rewrite规则正确'); goto CEZ0n; ws9Nn: ?>
                <?php  goto R2waW; FA01G: ?>
                <?php  goto ZBZaI; ioOKZ: ?>
                <?php  goto im0i4; MSpTj: php_version_ok() ? text_success('PHP版本 ' . PHP_VERSION) : text_error('PHP版本要求（' . php_version_requires() . '） 当前为 ' . PHP_VERSION); goto Y30NG; Z20P_: function_exists('openssl_open') ? text_success('OpenSSL PHP 扩展') : text_error('缺少 OpenSSL PHP 扩展'); goto UVNEU; R2waW: is_dir_really_writable(APP_PATH . '/storage/') ? text_success('/storage/目录可写') : text_error('/storage/目录不可写'); goto YT59q; Stb10: ?>
                <?php  goto MSpTj; K7PEf: ?>
 安装助手
        </h1>
        <div class="ub-panel">
            <div class="head">
                <div class="title">环境检查</div>
            </div>
            <div class="body">
                <?php  goto S4C6L; iP3TI: ?>
                <?php  goto iQjsA; UVNEU: ?>
                <?php  goto wDS_v; hqzWT: text_error('Rewrite规则错误', 'https://modstart.com/doc/install/qa.html#q-rewrite%E8%A7%84%E5%88%99', false); goto sXrin; sXrin: ?>
</div>
                    <div class="status error ub-alert ub-alert-warning" style="display:none;">
                        <div>- 配置Nginx/Apache，保证访问 <a href="/install/ping" target="_blank">/install/ping</a> 出现 ok 字样。</div>
                    </div>
                </div>
            </div>
        </div>
        <?php  goto ZGlGm; S4C6L: text_success('系统：' . PHP_OS); goto Stb10; MKgSR: } goto sAI04; sAI04: ?>
</div>
<script>
    $(function () {
        var $rewriteCheck = $('[data-rewrite-check]');
        $.ajax({
            url: '/install/ping',
            type: 'GET',
            success: function(data){
                if('ok'===data){
                    $rewriteCheck.find('.status').hide().filter('.success').show();
                    $('.ub-form').show();
                }else{
                    $rewriteCheck.find('.status').hide().filter('.error').show();
                }
            },
            error: function(data) {
                $rewriteCheck.find('.status').hide().filter('.error').show();
            }
        });
        window.doSubmit = function(){
            var data = {};
            var $form = $('.ub-form');
            $form.find('input[type=text],input[type=hidden]').each(function(i,o){
                data[$(o).attr('name')] = $(o).val();
            });
            $form.find('input[type=checkbox]:checked').each(function(i,o){
                data[$(o).attr('name')] = $(o).val();
            });
            window.api.dialog.loadingOn('正在提交表单..');
            window.api.base.post('/install/prepare',data,function(res){
                window.api.dialog.loadingOff();
                window.api.base.defaultFormCallback(res, {
                    success: function (res) {
                        window.api.dialog.loadingOn('正在安装系统，可能需要较长时间，请耐心等待...');
                        window.api.base.post('/install/execute',data,function(res){
                            window.api.dialog.loadingOff();
                            window.api.base.defaultFormCallback(res);
                        });
                    }
                })
            });
            return false;
        };
    });
</script>
</body>
</html>