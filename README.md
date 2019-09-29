# Topline Base Code Project

this project is for topline team .. it gave the team a head start on any project we started 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for devloping any new project. See deployment for notes on how to deploy the project on a live system.

### Installing

before you can start on the base code you need to run composer comand to download the vendor folder 

```
$ composer update

```
after that you need to run the migration and seeders comands to set you up and runing

```
$ php artisan migrate
$ php artisan db:seed
$ composer dump-autoload
```

the above comands will provide you with some default users to use the system .. the main user is the productowner

```
$ user : productowner@app.com
$ password : passwoerd
```



