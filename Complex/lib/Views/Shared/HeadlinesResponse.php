<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * A view generator shared by OnlineReports_1/GetHeadlines_1 and News_1/RetrieveHeadlineML_1
 */
class Views_Shared_HeadlinesResponse extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$retval = '<hr/>' .
					'<h2>HeadlineMLResponse - ' . $this->response->HeadlineMLResponse->Status->StatusMsg . '</h2>';
		
	
		if (!isset($this->response->HeadlineMLResponse->HEADLINEML->HL))
		{
			$retval .= 'No records found.';
			return $retval;
		}
		
		$retval .= 'Newer:&nbsp;' . $this->response->HeadlineMLResponse->Context->Newer . '<br/>Older:&nbsp;' . $this->response->HeadlineMLResponse->Context->Older . '<br/><br/>';
		
		
		foreach ($this->response->HeadlineMLResponse->HEADLINEML->HL as $items)
		{
			if (is_array($items))
			{
				foreach ($items as $item)
				{
					$retval .=  $this->getItemContent($item);
				}
			}
			else
			{
				$retval .= $this->getItemContent($items);
			}
		}
		
		return $retval;
	}

	private function getItemContent($item)
	{
		$retval = '<table width="100%" class="bordered">' .
					'<thead>' .
					'<b>' .	$item->HT . '</b><br/>' . $item->RT .
					'</thead>' . 
					'<tr><td>Unique ID:</td><td>' . $item->ID . '</td></tr>' . 
					'<tr><td>Revision Number:</td><td>' . $item->RE . '</td></tr>' . 
					'<tr><td>Status:</td><td>' . $item->ST . '</td></tr>' . 
					'<tr><td>Creation Time:</td><td>' . $item->CT . '</td></tr>' . 
					'<tr><td>Revision Time:</td><td>' . $item->RT . '</td></tr>' . 
					'<tr><td>Local Time:</td><td>' . $item->LT . '</td></tr>' . 
					'<tr><td>Provider:</td><td>' . $item->PR . '</td></tr>' . 
					'<tr><td>Attribution:</td><td>' . $item->AT . '</td></tr>' . 
					'<tr><td>Urgency:</td><td>' . $item->UR . '</td></tr>' . 
					'<tr><td>Language:</td><td>' . $item->LN . '</td></tr>' . 
					'<tr><td>Type:</td><td>' . $item->TY . '</td></tr>' . 
					'<tr><td>PE Values</td><td>' . $item->PE . '</td></tr>' . 
					'<tr><td>Companies:</td><td>' . $item->CO . '</td></tr>' . 
					'<tr><td>Take Number:</td><td>' . $item->TN . '</td></tr>' .
					'</table><br/>';
		return $retval;
	}
}