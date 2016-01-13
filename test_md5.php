<?php
$mobile = "cngold手机号15802158055huanrong";
echo md5($mobile);
echo "\n";
echo substr(md5($mobile),8,16); 