<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_TimeSeries1_GetExchangeData1Response extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$retval = '<hr/>' .
					'<b>Echange name:</b>&nbsp;' . $this->response->ExchangeDataResponse->ExchangeName . '<br/>' .
					'<b>Timezone:</b>&nbsp;' . $this->response->ExchangeDataResponse->Timezone . '<br/>' .
					'<b>IDN Exchange ID:</b>&nbsp;' . $this->response->ExchangeDataResponse->IDNExchID . '<br/><br/>';
		
		$retval .= '<h2>Trading week</h2><table><thead><td><b>Start</b></td><td><b>End</b></td></thead>';
		
		foreach ($this->response->ExchangeDataResponse->TradingWeek->TradingDay as $tradingDay)
		{
			$retval .= '<tr><td>' .
				$tradingDay->Session->StartDay . ' ' . $this->getTime($tradingDay->Session->StartTime) . '</td><td>' .
				$tradingDay->Session->EndDay . ' ' . $this->getTime($tradingDay->Session->EndTime) . '</td></tr>';
		}
		
		$retval .= '</table>';
		
		if (!isset($this->response->ExchangeDataResponse->Holiday))
		{
			return $retval;
		}
		
		$retval .= '<h2>Holidays</h2><table><thead><td><b>Start Date</b></td><td><b>End Date</b></td><td><b>Whole Day</b></td></thead>';
		
		if (is_array($this->response->ExchangeDataResponse->Holiday))
		{
			foreach ($this->response->ExchangeDataResponse->Holiday as $holiday)
			{
				$retval .= '<tr><td>' .
				$holiday->StartDate . '</td><td>' .
				$holiday->EndDate . '</td><td>' .
				$holiday->IsWholeDay . '</td></tr>';
			}
		} else
		{
				$retval .= '<tr><td>' .
				$this->response->ExchangeDataResponse->Holiday->StartDate . '</td><td>' .
				$this->response->ExchangeDataResponse->Holiday->EndDate . '</td><td>' .
				$this->response->ExchangeDataResponse->Holiday->IsWholeDay . '</td></tr>';			
		}
		
		$retval .= '</table>';
		
		return $retval;
	}
	
	private function getTime($xmlTimeString)
	{
		return $this->getBetween($xmlTimeString, 'T', '+');
	}
	
	private function getBetween($input, $start, $end)
	{
		$substr = substr($input, strlen($start) + strpos($input, $start), (strlen($input) - strpos($input, $end))*(-1));
		return $substr;
	}
}