
## Project Goal/Overview 

The main goal of this Laravel project is to create a simplified version of a performance management system (PM) based on the requirements specified in the BRD document(s). The project showcases understanding and application of SOLID principles and core application development.

The project primarily consists of two modules: Onboarding and Mission Plan.

For this implementation, the focus has been on developing the onboarding module.

## Installation & Usage
<hr/>

### Downloading the Project

It is ``Important`` to note that this project requires ```PHP 8.1``` and uses laravel ```version 10.10```

You can clone the project by running the following command in your Git Bash:

```bash
git https://github.com/ayangzy/mantrac-pcm.git
```
After cloning the project, navigate to the project directory and run the following command:
```
composer install
```
### Configure Environment
To run the application you must configure the ```.env``` environment file with your database details set up. Use the following commmand to create .env file. 
```
cp .env.example .env

```

### Mail driver configuration

To ensure the correct functioning of the application, configure your mail driver in the .env file as follows:
```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Replace the username and password with your mail server credentials.

The application uses ```database`` queue driver, that need a database table to hold the jobs. The purpose of using this Queue driver is to offload time-consuming and resource-intensive tasks to be processed asynchronously in the background. Make sure to set the following configuration in the .env file:

```
QUEUE_CONNECTION=database
```


### Generating app key
Run the following commands in the project directory to generate an app key:
```
php artisan key:generate

```
After generating the app key, run the following command to run database migrations:
```
php artisan migrate
```

## Seeding DB
Before testing this application, it is important to note that you need to run seeders to populate the necessary data in the database. To seed the database, execute the following command in your project terminal:
```
php artisan db:seed
```


### Serve your application
To start the application, run the command 
```
php artisan serve
```
 in the project directory.

## Running Queues
The application utilizes queues to send emails to staff members, notifying them about their onboarding on the platform. The email contains a link that allows them to reset their password. Additionally, staff members are also notified through email about any updates made to their profile by their organisational admin.

 To see this in action run
``` 
php artisan queue:work
```


### API Documentation
Please find the link to the API documentation below.
https://documenter.getpostman.com/view/11101115/2s93zCYfQ2
## Security

If you discover any security related issues, please email 
```
ayangefelix8@gmail.com
```
## Credits

- [Ayange Felix](https://github.com/ayangzy)


