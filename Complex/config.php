<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

//Error reporting
ini_set('display_errors', true);  
error_reporting(E_ALL|E_STRICT);

//Global constants.
defined('ROOT_PATH')  
    or define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);  

defined('HTML_PATH')  
    or define('HTML_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'html') . DIRECTORY_SEPARATOR);

defined('LIBRARY_PATH')  
    or define('LIBRARY_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib') . DIRECTORY_SEPARATOR);  
  
defined('RESOURCES_PATH')  
    or define('RESOURCES_PATH', realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'resources') . DIRECTORY_SEPARATOR);

    function __autoload($class_name)
    {
    	if(is_file(ROOT_PATH . "lib" . DIRECTORY_SEPARATOR . str_replace("_", DIRECTORY_SEPARATOR, $class_name) . ".php")){
    		require ROOT_PATH . "lib" . DIRECTORY_SEPARATOR . str_replace("_", DIRECTORY_SEPARATOR, $class_name) . ".php";
    	}
    }

//Start the session.
session_start();

//Application config
class Config
{
	private static $config = array (  
		    'webservices' => array (
			    //for the web-services that are split into several WSDLs each operation should be configured individually
		        'TokenManagement_1' => array (
		        	'CreateServiceToken_1' => array (
						'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/TokenManagement/wsdl/TokenManagement_1_HttpsAndAnonymous.wsdl',
						'endpoint' => 'https://api.trkd.thomsonreuters.com/api/TokenManagement/TokenManagement.svc/Anonymous'
					),
					'CreateImpersonationToken_1' => array (
						'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/TokenManagement/wsdl/TokenManagement_1_HttpAndRKDToken.wsdl',
						'endpoint' => 'http://api.trkd.thomsonreuters.com/api/TokenManagement/TokenManagement.svc'
					),
				),
		        'Quotes_1' => array (
					'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/Quotes/wsdl/Quotes_1_HttpAndRKDToken.wsdl',
					'endpoint' => 'http://api.trkd.thomsonreuters.com/api/Quotes/Quotes.svc'
				),
		        'Charts_1' => array (
					'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/Charts/wsdl/Charts_1_HttpAndRKDToken.wsdl',
					'endpoint' => 'http://api.trkd.thomsonreuters.com/api/Charts/Charts.svc'
				),
		        'OnlineReports_1' => array (
					'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/OnlineReports/wsdl/OnlineReports_1_HttpAndRKDToken.wsdl',
					'endpoint' => 'http://api.trkd.thomsonreuters.com/api/OnlineReports/OnlineReports.svc'
				),
		        'News_1' => array (
					'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/News/wsdl/News_1_HttpAndRKDToken.wsdl',
					'endpoint' => 'http://api.trkd.thomsonreuters.com/api/News/News.svc'
				),
		        'TimeSeries_1' => array (
					'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/TimeSeries/wsdl/TimeSeries_1_HttpAndRKDToken.wsdl',
					'endpoint' => 'http://api.trkd.thomsonreuters.com/api/TimeSeries/TimeSeries.svc'
				),
		        'Searchall_1' => array (
					'wsdl' => 'http://api.trkd.thomsonreuters.com/schemas/Search/wsdl/Searchall_1_HttpAndRKDToken.wsdl',
					'endpoint' => 'http://api.trkd.thomsonreuters.com/api/Search/Search.svc'
				),
		    ),
		    'credentials' => array(
		    	'serviceUserName' => '',
		    	'applicationId' => '',
		    	'password' => '',
		    	'effectiveUserName' => '',
		    	'userType' => 'Unmanaged'
		    )
		);

	static function getConfig()
	{
		return self::$config; 
	}
}

//Set the default time zone.
#date_default_timezone_set('UTC');
date_default_timezone_set('PRC');