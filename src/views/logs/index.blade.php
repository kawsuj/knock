@extends('knock::layouts.app')
@section('title', 'User Actions Log')
@section('breadcrumb')
	<li><a href="{{asset('/knock/home') }}">home</a></li>
	<li class="active">user-actions</li>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="panel panel-default" align="center">
			<div class="zero-clipboard">
				<div class="btn-clipboard-left">
					<span class="knock-user-corner-label knock-user-color"><i class="fa fa-2x fa-bolt"></i>&nbsp;</span>
				</div>

			</div>

			<div class="panel-heading knock-panel-header">
				<h2><span class="knock-user-color">User Actions</span></h2>
			</div>
			<div class="panel-body">
				<table id="events_table" class="table compact table-bordered table-condensed table-hover table-responsive" data-sort-name="time" data-sort-order="desc" data-cache="false" data-toggle="table" data-cache="true" data-page-list="[3, 4, 6, 8, 10]" data-pagination="true">
				    <thead>
				      <tr class="knock-table-header">
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
				        <th width="60%">Details</th>
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
					"url" : "{{action('\Knock\Http\Controllers\AuditController@getList')}}",
					"type" : "POST",
					"headers" : {
	                    "X-CSRF-TOKEN" : "{{ csrf_token() }}"
	                }
				},
			    createdRow: function( row, data, dataIndex ) {
			        $( row ).find('td:eq(0)').attr('data-title', 'Event Code:');
			        $( row ).find('td:eq(1)').attr('data-title', 'Event Data:');
			        $( row ).find('td:eq(2)').attr('data-title', 'Txn ID:');
			        $( row ).find('td:eq(3)').attr('data-title', 'Event ID:');
			        $( row ).find('td:eq(4)').attr('data-title', 'Timestamp:');
			    },
		        "columns": [
		            { data: 'event_code', name: 'event_code', className: 'knock-right-align'},
		            { data: 'event_data', name: 'event_data', className: 'knock-right-align'},
		            { data: 'transaction', name: 'transaction', className: 'knock-right-align'},
		            { data: 'id', name: 'id', className: 'knock-right-align'},
		            { data: 'created_at', name: 'created_at', className: 'knock-right-align'}
		        ]        
			});
			makeSearchable('#events_table');
		});	
		
	</script>
		
@stop