@extends('knock::layouts.app') @section('title', 'Users')
@section('breadcrumb')
<li><a href="{{asset('/knock/home') }}">home</a></li>
<li class="active">users</li>
@stop @section('content')


<div class="container">
	<div class="row">
		<div class="panel panel-default" align="center">
			<div class="zero-clipboard">
				<div class="btn-clipboard-left">
					<span class="knock-user-corner-label knock-user-color"><i
						class="fa fa-2x fa-users"></i>&nbsp;USERS</span>
				</div>
				<div class="btn-clipboard-right">
					<button type="button" class="button btn btn-control"
						 class="tip" data-toggle="tooltip" title="Register a new user">
						<a class="knock-user-color" href="{{url('/register')}}"><i
							class="fa fa-1x fa-star"></i></a>
					</button>
				</div>
			</div>

			<div class="panel-heading knock-panel-header">
				<span class="knock-user-color">
					<h2>Users</h2>
				</span>
			</div>
			<div class="panel-body">


				<table id="users_table"
					class="table dataTable table-bordered table-condensed table-hover table-responsive"
					data-pagination="true" data-search="true">
					<thead>
						<tr class="knock-table-header">
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Active</th>
							<th>Show</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>#NOSEARCH#</th>
							<th>#NOSEARCH#</th>
						</tr>
					</tfoot>
					<tbody>
						<tr>

							<!--<td></td>-->
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
			$('#users_table').dataTable({
					"processing": "true",
					"serverSide": "true",
					"paginationType" : "full_numbers",
					"ajax"		: {
						"url" : "{{action('\Knock\Http\Controllers\UsersController@getUserData')}}",
						"type": "POST",
						"headers" : {
	                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
	                    }
					},
				    createdRow: function( row, data, dataIndex ) {
				        $( row ).find('td:eq(0)').attr('data-title', 'First Name:');
				        $( row ).find('td:eq(1)').attr('data-title', 'Last Name:');
				        $( row ).find('td:eq(2)').attr('data-title', 'Email:');
				        $( row ).find('td:eq(3)').attr('data-title', 'Active:');
				        $( row ).find('td:eq(4)').attr('data-title', 'Details:');
				    },					
					"columns": [
						{ data: 'first_name', name: 'first_name', searchable: true, orderable: true, className: 'knock-right-align'},
						{ data: 'last_name', name: 'last_name', searchable: true, orderable: true, className: 'knock-right-align'},
						{ data: 'email', name: 'email', searchable: true, orderable: true, className: 'knock-right-align'},
						{ data: 'active', name: 'active', searchable: false, orderable: false, className: 'knock-right-align'},
						{ data: 'show', name: 'show', searchable: false, orderable: false, className: 'knock-right-align'}
					]        
				});
			makeSearchable('#users_table');
		});	
		
</script>


@stop
