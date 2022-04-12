<?php
/**
 * ------------------------ 
 *  版权所有  www.tecmz.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Member\Api\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Auth\Admin; use ModStart\Data\FileManager; use ModStart\Data\UeditorManager; use Module\Member\Auth\MemberUser; use Module\Member\Support\MemberLoginCheck; class MemberDataController extends Controller implements MemberLoginCheck { public function fileManager($HvLpm) { return FileManager::handle($HvLpm, 'member_upload', 'member_upload_category', MemberUser::id()); } }