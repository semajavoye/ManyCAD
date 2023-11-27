<?php
// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve new password and confirm password from the form
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];
    $username = $_SESSION['username'];

    // Check if passwords match
    if ($newPassword == $confirmPassword) {
        // Hash the new password (use appropriate password hashing method)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updatePasswordQuery = "UPDATE users SET passwort = '$hashedPassword' WHERE username = '$username'";

        // Execute the update query
        if ($conn->query($updatePasswordQuery) === TRUE) {
            // Password updated successfully
            echo "Passwort erfolgreich aktualisiert";
        } else {
            // Error updating password
            echo "Fehler beim Aktualisieren des Passworts: " . $conn->error;
        }
    } else {
        // Passwords do not match, handle the error (e.g., display an error message)
        $error = "Passwords do not match";
    }
}
?>
