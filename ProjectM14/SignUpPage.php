<?php
include_once 'dbConfig.php';

?>

<html>

<head>
  <meta charset="UTF-8">
  <title>Sign Up Form with live validation</title>
  
  
      <link rel="stylesheet" href="css2/style.css">
      
      <style>
      
      @import "compass/css3";

$button: rgba(148,186,101,0.7);

body {
  background: #384047;
  font-family: sans-serif;
  font-size: 10px
}
form {
  background: #fff;
  padding: 4em 4em 2em;
  max-width: 400px;
  margin: 50px auto 0;
  box-shadow: 0 0 1em #222;
  border-radius: 2px;
  h2 {
    margin:0 0 50px 0;
    padding:10px;
    text-align:center;
    font-size:30px;
    color:darken(#e5e5e5, 50%);
    border-bottom:solid 1px #e5e5e5;
  }
  p {
    margin: 0 0 3em 0;
    position: relative;
  }
  input {
    display: block;
    box-sizing: border-box;
    width: 100%;
    outline: none;
    margin:0;
  }
  input[type="text"],
  input[type="password"] {
    background: #fff;
    border: 1px solid #dbdbdb;
    font-size: 1.6em;
    padding: .8em .5em;
    border-radius: 2px;
  }
  input[type="text"]:focus,
  input[type="password"]:focus {
    background: #fff
  }
  span {
    display:block;
    background: #F9A5A5;
    padding: 2px 5px;
    color: #666;
  }
  input[type="submit"] {
    background: $button;
    box-shadow: 0 3px 0 0 darken($button, 10%);
    border-radius: 2px;
    border: none;
    color: #fff;
    cursor: pointer;
    display: block;
    font-size: 2em;
    line-height: 1.6em;
    margin: 2em 0 0;
    outline: none;
    padding: .8em 0;
    text-shadow: 0 1px #68B25B;
  }
  input[type="submit"]:hover {
    background: rgba(148,175,101,1);
    text-shadow:0 1px 3px darken($button, 30%);
  }
  input[type="submit"]:hover {
    
  }
  label{
    position: absolute;
    left: 8px;
    top: 12px;
    color: #999;
    font-size: 16px;
    display: inline-block;
    padding: 4px 10px;
    font-weight: 400;
    background-color: rgba(255,255,255,0);
    @include transition(color .3s, top .3s, background-color .8s);
    &.floatLabel{
      top: -11px;
      background-color: rgba(255,255,255,0.8);
      font-size: 14px;
    }
   }
  
}
      
      
      
      </style>

  
</head>	
  
<body>

	<form action="verifySignUp.php" method="post">
  <h2>Sign Up</h2>
		<p>
			<label for="email" class="floatLabel">Email</label>
			<input id="email" name="email" type="text">
		</p>
		<p>
			<label for="password" class="floatLabel">Password</label>
			<input id="password" name="password" type="password">
		</p>
		<p>
			<label for="name" class="floatLabel">Name</label>
			<input id="name" name="name" type="text">
			
		</p>
		<p>
			<label for="address" class="floatLabel">Address</label>
			<input id="address" name="address" type="text">
			
		</p>
		<p>
			<label for="city" class="floatLabel">City</label>
			<input id="city" name="city" type="text">
			
		</p>
		<p>
			<label for="state" class="floatLabel">State</label>
			<input id="state" name="state" type="text">
			
		</p>
		<p>
			<label for="phone" class="floatLabel">Phone</label>
			<input id="phone" name="phone" type="text">
			
		</p>
		<p>
		<label for="type" class="floatLabel">Type</label>
		<br/>
		<br/>
		<br/>
		<select name = "type">
		<?php
		$query = "SELECT * FROM membertype";
		$result = mysqli_query($connectionID, $query);
		while($row=mysqli_fetch_array($result)){
		    echo "<option value='".$row['title']."'>".$row['title']."</option>";
		}
		?>
		</select>
		</p>
		<p>
			<input type="submit" value="Create My Account" name="btnSignup">
		</p>
	</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


    <script  src="js/index.js"></script>


	
</body>


</html>
