# Code source for [developpeurwebjunior.fr](developpeurwebjunior.fr)


Instruction for local building :

* clone project
* create your local database
* create your local .env file following .env.example template (enter your own database credentials)
* run `composer install` to install composer dependencies
* run `npm install` to install npm dependencies
* run `npm run watch` to install npm dependencies
* run `php artisan migrate` to run your migration into your database
* run `php artisan key:generate` to create an APP_KEY in your .env file


You can then serve the project locally with `php artisan serve`




# Contributor code of conduct

## Before doing anything, check that you are currently a **Project members**

* Create a new branch
* Work on your feature/improvement/bug fix
* Submit a Pull Request from your branch towards the master branch
* Wait for it to be reviewed (and possibly merged) by the projects Owners