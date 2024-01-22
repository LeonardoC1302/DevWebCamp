# DevWebCamp: Conference site with PayPal payments, admin panel, authentication and more advanced features

## Project Description
This is a full stack conference site in which users will be able to register for conferences and workshops from a development camp. Three possible passes are available for the users: free, virtual and in-person. Also, the site implements a PayPal payment system for the paid passes. The admin panel allows the administrator to manage the conferences, workshops, speakers, users and gifts sent to the users who buy a pass. The site is built with PHP, MySQL, HTML, SAAS and JavaScript. The site is responsive and mobile friendly and implements a Model-View-Controller (MVC) architecture for easier maintenance and scalability.

## How to run the project
1. Clone or download the project files
2. Import the database diagram from the `database` folder into your MySQL database
3. Create a .env file on the 'includes' folder and add the following variables:
```
DB_HOST=
DB_USER=
DB_PASS=
DB_NAME=

EMAIL_HOST = 
EMAIL_PORT = 
EMAIL_USER = 
EMAIL_PASS = 

HOST=
```
4. Make sure to have PHP, MySQL, Apache, NPM and Composer installed on your machine
5. Run `npm install` to install the dependencies
6. Run `composer install` to install the dependencies
7. Run `npm run dev` to compile the assets
8. Run `php -S localhost:3000` to run the server (make sure to be on the 'public' folder when running this command)
9. Open your browser and go to `localhost:3000` to see the site running

## Features
- Authentication system
- Administrator dashboard
- PayPal payment system
- Conference and workshop registration
- Implementations of multiple JavaScript libraries (for animations, charts, etc.)

## Project Screenshots
### Public Pages
![Home Page](/assets/home.png)
![Home Page](/assets/register.png)
![Home Page](/assets/registration.png)
![Home Page](/assets/event-selection.png)
![Home Page](/assets/ticket.png)

### Admin Pages
![Home Page](/assets/dashboard.png)
![Home Page](/assets/speakers.png)
![Home Page](/assets/events.png)
![Home Page](/assets/users.png)
![Home Page](/assets/gifts.png)