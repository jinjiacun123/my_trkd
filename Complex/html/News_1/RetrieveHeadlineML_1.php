<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>News_1/RetrieveHeadlineML_1 Sample</h1>
<table>
<tr>
	<td>Time Out:</td>
	<td>
		<input type="text" name="timeOut" value="<?php echo isset($_POST['timeOut']) ? $_POST['timeOut'] : ''?>"/>&nbsp;
		<input type="button" onclick="document.all['timeOut'].value = ''" value="Clear" />
	</td>
</tr>
<tr>
	<td>Max Count:</td>
	<td>
		<input type="text" name="maxCount" value="<?php echo isset($_POST['maxCount']) ? $_POST['maxCount'] : '10'?>"/>&nbsp;
		<input type="button" onclick="document.all['maxCount'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['maxCount'].value = '10'" value="Default" />
	</td>
</tr>
<tr>
	<td>Start Time (UTC):</td>
	<td>
		<input type="text" name="startTime" value="<?php echo isset($_POST['startTime']) ? $_POST['startTime'] : substr_replace(date(DATE_ISO8601, time() - 60*60*24), '', -5)?>"/>&nbsp;
		<input type="button" onclick="document.all['startTime'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['startTime'].value = '<?php echo substr_replace(date(DATE_ISO8601, time() - 60*60*24), '', -5)?>'" value="Default" />
	</td>
</tr>
<tr>
	<td>End Time (UTC):</td>
	<td>
		<input type="text" name="endTime" value="<?php echo isset($_POST['endTime']) ? $_POST['endTime'] : substr_replace(date(DATE_ISO8601), '', -5)?>"/>&nbsp;
		<input type="button" onclick="document.all['endTime'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['endTime'].value = '<?php echo substr_replace(date(DATE_ISO8601), '', -5)?>'" value="Default" />
	</td>
</tr>
<tr>
<td></td><td><input type="submit" /></td>
</tr>
</table>
<?php
if (isset($_POST['timeOut']) && isset($_POST['maxCount']) && isset($_POST['startTime']) && isset($_POST['endTime']))
{
	$requestor = new WebServices_News1_RetrieveHeadlineML1();
	$requestor->setTimeOut($_POST['timeOut']);
	$requestor->setMaxCount($_POST['maxCount']);
	$requestor->setStartTime($_POST['startTime']);
	$requestor->setEndTime($_POST['endTime']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_Shared_HeadlinesResponse($response);
	echo $view->getHTML();
}
?>