

# Entry Keeper Book

**Version:** 1.0.0  
**Last Updated:** [Insert date]

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction

The **Entry Keeper Book** project is designed to digitalize and streamline the process of managing visitor check-ins and check-outs at facilities. This web-based application replaces traditional manual entry systems with a more efficient, error-resistant, and user-friendly interface, enabling security personnel to effectively track and manage visitor data in real-time.

## Features

- **Visitor Registration:** Easily register new visitors with essential details.
- **Check-In/Check-Out:** Real-time functionality for checking visitors in and out.
- **Role-Based Access:** Different access levels for Admin and Guards to manage data securely.
- **Reporting Tools:** Generate reports for visitor movements and statistics.
- **Search Functionality:** Quickly search for visitor records.
- **User Management:** Admins can add, edit, or delete user accounts.
  
## Technologies Used

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
- **Web Server:** XAMPP

## Installation

To set up the Entry Keeper Book project locally, follow these steps:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/perivo/entry-keeper-book.git
   cd entry-keeper-book
   ```

2. **Install XAMPP:** 
   Download and install [XAMPP](https://www.apachefriends.org/index.html) on your machine.

3. **Start Apache and MySQL:**
   Open XAMPP Control Panel and start the Apache and MySQL services.

4. **Create Database:**
   - Open phpMyAdmin by navigating to `http://localhost/phpmyadmin` in your browser.
   - Create a new database named `entry_keeper_db`.
   - Import the SQL scripts from the `sql` folder in the project repository to create necessary tables.

5. **Configure Database Connection:**
   - Open the `dbconnect.php` file located in the `includes` directory.
   - Update the database connection settings (hostname, username, password) as per your configuration.

6. **Access the Application:**
   - Place the project folder in the `htdocs` directory of your XAMPP installation (usually located in `C:\xampp\htdocs`).
   - Open your browser and navigate to `http://localhost/entry-keeper-book`.

## Usage

- Navigate through the sidebar to register visitors, check them in and out, manage users, and view reports.
- Admin users can manage user accounts and access all functionalities, while guards can only check in and out visitors.

## Testing

The project includes a basic testing framework for its functionalities. You can perform unit tests for individual modules, system integration testing, and end-to-end testing for check-in/out processes.

## Contributing

Contributions are welcome! If you would like to contribute to this project, please fork the repository and submit a pull request. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or feedback, please reach out to:

- **Name:** [Ivo Pereira]
- **Email:** [ivopereiraix3@gmail.com]
- **GitHub:** [Your GitHub Profile](https://github.com/yperivo)
