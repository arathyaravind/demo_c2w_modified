@extends('crudbooster::admin_template')
 <title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Candidate Submission List" }}</title>
@section('content')

@include('override.details_dashboard._styles')
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
        	<!-- <form method="get" class="form-horizontal" action='/admin/submittedcandidateListPdfView' target="_blank">
        					<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
        						Print PDF
        					</button>
        	
        					<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
        					<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
        					<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
        				</form> -->
        	@if(count($jobOrderApplicants)>0)
			<form method="get" class="form-horizontal" action='/admin/submittedcandidateListCsvView' target="_blank">
				<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
					Export CSV
				</button>

				<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
				<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
				<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
			</form>
			@endif

			<table class="table table-striped " >
				<thead>
					<tr>
						<th> Sl No. </th>
						<th> Candidate Name </th>
						<th> Job Order </th>
						<th> Company</th>
						<th> User </th>
						<th> Submission Date </th>
						<th> Created Date </th>
						<th>Next Action</th>
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
							<td> @if(!empty($jobOrderApplicant->date_submitted))
							{{date('d/m/Y',strtotime($jobOrderApplicant->date_submitted))}}        @endif</td>
							<td> @if(!empty($jobOrderApplicant->status_created_at))
							{{date('d/m/Y',strtotime($jobOrderApplicant->status_created_at))}}          
							@endif</td>
							<td>@if(!empty($jobOrderApplicant->next_action=='Get Submission Feedback'))
								@if(!empty($jobOrderApplicant->feedback_date))
								    {{$jobOrderApplicant->next_action}}
									<span class="jo-date-highlight">Feedback on <b>{{ date("d/m/Y", strtotime($jobOrderApplicant->feedback_date)) }}</b>
									</span>
								@endif
								@else
								{{'Get Submission Feedback'}}
								<span class="jo-date-highlight">Feedback on <b>{{ date("d/m/Y", strtotime($jobOrderApplicant->new_feedback_date)) }}</b>
									</span>
								@endif
							</td>
								
						</tr>
					<?php $i++; ?>
					@endforeach
				</tbody>
			</table>
			<p>{!! urldecode(str_replace("/?","?",$jobOrderApplicants->appends(Request::all())->render())) !!}</p> 
		</div>
	</div>
</div>
@endsection
@push('bottom')

<script type="text/javascript">
	/*
	$(document).ready(function() {
    	$("#birth_date").datepicker();
  	});*/
  	
		var html = '<h1><i class="fa fa-dashboard"></i> Candidate Submission List</h1>';
        $(".content-header h1").remove();

        $('.content-header').append(html);
	
	  

</script>
@endpush