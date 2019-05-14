<?php
include_once 'dbConfig.php';
include_once 'Advertisement.class.php';

session_start();

$refad = $_GET['refad'];
$adtype = $_SESSION['adtype'];
$connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);

if ($adtype=="free") 
{
    $ad = new Advertisement();
    $ad->deleteFreeAd($connection, $refad);
    
    echo "Advertisement was deleted successfully!";;
}

else if ($adtype=="paid")
{
    $ad = new Advertisement();
    $ad->deletePaidAd($connection, $refad);
    echo $refad;
    echo $adtype;
    echo "Advertisement was deleted successfully!";
}

echo "<br/><a href='myAds.php'>Go back to MyAds</a>";