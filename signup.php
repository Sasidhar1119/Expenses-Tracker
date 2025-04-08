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

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted username and password from the form
    $user_name = $_POST['username'];
    $user_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input (for example, ensure password and confirm password match)
    if ($user_password !== $confirm_password) {
        echo "Error: Passwords do not match";
    } else {
        // Check if the user already exists
        $check_sql = "SELECT * FROM users WHERE user_name = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $user_name);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // User already exists, display popup message and redirect to login page
            echo "<script>
                    alert('User already exists. Please login.');
                    window.location.href = 'http://localhost/Expense_final/Frontend/login.html';
                  </script>";
            exit; // Stop executing PHP script
        } else {
            // Prepare SQL statement to insert user data into the database
            $sql = "INSERT INTO users (user_name, user_password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $user_name, $user_password);

            // Execute the SQL statement
            if ($stmt->execute()) {
                echo "<script>
                        alert('User registered successfully!');
                        window.location.href = 'http://localhost/Expense_final/Frontend/login.html';
                      </script>";
                exit; // Stop executing PHP script
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

// Close connection
$conn->close();
?>
