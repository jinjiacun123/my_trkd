<?PHP
//QQ 344512179

//�÷� ini_file(�ļ���,ini����,����key , ��ֵ)

//��ѯʱ ��ֵ ���ջ���Ϊnull,�������ؼ�ֵ
//����ini��������ini������Ϊnull  ini���� ������[ ]

//��ѯ
//echo ini_file('abc.ini','sectionA','key1');
//�����Ӧ�ļ�ֵ ��123ds


//��ӻ����
/*
if(ini_file('abc.ini','sectionA','key1','bnmv')
echo "�ɹ���ӻ��޸�";
else
echo "����ʧ��";

*/

function ini_file($inifilename,$mode=null,$key,$value=null) {
	$inifilename = $inifilename==null ? 'Application.ini':$inifilename;
	$key = $key==null ? 'user' : $key;
	if(!file_exists($inifilename))
		return null;

	$confarr = parse_ini_file($inifilename,true);
	$newini="";
	if($mode!=null)
	{
		if($value==null)
 		{
 			return @$confarr[$mode][$key]==null ? null : $confarr[$mode][$key];
 		}
		else
 		{
 			$YNedit = @$confarr[$mode][$key]==$value ? false : true;
			@$confarr[$mode][$key]=$value;
  		}
	}
	else
	{
		if($value==null)
 		{
 			return @$confarr[$key]==null ? null : $confarr[$key];
 		}
		else
  		{
  			$YNedit = @$confarr[$key]==$value ? false : true;
			@$confarr[$key]==$value;
			$newini=$newini.$key."=".$value."\r\n";
  		}
	}
	if(!$YNedit)
		return true;



	$Mname=array_keys($confarr);
	$jshu=0;

	foreach ($confarr as $k => $v)
	{
		if(!is_array($v))
		{
			$newini=$newini.$Mname[$jshu]."=".$v."\r\n";$jshu += 1;
		}
		else
		{
			$newini=$newini.'['.$Mname[$jshu]."]\r\n";
			$jshu += 1;
			$jieM=array_keys($v);
			$jieS=0;
			foreach ($v as $k2 => $v2)
 			{
 				 $newini=$newini.$jieM[$jieS]."=".$v2."\r\n";$jieS += 1;
 			}
		}
		  
	}

	if ( ($fi = fopen($inifilename,"w")) )
	{
		flock($fi, LOCK_EX);//������
		fwrite($fi, $newini);
		flock($fi, LOCK_UN);                        
		fclose($fi); 
		return true;                               
	}

	return false;
}

#echo ini_file(null,'default','user');
#echo ini_file(null,'default','user11');
#echo date('Y-m-d');
?>

