<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# About
Questionnaire app with text and yes/no questions created in PHP/Laravel 9, Jquery and Bootstrap.

# Usage
Server start
```
php artisan serve
```

**!! Only admin can create questionnaire - after running migrations it's necessary to register a user in a traditional manner and then in database add true value (1) in 'Admin' field !!**

# Features
Admin user can create and edit questionnaries with yes/no and text questions. In admin view there's list of recent entries that can be managed and a summary of every poll.

# Code

## **Views**

### *resources/views*
Standard user views.

### *resources/views/admin*
Admin user views. Smaller components in /components such as adding new questionnaries and scripts for them.

### *resources/views/layouts*
Main app layout. Smaller components in /components such as navigation.

## **Controllers**

### *app/Http/Controllers/Controller.php*
Controller with logic for guest user.

### *app/Http/Controllers/HomeController.php*
Controller with logic for standard logged user.

### *app/Http/Controllers/AdminHomeController.php*
Controller with logic for admin user.

## **Admin middleware**

### *database/migrations/2014_10_12_000000_create_users_table.php*
In standard Laravel user migration there's added boolean column 'Admin' with default false value. 

### *app/Http/Middleware/Admin.php*
Main file with admin authorization logic.

### *app/Models/User.php*
In user model there's isAdmin() function, that checks if given user has 'true' value in 'Admin' column in database.

### *app/Http/Kernel.php*
In 'protected $routeMiddleware' there's a new line that registers admin middleware.