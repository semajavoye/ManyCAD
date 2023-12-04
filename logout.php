<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/var.css">
</head>

<body>
    <div class="logout-container">
        <div class="message">
            <h1>Logout erfolgreich</h1>
            <br>
            Du wirst in 3 Sekunden zur Login-Seite geführt. Wenn das nicht funktioniert, klicke
            <a href='login.php'>hier</a>
        </div>
    </div>
    <script>
        setTimeout(function () { window.location.href = 'login.php'; }, 3000);
    </script>
</body>

</html>