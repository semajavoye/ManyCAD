<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Benutzer ist nicht eingeloggt, leite weiter zur login.php
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitstellen System by Semaja Voyé</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/menus.css">
    <link rel="stylesheet" href="css/var.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="loader-container">
            <img src="img/logo.png" alt="Logo" class="logo">
            <div class="horizontal-loader">
                <div class="horizontal-loader-progress"></div>
            </div>
        </div>

        <div class="main-system">
            <div class="desktop" id="desktop">
                <!-- Navigation -->
                <div class="user-header">
                    <img onclick="backToHome()" src="img/desktop-icons/to-home.png" alt="">
                </div>
                <div class="desktop-icons">
                    <ul>
                        <li id="tab1" data-tab="new-call"><img src="img/desktop-icons/new-call.png" alt=""></li>
                        <li id="tab2" data-tab="map-container"><img src="img/desktop-icons/maps.png" alt=""></li>
                        <li id="tab3" data-tab="searchcars"><img src="img/desktop-icons/car-search.png" alt=""></li>
                        <li id="tab4" data-tab="searchpersons"><img src="img/desktop-icons/person-search.png" alt="">
                        </li>
                        <li id="tab5" data-tab="noteContainer"><img src="img/desktop-icons/notes.png" alt=""></li>
                        <li id="tab6" data-tab="active-calls"><img src="img/desktop-icons/activedispatches.png" alt="">
                        </li>
                    </ul>
                </div>

                <!-- Main System für das Hinzufügen von Anrufen -->
                <div class="new-call-main tab-content" id="new-call">
                    <div class="call-infos">
                        <div class="callform">
                            <form id="call-form">
                                Notfallaufnahme
                                <div class="form-group">
                                    <label for="call-number" class="label">Anrufsnummer:</label>
                                    <input type="number" id="call-number" name="call-number" class="input" max=6
                                        placeholder="Telefonnummer" required>
                                </div>
                                <div class="form-group">
                                    <label for="who" class="label">Wer?</label>
                                    <input type="text" id="firstName" placeholder="Vorname">
                                    <input type="text" id="lastName" placeholder="Nachname">
                                    <input type="date" id="dob" placeholder="Geburtsdatum">
                                </div>
                                <div class="form-group">
                                    <label for="primary-unit" class="label">Streifenauswahl:</label>
                                    <select id="primary-unit" name="primary-unit" class="input" required></select>
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
                                <button type="button" class="submit-button" onclick="createCall()"><span>Create
                                        Call</span></button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="active-calls-main tab-content" id="active-calls">
                    Aktive Dispatches
                    <div class="active-calls-container">
                        <div class="active-call-infos">
                            <div class="active-callform">
                                <form id="active-call-form">
                                    <div class="form-group">
                                        <label for="call-number" class="label">Anrufsnummer:</label>
                                        <span class="call-number-sp"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="who" class="label">Wer?</label>
                                        <div class="namecontainer">
                                            <span class="firstName-sp"></span>
                                            <span class="lastName-sp"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="location" class="label">Postleitzahl:</label>
                                        <span class="postCode-sp"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="map-main tab-content" id="map-container">
                    <div id="map"></div>
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                </div>
                <div class="car  tab-content" id="searchcars">
                    <div class="car-infos">
                        <div class="topContainerHead">
                            Vehicle Infos
                            <form class="searchVeh">
                                <input type="search" placeholder="Kennzeichen">
                                <button type="submit">Search</button>
                            </form>
                        </div>
                        <div class="cardetails">
                            <div class="owner">
                                Besitzer:
                                <div class="ownerholder">
                                    <span class="ownersp">Semaja Voye</span>
                                </div>
                            </div>
                            <div class="plate">
                                Kennzeichen:
                                <div class="plateholder">
                                    <span class="platesp">ING 365</span>
                                </div>
                            </div>
                            <div class="job">
                                Job:
                                <div class="jobholder">
                                    <span class="jobsp">Police</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="searchpersons-main tab-content" id="searchpersons">
                <div class="person-infos">
                    <div class="topContainerHead">
                        Personensuche
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
                                        <span class="person-namesp">Semaja Voye</span>
                                    </div>
                                </div>
                                <div class="person-dob">
                                    Geburtsdatum
                                    <div class="person-dobholder">
                                        <span class="person-dobsp">31.10.2008</span>
                                    </div>
                                </div>
                                <div class="person-height">
                                    Größe
                                    <div class="person-heightholder">
                                        <span class="person-heightsp">180</span>
                                    </div>
                                </div>
                                <div class="person-phonenumber">
                                    Telefonnummer
                                    <div class="person-phonenumberholder">
                                        <span class="person-phonenumbersp">123123</span>
                                    </div>
                                </div>
                                <div class="person-job">
                                    Arbeit
                                    <div class="person-jobholder">
                                        <span class="person-jobsp">IT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add this form inside the noteContainer div -->
            <div class="noteContainer tab-content" id="noteContainer">
                <div class="noteField">
                    Meine Notizen
                    <select>
                        <option value="Notiz 1">Notiz 1</option>
                        <option value="Notiz 2">Notiz 2</option>
                    </select>
                    <div class="alertField"></div>
                    <input type="text" id="titleNote" placeholder="Titel">
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                    <div class="buttonHolder">
                        <button>Speichern</button>
                        <button>Öffnen</button>
                        <button>Neu</button>
                    </div>
                </div>
            </div>

            <div class="user-settings-main tab-content" id="user-settings">
                <h1>User Settings</h1>

                
                <?php if (isset($_SESSION['username'])) {
                    echo '<span class="username">' . $_SESSION['username'] . '</span>';
                } ?>
            </div>

            <div class="taskbar">
                <div class="power-btn" id="powerbtn">
                    <form method="post" action="logout.php">
                        <button type="submit" style="border: none; background-color: transparent;"><img
                                src="img/power-button.png" alt="Shutdown Button"></button>
                    </form>
                </div>
                <div class="apps" id="user">
                    <ul>
                        <li data-tab="user-settings">
                            <i class="fa-solid fa-user"></i>
                            <?php if (isset($_SESSION['username'])) {
                                echo '<span class="username">' . $_SESSION['username'] . '</span>';
                            } ?>
                        </li>
                    </ul>
                </div>

                <div class="datetime">
                    <div class="date" id="date"></div>
                    <div class="time" id="time"></div>
                </div>
                <div class="panicbutton" id="panicbtn"><img src="img/panicbtn.png" alt="Panic"></div>
            </div>
        </div>
    </div>

    <script src="js/nui_int.js"></script>
    <script src="js/windowonl.js"></script>
    <script src="js/index.js"></script>
</body>

</html>