<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Register";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["mail"];
    $password = trim($_POST["pass"]);

  
    
    $query = "SELECT * FROM signup WHERE mail='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row["pass"])) {
          
            $_SESSION["mail"] = $email;
            header("Location: welcome.html");
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Email not found. Please sign up.";
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signup.css">
  
</head>
<body>
<div class="container">
         <div class="signup-box">
           <div class="col-2">
            <h1>Login</h1>
            <form method="POST">
              
               <label>Email Address</label>
               <input type="email" name="mail" placeholder="Enter your email" class="input-field">

               <label>Password</label>
               <input type="password" name="pass" placeholder="Enter password" class="input-field">

               <button id="submit-btn" type="submit">Login</button>
               <span>Don't have an account? <a href="signup.php">Signup</a></span>
           
            </form>
           </div> 
         </div>
      </div>
</body>
</html>
