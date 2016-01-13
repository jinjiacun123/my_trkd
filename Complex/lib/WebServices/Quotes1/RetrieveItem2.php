<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_Quotes1_RetrieveItem2 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $rics;

	private $fids;

	public function setRics($value)
	{
		$this->rics	= $value;
	}

	public function setFids($value)
	{
		$this->fids = $value;
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::validate()
	 */
	protected function validate()
	{
		if (empty($this->rics))
		{
			return 'The RIC value is not specified.';
		}

		return parent::validate();
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'Quotes_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'RetrieveItem_2';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$itemRequest = new WebServices_Quotes1_ItemRequest();
		$itemRequest->Fields = $this->fids;
		$itemRequest->Scope = empty($this->fids) ? 'All' : 'List';
		$requestKeyArray = array();
		foreach (explode(':', $this->rics) as $ric)
		{
			$requestKey = new WebServices_Quotes1_RequestKey();
			$requestKey->Name = $ric;
			$requestKeyArray[] = $requestKey;
		}
		$itemRequest->RequestKey = $requestKeyArray;
		$itemRequestArray[] = $itemRequest;
		$retval = new WebServices_Quotes1_RetrieveItemRequest();
		$retval->ItemRequest = $itemRequestArray;
		return $retval;
	}
}