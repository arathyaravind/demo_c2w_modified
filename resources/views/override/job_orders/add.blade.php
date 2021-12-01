@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />
@include('override.candidates._styles')
<script>
	window.initers = [];
</script>
@if(CRUDBooster::getCurrentMethod() != 'getProfile')
<p>
	<a href='{{CRUDBooster::mainpath()}}'> 
		<i class="fa fa-chevron-circle-left "></i>
		{{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}
	</a>
</p>      
@endif

<div id="Personal" class="">
	<div class="row">
		<div class="panel panel-default jo-panel">
			<div class="panel-body">
				<form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" action="{{CRUDBooster::mainpath('add-save')}}" novalidate="">
					<div class="form-group">
						<div class='col-md-2'> 
							Company <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control multi-select' name='company_id' id='company_id' onchange="listContacts(this.value)">
								<option value=''>--</option>
								@foreach($companies as $company)
									<option value = "{{$company->id}}" {{ $_REQUEST['company_id'] == $company->id ? 'selected' : '' }} >{{$company->name}}</option>
								@endforeach
							</select>
						</div>
						<div class='col-md-2'> 
							Contact <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='contact_id' id='contact_id'>
								<option value="">--</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class='col-md-2'> 
							Title <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='text' class='form-control' name='title' id='title'>
						</div>
						<div class='col-md-2'> 
							Industry <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='industry' id='industry'>
								<option value="">--</option>
								@foreach($industries as $industry)
									<option value='{{$industry->id}}'> {{$industry->name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">					
						<div class='col-md-2'> 
							Functional Area <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control multi-select' name='functional_area[]' id='functional_area' multiple="" onchange="listFunctionalAreaRolesAndSkills(this.value)">
								@foreach($functionalAreas as $functionalArea)
									<option value='{{$functionalArea->id}}'> {{$functionalArea->name}}</option>
								@endforeach
							</select>
						</div>

						<div class='col-md-2'> 
							Functional Area Skills <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control multi-select' name='functional_area_skill[]' id='functional_area_skill' multiple="">
							</select>
						</div>
					</div>

					<div class="form-group">					
						<div class='col-md-2'> 
							Functional Area Roles <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='functional_area_role' id='functional_area_role'>
								<option value="">--</option>
							</select>
						</div>

						<div class='col-md-2'> 
							General Skills <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control multi-select' name='general_skill[]' id='general_skill' multiple="">
								@foreach($generalSkills as $generalSkill)
									<option value='{{$generalSkill->id}}'>{{$generalSkill->name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class='col-md-2'> 
							Start Date <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='date' class='form-control' name='start_date' id='start_date'>
						</div>

						<div class='col-md-2'> 
							Expiry Date <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='date' class='form-control' name='expiry_date' id='expiry_date'>
						</div>
					</div>

					<!--<div class="form-group">					
						<div class='col-md-2'> 
							Min Exp Years<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='min_exp_years' id='min_exp_years'>
						</div>

						<div class='col-md-2'> 
							Min Exp Months<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='min_exp_months' id='min_exp_months'>
						</div>
					</div>-->
										<div class="form-group">
										<div class="col-md-2">
											Minimum Experience <span class='text-danger' title='This field is required'>*</span>
										</div>
										<input type="hidden" name='min_exp_years' id='min_exp_years' class="form-control" value="">
										<input type="hidden" name='min_exp_months' id='min_exp_months' class="form-control" value="">
										<div class="col-md-3">
										<div class="dropdown">
			    						<button class="btn btn-experience form-control" id="min_experience" onclick="getMinExpVal()" type="button" data-toggle="dropdown" value=" ">Minimum Experience
			     						</button>
										    <ul class="dropdown-menu col-md-12">
										    	 <span class="pull-right">
										        <button type="button"class="btn btn-danger btn-sm" data-toggle="dropdown">
										          <span class="glyphicon glyphicon-remove-sign"></span> Close
										        </button>
										      </span>
										      <br/>
										        <div class="col-md-6 btn-scroll">

										       <li><h4>Year</h4></li>
										     
												@for($x = 0; $x <= 50; $x++)  
												    <li>
												<div class="radio">
												  <label><input type="radio" value="{{$x}}" name="min_year" onclick="getMinExpVal()">{{$x}}</label>
												</div></li>
												    @endfor
												     </div>
												      <div class="col-md-6 btn-scroll">
												      <li><b><h4>Month</h4></b></li>
												       
												@for($x = 0; $x <= 11; $x++) 
												      <li>
												<div class="radio">
												  <label><input type="radio" value="{{$x}}" name="min_month" onclick="getMinExpVal()">{{$x}}</label>
												</div></li>
												   @endfor
												</div>
												  <p class="pull-right">
												        <a class="btn btn-danger btn-sm" id="min_experience_remove">
												          <span class="glyphicon glyphicon-remove"></span> Clear Selection
												        </a>
												      </p>

												    </ul>
												  </div></div>
			 
			                          

					<!-- <div class="form-group">
						<div class='col-md-2'> 
							Max Exp Years<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='max_exp_years' id='max_exp_years'>
						</div>
						
						<div class='col-md-2'> 
							Max Exp Months<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='max_exp_months' id='max_exp_months'>
						</div>
					</div> -->
										<div class="col-md-2">
											Maximum Experience <span class='text-danger' title='This field is required'>*</span>
										</div>
										<input type="hidden" name='max_exp_years' id='max_exp_years' class="form-control" value="">
										<input type="hidden" name='max_exp_months' id='max_exp_months' class="form-control" value="">
										<div class="col-md-3">
										                                       <div class="dropdown">
						    <button class="btn btn-experience form-control" id="max_experience" onclick="getMaxExpVal()" type="button" data-toggle="dropdown" value=" ">Maximum Experience
						 
						     
						    </button>
						     
						    <ul class="dropdown-menu col-md-12">
						    	 <span class="pull-right">
						        <button type="button"class="btn btn-danger btn-sm" data-toggle="dropdown">
						          <span class="glyphicon glyphicon-remove-sign"></span> Close
						        </button>
						      </span>
						      <br/>
						        <div class="col-md-6 btn-scroll">
						
						       <li><h4>Year</h4></li>
						         
						@for($x = 0; $x <= 50; $x++)  
						    <li>
						<div class="radio">
						  <label><input type="radio" value="{{$x}}" name="max_year" onclick="getMaxExpVal()">{{$x}}</label>
						</div></li>
						    @endfor
						     </div>
						      <div class="col-md-6 btn-scroll">
						      <li><b><h4>Month</h4></b></li>
						       
						@for($x = 0; $x <= 11; $x++) 
						      <li>
						<div class="radio">
						  <label><input type="radio" value="{{$x}}" name="max_month" onclick="getMaxExpVal()">{{$x}}</label>
						</div></li>
						   @endfor
						</div>
						  <p class="pull-right">
						        <a class="btn btn-danger btn-sm" id="max_experience_remove">
						          <span class="glyphicon glyphicon-remove"></span> Clear Selection
						        </a>
						      </p>
						
						    </ul>
						  </div></div>
						 
						                                              
						     
									</div> 

					<div class="form-group">					
						<div class='col-md-2'> 
							Min CTC <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' step="0.01" class='form-control' name='min_ctc' id='min_ctc' placeholder="In Lakhs" min="0">
						</div>
						<div class='col-md-2'> 
							Max CTC <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' step="0.01" class='form-control' name='max_ctc' id='max_ctc' placeholder="In Lakhs" min="0">
						</div>
					</div>

					<!-- <div class="form-group">
						<div class='col-md-2'> 
							Status<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='status' id='status'>
								<option value=''>--</option>
								<option value='Full'>Full</option>
								<option value='OnHold'>OnHold</option>
								<option value='Active'>Active</option>
								<option value='Canceled'>Canceled</option>
								<option value='Closed'>Closed</option>
							</select>
						</div>
 -->
						<!-- <div class='col-md-2'> 
							Next Step<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='next_step' id='nex_step'>
								<option value="">--</option>
							</select>
						</div> -->
					<!-- </div> -->

					<!-- <div class="form-group">
						<div class='col-md-2'> 
							Intro Call Date<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='date' class='form-control' name='intro_call_date' id='intro_call_date'>
						</div>
						<div class='col-md-2'> 
							Submission Date<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='date' class='form-control' name='submission_date' id='submission_date'>
						</div>
					</div> -->

					<div class="form-group">
						<div class='col-md-2'> 
							Client Job Id<!-- <span class='text-danger' title='This field is required'>*</span> -->
						</div>
						<div class='col-md-3'>
							<input type='text' class='form-control' name='client_job_id' id='client_job_id'>
						</div>
						<div class='col-md-2'> 
							Type <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='type' id='type'>
								<option value=''>--</option>
								<option value='C'> C </option>
								<option value='H'> H </option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class='col-md-2'> 
							Duration<!-- <span class='text-danger' title='This field is required'>*</span> -->
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='duration' id='duration' placeholder="In Months" min="0">
						</div>
						<div class='col-md-2'> 
							Max Rate<!-- <span class='text-danger' title='This field is required'>*</span> -->
						</div>
						<div class='col-md-3'>
							<input type='text' class='form-control' name='rate_max' id='rate_max'>
						</div>
					</div>
					<div class="form-group">
						<div class='col-md-2'> 
							Is Hot
						</div>
						<div class='col-md-3'>
							<input type='checkbox' name='is_hot' id='is_hot' value='1'>
						</div>
						<div class='col-md-2'> 
							Public
						</div>
						<div class='col-md-3'>
							<input type='checkbox' name='public' id='public' value='1'>
						</div>						
					</div>
					<div class="form-group">
						<div class='col-md-2'> 
							State <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control multi-select' name='state' id='state' onchange='listCities(this.value)'>
								<option value=''>--</option>
								@foreach($indianStates as $state)
									<option value='{{$state->id}}'>
										{{$state->name}}
									</option>
								@endforeach
							</select>
						</div>
						<div class='col-md-2'> 
							City <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control multi-select' name='city' id='city'>
								<option value=''>--</option>
							</select>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class='col-md-2'> 
							Company_department_id<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='text' class='form-control' name='company_department_id' id='company_department_id'>
						</div>
						<div class='col-md-2'> 
							is_admin_hidden<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='text' class='form-control' name='is_admin_hidden' id='is_admin_hidden'>
						</div>
					</div> -->
					
					<div class="form-group">
						<div class='col-md-2'> 
							No. of Vacancies <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='num_vacancies' id='num_vacancies' min='1'>
						</div>

						<!-- <div class='col-md-2'> 
							Openings Available<span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<input type='number' onkeypress="return checkIsNumber(event)" class='form-control' name='openings_available' id='openings_available'>
						</div> -->
					</div>

					<div class="form-group">
						<div class='col-md-2'> 
							Notes <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-8'>         
							<textarea class='form-control' name='notes' id='notes' rows="6"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class='col-md-2'> 
							Description <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-8'>
							 <textarea id='description' required   name='description' class='form-control' rows='5'></textarea> 
							 	<!-- <div><p><h5><b>Job Brief</b></h5><p></p><h5><b>Responsibilities</b></h5><p></p><h5><b>Requirements</b></h5><p></p></p></div> -->
							<!-- <textarea class='form-control' name='description' id='description' rows="6"></textarea> -->
						</div>
					</div>

					<div class="form-group">					
						
						<div class='col-md-2'> 
							Owner <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='owner' id='owner'>
								<option value=''>--</option>
								@foreach($users as $user)
							<option value='{{$user->id}}' {{ $user->id == CRUDBooster::myId() ? 'selected':''}} > {{$user->name}}
							</option>
								@endforeach
							</select>
						</div>

						<div class='col-md-2'> 
							Recruiter <span class='text-danger' title='This field is required'>*</span>
						</div>
						<div class='col-md-3'>
							<select class='form-control' name='recruiter' id='recruiter'>
								<option value=''>--</option>
								@foreach($users as $user)
							<option value='{{$user->id}}' {{ $user->id == CRUDBooster::myId() ? 'selected':''}} > {{$user->name}}
							</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-2">
							<input type="submit"  value="Save" class="btn btn-success">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('bottom')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>

<!-- include summernote css/js-->
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
	<script type="text/javascript">		
		$(document).ready(function(){
			$('.multi-select').select2();
			$( "#min_experience_remove" ).click(function() {
		    		var buttonValue= 'Minimum Experience';
		   		$('#min_experience').html(buttonValue);
		   		$('#min_experience').val("");
		   		$('#min_exp_years').val("");
		   		$('#min_exp_months').val("");
		   		$('input[name="min_year"]').prop('checked', false);
		   		$('input[name="min_month"]').prop('checked', false);
		});
			$('#description').summernote({
            height: 150,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        });
			$( "#max_experience_remove" ).click(function() {
    		var buttonValue= 'Maximum Experience';
   		$('#max_experience').html(buttonValue);
   		$('#max_experience').val("");
   		$('#max_exp_years').val("");
   		$('#max_exp_months').val("");
   		$('input[name="max_year"]').prop('checked', false);
   		$('input[name="max_month"]').prop('checked', false);
});
    	$(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
        });
			$('form').submit(function() {
				var description = $('#description').val();
				$(this).find('.validate-error').removeClass('validate-error');
				if(!$('#company_id').val()) {
					$("#company_id").next(".select2").addClass('validate-error').focus();
					return false;
				}
				if(!$('#contact_id').val()) {
					$(this).find('#contact_id').addClass('validate-error').focus();
					return false;
				}
				if(!$.trim($('#title').val())) {
					$(this).find('#title').addClass('validate-error').focus();
					return false;
				}
				if(!$('#industry').val()) {
					$(this).find('#industry').addClass('validate-error').focus();
					return false;
				}
				if(!$('#functional_area').val()) {
					$('#functional_area').next(".select2").addClass('validate-error').focus();
					return false;
				}
				if(!$('#functional_area_skill').val()) {
					$('#functional_area_skill').next(".select2").addClass('validate-error').focus();
					return false;
				}
				if(!$('#functional_area_role').val()) {
					$(this).find('#functional_area_role').addClass('validate-error').focus();
					return false;
				}
				if(!$('#general_skill').val()) {
					$('#general_skill').next(".select2").addClass('validate-error').focus();
					return false;
				}
				if(!$('#start_date').val()) {
					$(this).find('#start_date').addClass('validate-error').focus();
					return false;
				}
				if(!$('#expiry_date').val()) {
					$(this).find('#expiry_date').addClass('validate-error').focus();
					return false;
				}
				/*if(!$('#min_exp_years').val()) {
					$(this).find('#min_exp_years').addClass('validate-error').focus();
					return false;
				}
				if(!$('#min_exp_months').val()) {
					$(this).find('#min_exp_months').addClass('validate-error').focus();
					return false;
				}*/
				if(!$.trim($('#min_experience').val())) {
					$(this).find('#min_experience').addClass('validate-error').focus();
					return false;
				}
				if(!$.trim($('#max_experience').val())) {
					$(this).find('#max_experience').addClass('validate-error').focus();
					return false;
				}

				/*if(!$('#max_exp_years').val()) {
					$(this).find('#max_exp_years').addClass('validate-error').focus();
					return false;
				}
				if(!$('#max_exp_months').val()) {
					$(this).find('#max_exp_months').addClass('validate-error').focus();
					return false;
				}*/
				if(!$('#min_ctc').val()) {
					$(this).find('#min_ctc').addClass('validate-error').focus();
					return false;
				}
				if(!$('#max_ctc').val()) {
					$(this).find('#max_ctc').addClass('validate-error').focus();
					return false;
				}
				/*if(!$('#client_job_id').val()) {
					$(this).find('#client_job_id').addClass('validate-error').focus();
					return false;
				}*/
				if(!$('#type').val()) {
					$(this).find('#type').addClass('validate-error').focus();
					return false;
				}
				/*if(!$('#duration').val()) {
					$(this).find('#duration').addClass('validate-error').focus();
					return false;
				}*/
				/*if(!$('#rate_max').val()) {
					$(this).find('#rate_max').addClass('validate-error').focus();
					return false;
				}*/
				if(!$('#state').val()) {
					/*$(this).find('#state').addClass('validate-error').focus();*/
					$("#state").next(".select2").addClass('validate-error').trigger('focus.select2');
					return false;
				}
				if(!$('#city').val()) {
					/*$(this).find('#city').addClass('validate-error').focus();*/
					$("#city").next(".select2").addClass('validate-error').trigger('focus.select2');
					return false;
				}
				if(!$('#num_vacancies').val()) {
					$(this).find('#num_vacancies').addClass('validate-error').focus();
					return false;
				}
				/*if(!$('#openings_available').val()) {
					$(this).find('#openings_available').addClass('validate-error').focus();
					return false;
				}*/
				if(!$.trim($('#notes').val())) {
					$(this).find('#notes').addClass('validate-error').focus();
					return false;
				}
				if(!$.trim($(description).text().replace(/ /g,''))) {
					console.log("enter");
					$(".note-editor").addClass('validate-error').focus();
					//$('.jobOrderDescription').addClass('validate-error').focus();
					return false;
				}
				if(!$('#owner').val()) {
					$(this).find('#owner').addClass('validate-error').focus();
					return false;
				}
				if(!$('#recruiter').val()) {
					$(this).find('#recruiter').addClass('validate-error').focus();
					return false;
				}
				// submit more than once return false
				$(this).submit(function() {
					return false;
				});
				// submit once return true
				return true;
					});
		});
function getMinExpVal()
{
    var year=$('input[name=min_year]:checked').val();
    var month=$('input[name=min_month]:checked').val();
    if(year!== undefined)
   {
   	 var buttonValue=year+' years';
   	  $('#min_experience').html(buttonValue);
   	  $('#min_exp_years').val(year);

   }
  if(month!== undefined)
   {
   	 var buttonValue=month+' months';
   	  $('#min_experience').html(buttonValue);
   	  $('#min_exp_months').val(month);
   }
   if((year!== undefined) && (month!== undefined))
   {
   	var buttonValue= year+' years'+' '+ month+' months';
   	$('#min_experience').html(buttonValue);
   	$('#min_experience').val(buttonValue);
   	$('#min_exp_years').val(year);
   	$('#min_exp_months').val(month);
   }
    if((year== undefined) && (month== undefined)) 
    {	
   	var buttonValue= 'Minimum Experience';
   		$('#min_experience').html(buttonValue);
   }
   }
 function getMaxExpVal()
{
    var year=$('input[name=max_year]:checked').val();
    var month=$('input[name=max_month]:checked').val();
    if(year!== undefined)
   {
   	 var buttonValue=year+' years';
   	  $('#max_experience').html(buttonValue);
   	  $('#max_exp_years').val(year);

   }
  if(month!== undefined)
   {
   	 var buttonValue=month+' months';
   	  $('#max_experience').html(buttonValue);
   	  $('#max_exp_months').val(month);
   }
   if((year!== undefined) && (month!== undefined))
   {
   	var buttonValue= year+' years'+' '+ month+' months';
   	$('#max_experience').html(buttonValue);
   	$('#max_experience').val(buttonValue);
   	$('#max_exp_years').val(year);
   	$('#max_exp_months').val(month);
   }
    if((year== undefined) && (month== undefined)) 
    {	
   	var buttonValue= 'Minimum Experience';
   		$('#max_experience').html(buttonValue);
   }
   }
function listStates(country_id) {
	$.get('{{CRUDBooster::mainpath()}}/add', {
		country_id: country_id,
		current_action: 'list_states',
	}, function(_data) {
		var select = $('form select[name= state_id]');
		$.each(_data,function(key, value) {
			select.append('<option value=' + value.id + '>' + value.name + '</option>');
		});
	});
}

		function listContacts(_companyId){
			$.get('{{CRUDBooster::mainpath()}}/add', {
	            company_id : _companyId,
	            current_action : 'list_contacts',
	        }, function(_contacts) {
                select = $('#contact_id');
                select.empty();
                select.append("<option value=''>--</option>");
				$.each(_contacts,function(key, value) {
	                select.append('<option value=' + value.id + '>' + value.first_name +' '+ ( (value.last_name) ? value.last_name : '') +
	                	'</option>');
	            	});
				});
		}

		function listFunctionalAreaRolesAndSkills() {
	    	$.get('{{CRUDBooster::mainpath()}}/add', {
	            functional_area_id: $('#functional_area').val(),
	            current_action: 'list_functional_roles_skills',
	        }, function(_dataFunctionalArea) {
	        	var selectRoles = $('#functional_area_role');
	        	selectRoles.empty();
	        	selectRoles.append("<option value=''>--</option")
		 		$.each(_dataFunctionalArea['roles'],function(key, value) {
	                selectRoles.append('<option value=' + value.id + '>' + value.name + '</option>');
	            });

	            var selectSkills = $('#functional_area_skill');
	        	selectSkills.empty();
	        	$.each(_dataFunctionalArea['skills'],function(key, value) {
	                selectSkills.append('<option value=' + value.id + '>' + value.name + '</option>');
	            });
	        });
	    }


	function listCities(state_id) {
        $.get('{{CRUDBooster::mainpath()}}/add', {
            state_id: state_id,
            current_action: 'list_cities',
        }, function(_dataCity) {
        	var select = $('#city');
        	select.empty();
            select.append("<option value=''>--</option>");
	 		$.each(_dataCity,function(key, value) {
                select.append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    }
</script>
@if($_REQUEST['company_id']) 
	<script> listContacts("{{$_REQUEST['company_id'] }}") </script>
@endif
@endpush
@include('override.candidates._scripts')