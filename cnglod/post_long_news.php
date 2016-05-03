<?php

function post_long_news($url, $title, $content)
{
	/* Step1:初始化SoapClient对象 */
	#$wcfURL = 'http://192.168.1.38:8011/NewInsertArticle.asmx?wsdl';
	$wcfURL = $url;
	$wcfClient = new SoapClient ( $wcfURL );

	#$result = $wcfClient->AddNews($body);
	#$result = $wcfClient->Get($body);
	$params = array(
		'jsonContent'=>json_encode(array(
					'New_Title'=>$title,
					'New_Content'=>$content
			))	
	);
	$result = $wcfClient->__soapCall('JsonInsertArtinfo',array('parameters'=>$params));
	#print_r($result);
	return $result->JsonInsertArtinfoResult;
}

$url = 'http://192.168.1.9:8011/NewInsertArticle.asmx?wsdl';
$title = '我的测试';
$content = '我的测试内容';
echo post_long_news($url, $title, $content);