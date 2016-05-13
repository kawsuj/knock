@extends('knock::layouts.app')
@section('title', 'Show User')
@section('breadcrumb')
	<li><a href="{{url('knock/home') }}">home</a></li>
	<li><a href="{{url('/users') }}">users</a></li>
	<li class="active">{{$user->first_name}} {{$user->last_name}}</li>
@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-user-corner-label knock-user-color">VIEWING USER</span>
					</div>
					<div class="btn-clipboard-right">
					<br>
						<span class="knock-user-corner-label">
						<button type="button" class="button btn btn-control knock-user-color tip" data-toggle="tooltip" title="Edit user details"><a class="knock-user-color" href="{{action('\Knock\Http\Controllers\UsersController@edit', $user->id)}}"><i  class="fa fa-1x fa-edit"></i></a></button>
						</span>
					</div>
				</div>
            
                <div class="panel-heading knock-panel-header"><h2>{{$user->first_name}} {{$user->last_name}}</h2></div>
                <div class="panel-body">

					<span align="left"><h3><strong>Personal Details</strong></h3></span>
					<div class="form-group">
						<label class="col-md-4 control-label">First Name</label>
					
						<div class="col-md-6">
							<span class="form-control">{{$user->first_name}}</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">Last Name</label>
					
						<div class="col-md-6">
							<span class="form-control">{{$user->last_name}}</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">E-Mail Address</label>
					
						<div class="col-md-6">
							<span class="form-control">{{$user->email}}</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label">Active</label>
					
						<div class="col-md-6">
							<span class="form-control">{{$user->active? 'Yes' : 'No'}}</span>
							
						</div>
					</div>
					
					<div class="form-group">
						<table class="table">
							<thead>
								<tr>
									<td colspan="2" align="left"><h3><strong>Permissions Granted</strong></h3>
									<br>
									</td>
								</tr>
								<tr  class="knock-table-header">
									<td>Tag</td> <td>Role</td> <td>Action</td>
								</tr>
							</thead>
							<tbody>
								@if(!$user->actions->count())
								<tr>
									<td colspan="3" align="center">No permissions have been granted to this user</td>
								</tr>
								@endif
								@foreach($user->actions as $userAction)
								<tr>
									<td>
										<span  class="knock-tag-color tip" data-toggle="tooltip" title="{!! $userAction->action->role->tag->description !!}"><i class="fa fa-1x fa-info-circle"></i></span>&nbsp;
										{{$userAction->action->role->tag->name}} 
									</td>
									<td>
										<span  class="knock-role-color tip" data-toggle="tooltip" title="{!! $userAction->action->role->description !!}"><i class="fa fa-1x fa-info-circle"></i></span>&nbsp;
										{{$userAction->action->role->name}}
									</td>
									<td>
										<span  class="knock-action-color tip" data-toggle="tooltip" title="{!! $userAction->action->description !!}"><i class="fa fa-1x fa-info-circle"></i></span>&nbsp;
										{{$userAction->action->name}}
									</td>
								</tr>
								@endforeach
							</tbody>

						</table>
					</div>
					
        		</div>
        	</div>
        </div>
	</div>
</div>



@stop