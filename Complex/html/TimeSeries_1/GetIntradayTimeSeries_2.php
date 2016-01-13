<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
?>
<h1>TimeSeries_1/GetIntradayTimeSeries_2 Sample</h1>
<table>
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
			<option value="MINUTE" <?php if (isset($_POST['interval']) && $_POST['interval'] == 'MINUTE') { echo 'selected'; } ?> >Minute</option>
			<option value="5MINUTES" <?php if (isset($_POST['interval']) && $_POST['interval'] == '5MINUTES') { echo 'selected'; } ?> >5 minutes</option>
			<option value="30MINUTES" <?php if (isset($_POST['interval']) && $_POST['interval'] == '30MINUTES') { echo 'selected'; } ?> >30 minutes</option>
			<option value="HOUR" <?php if (isset($_POST['interval']) && $_POST['interval'] == 'HOUR') { echo 'selected'; } ?> >Hour</option>
		</select>  
	</td>
</tr>
<tr>
	<td>
	    <input type="radio" name="mode" id="date1" value="latest" <?php if (!isset($_POST['mode']) || (isset($_POST['mode']) && $_POST['mode'] == 'latest')) { echo 'checked'; } ?>/><label for="date1">Latest day</label>
	</td>
	<td/>
</tr>
<tr>
	<td>
	    <input type="radio" name="mode" id="date2" value="day" <?php if (isset($_POST['mode']) && $_POST['mode'] == 'day') { echo 'checked'; } ?>/><label for="date2">Certain day:</label>
	</td>
	<td>
		<select name="day">
			<option value="0" <?php if (isset($_POST['day']) && $_POST['day'] == 'Today') { echo 'selected'; } ?> >Today</option>
			<option value="1" <?php if (isset($_POST['day']) && $_POST['day'] == 'Yesterday') { echo 'selected'; } ?> >Yesterday</option>
			<option value="2" <?php if (isset($_POST['day']) && $_POST['day'] == 'Two days') { echo 'selected'; } ?> >Two days</option>
			<option value="3" <?php if (isset($_POST['day']) && $_POST['day'] == 'Three days') { echo 'selected'; } ?> >Three days</option>
			<option value="4" <?php if (isset($_POST['day']) && $_POST['day'] == 'Four days') { echo 'selected'; } ?> >Four days</option>
			<option value="5" <?php if (isset($_POST['day']) && $_POST['day'] == 'Five days') { echo 'selected'; } ?> >Five days</option>
		</select>
		Time zone:&nbsp;<input type="text" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''?>" /> 
	</td>
</tr>
<tr>
	<td>
	    <input type="radio" name="mode" id="date3" value="custom" <?php if (isset($_POST['mode']) && $_POST['mode'] == 'custom') { echo 'checked'; } ?>/><label for="date3">Custom date:</label>
	</td>
	<td>
		<input type="text" name="startTime" value="<?php echo isset($_POST['startTime']) ? $_POST['startTime'] : substr_replace(date(DATE_ISO8601, time() - 60*60*24*7), '', -5)?>"/>&nbsp;
		<input type="button" onclick="document.all['startTime'].value = ''" value="Clear" />&nbsp;
		<input type="button" onclick="document.all['startTime'].value = '<?php echo substr_replace(date(DATE_ISO8601, time() - 60*60*24*7), '', -5)?>'" value="Default" /><br/>
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
if (isset($_POST['interval']) && isset($_POST['symbol']) && isset($_POST['mode']))
{
	$requestor = new WebServices_TimeSeries1_GetIntradayTimeSeries2();
	$requestor->setSymbol($_POST['symbol']);
	$requestor->setInterval($_POST['interval']);
	$requestor->setDay($_POST['day']);
	$requestor->setTimezone($_POST['timezone']);
	$requestor->setStartTime($_POST['startTime']);
	$requestor->setEndTime($_POST['endTime']);
	$requestor->setMode($_POST['mode']);
	$response = WebServices_RkdAuthSession::getInstance()->execute($requestor);
	

 	$view = new Views_TimeSeries1_GetIntradayTimeSeries2Response($response);
 	echo $view->getHTML();
}
?>