<span align="left"><h3><strong>Personal Details</strong></h3></span>
<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
	<label class="col-md-4 control-label">First Name</label>

	<div class="col-md-6">
		{!! Form::text('first_name', $userAction === 'edit'? $user->first_name : null, ['class' => 'form-control']) !!}

		@if ($errors->has('first_name'))
		<span class="help-block">
			<strong>{{ $errors->first('first_name') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
	<label class="col-md-4 control-label">Last Name</label>

	<div class="col-md-6">
		{!! Form::text('last_name', $userAction === 'edit' ? $user->last_name : null, ['class' => 'form-control']) !!}

		@if ($errors->has('last_name'))
		<span class="help-block">
			<strong>{{ $errors->first('last_name') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	<label class="col-md-4 control-label">E-Mail Address</label>

	<div class="col-md-6">
		{!! Form::text('email', $userAction === 'edit' ? $user->email : null, ['class' => 'form-control']) !!}

		@if ($errors->has('email'))
		<span class="help-block">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
	<label class="col-md-4 control-label">Active</label>

	<div class="col-md-6">
		
		{!! Form::select('active', ['' => '[please select]', '1' => 'Yes','0' => 'NO'], $userAction === 'edit' ? $user->active : null, array('class' => 'form-control dropdown')) !!}
		@if ($errors->has('active'))
		<span class="help-block">
			<strong>{{ $errors->first('active') }}</strong>
		</span>
		@endif
	</div>
</div>

@if($userAction === 'register')
<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	<label class="col-md-4 control-label">Password</label>

	<div class="col-md-6">
		{!! Form::input('password', 'password', null, ['class' => 'form-control']) !!}

		@if ($errors->has('password'))
		<span class="help-block">
			<strong>{{ $errors->first('password') }}</strong>
		</span>
		@endif
	</div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	<label class="col-md-4 control-label">Confirm Password</label>

	<div class="col-md-6">
		{!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control']) !!}
		@if ($errors->has('password_confirmation'))
		<span class="help-block">
			<strong>{{ $errors->first('password_confirmation') }}</strong>
		</span>
		@endif
	</div>
</div>
@endif

@if(!($userAction === 'register'))
<br>
<div class="form-group">
	<table class="table">
		<thead>
			<tr>
				<td colspan="1" align="left"><h3><strong>User Actions</strong></h3></td>
			</tr>

		</thead>

		<div class="col-md-6">
			<span class="help-block">
				<tbody>
					@foreach(\Knock\Tag::all() as $tag)
					@if($tag->roles->count())
					<tr>
						
						<td>
							<table class="table">
								<tbody>
									@if($tag->roles->count())
									@foreach($tag->roles as $role)
									<tr class="role">
										<td>
											@if($role->actions->count() > 0)
											
												<table width="100%">
													<tr>
														<td width="35%" class="knock-tag-color"><h4><span class="tip" data-toggle="tooltip" title="{!! $role->tag->description !!}"><i class="knock-tag-color fa fa-1x fa-info-circle"></i></span><strong> <strong>{{$role->tag->name}}</strong></h4><td>
														<td class="knock-role-color"><h4><span class="tip" data-toggle="tooltip" title="{!! $role->description !!}"><i class="knock-role-color fa fa-1x fa-info-circle"></i></span>&nbsp;<strong> {{$role->name}}</strong></h4><td>
													</tr>
												</table>
												
											  											
											<table class="table">
												<thead>
													<tr>
														<th width="5%">Grant</th>
														<th width="30%">Action</th>
														<th>Description</th>
													</tr>
												</thead>
												<tbody>
												@if($userAction === 'edit')
													@foreach($role->actions as $action)
													<tr>
														<td>{!! Form::checkbox('action_'.$action->id, '1', $user->hasPermission($action->id)) !!}</td>
														<td class="knock-action-color"><strong>{{$action->name}}</strong> </td>
														<td>{!! $action->description !!}</td>
													</tr>
													@endforeach
												@endif
												</tbody>
											</table>	
											@endif														
										</td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</td>
					</tr>
					@endif
					@endforeach
				</tbody>
		
			</span>
		</div>
	</table>
</div>
@endif



