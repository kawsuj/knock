@extends('layouts.app')
@section('title', 'User Actions')
@section('breadcrumb')
	<li><a href="{{asset('/home') }}">home</a></li>
	<li class="active">user-actions</li>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="panel panel-default" align="center">
			<div class="zero-clipboard">
				<div class="btn-clipboard-left">
					<span class="knock-user-corner-label bw-color-3"><i class="fa fa-2x fa-bolt"></i>&nbsp;</span>
				</div>

			</div>

			<div class="panel-heading knock-panel-header bw-panel-admin-header bw-background-2">
				<h2><span class="bw-color-3">User Actions</span></h2>
			</div>
			<div class="panel-body">
				<table id="events_table" class="table compact table-bordered table-condensed table-hover table-responsive" data-sort-name="time" data-sort-order="desc" data-cache="false" data-toggle="table" data-cache="true" data-page-list="[3, 4, 6, 8, 10]" data-pagination="true">
				    <thead>
				      <tr class="bw-table-header">
				        <th>Event Code</th>
				        <th>Details</th>
				        <th>Transaction</th>
				        <th>Action</th>
				        <th>Time</th>
				      </tr>
				    </thead>
			   
			        <tfoot>
			            <tr>
				        <th>Event Code</th>
				        <th>Details</th>
				        <th>Transaction</th>
				        <th>Action</th>
				        <th>Time</th>
			            </tr>
			        </tfoot>
			
				    <tbody>
			
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
			
					</tbody>
				</table>	
			</div>
		</div>
		
	</div>
</div>	
	<script>
	 	
		$(document).ready(function(){
			$('#events_table').dataTable({
			"order": [[ 0, "desc" ]],
	        "processing": "true",
	        "serverSide": "false",
	        "order": [ 3, "desc" ],
			"ajax"		: {
				"url" : "{{action('\App\Http\Controllers\AuditController@getList')}}",
				"type" : "POST",
				"headers" : {
                    "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                }
			},
	        "columns": [
	            { data: 'event_code', name: 'event_code' },
	            { data: 'event_data', name: 'event_data', className: 'bw-event-details-col'},
	            { data: 'transaction', name: 'transaction' },
	            { data: 'id', name: 'id' },
	            { data: 'created_at', name: 'created_at' }
	        ]        
			});
			makeSearchable('#events_table');
		});	
		
	</script>
		
@stop