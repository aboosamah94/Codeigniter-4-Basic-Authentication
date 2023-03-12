# Codeigniter 4 Basic Authentication
This is a CodeIgniter 4 project that provides basic authentication features, including user registration, login, and logout, witho forgot and active user by email 
The project uses the Ion Auth library to handle user authentication and authorization.

# Requirements
PHP 7.3 or later
Composer
MySQL
Installation

# To install the project, follow these steps:

- Clone the repository:

        git clone https://github.com/aboosamah94/Codeigniter-4-Basic-Authentication.git
- Navigate to the project directory:

        cd Codeigniter-4-Basic-Authentication

- Install the project dependencies:

        composer install
        
- Create a new MySQL database and import the auth.sql file located in the project's root directory to create the necessary tables.
- Copy the .env.example file to .env:

        cp .env.example .env
- Open the .env file and update the database settings to match your local environment.
- Run migrate

        php spark migrate

- Run seeder

        php spark db:seed UserSeeder

* you can find login details there in \app\database\seeder\UserSeeder.php

- Start the development server:

        php spark serve

- Login by using
 
        yoursite/login OR The application should now be accessible at http://localhost:8080/login

# Features
- User registration: Users can register for an account by providing a valid email address, a unique username, and a password.
- Login and logout: Users can log in to the application using their email address and password. Once logged in, they can access protected pages and features. Users can also log out of the application.
- Authentication and authorization: The Ion Auth library handles user authentication and authorization. The library provides a flexible and extensible system for managing users, groups, and permissions.
- Validation: The application uses CodeIgniter's built-in validation library to validate user input and ensure data integrity.

# Usage
To use the application, follow these steps:
- Register for an account by clicking the "Register" link on the login page. Provide a valid email address, a unique username, and a password.
- Log in to the application using your email address and password.
- Once logged in, you will be able to access protected pages and features, such as the "Dashboard" page.
- To log out of the application, click the "Logout" link in the navigation bar.

# License
This project is licensed under the MIT License. See the LICENSE file for details.
