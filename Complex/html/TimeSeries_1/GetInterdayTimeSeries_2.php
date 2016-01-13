<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>TimeSeries_1/GetInterdayTimeSeries_2 Sample</h1>
<table>
<tr>
<tr>
	<td>Symbol<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="symbol" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : 'MSFT.O'?>"/>&nbsp;
		<input type="button" onclick="document.all['symbol'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['symbol'].value = 'MSFT.O'" value="Default" />
	</td>
</tr>
<tr>
	<td>Interval<span class="mandatory">*</span>:</td>
	<td>
		<select name="interval">  
			<option value="DAILY" <?php if (isset($_POST['interval']) && $_POST['interval'] == 'DAILY') { echo 'selected'; } ?> >Daily</option>
			<option value="WEEKLY" <?php if (isset($_POST['interval']) && $_POST['interval'] == 'WEEKLY') { echo 'selected'; } ?> >Weekly</option>
			<option value="MONTHLY" <?php if (isset($_POST['interval']) && $_POST['interval'] == 'MONTHLY') { echo 'selected'; } ?> >Monthly</option>
		</select>  
	</td>
</tr>
<tr>
	<td>Start time<span class="mandatory">*</span>:</td>
	<td>
		<input type="text" name="startTime" value="<?php echo isset($_POST['startTime']) ? $_POST['startTime'] : substr_replace(date(DATE_ISO8601, time() - 60*60*24*365), '', -5)?>"/>&nbsp;
		<input type="button" onclick="document.all['startTime'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['startTime'].value = '<?php echo substr_replace(date(DATE_ISO8601, time() - 60*60*24*365), '', -5)?>'" value="Default" />
	</td>
</tr>
<tr>
	<td>End time<span class="mandatory">*</span>:</td>
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
if (isset($_POST['symbol']) && isset($_POST['interval']) && isset($_POST['startTime']) && isset($_POST['endTime']))
{
	$requestor = new WebServices_TimeSeries1_GetInterdayTimeSeries2();
	$requestor->setSymbol($_POST['symbol']);
	$requestor->setInterval($_POST['interval']);
	$requestor->setStartTime($_POST['startTime']);
	$requestor->setEndTime($_POST['endTime']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);

	$view = new Views_TimeSeries1_GetInterdayTimeSeries2Response($response);
	echo $view->getHTML();
}
?>