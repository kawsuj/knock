<?php

namespace Knock;

use Illuminate\Database\Eloquent\Model;
use Knock\User;
use Knock as KnockFacade;

class Action extends Model
{
	protected $table = 'actions';
    protected $fillable = ['role_id', 'name', 'description'];
    
    public function role(){
		return $this->belongsTo(\Knock\Role::class);
	}
	
	public function peep(){
		$result = [];
		$result['action'] =  $this->name;
		$result['role'] = $this->role->name;
		$result['tag'] =  $this->role->tag->name;
		return $result;
	}
	
	public function users(){
		$users = collect();
		foreach (User::all() as $user){
			if (KnockFacade::hasPermission($this->role->tag->name, $this->role->name, $this->name, $user->id)){
				$users->push($user);
				
			}
		}
		return $users;
	}
    
	public function removeAllUsages(){
		$users = collect();
		foreach ($this->users() as $user){
			if ($user->removeAction($this->id) > 0){
				$users->push($user);
			}
		}
		return $users;
	}
	
	public function lt(Action $action){
		return (boolean) $this->priority < $action->priority;
	}
    
	public function gt(Action $action){
		return (boolean) $this->priority > $action->priority;
	}
    
}
