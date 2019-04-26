<?php

//session_start();

$con = mysqli_connect("localhost","root","","events");

if ($_SERVER['REQUEST_METHOD']=='post')
{
if (!isset($_post['_token']) || ($_post['_token'] !== $_session['_token']))
{
die('invalid csrf token');
}
}
$_session['_token']=bin2hex(openssl_random_pseudo_bytes(16));

?>
