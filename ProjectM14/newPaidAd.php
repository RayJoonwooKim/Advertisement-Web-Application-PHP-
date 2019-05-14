<?php
include_once 'dbConfig.php';
include_once 'Category.class.php';
include_once 'Advertisement.class.php';
session_start();
$luckyPercent = abs($_SESSION['luckyPercent']);
$islucky = $_SESSION['islucky'];
$luckyRate = $_SESSION['luckyRate'];
$original_total = abs(15);
$discount_total = abs($original_total - $original_total * $luckyPercent);
?>

<html>

<body>

<form action="insertPaidAd.php" enctype="multipart/form-data" method="post">
Advertisement Description 
<br/>
<textarea name="ad_description" style="height: 300px; width: 450px"></textarea>
<br />
<br />
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
<input type="file" name="image" id="image" style="width:400px"/>  
<br />
<br />
<?php 
if ($islucky==true)
{
    echo "Original Price : $ $original_total <br/>
          Lucky Discount : $luckyRate%<br/>
          Total : $$discount_total <br/>";

          
}
else 
{
    echo "Price : $$original_total <br/>";
}
?>
<br/>              
<input type="submit" name="insert" id="insert" value="Pay Now"/>
</form>

</body>


</html>