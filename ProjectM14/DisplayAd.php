<?php
require_once 'dbConfig.php';
include_once 'Advertisement.class.php';
$refad = $_SERVER["QUERY_STRING"];


try{
    $connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
    $advertisement = new Advertisement();
    $advertisement = $advertisement->getSelectedAd($connection, $refad);
    echo Advertisement::getHeader();
    echo $advertisement;
    echo Advertisement::getFooter();
}catch (PDOException $ex)
{
    echo "Connection Error";
}
/*
try {
    $connection=new PDO("mysql:host=$hostname;dbname=$dbname",
        $username,$password);
    echo "You are connected to $dbname database <br/>";
    $teacher=new Teacher();
    $teacher->setTeacherId(100);
    
    $teacher=$teacher->getTeacherById($connection);
    echo Teacher::getheader();
    echo $teacher;
    
    echo Teacher::getfooter();
    
}catch (PDOException $exception){
    echo "Error<br/>";
}
/*
$sql = "SELECT articles.refarticle, articles.article_name, articles.article_description, articles.price, articles.quantity, advertisements.refad, advertisements.regdate FROM articles INNER JOIN advertisements ON articles.refad = ".$refarticle;

if ($result = mysqli_query($connectionID, $sql))
{
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_array($result))
        {
            echo $row['article_name']."<br/>";
            echo $row['article_description']."<br/>";
            echo $row['price']."<br/>";
            echo $row['quantity']."<br/>";
        };
    };
}
*/