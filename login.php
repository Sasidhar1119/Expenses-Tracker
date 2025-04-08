<?php


// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted on a different server
$username = "root"; // Replace with your MySQL username
$password = "Meiko"; // Replace with your MySQL password
$dbname = "expense"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start(); // Start session
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username  = $_POST['username'];
    $user_password = $_POST['password'];

    // Prepare SQL statement to select user by username and password
    $sql = "SELECT id FROM users WHERE user_name = ? AND user_password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        // User exists, login successful
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id']; // Store user ID in session
        echo "Login successful!";
        // echo "User_id : " .$_SESSION['user_id'];
        header('Location: http://localhost/Expense_final/Frontend/1.html');
        exit(); // Terminate script execution after redirect
    } else {
        // User does not exist or incorrect credentials
        echo "Incorrect username or password!";
    }
}

// Close connection
$conn->close();
?>
