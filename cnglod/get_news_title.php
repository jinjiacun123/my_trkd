    <?php  
    set_time_limit(1800);
    include_once('./lib/lib.php');    //引用PHP XML操作类  
    include_once('./lib/lib_xml.php');    //引用PHP XML操作类  
    $xml = file_get_contents('data/news/tmp.xml');    //读取XML文件  
    //$xml = file_get_contents("php://input");    //读取POST过来的输入流  
    $data=XML_unserialize($xml);  

    /**
    * id
    * to
    */
    $re_list = array();
    /*
    * title
    * content
    * classname
    */
    $news_list = array();

    
    #print_r($data);    
    $list = $data['s:Envelope']['s:Body']['ns0:RetrieveHeadlineML_Response_1']['ns0:HeadlineMLResponse']['ns0:HEADLINEML']['HL'];
    #print_r($list);
    $rows = count($list);
    for($index = 0; $index<$rows/2;$index++)
    {
    	$to = $list[$index]['TO'];
    	$id = $list[$index]['ID'];
    	$re_list[] = array(
    		'id'=>$id,
    		'to'=>$to,
    	);
    }
    #print_r($re_list);
    

    #print_r($re_list);
    

    #映射分类
    $category_list = include_once('lib/topic-category.php');
    foreach($re_list as $k=>$v)
    {
    	$to = $v['to'];
    	$topic_list = explode(' ', $to);
    	foreach($topic_list as $sv)
    	{
    		if(isset($category_list[$sv]))
    		{
    			$re_list[$k]['classname'] = $category_list[$sv];
    			break;
    		}
    	}
    }
    #print_r($re_list);

    #获取token
    $token = file_get_contents('token.txt');
    $appid = 'trkddemoappwm';

    foreach($re_list as $k=>$v)
    {
    	$news_id = $v['id'];
	    #$news_id = 'urn:newsml:reuters.com:20160105:nL3T14P02B';
	    $tmp_content = get_news_content($appid, $token, $news_id);

	    #获取HT-标题
	    #    TE-内容
	    $format_content =  XML_unserialize($tmp_content);
	    #print_r($format_content);

	    $title = $format_content['s:Envelope']['s:Body']['ns0:RetrieveStoryML_Response_1']['ns0:StoryMLResponse']['ns0:STORYML']['HL']['HT'];
	    $content = $format_content['s:Envelope']['s:Body']['ns0:RetrieveStoryML_Response_1']['ns0:StoryMLResponse']['ns0:STORYML']['HL']['TE'];	
	    $re_list[$k]['title'] = $title;
	    $re_list[$k]['content'] = htmlspecialchars($content);
    }

    #print_r($re_list);
    
    include(dirname(__FILE__).'/post_data.php');
    foreach($re_list as $v)
    {
    	print_r(post_news($v['title'], $v['classname']));
    }
    ?>  