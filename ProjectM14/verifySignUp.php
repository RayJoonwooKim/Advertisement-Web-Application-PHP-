<?php
include_once 'dbConfig.php';
include_once 'Member.class.php';


$name = $_POST["name"];
$password = $_POST["password"];
$address = $_POST["address"];
$city = $_POST["city"];
$state = $_POST["state"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$title = $_POST["type"];

try {
    /*
    $sql = "INSERT INTO members (name, address, city, state, phone, email, password, membertype) VALUES ('n','a','c','s','p','e','p','t')";
    
    $results = mysqli_query($connectionID, $sql);
    
    if ($results==true) 
    {
        echo "New row added";
    }
    else {
        echo mysqli_error($connectionID);
    }
    */
    
    $connection = new PDO("mysql:host=$host; dbname=$dbname",$user,$pw);
    
    $member = new Member();
    $isInserted = $member->SignUp($connection, $name, $address, $city, $state, $phone, $email, $password, $title);
      
    if ($isInserted==true) 
    {
        echo "User signed up successfully! <br/><br/>";
        echo "<a href='Login.php'>Go back to login page</a>";
    }
    else {
        echo "Error";
    }
   
    
} catch (PDOException $e) {
    echo "$e";
}
