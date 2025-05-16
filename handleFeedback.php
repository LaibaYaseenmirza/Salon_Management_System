<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glow_up_beauty_salon";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $feedback = clean_input($_POST["feedback"]);

    
    $stmt = $conn->prepare("INSERT INTO feedback (feedback) VALUES (?)");
    $stmt->bind_param("s", $feedback);

    
    if ($stmt->execute()) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}


function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
