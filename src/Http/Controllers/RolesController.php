<?php

namespace Knock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Knock\KnockCascadeDeleteAttemptException;
use Knock;
use Knock\Tag;
use Knock\Role;

class RolesController extends Controller
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
    	//Roles are displayed on the "show tags" screen
        return 'Roles index not used';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tag_id)
    {
		$tag = Tag::FindOrFail($tag_id);
		return view('knock::auth.roles.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tag_id)
    {
    	$tag = Tag::findOrFail($tag_id);
    	
    	$action = Knock::createRole($tag->name, Str::slug($request->get('name')), $tag->description, str_replace('"', "'", $request->input('description')));
    	return redirect('/knock/tags/'.$tag->id)->with('flash_message', 'Role '.$action->role->name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tag_id, $role_id)
    {
		$role = Role::FindOrFail($role_id);
		return view('knock::auth.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tag_id, $role_id)
    {
		$role = Role::FindOrFail($role_id);
		return view('knock::auth.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tag_id
     * @param  int  $role_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tag_id, $role_id)
    {
    	$role = Role::findOrFail($role_id);
    	$action = Knock::updateRole($role->tag->name, Str::slug($request->get('name')), $role->tag->description, str_replace('"', "'", $request->input('description')));
    	return redirect('/knock/tags/'.$tag_id.'/roles/'.$role_id)->with('flash_message', 'Role '.$role->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag_id, $role_id){
    	$role= Role::find($role_id);
    	try{
    		if ($role != null){
    			Knock::deleteRole($role_id);
    			return redirect('/knock/tags/'.$tag_id)->with('flash_message', 'Role '.$role->name. ' has been deleted');
    		}
    	}catch(KnockCascadeDeleteAttemptException $e){
    		return redirect('/knock/tags/'.$tag_id.'/roles/'.$role_id)->with('flash_message', $e->getMessage());
    	}
    
    }
    
}
