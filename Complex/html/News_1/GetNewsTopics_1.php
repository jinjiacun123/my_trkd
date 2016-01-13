<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>News_1/GetNewsTopics_1 Sample</h1>
<h2>There are no input parameters required for this request.<br/>Click Submit to post the request.</h2>
<input type="hidden" name="submit" value="1"><br/>
<input type="submit" />
<?php
if (isset($_POST['submit']))
{
	$response = WebServices_RkdAuthSession::getInstance()->execute(new WebServices_News1_GetNewsTopics1());

	$view = new Views_News1_GetNewsTopics1Response($response);
	echo $view->getHTML();
}
?>