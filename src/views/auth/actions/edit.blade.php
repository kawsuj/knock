@extends('knock::layouts.app')
@section('title', 'Edit Action')
@section('breadcrumb')
	<li><a href="{{asset('/knock/home') }}">home</a></li>
	<li><a href="{{asset('/knock/tags') }}">tags</a></li>
	<li><a href="{{asset('/knock/tags/'.$action->role->tag->id) }}">{{$action->role->tag->name}}</a></li>
	<li><a href="{{asset('/knock/tags/'.$action->role->tag->id.'/roles/'.$action->role->id) }}">{{$action->role->name}}</a></li>
	<li class="active">edit-user-action</li>
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="knock-action-corner-label knock-action-color"><i class="fa fa-hand-o-right"></i>&nbsp;ACTION</span>
					</div>
				</div>
				<div class="panel-heading knock-panel-header"><h2>New User-action</h2></div>
				<div class="panel-body">

					{!! Form::open(['method' => 'PATCH', 'url' => 'knock/tags/'.$action->role->tag->id.'/roles/'.$action->role->id.'/actions/'.$action->id]) !!}
					@include('knock::auth.actions.form', ['userAction'=>'edit',  'submitButtonGlyph' => 'fa fa-btn fa-tag'])
					
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" align="right">
							{{Form::button('<i class="fa fa-btn fa-key"></i> Update', ['class' => 'btn btn-primary', 'type'=>'submit'], $action->id)}}
						</div>
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@stop