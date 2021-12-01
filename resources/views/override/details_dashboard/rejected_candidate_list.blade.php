@extends('crudbooster::admin_template')
 <title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Rejected Candidate List" }}</title>
@section('content')
@include('override.details_dashboard._styles')
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
        	<!-- <form method="get" action='/admin/rejected-candidates-pdf-view' target="_blank" class="form-horizontal">
        					<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
        						Print PDF
        					</button>
        					<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
        					<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
        					<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
        	
        				</form> -->
        	@if(count($jobOrderApplicants)>0)
			<form method="get" action='/admin/rejected-candidates-csv-view' target="_blank" class="form-horizontal">
				<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
					Export CSV
				</button>
				<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
				<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
				<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">

			</form>
			@endif
			<table class="table table-striped ">
				<thead>
					<tr>
						<th> Sl No. </th>
						<th> Candidate Name </th>
						<th> Job Order</th>
						<th> Company </th>
						<th> User </th>
						<th> Rejected Date</th>
						<th> Next Action </th>
					</tr>
				</thead>
				<tbody>
					<?php $i = ($jobOrderApplicants->currentpage()-1)* $jobOrderApplicants->perpage() + 1; ?>
					@foreach($jobOrderApplicants as $jobOrderApplicant)
						<tr>
							<td> {{$i}} </td>
							<td><a href='/admin/candidates/detail/{{ $jobOrderApplicant->candidate_id}}'target="_blank"> {{$jobOrderApplicant->candidateName}} </a></td>
							<td> <a href='/admin/job_order_applicants?job_order_id={{$jobOrderApplicant->job_order_id}}&candidate_id={{ $jobOrderApplicant->candidate_id }}'target="_blank">{{$jobOrderApplicant->jobOrder->title}} </a></td>
							<td> 
							@if(CRUDBooster::myPrivilegeId()==4)
        					<a href='/admin/companies/detail/{{ $jobOrderApplicant->companyId}}' target="_blank">{{$jobOrderApplicant->companyName}}</a>
                			 @else
               				<a href='/admin/companies/detail/{{ $jobOrderApplicant->companyId}}' target="_blank">{{$jobOrderApplicant->companyName}}</a>
                			@endif</td>
							<td> {{$jobOrderApplicant->recruiterName }} </td>
							<td> @if(!empty($jobOrderApplicant->status_created_at))
							{{date('d/m/Y',strtotime($jobOrderApplicant->status_created_at))}}    
						    @endif</td>

							<td> {{'-'}} </td>
						</tr>
					<?php $i++; ?>
					@endforeach
				</tbody>
			</table>
			<p>{!! urldecode(str_replace("/?","?",$jobOrderApplicants->appends(Request::all())->render())) !!}</p>
	</div>
</div>
@endsection
@push('bottom')

<script type="text/javascript">	
var html = '<h1><i class="fa fa-dashboard"></i> Rejected Candidate List</h1>';
 $(".content-header h1").remove();

    $('.content-header').append(html);
	
</script>
@endpush