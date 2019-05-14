<?php

require_once 'dbConfig.php';
include_once 'Advertisement.class.php';

session_start();

$refmember = $_SESSION['refmember'];
$luckyPercent = $_SESSION['luckyPercent'];
$islucky = $_SESSION['islucky'];
$_SESSION['navigator'] = true;
try{
    
    $connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
    $advertisement = new Advertisement();
    $adtables = $advertisement->getSelectedAdByRefmember($connection, $refmember);
    
    $sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember, advertisements.regdate, advertisements.expdate, images.refimage, images.name FROM advertisements INNER JOIN images ON advertisements.refad = images.refad AND advertisements.refmember=$refmember";
    $results = mysqli_query($connectionID, $sql);
    if ($results==true)
    {
        echo "<a href='newPaidAd.php'>Post New Premium Ad</a> &nbsp&nbsp&nbsp&nbsp <a href='newFreeAd.php'>Post New Free Ad</a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href='Main.php'>Go back to main page</a>";
        echo "<br/><br/>My Paid Ads <br/>";
        echo "<table width=100%>
                            <tr>
                                <th>Image</th>
                                <th>Advertisement</th>
                                <th>Posted Date</th>
                                <th>Expire Date</th>
                                <th>Actions</th>
                            </tr>";
        
        while ($row = mysqli_fetch_array($results))
        {
            $_SESSION['adtype'] = "paid";
            $_SESSION['refad'] = $row['refad'];
            echo '<tr>
                    <td>
                     <img src="data:image/jpeg;base64,'.base64_encode($row['name']).'" height="200" width="200" />
                     </td>';
            echo "
                    <td>".$row['ad_description']."</a></td>
                    <td>".$row['regdate']."</td>
                    <td>".$row['expdate']."</td>
                    <td><a href='updatePaidAdPage.php?refad=".$row['refad']."&adtype=".$_SESSION['adtype']."'>Update</a></td>
                    <td><a href='deleteAd.php?refad=".$row['refad']."&adtype=".$_SESSION['adtype']."'>Delete</a></td>
                </tr>";
            
            
        }
        echo "</table>";
    
    echo "My Free Ads <br/>";
    echo "<table width=100%>
                            <tr>
                                <th>Advertisement</th>
                                <th>Posted Date</th>
                                <th>Expire Date</th>
                                <th>Actions</th>
                            </tr>";
    echo "$adtables";
    echo "</table> <br/><br/>";

    
        
    }
    else {
        printf(mysqli_error($connectionID));
    }
 
    /*
    $sql = "SELECT * FROM advertisements WHERE refmember=$refmember";
    $results = mysqli_query($connectionID, $sql);
    echo "<table>
            <tr>
                <th>Advertisement</th>
                <th>Posted Date</th>
                <th>Expire Date</th>
                <th>Action</th>
            </tr>";
    while ($row = mysqli_fetch_array($results))
    {
        
        echo "<tr>
                <td>".$row['ad_description']."</td>
                <td>".$row['regdate']."</td>
                <td>".$row['expdate']."</td>
                <td><a href='updateAd.php=".$row['refad']."'>Update</a></td>
                <td><a href='deleteAd.php=".$row['refad']."'>Delete</a></td>
              </tr>";
    }
    echo "</table>";
   */
    
}catch (PDOException $ex)
{
    echo "Connection Error";
}