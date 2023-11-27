<?php
session_start();
require_once 'db.php';

// Überprüfe, ob der Benutzer als Admin angemeldet ist
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    // Falls nicht, leite zur index.php weiter oder zu einer anderen Seite
    header("Location: index.php");
    exit();
}

$generatedPassword = ''; // Initialize the variable to store the generated password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];

    // Generate a random password
    $generatedPassword = generateRandomPassword();

    // Überprüfe, ob der Benutzer bereits existiert
    $checkUserExistence = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUserExistence);

    if ($result->num_rows > 0) {
        echo "Benutzername bereits vergeben";
    } else {
        // Füge den Benutzer zur Datenbank hinzu
        $sql = "INSERT INTO users (username, passwort) VALUES ('$username', '$generatedPassword')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $username;
        } else {
            echo "Fehler beim Hinzufügen des Benutzers: " . $conn->error;
        }
    }
}

$conn->close();

// Function to generate a random password
function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css"> <!-- Falls du ein CSS für das Registrierungs-Formular verwenden möchtest -->
</head>

<body>
    <div class="register-container">
        <a href="logout.php">Logout</a>
        <h2>Benutzer aufnehmen</h2>
        <form action="" method="post">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required>

            <?php if (!empty($generatedPassword)): ?>
                <!-- Display the generated password only if it's not empty -->
                <p>Automatisch generiertes Passwort: <?php echo $generatedPassword; ?></p>
            <?php endif; ?>

            <button type="submit">BENUTZER ANLEGEN!</button>
        </form>
    </div>
</body>

</html>
