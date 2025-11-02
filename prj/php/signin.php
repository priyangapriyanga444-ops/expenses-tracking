<?php
$servername = "localhost";
$username   = "root";
$password   = "";          // XAMPP default no password
$dbname     = "register1"; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    // check user by email
    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        
        // verify password
        if(password_verify($pass, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['first_name'];
            header("Location: categories.php");
            exit();
        }else{
            echo "<script>alert('Wrong Password');</script>";
        }
    }else{
        echo "<script>alert('Email not registered');</script>";
    }
}
?>

