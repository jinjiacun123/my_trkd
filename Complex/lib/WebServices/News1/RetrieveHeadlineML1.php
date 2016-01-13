<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_News1_RetrieveHeadlineML1 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $timeOut;

	private $maxCount;
	
	private $startTime;
	
	private $endTime;
	
	public function setTimeOut($value)
	{
		$this->timeOut = $value;
	}

	public function setMaxCount($value)
	{
		$this->maxCount = $value;
	}

	public function setStartTime($value)
	{
		$this->startTime = $value;
	}

	public function setEndTime($value)
	{
		$this->endTime = $value;
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'News_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'RetrieveHeadlineML_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$headlineRequest = new WebServices_News1_HeadlineMLRequest();
		$headlineRequest->TimeOut = $this->timeOut;
		$headlineRequest->MaxCount = $this->maxCount;
		$headlineRequest->StartTime = $this->startTime;
		$headlineRequest->EndTime = $this->endTime;
		$retval = new WebServices_News1_RetrieveHeadlineML1Request();
		$retval->HeadlineMLRequest = $headlineRequest;
		return $retval;
	}
	
} 