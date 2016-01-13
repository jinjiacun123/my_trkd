<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<div class="floatingList">
	Consolidated FIDs:
	<ul>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_ASK:'">CF_ASK</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_BID:'">CF_BID</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_CLOSE:'">CF_CLOSE</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_DATE:'">CF_DATE</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_EXCHNG:'">CF_EXCHNG</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_HIGH:'">CF_HIGH</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_LAST:'">CF_LAST</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_NETCHNG:'">CF_NETCHNG</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_SOURCE:'">CF_SOURCE</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_TICK:'">CF_TICK</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_TIME:'">CF_TIME</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_VOLUME:'">CF_VOLUME</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_YIELD:'">CF_YIELD</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_CURRENCY:'">CF_CURRENCY</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_NAME:'">CF_NAME</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_SRC_PAGE:'">CF_SRC_PAGE</a></li>
		<li><a href="#" onclick="document.all['fids'].value += 'CF_LOTSIZE:'">CF_LOTSIZE</a></li>
	</ul>
</div>
<h1>Quotes_1/RetieveItem_2 Sample</h1>
<table>
<tr>
	<td>RICs<span class="mandatory">*</span> <span class="note">(use colon as a separator)</span>:</td>
	<td>
		<input type="text" name="rics" value="<?php echo isset($_POST['rics']) ? $_POST['rics'] : 'MSFT.O'?>"/>&nbsp;
		<input type="button" onclick="document.all['rics'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['rics'].value = 'MSFT.O'" value="Default" />
	</td>
</tr>
<tr>
	<td>Fields <span class="note">(use colon as a separator)</span>:</td>
	<td>
		<input type="text" name="fids" value="<?php echo isset($_POST['fids']) ? $_POST['fids'] : ''?>"/>&nbsp;
		<input type="button" onclick="document.all['fids'].value = ''" value="Clear" /></td>
</tr>
<tr>
<td></td><td><input type="submit" /></td>
</tr>
</table>
<?php
if (isset($_POST['rics']) && isset($_POST['fids']))
{
	$requestor = new WebServices_Quotes1_RetrieveItem2();
	$requestor->setRics($_POST['rics']);
	$requestor->setFids($_POST['fids']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_Quotes1_RetrieveItemResponse($response);
	echo $view->getHTML();
}
?>