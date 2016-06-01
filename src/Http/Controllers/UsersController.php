<?php

namespace Knock\Http\Controllers;

use Auth;
use Knock\User;
use Knock\UserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Datatables;
use Log;


class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('knock');
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
    		return view('knock::auth.users.index');
    	}else{
    		return view('knock::welcome');
    	}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	//Users are created using AuthController
        return 'user create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//users are savced using AuthController
        return 'user store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
    	$user = User::FindOrFail($user_id);
    	return view('knock::auth.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $user_id)
    {
    	$user = User::FindOrFail($user_id);
    	return view('knock::auth.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
    	Log::debug(get_class($this).': Updating user '. $user_id);
    	$user = User::findOrFail($user_id);
    	$user->update($request->all());
    	$user->save();
    	$data = $request->input();
    	$this->applyPermissions($user, $data);
    
    	return redirect('/users/'.$user_id)->with('flash_message', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
    	$user = User::findOrFail($user_id);
    	
    	if (!$user == null){
    	
    		try {
    			$user->actions()->delete();
    			$user->delete();
    		} catch (QueryException $e) {
    			return redirect('/users/'.$user_id)->with('flash_message', 'user '.$user->email.' cannot be deleted because it is being used');
    		}
    		return redirect('/users')->with('flash_message', 'User '.$user->email.' has been removed');
    	}else{
    		return redirect('/users/'.$user_id)->with('flash_message', 'User was not found');
    	}
    	 
    }
    
    public function getUserData(){
    	$users = $this->getUsers();
    	return Datatables::of($users)
    	->editColumn('active', function($model){
    		return $model->active? "Yes" : "No";
    	})
    	->addColumn('show', function($model){
    		return "<a href=".action('\Knock\Http\Controllers\UsersController@show',[$model->id])." role='button'><i class='".'knock-user-color fa fa-2x fa-btn fa-ellipsis-h'."'></i></a>";
    	})
    	->make(true);
    }
    
    private function getUsers(){
    	return User::all();
    }
 
    private function applyPermissions($user, $data){
    	$user->actions()->delete();
    	$keys = array_keys($data);
    	foreach($keys as $key){
    		if (starts_with($key, 'action_')){
    			$userAction = new UserAction;
    			$userAction->user_id = $user->id;
    			$userAction->action_id = substr(strrchr($key, "_"), 1); //the number following the prefix
    			$userAction->save();
    		}
    	}
    }
    
    
    
}
