<?php
session_start();
// Access session variables
$id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "Meiko";
$dbname = "expense";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve form data
$amount = $_POST['amount'];
$date = $_POST['date'];
$description = $_POST['description'];
$mode = $_POST['mode'];
$category = $_POST['category'];

// Prepare and execute the SQL query
$sql = "INSERT INTO expenses (id,amount, date, description, mode_of_payment, expense_category)
        VALUES ($id,'$amount', '$date', '$description', '$mode', '$category')";

if ($conn->query($sql) === TRUE) {
    // Successful insertion, echo JavaScript function call to show success message
    // echo '<script type="text/javascript">showPopup();</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();

// Redirect to the homepage after form submission
header('Location: http://localhost/Expense_final/Frontend/');
exit(); // Make sure to exit after redirecting to prevent further execution
?>
