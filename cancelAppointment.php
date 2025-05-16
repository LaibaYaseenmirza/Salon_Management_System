<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glow_up_beauty_salon";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get form data
$appointment_id = $_POST['appointment_id'];

// Prepare a SQL statement using prepared statements to prevent SQL injection
$stmt = $con->prepare("DELETE FROM appointment WHERE id = ?");
$stmt->bind_param("i", $appointment_id);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Appointment cancelled successfully";
} else {
    echo "Query failed: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$con->close();
?>
