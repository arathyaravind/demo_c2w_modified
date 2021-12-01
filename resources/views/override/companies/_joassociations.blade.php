<div class="row">
	<div class="col-md-12">
		<div class="title-main"> JOBORDERS ({{$company->jo_count}})
			<button class="btn btn-xs btn-primary pb-3" id="add-job-order-bt"
			onclick="location.href='/admin/job_orders/add?company_id={{ $id}}'">Add JobOrder</button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive"> 
		<table class="table table-bordered table-striped" >
			<tr>
				<th>Title</th>
				<th>Recruiter</th>
				<th>Added On</th>
				<th>Status</th>
			</tr>
			@foreach($joborders as $jo) 
			<tr>
				<?php $recruiter = \DB::table('cms_users')->where('name',$jo->recruiter)->first();?> 
				<td>
				 @if(CRUDBooster::myPrivilegeId()==4)
				 @if($recruiter->id==CRUDBooster::myId())
				<a href='/admin/job_order_applicants?job_order_id={{$jo->id}}'>{{ $jo->title }}</a>
				@else
                {{ $jo->title }}
                @endif
                @else
                <a href='/admin/job_order_applicants?job_order_id={{$jo->id}}'>{{ $jo->title }}</a>
                @endif
                </td>
				<td><!-- <a href='/admin/users/detail/{{$jo->creator_id}}'> -->{{ $jo->recruiter }}<!-- </a> --></td>
				<td>{{ date("d/m/Y", strtotime($jo->created_at)) }}</td>
				<td>{{ $jo->status }}</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>