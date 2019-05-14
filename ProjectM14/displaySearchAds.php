<?php
require_once 'dbConfig.php';
include_once 'Advertisement.class.php';
include_once 'Member.class.php';
include_once 'Category.class.php';

session_start();

$connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
$refcat = $_SERVER['QUERY_STRING'];

$sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember, advertisements.regdate, advertisements.expdate, images.refimage, images.name FROM advertisements INNER JOIN images ON advertisements.refad = images.refad AND advertisements.refcat = $refcat";
$results = mysqli_query($connectionID, $sql);
if ($results==true)
{
    
    echo "<table width=100%>
                            <tr>
                                <th>Image</th>
                                <th>Advertisement</th>
                                <th>Posted Date</th>
                                <th>Expire Date</th>
                            </tr>";
    
    while ($row = mysqli_fetch_array($results))
    {
        
        echo '<tr>
                    <td>
                     <img src="data:image/jpeg;base64,'.base64_encode($row['name']).'" height="200" width="200" />
                     </td>';
        echo"
                    <td><a href=DisplayAd.php?'".$row['refad'].'">'.$row['ad_description']."</a></td>
                    <td>".$row['regdate']."</td>
                    <td>".$row['expdate']."</td>
                    </tr>";
        
        
    }
    echo "</table>";
    
}
else {
    printf(mysqli_error($connectionID));
}


$advertisement = new Advertisement();
$arrAd = $advertisement->getFreeAdsByCategory($connection, $refcat);
$advertisement->DisplayAds($arrAd);


