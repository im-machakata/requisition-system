# What is this?

This is a very basic Online Requisition System. 

## Users

The system can be used by 3 different users who are: **The Admin**, **The Accounts** and **The Supervisors**.

## Functionality

All users can create a new requisition from the three defined requisition types. However, there are a couple of things each user can do that the other can not.

### The Admin

The admin can lookup or add a new clients to the system.

### The Accounts

The accounts can disburse funds to any approved requisitions. They can not approve any requisitions on their own.

### The Supervisor

The supervisor is the only one who can approve or reject requisitions. This leaves the requisition open for the accounts team to disburse the funds.

### The User

A (general) user can interact with the system as a normal  employee with no special rights or roles. This was done so that you can experience the system from their perspective.

## System Design

The documentation provided had a desktop theme and some effort were made to make it look good on desktops than on mobile devices. The entire system was built using Bootstrap 5, jQuery and uses CodeIgniter 4 as the sole PHP framework. It follows the MVC (Model-View-Controller) architect.

### Views 

Views, which are basically the frontend html are located in `app/Views`. You can edit them to add beautiful designs and more.

### Controllers

Controllers, which basically allows us to handle request separately and not in the frontend code. It makes our code nicer :)

These can be found in `app/Controllers`

### Models

Models provide an easy interaction with the database, providing helper functions to manipulate the database. These can be found in `app/Models`

### Database Migrations

Database migrations contain the definitions of our database tables. These can be found in `app/Database/Migrations`.

## Installation (5 mins)

To install the system, clone or download the project zip file from the **Code** button at the top. You should have PHP 8.1 or greater already installed (either via XAMPP, WAMP, or MAMP)

You will also need to download [composer](https://getcomposer.org) and install it.

When the installation is done, you have to move into your working directory eg. `cd C:/xampp/htdocs/requisition_system`

## Database Configurations (3 min)

Database configurations have to be stored in a **.env** file. The system will throw an error when these configurations are missing so you can copy the **env** to **.env** and adjust your `database.*` and `default.login` configurations to match your servers and to your linking respectively. 

You will also need to create an empty database for the system through your `PHPMyAdmin` => [http://localhost/phpmyadmin](http://localhost/phpmyadmin) matching the provided `database.default.database`.

## Database Seeding (1 min)

Once you have installed and configured the system, you can open the following web page to seed the database `http://localhost/requisition_system/sys/install`. If all goes well, you'll see a very comforting message.

## Admin Auth

Once the preceding step is completed, you will be able to login as an admin using the username and password in the .env file

> **NB:** Additional features may be added at a much later time but is not guaranteed. If you would like to see that, kindly star this project and perhaps create an issue :) - TIA
