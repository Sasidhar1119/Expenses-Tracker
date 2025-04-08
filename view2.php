<?php
session_start();
// Access session variables
$id = $_SESSION['user_id'];
// Establish database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "Meiko";
$dbname = "expense";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data grouped by expense_category
$sql = "SELECT expense_category, SUM(amount) AS total_amount FROM expenses where id = $id GROUP BY expense_category";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
