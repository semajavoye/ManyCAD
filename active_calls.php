<?php
require_once 'db.php';

// Fetch data from the database
$query = "SELECT * FROM calls";
$result = mysqli_query($conn, $query);

// Check if there are rows in the result
if (mysqli_num_rows($result) > 0) {
    // Loop through the database entries
    while ($row = mysqli_fetch_assoc($result)) {
        $callNumber = $row['call_number'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $postCode = $row['location'];

        // Insert values into HTML elements
        echo '<div class="active-call-container">
                <div class="active-calls-form">
                    <form id="active-call-form">
                        <div class="form-group">
                            <label for="call-number" class="label">Anrufsnummer:</label>
                            <span class="call-number-sp">' . $callNumber . '</span>
                        </div>
                        <div class="form-group">
                            <label for="who" class="label">Wer?</label>
                            <div class="namecontainer">
                                <span class="firstName-sp">' . $firstName . '</span>
                                <span class="lastName-sp">' . $lastName . '</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="label">Postleitzahl:</label>
                            <span class="postCode-sp">' . $postCode . '</span>
                        </div>
                    </form>
                </div>
            </div>';
    }
} else {
    echo 'No rows found';
}

mysqli_free_result($result);
mysqli_close($conn);
?>
