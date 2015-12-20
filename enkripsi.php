<?php
function vernam_enkripsi($plain, $key){
	$n = strlen($plain);
	for($i=0;$i<$n;$i++){
		$data[$i] = str_pad(decbin(ord($plain[$i])), 8, "0", STR_PAD_LEFT);
		$kunci[$i] = str_pad(decbin(ord($key[$i])), 8, "0", STR_PAD_LEFT);
		//echo 'biner data ='.str_pad(decbin(ord($plain[$i])), 8, "0", STR_PAD_LEFT).', biner kunci = '.str_pad(decbin(ord($key[$i])), 8, "0", STR_PAD_LEFT).' ';
		//opeasi xor
		for($j=0;$j<8;$j++){
			$hasil[$j] = ($data[$i][$j] + $kunci[$i][$j])%2;
		}
		
		$result[$i] = implode($hasil);
		//echo 'biner hasil = '.$result[$i];
		$chiper[$i] = chr(normalize(bindec($result[$i])));
		//echo ', biner chiper = '.$chiper[$i];

		//echo ' '.ord($plain[$i]).', key ='.ord($key[$i]).', hasil = '.bindec($result[$i]).', normalisasi ='.normalize(bindec($result[$i])).'<br/>';
	}
	$chiperKey = implode($chiper);
	return $chiperKey;
}

function normalize($dec){
	//return ($dec%94)+33;
	return ($dec%126)+33;
	//return $dec+33;
}

$plain = $_POST['plain_text'];
$key = $_POST['key'];
$chiper = vernam_enkripsi($plain, $key);
echo $chiper;
?>