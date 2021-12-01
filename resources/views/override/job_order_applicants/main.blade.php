@extends('crudbooster::admin_template')
@section('content')
@include('override.candidates._styles')
<script>
window.initers = [];
</script>

@include('override.job_order_applicants._styles')

<!-- jo status row -->
<div class="row">
	<div class="col-md-12">
		<div class="jo-status-row">
			<div class="col-md-2 {{ $jobOrder->status === 'New' ? 'current' : '' }}">New</div>
			<div class="col-md-2 {{ $jobOrder->status === 'Intro Call Scheduled' ? 'current' : '' }}">Intro Call Scheduled</div>
			<div class="col-md-2 {{ $jobOrder->status === 'Hiring In Progress' ? 'current' : '' }}">Hiring In Progress</div>
			<div class="col-md-2 {{ $jobOrder->status === 'On Hold' ? 'current' : '' }}">On Hold</div>
			<div class="col-md-2 {{ $jobOrder->status === 'Cancelled' ? 'current' : '' }}">Cancelled</div>
			<div class="col-md-2 {{ $jobOrder->status === 'Completed' ? 'current' : '' }}">Completed</div>
		</div>
	</div>
</div>

@include('override.job_order_applicants._jostatus-new')
@include('override.job_order_applicants._jostatus-intro-call-scheduled')
@include('override.job_order_applicants._jostatus-hiring-in-progress')
@include('override.job_order_applicants._jostatus-on-hold')
@include('override.job_order_applicants._jostatus-cancelled')
@include('override.job_order_applicants._jostatus-completed')

@include('override.job_order_applicants._scripts')

@endsection