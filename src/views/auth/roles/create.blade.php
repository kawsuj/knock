@extends('knock::layouts.app')
@section('title', 'New Role')

@section('breadcrumb')
	<li><a href="{{asset('/knock/home') }}">home</a></li>
	<li><a href="{{asset('/knock/tags') }}">tags</a></li>
	<li><a href="{{asset('/knock/tags/'.$tag->id) }}">{{$tag->name}}</a></li>
	<li class="active">new-role</li>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-role-corner-label knock-role-color"><i class="fa fa-user"></i>&nbspNEW ROLE</span>
					</div>
				</div>
			
				<div class="panel-heading knock-panel-header">
					<h2>{{$tag->name}}</h2>
				</div>
				<div class="panel-body">

					{{ Form::open(['method' => 'post', 'action'=>['\Knock\Http\Controllers\RolesController@store', $tag->id]]) }}
					@include('knock::auth.roles.form', ['userAction'=>'create', 'submitButtonText' => 'create', 'submitButtonGlyph' => 'fa fa-btn fa-tag'])
					
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" align="right">
							{{Form::button('<i class="fa fa-btn fa-user"></i> Create', ['class' => 'btn btn-primary', 'type'=>'submit'])}}
						</div>
					</div>

					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

@stop