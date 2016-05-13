<?php

namespace Knock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Datatables;
use Knock\Tag;
use Knock;
use Knock\KnockCascadeDeleteAttemptException;

class TagsController extends Controller
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
		return view('knock::auth.tags.index');
    }
    
    /**
     * Get Tags in Json format to populate dataTables
     */
    public function getTagData(){
    	return Datatables::of(Tag::all())
    	->addColumn('roles', function($model){
    		return $model->roles->count();
    	})
    	->addColumn('show', function($model){
    		//return "<a href=".action('\Knock\Http\Controllers\TagsController@show',[$model->id])." role='button'><span data-toggle='".'tooltip'."' title='".'Manage this tag'."'><i class='".'knock-tag-color fa fa-2x fa-btn fa-cog'."'></i></span></a>";
    		return "<a href=".action('\Knock\Http\Controllers\TagsController@show',[$model->id])." role='button'><i class='".'knock-tag-color fa fa-2x fa-btn fa-cog'."'></i></a>";
    	})
    	->make(true);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('knock::auth.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		Knock::createTag(Str::slug($request->get('name')), str_replace('"', "'", $request->input('description')));
		return redirect('/knock/tags')->with('flash_message', 'Created Tag: '.Str::slug($request->get('name')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$tag = Tag::FindOrFail($id);
		return view('knock::auth.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tag_id)
    {
		$tag = Tag::FindOrFail($tag_id);
		return view('knock::auth.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tag_id)
    {
    	Knock::updateTag(Str::slug($request->get('name')), str_replace('"', "'", $request->input('description')));
    	return redirect('/knock/tags')->with('flash_message', 'Updated Tag: '.Str::slug($request->get('name')));
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param  int  $tag_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tag_id)
    {
    	$tag = Tag::find($tag_id);
    	try{
    		if ($tag != null){
    			Knock::deleteTag($tag_id);
    			return redirect('/knock/tags')->with('flash_message', 'Tag '.$tag->name . ' has been deleted');
    		}
    	}catch(KnockCascadeDeleteAttemptException $e){
    		return redirect('/knock/tags/'.$tag_id)->with('flash_message', $e->getMessage());
    	}
    }
    
}
