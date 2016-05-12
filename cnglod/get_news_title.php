    <?php  
    date_default_timezone_set("PRC");
    set_time_limit(1800);
    include_once("./config.php");
    include_once('./lib/lib.php');    //引用PHP XML操作类  
    include_once('./ini_file.php');
    #include_once('./lib/lib_xml.php');    //引用PHP XML操作类  
    $xml_url = 'data/news/tmp.xml';
    $xml = file_get_contents($xml_url);    //读取XML文件  
    //$xml = file_get_contents("php://input");    //读取POST过来的输入流  
    #$data=XML_unserialize($xml); 
    $reader = new XMLReader();
$reader->open($xml_url, 'utf-8');
while ($reader->read()) {
    if($reader->nodeType == XMLReader::ELEMENT){   
                    $nodeName = $reader->name;   
            }   
            if($reader->nodeType == XMLReader::TEXT && !empty($nodeName)){   
                   $id = '';
                   $to = '';
                    switch($nodeName){   
                            case 'ID':
                                $value = $reader->value;
                                #echo $value;
                                #echo "\n";
                                $id = $value;
                                $list['id'][] = $id;
                                break;   
                            case 'TO':
                                $value = $reader->value;
                                #echo $value;
                                #echo "\n";
                                $to = $value;
                                $list['to'][] = $to;
                                break;   
                } 
        }   
}
$reader->close();

#检查是否提交了


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
   # $list = $data['s:Envelope']['s:Body']['ns0:RetrieveHeadlineML_Response_1']['ns0:HeadlineMLResponse']['ns0:HEADLINEML']['HL'];
    
    #print_r($list);
    
    /*f(is_array($list[0]))
    {
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
    }*/    
    
    foreach($list['id'] as $k=>$v)
    {
        $re_list[] = array(
                'id'=>$v,
                'to'=>$list['to'][$k],
            );
    }
    unset($k, $v);

    #print_r($re_list);
    

    #print_r($re_list);


    #映射分类
    $category_list = include_once('./lib/topic-category.php');
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
    $appid = APPID;

    foreach($re_list as $k=>$v)
    {        
    	$news_id = $v['id'];

        //检查Ini文件是否存在
        ##存在就跳过，写入
        $cur_date = date('Y-m-d');
        $is_have = ini_file(null, 'default', $news_id);
        if('' == $is_have)
        {
            ini_file(null, 'default', $news_id, $cur_date);
        }
        else
        {
            continue;
        }


	    #$news_id = 'urn:newsml:reuters.com:20160105:nL3T14P02B';
	    $tmp_content = get_news_content($appid, $token, $news_id);
        file_put_contents("./data/news/content.xml", $tmp_content);
	    #获取HT-标题
	    #    TE-内容
	    #$format_content =  XML_unserialize($tmp_content);
	    #print_r($format_content);

	    /*$title = $format_content['s:Envelope']['s:Body']['ns0:RetrieveStoryML_Response_1']['ns0:StoryMLResponse']['ns0:STORYML']['HL']['HT'];
	    $content = $format_content['s:Envelope']['s:Body']['ns0:RetrieveStoryML_Response_1']['ns0:StoryMLResponse']['ns0:STORYML']['HL']['TE'];	
	    $re_list[$k]['title'] = $title;
	    $re_list[$k]['content'] = htmlspecialchars($content);*/
        $tmp_content_url = "./data/news/content.xml";
        $reader = new XMLReader();
        $reader->open($tmp_content_url, 'utf-8');
        while ($reader->read()) {
            if($reader->nodeType == XMLReader::ELEMENT){   
                            $nodeName = $reader->name;   
                    }   
                    if($reader->nodeType == XMLReader::TEXT && !empty($nodeName)){   
                           $ht = '';
                           $te = '';
                            switch($nodeName){   
                                    case 'HT':
                                        $ht = $reader->value;
                                        $list['ht'][] = $ht;
                                        break;   
                                    case 'TE':
                                        $te = $reader->value;
                                        $list['te'][] = $te;
                                        break;   
                        } 
                }   
        }
        $reader->close();
        break;
    }

    #print_r($list);
    
    #die;
    include(dirname(__FILE__).'/post_data.php');
    foreach($list['ht'] as $k=>$v)
    {
    	#print_r(post_news($v['title'], $v['classname']));
        echo '<br/>';
        print_r(post_long_news($list['ht'][$k], $list['te'][$k]));
    }
    ?>  