<?php
/* Step1:初始化SoapClient对象 */
$wcfURL = 'http://192.168.1.248:86/LightService.svc?wsdl';
$wcfClient = new SoapClient ( $wcfURL );

/*
$body->idSpecified        = True;
$body->Type               = 0;
$body->UpdateTime         ='0';
$body->SyncTime           ='0';
$body->News_Content       ='内容';
$body->News_Important     =1;
$body->News_ReferUrl      ='';
$body->News_VideoUrl      ='';
$body->News_ImageUrl      ='';
$body->News_Effect        ='';
$body->Finance_Time       ='0';
$body->Finance_Name       ='';
$body->Finance_Before     =0;
$body->Finance_Prediction =0;
$body->Finance_Result     =0;
$body->Finance_Rank       =0;
$body->Finance_Effect     =0;
$body->Finance_Country    ='中国';
$body->Icon               ='中国';
$body->CreatorID          =0;
$body->CreatorNickname    ='';
$body->CreatorUsername    ='';
$body->EditorID        =0;
$body->EditorUsername  ='';
$body->EditorNickname  ='';
$body->IsTop           =0;
$body->ClassName       ='央行动态';
$body->Reading         ='';
$body->Tag             ='';
*/

#$result = $wcfClient->AddNews($body);
#$result = $wcfClient->Get($body);
$params = array(
	'Type'               =>  0,
	'UpdateTime'         => '0',
	'SyncTime'           => '0',
	'News_Content'       => '内容',
	'News_Important'     => 1,
	'News_ReferUrl'      => '',
	'News_VideoUrl'      => '',
	'News_ImageUrl'      => '',
	'News_Effect'        => '',
	'Finance_Time'       => '0',
	'Finance_Name'       => '',
	'Finance_Before'     => 0,
	'Finance_Prediction' => 0,
	'Finance_Result'     => 0,
	'Finance_Rank'       => 0,
	'Finance_Effect'     => 0,
	'Finance_Country'    => '中国',
	'Icon'               => '中国',
	'CreatorID'          => 0,
	'CreatorNickname'    => '',
	'CreatorUsername'    => '',
	'EditorID'           =>  0,
	'EditorUsername'     => '',
	'EditorNickname'     =>'',
	'IsTop'              =>0,
	'ClassName'          =>'央行动态',
	'Reading'            =>'',
	'Tag'                =>'',
);
#$result = $wcfClient->__soapCall('Get',array('parameters'=>$params));
$result = $wcfClient->__soapCall('Add',array('parameters'=>$params));
print_r ( $result );
echo '<br>';
#print_r($result->AddNewsResult);
