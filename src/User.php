<?php

namespace Knock;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use DB;
use Knock\UserAction;
use Knock\Action;
use Knock;
use Log;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = [
		'first_name', 'last_name', 'email', 'active', 'password'
	];

	/**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
	protected $hidden = [
		'password', 'remember_token',
	];
    
	public function actions(){
		return $this->hasMany('\Knock\UserAction');
	}
	
	public function hasPermission($action_id){
		return collect(
				$this->actions()
				->select('action_id')->get()->toArray())
				->flatten()
				->contains($action_id);
	}
	
	public function getAction($action_id){
		return $this->actions()->where('action_id', '=', $action_id)->first();
	}
	
	public function removeAction($action_id){
		$deleted = 0;
		try{
			$deleted = DB::delete('delete from users_actions where user_id = "'.$this->id.'" and action_id = "'.$action_id.'"');
			return $deleted;
		}catch(\Exception $e){
			return $deleted;
		}
	
	}
	
	public function assignAction(Action $action){
		
		if ($action != null){
			return UserAction::firstOrCreate(['user_id'=>$this->id, 'action_id'=>$action->id]);
		} else{
			Log::debug(__METHOD__. ' *** null action given');
		}
	}
	
	public function isActive(){
		return $this->active;
	}
	
	
}
