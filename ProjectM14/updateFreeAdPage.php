<?php
include_once 'dbConfig.php';
include_once 'Category.class.php';
session_start();
$refad = $_GET["refad"];
?>
<html>

<body>

<form action="updateFreeAd.php" method="post">
Advertisement Description
<br/>
<textarea name="ad_description" style="height: 300px; width: 450px">
<?php
$sql = "SELECT ad_description FROM advertisements WHERE refad = $refad";
$results = mysqli_query($connectionID, $sql);
if ($results==true) 
{
    while ($row = mysqli_fetch_array($results))
    {
        $desc = $row['ad_description'];
        $_SESSION['refad'] = $refad;
    };
}

echo "$desc";
?></textarea>
<br/>
<label>Category : </label>
<select name="catid">
	<?php 
	$connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
	$category = new Category();
	$arrCat = $category->getComboboxElements($connection);
	$category->displayCombobox($arrCat);
	?>
</select>
<br/>              
<input type="submit" name="update" id="update" value="Update"/>
</form>

</body>


</html>