# Knock: Roles and Permissions#

##Description##
Provides a simple framework for Laravel 5.2 projects requiring user roles and permissions. It includes a user interface to manage your application's users and their permitted actions.

##Installation##
**
Please note that these installation notes assume you have a clean installation of Laravel 5.2.
Running the database migration will delete and recreate your users table if you already have one.    
**

###Edit composer.json###
Edit your application's composer.json file to add this package to the require section as follows:
```
"require": {
	"kawsuj/knock": "dev-master"
}
```

###Update Composer###
cd to your application's root folder and update composer as follows:
```
composer update
```

###Edit config/app.php##
Edit your application's config/app.php file:

Add the following to the providers section:
```
yajra\Datatables\DatatablesServiceProvider::class,
Collective\Html\HtmlServiceProvider::class,
Knock\KnockServiceProvider::class,
```

Add the following to the aliases section:

```
'Form'      => Collective\Html\FormFacade::class,
'Html'      => Collective\Html\HtmlFacade::class,
'Datatables'=> yajra\Datatables\Datatables::class,
'Knock'	=>	Knock\Facades\Knock::class,
```

###Edit config/auth.php##
Edit your application's config/auth.php file:

Change the providers/users/model array as follows: 
```
'model' => Knock\User::class,
```   	

Change the passwords/users/email array as follows: 
```
'email' => 'knock::auth.emails.password',
```

###Publish###
cd to your application's root folder to publish assets, migrations, seeds, and middleware as follows:
```
php artisan vendor:publish --tag=knock
```
 
###Edit app/Http/Kernel.php###
Edit your application's app/Http/Kernel.php file and add the following to the $routeMiddleware array:
```
'knock' => \App\Http\Middleware\RedirectIfNotKnockUser::class,
```

###Database Migration ###
cd to your application's root folder and run the database migration

```
php artisan migrate
```

###Database Seeder###
cd to your application's root folder and run the database seeder.

*Note: You may need to run composer dump-autoload before running the seeder* 
```
composer dump-autoload
php artisan db:seed --class=KnockDatabaseSeeder
```

The installation is now complete!

Navigate to **http://your-installation-url/knock** 

###Sign in ###
**For access to Users And Permissions and** 

**username:** ```developer@some-email-address.com```

**password:** ```secret```

**For access to Users but NOT Permissions and** 

**username:** ```user-admin@some-email-address.com```

**password:** ```secret```



When signed in, you will be directed to the Knock home page where there are further user instructions.