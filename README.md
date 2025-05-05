# LaraVueTasks

Laravel: Laravel is a free and open-source PHP-based web framework for building web applications 


**Prerequisites** :

- Laravel Herd
- Php latest version
- Composer(dependency manager)
- laravel Installer
- Database(Maria DB)
- Basic Konwledge on Html,css,JS and Php

After all these i am ready to create project in Laravel:

Here we can create project in 3 methods:
1.Laravel Herd
2.In CMD with certain commands along with xampp software(which contains in build php,apache server,mysql)
3.install above all node js,php,composer locally and run commands through CMD

Process of Creating Project:

Step 1: Create a Laravel Project

composer create-project laravel/laravel task_app
                  or
laravel new project-name 

cd project-name 

 Step 2: Install Laravel Breeze with Vue

composer require laravel/breeze --dev

php artisan breeze:install vue

npm install

npm run dev

 Step 3 : Database Set Up

In Database eun bewlow statements

CREATE DATABASE taskapp;

GRANT ALL PRIVILEGES ON taskapp.* TO 'task_user'@'localhost';

FLUSH PRIVILEGES;

EXIT;

change above details in .env file

php artisan migrate // this will create 3 migrations users_table,cache_table,jobs_table)

Step 4: Create Task Model(Task.php) and Migration // this will create Task.php and tasks_table

php artisan make:model Task -m

php artisan migrate // this will create tasks_table in Database

Step 5: Define Relationships in Models

Task.php
User.php

Step 6: Create API Routes
in routes/web.php

Step 7: Create Task Controller

php artisan make:controller TaskController

add index,store,update,remove,togglecompleted functions

step 8 : create task policy and register in AuthServiceProvider

Step 9: write the code to display Frontend in DashBoard.vue

at last run for php artisan serve & npm run dev










