<?php

include 'dbConfig.php';
session_start();

/*$connect = mysqli_connect("127.0.0.1", "root", "", "dbprjm14");*/
if(isset($_POST["insert"]))
{
    $refad = $_SESSION['refad'];
    $ad_description = $_POST['ad_description'];
    $catid = $_POST['catid'];
    $now = date('Y-m-d');
    $start_date = strtotime($now);
    $end_date = strtotime("+7 day", $start_date);
    $regdate = date('Y-m-d', $start_date);
    $expdate = date('Y-m-d', $end_date);
    $refmember = $_SESSION['refmember'];
    
    
    $query = "INSERT INTO advertisements (ad_description, refmember, regdate, expdate, refcat) VALUES ('$ad_description', $refmember, '$regdate', '$expdate', $catid)";
    
    if (mysqli_query($connectionID, $query))
    {
        $sql = "SELECT refad FROM advertisements ORDER BY refad DESC LIMIT 1";
        $results = mysqli_query($connectionID, $sql);
        while ($row = mysqli_fetch_array($results))
        {
            $lastrefad= $row['refad'];
            
        }
        
        
    } 
    
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $query2 = "INSERT INTO images(name, refad) VALUES ('$file', $lastrefad )";

    if (mysqli_query($connectionID, $query2)) 
    {
        echo "Advertisement was posted successfully!";
        echo "<br/><br/><a href='myAds.php'>Go back to MyAds</a>";
    }
    /*
    if(mysqli_query($connect, $query) && mysqli_query($connect, $query2))
    {
        echo '<script>alert("Advertisement was posted!")</script>';
    }
    */
}
?>
