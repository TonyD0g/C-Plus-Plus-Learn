SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for cms_ad
-- ----------------------------
DROP TABLE IF EXISTS `cms_ad`;
CREATE TABLE `cms_ad` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `pic` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_ad_group
-- ----------------------------
DROP TABLE IF EXISTS `cms_ad_group`;
CREATE TABLE `cms_ad_group` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) DEFAULT '',
  `gnum` int(10) DEFAULT '0',
  `gkey` varchar(50) DEFAULT '',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_admin
-- ----------------------------
DROP TABLE IF EXISTS `cms_admin`;
CREATE TABLE `cms_admin` (
  `adminid` int(10) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(50) DEFAULT '',
  `adminpass` varchar(50) DEFAULT '',
  `penname` varchar(20) DEFAULT '',
  `pid` int(10) DEFAULT '0',
  `logintimes` int(10) DEFAULT '0',
  `lastlogindate` int(10) DEFAULT '0',
  `lastloginip` varchar(50) DEFAULT '',
  `readonly` smallint(1) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`adminid`),
  KEY `adminname` (`adminname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_alias
-- ----------------------------
DROP TABLE IF EXISTS `cms_alias`;
CREATE TABLE `cms_alias` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) DEFAULT '',
  `app` varchar(50) DEFAULT '',
  `sid` int(10) DEFAULT '0',
  `types` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `alias` (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_auth
-- ----------------------------
DROP TABLE IF EXISTS `cms_auth`;
CREATE TABLE `cms_auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ckey` varchar(50) DEFAULT '',
  `cval` text,
  `cdate` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_badword
-- ----------------------------
DROP TABLE IF EXISTS `cms_badword`;
CREATE TABLE `cms_badword` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `words` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_book
-- ----------------------------
DROP TABLE IF EXISTS `cms_book`;
CREATE TABLE `cms_book` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `mobile` varchar(20) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `qq` varchar(20) DEFAULT '',
  `postip` varchar(20) DEFAULT '',
  `message` text,
  `reply` text,
  `createdate` int(10) DEFAULT '0',
  `replydate` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_class
-- ----------------------------
DROP TABLE IF EXISTS `cms_class`;
CREATE TABLE `cms_class` (
  `cateid` int(10) NOT NULL AUTO_INCREMENT,
  `followid` int(10) DEFAULT '0',
  `cate_name` varchar(50) DEFAULT '',
  `cate_type` smallint(2) DEFAULT '0',
  `cate_url` varchar(255) DEFAULT '',
  `cate_page` int(10) DEFAULT '20',
  `cate_order` int(10) DEFAULT '0',
  `cate_title` varchar(255) DEFAULT '',
  `cate_key` varchar(255) DEFAULT '',
  `cate_desc` varchar(255) DEFAULT '',
  `cate_list` varchar(255) DEFAULT '',
  `cate_show` varchar(255) DEFAULT '',
  `cate_pic` varchar(255) DEFAULT '',
  `cate_en` varchar(255) DEFAULT '',
  `isgroup` smallint(1) DEFAULT '0',
  `ismenu` smallint(1) DEFAULT '0',
  `isnew` smallint(1) DEFAULT '0',
  PRIMARY KEY (`cateid`),
  KEY `order` (`cate_order`,`cateid`),
  KEY `where` (`followid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_config
-- ----------------------------
DROP TABLE IF EXISTS `cms_config`;
CREATE TABLE `cms_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gid` int(10) DEFAULT '0',
  `ckey` varchar(50) DEFAULT '',
  `ctitle` varchar(50) DEFAULT '',
  `cvalue` text,
  `ordnum` int(10) DEFAULT '0',
  `ctype` int(10) DEFAULT '0',
  `dvalue` text,
  `dtext` varchar(255) DEFAULT '',
  `rtype` smallint(1) DEFAULT '0',
  `utype` smallint(1) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  `issys` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ckey` (`ckey`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_config_group
-- ----------------------------
DROP TABLE IF EXISTS `cms_config_group`;
CREATE TABLE `cms_config_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) DEFAULT '',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_data
-- ----------------------------
DROP TABLE IF EXISTS `cms_data`;
CREATE TABLE `cms_data` (
  `dataid` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT '0',
  `piclist` text,
  `content` mediumtext,
  PRIMARY KEY (`dataid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_field
-- ----------------------------
DROP TABLE IF EXISTS `cms_field`;
CREATE TABLE `cms_field` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mid` int(10) DEFAULT '0',
  `field_title` varchar(50) DEFAULT '',
  `field_key` varchar(50) DEFAULT '',
  `field_type` int(5) DEFAULT '0',
  `field_length` int(10) DEFAULT '0',
  `field_upload_type` int(10) DEFAULT '0',
  `field_default` varchar(255) DEFAULT '',
  `field_list` text,
  `field_sql` varchar(255) DEFAULT '',
  `field_tips` varchar(255) DEFAULT '',
  `field_rule` int(10) DEFAULT '0',
  `field_radio` int(10) DEFAULT '0',
  `field_editor` int(10) DEFAULT '0',
  `field_group` int(10) DEFAULT '0',
  `field_filter` int(10) DEFAULT '0',
  `field_table` varchar(50) DEFAULT '',
  `field_join` varchar(255) DEFAULT '',
  `field_where` varchar(255) DEFAULT '',
  `field_order` varchar(255) DEFAULT '',
  `field_value` varchar(50) DEFAULT '',
  `field_label` varchar(50) DEFAULT '',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_file
-- ----------------------------
DROP TABLE IF EXISTS `cms_file`;
CREATE TABLE `cms_file` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) DEFAULT '',
  `file_name` varchar(255) DEFAULT '',
  `file_ext` varchar(50) DEFAULT '',
  `file_size` int(10) DEFAULT '0',
  `file_type` int(10) DEFAULT '0',
  `file_update` int(10) DEFAULT '0',
  `file_adminid` int(10) DEFAULT '0',
  `file_ip` varchar(50) DEFAULT '',
  `gid` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`file_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_file_group
-- ----------------------------
DROP TABLE IF EXISTS `cms_file_group`;
CREATE TABLE `cms_file_group` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `gname` varchar(50) DEFAULT '',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_link
-- ----------------------------
DROP TABLE IF EXISTS `cms_link`;
CREATE TABLE `cms_link` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_log
-- ----------------------------
DROP TABLE IF EXISTS `cms_log`;
CREATE TABLE `cms_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `msg` varchar(255) DEFAULT '',
  `ip` varchar(50) DEFAULT '',
  `createdate` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_log_login
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_login`;
CREATE TABLE `cms_log_login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(50) DEFAULT '',
  `loginip` varchar(50) DEFAULT '',
  `logindate` int(10) DEFAULT '0',
  `loginmsg` varchar(255) DEFAULT '',
  `loginstate` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_menu
-- ----------------------------
DROP TABLE IF EXISTS `cms_menu`;
CREATE TABLE `cms_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `cname` varchar(50) DEFAULT '',
  `aname` varchar(50) DEFAULT '',
  `dname` varchar(255) DEFAULT '',
  `followid` int(10) DEFAULT '0',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_page
-- ----------------------------
DROP TABLE IF EXISTS `cms_page`;
CREATE TABLE `cms_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cid` int(10) DEFAULT NULL,
  `piclist` text,
  `content` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_part
-- ----------------------------
DROP TABLE IF EXISTS `cms_part`;
CREATE TABLE `cms_part` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `ordnum` int(10) DEFAULT '0',
  `page_list` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_show
-- ----------------------------
DROP TABLE IF EXISTS `cms_show`;
CREATE TABLE `cms_show` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `classid` int(10) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `pic` varchar(255) DEFAULT '',
  `ispic` smallint(1) DEFAULT '0',
  `tags` varchar(255) DEFAULT '',
  `tagslist` varchar(500) DEFAULT '',
  `alias` varchar(50) DEFAULT '',
  `isnice` smallint(1) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  `isauto` smallint(1) DEFAULT '0',
  `ordnum` int(10) DEFAULT '0',
  `hits` int(10) DEFAULT '0',
  `intro` varchar(500) DEFAULT '',
  `isurl` smallint(1) DEFAULT '0',
  `url` varchar(255) DEFAULT '',
  `show_title` varchar(255) DEFAULT '',
  `show_key` varchar(255) DEFAULT '',
  `show_desc` varchar(255) DEFAULT '',
  `show_theme` varchar(255) DEFAULT '',
  `createdate` int(10) DEFAULT '0',
  `lastupdate` int(10) DEFAULT '0',
  `adminid` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `where1` (`isshow`,`classid`),
  KEY `where2` (`isshow`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_sitelink
-- ----------------------------
DROP TABLE IF EXISTS `cms_sitelink`;
CREATE TABLE `cms_sitelink` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `num` int(10) DEFAULT '0',
  `ordnum` int(10) DEFAULT '0',
  `isshow` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_tags
-- ----------------------------
DROP TABLE IF EXISTS `cms_tags`;
CREATE TABLE `cms_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT '',
  `hits` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `cms_ad_group` VALUES ('1', 'PC站Banner', '0', 'pc');
INSERT INTO `cms_ad_group` VALUES ('2', '手机站Banner', '0', 'mobile');
INSERT INTO `cms_alias` VALUES ('1', 'sitemap', 'other/sitemap', '0', '0');
INSERT INTO `cms_alias` VALUES ('2', 'search', 'other/search', '0', '0');
INSERT INTO `cms_alias` VALUES ('3', 'book', 'other/book', '0', '0');
INSERT INTO `cms_alias` VALUES ('5', 'label', 'other/label', '0', '0');
INSERT INTO `cms_alias` VALUES ('6', 'tags', 'other/tags', '0', '0');
INSERT INTO `cms_badword` VALUES ('1', '');
INSERT INTO `cms_config` VALUES ('1', '1', 'web_line', '常用设置', '', '1', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('2', '1', 'web_open', '网站开关', '1', '3', '6', '开启|1,关闭|0', '关闭后前台无法访问，后台不影响使用', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('3', '1', 'web_close', '关闭原因', '网站维护', '5', '5', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('4', '1', 'web_name', '网站名称', '轻站管理系统', '7', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('5', '1', 'web_logo', '网站Logo', '/upfile/logo.png', '9', '4', '', '', '1', '1', '1', '0');
INSERT INTO `cms_config` VALUES ('6', '1', 'web_icp', 'ICP备案号', '', '11', '1', '', '', '1', '1', '1', '0');
INSERT INTO `cms_config` VALUES ('7', '1', 'web_service', 'QQ客服', '', '13', '5', '', '示范：客服名称|10001，一行一条', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('8', '1', 'count_code', '流量统计', '', '15', '5', '', '百度统计请至模板里添加', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('9', '1', 'home_line', '域名相关', '', '17', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('10', '1', 'web_http', 'Http类型', 'http://', '19', '6', 'Http://|http://,Https://|https://', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('11', '1', 'web_domain', '主域名', '', '21', '1', '', '例：www.baidu.com，使用栏目绑定域名时，必须配置主域名', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('12', '1', 'web_domains', '副域名', '', '23', '5', '', '一行一条，格式：www.baidu.com 或 baidu.com，副域名会自动跳转到主域名', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('13', '1', 'seo_line', '优化设置', '', '25', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('14', '1', 'seo_title', '优化标题', '', '27', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('15', '1', 'seo_key', '关键字', '', '29', '5', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('16', '1', 'seo_desc', '描述', '', '31', '5', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('17', '2', 'url_mode_line', 'Url设置', '', '1', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('18', '2', 'url_mode', 'Url模式', '1', '3', '6', '调试模式（例: /?m=home）|1,Path_Info模式（例: /index.php/news.html）|2,伪静态模式（例: /news.html）|3', '在域名下使用，建议伪静态模式，同时需要配置伪静态规则', '2', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('19', '2', 'url_mid', 'Url间隔符', '/', '5', '8', '/|/,-|-,_|_', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('20', '2', 'url_cate_ext', '栏目及别名后缀', '/', '7', '8', '无后缀|,/|/,.html|.html', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('21', '2', 'url_ext', '内容页Url后缀', '.html', '9', '8', '无后缀|,/|/,.html|.html', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('22', '2', 'url_line', '路由映射', '', '11', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('23', '2', 'url_list', '内容列表页', 'list', '13', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('24', '2', 'url_show', '内容详情页', 'show', '15', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('25', '3', 'upload_line', '上传设置', '', '1', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('26', '3', 'upload_image_max', '图像最大上传', '5', '3', '1', '', '单位：M', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('27', '3', 'upload_video_max', '视频最大上传', '10', '5', '1', '', '单位：M', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('28', '3', 'upload_file_max', '附件最大上传', '20', '7', '1', '', '单位：M', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('29', '3', 'upload_file_folder', '储存方式', '2', '9', '6', '按年储存|1,按年/月储存|2,按年/月/日储存|3', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('30', '3', 'thumb_line', '压缩设置', '', '11', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('31', '3', 'thumb_open', '压缩开关', '0', '13', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('32', '3', 'thumb_min', '压缩宽度', '600', '15', '1', '', '图片会被压缩成这个宽度', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('33', '3', 'thumb_piclist', '组图压缩', '0', '17', '6', '开始|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('34', '3', 'thumb_auto', '自动缩略图', '0', '19', '6', '开启|1,关闭|0', '前台图片自动生成缩略图', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('35', '3', 'water_line', '水印设置', '', '21', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('36', '3', 'water_open', '水印开关', '0', '23', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('37', '3', 'water_width', '最小宽度', '400', '25', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('38', '3', 'water_height', '最小高度', '100', '27', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('39', '3', 'water_opacity', '透明度', '60', '29', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('40', '3', 'water_position', '水印位置', '5', '31', '8', '随机显示|0,顶部居左|1,顶部居中|2,顶部居右|3,中部居左|4,中部居中|5,中部居右|6,底部居左|7,底部居中|8,底部居右|9', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('41', '3', 'water_logo', '水印Logo', '', '33', '4', '', '', '1', '1', '1', '0');
INSERT INTO `cms_config` VALUES ('42', '3', 'water_piclist', '组图水印', '0', '35', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('43', '4', 'mobile_open', '开关', '1', '1', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('44', '4', 'mobile_http', 'Http类型', 'http://', '3', '6', 'Http://|http://,Https://|https://', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('45', '4', 'mobile_domain', '绑定域名', '', '5', '1', '', '例：m.baidu.com，和主域名一样需要做解析和空间上绑定', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('46', '4', 'mobile_auto', '自动识别', '1', '7', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('47', '4', 'mobile_logo', '手机站Logo', '/upfile/logo.png', '9', '4', '', '', '1', '1', '1', '0');
INSERT INTO `cms_config` VALUES ('48', '5', 'ct_company', '公司名称', '', '1', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('49', '5', 'ct_tel', '服务热线', '', '3', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('50', '5', 'ct_fax', '传真号码', '', '5', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('51', '5', 'ct_mobile', '手机号码', '', '7', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('52', '5', 'ct_email', '电子邮箱', '', '9', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('53', '5', 'ct_address', '公司地址', '', '13', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('54', '5', 'ct_work_time', '工作时间', '', '15', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('55', '5', 'ct_weixin', '微信二维码', '', '11', '4', '', '上传微信二维码，方便客户加好友', '1', '1', '1', '0');
INSERT INTO `cms_config` VALUES ('56', '6', 'admin_logo', '后台Logo', '/public/admin/images/logo.png', '1', '4', '', '建议尺寸：200*40', '1', '1', '1', '0');
INSERT INTO `cms_config` VALUES ('57', '6', 'admin_code', '登录验证码', '1', '3', '6', '开启|1,关闭|2', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('58', '6', 'admin_logintimes', '登录尝试次数', '10', '5', '1', '', '超过次数后禁止登录', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('59', '6', 'admin_log', '自动清理日志时间', '10', '7', '1', '', '单位：天，超过多少天的自动清理', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('60', '6', 'admin_log_login', '登录日志', '1', '9', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('61', '6', 'admin_log_admin', '管理日志', '1', '11', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('62', '6', 'admin_csrf', 'CSRF开关', '1', '13', '6', '开启|1,关闭|0', '如果使用火车头采集软件，请关闭，不影响前台CSRF防护', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('64', '7', 'state_class_line', '栏目部分', '', '1', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('65', '7', 'state_class_en', '英文名称', '0', '3', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('66', '7', 'state_class_pic', '栏目图片', '0', '5', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('67', '7', 'state_content_line', '内容部分', '', '7', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('68', '7', 'state_page', '单页组图', '0', '9', '6', '开启|1,关闭|0', '单页组图开关', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('69', '7', 'state_content', '内容组图', '0', '11', '6', '开启|1,关闭|0', '内容组图开关', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('70', '7', 'state_tags', '标签功能', '1', '13', '6', '开启|1,关闭|0', '后台部分功能开关', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('71', '7', 'state_book_line', '留言部分', '', '15', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('72', '7', 'state_book', '留言开关', '1', '17', '6', '开启|1,关闭|0', '关闭后无法使用留言功能', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('73', '7', 'state_book_show', '留言显示', '1', '19', '6', '开启|1,关闭|0', '留言页面是否显示通过审核的留言', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('74', '7', 'state_name', '姓名开关', '1', '21', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('75', '7', 'state_mobile', '手机开关', '1', '23', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('76', '7', 'state_email', '邮箱开关', '0', '25', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('77', '7', 'state_qq', 'QQ开关', '0', '27', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('78', '7', 'state_message', '留言内容', '1', '29', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('79', '7', 'state_code', '验证码', '1', '31', '6', '开启|1,关闭|0', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('80', '7', 'state_limit', '提交限制', '1', '33', '1', '', '单位：分钟，为0时不限制', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('81', '7', 'beian_line', '公安备案号', '', '35', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('82', '7', 'beian_num', '备案号', '', '37', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('83', '7', 'beian_url', '备案链接', '', '39', '1', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('84', '7', 'other_line', '其他可选', '', '41', '9', '', '', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('85', '7', 'other_favicon', 'favicon图标', '/favicon.ico', '43', '4', '', '请上传.ico格式的文件', '1', '3', '1', '0');
INSERT INTO `cms_config` VALUES ('86', '7', 'other_beian', '备案号链接', 'https://beian.miit.gov.cn', '45', '1', '', '工信部备案号链接网址，一般情况下无需修改', '1', '0', '1', '0');
INSERT INTO `cms_config` VALUES ('87', '7', 'other_nopic', '暂无图片', '/upfile/nopic.png', '47', '4', '', '没有缩略图时显示的图片', '1', '1', '1', '0');
INSERT INTO `cms_config_group` VALUES ('1', '基本设置', '0', '1');
INSERT INTO `cms_config_group` VALUES ('2', '运行模式', '0', '1');
INSERT INTO `cms_config_group` VALUES ('3', '附件设置', '0', '1');
INSERT INTO `cms_config_group` VALUES ('4', '手机站', '0', '1');
INSERT INTO `cms_config_group` VALUES ('5', '联系方式', '0', '1');
INSERT INTO `cms_config_group` VALUES ('6', '后台相关', '0', '1');
INSERT INTO `cms_config_group` VALUES ('7', '可选设置', '0', '1');
INSERT INTO `cms_menu` VALUES ('1', '网站管理', '', '', '', '0', '1', '1');
INSERT INTO `cms_menu` VALUES ('2', '内容管理', '', '', '', '0', '3', '1');
INSERT INTO `cms_menu` VALUES ('3', '扩展管理', '', '', '', '0', '5', '1');
INSERT INTO `cms_menu` VALUES ('4', '模板插件', '', '', '', '0', '7', '1');
INSERT INTO `cms_menu` VALUES ('5', '系统管理', '', '', '', '0', '9', '1');
INSERT INTO `cms_menu` VALUES ('6', '网站设置', 'config', 'index', '', '1', '1', '1');
INSERT INTO `cms_menu` VALUES ('7', '部门管理', 'part', 'index', '', '1', '3', '1');
INSERT INTO `cms_menu` VALUES ('8', '后台用户', 'admin', 'index', '', '1', '5', '1');
INSERT INTO `cms_menu` VALUES ('9', '栏目管理', 'category', 'index', '', '2', '1', '1');
INSERT INTO `cms_menu` VALUES ('10', '内容管理', 'content', 'index', '', '2', '3', '1');
INSERT INTO `cms_menu` VALUES ('11', '模板管理', 'theme', 'index', '', '4', '1', '1');
INSERT INTO `cms_menu` VALUES ('12', '区块管理', 'block', 'index', '', '4', '3', '1');
INSERT INTO `cms_menu` VALUES ('13', '插件管理', 'plug', 'index', '', '4', '5', '1');
INSERT INTO `cms_menu` VALUES ('14', '广告管理', 'ad', 'index', '', '3', '1', '1');
INSERT INTO `cms_menu` VALUES ('15', '友情链接', 'link', 'index', '', '3', '3', '1');
INSERT INTO `cms_menu` VALUES ('16', '留言管理', 'book', 'index', '', '3', '5', '1');
INSERT INTO `cms_menu` VALUES ('17', '内链管理', 'sitelink', 'index', '', '3', '7', '1');
INSERT INTO `cms_menu` VALUES ('18', '标签管理', 'tags', 'index', '', '3', '9', '1');
INSERT INTO `cms_menu` VALUES ('19', '字段管理', 'field', 'index', '', '3', '11', '1');
INSERT INTO `cms_menu` VALUES ('20', '设置分组', 'configgroup', 'index', '', '5', '1', '1');
INSERT INTO `cms_menu` VALUES ('21', '后台菜单', 'menu', 'index', '', '5', '3', '1');
INSERT INTO `cms_menu` VALUES ('22', '管理日志', 'log', 'index', '', '5', '5', '1');
INSERT INTO `cms_menu` VALUES ('23', '错误日志', 'logerror', 'index', '', '5', '7', '1');
INSERT INTO `cms_menu` VALUES ('24', '缓存管理', 'cache', 'index', '', '5', '9', '1');