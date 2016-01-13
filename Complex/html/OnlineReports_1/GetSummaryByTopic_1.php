<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>OnlineReports_1/GetSummaryByTopic_1 Sample</h1>
<table>
<tr>
	<td>Topic<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="topic" value="<?php echo isset($_POST['topic']) ? $_POST['topic'] : 'OLUSBUS'?>"/>&nbsp;
		<input type="button" onclick="document.all['topic'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['topic'].value = 'OLUSBUS'" value="Default" />
	</td>
</tr>
<tr>
	<td>Max Count:</td>
	<td>
		<input type="text" name="maxCount" value="<?php echo isset($_POST['maxCount']) ? $_POST['maxCount'] : ''?>"/>&nbsp;
		<input type="button" onclick="document.all['maxCount'].value = ''" value="Clear" />
	</td>
</tr>
<tr>
<td></td><td><input type="submit" /></td>
</tr>
</table>
<?php
if (isset($_POST['topic']) && isset($_POST['maxCount']))
{
	$requestor = new WebServices_OnlineReports1_GetSummaryByTopic1();
	$requestor->setTopic($_POST['topic']);
	$requestor->setMaxCount($_POST['maxCount']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_OnlineReports1_GetSummaryByTopic1GetSummaryByStories1Response($response);
	echo $view->getHTML();
}
?>