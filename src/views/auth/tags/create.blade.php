@extends('knock::layouts.app')
@section('title', 'Create Tag')
@section('breadcrumb')
	<li><a href="{{asset('/knock/home') }}">home</a></li>
	<li><a href="{{asset('/knock/tags') }}">tags</a></li>
	<li class="active">new-tag</li>
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-tag-corner-label knock-tag-color"><i class="fa fa-x fa-tag"></i>&nbsp;NEW TAG</span>
					</div>
				</div>
				<div class="panel-heading knock-panel-header">
					<h2>New Tag</h2>
				</div>
				<div class="panel-body">

					{!! Form::open(['method' => 'POST', 'action' => ['\Knock\Http\Controllers\TagsController@store']]) !!}
					@include('knock::auth.tags.form', ['userAction'=>'create', 'submitButtonText' => 'Update', 'submitButtonGlyph' => 'fa fa-btn fa-tag'])
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" align="right">
							{{Form::button('<i class="fa fa-btn fa-user"></i> Create', ['class' => 'btn btn-primary', 'type'=>'submit'])}}
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@stop