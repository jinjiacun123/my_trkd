<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_News1_RetrieveStoryML1Response extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$retval = '<hr/>' .
					'<h2>StoryMLResponse - ' . $this->response->StoryMLResponse->Status->StatusMsg . '</h2>';
		
		if (is_array($this->response->StoryMLResponse->STORYML->HL))
		{
			foreach ($this->response->StoryMLResponse->STORYML->HL as $item)
			{
				$retval .=  $this->getItemContent($item);
			}
		}
		else
		{
			$retval .= $this->getItemContent($this->response->StoryMLResponse->STORYML->HL);
		}
		
		return $retval;
	}
	
	private function getItemContent($item)
	{
		$retval = '<table width="100%" class="bordered"><thead>' .
					'<b>' .	$item->HT . '</b><br/>' . $item->RT . '</thead>' .
					'<tr><td>' . $item->TE . '</td></tr>' .
					'<tr><td>' . $this->getHeadlineContent($item) . '</td></tr>';
		
		$retval .= '</table><br/>';
		return $retval;
	}

	private function getHeadlineContent($headline)
	{
		$retval = '<table width="100%" class="bordered">' .
					'<tr><td>Unique ID:</td><td>' . $headline->ID . '</td></tr>' . 
					'<tr><td>Revision Number:</td><td>' . $headline->RE . '</td></tr>' . 
					'<tr><td>Status:</td><td>' . $headline->ST . '</td></tr>' . 
					'<tr><td>Creation Time:</td><td>' . $headline->CT . '</td></tr>' . 
					'<tr><td>Revision Time:</td><td>' . $headline->RT . '</td></tr>' . 
					'<tr><td>Local Time:</td><td>' . $headline->LT . '</td></tr>' . 
					'<tr><td>Provider:</td><td>' . $headline->PR . '</td></tr>' . 
					'<tr><td>Attribution:</td><td>' . $headline->AT . '</td></tr>' . 
					'<tr><td>Urgency:</td><td>' . $headline->UR . '</td></tr>' . 
					'<tr><td>Language:</td><td>' . $headline->LN . '</td></tr>' . 
					'<tr><td>Type:</td><td>' . $headline->TY . '</td></tr>' . 
					'<tr><td>PE Values</td><td>' . $headline->PE . '</td></tr>' .
					'<tr><td>Topics:</td><td>' . $headline->TO . '</td></tr>' .  
					'<tr><td>Companies:</td><td>' . $headline->CO . '</td></tr>' . 
					'<tr><td>Take Number:</td><td>' . $headline->TN . '</td></tr>' .
					'<tr><td>Products:</td><td>' . $headline->PD . '</td></tr>' .
					'</table>';
		return $retval;
	}
}