<?php
//写ini文件
function write_ini_file($assoc_arr, $path, $has_sections=FALSE)
{
    $content = "";
    if ($has_sections)
    {
        foreach ($assoc_arr as $key=>$elem)
        {
            $content .= "[".$key."]\n";
            foreach ($elem as $key2=>$elem2)
            {
                if(is_array($elem2))
                {
                    for($i=0;$i<count($elem2);$i++)
                    {
                        $content .= $key2."[] = \"".$elem2[$i]."\"\n";
                    }
                }
                else if($elem2=="") $content .= $key2." = \n";
                else $content .= $key2." = \"".$elem2."\"\n";
            }
        }
    }
    else
    {
        foreach ($assoc_arr as $key=>$elem)
        {
            if(is_array($elem))
            {
                for($i=0;$i<count($elem);$i++)
                {
                    $content .= $key2."[] = \"".$elem[$i]."\"\n";
                }
            }
            else if($elem=="") $content .= $key2." = \n";
            else $content .= $key2." = \"".$elem."\"\n";
        }
    }
    if (!$handle = fopen($path, 'w'))
    {
        return false;
    }
    if (!fwrite($handle, $content))
    {
        return false;
    }
    fclose($handle);
    return true;
}
//读ini文件
function readini($name)
{
    if (file_exists(SEM_PATH.'init/'.$name))
    {
        $data = parse_ini_file(SEM_PATH.'init/'.$name,true);
        if ($data)
        {
        return $data;
        }
    }
    else
    {
        return false;
    }
}
//用法
//
$sampleData = array(
                'first' => array(
                    'first-1' => 1,
                    'first-2' => 2,
                    'first-3' => 3,
                    'first-4' => 4,
                    'first-5' => 5,
                ),
                'second' => array(
                    'second-1' => 1,
                    'second-2' => 2,
                    'second-3' => 3,
                    'second-4' => 4,
                    'second-5' => 5,
                ));
write_ini_file($sampleData, './data.ini', true);