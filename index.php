<?php
session_start();

if(!isset($_SESSION['username'])) {
    // Benutzer ist nicht eingeloggt, leite weiter zur login.php
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitstellen System by Semaja Voyé</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/var.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="main-system">
            <div class="desktop" id="desktop">
                <div class="sidebar">
                    <ul>
                        <li id="tab0" data-tab="user-settings">
                            <i class="fa-solid fa-user"></i>
                            <?php if(isset($_SESSION['username'])) {
                                echo '<span class="username">'.$_SESSION['username'].'</span>';
                            }
                            if(isset($_SESSION['user_id'])) {
                                echo '<span class="user_id">'.$_SESSION['user_id'].'</span>';
                            } ?>
                        </li>
                        <li id="logout"><button>Logout</button></li>
                        <li id="tab1" data-tab="new-call"><img src="img/desktop-icons/new-call.png" alt="">New Call</li>
                        <li id="tab2" data-tab="map-container"><img src="img/desktop-icons/maps.png" alt="">Maps</li>
                        <li id="tab3" data-tab="searchcars"><img src="img/desktop-icons/car-search.png" alt="">Search
                            Vehicle</li>
                        <li id="tab4" data-tab="searchpersons"><img src="img/desktop-icons/person-search.png"
                                alt="">Search person</li>
                        <li id="tab5" data-tab="noteContainer"><img src="img/desktop-icons/notes.png" alt="">Notes</li>
                        <li id="tab6" data-tab="active-calls"><img src="img/desktop-icons/activedispatches.png"
                                alt="">Active Dispatches</li>

                        <div class="sidebar-footer">
                            <div class="datetime">
                                <div class="date" id="date"></div>
                                <div class="time" id="time"></div>
                            </div>
                        </div>
                    </ul>
                </div>

                <div class="apps-container">
                    <div class="user-settings-main tab-content" id="user-settings">
                        <div class="user-settings-container">
                            <div class="title">User Settings</div>

                            <div class="message"></div>
                            <?php
                            if(isset($_SESSION['username'])) {
                                echo '<span class="username"> Benutzername: '.$_SESSION['username'].'</span>';
                            }
                            ?>

                            <form action="change_password.php" method="post">
                                <div class="new-password">
                                    <label for="new-password" class="label">Neues Passwort:</label>
                                    <input type="password" name="new_password" id="new-password" required>
                                    <label for="confirm-password" class="label">Passwort bestätigen:</label>
                                    <input type="password" name="confirm_password" id="confirm-password" required>
                                    <button type="submit">Passwort ändern</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="new-call-main tab-content" id="new-call">
                        <div class="new-call-container">
                            <div class="new-call-form">
                                <div class="title">Notfallaufnahme</div>
                                <form id="new-call-form" action="create_call.php" method="post">
                                    <div class="form-group">
                                        <label for="call-number" class="label">Anrufsnummer:</label>
                                        <input type="number" id="call-number" name="call-number" class="input"
                                            maxlength="6" placeholder="Telefonnummer" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="who" class="label">Wer?</label>
                                        <div class="name-inputs">
                                            <input type="text" id="firstName" placeholder="Vorname" name="first-name">
                                            <input type="text" id="lastName" placeholder="Nachname" name="last-name">
                                        </div>

                                        <input type="date" id="dob" placeholder="Geburtsdatum" name="dob">
                                    </div>
                                    <div class="form-group">
                                        <label for="primary-unit" class="label">Streifenauswahl:</label>
                                        <select id="primary-unit" name="primary-unit" class="input" required>
                                            <option value="placeholder1">TEST</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="location" class="label">Postleitzahl:</label>
                                        <input type="number" id="location" name="location" class="input" required
                                            maxlength="5" placeholder="Postleitzahl">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="label">Beschreibung:</label>
                                        <textarea id="description" name="description" class="input" rows="4" required
                                            placeholder="Was ist passiert?"></textarea>
                                    </div>
                                    <button type="submit" class="submit-button"><span>Create Call</span></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="map-main tab-content" id="map-container">
                    </div>


                    <div class="car-main tab-content" id="searchcars">
                        <div class="car-container">
                            <div class="title">Vehicle Infos</div>
                            <div class="topContainerHead">
                                <form class="searchVeh">
                                    <input type="search" placeholder="Kennzeichen">
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                            <div class="cardetails">
                                <div class="owner">
                                    Besitzer:
                                    <div class="ownerholder">
                                        <span class="ownersp"></span>
                                    </div>
                                </div>
                                <div class="plate">
                                    Kennzeichen:
                                    <div class="plateholder">
                                        <span class="platesp"></span>
                                    </div>
                                </div>
                                <div class="job">
                                    Job:
                                    <div class="jobholder">
                                        <span class="jobsp"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="searchpersons-main tab-content" id="searchpersons">
                        <div class="searchpersons-container">
                            <div class="title">Personensuche</div>
                            <div class="topContainerHead">
                                <div class="searchPers">
                                    <input type="search" placeholder="Vorname" id="firstName">
                                    <input type="search" placeholder="Nachname" id="lastName">
                                    <button onclick="searchPersons()">Search</button>
                                </div>
                            </div>
                            <div id="personContainer" class="personContainer">
                                <div class="person">
                                    <div class="person-details">
                                        <div class="person-name">
                                            Name
                                            <div class="person-nameholder">
                                                <span class="person-namesp"></span>
                                            </div>
                                        </div>
                                        <div class="person-dob">
                                            Geburtsdatum
                                            <div class="person-dobholder">
                                                <span class="person-dobsp"></span>
                                            </div>
                                        </div>
                                        <div class="person-height">
                                            Größe
                                            <div class="person-heightholder">
                                                <span class="person-heightsp"></span>
                                            </div>
                                        </div>
                                        <div class="person-phonenumber">
                                            Telefonnummer
                                            <div class="person-phonenumberholder">
                                                <span class="person-phonenumbersp"></span>
                                            </div>
                                        </div>
                                        <div class="person-job">
                                            Arbeit
                                            <div class="person-jobholder">
                                                <span class="person-jobsp"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add this form inside the noteContainer div -->
                    <div class="note-main tab-content" id="noteContainer">
                        <div class="note-container">
                            <div class="title">Meine Notizen</div>
                            <select>
                                <option value="Notiz 1">Notiz 1</option>
                                <option value="Notiz 2">Notiz 2</option>
                            </select>
                            <div class="alertField"></div>
                            <input type="text" id="titleNote" placeholder="Titel">
                            <textarea class="editor" id="editor" placeholder="Start typing..." rows="10"></textarea>
                            <div class="buttonHolder">
                                <button>Speichern</button>
                                <button>Öffnen</button>
                                <button onclick="newNote()">Neu</button>
                            </div>
                        </div>
                    </div>

                    <div class="active-calls-main tab-content" id="active-calls">
                        <div class="title">Aktive Dispatches</div>
                        <div class="active-calls-container-holder">
                            <?php include 'active_calls.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="notification-container"></div>
        <script src="js/index.js"></script>
        <script>
            // AJAX request to handle form submission without page reload
            $(document).ready(function () {
                $("form").submit(function (e) {
                    e.preventDefault();

                    // Check the form action
                    if ($(this).attr("action") === "change_password.php") {
                        // Only execute this code for the change_password form

                        $.ajax({
                            type: "POST",
                            url: "change_password.php",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (response) {
                                // Display the message on the page
                                if (response.message) {
                                    $(".message").text(response.message);
                                }
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    } else if ($(this).attr("action") === "create_call.php") {
                        // Handle new call form
                        $.ajax({
                            type: "POST",
                            url: "create_call.php",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (response) {
                                // Handle success
                                console.log(response);
                            },
                            error: function (error) {
                                // Handle error
                                console.log(error);
                            }
                        });
                    }
                });
            });


            document.getElementById("logout").addEventListener("click", logout);

            function logout() { window.location.href = "logout.php"; }

        </script>

</body>

</html>