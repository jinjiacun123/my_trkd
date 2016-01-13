<?php
/* Step1:初始化SoapClient对象 */
$wcfURL = 'http://192.168.1.248:8355/PictureService.asmx?wsdl';
$wcfClient = new SoapClient ( $wcfURL );
$fp = fopen("./images/1.JPG","r");
$result = $wcfClient->UploadImg($fp);
print_r ( $result );
echo '<br>';
#print_r($result->GetResult);
