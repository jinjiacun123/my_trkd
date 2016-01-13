<html>
<head>
	<title>rsa</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<form method="post" action="">
<? if(isset($_POST['old'])){ ?>
<input type="text" name="old" value="<? echo $_POST['old']; ?>"/>
<? }else{ ?>
<input type="text" name="old" value=""/>
<? } ?>
<input type="submit" value="submit" name="submit"/>
</form>
</body>
</html>
<?php
/**
* User: xishizhaohua@qq.com
* Date: 14-11-29
* Time: 上午10:27
*/
if(isset($_POST['submit']) && $_POST['submit'])
{
	header("Content-type: text/html; charset=utf-8");      

	/**
	* 密钥文件的路径
	*/
	$privateKeyFilePath = 'rsa_private_key.pem';
	/**
	* 公钥文件的路径
	*/
	$publicKeyFilePath = 'rsa_public_key.pem';

	extension_loaded('openssl') or die('php需要openssl扩展支持');
	/*
	(file_exists($privateKeyFilePath) && file_exists($publicKeyFilePath))
	or die('密钥或者公钥的文件路径不正确');
	*/
	(file_exists($publicKeyFilePath))
	or die('密钥或者公钥的文件路径不正确');
	/**
	* 生成Resource类型的密钥，如果密钥文件内容被破坏，openssl_pkey_get_private函数返回false
	*/
	#$privateKey = openssl_pkey_get_private(file_get_contents($privateKeyFilePath));
	/**
	* 生成Resource类型的公钥，如果公钥文件内容被破坏，openssl_pkey_get_public函数返回false
	*/
	$publicKey = openssl_pkey_get_public(file_get_contents($publicKeyFilePath));
	#echo 'publicKey:';
	#var_dump($publicKey);

	#($privateKey && $publicKey) or die('密钥或者公钥不可用');
	($publicKey) or die('密钥或者公钥不可用');
	/**
	* 原数据
	*/
	$originalData = $_POST['old'];
	/**
	* 加密以后的数据，用于在网路上传输
	*/
	$encryptData = '';

	echo '原数据为:', $originalData, PHP_EOL;

	///////////////////////////////用私钥加密////////////////////////
	#if (openssl_private_encrypt($originalData, $encryptData, $publicKey)) {
	if (openssl_public_encrypt($originalData, $encryptData, $publicKey)) {

	    /**
	     * 加密后 可以base64_encode后方便在网址中传输 或者打印  否则打印为乱码
	     */
    	echo '加密成功，加密后数据(base64_encode后)为:', base64_encode($encryptData), PHP_EOL;

	} else {
    	die('加密失败');
	}

}
///////////////////////////////用公钥解密////////////////////////

/**
* 解密以后的数据
*/
/*
$decryptData ='';

if (openssl_public_decrypt($encryptData, $decryptData, $publicKey)) {

    echo '解密成功，解密后数据为:', $decryptData, PHP_EOL;

} else {
    die('解密成功');
}
*/
/*
c#
//转换成不同的格式
KeyPair asnKeyPair = keyPair.ToASNKeyPair();
KeyPair xmlKeyPair = asnKeyPair.ToXMLKeyPair();
KeyPair pemKeyPair = xmlKeyPair.ToPEMKeyPair();

java

//转换成不同的格式
KeyPair asnKeyPair = keyPair.toASNKeyPair();
KeyPair xmlKeyPair = asnKeyPair.toXMLKeyPair();
KeyPair pemKeyPair = xmlKeyPair.toPEMKeyPair();
*/