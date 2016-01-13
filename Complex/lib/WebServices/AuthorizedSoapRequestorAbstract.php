<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * Provides the functionality to make a call to a specific web-service operation
 * that requires authorization. Uses authorization session.
 */
abstract class WebServices_AuthorizedSoapRequestorAbstract
	extends WebServices_SoapRequestorAbstract
	implements WebServices_IRkdApiOperation
{
	private $applicationId;
	
	private $token;
	
	public function runAuthorized($appId, $token)
	{
		$this->applicationId = $appId;
		$this->token = $token;
		return parent::run();
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbstract::getSoapHeaders()
	 */
	protected function getSoapHeaders()
	{
		$auth = array('ApplicationID'=> $this->applicationId, 'Token'=> $this->token);
		$authvar = new SoapVar($auth, SOAP_ENC_OBJECT, "AuthorizationType", 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1' );
		$authorization = new SoapHeader('http://www.reuters.com/ns/2006/05/01/webservices/rkd/Common_1', 'Authorization', $authvar);
		
		$retval = parent::getSoapHeaders();
		$retval[] = $authorization;
		return $retval;
	}
}