<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_Charts1_GetChart2 extends WebServices_AuthorizedSoapRequestorAbstract
{
	private $symbol1;

	private $symbol2;

	private $rangeFirst;

	private $rangeLast;

	private $theme;

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::validate()
	 */
	protected function validate()
	{
		if (empty($this->symbol1))
		{
			return 'The Symbol 1 value is not specified.';
		}
		if (empty($this->symbol2))
		{
			return 'The Symbol 2 value is not specified.';
		}
		if (empty($this->rangeFirst))
		{
			return 'The Range First value is not specified.';
		}
		if (empty($this->rangeLast))
		{
			return 'The Range Last value is not specified.';
		}

		return parent::validate();
	}

	public function setSymbol1($value)
	{
		$this->symbol1 = $value;
	}

	public function setSymbol2($value)
	{
		$this->symbol2 = $value;
	}

	public function setRangeFirst($value)
	{
		$this->rangeFirst = $value;
	}

	public function setRangeLast($value)
	{
		$this->rangeLast = $value;
	}

	public function setTheme($value)
	{
		$this->theme = $value;
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'Charts_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'GetChart_2';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$retval = $this->getTemplateRequest();

		$retval['chartRequest']['TimeSeries']['TimeSeriesRequest'][0]['Symbol'] = $this->symbol1;
		$retval['chartRequest']['TimeSeries']['TimeSeriesRequest'][1]['Symbol'] = $this->symbol2;
		
		$retval['chartRequest']['StandardTemplate']['XAxis']['Range'] = array(
			'Fixed' => array (
				'First' => $this->rangeFirst,
				'Last' => $this->rangeLast
			)
		);

		return $retval;
	}

	private function getTemplateRequest()
	{
		$doc = simplexml_load_file(RESOURCES_PATH . $this->theme . '.xml');
		$retval = $this->deserialize($doc);
		return $retval;
	}

	private function deserialize($root)
	{
		$array = array();
		$arrayLikeChildren = array();
		
		foreach ($root as $child)
		{
			foreach ($root->attributes() as $attribute => $value)
			{
				$array[$attribute] = $value;
			}

			if (count($child->children()) == 0)
			{
				$value = (string) $child;
				if ($value == 'true')
				{
					$array[$child->getName()] = true;
				} else if ($value == 'false')
				{
					$array[$child->getName()] = false;
				} else
				{
					$array[$child->getName()] = $value;
				}
			}
			else
			{
				if (array_key_exists($child->getName(), $array))
				{
					$childValue = $array[$child->getName()];
					if (!in_array($child->getName(), $arrayLikeChildren))
					{
						$childValue = array($childValue);
						$arrayLikeChildren[] = $child->getName();
					}
					$childValue[] = $this->deserialize($child);
					$array[$child->getName()] = $childValue;	
				} else
				{
					$array[$child->getName()] = $this->deserialize($child);	
				}
			}
		}
		return $array;
	}
}
