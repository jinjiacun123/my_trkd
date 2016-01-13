<?php
function my_post($url, $params = false, $header = array()){
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
		#curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 5.1; rv:21.0) Gecko/20100101 Firefox/21.0'); 
		curl_setopt($ch, CURLOPT_URL,$url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
		$result = curl_exec($ch); 
		curl_close($ch); 
		 
		return $result; 
	}

function get_news_content()
{
$xml = <<<xl
<?xml version="1.0" encoding="utf-8"?>

<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1" xmlns:ns2="http://www.w3.org/2005/08/addressing" xmlns:ns3="http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1">  
  <env:Header> 
    <ns2:To>http://api.rkd.reuters.com/api/2006/05/01/News_1.svc</ns2:To>  
    <ns2:Action>http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1/RetrieveStoryML_1</ns2:Action>  
    <ns3:Authorization> 
      <ns3:ApplicationID>trkddemoappwm</ns3:ApplicationID>  
      <ns3:Token>72a7ebf4b402280b1453ded824de6e966792cd79dd0c12d87f0ce21c048baa028db51e2924aa0e60713fea6d85e2f13bd9d521818383febbe0e61f824dae751798433a61b158f5eab068a909a1a8482687f1043cde1046a7c4aff1c0b00cdebb</ns3:Token> 
    </ns3:Authorization> 
  </env:Header>  
  <env:Body> 
    <ns1:RetrieveStoryML_Request_1 characters="zh-Hans"> 
      <ns1:StoryMLRequest> 
        <ns1:TimeOut>600</ns1:TimeOut>  
        <ns1:StoryId>urn:newsml:reuters.com:20160105:nL3T14P3DH</ns1:StoryId> 
      </ns1:StoryMLRequest>
    </ns1:RetrieveStoryML_Request_1> 
  </env:Body> 
</env:Envelope>
xl;

$url = 'http://api.trkd.thomsonreuters.com/api/News/News.svc';
$header[] = 'Content-Type:application/soap+xml;';
$param = $xml;
print_r(my_post($url, $param, $header));
}
get_news_content();
