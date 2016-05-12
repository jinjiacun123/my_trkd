<?php
$url = 'http://192.168.1.248:86/ReutersHandler.ashx';
#$url1 = 'http://192.168.1.38:8011/NewInsertArticle.asmx?wsdl';
$url1 = 'http://192.168.1.9:8011/NewInsertArticle.asmx?wsdl';
#$url1 = 'http://192.168.1.248:8069/NewInsertArticle.asmx';
#正式地址
#http://221.6.167.39:802/
$header[] = 'Source: cngold.com.cn';
#$header[] = 'Content-Type: application/x-www-form-urlencoded';
$header[] = 'User-Agent: CngoldClient/1.0';
function my_post1($url, $params = false, $header = array()){
		//$cookie_file = tempnam(dirname(__FILE__),'cookie');
		#$cookie_file = __PUBLIC__.'cookies.tmp';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60); 
		//curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
		#curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file); 
		//curl_setopt($ch, CURLOPT_COOKIEFILE,$cookieFile); 
		#curl_setopt($ch, CURLOPT_COOKIEFILE,$cookie_file); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE); 
		curl_setopt($ch, CURLOPT_HTTPGET, true); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
		if($params !== false){
		 	curl_setopt($ch, CURLOPT_POSTFIELDS , $params);
		} 
		curl_setopt($ch, CURLOPT_USERAGENT,'CngoldClient/1.0'); 
		curl_setopt($ch, CURLOPT_URL,$url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
		$result = curl_exec($ch); 
		curl_close($ch); 
		 
		return $result; 
}

function post_news($newscontent, $classname)
{
	global $url, $header;
	/*demo
	$param = array(
		'op'=>'addnews',
		'newscontent'=>'人民币麻烦不断！期权市场暗示还将继续下行',
		'classname'=>'央行动态',
	);
	*/
	$param = array(
		'op'=>'addnews',
		'newscontent'=>$newscontent,
		'classname'=>$classname,
	);
	return my_post1($url, $param, $header);
}

function post_long_news($title, $content)
{
	global $url1;
	/* Step1:初始化SoapClient对象 */
	#$wcfURL = 'http://192.168.1.38:8011/NewInsertArticle.asmx?wsdl';
	$wcfURL = $url1;
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

function post_data($title, $before, $prediction, $result, $country, $rank=1)
{
	global $url, $header;
	/*
	$param = array(
		'op'=>'addfinancedata',
		'content'=>'澳大利亚11月出口(月率)',
		'before'=>'-3%',
		'prediction'=>'-3%',
		'result'=>'1%',
		'country'=>'澳大利亚',
		'rank'=>'5',                               
	);
	*/
	$param = array(
		'op'=>'addfinancedata',
		'content'=>$title,
		'before'=>$before,
		'prediction'=>$prediction,
		'result'=>$result,
		'country'=>$country,
		'rank'=>$rank,                               
	);
	return my_post1($url, $param, $header);
}

print post_data('澳大利亚建筑支出(季率)', 
		      $re_list['HTS_CLOSE2'], 
		      $re_list['SEC_YLD_1'], 
		      $re_list['CF_LAST'], 
		      $re_list['country'], 
		      $re_list['right']);

