<?php
// 1) DB connection
$servername = "localhost";
$username   = "root";
$password   = "";          // XAMPP default no password
$dbname     = "register1";   // <-- change this to your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2) When submit button clicked
if (isset($_POST['signUp'])) {

    $fname   = $_POST['fName'];
    $lname   = $_POST['lName'];
    $email   = $_POST['email'];
    $pass    = $_POST['password'];

    // --- hash password (IMPORTANT) ---
    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    // 3) Insert Query
    $sql = "INSERT INTO users (first_name,last_name,email,password) 
            VALUES('$fname','$lname','$email','$hashed')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registered Successfully');window.location.href='login.html';</script>";
    } else {
        echo "Error : " . $conn->error;
    }
}
$conn->close();
?>
