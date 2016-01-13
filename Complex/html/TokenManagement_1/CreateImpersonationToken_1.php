<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>TokenManagement_1/CreateImpersonationToken_1 Sample</h1>
<table>
<tr>
<td>Effective User Name<span class="mandatory">*</span>:</td><td><input type="text" name="effectiveUserName" value="<?php echo isset($_POST['effectiveUserName']) ? $_POST['effectiveUserName'] : ''?>" /></td>
</tr>
<tr>
<td>User Type<span class="mandatory">*</span>:</td>
<td>
	<select name="userType">  
		<option value="Unmanaged" <?php if (isset($_POST['userType']) && $_POST['userType'] == 'Unmanaged') { echo 'selected'; } ?> >Unmanaged</option>
		<option value="Reuters" <?php if (isset($_POST['userType']) && $_POST['userType'] == 'Reuters') { echo 'selected'; } ?> >Reuters</option>
	</select>  
</td>
</tr>
<tr>
<td></td><td><input type="submit" /> <input type="button" value="Fast Login" onclick="document.all['fast'].value = true; submit();" /></td>
</tr>
</table>
<input type="hidden" name="fast" />
<span class="note">Note: Fast Login tries to retrieve the credentials from <i>config.php</i>. If not applicable then uses the form values from this page.</span>
<?php
if (isset($_POST['fast']) && $_POST['fast'] == true)
{
	$config = Config::getConfig();
	if (!empty($config['credentials']['effectiveUserName']))
	{
		$_POST['effectiveUserName'] = $config['credentials']['effectiveUserName'];
	}
	if (!empty($config['credentials']['userType']))
	{
		$_POST['userType'] = $config['credentials']['userType'];
	}
}
if (isset($_POST['effectiveUserName']) && isset($_POST['userType']))
{
	$response = WebServices_RkdAuthSession::getInstance()->createImpersonationToken($_POST['effectiveUserName'], $_POST['userType']);

	$view = new Views_TokenManagement1_TokenManagement1Response($response);
	echo $view->getHTML();
}
?>