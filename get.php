    <?php
    $ch = curl_init("http://www.baidu.com") ;  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回  
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回  
    echo $output = curl_exec($ch) ;  
      
    /* 写入文件 */  
    $fh = fopen("out.html", 'w') ;  
    fwrite($fh, $output) ;  
    fclose($fh) ;   