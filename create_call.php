<?php

session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $call_number = $_POST['call-number'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $dob = $_POST['dob'];
    $primary_unit = $_POST['primary-unit'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $created_by_id = $_SESSION['user_id'];
    $created_by_name = $_SESSION['username'];

    $sql = "INSERT INTO calls (call_number, first_name, last_name, dob, primary_unit, location, description, created_by_id, created_by_name) VALUES ('$call_number', '$first_name', '$last_name', '$dob', '$primary_unit', '$location', '$description', '$created_by_id', '$created_by_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Einsatz erfolgreich erstellt";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();

?>