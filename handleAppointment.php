<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glow_up_beauty_salon";


$con = new mysqli($servername, $username, $password, $dbname);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


if (isset($_POST['date']) && isset($_POST['time'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];

    
    $stmt = $con->prepare("INSERT INTO appointment (date, time) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $date, $time);

        
        if ($stmt->execute()) {
            echo "Appointment booked successfully";
        } else {
            echo "Query failed: " . $stmt->error;
        }

       
        $stmt->close();
    } else {
        echo "Failed to prepare the statement: " . $con->error;
    }
} else {
    echo "Please provide both date and time.";
}


$con->close();
?>
