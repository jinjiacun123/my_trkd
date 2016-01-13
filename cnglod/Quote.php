<?php
include_once('lib/lib.php');
include_once('lib/lib_xml.php');

$eci_list = include_once('lib/eci.php');
$max = 1000;

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
$token = '0b16ad78a41fae7d5ed7dad5646eb252fdc56738f630f71ee0bf56548cdcfa148e56483150046c7aa1d8159b1c2daa63a0830a0250863f88dd1e5b4845e5ef81abd4e08b2d8f1400bb661f02db938494a37f6ed0cade5a7bcff58905fdaadecf';

$tmp_content = get_quotes($appid, $token, $ric);
$json_content =  $data=XML_unserialize($tmp_content);

$obj = $json_content['s:Envelope']['s:Body']['ns1:RetrieveItem_Response_3']['ns1:ItemResponse']['omm:Item']['omm:Fields']['omm:Field'];
$re_list = array(
	'ric'      => $ric,
	'CF_YIELD' => current($obj[0]),#result
	'CF_CLOSE' => current($obj[1]),#before
	'CF_LAST'  => current($obj[2]),#prediction
	'country'  => $eci_list[$ric]['country'],
	'title'    => $eci_list[$ric]['title']
);

print_r($re_list);

#提交post数据
include_once('post_data.php');
#($title, $before, $prediction, $result, $country, $rank=1)
print_r(post_data($re_list['title'], $re_list['CF_CLOSE'], $re_list['CF_LAST'], $re_list['CF_YIELD'], $country));

file_put_contents('ric_index.log', ($ric_index+1)%$max);