@extends('knock::layouts.app')

@section('title', 'Role')

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
					<div class="form-group btn-clipboard-right">
							{{ Form::open(['method' => 'DELETE', 'class'=>'knock-confirm-delete', 'url' => 'knock/tags/'.$role->tag->id.'/roles/'.$role->id]) }}
							<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Edit role details"><a class="knock-role-color" href="{{action('\Knock\Http\Controllers\RolesController@edit', [$role->tag->id, $role->id])}}"><i  class="fa fa-1x fa-edit"></i></a></button>
							<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Define a new user action"><a class="knock-action-color" href="{{action('\Knock\Http\Controllers\ActionsController@create', [$role->tag->id, $role->id])}}"><i  class="fa fa-1x fa-magic"></i></a></button>
							{{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'button btn btn-control knock-danger-color tip', 'data-toggle'=>'tooltip', 'type'=>'submit', 'title'=>'Delete '.$role->name. ' '])}}
							{{ Form::close()}}
					</div>	
					<div class=" form-group btn-clipboard-left">
						<span class="knock-role-corner-label knock-role-color"><i class="fa fa-user"></i>&nbsp;ROLE</span>	
					</div>
					
				</div>
				<div class="panel-heading knock-panel-header">
					<h2>{{$role->name}}</h2>
				</div>
				<div class="panel-body">
					<div align="left">
						{!! $role->description !!}
					</div>			
				</div>
			</div>
		</div>	
	</div>	


	<div class="row" align="center">
		<h3>User Actions</h3>
	</div>
	<hr>
	@foreach($role->actions->chunk(3) as $row)
	<div class="row">
		@foreach($row as $action)
		<div class="col-md-4">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="form-group  btn-clipboard-right">
						{{ Form::open(['method' => 'DELETE', 'class'=>'knock-confirm-delete', 'url' => 'knock/tags/'.$role->tag->id.'/roles/'.$role->id.'/actions/'. $action->id]) }}
						<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Edit action details"><a class="knock-action-color" href="{{action('\Knock\Http\Controllers\ActionsController@edit', [$action->role->tag->id, $action->role->id, $action->id])}}"><i  class="fa fa-1x fa-edit"></i></a></button>
						{{Form::button('<i class="fa fa-trash"></i>', ['class' => 'button btn btn-control knock-danger-color tip', 'data-toggle'=>'tooltip', 'type'=>'submit', 'title'=>'Delete '.$action->name. ' ']) }}
						{{ Form::close() }}				
					</div>
					
					<div class=" form-group btn-clipboard-left">
						<span class="knock-role-corner-label knock-action-color"><i class="fa fa-hand-o-right "></i>&nbsp;ACTION</span>	
					</div>
					
				</div>
				<div class="panel-heading knock-panel-header">	
					<strong>{{$action->name}}</strong>
					<br>

				</div>	
				<div class="panel-body">
					<div align="left">
						{!!$action->description!!}
					</div>			
				</div>
			</div>
		</div>
		@endforeach
	</div>

@endforeach	
</div>	


@stop