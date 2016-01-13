<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_OnlineReports1_GetHeadlines2Response extends Views_ResponseViewAbstract
{
	/**
	* @see lib/Views/Views_ResponseViewAbstract::getHTML()
	*/
	public function getHTML()
	{
		$retval = '';
	
		foreach ($this->response->Story as $items)
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
		$retval = '<hr/><div width="100%"><b>Headlines:</b><br><br/>';
		
		if (is_array($item->HL->T))
		{
			foreach ($item->HL->T as $t)
			{
				$retval .= $t . '<br/><br/>';
			}
		} else
		{
			$retval .= $item->HL->T . '<br/><br/>';
		}

		$retval .= '<table class="bordered" width="100%">'
					. '<tr><td><b>ID:</b></td><td>' . $item->ID . '</td></tr>'
					. '<tr><td><b>Story Date:</b></td><td>' . $item->StoryDate . '</td></tr>';
		
		
		if (isset($item->Thumbnail))
		{
			$retval .= '<tr><td><b>Thumbnail:</b></td><td>' . $item->Thumbnail . '</td></tr>';
		}
		
		if (isset($item->Img))
		{
			$retval .= '<tr valign="top"><td><b>Image:</b></td><td>' 
						. $item->Img->Ref . '<br/>'
						. '<b>Title:</b> ' . $item->Img->Title . '<br/>' 
						. '<b>Date:</b> ' . $item->Img->Date . '</td></tr>';
		}
		
		$retval .= '</table></div><br/>';
		
		return $retval;
	}
}