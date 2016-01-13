<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>News_1/RetrieveNewsML_1 Sample</h1>
<table>
<tr>
	<td>Time Out:</td>
	<td>
		<input type="text" name="timeOut" value="<?php echo isset($_POST['timeOut']) ? $_POST['timeOut'] : ''?>"/>&nbsp;
		<input type="button" onclick="document.all['timeOut'].value = ''" value="Clear" />
	</td>
</tr>
<tr>
	<td>Story IDs<span class="mandatory">*</span><br/><span class="note">(place each story ID on a new line)</span>:</td>
	<td>
	<textarea name="storyIDs" rows="7" cols="60"><?php echo isset($_POST['storyIDs']) ? $_POST['storyIDs'] : ''?></textarea><br/>
	<input type="button" onclick="document.all['storyIDs'].value = ''" value="Clear" /><br/>
	</td>
</tr>
<tr>
<td></td><td><input type="submit" /></td>
</tr>
</table>
<?php
if (isset($_POST['storyIDs']) && isset($_POST['timeOut']))
{
	$requestor = new WebServices_News1_RetrieveNewsML1();
	$requestor->setStoryIDs($_POST['storyIDs']);
	$requestor->setTimeOut($_POST['timeOut']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_News1_RetrieveNewsML1Response($response);
	echo $view->getHTML();
}
?>