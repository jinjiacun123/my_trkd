<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_TimeSeries1_GetIntradayTimeSeries2Response extends Views_ResponseViewAbstract
{
	/**
	* @see lib/Views/Views_ResponseViewAbstract::getHTML()
	*/
	public function getHTML()
	{
		if (!isset($this->response->Row))
		{
			return '<hr/>No Time Series found.';
		}
		
		$retval = '<hr/><table class="bordered" width="100%">' .
                        '<thead><tr>' .
                        '<td><b>Open<b/></td>' .
                        '<td><b>High<b/></td>' .
                        '<td><b>Low<b/></td>' .
                        '<td><b>Close<b/></td>' .
                        '<td><b>Close Yield<b/></td>' .
                        '<td><b>Volume<b/></td>' .
                        '<td><b>Time Stamp<b/></td>' .
                        '</tr></thead>';		
		if (is_array($this->response->Row))
		{
			foreach ($this->response->Row as $row)
			{
				$retval .= $this->getItemContent($row);
			}
		} else
		{
			$retval .= $this->getItemContent($row);
		}
		$retval .= '</table>';
                
                if (isset($this->response->IntradayMin) & isset($this->response->IntradayMax))
                {
                    $retval .= '<br/>Summary elements:<br/>';
                    $retval .= '<table class="bordered" width="100%">' .
                        '<thead><tr>' .
                        '<td><b>Summary<b/></td>' .
                        '<td><b>Open<b/></td>' .
                        '<td><b>High<b/></td>' .
                        '<td><b>Low<b/></td>' .
                        '<td><b>Close<b/></td>' .
                        '<td><b>Close Yield<b/></td>' .
                        '<td><b>Volume<b/></td>' .
                        '<td><b>Date<b/></td>' .
                        '<td><b>Time<b/></td>' .
                        '</tr></thead>';
                    $retval .= $this->getSummaryContent($this->response->IntradayMin, 'IntradayMin');
                    $retval .= $this->getSummaryContent($this->response->IntradayMax, 'IntradayMax');
                    $retval .= '</table>';
                }
		
		
		return $retval;
	}
	
	private function getItemContent($item)
	{
		return '<tr><td>' . (isset($item->OPEN) ? $item->OPEN : '') . '</td>' .
			'<td>' . (isset($item->HIGH) ? $item->HIGH : '')  . '</td>' .
			'<td>' . (isset($item->LOW) ? $item->LOW : '')  . '</td>' .
			'<td>' . (isset($item->CLOSE) ? $item->CLOSE : '')  . '</td>' .
			'<td>' . (isset($item->CLOSEYIELD) ? $item->CLOSEYIELD : '')  . '</td>' .
			'<td>' . (isset($item->VOLUME) ? $item->VOLUME : '')  . '</td>' .
			'<td>' . (isset($item->TIMESTAMP) ? $item->TIMESTAMP : '')  . '</td></tr>';
	}
        
        private function getSummaryContent($item, $name)
	{
		return '<tr><td>' . $name . '</td>' .
                        '<td>' . (isset($item->OPEN) ? $item->OPEN : '')  . '</td>' .
			'<td>' . (isset($item->HIGH) ? $item->HIGH : '')  . '</td>' .
			'<td>' . (isset($item->LOW) ? $item->LOW : '')  . '</td>' .
			'<td>' . (isset($item->CLOSE) ? $item->CLOSE : '')  . '</td>' .
			'<td>' . (isset($item->CLOSEYIELD) ? $item->CLOSEYIELD : '')  . '</td>' .
			'<td>' . (isset($item->VOLUME) ? $item->VOLUME : '')  . '</td>' .
			'<td>' . (isset($item->DATE) ? $item->DATE : '')  . 
                        '<td>' . (isset($item->TIME) ? $item->TIME : '')  .
                        '</td></tr>';
	}
}