@extends('knock::layouts.app') @section('title', 'Tags')
@section('breadcrumb')
<li><a href="{{url('/knock/home') }}">home</a></li>
<li class="active">tags</li>
@stop 

@section('content')

<div class="container">
	<div class="row">
		<div class="panel panel-default" align="center">
			<div class="zero-clipboard">
				<div class="btn-clipboard-left">
					<span class="knock-user-corner-label knock-tag-color"><i class="fa fa-2x fa-tags"></i>&nbsp;TAG LIST</span>
				</div>
				<div class="btn-clipboard-right">
					<button type="button" class="button btn btn-control tip" data-toggle="tooltip" title="Define a new tag"><a class="knock-tag-color" href="{{route('knock.tags.create')}}"><i  class="fa fa-1x fa-star"></i></a></button>
				</div>
			</div>

			<div class="panel-heading knock-panel-header">
		<h2><span cl0ass="knock-tag-color">
			Permission Tags
		</span></h2>
			</div>
			<div class="panel-body">

				<table id="tags_table"
					class="table table-bordered table-condensed table-hover table-responsive"
					data-pagination="true" data-search="true">
					<thead>
						<tr class="knock-table-header">
							<th class="">Tag Name</th>
							<th class="">Description</th>
							<th class=""></th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th class="">Tag Name</th>
							<th class="">Description</th>
							<th class="">#NOSEARCH#</th>
						</tr>
					</tfoot>
					<tbody>
						<tr>

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
		
			$('#tags_table').dataTable({
					"processing": "true",
					"serverSide": "true",
					"paginationType" : "full_numbers",
					"ajax"		: {
						"url" : "{{action('\Knock\Http\Controllers\TagsController@getTagData')}}",
						"type" : "POST",
						"headers" : {
	                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
	                    }
					},
					"columns": [
						{ data: 'name', name: 'name', searchable: true, orderable: true},
						{ data: 'description', name: 'description', searchable: true, orderable: true},
						{ data: 'show', name: 'show', searchable: false, orderable: false}
					]        
				});
			makeSearchable('#tags_table');
		      
			
		});	
		
</script>

@stop
