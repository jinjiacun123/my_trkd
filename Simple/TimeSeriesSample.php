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
class GetInterdayTimeSeriesResponse2
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

	/**
	 * Gets the generated HTML.
	 *
	 * @return the string containing HTML markup.
	 */
	public function getHTML()
	{
		$retval = '<table border="1"><tr><th>Open</th><th>High</th><th>Low</th><th>Close</th><th>Volume</th><th>Close Yield</th><th>Timestamp</th></tr>';
		foreach ($this->response as $items)
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
		
        $retval .= '</table>';
		return $retval;
	}

	private function getItemContent($item)
	{
		return '<tr><td>' . $item->O . '</td><td>' . $item->H . '</td><td>' . $item->L . '</td><td>' . $item->C . '</td><td>' . $item->V . '</td><td>' . $item->CY . '</td><td>' . $item->T . '</td></tr>';
	}
}

class RequestBuilder
{
  public static function createRequest()
  {
    return array(
      'TrimResponse' => true, //enable response trimming
      'Symbol' => 'IBM.N',
      'StartTime' => substr_replace(date(DATE_ISO8601, time() - 60*60*24*365), '', -5),
      'EndTime' => substr_replace(date(DATE_ISO8601), '', -5),
      'Interval' => 'DAILY'
    );
  }
}

$client = new SoapClient("http://api.rkd.reuters.com/schemas/wsdl/TokenManagement/TokenManagement_1_HttpsAndAnonymous.wsdl", array('soap_version' => SOAP_1_2));

$applicationId = '';
$createTokenRequest = array(
   'ApplicationID' => $applicationId,
   'Username' => '',
   'Password' => ''
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

$client2 = new SoapClient("http://api.rkd.reuters.com/schemas/wsdl/TimeSeries/TimeSeries_1_HttpAndRKDToken.wsdl", array('soap_version' => SOAP_1_2, 'trace' => true)                                                        //in order to get the XML response enable trace
  );

$auth = array('ApplicationID' => $applicationId, 'Token'=> $createTokenResponse->Token );  //make sure the app ID is initialized here
$authvar = new SoapVar($auth, SOAP_ENC_OBJECT, "AuthorizationType", 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1' );

$tsRequest = RequestBuilder::createRequest();

$wsAddressingHeaders2 = array(
	new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'http://api.rkd.reuters.com/api/TimeSeries/TimeSeries.svc'),
	new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/TimeSeries_1/GetInterdayTimeSeries_2'),
	new SoapHeader('http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1', 'Authorization', $authvar)
);

try
{
	$tsResponse = $client2->__soapCall('GetInterdayTimeSeries_2', array('parameters' => $tsRequest), null, $wsAddressingHeaders2);
	$view = new GetInterdayTimeSeriesResponse2($tsResponse);
    echo '<hr/><a href="#formatted">Go to formatted ouput.</a>';
	echo '<hr/><h2>XML Response:</h2><br/>' . htmlspecialchars($client2->__getLastResponse()); //get XML response
	echo '<hr/><h2><a name="formatted">Formatted output:</a></h2><br/>' . $view->getHTML(); //creaing HTML from the response object
} catch (SoapFault $e) {
	echo "<span style='color:red'>Error occured: " . $e->getMessage() . "</span>";
}