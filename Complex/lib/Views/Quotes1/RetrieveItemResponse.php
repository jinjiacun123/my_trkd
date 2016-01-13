<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_Quotes1_RetrieveItemResponse extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$retval = '<hr/>';
		foreach ($this->response->ItemResponse as $items)
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
		$retval = '<table class="bordered">' .
					'<thead>' .
					'<b>' .	$item->RequestKey->Name . '</b> - ' . $item->Status->StatusMsg . '<br/>' .
					'Timeliness:&nbsp;' . $item->QoS->TimelinessInfo->Timeliness . ',&nbsp;' . $item->QoS->TimelinessInfo->TimeInfo . '&nbsp;|&nbsp;Rate:&nbsp;' . $item->QoS->RateInfo->Rate . ',&nbsp;' .	$item->QoS->RateInfo->TimeInfo .
					'</thead>' . 
					'<tr><th width="20%">Field</th><th>Value</th><th width="20%">Data type</th></tr>';
		foreach ($item->Fields as $fields)
		{
			foreach ($fields as $field)
			{
				$retval .= '<tr><td>' . $field->Name . '</td><td>';
				switch ($field->DataType)
				{
					case 'Binary':
						{
							$retval .= $field->Binary;
							break;
						}
					case 'Date':
						{
							$retval .= $field->Date;
							break;
						}
					case 'DateTime':
						{
							$retval .= $field->DateTime;
							break;
						}
					case 'Float':
						{
							$retval .= $field->Float;
							break;
						}
					case 'Double':
						{
							$retval .= $field->Double;
							break;
						}
					case 'Time':
						{
							$retval .= $field->Time;
							break;
						}
					case 'Int8':
						{
							$retval .= $field->Int8;
							break;
						}
					case 'Int16':
						{
							$retval .= $field->Int16;
							break;
						}
					case 'Int32':
						{
							$retval .= $field->Int32;
							break;
						}
					case 'Int64':
						{
							$retval .= $field->Int64;
							break;
						}
					case 'UInt8':
						{
							$retval .= $field->UInt8;
							break;
						}
					case 'UInt16':
						{
							$retval .= $field->UInt16;
							break;
						}
					case 'UInt32':
						{
							$retval .= $field->UInt32;
							break;
						}
					case 'UInt64':
						{
							$retval .= $field->UInt64;
							break;
						}
					case 'Utf8String':
						{
							$retval .= $field->Utf8String;
							break;
						}
				}
				$retval .= '</td><td>' . $field->DataType . '</td></tr>';
			}
		}
		$retval .= '</table><br/>';
		
		return $retval;
	}
}
