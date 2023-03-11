# Codeigniter 4 Basic Authentication
 Basic Login Signup to get started for Codeigniter 4 project
 
To use the CodeIgniter 4 Basic Authentication project from GitHub, you can follow these general steps:

1 -Clone the project: First, you will need to clone the project from GitHub to your local machine. To do this, you can run the following command in your terminal:
 
  git clone https://github.com/aboosamah94/Codeigniter-4-Basic-Authentication.git

2- Install dependencies: Next, you will need to install the project's dependencies, including CodeIgniter 4 and any third-party libraries. To do this, navigate to the project directory in your terminal and run the following command:

 composer install
 
This will install all the required dependencies specified in the composer.json file.
 
3- make your database

4- Configure the database connection: Next, you will need to configure the database connection in the .env file. Open the file in your text editor and modify the following lines to match your database settings:
 
  database.default.hostname = localhost
  database.default.database = your_database
  database.default.username = your_username
  database.default.password = your_password
  database.default.DBDriver = MySQLi
 
then run 
 
  php spark migrate
  
after that run

 php spark db:seed UserSeeder
 
in site login to

yoursite/login

by using

 admin@demo.com
 12345678

