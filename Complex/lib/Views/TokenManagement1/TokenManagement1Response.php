<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class Views_TokenManagement1_TokenManagement1Response extends Views_ResponseViewAbstract
{
	/**
	 * @see lib/Views/Views_ResponseViewAbstract::getHTML()
	 */
	public function getHTML()
	{
		$config = Config::getConfig();
		$retval = '<hr/><h2>Token was created successfully:<br />' . 
					WebServices_RkdAuthSession::getInstance()->getTokenHex() .
					'</h2><b>Expires (UTC)</b>:' . date(DATE_RFC822, strtotime($this->response->Expiration));
		
		return $retval;
	}
}