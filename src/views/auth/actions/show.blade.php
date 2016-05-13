@extends('knock::layouts.app')
@section('title', 'Permission')
@section('breadcrumb')
	<li><a href="{{asset('/knock/home') }}">home</a></li>
	<li><a href="{{asset('/knock/tags') }}">Tags</a></li>
	<li><a href="{{asset('/knock/tags/'.$role->tag->id) }}">Tag</a></li>
	<li><a href="{{asset('/knock/roles/'.$role->id) }}">$role->name</a></li>
	<li class="active">Permission</li>
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-permission-corner-label">PERMISSION</span>
					</div>
				</div>
				<div class="panel-heading knock-panel-header">
					<h2>Permissions for: {{$role->name}}</h2>
					<a class="button btn btn-control" role="button" href="{{asset('/knock/roles/edit/'.$role->id)}}">edit</a>
					&nbsp;
					<a class="button btn btn-control" role="button" href="{{asset('/knock/actions/'.$role->id)}}">Permissions</a>
				</div>
				<div class="panel-body">
					<div>
						{{$role->description}}
					</div>			
				</div>
			</div>
		</div>	
	</div>	

	<hr>

	<h2>Permissions</h2>

	@foreach($role->actions->chunk(3) as $row)
	<div class="row">
		@foreach($row as $action)
		<div class="col-md-3">
			<div class="panel panel-default" align="center">
				<div class="panel-heading knock-panel-header">	
					<strong>{{$action->name}}</strong>
					<br>
					{{$action->description}}
					<br><a href=""><i class="fa fa-bin"></i>Delete</a>
				</div>	
				<div class="panel-body">
					<div>
						{{$role->description}}
					</div>			
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@endforeach	
</div>	


@stop