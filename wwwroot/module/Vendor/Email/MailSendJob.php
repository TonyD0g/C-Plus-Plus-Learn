<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Email; use Illuminate\Support\Facades\View; use ModStart\Core\Exception\BizException; use ModStart\Core\Job\BaseJob; use Module\Vendor\Log\Logger; use Module\Vendor\Provider\MailSender\AbstractMailSenderProvider; use Module\Vendor\Provider\MailSender\MailSenderProvider; class MailSendJob extends BaseJob { public $email; public $subject; public $template; public $templateData = array(); public $emailUserName = null; public $option = array(); public $module; public static function create($plRSP, $CTO0l, $RJldp, $hoD52 = array(), $kj_IW = null, $HxhmW = array(), $EqTg2 = 0, $VLCiR = null) { goto SSkuk; SSkuk: $Y2SRS = app()->config->get('EmailSenderProvider'); goto FGfIE; J6k2n: $FRS1x->emailUserName = $kj_IW; goto WXFgF; Vt8Lr: $FRS1x->subject = $CTO0l; goto FVVPI; xqpQM: if ($EqTg2 > 0) { $FRS1x->delay($EqTg2); } goto xIhKv; gpdlO: $FRS1x->module = $VLCiR; goto K3jIM; FGfIE: BizException::throwsIfEmpty('邮箱发送未配置', $Y2SRS); goto LldBY; ZjwA9: $FRS1x->email = $plRSP; goto Vt8Lr; xIhKv: app('Illuminate\\Contracts\\Bus\\Dispatcher')->dispatch($FRS1x); goto ZTSiP; K3jIM: $FRS1x->onQueue('DefaultJob'); goto xqpQM; kUP1q: $FRS1x->templateData = $hoD52; goto J6k2n; WXFgF: $FRS1x->option = $HxhmW; goto gpdlO; LldBY: $FRS1x = new MailSendJob(); goto ZjwA9; FVVPI: $FRS1x->template = $RJldp; goto kUP1q; ZTSiP: } public function handle() { goto Y6KoE; dXQGg: $tJxVf = MailSenderProvider::get($Y2SRS); goto mu5Vr; fz1WT: $HvAUu = View::make($vvDaY, $this->templateData)->render(); goto KOtrX; Y6KoE: $Y2SRS = app()->config->get('EmailSenderProvider'); goto dXQGg; UCxgC: if (null === $this->emailUserName) { $this->emailUserName = $this->email; } goto fz1WT; dvNIk: Logger::info('Email', 'End', $this->email . ' -> ' . $this->subject); goto fnaaG; ZGnf8: if (!view()->exists($vvDaY)) { throw new \Exception('mail view not found : ' . $vvDaY); } goto UCxgC; HsL5p: if (!view()->exists($vvDaY)) { $vvDaY = 'theme.' . modstart_config()->getWithEnv('siteTemplate', 'default') . '.mail.' . $this->template; if (!view()->exists($vvDaY)) { $vvDaY = 'theme.default.mail.' . $this->template; if (!view()->exists($vvDaY)) { if ($this->module) { $vvDaY = 'module::' . $this->module . '.View.mail.' . $this->template; } if (!view()->exists($vvDaY)) { $vvDaY = 'module::Vendor.View.mail.' . $this->template; } } } } goto ZGnf8; Drubq: $vvDaY = $this->template; goto HsL5p; KOtrX: $mW7Vi = $tJxVf->send($this->email, $this->emailUserName, $this->subject, $HvAUu); goto McaCX; mu5Vr: Logger::info('Email', 'Start', $this->email . ' -> ' . $this->subject . ' -> ' . $this->template); goto Drubq; McaCX: BizException::throwsIfResponseError($mW7Vi); goto dvNIk; fnaaG: } }