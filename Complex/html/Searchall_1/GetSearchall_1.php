<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>Searchall_1/GetSearchall_1 Sample</h1>
<table>
<tr>
	<td>Search for:</td>
	<td>
		<input type="text" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : 'Microsoft'?>"/>&nbsp;
		<input type="button" onclick="document.all['search'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['search'].value = 'Microsoft'" value="Default" />
	</td>
</tr>
<tr>
	<td>Filter by</td><td/>
</tr>
<tr>
	<td>Asset Category Code<br/><span class="note">(place each Asset Category Code on a new line)</span>:</td>
	<td>
		<textarea name="assetCategoryCodes" rows="7" cols="60"><?php echo isset($_POST['assetCategoryCode']) ? $_POST['assetCategoryCode'] : ''?>ORD</textarea><br/>
		<input type="button" onclick="document.all['assetCategoryCode'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['assetCategoryCode'].value = 'ORD'" value="Default" />
	</td>
</tr>
<tr>
	<td>Exchange Code<br/><span class="note">(place each Exchange Code on a new line)</span>:</td>
	<td>

		<textarea name="exchangeCodes" rows="7" cols="60"><?php echo isset($_POST['exchanges']) ? $_POST['exchanges'] : ''?>NSQ&#10;NYS</textarea><br/>
		<input type="button" onclick="document.all['exchanges'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['exchanges'].value = 'NSQ\nNYS'" value="Default" />

	</td>
</tr>
<tr>
	<td>Use unentitled access:</td>
	<td>
            <select name="useUnentitledAccess">  
		<option value="false" <?php if (isset($_POST['useUnentitledAccess']) && $_POST['useUnentitledAccess'] == 'false') { echo 'selected'; } ?> >No</option>
		<option value="true" <?php if (isset($_POST['useUnentitledAccess']) && $_POST['useUnentitledAccess'] == 'true') { echo 'selected'; } ?> >Yes</option>
            </select>  
	</td>
</tr>
<tr>
	<td/>
	<td><input type="submit" /></td>
</tr>
</table>

<?php
if (isset($_POST['assetCategoryCodes']) && isset($_POST['exchangeCodes']) && isset($_POST['search']) && isset($_POST['useUnentitledAccess']))
{
	$requestor = new WebServices_Searchall1_GetSearchall1();
	$requestor->setAssetCategoryCodes($_POST['assetCategoryCodes']);
	$requestor->setExchangeCodes($_POST['exchangeCodes']);
	$requestor->setSearch($_POST['search']);
        $requestor->setUnentitledAccess($_POST['useUnentitledAccess']);
	
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_Searchall1_GetSearchallResponse($response);
	echo $view->getHTML();
}
?>