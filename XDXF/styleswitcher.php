<?php
// Denna sats sparar en cookie med vald layout i 1 år.
if(isset($_REQUEST["SETSTYLE"])){
 if(setcookie("testcookie",true)){
  setcookie("STYLE",$_REQUEST["SETSTYLE"],time()+31622400);
 }else{
  $_SESSION["STYLE"]=$_REQUEST["SETSTYLE"];
 }
}

// Återvänder till sidan som kallade på detta PHP.
header("Location: ".$_SERVER["HTTP_REFERER"]);
?>