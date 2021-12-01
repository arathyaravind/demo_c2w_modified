<?php
function highlight($text, $words) {
	if(trim($_REQUEST['q'])) {
		preg_match_all('~\w+~', $words, $m);
		if(!$m)
			return $text;
		//$re = '~(?i)(?<=|^)'.implode('|',$m[0]).'|'.implode('|',$m[0]).'\w+(?=|$)~';
		$re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
		//$re = '~(?i)(?<=|^)\b'.implode('\b|\b',$m[0]).'\b|\b'.implode('\b|\b',$m[0]).'\b\w+(?=|$)~';
		//$re = '~(?i)(?<=|^)\s'.implode('\b|\b',$m[0]).'\b|\b'.implode('\b|\b',$m[0]).'\s\w+(?=|$)~';
		return preg_replace($re, "<span class='keyword-style'>$0</span>", $text);
	} else {
		return $text;
	}
}
?>