<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glow_up_beauty_salon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $card_number = clean_input($_POST["card_number"]);
    $expiration = clean_input($_POST["expiration"]);
    $cvv = clean_input($_POST["cvv"]);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO payment (card_number, expiration, cvv) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $card_number, $expiration, $cvv);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Payment processed successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// Function to sanitize input data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
