<?php


use Illuminate\Database\Seeder;
use Knock\User;
use Knock\Tag;
use Knock\Action;

class KnockDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//cleanup database
        DB::table('users_actions')->delete();
        DB::table('actions')->delete();
        DB::table('roles')->delete();
        DB::table('tags')->delete();
        DB::table('users')->delete();

        //create a user that can manage users and Tags
        $devUser = User::create([
        		'email' => 'developer@some-email-address.com',
        		'password'=> bcrypt('secret'),
        		'first_name'=>'John Developer',
        		'last_name'=>'Doe',
        		'active'=>'1'
        ]);
        
        //create a User that can manage users but not Tags
        $userAdmin = User::create([
        		'email' => 'user-admin@some-email-address.com',
        		'password'=> bcrypt('secret'),
        		'first_name'=>'Jane Useradmin',
        		'last_name'=>'Doe',
        		'active'=>'1'
        ]);
        
        //create a User that can manage users but not Tags
        $kawsuj= User::create([
        		'email' => 'kawsuj@gmail.com',
        		'password'=> bcrypt('nevertold'),
        		'first_name'=>'Kawsu',
        		'last_name'=>'Jawara',
        		'active'=>'1'
        ]);
        
       ////////// USER MANAGEMENT  ////////////////////////////////// 
       //Create Tags / Roles / Permissions
       //assign to user
       $action = Knock::createAction(
       		'knock', 'user-administrator', 'view-users',
       		"This tag represents the users allowed to enter the Knock modules and is used to authenticate users into the knock module.<br><span class='knock-tag-color'> See Knock\Knock->isKnockUser()</span>",
       		"Manages users",
       		'Can view user details');
       $userAdmin->assignAction($action);
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       $action = Knock::createAction(
       		'knock', 'user-administrator', 'create-users',
       		"This tag represents the users allowed to enter the Knock modules and is used to authenticate users into the knock module.<br><span class='knock-tag-color'> See Knock\Knock->isKnockUser()</span>",
       		"Manages users",
       		'Can Create new users');
       $userAdmin->assignAction($action);
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       $action = Knock::createAction(
       		'knock', 'user-administrator', 'edit-users',
       		"This tag represents the users allowed to enter the Knock modules and is used to authenticate users into the knock module.<br><span class='knock-tag-color'> See Knock\Knock->isKnockUser()</span>",
       		"Manages users",
       		'Can Edit existing users');
       $userAdmin->assignAction($action);
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       $action = Knock::createAction(
       		'knock', 'user-administrator', 'delete-users',
       		"This tag represents the users allowed to enter the Knock modules and is used to authenticate users into the knock module.<br><span class='knock-tag-color'> See Knock\Knock->isKnockUser()</span>",
       		"Manages users",
       		'Can Delete existing users');
       $userAdmin->assignAction($action);
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       ///////  PERMISSION MANAGEMENT ////////////////
       
       $action = Knock::createAction(
       		'knock', 'permission-administrator', 'view-permissions',
       		"Users define Tags, Roles, and Permissions",
       		"Manages Application roles and permissions",
       		"Can view permission definitions");
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       $action = Knock::createAction(
       		'knock', 'permission-administrator', 'create-permissions',
       		"Users define Tags, Roles, and Permissions",
       		"Manages Application roles and permissions",
       		"Can create new permission definitions");
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       $action = Knock::createAction(
       		'knock', 'permission-administrator', 'edit-permissions',
       		"Users define Tags, Roles, and Permissions",
       		"Manages Application roles and permissions",
       		"Can edit existing permission definitions");
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
        
       $action = Knock::createAction(
       		'knock', 'permission-administrator', 'delete-permissions',
       		"Users define Tags, Roles, and Permissions",
       		"Manages Application roles and permissions",
       		"Can delete permission definitions");
       $devUser->assignAction($action);
       $kawsuj->assignAction($action);
       
       ///////  BURWASH ACTIONS ////////////////
       $action = Knock::createAction(
       		'burwash', 'burwash-administrator', 'all-permissions',
       		"Users of the Burwash web services",
       		"Administrators of the burwash web service",
       		"Can do all Burwash Web Service operations");
       $kawsuj->assignAction($action);
       $devUser->assignAction($action);
       $userAdmin->assignAction($action);
    }
    

    
}
