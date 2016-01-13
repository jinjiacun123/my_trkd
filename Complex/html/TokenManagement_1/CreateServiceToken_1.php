<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>TokenManagement_1/CreateServiceToken_1 Sample</h1>
<table>
<tr>
<td>Service User Name<span class="mandatory">*</span>:</td><td><input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''?>" /></td>
</tr>
<tr>
<td>Application ID<span class="mandatory">*</span>:</td><td><input type="text" name="applicationId" value="<?php echo isset($_POST['applicationId']) ? $_POST['applicationId'] : ''?>" /></td>
</tr>
<tr>
<td>Password<span class="mandatory">*</span>:</td><td><input type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''?>" /></td>
</tr>
<tr>
<td></td><td><input type="submit" /> <input type="button" value="Fast Login" onclick="document.all['fast'].value = true; submit();"/></td>
</tr>
</table>
<input type="hidden" name="fast" />
<span class="note">Note: Fast Login tries to retrieve the credentials from <i>config.php</i>. If not applicable then uses the form values from this page. This option has been added for the sake of faster debugging. Don't store your credentials in a config file unsecured in the production environment.</span>
<?php
if (isset($_POST['fast']) && $_POST['fast'] == true)
{
	$config = Config::getConfig();
	if (!empty($config['credentials']['serviceUserName']))
	{
		$_POST['username'] = $config['credentials']['serviceUserName'];
	}
	if (!empty($config['credentials']['applicationId']))
	{
		$_POST['applicationId'] = $config['credentials']['applicationId'];
	}
	if (!empty($config['credentials']['password']))
	{
		$_POST['password'] = $config['credentials']['password'];
	}
}
if (isset($_POST['username']) && isset($_POST['applicationId']) && isset($_POST['password']))
{
	$response = WebServices_RkdAuthSession::getInstance()->createServiceToken($_POST['applicationId'], $_POST['username'], $_POST['password']);

	$view = new Views_TokenManagement1_TokenManagement1Response($response);
	echo $view->getHTML();
}
?>