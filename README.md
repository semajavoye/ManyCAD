# ManyCAD Project

## Overview

ManyCAD is a web-based application designed to manage various aspects of a CAD (Computer-Aided Dispatch) system. This system is likely used for dispatching, tracking, and managing calls, vehicles, notes, and user interactions within an organization. The project is structured with a mix of PHP backend files, HTML front-end pages, CSS for styling, and a MySQL database for data persistence.

# ABOUT THE PROJECTS FUTURE
As I don´t have time to comeplete the Proejct and/or work on it, it is now open source to everyone and I´m really interested in what it can be when users are working on it. As of that, Pull requests are VERY welcomed and I will have a big smile on my face if this is going to get nicer as it is now. **THANKS FOR EVERY STEP FORWARD!!!**

## Features

- **User Authentication**: Support for user login and logout functionalities, along with the ability to change passwords.
- **Call Management**: Creation and active monitoring of calls, allowing for efficient dispatch handling.
- **Vehicle Tracking**: A dedicated section for managing vehicle information, including ownership, plate numbers, and associated jobs.
- **Note Taking**: Functionality to create and manage notes, useful for adding additional information to calls or other entities.
- **Data Backup**: A feature for backing up important data, ensuring data integrity and availability.
- **Styling and UI**: Custom CSS styling for the application, ensuring a consistent and user-friendly interface across different modules.

## Technical Details

### Database

The application uses a MySQL database named `manycad`, with tables for users, calls, vehicles, notes, and persons. Each table is designed with primary keys and relevant fields to store necessary data efficiently. The database schema includes auto-increment for primary keys to ensure unique identifiers for records.

### Backend

The backend is developed in PHP, handling server-side logic including database interactions, session management, and request handling. The `db.php` file establishes a connection to the MySQL database, which is a critical component for the application's functionality.

### Frontend

The frontend consists of HTML pages styled with CSS, providing a user interface for interaction with the application. The `apps.html` file likely serves as a dashboard or main application page, with additional pages like `login.php` and `logout.php` for user authentication. CSS files like `index.css` and `admin.css` define the visual aspects of the application, ensuring a cohesive look and feel.

### Directory Structure

- **PHP Files**: Core application logic and pages (login.php, logout.php, admin.php, etc.).
- **HTML Files**: Frontend pages (apps.html, backup.html).
- **CSS Directory**: Styling for the application, organized into general and app-specific styles.
- **JS Directory**: Contains JavaScript files, potentially for dynamic interactions on the frontend.
- **Database File**: `manycad.sql` for setting up the database schema and initial data.

## Setup and Installation

1. **Database Setup**: Import the `manycad.sql` file into a MySQL database to create the necessary tables and initial data.
2. **Server Configuration**: Place the project files in a server environment like XAMPP/WAMP, ensuring PHP and MySQL are available.
3. **Configuration**: Update the `db.php` file with the correct database connection details if different from the defaults.

## Usage

After setting up the project, navigate to the `login.php` page in a web browser to access the application. Use the provided credentials in the `users` table for initial login.

## Conclusion

ManyCAD is a comprehensive solution for managing CAD-related tasks, offering a range of features from user management to call dispatching. Its modular design and use of web technologies make it a flexible and accessible tool for organizations looking to streamline their dispatch operations.