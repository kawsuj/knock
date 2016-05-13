@extends('knock::layouts.app')

@section('title', 'Edit Role')

@section('breadcrumb')
	<li><a href="{{asset('/knock/home') }}">home</a></li>
	<li><a href="{{asset('/knock/tags') }}">tags</a></li>
	<li><a href="{{asset('/knock/tags/'.$role->tag->id) }}">{{$role->tag->name}}</a></li>
	<li class="active">{{$role->name}}</li>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-role-corner-label">ROLE</span>
					</div>
				</div>
				<div class="panel-heading knock-panel-header"><h2>{{$role->name}}</h2></div>
				<div class="panel-body">
					{!! Form::open(['method' => 'PATCH', 'url' => 'knock/tags/'.$role->tag->id.'/roles/'.$role->id]) !!}
					@include('knock::auth.roles.form', ['userAction'=>'edit', 'submitButtonText' => 'Update', 'submitButtonGlyph' => 'fa fa-btn fa-tag'])

					
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" align="right">
							{{Form::button('<i class="fa fa-btn fa-user"></i> Update Role', ['class' => 'btn btn-primary', 'type'=>'submit'], $role->id)}}
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@stop