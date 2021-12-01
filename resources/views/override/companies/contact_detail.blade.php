@extends('crudbooster::admin_template')
@section('content')
@include('override.companies._styles')
<style>
body section.content-header {
    display: none !important;
}
</style>
<div class="row">
	<div class="col-md-12">
		<h2>{{ $contact->first_name }} {{ $contact->last_name }} {!! empty($contact->title) ? '' : '- '.$contact->title !!} </h2>
	</div>
</div>

<div class="row"> 
	<div class="col-md-4"> <b>Company:</b> </div> 
	<div class="col-md-4"> <b>Department:</b> </div> 
</div>
<div class="row">
	<div class="col-md-4">
		{!! empty($contact->company_name) ? '<i>Not Specified</i>' : $contact->company_name !!}
	</div>
	<div class="col-md-4">
		{!! empty($department) ? '<i>Not Specified</i>' : $department !!}
	</div>
</div>

<hr style="border-color: #f39c12">

<div class="row">
	<div class="col-md-4"> <b>Phone Work:</b> </div>
	<div class="col-md-4"> <b>Phone Cell:</b> </div>
	<div class="col-md-4"> <b>Phone Other:</b> </div>
</div>
<div class="row">
	<div class="col-md-4">
		{!! empty($contact->phone_work) ? '<i>Not Specified</i>' : $contact->phone_work !!}
	</div>
	<div class="col-md-4">
		{!! empty($contact->phone_cell) ? '<i>Not Specified</i>' : $contact->phone_cell !!}
	</div>
	<div class="col-md-4">
		{!! empty($contact->phone_other) ? '<i>Not Specified</i>' : $contact->phone_other !!}
	</div>
</div>

<hr style="border-color: #f39c12">

<div class="row">
	<div class="col-md-4"> <b>Email 1:</b> </div>
	<div class="col-md-4">	<b>Email 2:</b> </div>
</div>
<div class="row">
	<div class="col-md-4">
		{!! empty($contact->email1) ? '<i>Not Specified</i>' : $contact->email1 !!}
	</div>
	<div class="col-md-4">
		{!! empty($contact->email2) ? '<i>Not Specified</i>' : $contact->email2 !!}
	</div>
</div>

<hr style="border-color: #f39c12">

<div class="row">
	<div class="col-md-8"> <b>Address:</b> </div>
</div>
<div class="row">
	<div class="col-md-8">
		{!! (empty($contact->address) ? '' : $contact->address . '<br>') . $city !!}
	</div>
</div>

<hr style="border-color: #f39c12">

<div class="row">
	<div class="col-md-8"> <b>Notes:</b> </div>
</div>
<div class="row">
	<div class="col-md-8">
		{!! (empty($contact->notes) ? '' : $contact->notes ) !!}
	</div>
</div>

<hr style="border-color: #f39c12">

@endsection 