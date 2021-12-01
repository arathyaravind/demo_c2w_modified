@extends('crudbooster::admin_template')
@section('content')
@include('override.admins._styles')
<style>
body section.content-header {
    display: none !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<h2>{{ $admin->name }}&nbsp;&nbsp;&nbsp;(&nbsp;{{ $admin->email }}&nbsp;)</h2>
		<hr style="border-color: #f39c12">
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="title-main"> ASSISGNED JOBORDERS ({{$admin->jo_count}})</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive"> 
		<table class="table table-bordered table-striped" >
			<tr>
				<th>Title</th>
				<th>Company</th>
				<th>Added On</th>
				<th>Status</th>
			</tr>
			@foreach($joborders as $jo) 
			<tr>
				<td><a href='/admin/job_order_applicants?job_order_id={{$jo->id}}'>{{ $jo->title }}</a></td>
				<td><a href='/admin/companies/detail/{{$jo->company_id}}'>{{ $jo->company_name }}</a></td>
				<td> {{ ($jo->created_at) ? date("d/m/Y", strtotime($jo->created_at)) : ' '}} </td>
				<td>{{ $jo->status }}</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>



@endsection