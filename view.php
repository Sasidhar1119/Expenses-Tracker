<?php
session_start();
    // Access session variables
    $id = $_SESSION['user_id'];
    
// Connect to MySQL
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = "Meiko"; // Change this to your MySQL password
$database = "expense"; // Change this to your MySQL database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch expenses
$sql = "SELECT amount, date, description, mode_of_payment, expense_category FROM expenses where id = $id";
$result = $conn->query($sql);


// Close MySQL connection
$conn->close();

// Return expenses data as JSON
header('Content-Type: application/json');
echo json_encode($result->fetch_all(MYSQLI_ASSOC));
?>
