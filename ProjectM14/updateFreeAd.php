<?php
include_once 'dbConfig.php';
include_once 'Advertisement.class.php';
session_start();
$refad = $_SESSION["refad"];
$desc = $_POST["ad_description"];
$refcat = $_POST["catid"];

$connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
$ad = new Advertisement();
$results = $ad->updateFreeAd($connection, $refad, $desc, $refcat);

if ($results!=0) 
{
    echo "Advertisement was updated successfully!";
}