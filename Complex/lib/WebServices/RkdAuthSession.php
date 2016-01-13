<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.

/**
 * Singleton class that stores the current TRKD API authorization session credentials as well as
 * the token used to authorize web-service operations.
 */
class WebServices_RkdAuthSession
{
	const THIS_ID = "RkdAuthSession";
	const EXPIRED_TOKEN_MESSAGE = "Token expired";
	const MAX_ATTEMPTS = 2;

	private $appId;
	private $serviceUserName;
	private $password;
	private $effectiveUserName;
	private $userType;
	private $token;

	private static $instance;

	private function __construct()
	{
	}

	/**
	 * Gets the instance of <tt>WebServices_RkdAuthSession</tt>.
	 */
	public static function getInstance()
	{		 
		if (!isset($_SESSION[self::THIS_ID])) {
			$_SESSION[self::THIS_ID] = new self();
		}

		return $_SESSION[self::THIS_ID];
	}
	
	/**
	 * Destroys the instance of <tt>WebServices_RkdAuthSession</tt>.
	 */
	public static function destroy()
	{
		$_SESSION[self::THIS_ID] = null;
	}

	public function __clone()
	{
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
	
	/**
	 * Executes the request with the specified operation object.
	 * 
	 * @param WebServices_IRkdApiOperation $operation the operation object that runs an authorized request
	 * to TRKD API.
	 * @return the response to the request.
	 */
	public function execute(WebServices_IRkdApiOperation $operation)
	{
		if (!isset($this->appId) || !isset($this->token))
		{
			throw new RuntimeException('You have to authorize first! Use CreateServiceToken_1 for authorization.');
		}
		
		for($i = 0; $i < self::MAX_ATTEMPTS; $i++)
		{
			try
			{
				return $operation->runAuthorized($this->appId, $this->token);
			}
			catch(Exception $ex)
			{
				if(stripos($ex->getMessage(), self::EXPIRED_TOKEN_MESSAGE) === false) {
					throw $ex;
				}
			}
			$this->createServiceToken0();
		}
		
		throw new Exception("Max refresh token attempts exceeded.");
	}

	/**
	 * Creates a new service token using specified credentials. 
	 *
	 * @param string $appId the Application ID.
	 * @param string $serviceUserName the Service User username.
	 * @param string $password the Service User password.
	 * @return the response from the CreateServiceToken_1 operation.
	 */
	public function createServiceToken($appId, $serviceUserName, $password)
	{
		$this->appId = $appId;
		$this->serviceUserName = $serviceUserName;
		$this->password = $password;

		return $this->createServiceToken0();
	}

	/**
	 * Creates a new impersonation token using specified credentials. 
	 *
	 * @param string $effectiveUserName the Effective User username.
	 * @param string $userType the Effective User type.
	 * @return the response from the CreateImpersonationToken_1 operation.
	 */
	public function createImpersonationToken($effectiveUserName, $userType)
	{
		$this->effectiveUserName = $effectiveUserName;
		$this->userType = $userType;

		return $this->createImpersonationToken0();
	}
	
	/**
	 * Gets the token used in this session to authorize web-service operations.
	 * 
	 * @return the authorization token in a form of byte array.
	 */
	public function getToken()
	{
		return $this->token;
	}
	
	/**
	 * Gets the Application ID used in this session to authorize web-service operations.
	 * 
	 * @return the Application ID string.
	 */
	public function getApplicationId()
	{
		return $this->appId;
	}
	
	/**
	 * Gets the hexademical representation of the token used in this session
	 * to authorize web-service operations.
	 * 
	 * @return the authorization token in a form of string.
	 */
	public function getTokenHex()
	{
		return bin2hex($this->token);
	}

	private function createServiceToken0()
	{
		$requestor = new WebServices_TokenManagement1_CreateServiceToken1();
		$requestor->setUsername($this->serviceUserName);
		$requestor->setApplicationId($this->appId);
		$requestor->setPassword($this->password);

		$response = $requestor->run();
		$this->token = $response->Token;
		return $response;
	}

	private function createImpersonationToken0()
	{
		$requestor = new WebServices_TokenManagement1_CreateImpersonationToken1();
		$requestor->setEffectiveUsername($this->effectiveUserName);
		$requestor->setUserType($this->userType);

		$response = $this->execute($requestor);
		$this->token = $response->Token;
		return $response;
	}
}