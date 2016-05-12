<?php
while(true)
{
	echo file_get_contents('http://localhost/sample_api/cnglod/NewsSample.php');
	echo file_get_contents('http://localhost/sample_api/cnglod/get_news_title.php');	
	sleep(10);
}
