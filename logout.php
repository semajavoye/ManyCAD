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
</head>

<body>
    <div class="logout-container">
        <p class="message">
            Logout erfolgreich<br>
            Du wirst in 1 Sekunden zur Login-Seite geführt. Wenn das nicht funktioniert, klicke
            <a href='login.php'>hier</a>.
        </p>
    </div>
    <script>
        setTimeout(function () { window.location.href = 'login.php'; }, 1000);
    </script>
</body>

</html>