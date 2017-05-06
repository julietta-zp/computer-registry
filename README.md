# Computer Registry
This is a simple CRUD project with basic UI. It is based on [Yii 2 Basic Project Template](https://github.com/yiisoft/yii2-app-basic).
The main task of this project is keeping records of computers and applications.

### Features
It provides the following features:
* user authentication and authorization
* admin and user roles (admins can manage all records, users can only read them)
* CRUD operations on computers and applications (application-computer relation)
* export page data as html, csv, text, excel, pdf, json

### Getting Started
1. [Install composer](https://getcomposer.org/doc/00-intro.md) if you don't have one.
2. Install the defined dependencies for this project. Run the install command `php composer.phar install`.
3. Create MySQL database. Change `'dbname'`, `'username'`, `'password'` in `'config/db.php'`.
4. Run `php yii migrate`. 
5. Run `php yii serve`.
6. It works. 
7. Login as admin (login: admin, password: admin) and try it.


