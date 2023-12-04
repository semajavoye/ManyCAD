document.addEventListener('DOMContentLoaded', (event) => {
    // Function to get formatted German weekday
    function getGermanWeekday(date) {
        const weekdays = ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'];
        return weekdays[date.getDay()];
    }

    // Function to update date and time
    function updateDateTime() {
        const dateElement = document.getElementById('date');
        const timeElement = document.getElementById('time');
        const now = new Date();

        // Format date with German weekday
        const formattedDate = getGermanWeekday(now) + ', ' + now.getDate() + '. ' + getGermanMonth(now.getMonth()) + ' ' + now.getFullYear();
        dateElement.textContent = formattedDate;

        // Format time
        const formattedTime = formatTwoDigitNumber(now.getHours()) + ':' + formatTwoDigitNumber(now.getMinutes()) + ':' + formatTwoDigitNumber(now.getSeconds());
        timeElement.textContent = formattedTime;
    }

    // Function to get formatted German month
    function getGermanMonth(monthIndex) {
        const months = ['Jan', 'Febr', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Dez'];
        return months[monthIndex];
    }

    function formatTwoDigitNumber(number) {
        return number < 10 ? '0' + number : number;
    }

    setInterval(updateDateTime, 1000);

});


function saveNote() {
    var noteContent = document.getElementById("AreanoteField").value;
    var userId = "<?php echo $_SESSION['user_id']; ?>;" // Get the user_id from the session

    // Validate that the note content is not empty before saving
    if (noteContent.trim() !== "") {
        // Use AJAX to send a request to the server to save the note
        $.ajax({
            type: "POST",
            url: "../savenote.php", // Create this PHP file to handle the saving process
            data: { content: noteContent },
            success: function (response) {
                // Handle success, e.g., show a success message
                console.log("Note saved successfully");
            },
            error: function (error) {
                // Handle errors, e.g., show an error message
                console.error("Error saving note:", error);
            }
        });
    } else {
        // Show an alert or message indicating that the note content is empty
        alert("Note content cannot be empty");
    }
}



function openNote() {

}

function newNote() {
    inputField.value = '';
}



// Tab Elements menu in dekstop for handling the menus
document.addEventListener('DOMContentLoaded', (event) => {
    // Get all tab elements
    const tabs = document.querySelectorAll('li[data-tab]');
    const sidebar = document.querySelector('.sidebar');

    // Get all tab content elements
    const tabContents = document.querySelectorAll('.tab-content');

    const main_system = document.querySelector('.main-system');

    // Add click event listener to each tab
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Hide all tab content elements
            tabContents.forEach(content => {
                content.classList.remove('active');
                main_system.classList.remove('inmenu');
            });

            // Get the data-tab attribute value of the clicked tab
            const tabId = tab.getAttribute('data-tab');

            // Show the corresponding tab content
            const activeContent = document.getElementById(tabId);
            const userheader = document.querySelector('.user-header');
            if (activeContent) {
                activeContent.classList.add('active');
                main_system.classList.add('inmenu');
                sidebar.style.display = 'none';
                userheader.style.display = 'block';
            }
        });
    });
});


function backToHome() {
    const tabContents = document.querySelectorAll('.tab-content');
    const sidebar = document.querySelector('.sidebar');
    const userheader = document.querySelector('.user-header');
    const main_system = document.querySelector('.main-system');

    tabContents.forEach(content => {
        content.classList.remove('active');
        main_system.classList.remove('inmenu');
    });

    sidebar.style.display = 'block';
    userheader.style.display = 'none';
}

function displayNotification(message, type, timeout) {
    var container = document.getElementById("notification-container");
    var existingNotifications = container.getElementsByClassName("notification");

    // Calculate the bottom position for the new notification
    var bottomPosition = 100; // Startposition für die neuen Benachrichtigungen

    // Verschiebe die bestehenden Benachrichtigungen nach oben
    for (var i = 0; i < existingNotifications.length; i++) {
        var notification = existingNotifications[i];
        var currentBottom = parseInt(notification.style.bottom, 10);
        notification.style.bottom = (currentBottom + 70) + "px";
    }

    // Create a new div element
    var notification = document.createElement("div");

    // Set its class to "notification" and the type
    notification.className = "notification " + type;

    // Set its innerHTML to the message
    notification.innerHTML = message;

    // Set the bottom position for the new notification
    notification.style.bottom = bottomPosition + "px";

    // Append this div to the notification container
    container.insertBefore(notification, container.firstChild);

    // After 5 seconds, remove this div from the container
    setTimeout(function () {
        container.removeChild(notification);
    }, timeout);
}