<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>OnlineReports_1/GetSummaryByStories_1 Sample</h1>
Story IDs<span class="mandatory">*</span> <span class="note">(place each story ID on a new line)</span>:<br/>
<textarea name="storyIDs" rows="7" cols="60"><?php echo isset($_POST['storyIDs']) ? $_POST['storyIDs'] : ''?></textarea><br/>
<input type="button" onclick="document.all['storyIDs'].value = ''" value="Clear" /><br/>
<input type="submit" />
<?php
if (isset($_POST['storyIDs']))
{
	$requestor = new WebServices_OnlineReports1_GetSummaryByStories1();
	$requestor->setStoryIDs($_POST['storyIDs']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_OnlineReports1_GetSummaryByTopic1GetSummaryByStories1Response($response);
	echo $view->getHTML();
}
?>
