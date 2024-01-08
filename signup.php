<?php
session_start();

// Replace these variables with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Register";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process signup form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["fname"];
    $gender = $_POST["gender"];
    $phone = $_POST["num"];
    $email = $_POST["mail"];
    $password = password_hash($_POST["pass"], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check_query = "SELECT * FROM signup WHERE mail='$email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Email already exists. Please choose a different one.";
    } else {
        // Insert the new user into the database
        $insert_query = "INSERT INTO signup (fname, gender, num, mail, pass) VALUES ('$name', '$gender', '$phone', '$email', '$password')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo "Signup successful. You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
<div class="container">
         <div class="signup-box">
           <div class="col-2">
            <h1>Signup</h1>
            <span>Already have an account? <a href="login.php">Login</a></span>
           
            <h3>or</h3>

            <form method="post">
               <label>Full Name</label>
               <input type="text" name="fname" placeholder="Enter your Full Name" class="input-field" required>
               <label>Gender</label>
               <input type="text" name="gender" placeholder="gender" class="input-field" required>

               <label>Phone Number</label>
               <input type="tel" name="num" placeholder="Enter your Phone number" class="input-field" required>

               <label>Email Address</label>
               <input type="email" name="mail" placeholder="Enter your email" class="input-field" required>

               <label>Password</label>
               <input type="password" name="pass" placeholder="Enter password" class="input-field" required>

               <div class="row">
                  <input id="check-box" type="checkbox" checked required>
                  <span>By Clicking You Agree to the <br> <a href="condition.html">Terms and Conditions</a></span>
               </div>
               <button id="submit-btn" type="submit">Signup</button>
            </form>
           </div> 
         </div>
      </div>

</body>
</html>
