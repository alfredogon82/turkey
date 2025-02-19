# Alfredo González Turkey Challenge

## Overview

This project is a web application for managing turkeys. It allows users to add, view, and generate reports (CSV and SQL) for turkeys. The application is built using PHP, MySQL, jQuery, and Bootstrap.

## Technologies Used

- **PHP**: The server-side scripting language used to build the backend of the application.
- **MySQL**: The relational database management system used to store turkey data.
- **jQuery**: A fast, small, and feature-rich JavaScript library used to simplify HTML document traversal and manipulation, event handling, and Ajax.
- **Bootstrap**: A popular CSS framework used to create responsive and mobile-first web pages.

## Features

- **Add Turkey**: Users can add new turkeys by providing details such as name, weight, age, status, and color.
- **View Turkeys**: Users can view a list of all turkeys with details such as name, weight, age, status, color, and created date.
- **Generate Reports**: Users can generate CSV and SQL reports for the turkeys.

## File Structure

- **/classes**: Contains the PHP classes for managing turkeys and generating reports.
  - `Turkey.php`: The class for managing turkey data.
  - `TurkeyExport.php`: The class for generating CSV and SQL reports.
- **/views**: Contains the HTML views for the application.
  - `list.php`: The main view for displaying the list of turkeys and the forms for adding turkeys and generating reports.
- **api.php**: The API endpoint for handling AJAX requests and generating reports.

## How to Use

1. **Add Turkey**: Click the "Add Turkey" button, fill in the details, and click "Save".
2. **Generate CSV Report**: Click the "Report" button to download a CSV report of all turkeys.
3. **Generate SQL Report**: Click the "SQL Report" button to download an SQL report of all turkeys.

The database connection string should be specified on the connect method of the database class

## Contact

For any questions or support, please contact Alfredo González at [alfredogon82@gmail.com](mailto:alfredogon82@gmail.com).