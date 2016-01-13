<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>OnlineReports_1/GetHeadlines_2 Sample</h1>
<table>
<tr>
	<td>Echange<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="exchange" value="<?php echo isset($_POST['exchange']) ? $_POST['exchange'] : 'NSQ'?>"/>&nbsp;
		<input type="button" onclick="document.all['exchange'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['exchange'].value = 'NSQ'" value="Default" />
	</td>
</tr>
<tr>
<td></td><td><input type="submit" /></td>
</tr>
</table>
<?php
if (isset($_POST['exchange']))
{
	$requestor = new WebServices_TimeSeries1_GetExchangeData1();
	$requestor->setExchange($_POST['exchange']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_TimeSeries1_GetExchangeData1Response($response);
	echo $view->getHTML();
}
?>