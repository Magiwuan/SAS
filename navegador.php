<?php
include('browser_class_inc.php');
$br = new browser();

$br->whatBrowser();
$version = $br->version; 
$navegador = $br->browsertype;
$platform = $br->platform;

echo ''.$navegador.' </br>';
echo ''.$version.' </br>';
echo ''.$platform.' </br>';

?>