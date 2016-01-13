<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * Provide the generation of RetrieveHeadlinesML_1 request.
 */
class RequestBuilder
{
  public static function createRequest()
  {
	$filter = new SoapVar('
        <Filter xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1">
          <MetaDataConstraint class="Language">
			<Value>zh</Value>
          </MetaDataConstraint>
        </Filter>', XSD_ANYXML); //SimpleXml doesn't support mixed content; should use mixed type elemetns explicitly

    $return = array(
        'StoryMLRequest' => array(
            'TimeOut' => 600,
            'StoryId' => 'urn:newsml:reuters.com:20160105:nL3T14P3DH',
            'characters' => ' ',
        )
    );
    #$return->setAttribute("characters","zh-Hans");
    return $return;
  }
}

#$client = new SoapClient("http://api.rkd.reuters.com/schemas/wsdl/TokenManagement/TokenManagement_1_HttpsAndAnonymous.wsdl", array('soap_version' => SOAP_1_2));
$client = new SoapClient("http://api.trkd.thomsonreuters.com/schemas/wsdl/TokenManagement/TokenManagement_1_HttpsAndAnonymous.wsdl", array('soap_version' => SOAP_1_2));

$applicationId = 'trkddemoappwm';
$createTokenRequest = array(
   'ApplicationID' => $applicationId,
   'Username' => 'trkd-demo-wm@thomsonreuters.com',
   'Password' => 't7c9k32db'
); //make sure credentials are initialized here

$wsAddressingHeaders = array(
  new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://api.rkd.reuters.com/api/2006/05/01/TokenManagement_1.svc/Anonymous'),
  new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/TokenManagement_1/CreateServiceToken_1')
  );

try
{
	$createTokenResponse = $client->__soapCall('CreateServiceToken_1', array('parameters' => $createTokenRequest), null, $wsAddressingHeaders);
	echo 'Token received<br/>Token:&nbsp;' . bin2hex($createTokenResponse->Token) .
	'<br/>Expiration:&nbsp;' . $createTokenResponse->Expiration . '<br/>';

} catch (SoapFault $e) {
	echo "<span style='color:red'>Error occured: " . $e->getMessage() . "</span>";
}

$client2 = new SoapClient("http://api.trkd.thomsonreuters.com/schemas/wsdl/News/News_1_HttpAndRKDToken.wsdl", array('soap_version' => SOAP_1_2, 'trace' => true)); //in order to get the XML response enable trace

$auth = array('ApplicationID' => $applicationId, 'Token'=> $createTokenResponse->Token ); //make sure the app ID is initialized here
$authvar = new SoapVar($auth, SOAP_ENC_OBJECT, "AuthorizationType", 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1' );

$newsRequest = RequestBuilder::createRequest();

$wsAddressingHeaders2 = array(
	new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'http://api.rkd.reuters.com/api/2006/05/01/News_1.svc'),
	new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1/RetrieveStoryML_1'),
	new SoapHeader('http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1', 'Authorization', $authvar)
);


try
{
	#$tmp['_'] = 'RetrieveStoryML_1';
	$RetrieveStoryML_1['characters'] = "zh-Hans";
	$endcoded = new SoapVar($RetrieveStoryML_1, SOAP_ENC_OBJECT);
	$newsResponse = $client2->__soapCall($endcoded, array('parameters' => $newsRequest), null, $wsAddressingHeaders2);
	#$view = new RetrieveStoryML1Response($newsResponse);
    echo '<hr/><a href="#formatted">Go to formatted ouput.</a>';
	echo '<hr/><h2>XML Response:</h2><br/>' . htmlspecialchars($client2->__getLastResponse()); //get XML response
	#header("Content-Type: text/html; charset=utf-8");
	#echo '<hr/><h2><a name="formatted">Formatted output:</a></h2><br/>' . $view->getHTML(); //creaing HTML from the response object
} catch (SoapFault $e) {
	echo "<span style='color:red'>Error occured: " . $e->getMessage() . "</span>";
}


