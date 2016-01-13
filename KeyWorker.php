<?php
namespace Cn\Ubingo\Security\RSA\Data;

include "KeyFormat.php";
use Cn\Ubingo\Security\RSA\Core as core;
/*
 陈服建(fochen,j@ubingo.cn)
 2015-01-23
 */
class KeyWorker{
	
	private $key;
	private $isPrivate;
	private $keyFormat;
	private $keyProvider;
	
	function __construct($key,$keyFormat=core\KeyFormat::PEM){
		
		$this->KeyWorker($key,$keyFormat);
	}

	function KeyWorker($key,$keyFormat=core\KeyFormat::PEM)
	{
		$this->key = $key;
		$this->keyFormat = $keyFormat;
	}

	function encrypt($data){
		$this->_makesure_provider();

		if($this->isPrivate){
			$r= openssl_private_encrypt($data,$encrypted,$this->keyProvider,OPENSSL_PKCS1_PADDING);
		}
		else{
			$r= openssl_public_encrypt($data,$encrypted,$this->keyProvider,OPENSSL_PKCS1_PADDING);
		}

		return $r?$data = base64_encode($encrypted):null;
	}
	
	function decrypt($data){
		$this->_makesure_provider();
		$data = base64_decode($data);
		if($this->isPrivate){
			$r= openssl_private_decrypt($data,$decrypted,$this->keyProvider,OPENSSL_PKCS1_PADDING);
		}
		else{
			$r= openssl_public_decrypt($data,$decrypted,$this->keyProvider,OPENSSL_PKCS1_PADDING);
		}

		return $r?$decrypted:null;
	}

	function _makesure_provider(){
	    if($this->keyProvider==null){
    	    $this->isPrivate = strlen($this->key)>500;
    	    
    		switch($this->keyFormat){
    			case core\KeyFormat::ASN:{
    			    
    				$this->key = chunk_split($this->key,64,"\r\n");//转换为pem格式的公钥
    				if($this->isPrivate){
    				    $this->key = "-----BEGIN PRIVATE KEY-----\r\n".$this->key."-----END PRIVATE KEY-----";
    				}
    				else{
    				    $this->key = "-----BEGIN PUBLIC KEY-----\r\n".$this->key."-----END PUBLIC KEY-----";
    				}
    				
    				break;
    			}
    		}
    
    		$this->keyProvider = $this->isPrivate?openssl_pkey_get_private($this->key):openssl_pkey_get_public($this->key);
	    }
	}
}
?>