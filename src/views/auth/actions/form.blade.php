<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	{{ csrf_field() }}
	<label class="col-md-4 control-label">Action Name</label>
	<div class="col-md-6">
		{!! Form::text('name', $userAction === 'edit'? $action->name : null, [$userAction === 'edit'? 'readonly' : '', 'class' => 'form-control']) !!}

		@if ($errors->has('description'))
		<span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
		@endif
	</div>

	<label class="col-md-4 control-label">Description</label>
	<div class="col-md-6">
		{!! Form::textarea('description', $userAction === 'edit'? $action->description : null, ['class' => 'form-control']) !!}

		@if ($errors->has('description'))
		<span class="help-block">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
		@endif
	</div>
</div>


