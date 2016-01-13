<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_OnlineReports1_GetHeadlines2 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $topic;

	public function setTopic($value)
	{
		$this->topic = $value;
	}

	/**
	 * @see lib/WebServices/SoapRequestorAbstract::validate()
	 */
	protected function validate()
	{
		if (empty($this->topic))
		{
			return 'The topic value is not specified.';
		}
                
		return parent::validate();
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'OnlineReports_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'GetHeadlines_2';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$retval = new WebServices_OnlineReports1_GetHeadlines2Request();
		$retval->Topic = $this->topic;
		return $retval;
	}
	
} 