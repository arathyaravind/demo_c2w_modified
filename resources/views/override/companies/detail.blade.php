@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@include('override.companies._styles')
<style>
body section.content-header {
    display: none !important;
}
</style>
@if($company->logo_url!='')
<div class="row">
	<div class="col-md-2">
		<img src="/{{$company->logo_url}}" class="img-thumbnail img-responsive">
	</div>
</div>
@endif
<div class="row">
	<div class="col-md-12">
		<h2>{{ $company->name }}</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		@if($company->web_site!='')
			@if (strpos($company->web_site, 'http') === 0) 
	    		{!! empty($company->web_site) ? '<i>No URL Specified</i>' : '<a target="_blank" href="' . $company->web_site . '">' . $company->web_site . '</a>' !!}
	    	@else
	    		{!! empty($company->web_site) ? '<i>No URL Specified</i>' : '<a target="_blank" href="http://' . $company->web_site . '">' . $company->web_site . '</a>' !!}
			@endif
		@endif
	</div>
	<div class="col-md-4">
		<b><?php $rate_vname = 'Contract Rate'; ?></b>
		{!! empty($company->contract_rate) ? '<i>No Rate Specified</i>' : $rate_vname.'(%): '.$company->contract_rate !!}
	</div>
	<div class="col-md-4">
		<b>{!! empty($company->status) ? '<i>No Status Specified</i>' : $company->status !!}</b>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		{!! (empty($company->address) ? '' : $company->address . '<br>') . $company->city .'<br>'. $company->state  !!}
		{!! (empty($company->zip) ? '' : ' - '.$company->zip )  !!}
	</div>
	<div class="col-md-8">
		{!! (empty($company->phone1) ? '' : $company->phone1 . '<br>') . $company->phone2 !!}
	</div>
</div>

<hr style="border-color: #f39c12">

@include('override.companies._industries')

<hr style="border-color: #f39c12">

@include('override.companies._departments')


<hr style="border-color: #f39c12">

@include('override.companies._joassociations')

<hr style="border-color: #f39c12">

@include('override.companies._contacts')

<hr style="border-color: #f39c12">

@include('override.companies._notes')


@endsection

@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    	$('.select-select2').select2();
	});
</script>
@endpush
