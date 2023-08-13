# Introduction.
Docker, PHP and Vue Application 

This is a simple PHP application to extract csv data. 

- Upload the CSV file ( fomat is under employee.csv ) 
- Imports the CSV file into a database
- Displays the list of Employees
- Allows the user to edit an Employee’s Email Address
- Shows the average salary of each company

This application has not used any PHP framework or 3rd party PHP libraries for the ORM layer, or CSV handling.

# Install
If you do not have docker installed in your machine please follow the instructions here https://docs.docker.com/get-docker/ 

Once you set up Docker. Please execute 
`docker-compose up -d` from your command line. That should then build the images required for this application.


# Webserver
You can access the site on http://localhost:8080/

# Docker
There are three containers
 - MySQL
 - PHP
 - NGINX

The inital database query is set in `dbscript` folder. That will create the table needed for this application.

# Future improvements 

 It is possible to make loads of improvements to this application based on unlimited time. 

 - Create autoloader for classes so we can ignore including the classes in `classes` folder
 - Create a new endpoint with more routing capabilies so we can have much more controll over some new features that may come up
 - Load assests (CSS and JS) into the application rather than using CDN paths so we can have a bit more reliable application
 - When initiating the entity , we can move the columns been defined in to a method rather than from the constructor.
 - Create a Absrtact Contoller for common methods
 

# More info 

The `main` branch has and application that use Docker, PHP and Vue JS .
The `php-no-js-app` branch only got PHP and Docker for the application. 



