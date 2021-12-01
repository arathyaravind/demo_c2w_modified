<div class="row">
	<div class="col-md-12">
		<div class="title-main"> CONTACTS ({{$company->contact_count}})&nbsp;&nbsp;&nbsp;<button class="btn btn-xs btn-primary pb-3" 
			onclick="$('.add-contact-row').toggleClass('hidden'); $('input[name=first_name]:visible').focus();">Add Contact</button></div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive"> 
		<table class="table table-bordered table-striped">
			<tr>
				<th>Name</th>
				<th>Designation</th>
				<th>Email</th>
				<th>Phone</th>
				<th>City</th>
				<th>&nbsp;</th>
			</tr>
			@foreach($contacts as $contact) 
			<tr>
				<td>{{ implode(' ', [$contact->first_name, $contact->last_name]) }}</td>
				<td>{{ $contact->title }}</td>
				<td>{!! (empty($contact->email1) ? '' : $contact->email1 . '<br>') . $contact->email2 !!}</td>
				<td>{!! (empty($contact->phone_work) ? '' : $contact->phone_work . '<br>') . (empty($contact->phone_cell) ? '' : $contact->phone_cell . '<br>') . $contact->phone_other !!}</td>
				<?php $contactCity = \DB::table('cities')->find($contact->city)->name; ?>
				<td>{{ $contactCity }}</td>
				<td>
					<a class="btn btn-xs btn-success" href="/admin/companies/detail/{{ $contact->company_id }}?edit_contact={{ $contact->id }}">Edit</a>&nbsp;
					<button class="btn btn-xs btn-danger" onclick="deleteContact({{ $contact->id }})">Delete</button>
				</td>
			</tr>
			@endforeach
			<tr class="hidden add-contact-row">
				<td colspan="6"><h4>Add New Contact</h4></td>
			</tr>
			<tr class="hidden add-contact-row">
				<td>
					<input class="form-control" type="text" placeholder="* First Name" name="first_name" id="first_name" required=""><br>
					<input class="form-control" type="text" placeholder="Designation" name="title">
				</td>
				<td>
					<input class="form-control" type="text" placeholder="* Last Name" name="last_name" id="last_name">
				</td>
				<td>
					<div class="hidden form-control alert-warning">Incorrect email.</div>
					<input class="form-control" type="text" placeholder="Email 1" name="email1" id="email1"><br>
					<input class="form-control" type="text" placeholder="Email 2" name="email2" id="email2">
				</td>
				<td>
					<input class="form-control" type="number" placeholder="Phone Work" name="phone_work" id="phone_work"><br>
					<input class="form-control" type="number" placeholder="Phone Cell" name="phone_cell"><br>
					<input class="form-control" type="number" placeholder="Phone Other" name="phone_other">
				</td>
				<td>
					<!-- <input class="form-control" type="text" placeholder="City" name="city"><br> -->
					<select class="form-control" name = "city" id= "city">
						<option value =''>Select City</option>
						@foreach($cities as $city)
						 <option value="{{$city->id}}"> {{ $city->name}}</option>
						@endforeach
					</select> <br>
					<button class="btn btn-sm btn-success" type="button" onclick="saveContact()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="$('.add-contact-row').toggleClass('hidden')">Cancel</button>
				</td>
			</tr>
			@if(request()->input('edit_contact'))
			<?php $eContact = \DB::table('contacts')->where('id', request()->input('edit_contact'))->first(); ?>
			<tr class="edit-contact-row">
				<td colspan="6"><h4>Edit Contact</h4></td>
			</tr>
			<tr class="edit-contact-row">
				<td>
					<input class="form-control" type="text" placeholder="* First Name" name="first_name" id="e_first_name" value="{{ $eContact->first_name }}" required=""><br>
					<input class="form-control" type="text" placeholder="Designation" name="title" value="{{ $eContact->title }}">
				</td>
				<td>
					<input class="form-control" type="text" placeholder="* Last Name" name="last_name" id="e_last_name" value="{{ $eContact->last_name }}" required="">
				</td>
				<td>
					<input class="form-control" type="text" placeholder="Email 1" name="email1" id="e_email1" value="{{ $eContact->email1 }}"><br>
					<input class="form-control" type="text" placeholder="Email 2" name="email2" id="e_email2" value="{{ $eContact->email2 }}">
				</td>
				<td>
					<input class="form-control" type="number" placeholder="Phone Work" id="ephone_work" name="phone_work" value="{{ $eContact->phone_work }}"><br>
					<input class="form-control" type="number" placeholder="Phone Cell" name="phone_cell" value="{{ $eContact->phone_cell }}"><br>
					<input class="form-control" type="number" placeholder="Phone Other" name="phone_other" value="{{ $eContact->phone_other }}">
				</td>
				<td>
					<!-- <input class="form-control" type="text" placeholder="City" name="city" value="{{ $eContact->city }}"><br> -->
					<select class="form-control" name = "city" id= "ecity">
						<option value =''>Select City</option>
						@foreach($cities as $city)
						 <option value="{{$city->id}}" {{($eContact->city == $city->id)? 'selected' : ''}}> {{ $city->name}}</option>
						@endforeach
					</select> <br>
					<button class="btn btn-sm btn-success" type="button" onclick="updateContact()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="window.location.href = '/admin/companies/detail/{{ $contact->company_id }}'">Cancel</button>
				</td>
			</tr>
			@endif
		</table>
	</div>
</div>
<script>
	function saveContact() {
		console.log('save contact');
		var fname = $("#first_name").val();
		var lname = $("#last_name").val();
		var email1 = $("#email1").val();
		var email2 = $("#email2").val();
		var email_pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
		if(fname==''){
			$("#first_name").focus();
			$("#first_name").css("border","1px solid red");
			$("#last_name").css("border","1px solid #d2d6de");
			$("#email1").css("border","1px solid #d2d6de");
			$("#email2").css("border","1px solid #d2d6de");
			return false;
		}
		if(lname==''){
			$("#last_name").focus();
			$("#last_name").css("border","1px solid red");
			$("#first_name").css("border","1px solid #d2d6de");
			$("#email1").css("border","1px solid #d2d6de");
			$("#email2").css("border","1px solid #d2d6de");
			return false;
		}
		if(!email1){
			if(!email_pattern.test(email1)) {
				$("#email1").focus();
				$("#email1").val("") ;
				$("#email1").attr("placeholder","Incorrect email format");
				$("#email1").css("border","1px solid red");
				$("#first_name").css("border","1px solid #d2d6de");
				$("#last_name").css("border","1px solid #d2d6de");
				$("#email2").css("border","1px solid #d2d6de");
				return false;
			}
		}
		// if(!email2){
		// 	$("#email2").focus();
		// 	$("#email2").css("border","1px solid red");
		// 	$("#first_name").css("border","1px solid #d2d6de");
		// 	$("#last_name").css("border","1px solid #d2d6de");
		// 	$("#email1").css("border","1px solid #d2d6de");
		// 	return false;
		// }
		if(!$.trim($("#phone_work").val())){
			$("#phone_work").focus();
			$("#phone_work").attr("placeholder","Incorrect number");
			$("#phone_work").css("border","1px solid red");
			$("#first_name").css("border","1px solid #d2d6de");
			$("#last_name").css("border","1px solid #d2d6de");
			$("#email1").css("border","1px solid #d2d6de");
			return false;
		}
		var payload = {
			company_id: '{{ $company->id }}',
			company_name: '{{ $company->name}}',
			office_id: '{{ $company->id }}',
			office_name: '{{ $company->name}}',
			status: 1
		};

		$('.add-contact-row input').each(function() {
			payload[$(this).attr('name')] = $(this).val();
		});
		payload['city'] = $('#city').val();
		$.post('/custom/save-company-contact', payload, function() {
			window.location.reload();
		});
	}
	
	function updateContact() {

	var e_fname = $("#e_first_name").val();
	var e_lname = $("#e_last_name").val();
	var e_email1 = $("#e_email1").val();
	var e_email2 = $("#e_email2").val();
	var email_pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
	
	if(e_fname==''){
		$("#e_first_name").focus();
		$("#e_first_name").css("border","1px solid red");
		$("#e_last_name").css("border","1px solid #d2d6de");
		$("#e_email1").css("border","1px solid #d2d6de");
		$("#e_email2").css("border","1px solid #d2d6de");
				
		return false;
	}
	if(e_lname==''){
		$("#e_last_name").focus();
		$("#e_last_name").css("border","1px solid red");
		$("#e_first_name").css("border","1px solid #d2d6de");
		$("#e_email1").css("border","1px solid #d2d6de");
		$("#e_email2").css("border","1px solid #d2d6de");
		
		return false;
	}

	if(!e_email1){
		if(!email_pattern.test(e_email1)) {
			$("#e_email1").focus();
			$("#e_email1").val("") ;
			$("#e_email1").attr("placeholder","Incorrect email format");
			$("#e_email1").css("border","1px solid red");
			$("#e_first_name").css("border","1px solid #d2d6de");
			$("#e_last_name").css("border","1px solid #d2d6de");
			$("#email2").css("border","1px solid #d2d6de");
			return false;
		}
	}
	// if(e_email2!=''){
	// 	$("#e_email2").focus();
	// 	$("#e_email2").val("") ;
	// 	$("#e_email2").attr("placeholder","Incorrect email format");
	// 	$("#e_email2").css("border","1px solid red");
	// 	$("#e_first_name").css("border","1px solid #d2d6de");
	// 	$("#e_last_name").css("border","1px solid #d2d6de");
	// 	$("#e_email1").css("border","1px solid #d2d6de");
	// 	return false;
	// }
	if(!$.trim($('#ephone_work').val())) {
		$("#ephone_work1").focus();
		$("#ephone_work").val("") ;
		$("#ephone_work").attr("placeholder","Incorrect Number");
		$("#ephone_work").css("border","1px solid red");
		$("#e_first_name").css("border","1px solid #d2d6de");
		$("#e_last_name").css("border","1px solid #d2d6de");
		$("#e_email1").css("border","1px solid #d2d6de");
		return false;
	}

	var payload = {
		company_id: '{{ $contact->company_id }}'
	};
	$('.edit-contact-row input').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	payload['city'] = $('#ecity').val();
	$.post('/custom/update-company-contact/' + '{{ request()->input('edit_contact') }}', payload, function() {
		window.location.href = '/admin/companies/detail/{{ $contact->company_id }}';
	});
}
function deleteContact(_id) {
	if(window.confirm('Are you sure?')) {
		$.post('/custom/delete-company-contact/' + _id, {}, function() {
			window.location.href = '/admin/companies/detail/{{ $contact->company_id }}';
		});
	}
}
</script>