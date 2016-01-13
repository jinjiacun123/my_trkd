    <?php  
    include('./lib/lib_xml.php');    //引用PHP XML操作类  
    $xml = file_get_contents('./Simple/1.log');    //读取XML文件  
    //$xml = file_get_contents("php://input");    //读取POST过来的输入流  
    $data=XML_unserialize($xml);  
    echo '<pre>';  
    #print_r($data);
    echo '</pre>';  
    ?>  