<?php
error_reporting(0);
set_time_limit(180000);
include_once('lib/lib.php');
include_once('lib/lib_xml.php');

$eci_list = include_once('lib/eci.php');
$max = 711;#最大循环条数

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
#print_r($ric);
#die;

$appid = 'trkddemoappwm';
$token = file_get_contents('token.txt');

$tmp_content = get_quotes($appid, $token, $ric);
$json_content =  $data=XML_unserialize($tmp_content);

$obj = $json_content['s:Envelope']['s:Body']['ns1:RetrieveItem_Response_3']['ns1:ItemResponse']['omm:Item']['omm:Fields']['omm:Field'];
$re_list = array(
	'ric'      => $ric,
	'CF_YIELD' => current($obj[2]),#result
	'CF_CLOSE' => current($obj[1]),#before
	'CF_LAST'  => current($obj[0]),#prediction
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
	post_data($re_list['title'], $re_list['CF_CLOSE'], $re_list['CF_LAST'], $re_list['CF_YIELD'], $re_list['country'], $re_list['right']);
	#print_r(post_data($re_list['title'], $re_list['CF_CLOSE'], $re_list['CF_LAST'], $re_list['CF_YIELD'], $re_list['country'], $re_list['right']));	
}



file_put_contents('ric_index.log', ($ric_index+1)%$max);
$r_url = 'http://localhost/sample_api/cnglod/redirect.php';
if($ric_index<711 || 0 == $ric_index)
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