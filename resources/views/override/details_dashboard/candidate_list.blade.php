@extends('crudbooster::admin_template')
 <title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Candidate Added List" }}</title>
@section('content')
@include('override.details_dashboard._styles')
<?php set_time_limit(0);?>
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
        	{{-- @if($candidatesCount<100)
        	<form method="get" action='/admin/candidateListPdfView' target="_blank" class="form-horizontal">
				<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
					Print PDF
				</button>
				<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
				<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
				<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
			</form>
				@endif --}}
				@if(count($candidates)>0)
				<form method="get" action='/admin/candidateListCsvView' target="_blank" class="form-horizontal">
				<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
					Export CSV
				</button>
				<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
				<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
				<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
			</form>
			@endif
			<table class="table table-striped">
				<thead>
					<tr>
						<th> Sl No. </th>
						<th>Candidate Name</th>
						<th> Email </th>
						<th> Contact Number </th>
						<th> Created By </th>
						<th>Candidates Added Date</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = ($candidates->currentpage()-1)* $candidates->perpage() + 1; ?>
					@foreach($candidates as $candidate)
						<tr>
							<td> {{$i}} </td>
							<td><a href='/admin/candidates/detail/{{ $candidate->id}}'target="_blank">  {{$candidate->first_name}} {{ $candidate->last_name}}  </a></td>
							<td> {{  $candidate->primary_email}} </td>
							<td> {{$candidate->primary_phone}} </td>
							<td> {{DB::table('cms_users')->find($candidate->creator_id)->name}} </td>
							<td> @if( $candidate->created_at )
									{{date('d/m/Y',strtotime($candidate->created_at))}}
								@else
									'-'
								@endif		
							</td>
						
						</tr>
					<?php $i++; ?>
					@endforeach
				</tbody>
			</table>
			<p>{!! urldecode(str_replace("/?","?",$candidates->appends(Request::all())->render())) !!}</p>
		</div>
	</div>
</div>
@endsection
@push('bottom')

<script type="text/javascript">	
var html = '<h1><i class="fa fa-dashboard"></i> Candidate Added List</h1>';
 $(".content-header h1").remove();

    $('.content-header').append(html);
	
</script>
@endpush