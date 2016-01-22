<?php
set_time_limit(1800);
#url
define('TOKEN_URL',    'http://localhost/sample_api/cnglod/TokenManagement');#生成token的url
define('REDIRECT_URL', 'http://localhost/sample_api/cnglod/redirect.php');#中间跳转url

#账号配置信息
define('APPID',       'trkddemoappwm');
define('USER_NAME',   'trkd-demo-wm@thomsonreuters.com');
define('PASSWORD',    't7c9k32db');

define('MAX_DATA_COUNT', 711);#最大经济数据条数



#系统格式化字符串
$system_dict = array(
	#替换
	'replace'=>array(
		#季度
		'Q1'=>'第一季度',
		'Q2'=>'第二季度',
		'Q3'=>'第二季度',
		'Q4'=>'第二季度',
		#月份
		'Jan'=>'1月',
		''=>'2月',
		''=>'3月',
		''=>'4月',
		''=>'5月',
		''=>'6月',
		''=>'7月',
		''=>'8月',
		''=>'9月',
		''=>'10月',
		''=>'11月',
		''=>'12月',
		#上周
		'w/e'=>'上周',
		'N/A'=>''
	),

	#单位运算
	'unit'=>array(),

	#货币
	'coin'=>array(),
);