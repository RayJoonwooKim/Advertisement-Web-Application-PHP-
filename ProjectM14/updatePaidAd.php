<?php
include_once 'dbConfig.php';
include_once 'Advertisement.class.php';
session_start();
$refad = $_SESSION["refad"];
$desc = $_POST["ad_description"];
$refcat = $_POST["catid"];
$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

$connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
$ad = new Advertisement();
$results = $ad->updatePaidAd($connection, $refad, $desc, $refcat);
$results2 = $ad->updateImage($connection, $refad, $file);

if ($results&&$results2!=0) 
{
    echo "Advertisement was updated successfully!";
}
echo "<br/> <a href='myAds'>Go back to myAds Page</a>";
