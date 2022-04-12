<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Concern\HasAdminQuickCRUD; use ModStart\Admin\Layout\AdminCRUDBuilder; use ModStart\Grid\GridFilter; use ModStart\Support\Concern\HasFields; class MemberSelectController extends Controller { use HasAdminQuickCRUD; protected function crud(AdminCRUDBuilder $bhaAK) { $bhaAK->init('member_user')->field(function ($bhaAK) { $bhaAK->id('id', 'ID'); $bhaAK->display('created_at', '创建时间'); $bhaAK->image('avatar', '头像'); $bhaAK->text('username', '用户名'); $bhaAK->text('email', '邮箱'); $bhaAK->text('phone', '手机'); })->gridFilter(function (GridFilter $P2EU9) { $P2EU9->eq('id', L('ID')); $P2EU9->like('username', '用户名'); $P2EU9->like('email', '邮箱'); $P2EU9->like('phone', '手机'); })->title('用户管理')->canDelete(false); } }