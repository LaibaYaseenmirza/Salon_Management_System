<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glow_up_beauty_salon";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo "Connected successfully";
}

$name = $_POST['name'];
$email = $_POST['email'];


$stmt = $con->prepare("INSERT INTO `user` (`name`, `email`) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);


if ($stmt->execute()) {
    echo "Data submitted successfully";
} else {
    echo "Query failed: " . $stmt->error;
}


$stmt->close();
$con->close();
?>
