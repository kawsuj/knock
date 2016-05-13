@extends('knock::layouts.app') @section('title', 'Home')
@section('breadcrumb')
<li class="active">home</li>
@stop @section('content')
<div class="container">

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" align="center">
					<h3><strong>Knock!</strong></h3>
					<h4>Roles and Permissions</h4>
				</div>

				<div class="panel-body">
					<h4>Hi {{Auth::user()->first_name. ' ' . Auth::user()->last_name}},</h4>

					<p>
						Congratulations, you have successfully installed the <strong>Knock</strong>
						tool for Laravel 5.2 if you see this page!
					</p>

					<p>This is a brief intro to what Knock is and how you can use it in
						your own projects.</p>

					<h4>Background</h4>
					<p>Knock is Laravel 5.2 tool built from common code that I factored
						out of some of my Laravel projects into a package. It is intended
						to provide a starting point for new projects requiring user roles
						and permissions. We all know the score... nothing fancy yet so
						important we want to make sure we've got it right, hence the
						decision to package and reuse the functionality. Well, enough said
						on that, let's see how it hangs...</p>

					<h4>Functionality</h4>
					<p>Installing Knock onto a clean Laravel 5.2 installation gives you
						facilities to:
					
					
					<ol>
						<li>Create and manage users from the web user interface based on
							Laravel's default authentication facilities</li>
						<li>Define and manage user actions for your application through
							the web user interface</li>
						<li>Assign your users permissions to perform your defined actions</li>
						<li>Easily check that your users have adequate permissions to
							perform your application's defined actions</li>
						<li>Return a collection of the authenticated user's permitted actions</li>
							
					</ol>
					</p>

					<h4>Model</h4>
					<p>The diagram below shows the main classes that make up Knock and
						how they collaborate to provide simple functionality.</p>
						<br><br>
					<div align="center">
						<img class="tip" data-toggle="tooltip" data-placement="right"
							title="Knock Model" alt="Knock Model"
							src="{{asset('images/knock-model.png')}}">
					</div>
					<br><br>
					<p>Knock works by defining a set of security profiles for your
						application. You first define a set of Tags, Roles, and Actions
						for your application then use the Knock facade to check for user
						permission to 'enter' strategic points in your application based
						on your definitions. Users are assigned permissions from the Knock
						user interface. The following may shed some light on how to define
						Tags, roles, and permissions.</p>

					<p>
					
					
					<ol>
						<li><strong>Tags</strong> - A tag is the root of the security
							hierarchy consisting of a <code>name</code> and <code>description</code>.
							<br>For example, if you run the <code>KnockDatabaseSeeder</code>
							included in the package you'll notice that a tag
							called <code>knock</code> is included to represent Knock. Feel free to add as
							many tags as you may need for your application, e.g. you may want
							to create a tag to group and classify your customers, or perhaps
							a tag to identify administrators of your application. Hopefully
							it is clear how you can use tags to define closed groups of
							users, or in other words, 'tag' a group of users for
							participation in functionality of your choice.</li>
						<br>
						<li><strong>Roles</strong> - Each tag defines its own set of user
							roles. <br>For example the tag <code>knock</code> has a role <code>user-administrator</code>, associated with it. This is
							may represent users who can manage user accounts. You may want to define additional roles
							for Knock to represent other functions.</li>
						<br>
						<li><strong>Actions</strong> - Each role has its own set of
							Actions defined. Actions are specific to a role, representing
							actions that a user can perform. <br>For example, Tag=><code>knock</code>,
							Role=><code>user-administrator</code>, Action=><code>create-users</code> may indicate
							that a user with such credentials granted is a Knock administrator
							who can create users.</li>
					</ol>
					</p>

				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Usage with Examples</h3>
				</div>
				<div class="panel-body">
					<h4>Usage</h4>		
					<p>
						The examples below show how we can check if the authenticated user
						has the necessary permissions The Knock facade can be used to
						conveniently perform checks throughout your application provided
						you have defined your Tags, Roles, and actions using the following
						methods: <br>
						<br>
					
					
					<ol>
						<li><code>Knock::hasTag('knock')</code> simply checks that the
							authenticated user has been tagged with <code>'knock'</code> no
							further checks are made.<br>
							Returns <code>true</code> if passed and <code>false</code> otherwise.
							</li>
							<br>
						<li><code>Knock::hasRole('knock', 'user-administrator')</code> checks that the
							authenticated user has been tagged with <code>'knock'</code> and
							has been assigned role <code>'user-administrator '</code>no further checks are
							made.<br>
							Returns <code>true</code> if passed and <code>false</code> otherwise.
							</li>
							<br>
						<li><code>Knock::hasPermission('knock', 'permission-administrator', 'edit-permissions')</code> checks that
							the authenticated user has been tagged with <code>'knock'</code>,
							has been assigned role <code>'permission-administrator'</code>, and has permission to
							perform action <code>'edit-permissions'</code>.<br>
							Returns <code>true</code> if passed and <code>false</code> otherwise.
							</li>
							<br>
						<li><code>Knock::allPermissions()</code> gets all the permissions assigned to the authenticated user.
						<br>Returns a <code>Collection</code> of <code>Action</code> objects.  
						</li>
							<br>
						<li><code>Knock::allPermissionNames()</code> gets all the permissions assigned to the authenticated user as a string.
						<br>Returns a String list of <code>Tag->name</code>, <code>Role->name</code>, <code>Action->name</code> triplets.  
						</li>
					</ol>
					</p>

					<h4>Live Examples</h4>
					See <strong>layouts/app.blade</strong> for typical usage where items under the settings menu are shown/hidden depending on your circumstances.  
					<br><br>
					The following examples are queries run on you as an authenticated user, so you may want to modify your permissions 
					to see the effects.
					<br><br>
					<div class="code">
						<br>
						<span class="code-heading"><strong>Examples 1</strong></span> <br>
						<strong>Knock::hasTag('knock')</strong> {{Knock::hasTag('knock')?' ==> TRUE!' : '==> FALSE'}} <br>
						<strong>Knock::hasRole('knock', 'permission-administrator')</strong>{{Knock::hasRole('core', 'permission-administrator')? '==> TRUE!' : '==> FALSE '}} <br>
						<strong>Knock::hasPermission('knock', 'permission-administrator', 'delete-users')</strong>{{Knock::hasPermission('knock', 'permission-administrator', 'delete-users')? '==> TRUE!' : '==> FALSE'}}
					</div>
					<br>
					<div class="code">
						<br>
						<span class="code-heading"><strong>Examples 2</strong></span> <br>
						<strong>Knock::hasTag('xyz')</strong> {{Knock::hasTag('xyz')?'==> TRUE!' : '==> FALSE'}} <br>
						<strong>Knock::hasRole('knock', 'xyz')</strong>{{Knock::hasRole('core', 'xyz')? '==> TRUE!' : '==> FALSE '}} <br>
						<strong>Knock::hasPermission('knock', 'permission-administrator', 'xyz')</strong>{{Knock::hasPermission('knock', 'permission-administrator', 'xyz')? '==> TRUE!' : '==> FALSE'}}
					</div>
					<br>
					<div class="code">
						<br>
						<span class="code-heading"><strong>Examples 3</strong></span> <br>
						<strong>Knock::allPermissionNames()</strong> ==> {!!Knock::allPermissionNames()!!}
					</div>
					<br>
					<div class="code">
						<br>
						<span class="code-heading"><strong>Examples 4</strong></span> <br>
						<strong>Knock::permissionExists('knock', 'permission-administrator', 'view-permissions')</strong> ==> {{Knock::permissionExists('knock', 'permission-administrator', 'view-permissions')? 'YES' : 'NO'}} <br>
						<strong>Knock::permissionExists('knock', 'user-administrator', 'view-users')</strong> ==> {{Knock::permissionExists('knock', 'user-administrator', 'view-users')? 'YES' : 'NO'}} <br>
						<strong>Knock::permissionExists('knock', 'user-administrator', 'edit-users')</strong> ==> {{Knock::permissionExists('knock', 'user-administrator', 'edit-users')? 'YES' : 'NO'}} <br>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
@endsection
