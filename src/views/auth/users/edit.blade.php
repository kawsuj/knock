@extends('knock::layouts.app')
@section('title', 'Edit User')
@section('breadcrumb')
	<li><a href="{{asset('knock/home') }}">home</a></li>
	<li><a href="{{asset('/users') }}">users</a></li>
	<li class="active">{{$user->first_name}} {{$user->last_name}}</li>
@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-user-corner-label knock-user-color">EDITING USER</span>
					</div>
					<div class="btn-clipboard-right">
					<br>
						<span>
						{!! Form::open(['method' => 'DELETE', 'class'=>'knock-confirm-delete', 'action' => ['\Knock\Http\Controllers\UsersController@destroy', $user->id]]) !!}
						<button type="button" class="button btn btn-control knock-user-color tip" data-toggle="tooltip" title="Cancel and discard changes"><a class="knock-user-color" href="{{action('\Knock\Http\Controllers\UsersController@show', $user->id)}}"><i  class="fa fa-1x fa-sign-out"></i></a></button>

						{{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'button btn btn-control knock-danger-color tip', 'data-target'=>'#confirm-delete', 'data-toggle'=>'modal', 'type'=>'submit', 'title'=>'Delete '.$user->email])}}
						{!! Form::close()!!}

						</span>
					</div>
				</div>
            
                <div class="panel-heading knock-panel-header"><h2>{{$user->first_name}}&nbsp;{{$user->last_name}}</h2></div>
                <div class="panel-body">
        
				{!! Form::open(['method' => 'PATCH', 'url' => '/users/'.$user->id]) !!}
					@include('knock::auth.users.form', ['userAction'=>'edit', 'submitButtonText' => 'Update', 'submitButtonGlyph' => 'fa fa-btn fa-user'])
				
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" align="right">
							{{Form::button('<i class="fa fa-btn fa-user"></i> Update', ['class' => 'btn btn-primary', 'type'=>'submit'], $user->id)}}
						</div>
					</div>
				
				{!! Form::close() !!}
        		</div>
        	</div>
        </div>
	</div>
</div>


@stop