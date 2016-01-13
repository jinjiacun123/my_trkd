<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 *  Provides the method to resolve the path the requested file. 
 */
class Views_LocationResolver
{
	const WEB_SERVICE_PARAM = 'ws';
	
	const OPERATION_PARAM = 'op';
	
	const RESET_PARAM = 'reset';

	const RESET_URL = 'resetToken.php';
	
	const DEFAULT_WEB_SERVICE = 'TokenManagement_1';
	
	const DEFAULT_OPERATION = 'CreateServiceToken_1';

	/**
	 * Gets the path to the requested file.
	 * 
	 * @return absolute path to the file.
	 */
	public static function resolve()
	{
		if (isset($_REQUEST[self::RESET_PARAM]))
		{
			return HTML_PATH . self::RESET_URL;
		}
		if (!isset($_REQUEST[self::WEB_SERVICE_PARAM]) || !isset($_REQUEST[self::OPERATION_PARAM]))
		{
			return HTML_PATH . self::DEFAULT_WEB_SERVICE . DIRECTORY_SEPARATOR . self::DEFAULT_OPERATION . '.php';
		}
		return HTML_PATH . $_REQUEST[self::WEB_SERVICE_PARAM] . DIRECTORY_SEPARATOR . $_REQUEST[self::OPERATION_PARAM] . '.php';
	}

	/**
	 * Gets the web-service "ws" parameter from the request.
	 */
	public static function getCurrentWebService()
	{
		return isset($_REQUEST[self::WEB_SERVICE_PARAM]) ?
			$_REQUEST[self::WEB_SERVICE_PARAM] :
			self::DEFAULT_WEB_SERVICE;
	}

	/**
	 * Gets the operation "op" parameter from the request.
	 */
	public static function getCurrentOperation()
	{
		return isset($_REQUEST[self::OPERATION_PARAM]) ?
			$_REQUEST[self::OPERATION_PARAM] :
			self::DEFAULT_OPERATION;
	}
}