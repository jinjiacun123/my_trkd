<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_TimeSeries1_GetInterdayTimeSeries2 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $symbol;
	
	private $interval;
	
	private $startTime;
	
	private $endTime;

	public function setSymbol($value)
	{
		$this->symbol = $value;
	}

	public function setInterval($value)
	{
		$this->interval = $value;
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
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::validate()
	 */
	protected function validate()
	{
		if (empty($this->symbol))
		{
			return 'The symbol value is not specified.';
		}
		
		if (empty($this->interval))
		{
			return 'The interval value is not specified.';
		}
		
		if (empty($this->startTime))
		{
			return 'The start time value is not specified.';
		}

		if (empty($this->endTime))
		{
			return 'The end time value is not specified.';
		}

		return parent::validate();
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'TimeSeries_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'GetInterdayTimeSeries_2';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$retval = new WebServices_TimeSeries1_GetInterdayTimeSeries2Request();
		$retval->Symbol = $this->symbol;
		$retval->Interval = $this->interval;
		$retval->StartTime = $this->startTime;
		$retval->EndTime = $this->endTime;
		return $retval;
	}

}