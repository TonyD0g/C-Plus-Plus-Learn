<?php
return [
	#前缀
	'PREFIX'         => 'cms_8083',
	#后台目录
	'ADMIN'          => 'admin',
	#缓存目录
	'COMPILE_DIR'    => 'cache',
	#页面缓存开关
	'HTML_CACHE'     => false,
	#页面缓存目录
	'HTML_CACHE_DIR' => 'html',
	#页面缓存时间，单位分钟
	'HTML_CACHE_TIME'=> 5,
	#页面代码压缩
	'HTML_ZIP'       => false,
	#不支持Path_Info时使用的变量字符，支持时请留空
	'PATHINFO'       => '',
	#是否显示程序查询次数和内存
	'PROCESSED'     => true,
	#数据库
	'DEFAULT_DB'     => [
			#数据库类型（支持：mysql和sqlite）
			'DB_TYPE'    => 'mysql',
			#表前缀
			'DB_PREFIX'  => 'cms_',
			#Sqlite数据库名称
			'DB_NAME'  => '',
			#数据库IP
			'DB_HOST'    => '127.0.0.1',
			#数据库端口
			'DB_PORT'    => '3306',
			#数据库名称
			'DB_BASE'    => 'SD_CMS',
			#数据库用户名
			'DB_USER'    => 'SD_CMS',
			#数据库密码
			'DB_PASS'    => 'SD_CMS',
			
		]
	];