<?php
function __re_rand($arr) {
	$res = array();
	$key = array_keys($arr);
	foreach($arr[$key[0]] as $v) $res[$key[0]][] = rand(1,6);
	return $res;
}

function __find_winner($arr,$arr2,$arr3,$arr4) {
	$key = array_keys($arr);
	$key2 = array_keys($arr2);
	$key3 = array_keys($arr3);
	$key4 = array_keys($arr4);

	$res = '';
	
	if (count($arr[$key[0]]) == 0) $res .= $key[0] . ' Win and ';
	if (count($arr2[$key2[0]]) == 0) $res .= $key2[0] . ' Win and ';
	if (count($arr3[$key3[0]]) == 0) $res .= $key3[0] . ' Win and ';
	if (count($arr4[$key4[0]]) == 0) $res .= $key4[0] . ' Win and ';
	
	return substr($res,0,-5);
}

function __check_done($arr,$arr2,$arr3,$arr4) {
	$key = array_keys($arr);
	$key2 = array_keys($arr2);
	$key3 = array_keys($arr3);
	$key4 = array_keys($arr4);
	
	if (count($arr[$key[0]]) > 0 && count($arr2[$key2[0]]) > 0 && count($arr3[$key3[0]]) > 0 && count($arr4[$key4[0]]) > 0) return false;
	return true;
}

function __find_dice_one($arr) {
	foreach($arr as $v) {
		if ($v == 1) return true;
	}
	return false;
}

function __array_remove($arr,$arr2,$arr3,$arr4,$round=1) {
	$res = array();
	$res2 = array();
	$res3 = array();
	$res4 = array();
	
	if ($round == 1) {
		echo '<h1>First Round, Before removed number 6 on top side.</h1>';
		var_dump($arr,$arr2,$arr3,$arr4);
		echo '<hr />';
	}
	
	$key = array_keys($arr);
	foreach($arr[$key[0]] as $v)
		if ($v !== 6) $res[$key[0]][] = $v;
		
	$key2 = array_keys($arr2);
	if (__find_dice_one($res[$key[0]])) $arr2[$key2[0]][] = rand(1,6);
	
	foreach($arr2[$key2[0]] as $v)
		if ($v !== 6) $res2[$key2[0]][] = $v;

	$key3 = array_keys($arr3);
	if (__find_dice_one($res2[$key2[0]])) $arr3[$key3[0]][] = rand(1,6);
	foreach($arr3[$key3[0]] as $v)
		if ($v !== 6) $res3[$key3[0]][] = $v;

	$key4 = array_keys($arr4);
	if (__find_dice_one($res3[$key3[0]])) $arr4[$key4[0]][] = rand(1,6);
	foreach($arr4[$key4[0]] as $v)
		if ($v !== 6) $res4[$key4[0]][] = $v;
		
	if (__find_dice_one($res4[$key4[0]])) $res[$key[0]][] = rand(1,6);
	echo '<h1>Round '.$round.'</h1>';
	$res = (count($res) > 0 ? $res : array($key[0] => array()));
	$res2 = (count($res2) > 0 ? $res2 : array($key2[0] => array()));
	$res3 = (count($res3) > 0 ? $res3 : array($key3[0] => array()));
	$res4 = (count($res4) > 0 ? $res4 : array($key4[0] => array()));
	
	var_dump(array($res,$res2,$res3,$res4));
	
	echo '<hr />';
	if (!__check_done($res,$res2,$res3,$res4)) {
		return __array_remove(__re_rand($res),__re_rand($res2),__re_rand($res3),__re_rand($res4),($round+1));
	}
	else {
		return __find_winner($res,$res2,$res3,$res4);
	}
}

$A = array('Player A' => array(rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6)));
$B = array('Player B' => array(rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6)));
$C = array('Player C' => array(rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6)));
$D = array('Player D' => array(rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6),rand(1,6)));
var_dump(__array_remove($A,$B,$C,$D,1));
