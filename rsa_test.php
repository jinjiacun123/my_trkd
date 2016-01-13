<?php
include "KeyWorker.php";
use Cn\Ubingo\Security\RSA\Core as core;
use Cn\Ubingo\Security\RSA\Data as data;

/*PEM TEST*/
/*
$publicWorker = new data\KeyWorker("-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCZw5tyBNJsjgVrPkLUIWF9el5E
OXL1AydVBnJ/WWPKTZJBWYxudW+1jI5ifML+1DkCxw/2QLowzViV1OLnpNAWr7zv
LpN6i7OZtq0o2Yfc+vv6vCctTpMvFartRRwDeXTRBgoGd71UwWgdMOu8Gmr9sv5u
3C9Kj5fhj0I4WgB94wIDAQAB
-----END PUBLIC KEY-----",core\KeyFormat::PEM);
*/
$publicWorker = new data\KeyWorker("-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDbLmw+Q6PVkkVJhFxD7WX7Ni0M
iBezh8+8R1tkbRVm8UbPKAO8bh8Ttpnhg4UcdQ5axQDyhcqmKZRuCPH/cDuiRKn2
BnLoydu0BH/0XVfzRDD3UrOhKP5OnNLXi9/VTedbqDFj1lOuQ31E8QnT4uYYoniY
X/YX+AQ93BuhBXroCQIDAQAB
-----END PUBLIC KEY-----",core\KeyFormat::PEM);
echo $publicWorker->encrypt("你好！中国");
/*
$privateWorker = new data\KeyWorker("-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAJnDm3IE0myOBWs+
QtQhYX16XkQ5cvUDJ1UGcn9ZY8pNkkFZjG51b7WMjmJ8wv7UOQLHD/ZAujDNWJXU
4uek0BavvO8uk3qLs5m2rSjZh9z6+/q8Jy1Oky8Vqu1FHAN5dNEGCgZ3vVTBaB0w
67waav2y/m7cL0qPl+GPQjhaAH3jAgMBAAECgYA6ANHYlv0RuhlNNTVcdCMkhE6f
CdTVnBTwO/hhFcVRASYUxMT2vhIfuB/WAx5DpqbC53ib+hrCYhPyoVXe8AsWjgBJ
cj3RHxjLMou0Jbu6mTjcLgKzMYM85yHscmmDcc8l/ep9BhbiJJsTVM8RqqXfdPmY
5CAgfwsNXruC7Zb5wQJBAMxVZhR+IzoeYLsmEciy2oOaTq5u8O6yjx7RapIggIKT
dRU5G2GeCyLRHyZH/+U2/nL3undiP74fxizatzgTE3ECQQDApNKzaMobPW23wRes
E+dDjJxYnqVqOmZS22D6s+BKwDmHpOt+oJmrirY4LWmOUwUfgAboDWH5y/q5+qJH
P5STAkEAux+F4UR2nDXPnfPKG4L3K8f3QDUm/WGWQcHEF9gd9/Z0JaBrm+TxC8x4
+0S6ar4HHWASalwWRdWxVchiO770cQJAGaEUAxhq4wreIPdIffU77Em1tziMC0Dv
whA7q77olSlTvg8b4YHeT+spaPnptCypXtJ6mL7HDSOtHLcSheYYjwJBAJFdK3vg
ZS0Sk4oy6iOaOcux+5uBkpF9ran0GIpehyGzia+F1Xf/+NnS22qER/ADvRMNnyHf
QH24qWxQuST39UQ=
-----END PRIVATE KEY-----",core\KeyFormat::PEM);


echo $publicWorker->decrypt($privateWorker->encrypt("你好！世界"));
echo $privateWorker->decrypt($publicWorker->encrypt("你好！中国"));
*/

/*ASN TEST*/
/*
$publicWorker = new data\KeyWorker("MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCZw5tyBNJsjgVrPkLUIWF9el5EOXL1AydVBnJ/WWPKTZJBWYxudW+1jI5ifML+1DkCxw/2QLowzViV1OLnpNAWr7zvLpN6i7OZtq0o2Yfc+vv6vCctTpMvFartRRwDeXTRBgoGd71UwWgdMOu8Gmr9sv5u3C9Kj5fhj0I4WgB94wIDAQAB",core\KeyFormat::ASN);
$privateWorker = new data\KeyWorker("MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAJnDm3IE0myOBWs+QtQhYX16XkQ5cvUDJ1UGcn9ZY8pNkkFZjG51b7WMjmJ8wv7UOQLHD/ZAujDNWJXU4uek0BavvO8uk3qLs5m2rSjZh9z6+/q8Jy1Oky8Vqu1FHAN5dNEGCgZ3vVTBaB0w67waav2y/m7cL0qPl+GPQjhaAH3jAgMBAAECgYA6ANHYlv0RuhlNNTVcdCMkhE6fCdTVnBTwO/hhFcVRASYUxMT2vhIfuB/WAx5DpqbC53ib+hrCYhPyoVXe8AsWjgBJcj3RHxjLMou0Jbu6mTjcLgKzMYM85yHscmmDcc8l/ep9BhbiJJsTVM8RqqXfdPmY5CAgfwsNXruC7Zb5wQJBAMxVZhR+IzoeYLsmEciy2oOaTq5u8O6yjx7RapIggIKTdRU5G2GeCyLRHyZH/+U2/nL3undiP74fxizatzgTE3ECQQDApNKzaMobPW23wResE+dDjJxYnqVqOmZS22D6s+BKwDmHpOt+oJmrirY4LWmOUwUfgAboDWH5y/q5+qJHP5STAkEAux+F4UR2nDXPnfPKG4L3K8f3QDUm/WGWQcHEF9gd9/Z0JaBrm+TxC8x4+0S6ar4HHWASalwWRdWxVchiO770cQJAGaEUAxhq4wreIPdIffU77Em1tziMC0DvwhA7q77olSlTvg8b4YHeT+spaPnptCypXtJ6mL7HDSOtHLcSheYYjwJBAJFdK3vgZS0Sk4oy6iOaOcux+5uBkpF9ran0GIpehyGzia+F1Xf/+NnS22qER/ADvRMNnyHfQH24qWxQuST39UQ=",core\KeyFormat::ASN);

echo $publicWorker->decrypt($privateWorker->encrypt("你好！世界"));
echo $privateWorker->decrypt($publicWorker->encrypt("你好！中国"));
*/
?>