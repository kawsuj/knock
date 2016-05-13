@extends('knock::layouts.app')
@section('title', 'Show Tag')

@section('breadcrumb')
	<li><a href="{{url('/knock/home') }}">home</a></li>
	<li><a href="{{url('/knock/tags') }}">tags</a></li>
	<li class="active">{{$tag->name}}</li>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-tag-corner-label knock-tag-color"><i class="fa fa-tag"></i>&nbsp;TAG</span>
					</div>
					<div class="btn-clipboard-right">
						
						<div>
							{!! Form::open(['method' => 'DELETE', 'class'=>'knock-confirm-delete', 'action' => ['\Knock\Http\Controllers\TagsController@destroy', $tag->id]]) !!}

							<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Edit tag details"><a class="knock-tag-color" href="{{action('\Knock\Http\Controllers\TagsController@edit', $tag->id)}}"><i  class="fa fa-1x fa-edit"></i></a></button>
							<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Define a new role"><a class="knock-role-color" href="{{action('\Knock\Http\Controllers\RolesController@create', $tag->id)}}"><i  class="fa fa-1x fa-star"></i></a></button>
							{{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'button btn btn-control knock-danger-color tip', 'data-toggle'=>'tooltip', 'type'=>'submit', 'title'=>'Delete '.$tag->name. ' '])}}
							{!! Form::close()!!}
						</div>
						
					</div>
				</div>
				<div class="panel-heading knock-panel-header">
					<h2>{{$tag->name}}</h2>
				</div>
				<div class="panel-body">
					<div align="left">
						{!!$tag->description!!}
					</div>			
				</div>
			</div>
		</div>	
	</div>	

	@foreach($tag->roles->chunk(3) as $row)
	<div class="row">
		@foreach($row as $role)
		
		@if($row->count() == 1) 
			<div class="col-md-6 col-md-offset-3">
		@elseif($row->count() == 2)
		<div class="col-md-6">
		@else
			<div class="col-md-4">
		@endif
			<div class="panel panel-default">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-role-corner-label knock-role-color"><i class="fa fa-user"></i>&nbsp;ROLE</span>
					</div>
					<div class="btn-clipboard-right">
						<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Manage this role and its associated actions"><a class="knock-role-color" href="{{action('\Knock\Http\Controllers\RolesController@show', [$role->tag->id, $role->id])}}"><i  class="fa fa-1x fa-cog"></i></a></button>
					</div>
				</div>
				<div class="panel-heading" align="center">	
					<strong>{{$role->name}}</strong>
					<br><br>
				</div>	
				<div class="panel-body">
					{!! $role->description !!}
					<br>
					<table class="table">
						<tr class="knock-table-header">
							<td>Action</td>
							<td>Description</td>
						</tr>
						@if(!$role->actions->count())
						<tr>
							<td colspan="2" align="center"><strong>No actions defined yet</strong></td>
						</tr>
						@endif
						@foreach($role->actions as $action)
						<tr>
							<td class="knock-action-color"><strong>{{$action->name}}</strong></td>
							<td>{!! $action->description !!}</td>
						</tr>
						@endforeach
					</table>						
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@endforeach	
</div>

@stop