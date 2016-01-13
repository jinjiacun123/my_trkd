<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_News1_GetNewsTopics1Response extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$retval= '<hr/>';

		if (is_array($this->response->topics->group))
		{
			foreach ($this->response->topics->group as $group)
			{
				$retval .=  $this->getGroupContent($group);
			}
		}
		else
		{
			$retval .= $this->getGroupContent($this->response->topics->group);
		}

		return $retval;
	}
	
	private function getGroupContent($group)
	{
		$retval = '';

		if (is_array($group->topic))
		{
			foreach ($group->topic as $topic)
			{
				$retval .=  $this->getTopicContent($topic);
			}
		}
		else
		{
			$retval .= $this->getTopicContent($group->topic);
		}

		return $retval;
	}
	
	private function getTopicContent($topic)
	{
		$retval = '<table width="100%" class="bordered"><thead><b>' . $topic->code . '</b></thead>';
		
		if (is_array($topic->Description))
		{
			foreach ($topic->Description as $description)
			{
				$retval .=  '<tr><td>' . $description->_ . '</td></tr>';
			}
		}
		else
		{
			$retval .=  '<tr><td>' . $topic->Description->_ . '</td></tr>';
		}
		
		$retval .= '</table><br/>';
		
		return $retval;
	}
}
