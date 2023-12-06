<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND passwort = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        // Überprüfe, ob der Benutzer "admin" ist
        if ($username == 'admin') {
            header("Location: admin.php");
            exit();
        } else {
            // Falls nicht "admin", leite zur index.php weiter
            header("Location: index.php");
            exit();
        }
    } else {
        // Benutzer nicht gefunden oder falsches Passwort, zeige Fehlermeldung oder handle anders
        echo "Falscher Benutzername oder Passwort";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/var.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>
            <div class="showpw">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Passwort anzeigen</label>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>