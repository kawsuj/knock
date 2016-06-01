<?php

namespace Knock\Http\Controllers;

use App\Http\Controllers\Controller;
use Knock\Event;
use Knock;
use Datatables;

class AuditController extends Controller
{
	
	public function __construct(){
		$this->middleware('knock');
	}


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		if(Knock::hasRole('knock', 'user-administrator')){
	    	$events = Event::all();
			return view('knock::logs.index', compact('events'));
		}else{
			return redirect('/');
		}
    }
    
    public function getList(){
		if(Knock::hasRole('knock', 'user-administrator')){
			return Datatables::of(Event::all())
			->make(true);		
		}
	}

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    	return redirect()->back();
		if(Knock::hasRole('knock', 'user-administrator')){
	        return view('knock::logs.show');
		}else{
			return redirect('/');
		}
    }

}
