<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.


class Views_TimeSeries1_GetTimezoneList1Response extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{		
		$retval = '<table class="bordered"><thead><td width="7%"><b>Short Name<b></td><td width="30%"><b>Long Name<b></td>' .
			'<td width="7%"><b>GMT Offset<b></td><td width="7%"><b>Has Summer Time<b></td width="7%"><td  width="7%"><b>Summer Offset<b></td>' .
			'<td width="23%"><b>Summer Start<b></td><td><b>Summer End<b></td></thead>';
		$i = 1;
		
		foreach ($this->response->TimezoneList->Timezone as $timezone)
		{
			$retval .= '<tr><td>' . $timezone->ShortName . '</td>' .
				'<td>' . $timezone->LongName . '</td>' .
				'<td>' . $timezone->GMTOffset . '</td>' .
				'<td>' . ($timezone->HasSummerTime ? 'Yes' : 'No') . '</td>';
			
			if ($timezone->HasSummerTime === true)
			{
				$retval .= '<td>' . $timezone->SummerOffset . '</td>' .
					'<td>' . $timezone->SummerStart . '</td>' .
					'<td>' . $timezone->SummerEnd . '</td></tr>';
			}
		}
		
		$retval .= '</table>';
		
		return $retval;
	}
}