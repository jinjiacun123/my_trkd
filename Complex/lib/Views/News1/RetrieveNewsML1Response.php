<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_News1_RetrieveNewsML1Response extends Views_ResponseViewAbstract
{
	public function getHTML()
	{
		$retval = '<hr/>' .
					'<h2>NewsMLResponse - ' . $this->response->NewsMLResponse->Status->StatusMsg . '</h2>';
		
		if (is_array($this->response->NewsMLResponse->Story))
		{
			foreach ($this->response->NewsMLResponse->Story as $item)
			{
				$retval .=  $this->getItemContent($item);
			}
		}
		else
		{
			$retval .= $this->getItemContent($this->response->NewsMLResponse->Story);
		}
		
		return $retval;
	}
	
	private function getItemContent($item)
	{
		return '<div class="bordered">' . $item . '</div><br/>';
	}
}