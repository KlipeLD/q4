<?php
$result = revertCharacters("Привет! Давно не виделись.");
echo $result; // Тевирп! Онвад ен ьсиледив.
echo"<br>=======<br>";
$result = revertCharacters("Привет, ДавНо не виделись.");
echo $result; 
echo"<br>=======<br>";
$result = revertCharacters(" Привет. Давно не виделись.");
echo $result; 
echo"<br>=======<br>";

function revertCharacters($text)
{
	$keywords = preg_split("/[\s,!.()]+/", $text, -1, PREG_SPLIT_OFFSET_CAPTURE);
	$arr = [];
	$str = '';
	for ($i=0;$i<count($keywords);$i=$i+1)
	{
		$arr[$i] = '';
		$char_array = str_split_unicode($keywords[$i][0]);
		for($j=0;$j<count($char_array);$j=$j+1)
		{
			$numb_n = count($char_array)-$j-1;
			$chr = mb_substr ($char_array[$j], 0, 1, 'utf-8');
			if( mb_strtolower($chr, 'utf-8') != $chr ) 
			{
				$arr[$i] = $arr[$i].mb_strtoupper($char_array[$numb_n]);
			} else 
			{
				$arr[$i] = $arr[$i].mb_strtolower($char_array[$numb_n]);
			}
		}
		if($keywords[$i][1] == (strlen($str)))
		{
			$str = $str.$arr[$i];
		}
		else
		{
			$count_temp = $keywords[$i][1] - (strlen($str));
			$str = $str.substr($text, strlen($str), $count_temp);
			$str = $str.$arr[$i];
		}
	}
	return $str;
}

function str_split_unicode($str, $l = 0) 
{
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}