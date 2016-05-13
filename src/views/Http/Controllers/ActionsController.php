<?php

namespace Knock\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Knock;
use Knock\Tag;
use Knock\Role;
use Knock\Action;

class ActionsController extends Controller
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
        return 'action list';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tag_id, $role_id)
    {
		$role = Role::FindOrFail($role_id);
		return view('knock::auth.actions.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tag_id, $role_id)
    {
    	$role= Role::findOrFail($role_id);
    	$action = Knock::createAction($role->tag->name, $role->name, Str::slug($request->get('name')), $role->tag->description, $role->description, str_replace('"', "'", $request->input('description')));
    	return redirect('/knock/tags/'.$role->tag->id.'/roles/'.$role->id)->with('flash_message', 'Action '.Str::slug($request->get('name')).' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	//actions are displayed on the "show roles" screen 
        return 'show action not used';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tag_id, $role_id, $action_id)
    {
        $action = Action::findOrFail($action_id);
        return view('knock::auth.actions.edit', compact('action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tag_id, $role_id, $action_id)
    {
    	$action = Action::findOrFail($action_id);
    	Knock::updateAction($action->role->tag->name, $action->role->name, Str::slug($request->get('name')), $action->role->tag->description, $action->role->description, str_replace('"', "'", $request->input('description')));
    	return redirect('/knock/tags/'.$action->role->tag->id.'/roles/'.$action->role->id)->with('flash_message', 'Action '.Str::slug($request->get('name')).' updated');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag_id, $role_id, $action_id){
    	$action= Action::find($action_id);
   		if ($action != null){
   			$users = Knock::deleteAction($action_id);
   			$msg = 'Action ['.$action->name.'] has been deleted. ';
   			if ($users->isEmpty()){
   				$msg .= ' No users are affected by this deletion.';
   			}else{
   				$msg .= ' The permission to perform this action has been removed from the following users: '. $users->pluck('email')->implode(', ');
   			}
   			return redirect('/knock/tags/'.$action->role->tag->id.'/roles/'.$action->role->id)->with('flash_message', $msg);
   		}
    }
    
}
