<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Knock\User;

class KnockPermissionQueryTests extends TestCase
{
	use DatabaseTransactions,  WithoutMiddleware;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(false);
    }
    
    /**
     * @test
     * 
     * hasTag('invlid-tag')
     */
    function it_should_return_false_if_authenticated_user_queried_invalid_tag(){
    	//Setup test
		$user = factory(User::class)->create();
		$this->be($user);
		$service = new App\KnockDelegate;
    	$result = $service->hasTag('invlid-tag');
    	$this->assertEquals($result, false);
    }
    
    /**
     * @test
     * hasTag('valid-tag')
     */
    function it_should_return_true_if_authenticated_user_queried_valid_tag(){
		//Setup test
		$user = factory(User::class)->create();
		$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createTag('valid-tag');
    	$user->assignAction($action);
    	
    	$result = $service->hasTag('valid-tag');
    	$this->assertEquals($result, true);
    } 
    
    /**
     * @test
     * hasRole('valid-tag', 'invalid-role')
     */
    function it_should_return_false_if_authenticated_user_queried_valid_tag_invalid_role(){
    	//Setup test
    	$user = factory(User::class)->create();
    	$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createRole('valid-tag', 'valid-role');
    	$user->assignAction($action);
    	 
    	$result = $service->hasRole('valid-tag', 'invalid-role');
    	$this->assertEquals($result, false);
    }
    
    /**
     * @test
     * hasRole('valid-tag', 'valid-role')
     */
    function it_should_return_true_if_authenticated_user_queried_valid_tag_valid_role(){
    	//Setup test
    	$user = factory(User::class)->create();
    	$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createRole('valid-tag', 'valid-role', 'Test Tag desc', 'Test Role Desc');
    	$user->assignAction($action);
    
    	$result = $service->hasRole('valid-tag', 'valid-role');
    	$this->assertEquals($result, true);
    }
    
    /**
     * @test
     * hasPermission('valid-tag', 'valid-role', 'invalid-action')
     */
    function it_should_return_false_if_authenticated_user_queried_valid_tag_valid_role_invalid_action(){
    	//Setup test
    	$user = factory(User::class)->create();
    	$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createAction('valid-tag', 'valid-role', 'valid-action');
    	$user->assignAction($action);
    
    	$result = $service->hasPermission('valid-tag', 'valid-role', 'invalid-action');
    	$this->assertEquals($result, false);
    }
    
    /**
     * @test
     * hasPermission('valid-tag', 'valid-role', 'valid-action')
     */
    function it_should_return_true_if_authenticated_user_queried_valid_tag_valid_role_valid_action(){
    	//Setup test
    	$user = factory(User::class)->create();
    	$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createAction('valid-tag', 'valid-role', 'valid-action');
    	$user->assignAction($action);
    
    	$result = $service->hasPermission('valid-tag', 'valid-role', 'valid-action');
    	$this->assertEquals($result, true);
    }
    
    /**
     * @test
     * hasPermission('valid-tag', 'valid-role', 'valid-action', $user->id)
     */
    function it_should_return_true_if_given_user_queried_valid_tag_valid_role_valid_action(){
    	//Setup test
    	$user = factory(User::class)->create();
    	$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createAction('valid-tag', 'valid-role', 'valid-action');
    	$user->assignAction($action);
    
    	$result = $service->hasPermission('valid-tag', 'valid-role', 'valid-action', $user->id);
    	$this->assertEquals($result, true);
    }
    
    /**
     * @test
     * Tests the Knock::hasPermission(Tag, Role, Action, User) where a user is supplied
     * hasPermission(null, 'valid-role', 'valid-action', $user->id)
     */
    function it_should_return_false_if_given_user_queried_null_tag_valid_role_valid_action(){
    	//Setup test
    	$user = factory(User::class)->create();
    	//$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createAction('valid-tag', 'valid-role', 'valid-action');
    	$user->assignAction($action);
    
    	$result = $service->hasPermission(null, 'valid-role', 'valid-action', $user->id);
    	$this->assertEquals($result, false);
    } 
    
   /**
     * @test
     * hasPermission('valid-tag', null, 'valid-action')
     */
    function it_should_return_false_if_authenticated_user_has_been_assigned_valid_tag_but_null_role_valid_action(){
    	//Setup test
    	$user = factory(User::class)->create();
    	//$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createAction('valid-tag', 'valid-role', 'valid-action');
    	$user->assignAction($action);
    
    	$result = $service->hasPermission('valid-tag', null, 'valid-action');
    	$this->assertEquals($result, false);
    }
    
    /**
     * @test
     * hasPermission('valid-tag', 'valid-role', null)
     */
    function it_should_return_false_if_authenticated_user_has_been_assigned_valid_tag_but_valid_role_null_action(){
    	//Setup test
    	$user = factory(User::class)->create();
    	//$this->be($user);
    	$service = new App\KnockDelegate;
    	$action = $service->createAction('valid-tag', 'valid-role', 'valid-action');
    	$user->assignAction($action);
    
    	$result = $service->hasPermission('valid-tag', 'valid-role', null);
    	$this->assertEquals($result, false);
    }
    
    
}
