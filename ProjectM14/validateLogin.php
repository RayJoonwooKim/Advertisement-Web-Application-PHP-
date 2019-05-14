<?php

include_once 'dbConfig.php';

session_start();

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
        $_SESSION['name'] = $row["name"];
        
        echo "Welcome! ".$_SESSION['name'];
        return true;
    }
    echo "Invalid email or password!";
    return false;
    
}

?>