<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * An object that is able to perform an authorized request to a TRKD API web-service.
 */
interface WebServices_IRkdApiOperation
{
	/**
	 * Makes a request to the web-service operation with the specified authorization parameters.
	 * 
	 * @param $appId the Application ID.
	 * @param $token the authorization token.
	 * @return the response object.  
	 */
	public function runAuthorized($appId, $token);
}