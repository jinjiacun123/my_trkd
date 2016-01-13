<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

class WebServices_TokenManagement1_CreateServiceToken1
	extends WebServices_SoapRequestorAbstract
{
	private $applicationId;

	private $username;

	private $password;
	
	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbstract::run()
	 */
	public function run()
	{
		return parent::run();
	}
	
	public function setUsername($value)
	{
		$this->username	= $value;
	}
	
	public function setApplicationId($value)
	{
		$this->applicationId = $value;
	}
	
	public function setPassword($value)
	{
		$this->password	= $value;
	}
	
	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::validate()
	 */
	protected function validate()
	{
		if (empty($this->username))
		{
			return 'The username is not specified.';
		}
		if (empty($this->applicationId))
		{
			return 'The application ID is not specified.';
		}
		if (empty($this->password))
		{
			return 'The password is not specified.';
		}
		
		return parent::validate();
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getWebServiceName()
	 */
	protected function getWebServiceName()
	{
		return 'TokenManagement_1';
	}

	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getOperationName()
	 */
	protected function getOperationName()
	{
		return 'CreateServiceToken_1';
	}
	
	/**
	 * @see lib/WebServices/WebServices_SoapRequestorAbsract::getRequest()
	 */
	protected function getRequest()
	{
		$retval = new WebServices_TokenManagement1_CreateServiceToken1Request();
		$retval->ApplicationID = $this->applicationId;
		$retval->Username = $this->username;
		$retval->Password = $this->password;
		return $retval;
	}

}