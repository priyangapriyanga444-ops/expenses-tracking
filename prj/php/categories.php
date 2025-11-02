<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "moneytracker";  // your database name

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// Insert data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $note = $_POST['note'];
    $date = $_POST['date'];

    $sql = "INSERT INTO expenses (user_id, category, amount, note, date) 
            VALUES ('$user_id', '$category', '$amount', '$note', '$date')";
    
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Expense added successfully');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <link rel="stylesheet" href="styles/categories.css">
</head>
<body>

<h2 align="center">Add Your Expense</h2>

<form method="POST">
    <label>Category:</label>
    <select name="category" required>
        <option value="Loan">Loan</option>
        <option value="Shopping">Shopping</option>
        <option value="Entertainment">Entertainment</option>
        <option value="Groceries">Groceries</option>
        <option value="Medical">Medical</option>
        <option value="Travel">Travel</option>
        <option value="Other">Other</option>
    </select>

    <label>Amount:</label>
    <input type="number" name="amount" step="0.01" required>

    <label>Note:</label>
    <textarea name="note" rows="3"></textarea>

    <label>Date:</label>
    <input type="date" name="date" required>

    <button type="submit">Add Expense</button>
</form>

</body>
</html>
