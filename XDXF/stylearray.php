<?php
$styleSheets = array();

// Här definieras mina länkar till mina olika css-filer
$styleSheets[0]["name"]='Purple';
$styleSheets[0]["sheet"]='<link href="xdxf.css" rel="stylesheet" type="text/css" />';

$styleSheets[1]["name"]='Green';
$styleSheets[1]["sheet"]='<link href="green.css" rel="stylesheet" type="text/css" />';

$styleSheets[2]["name"]='Orange';
$styleSheets[2]["sheet"]='<link href="orange.css" rel="stylesheet" type="text/css" />';

$styleSheets[3]["name"]='Blue';
$styleSheets[3]["sheet"]='<link href="blue.css" rel="stylesheet" type="text/css" />';

// Denna css-fil används om inget annat är satt.
$defaultStyleSheet=0;

// Denna sats sätter vilket stylesheet som skall användas.
if(!isset($_COOKIE["STYLE"])){
 if(isset($_SESSION["STYLE"])){
  echo $styleSheets[$_SESSION["STYLE"]]["sheet"];
 }else{
  echo $styleSheets[$defaultStyleSheet]["sheet"];
 }
}else{
 echo $styleSheets[$_COOKIE["STYLE"]]["sheet"];
}
?>