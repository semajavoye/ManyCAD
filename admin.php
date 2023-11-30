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
        if ($conn->query($sql) !== TRUE) {
            echo "Fehler beim Hinzufügen des Benutzers: " . $conn->error;
        }
    }
}

// Function to generate a random password
function generateRandomPassword($length = 10)
{
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/var.css">
    <!-- Falls du ein CSS für das Registrierungs-Formular verwenden möchtest -->
</head>

<body>
    <div class="cont">
        <div class="register-container">
            <a href="logout.php">Logout</a>
            <h2>Benutzer aufnehmen</h2>
            <form action="" method="post">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required>

                <?php if (!empty($generatedPassword)): ?>
                    <!-- Display the generated password only if it's not empty -->
                    <p>Automatisch generiertes Passwort:
                        <?php echo $generatedPassword; ?>
                    </p>
                <?php endif; ?>

                <button type="submit">BENUTZER ANLEGEN!</button>
            </form>
        </div>
        <div class="userstable">
            <h2>Benutzerliste</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Benutzername</th>
                    <th>Passwort</th>
                    <th>Erstellt</th>
                    <th>Geupdatet</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Fetch and display users
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display users
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["passwort"] . "</td>
                    <td>" . $row["created_at"] . "</td>
                    <td>" . $row["updated_at"] . "</td>
                    <td>
                        <button class='edit-button' data-username='" . $row["username"] . "' data-password='" . $row["passwort"] . "'>Edit</button>
                        <button class='delete-button' data-username='" . $row["username"] . "'>Delete</button>
                    </td>
                </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Keine Benutzer gefunden</td></tr>";
                }

                $conn->close(); // Close the connection after fetching users
                ?>
            </table>
        </div>
    </div>
    <script>
        // Add event listener to all "Edit" buttons
        document.querySelectorAll('.edit-button').forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the row
                var row = button.parentElement.parentElement;

                // Get the username and password cells
                var usernameCell = row.children[1];
                var passwordCell = row.children[2];

                // Replace the text in the cells with input fields
                usernameCell.innerHTML = '<input type="text" value="' + usernameCell.textContent + '">';
                passwordCell.innerHTML = '<input type="password" value="' + passwordCell.textContent + '">';

                // Replace the "Edit" button with a "Save" button
                button.outerHTML = '<button class="save-button">Save</button>';
            });
        });

        // Add event listener to all "Save" buttons
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('save-button')) {
                // Get the row
                var row = event.target.parentElement.parentElement;

                // Get the username and password cells
                var usernameCell = row.children[1];
                var passwordCell = row.children[2];

                // Replace the input fields in the cells with the input values
                usernameCell.textContent = usernameCell.children[0].value;
                passwordCell.textContent = passwordCell.children[0].value;

                // Replace the "Save" button with an "Edit" button
                event.target.outerHTML = '<button class="edit-button">Edit</button>';
            }
        });
    </script>
</body>

</html>