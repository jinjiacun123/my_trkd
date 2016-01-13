<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_Searchall1_GetSearchallResponse extends Views_ResponseViewAbstract
{
	/**
	* @see lib/Views/Views_ResponseViewAbstract::getHTML()
	*/
	public function getHTML()
	{
		$retval = '<hr/>';
		
		if (isset($this->response->Result->Hit))
		{
			if (is_array($this->response->Result->Hit))
			{
				foreach ($this->response->Result->Hit as $item)
				{
					$retval .=  $this->getItemContent($item);
				}
			} else
			{
				$retval .= $this->getItemContent($this->response->Result->Hit);
			}

		} else
		{
			$retval .= "No records found.";
		}
		
		
	
		return $retval;
	}
	
	private function getItemContent($item)
	{		
		$retval = '<table class="bordered" width="80%">' .
						'<thead>' .	'<tr><th colspan="2">' .	
							$item->DocumentTitle->Value. //UseEnglishOnly = true has ensured that there's only one item in the list of titles
						'</th><tr>' . '</thead>';
		
		if (isset($item->BusinessEntity))
		{
			$retval .= '<tr><td width="35%">Business Entity</td><td>' . $item->BusinessEntity . '</td></tr>';
		}
		
		if (isset($item->PI))
		{
			$retval .= '<tr><td width="35%">PI</td><td>' . $item->PI . '</td></tr>';
		}
		
		if (isset($item->AssetCategory))
		{
			$retval .= '<tr><td width="35%">Asset Category</td><td>' . $item->AssetCategory . '</td></tr>';
		}

		if (isset($item->ExchangeCode))
		{
			$retval .= '<tr><td width="35%">Exchange Code</td><td>' . $item->ExchangeCode . '</td></tr>';
		}
		
		$retval .= '</table><br/>';
		return $retval;
	}
}