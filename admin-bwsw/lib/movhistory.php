<?php
function regMovimiento($link, $operacion){
    $host=gethostname();
	date_default_timezone_set('Mexico/General');
	$ip = getRealIP();
	$date=new DateTime(); //this returns the current date time
	$fecha = $date->format('Y-m-j G:i:s');
	$username= $_SESSION["session_username"];	
$sql="INSERT INTO movhistorytbl(id,username,host,operacion) VALUES ('$fecha','$username','$ip','$operacion')";
echo $sql;
$link->query($sql);
}

function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}
?>