<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_TimeSeries1_GetIntradayTimeSeries2 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $symbol;
	
	private $interval;
	
	private $day;
	
	private $timezone;
	
	private $startTime;
	
	private $endTime;
	
	private $mode;

	public function setSymbol($value)
	{
		$this->symbol = $value;
	}

	public function setInterval($value)
	{
		$this->interval = $value;
	}

	public function setDay($value)
	{
		$this->day = $value;
	}

	public function setTimezone($value)
	{
		$this->timezone = $value;
	}

	public function setStartTime($value)
	{
		$this->startTime = $value;
	}

	public function setEndTime($value)
	{
		$this->endTime = $value;
	}

	public function setMode($value)
	{
		$this->mode = $value;
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
		
		if ($this->mode == 'custom')
		{
			if (empty($this->startTime))
			{
				return 'The start time value is not specified.';
			}
	
			if (empty($this->endTime))
			{
				return 'The end time value is not specified.';
			}
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
		return 'GetIntradayTimeSeries_2';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$retval = null;
		
		if ($this->mode == 'day' || $this->mode == 'latest')
		{
                    $content = '<GetIntradayTimeSeries_Request_2 TrimResponse="false" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.reuters.com/ns/2006/05/01/webservices/rkd/TimeSeries_1">';
                    $content .= '<Symbol>' . $this->symbol . '</Symbol>';
                  
                    if ($this->mode == 'day')
                    {
                        $content .= '<Day>' . $this->day . '</Day>';
                    }
                    if(!empty($this->timezone))
                    {
                        $content .= '<Timezone>' . $this->timezone . '</Timezone>';
                    }
                    
                    $content .= '<Interval>' . $this->interval . '</Interval>';
                    $content .= '</GetIntradayTimeSeries_Request_2>';
                    
                    $retval = new SoapVar($content, XSD_ANYXML);
		}
		
		if ($this->mode == 'custom')
		{
			$retval = new WebServices_TimeSeries1_GetInterdayTimeSeries2Request();

			$retval->StartTime = $this->startTime;
			$retval->EndTime = $this->endTime;
                        $retval->Symbol = $this->symbol;
                        $retval->Interval = $this->interval;
		}
		
		return $retval;
	}

}