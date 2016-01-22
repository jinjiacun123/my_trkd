<?php
error_reporting(0);
set_time_limit(180000);
include_once('lib/lib.php');
include_once('lib/lib_xml.php');
include_once('config.php');


#货币
$coin_dict = array();

$eci_list = include_once('lib/eci.php');
$max = MAX_DATA_COUNT;#最大循环条数

$ric_index = file_get_contents('ric_index.log');

$ric = '';
$tmp_index = 0;
foreach($eci_list as $k=>$v)
{
	if($tmp_index == $ric_index)
	{
		$ric = $k;
		break;
	}
	else
	{
		$tmp_index += 1;
	}
}
unset($k, $v);
$status = 0;


$token = file_get_contents('token.txt');
#判断token是否过期
$tmp_content = get_quotes(APPID, $token, $ric);
#Token expired
while(strpos($tmp_content, "Token expired"))
{
	file_get_contents(TOKEN_URL);
	$token = file_get_contents('token.txt');
	$tmp_content = get_quotes(APPID, $token, $ric);
	print_r($tmp_content);
}
$json_content =  $data=XML_unserialize($tmp_content);

$obj = $json_content['s:Envelope']['s:Body']['ns1:RetrieveItem_Response_3']['ns1:ItemResponse']['omm:Item']['omm:Fields']['omm:Field'];
print_r($obj);
/*
$old_field_list = array(
	'CF_LAST'=>'',#公布值 
	'HTS_CLOSE2'=>'',#前值 
	'SEC_YLD_1'=>'',#预期值
	'CTBTR_1LL'=>'',#周期
	'CF_DATE'=>'',#公布日期
	'CF_TIME'=>'',#公布时间
	'GV3_TEXT'=>'',#计量单位
);
*/
$old_field_list = array(
  $obj['0 attr']['Name'] => current($obj[0]),
  $obj['1 attr']['Name'] => current($obj[1]),
  $obj['2 attr']['Name'] => current($obj[2]),
  $obj['3 attr']['Name'] => current($obj[3]),
  $obj['4 attr']['Name'] => current($obj[4]),
  $obj['5 attr']['Name'] => current($obj[5]),
  $obj['6 attr']['Name'] => current($obj[6]),
);

print_r($old_field_list);
die;
#格式化转换
$fmt_field_list = array();


$re_list = array(
	'ric'        => $ric,
	'CF_LAST'    =>$old_field_list['CF_LAST'],#公布值
	'HTS_CLOSE2' =>$old_field_list['HTS_CLOSE2'],#前值 
	'SEC_YLD_1'  =>$old_field_list['SEC_YLD_1'],#预期值
	'CTBTR_1LL'  =>$old_field_list['CTBTR_1LL'],#周期
	'CF_DATE'    =>$old_field_list['CF_DATE'],#公布日期
	'CF_TIME'    =>$old_field_list['CF_TIME'],#公布时间
	'GV3_TEXT'   =>$old_field_list['GV3_TEXT'],#计量单位
	#'CF_YIELD' => current($obj[2]),#result
	#'CF_CLOSE' => current($obj[1]),#before
	#'CF_LAST'  => current($obj[0]),#prediction
	'country'  => $eci_list[$ric]['country'],
	'title'    => $eci_list[$ric]['country'].$eci_list[$ric]['title'],
	'right'    => $eci_list[$ric]['priviege'],
);

#print_r($re_list);
/*
$re_list = Array ( 
	    'ric' => 'CNCBRR=ECI',
	    'CF_YIELD' => 0.0,
	    'CF_CLOSE' => 0.0,
	    'CF_LAST' => 17.5,
	    'country' => '中国',
	    'title' => '中国存款准备金率',
	    'right' => 5 
	   );
*/

#提交post数据
include_once('post_data.php');
#print_r($re_list);
#($title, $before, $prediction, $result, $country, $rank=1)
if('' != $re_list['CF_YIELD']
&& '' != $re_list['CF_CLOSE']
&& '' != $re_list['CF_LAST'])
{
	post_data($re_list['title'], 
		      $re_list['CF_CLOSE'], 
		      $re_list['CF_LAST'], 
		      $re_list['CF_YIELD'], 
		      $re_list['country'], 
		      $re_list['right']);
	#print_r(post_data($re_list['title'], $re_list['CF_CLOSE'], $re_list['CF_LAST'], $re_list['CF_YIELD'], $re_list['country'], $re_list['right']));	
}



file_put_contents('ric_index.log', ($ric_index+1)%$max);
$r_url = REDIRECT_URL;
if($ric_index<MAX_DATA_COUNT || 0 == $ric_index)
{
	sleep(10);
    #$url = "http://bbs.lampbrother.net";  
    echo "<script language='javascript' 
    type='text/javascript'>";  
    echo "window.location.href='$r_url'";  
    echo "</script>";  
    
    #header("location:http://localhost/sample_api/cnglod/redirect.php");
}
else
{
	echo '跑结束';
}
#	header("location:http://localhost/sample_api/cnglod/redirect.php");}
 ?> 