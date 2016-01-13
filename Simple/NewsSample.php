<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * Provide the generation of HTML for RetrieveItem_3 response.
 */
class RetrieveHeadlinesML1Response
{
	private $response;

	/**
	 * Initializes a new instance of <tt>Views_Quotes1_RetrieveItem3Response</tt> with the secified parameters.
	 *
	 * @param $response the response object.
	 */
	public function __construct($response)
	{
		$this->response = $response;
	}

	public function getHTML()
	{
		$retval = '<h2>HeadlineMLResponse - ' . $this->response->HeadlineMLResponse->Status->StatusMsg . '</h2>';
	
		if (!isset($this->response->HeadlineMLResponse->HEADLINEML->HL))
		{
			$retval .= 'No records found.';
			return $retval;
		}
		
		$retval .= 'Newer:&nbsp;' . $this->response->HeadlineMLResponse->Context->Newer . '<br/>Older:&nbsp;' . $this->response->HeadlineMLResponse->Context->Older . '<br/><br/>';
		
		
		foreach ($this->response->HeadlineMLResponse->HEADLINEML->HL as $items)
		{
			if (is_array($items))
			{
				foreach ($items as $item)
				{
					$retval .=  $this->getItemContent($item);
				}
			}
			else
			{
				$retval .= $this->getItemContent($items);
			}
		}
		
		return $retval;
	}

	private function getItemContent($item)
	{
		$retval = '<table width="100%" style="border: solid black 1px; padding: 5px;">' .
					'<thead>' .
					'<b>' .	$item->HT . '</b><br/>' . $item->RT .
					'</thead>' . 
					'<tr><td>Unique ID:</td><td>' . $item->ID . '</td></tr>' . 
					'<tr><td>Revision Number:</td><td>' . $item->RE . '</td></tr>' . 
					'<tr><td>Status:</td><td>' . $item->ST . '</td></tr>' . 
					'<tr><td>Creation Time:</td><td>' . $item->CT . '</td></tr>' . 
					'<tr><td>Revision Time:</td><td>' . $item->RT . '</td></tr>' . 
					'<tr><td>Local Time:</td><td>' . $item->LT . '</td></tr>' . 
					'<tr><td>Provider:</td><td>' . $item->PR . '</td></tr>' . 
					'<tr><td>Attribution:</td><td>' . $item->AT . '</td></tr>' . 
					'<tr><td>Urgency:</td><td>' . $item->UR . '</td></tr>' . 
					'<tr><td>Language:</td><td>' . $item->LN . '</td></tr>' . 
					'<tr><td>Type:</td><td>' . $item->TY . '</td></tr>' . 
					'<tr><td>PE Values</td><td>' . $item->PE . '</td></tr>' . 
					'<tr><td>Companies:</td><td>' . $item->CO . '</td></tr>' . 
					'<tr><td>Take Number:</td><td>' . $item->TN . '</td></tr>' .
					'</table><br/>';
		return $retval;
	}
}

$begin_time = date('Y-m-d',strtotime('-10 day')).'T00:00:00';
$end_time = date('Y-m-d').'T00:00:00';

/**
 * Provide the generation of RetrieveHeadlinesML_1 request.
 */
class RequestBuilder
{
  public static function createRequest()
  {
  	global $begin_time, $end_time;
  	/*
  	$filter = new SoapVar('
  	<Filter xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1">
      <And xmlns="http://schemas.reuters.com/ns/2006/04/14/rmds/webservices/news/filter">
		<Or>
			<MetaDataConstraint class="companies">
				<Value>.NCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.LCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.TCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.EUCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.HKCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.TWCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.SSCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>FRX/CN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>GOL/ECN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>GOL/HCN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>CNY/CN</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>O/NCN</Value>
			</MetaDataConstraint>

			<MetaDataConstraint class="companies">
				<Value>.N</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.L</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.T</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.BA</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>.EU</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>FRX/</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>GOL/</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>O/R</Value>
			</MetaDataConstraint>
			<MetaDataConstraint class="companies">
				<Value>MKTS/GLOB</Value>
			</MetaDataConstraint>

		

		</Or>
       
        <MetaDataConstraint class="language">
          <Value>zh</Value>
        </MetaDataConstraint>
      </And>
    </Filter>', XSD_ANYXML);
    */
	$filter = new SoapVar('
    <Filter xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1">
      <And xmlns="http://schemas.reuters.com/ns/2006/04/14/rmds/webservices/news/filter">
      	<MetaDataConstraint class="any">
        	<Value>MSFT.O</Value>
      	</MetaDataConstraint>
      	<MetaDataConstraint class="Language">
			<Value>zh</Value>
      	</MetaDataConstraint>
	 </And>
    </Filter>
    ', XSD_ANYXML); //SimpleXml doesn't support mixed content; should use mixed type elemetns explicitly
      /*
    $filter = new SoapVar('
        <Filter xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1">
          <MetaDataConstraint xmlns="http://schemas.reuters.com/ns/2006/04/14/rmds/webservices/news/filter" class="nameditem">
            <Or>
              <Value>.N</Value>
              <Value>.L</Value>
              <Value>.T</Value>
              <Value>.EU</Value>
              <Value>FRX/</Value>
              <Value>GOL/</Value>
              <Value>O/R</Value>
              <Value>MARKETS/AS</Value>
              <Value>MARKETS/US</Value>
            </Or>
          </MetaDataConstraint>
          <MetaDataConstraint class="Language">
			<Value>zh</Value>
          </MetaDataConstraint>
        </Filter>
    ', XSD_ANYXML); //SimpleXml doesn't support mixed content; should use mixed type elemetns explicitly
    */

    return array(
        'HeadlineMLRequest' => array(
            'TimeOut' => 600,
            'MaxCount' => 25,
            'MaxCountPerFilter' => true,
            // 'StartTime' => '2011-04-06T00:00:00',  //uncomment these lines to set the start and end dates if necessary
            'StartTime' => $begin_time,
            // 'EndTime' => '2011-04-08T00:00:00',
            'EndTime' => $end_time,
            'Direction' => Newer,
            'Filter' => $filter,
        )
    );
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

#保存token
file_put_contents(dirname(dirname(__FILE__)).'/cnglod/token.txt', bin2hex($createTokenResponse->Token));

$auth = array('ApplicationID' => $applicationId, 'Token'=> $createTokenResponse->Token ); //make sure the app ID is initialized here
$authvar = new SoapVar($auth, SOAP_ENC_OBJECT, "AuthorizationType", 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1' );

$newsRequest = RequestBuilder::createRequest();

$wsAddressingHeaders2 = array(
	new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'http://api.rkd.reuters.com/api/2006/05/01/News_1.svc'),
	new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/News_1/RetrieveHeadlineML_1'),
	new SoapHeader('http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1', 'Authorization', $authvar)
);

try
{
	$newsResponse = $client2->__soapCall('RetrieveHeadlineML_1', array('parameters' => $newsRequest), null, $wsAddressingHeaders2);
	#$view = new RetrieveHeadlinesML1Response($newsResponse);
    echo '<hr/><a href="#formatted">Go to formatted ouput.</a>';
	echo '<hr/><h2>XML Response:</h2><br/>' . htmlspecialchars($client2->__getLastResponse()); //get XML response
    #print_r($client2->__getLastResponse());
    
	#$xml_str = htmlspecialchars($client2->__getLastResponse());
	#导出xml
	#$xml = simplexml_load_file($xml_str);
	$file_path = dirname(dirname(__FILE__)).'/cnglod/data/news/'.$begin_time.'_'.$end_time.'.xml';
	print_r($file_path);
	file_put_contents(dirname(dirname(__FILE__))."/cnglod/data/news/tmp.xml", $client2->__getLastResponse());
	echo 'success';
	#print_r($xml->HL);
	/*
	foreach ($xml as $key => $value) { 
	    // 获取属性 
	    $attr = $value->title->attributes(); 
	    echo "Id: " . $attr['id'] . "<br />"; 
	    echo "Title: " . $value->title . "<br />"; 
	    echo "Details: " . $value->details . "<br /><br />"; 
	} 
	*/
	#header("Content-Type: text/html; charset=utf-8");
	#echo '<hr/><h2><a name="formatted">Formatted output:</a></h2><br/>' . $view->getHTML(); //creaing HTML from the response object
} catch (SoapFault $e) {
	echo "<span style='color:red'>Error occured: " . $e->getMessage() . "</span>";
}


