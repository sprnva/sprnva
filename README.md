# Sprnva /supernova/
Sprnva is a beautifully designed application starter kit for you and provides the perfect starting point for your next application. Sprnva provides the entry point in learning the MVC framework.
<br><br>
docs: http://sprnva.000webhostapp.com/
<br>
Sprnva is designed using bootstrap 4 and offers your choice of using different stacks.
![sprnva-home](https://user-images.githubusercontent.com/37282871/112921756-ee2ea900-913d-11eb-85e2-1a4d44677ffd.png)

## Features

- beautiful routing
- protected routes by authentication
- can run on php >= php5.5
- built in login and registration
- forgot password with email sending password reset link
- inspired in MVC approach
- simple database migration <i>(sync database development for everyone)</i>
- can send email with just a simple setup
- bootstrap 4 stack (can use diffrent stacks)
- jquery-3.6.0 stack (can use diffrent stacks)
- easy to deploy to a hosting server
- can add/change diffrent templates of your choice
- open-source
- easy to undertstand
- coding used is not complex good for rising artisan
- fast developing applications
- Csrf protection
- database seeder
- brightens your horizon in future engagement for massive frameworks
---
## REQUIREMENTS
- Php version supported: PHP >= php5.5
- composer
---
## INSTALLATION
- Download sprnva repo as zip or clone it to your local machine
- Open your application directory in the terminal/cmd and execute this
```bash
$ composer dump-autoload
```
- duplicate the config.example.php and rename the duplicated one to config.php . After that open config.php and then change it to your credentials.
- base_url :: This plays the important role in this setup because it's used if your application is inside a folder in a domain like example.com/sprnva/login instead use 'base_url' => '' if your application is in the root directory of a domain like example.com/login
- mysql_path :: For more flexible database migration please indicate the path of mysql in your machine including the trailing slashes.
- Environment :: this is to identify if your app is for development only or for production. Some modules may not work in production due to security reasons.
- Create a database identical to your config then go to /migration to your URL
```
$ http://localhost/sprnva/migration
```

#### Now you are in the database migration page, click the "Fresh" button to generate default tables and start adding users. You can now run your application in your browser as easy as that.
