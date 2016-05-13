@extends('knock::layouts.app')
@section('title', 'Edit Tag')
@section('breadcrumb')
	<a href="{{url('/tags/'.$tag->id) }}"></a>
	<li><a href="{{url('/knock/home') }}">home</a></li>
	<li><a href="{{url('/knock/tags') }}">tags</a></li>
	<li><a href="{{url('/knock/tags/'.$tag->id) }}">{{$tag->name}}</a></li>
	<li class="active">Edit</li>
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-tag-corner-label knock-tag-color">TAG</span>
					</div>
				</div>
			
				<div class="panel-heading knock-panel-header">
				<h2>{{$tag->name}}</h2></div>
				<div class="panel-body">

					{{ Form::open(['method' => 'PATCH', 'action' => ['\Knock\Http\Controllers\TagsController@update', $tag->id]]) }}
					@include('knock::auth.tags.form', ['userAction'=>'edit', 'submitButtonText' => 'Update', 'submitButtonGlyph' => 'fa fa-btn fa-tag'])

					
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" align="right">
							{{Form::button('<i class="fa fa-btn fa-user"></i> Update', ['class' => 'btn btn-primary', 'type'=>'submit'], $tag->id)}}
						</div>
					</div>

					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

@stop