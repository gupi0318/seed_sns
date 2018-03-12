<?php
	// issetと!emptyの関係について
	//空文字、文字列の0、数字の0、nullではない値
$i='';
$ii='0';
$iii=0;
$iiii=null;

if (!empty($i)){
echo '$i';

}

if (!empty($ii)){
	echo '$ii';

}

if (!empty($iii)){
    echo '$iii';
}

if (!empty($iiii)){
   echo '$iiii';
}
?>