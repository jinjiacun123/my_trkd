<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_Searchall1_GetSearchall1 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $search;

	private $exchangeCodes;
	
	private $assetCategoryCodes;
        
        private $useUnentitledAccess;

	public function setSearch($value)
	{
		$this->search = $value;
	}

	public function setExchangeCodes($value)
	{
		$this->exchangeCodes = $value;
	}

	public function setAssetCategoryCodes($value)
	{
		$this->assetCategoryCodes = $value;
	}
        
        public function setUnentitledAccess($value)
	{
		$this->useUnentitledAccess = ($value == 'true');
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'Searchall_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'GetSearchall_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$retval = new WebServices_Searchall1_GetSearchallRequest1();
		
		$filter = new WebServices_Searchall1_SearchallQuerySpec1();
		
		$exchangeCodesExp = new WebServices_Searchall1_StringExpression();
		$exchangeCodesExp->StringValue = $this->getArrayOfStringValues($this->exchangeCodes);
		
		$assetCategoryCodesExp = new WebServices_Searchall1_NavigableStringExpression();
		$assetCategoryCodesExp->StringValue = $this->getArrayOfStringValues($this->assetCategoryCodes);
				
		$filter->ExchangeCode  = $exchangeCodesExp;
		$filter->AssetCategory = $assetCategoryCodesExp;
		
		$query = new WebServices_Searchall1_SearchallQuerySpec1();
		
		$string = new WebServices_Searchall1_StringValue();
		$string->Value = $this->search;
		$string->Negated = false;
		$search = new WebServices_Searchall1_StringExpression();
		$search->StringValue = $string;
		
		$query->Search = $search;
	
		$retval->Filter = $filter;
		$retval->Query = $query;
		//with this option enabled only document title in English will be returned
		//otherwise response contains titles in all available languages (e.g. Chinese, Japanese, etc.)
		$retval->UseEnglishOnly = true; 
		
                $retval->UnentitledAccess = $this->useUnentitledAccess;
		return $retval;
	}

	private function getArrayOfStringValues($value)
	{
		$retval = array();
		
		$codes = explode(PHP_EOL, $value);
		foreach ($codes as $code)
		{
			$string = new WebServices_Searchall1_StringValue();
			$string->Value = $code;
			$string->Negated = false;
			
			$retval[] = $string;
		}
		
		return $retval;
	}	
}
