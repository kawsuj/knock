<?php

namespace Knock;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Knock\Tag;
use Knock\Role;
use Knock\Action;
use Knock\User;
use Auth;
use Log;
use Illuminate\Database\Eloquent\Collection;
use Knock\KnockCascadeDeleteAttemptException;

//All services to Knock

/**
 * Handles all Knock operations
 * @author Kawsu
 *
 */
trait KnockServices{
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @return boolean true if user has given tag
	 */
	public function hasTag($tag) {
		if (Auth::guest ()){
			return false;
		}
		
		if ($tag === null){
			return false;
		}
		
		foreach ( Auth::user ()->actions as $userAction ) {
			$myActions = Action::findOrFail ( $userAction->action_id )->peep ();
			if ($tag === $myActions ['tag']){ 
				return true;
			}
		}
		return false;
		
	}

	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @return boolean true if user has given role
	 */
	public function hasRole($tag, $role) {
		if (Auth::guest ())
			return false;
		
		if ($tag === null || $role === null)
			return false;
		
		foreach ( Auth::user ()->actions as $userAction ) {
			$myActions = Action::findOrFail ( $userAction->action_id )->peep ();
			if ($tag === $myActions ['tag'] && $role  === $myActions ['role']){ 
				return true;
			}
		}
		return false;
		
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $tagDesc Tag Description
	 * @param String $roleDesc Role description
	 * @param String $user_id ID of user to check (authenticated user is checked if not supplied)
	 * @return boolean true if user has given permission
	 */
	public function hasPermission($tag, $role, $action, $user_id=null) {
		if (Auth::guest ())
			return false;
		
		if ($tag === null || $role === null || $action === null)
			return false;
	
		$user;
		if($user_id == null){
			$user = Auth::user();
		}else{
			$user = User::findOrFail($user_id);
		}
		
		foreach ($user->actions as $userAction ) {
			$myActions = Action::findOrFail ( $userAction->action_id )->peep ();
			if (($tag === $myActions ['tag']) && ($role  === $myActions ['role']) && ($action  === $myActions ['action'])){ 
				return true;
			}
		}
		return false;
	}
	
	/**
	 * @return Collection of Action objects assigned to the authenticated user
	 */
	public function allPermissions(){
		if (Auth::guest ())
			return null;
		
		$permissions = collect([]);
		foreach(Auth::user()->actions as $userAction){
			$permissions->push(Action::findOrFail($userAction->action_id ));
		}
		
		return $permissions;
	}
	
	/**
	 * @return String list of tag names 
	 */
	public function allPermissionNames(){
		$permissions = $this->allPermissions();
		$strPermissions = '';
		foreach($permissions as $action){
			$strPermissions .= "<br>&nbsp;&nbsp;[".$action->role->tag->name.", ". $action->role->name . ", ". $action->name ."]";
		}
		return $strPermissions;
	}
	
	/**
	 * @return true if the authenticated user is a knock user, otherwise logs the fact returns false
	 */
	public function isKnockUser(){
		$isKnockUser = $this->hasTag('knock');
		if (!$isKnockUser){
			Log::debug(Auth::user()->email. ' is not a Knock UserKnock user');
		}
		return $isKnockUser;
		
	}
	
	/////////// CREATION METHODS  //////////////
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $tagDesc Tag Description
	 */
	public function createTag($tag, $tagDesc=null){
		return $this->createAction($tag, null, null, $tagDesc, null, null);
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $tagDesc Tag Description
	 * @param String $roleDesc Role description
	 */
	public function createRole($tag, $role, $tagDesc=null, $roleDesc=null){
		return $this->createAction($tag, $role, null, $tagDesc, $roleDesc, null);
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $tagDesc Tag Description
	 * @param String $roleDesc Role description
	 * @param String $action Action name
	 * @param String $actionDesc Action description
	 * @return Action object created
	 */
	public function createAction($tag, $role=null, $action=null, $tagDesc=null, $roleDesc=null, $actionDesc=null){
		if ($tag===null) {
			Log::debug('knock: Cannot create permission without a tag name.');
			return null;
		}
		
		$t; $r; $a;
		try{
			$t = Tag::where('name', '=', Str::slug($tag))->firstOrFail();
		}catch(ModelNotFoundException $e){
			Log::debug('knock Caught exception; '. $e->getMessage());
			$t = Tag::create(['name'=>Str::slug($tag), 'description' => ($tagDesc===null ? $tag : $tagDesc)]);
			$t->save();
		}
		
		if ($role === null) $role = 'default-role';
		if ($action===null) $action= 'default-action';
		try{
			$r = Role::where('tag_id', '=', $t->id)->where('name', '=', Str::slug($role))->firstOrFail();
		}catch(ModelNotFoundException $e){
			Log::debug('knock Caught exception; '. $e->getMessage());
			$r = Role::create(['tag_id'=> $t->id, 'name'=>Str::slug($role), 'description' => ($roleDesc===null ? $role : $roleDesc)]);
			$t->roles()->save($r);
		}
		try{
			$a = Action::where('role_id', '=', $r->id)->where('name', '=', Str::slug($action))->firstOrFail();
		}catch(ModelNotFoundException $e){
			Log::debug('knock Caught exception; '. $e->getMessage());
			$a = Action::create(['role_id'=> $r->id, 'name'=>Str::slug($action), 'description' => ($actionDesc===null ? $action : $actionDesc)]);
			$r->actions()->save($a);
		}
		return $a;
	}

	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $tagDesc Tag Description
	 * @return Action object updated
	 */
	public function updateTag($tag, $tagDesc=null){
		return $this->updateAction($tag, null, null, $tagDesc, null, null);
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $tagDesc Tag Description
	 * @param String $roleDesc Role description
	 * @return Action object updated
	 */
	public function updateRole($tag, $role, $tagDesc=null, $roleDesc=null){
		return $this->updateAction($tag, $role, null, $tagDesc, $roleDesc, null);
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $action Action name
	 * @param String $tagDesc Tag Description
	 * @param String $roleDesc Role description
	 * @param String $actionDesc Action description
	 * @return Action object updated
	 */
	public function updateAction($tag, $role=null, $action=null, $tagDesc=null, $roleDesc=null, $actionDesc=null){
		if ($tag===null) {
			Log::debug('knock: Cannot update permission without a tag name.');
			return null;
		}
		
		$t; $r; $a;
		try{
			$t = Tag::where('name', '=', Str::slug($tag))->firstOrFail();
			//$t->name = $tag;
			$t->description = $tagDesc;
			$t->save();
		}catch(ModelNotFoundException $e){
			Log::debug('updateAction Exception: '. $e->getMessage());
			return null;
		}

		try{
			$r = Role::where('tag_id', '=', $t->id)->where('name', '=', Str::slug($role))->firstOrFail();
			//$r->name = $role;
			$r->description = $roleDesc;
			$t->roles()->save($r);
		}catch(ModelNotFoundException $e){
			Log::debug('updateAction Exception: '. $e->getMessage());
			return null;
		}
		try{
			$a = Action::where('role_id', '=', $r->id)->where('name', '=', Str::slug($action))->firstOrFail();
			//$a->name = $action;
			$a->description = $actionDesc;
			$r->actions()->save($a);
		}catch(ModelNotFoundException $e){
			Log::debug('updateAction Exception: '. $e->getMessage());
			return null;
		}
		return $a;
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $action Action name
	 * @return boolean true if permission exists
	 */
	public function permissionExists($tag, $role, $action){
		if ($tag===null || $role === null || $action === null){
			return false;
		}
		return ($this->getAction($tag, $role, $action) != null);
	}
	
	/**
	 * 
	 * @param String $tag Tag name 
	 * @param String $role Role name
	 * @param String $action Action name
	 */
	public function getAction($tag, $role, $action){
		if ($tag===null ||$role === null || $action === null){
			Log::debug('permissionExists: Tag, Role, Action cannot be null');
			return null;
		}

		try{
			$t = Tag::where('name','=', $tag)->firstOrFail();
			$r = Role::where('tag_id','=', $t->id)->where('name', '=', $role)->firstOrFail();
			$a = Action::where('role_id', '=', $r->id)->where('name', '=', $action)->firstOrFail();
			Log::debug('Knock Permission Found: Tag='.$tag. ', Role='.$role. ', Action='.$action);
			return $a;
		}catch(ModelNotFoundException $e){
			Log::debug('Knock Caught Exception: '. $e->getMessage());
			return null;
		}
	}
	
	//// DELETION METHODS ////
	

	/**
	 * 
	 * @param string $tag_id ID of tag to delete
	 * @throws KnockCascadeDeleteAttemptException
	 */
	public function deleteTag($tag_id){
		$tag = Tag::findOrFail($tag_id);
		if (!$tag == null){
			if ($tag->roles->count() == 0) {
				$tag->delete();
			}else{
				throw new KnockCascadeDeleteAttemptException(
						"Sorry, you cannot delete Tag [". $tag->name
						. "] because there are roles and actions associated with it. 
						You must first delete all associated roles and actions before it can be deleted.");
			}
		}
	}
	
	/**
	 * 
	 * @param String $role_id ID of role to delete
	 * @throws KnockCascadeDeleteAttemptException
	 */
	public function deleteRole($role_id){
		$role = Role::findOrFail($role_id);
		if (!$role == null){
			if ($role->actions->count() == 0) {
				$role->delete();
			}else{
				throw new KnockCascadeDeleteAttemptException(
						"Sorry, you cannot delete Role [". $role->name
						. "] because there are actions associated with it.
						You must first delete all related actions before it can be deleted.");
			}
		}
	}
	
	/**
	 * 
	 * @param String $action_id ID of action to delete
	 */
	public function deleteAction($action_id){
		$action = Action::findOrFail($action_id);
		$users = $action->removeAllUsages();
		if (!$action == null){
			$action->delete();
		}
		return $users;
	}
	
	public function sayHello(){
		return 'hello kawsuj';
	}
	
}


