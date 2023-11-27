<?php
session_start();
require_once("db.php");

// Initialize a variable to store messages
$message = "";

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve new password and confirm password from the form
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];
    $username = $_SESSION['username'];

    // Check if passwords match
    if ($newPassword == $confirmPassword) {

        // Update the password in the database
        $updatePasswordQuery = "UPDATE users SET passwort = '$newPassword' WHERE username = '$username'";

        // Execute the update query
        if ($conn->query($updatePasswordQuery) === TRUE) {
            // Password updated successfully
            $message = "Passwort erfolgreich aktualisiert";
        } else {
            // Error updating password
            $message = "Fehler beim Aktualisieren des Passworts: " . $conn->error;
        }
    } else {
        // Passwords do not match, handle the error (e.g., display an error message)
        $message = "Passwords do not match";
    }

    // Return the message as JSON
    echo json_encode(['message' => $message]);
    exit();
}
?>
