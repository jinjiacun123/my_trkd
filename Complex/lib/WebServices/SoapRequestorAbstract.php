<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * Provides the functionality to make a call to a specific web-service operation.
 */
abstract class WebServices_SoapRequestorAbstract
{
	const SOAP_ACTION_XPATH = '//wsdl:binding/wsdl:operation[@name="%1$s"]/soap12:operation';
	
	const SOAP_ACTION_ATTRIBUTE = 'soapAction';

	/**
	 * Makes a request to the web-service operation defined by this instance.
	 * 
	 * @return the response object.  
	 */
	protected function run()
	{
		if ($this->validate() !== true)
		{
			 throw new RuntimeException($this->validate());
		}
		
		$client = new SoapClient($this->getWsdlUrl(), array('soap_version' => SOAP_1_2, 'trace' => true, 
			                    //"proxy_host"	=> '127.0.0.1',				//in order to set a proxy server to access Internet use this parameter
						//		"proxy_port"	=> 8888,					//and use this one to set the proxy port
								"cache_wsdl"	=> WSDL_CACHE_MEMORY));		//in order to enable WSDL chaching (WSDLs won't be downloaded before every service call)
// 		$client = new SoapClient($this->getWsdlUrl(), array('soap_version' => SOAP_1_2));

		$operation = $this->getOperationName();
		$request = $this->getRequest();
		$headers = $this->getSoapHeaders();
		$retval = $client->__soapCall($operation, array('parameters' => $request), null, $headers);
		return $retval;
	}

	/**
	 * Gets the name of the web-service to request.
	 * 
	 * @return the web-service name.
	 */
	protected abstract function getWebServiceName();

	/**
	 * Gets the name of the web-service operation to request.
	 * 
	 * @return the operation name.
	 */
	protected abstract function getOperationName();

	/**
	 * Gets the SOAP request object.
	 * 
	 * @return the request object.
	 */
	protected abstract function getRequest();
	
	/**
	 * Validates the request data before make a request.
	 * 
	 * @return <code>true</code> if the data is valid; <code>false</code> otherwise.
	 */
	protected function validate()
	{
		return true;
	}

	/**
	 * Gets the URL to the WSDL that defines the web-service this instance calls.
	 * 
	 * @return the URL to the WSDL.
	 */
	protected function getWsdlUrl()
	{
		$config_section = $this->getConfigSection();
		return $config_section['wsdl'];
	}

	/**
	 * Gets the headers of the SOAP request.
	 * 
	 * @return the array of configured <tt>SoapHeader</tt> objects.
	 */
	protected function getSoapHeaders()
	{
		return array(
		new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', $this->getSoapHeaderTo()),
		new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', $this->getSoapHeaderAction()),
		new SoapHeader('http://www.w3.org/2005/08/addressing', 'MessageID', uniqid('php_samples_', true))
		);
	}

	private function getSoapHeaderTo()
	{
		$config_section = $this->getConfigSection();
		return $config_section['endpoint'];
	}

	private function getSoapHeaderAction()
	{
		//to setup a proxy server for the libxml which is used to retrieve a WSDL several lines below you can use this code snippet
		
// 		$r_default_context = stream_context_get_default (
// 			array(
// 				'http' => array(
// 					'proxy' => "tcp://127.0.0.1:8888", 
// 					'request_fulluri' => True, 
// 				),
// 			)
// 		);
// 		libxml_set_streams_context($r_default_context);
		
		$xml = simplexml_load_file($this->getWsdlUrl()); 
	    $namespaces = $xml->getDocNamespaces();
		$result = $xml->xpath(sprintf(self::SOAP_ACTION_XPATH, $this->getOperationName()));
		
		if ($result === false)
		{
			throw new RuntimeException('Unable to retrieve SOAP Action.');
		}

		foreach($result[0][0]->attributes() as $a => $b)
		{
			if ($a === self::SOAP_ACTION_ATTRIBUTE)
			{
				return (string)$b;
			}
		}

		throw new RuntimeException('Unable to retrieve SOAP Action.');
	}
	
	/**
	 * Gets the appropriate config section for this requestor.
	 * 
	 * Some services might be split into several WSDLs (e.g. Token Management). In this case the config will
	 * specify settings for each operation individually rather then for the whole service. This method finds
	 * the right configuration based on the structure of 'webservices' config section for this particular requestor.  
	 */
	private function getConfigSection()
	{
		$config = Config::getConfig();
		$service_level = $config['webservices'][$this->getWebServiceName()];
		return array_key_exists('wsdl', $service_level) ? $service_level : $service_level[$this->getOperationName()];
	}
}