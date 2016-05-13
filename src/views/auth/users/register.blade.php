@extends('knock::layouts.app')
@section('title', 'Register User')
@section('breadcrumb')
	<li><a href="{{asset('knock/home') }}">home</a></li>
	<li><a href="{{asset('/users') }}">users</a></li>
	<li class="active">New User</li>
@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-user-corner-label">USER</span>
					</div>
				</div>
            
                <div class="panel-heading"><h2>New User</h2></div>
                <div class="panel-body">

				{!! Form::model(['method' => 'POST', 'action' => ['Knock\Http\Controllers\Auth\AuthController@register']]) !!}
					@include('knock::auth.users.form', ['userAction'=>'register', 'submitButtonText' => 'Register', 'submitButtonGlyph' => 'fa fa-btn fa-user'])

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							{{Form::button('<i class="fa fa-btn fa-user"></i> Register', ['class' => 'btn btn-primary', 'type'=>'submit'])}}
						</div>
					</div>

				{!! Form::close() !!}
        		</div>
        	</div>
        </div>
	</div>
</div>

@stop