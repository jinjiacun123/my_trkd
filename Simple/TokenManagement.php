<?php
//The TRKD API sample code is provided for informational purposes only
//and without knowledge or assumptions of the end users development environment.
//We offer this code to provide developers practical and useful guidance while developing their own code.
//However, we do not offer support and troubleshooting of issues that are related to the use of this code
//in a particular environment; it is offered solely as sample code for guidance.
//Please see the Thomson Reuters Knowledge Direct product page at http://customers.thomsonreuters.com
//for additional information regarding the TRKD API.
ini_set("soap.wsdl_cache_enabled", 0);
#http://api.trkd.thomsonreuters.com/
#$client = new SoapClient("http://api.rkd.reuters.com/schemas/wsdl/TokenManagement/TokenManagement_1_HttpsAndAnonymous.wsdl", array('soap_version' => SOAP_1_2));
$client = new SoapClient("http://api.trkd.thomsonreuters.com/schemas/wsdl/TokenManagement/TokenManagement_1_HttpsAndAnonymous.wsdl", array('soap_version' => SOAP_1_2));
#$client = new SoapClient("http://api.rkd.reuters.com/schemas/wsdl/TokenManagement_1_HttpsAndAnonymous.wsdl", array('soap_version' => SOAP_1_2));
$createTokenRequest = array(
   'ApplicationID' => 'YolandaCngoldComCn',
   'Username' => 'yolanda@cngold.com.cn',
   'Password' => 'cngold2016'
);
$wsAddressingHeaders = array(
      new SoapHeader('http://www.w3.org/2005/08/addressing', 'To', 'https://api.rkd.reuters.com/api/2006/05/01/TokenManagement_1.svc/Anonymous'),
      new SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://www.reuters.com/ns/2006/05/01/webservices/rkd/TokenManagement_1/CreateServiceToken_1')
);
try
{
      $createTokenResponse = $client->__soapCall('CreateServiceToken_1', array('parameters' => $createTokenRequest), null, $wsAddressingHeaders);
?>
      <table>
            <thead>Token received</thead>
            <tr>
                  <td>Token:</td>
                  <td><?php echo bin2hex($createTokenResponse->Token); ?></td>
            </tr>
            <tr>
                  <td>Expiration:</td>
                  <td><?php echo $createTokenResponse->Expiration; ?></td>
            </tr>
<?php
} catch (SoapFault $e) {
    echo "<span style='color:red'>Error occured: " . $e->getMessage() . "</span>";
}
?>