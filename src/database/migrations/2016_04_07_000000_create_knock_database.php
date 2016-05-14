<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnockDatabase extends Migration{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up(){
		/* if (Schema::hasTable('users')){
			//Don't go ahead with the migrationif a users table is detected.
			//TODO: KJ try to find a better way to check that authentication is not installed
			return;
		} */
		
		$this->down();
			
		Schema::create('users', function (Blueprint $table){
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->unique();
			$table->boolean('active')->default(true);
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();
		});
		
			Schema::create('password_resets', function (Blueprint $table) {
				$table->string('email')->index();
				$table->string('token')->index();
				$table->timestamp('created_at');
			});
			
 
		if(!Schema::hasTable('tags')){
			Schema::create('tags', function (Blueprint $table){
					$table->increments('id');
					$table->string('name')->unique();
					$table->mediumText('description')->nullable();
					$table->timestamps();
				});
		}
        
		if(!Schema::hasTable('roles')){
			Schema::create('roles', function (Blueprint $table){
					$table->increments('id');
					$table->integer('tag_id')->unsigned();
					$table->string('name');
					$table->mediumText('description')->nullable();
					$table->timestamps();
	
					$table->foreign('tag_id')
					->references('id')
					->on('tags')
					->onDelete('cascade');
					
					$table->unique(['tag_id', 'name']);
				});
		}
        
		if(!Schema::hasTable('actions')){
			Schema::create('actions', function (Blueprint $table){
					$table->increments('id');
					$table->integer('role_id')->unsigned();
					$table->string('name');
					$table->mediumText('description');
					$table->integer('priority')->notNull()->default(0);
					$table->timestamps();
	
					$table->foreign('role_id')
					->references('id')
					->on('roles')
					->onDelete('cascade'); 
					
					$table->unique(['role_id', 'name']);
				});
		}
		
		if(!Schema::hasTable('users_actions')){
			Schema::create('users_actions', function (Blueprint $table){
					$table->integer('user_id')->unsigned();
					$table->integer('action_id')->unsigned();
					$table->timestamps();

					$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');
					
					$table->foreign('action_id')
					->references('id')
					->on('actions');
					
					$table->unique(['user_id', 'action_id']);
				});
		}
		
		if(!Schema::hasTable('events')){
			Schema::create('events', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('transaction')->unsigned();
				$table->string('event_code');
				$table->mediumText('event_data');
				$table->timestamps();
			});
		}
		
		if(!Schema::hasTable('transactions')){
			Schema::create('transactions', function (Blueprint $table) {
				$table->increments('id');
				$table->timestamps();
			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down(){
		Schema::dropIfExists ('users_actions');
		Schema::dropIfExists ('actions');
		Schema::dropIfExists ('roles');
		Schema::dropIfExists ('tags');
		Schema::dropIfExists ('password_resets');
		Schema::dropIfExists ('users');
		Schema::dropIfExists('events');
		Schema::dropIfExists('transactions');
	}
}
