@extends('knock::layouts.app')
@section('title', 'Welcome')
@section('breadcrumb')
<li class="active">Welcome</li>
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style="height: 100%">
                <div class="panel-heading" align="center">
                <h2>Knock!</h2>
                <h3>User Roles and Permissions</h3></div>
                <div class="panel-body" align="center">
                	
   					<img src="{{Config::get('knock.knocklogo')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
