<?php
// Denna sats sparar en cookie med vald layout i 1 �r.
if(isset($_REQUEST["SETSTYLE"])){
 if(setcookie("testcookie",true)){
  setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400);
 }else{
  $_SESSION["STYLE"]=$_REQUEST["SETSTYLE"];
 }
}

// �terv�nder till sidan som kallade p� detta PHP.
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>