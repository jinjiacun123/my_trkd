<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>Charts_1/GetChart_2 Sample</h1>
<table>
<tr>
	<td>Symbol 1<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="symbol1" value="<?php echo isset($_POST['symbol1']) ? $_POST['symbol1'] : 'IBM.N'?>"/>&nbsp;
		<input type="button" onclick="document.all['symbol1'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['symbol1'].value = 'IBM.N'" value="Default" />
	</td>
</tr>
<tr>
	<td>Symbol 2<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="symbol2" value="<?php echo isset($_POST['symbol2']) ? $_POST['symbol2'] : '.DJI'?>"/>&nbsp;
		<input type="button" onclick="document.all['symbol2'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['symbol2'].value = '.DJI'" value="Default" />
	</td>
</tr>
<tr>
	<td>Range First (UTC)<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="rangeFirst" value="<?php echo isset($_POST['rangeFirst']) ? $_POST['rangeFirst'] : substr_replace(date(DATE_ISO8601, time() - 60*60*24*365), '', -5)?>"/>&nbsp;
		<input type="button" onclick="document.all['rangeFirst'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['rangeFirst'].value = '<?php echo substr_replace(date(DATE_ISO8601, time() - 60*60*24*365), '', -5)?>'" value="Default" />
	</td>
</tr>
<tr>
	<td>Range Last (UTC)<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="rangeLast" value="<?php echo isset($_POST['rangeLast']) ? $_POST['rangeLast'] : substr_replace(date(DATE_ISO8601), '', -5)?>"/>&nbsp;
		<input type="button" onclick="document.all['rangeLast'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['rangeLast'].value = '<?php echo substr_replace(date(DATE_ISO8601), '', -5)?>'" value="Default" />
	</td>
</tr>
<tr>
	<td>Theme:</td>
	<td>
		<select name="theme">  
			<option value="Simple" <?php if (isset($_POST['theme']) && $_POST['theme'] == 'Simple') { echo 'selected'; } ?> >Simple</option>
			<option value="Gradient" <?php if (isset($_POST['theme']) && $_POST['theme'] == 'Gradient') { echo 'selected'; } ?> >Gradient</option>
		</select>  
	</td>
</tr>
<tr>
<td></td><td><input type="submit" /></td>
</tr>
</table>
<?php
if (isset($_POST['symbol1']) && isset($_POST['symbol2']) && isset($_POST['rangeFirst']) && isset($_POST['rangeLast']) && isset($_POST['theme']))
{
	$requestor = new WebServices_Charts1_GetChart2();
	$requestor->setSymbol1($_POST['symbol1']);
	$requestor->setSymbol2($_POST['symbol2']);
	$requestor->setRangeFirst($_POST['rangeFirst']);
	$requestor->setRangeLast($_POST['rangeLast']);
	$requestor->setTheme($_POST['theme']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_Charts1_GetChart1Response($response);
	echo $view->getHTML();
}
?>
