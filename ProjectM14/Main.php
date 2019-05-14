
<?php 
require_once 'dbConfig.php';
include_once 'Advertisement.class.php';
include_once 'Member.class.php';
include_once 'Category.class.php';

session_start();

$connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);

try{    

        if (isset($_POST["email"]) && isset($_POST["password"]))
        {
            
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            $sql = "SELECT * FROM members WHERE email='$email' AND password='$password'";
            
            $result = mysqli_query($connectionID, $sql);
            
            if (!$result)
            {
                echo mysqli_error($connectionID);
            }
            
            if (mysqli_num_rows($result) > 0)
            {
                
                $row= mysqli_fetch_array($result);
                $_SESSION['refmember'] = $row["refmember"];
                $_SESSION['name'] = $row["name"];
                
                //Generate Lucky number
                $member = new Member();
                $luckyNumber = $member->getLuckyMember($connectionID);
                $_SESSION['islucky'] = false;
                
                if ($luckyNumber==$_SESSION['refmember'])
                {
                    echo "Congrats! You are a lucky member <br/>";
                    $luckyRate = rand(10,50);
                    $luckyPercent = $luckyRate/100;
                    
                    $_SESSION['luckyRate'] = $luckyRate;
                    $_SESSION['luckyPercent'] = $luckyPercent;
                    $_SESSION['islucky'] = true;
                    echo "You will get $luckyRate% discount on Premium Ads! <br/>";
                }
                
                /*
                echo "Welcome! ".$_SESSION['name']. "&nbsp&nbsp&nbsp&nbsp<a href='myAds.php?".$_SESSION['refmember']."&".$_SESSION['luckyPercent']."'>My Ads</a> <br/><br/>";
                */
    }
    
            //Load Ads
            ?>
            <html>
             <style>
                td{
                    text-align:center;
                }
             </style>
           	<body>
           	<?php
           	
           	echo "Welcome! ".$_SESSION['name']. "&nbsp&nbsp&nbsp&nbsp<a href='myAds.php?".$_SESSION['refmember']."&".$_SESSION['luckyPercent']."'>My Ads</a> <br/><br/>";
           	
           	?>
           	
           	<br/>
           	<label>Search Advertisements By Category : </label>
           	<br/>
           	<?php 
           	$sql_cat = "SELECT * FROM category";
           	$results = mysqli_query($connectionID, $sql_cat);
           	while ($row = mysqli_fetch_array($results))
           	{
           	    echo "<a href='displaySearchAds.php?".$row['refcat']."'>".$row['category_description']."</a>";
           	    echo "&nbsp&nbsp&nbsp&nbsp";
           	}
           	    
   	
           	?>
           	<br/>
           	<br/>
 
           	<label>Paid Ad Section</label>
           	<br/>
           	<table>
           		<?php 
           		
           	
           		$sql = "SELECT advertisements.refad, advertisements.ad_description, advertisements.refmember, advertisements.regdate, advertisements.expdate, images.refimage, images.name FROM advertisements INNER JOIN images ON advertisements.refad = images.refad";
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
                    <td>".$row['ad_description']."</td>
                    <td>".$row['regdate']."</td>
                    <td>".$row['expdate']."</td>
                    </tr>";
           		        
           		        
           		    }
           		    echo "</table>";
           		    
           		}
           		else {
           		    printf(mysqli_error($connectionID));
           		}
           		?>
           	
           	
           	</table>
           	<br/>
           	<label>Free Ad Section</label>
           	
           		<?php 
            
            
            $advertisement = new Advertisement();
 
            $arrAd = $advertisement->getAllFreeAds($connection);
            if ($arrAd==null)
            {
                echo "There is no advertisement!";
            }
            else{
                
                $advertisement->DisplayAds($arrAd);
            }
            
            ?>
           	
           	</body>
            </html>
            
            <?php 
            return true;
        }
        echo "Invalid email or password!";
        return false;
        

    
}catch (PDOException $ex)
{
    echo "Connection Error";
}



/*
DisplayCategory($connectionID);
DisplayAllAds($connectionID);

function DisplayCategory($connectionID)
{
    $sql_category = "SELECT * FROM category";
    
    if($result = mysqli_query($connectionID, $sql_category))
    {
        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_array($result)) 
            {
                echo "<a href='#'>".$row['category_description']."</a>&nbsp&nbsp";
                
            }
            mysqli_free_result($result);
        }
        else {
            echo "No Category!";
        }
    }
}




function DisplayAllAds($connectionID)
{
    $sql_article = "SELECT articles.refarticle, articles.article_name, articles.article_description, articles.price, advertisements.regdate, subcategory.subcat_description FROM articles INNER JOIN advertisements ON articles.refad = advertisements.refad INNER JOIN subcategory ON subcategory.refad = advertisements.refad";
    if ($result = mysqli_query($connectionID, $sql_article))
    {
        if (mysqli_num_rows($result) > 0)
        {
            echo "<table>";
            echo "<tr>";
            echo "<td>Title</td>";
            echo "<td>Description</td>";
            echo "<td>Price</td>";
            echo "<td>Posted Date</td>";
            echo "<td>Category</td>";
            echo "</tr>";
            
            while ($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                echo "<td><a href='DisplayAd.php?".$row['refarticle']."'>".$row['article_name']."</a></td>";
                echo "<td>".$row['article_description']."</td>";
                echo "<td>$".$row['price']."</td>";
                echo "<td>".$row['regdate']."</td>";
                echo "<td>".$row['subcat_description']."</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            mysqli_free_result($result);
        }
        else
        {
            echo "No data found!";
        }
    }
}
*/

?>

