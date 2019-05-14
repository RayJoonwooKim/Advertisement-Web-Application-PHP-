<?php
include_once 'dbConfig.php';
include_once 'Category.class.php';
?>
<html>

<body>

<form action="insertFreeAd.php" enctype="multipart/form-data" method="post">
Advertisement Description
<br/>
<textarea name="ad_description" style="height: 300px; width: 450px"></textarea>
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
<input type="submit" name="insert" id="insert" value="Post Now"/>
</form>

</body>


</html>