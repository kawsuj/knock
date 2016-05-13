@extends('knock::layouts.app')
@section('title', 'Page Not Found')
@section('breadcrumb')
	<li><a href="{{asset('/home') }}">Home</a></li>
	<li class="active">Not Found</li>
@stop
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" align="center">
				<div class="zero-clipboard">
					<div class="btn-clipboard-left">
						<span class="otl-user-corner-label">Page Not Found</span>
					</div>
					<div class="btn-clipboard-right">
						<span class="otl-user-corner-label"><a href="#">back</a></span>
					</div>
				</div>
            
                <div class="panel-heading otl-panel-header"><h3>Whoops!</h3></div>
                <div class="panel-body">
                Sorry the page you are looking for does not exist on this server.
        		</div>
        	</div>
        </div>
	</div>
</div>

@stop