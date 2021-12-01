@extends('crudbooster::admin_template')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />

<script>
	window.initers = [];
</script>

@include('override.candidates._styles')
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
				<form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" novalidate="" action='{{CRUDBooster::mainpath('edit-save/'.$candidate->id)}}'>
					<!-- ** -->
					<div class="panel-group" id="accordion">
						<div class='parse_msg'></div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">PERSONAL DETAILS</a>
								</h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="form-group">
										  <div class="col-md-2 title">
						                	Resume
						                </div>
						                  <div class="col-md-7 resume_height">
						                @if($candidate->resume_url)
						                	 <div class="col-md-2">
					                		<div class="candidate-edit-resume-container">
						                		<a href="/{{$candidate->resume_url}}" target="_blank">
						                			<i class="fa fa-file icon-resume" style="padding:0px!important;"></i>
						                		</a>
						                	</div></div>
										 <div class="col-md-10">
						                <input type="file" name="resume_url" id="resume_url" class="form-control" value="{{$candidate->resume_url}}" @if($candidate->resume_url) style="width:100%;" @endif>	

						                </div>
						                @else
						                <input type="file" name="resume_url" id="resume_url" class="form-control" value=" ">	
						                @endif 
						                  </div>
										<div class="col-md-2">
											<input type="button" id="parse" name="parse_resume" value="Parse" class="btn btn-success">
										</div>
						            </div>
										<div class="form-group">
										<div class="col-md-2">
											First Name
											<span class='text-danger' title='This field is required'>*</span>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" name="first_name" id="first_name" required="" value="{{$candidate->first_name}}"></div>
											<div class="col-md-2">
												Last Name
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3"><input type="text" class="form-control" name="last_name" id="last_name" value="{{$candidate->last_name}}" required ></div>
										</div>
										<div class="form-group">
											<div class="col-md-2 title">
												Date of Birth
											</div>
											<div class="col-md-3">
												<input type='date' class="form-control" name="birth_date" value="{{$candidate->birth_date}}" id="birth_date"/>
											</div>
											<div class="col-md-2">Gender<span class='text-danger' title='This field is required'>*</span></div>
											<div class="col-md-3">
												<select name="gender" id="gender" class="form-control">
													<option value="" >--</option>
													<option value="Male" {{ ($candidate->gender == 'Male')? 'selected':''}} >Male</option>
													<option value="Female" {{ ($candidate->gender == 'Female')? 'selected':''}} >Female</option>
													<option value="Others" {{ ($candidate->gender == 'Others')? 'selected':''}} >Others</option>
												</select>
											</div>
										</div>

										<div class="form-group">
										<div class="col-md-2">Relationship Status</div>
											<div class="col-md-3">
												<select name="relationship_status" id="relationship_status" class="form-control">
													<option value="" >--</option>
													<option value="Married" {{ ($candidate->relationship_status == 'Married')? 'selected':''}} >Married</option>
													<option value="Unmarried" {{ ($candidate->relationship_status == 'Unmarried')? 'selected':''}} >Unmarried</option>
												
												</select>
											</div>
											<div class="col-md-2">
												Primary Email
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="primary_email" id="primary_email" required="" value="{{$candidate->primary_email}}" >
											<div class="text-danger"><p class="msg"></p></div>
											</div>
											
										</div>

										<div class="form-group">
										<div class="col-md-2">Secondary Email</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="secondary_email" id="secondary_email" value="{{$candidate->secondary_email}}">
											</div>
											<div class="col-md-2">
												Primary Phone
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="primary_phone" id="primary_phone" required="" value="{{$candidate->primary_phone}}" >
												<div class="text-danger"><p class="phone_msg"></p></div>
											</div>
											
										</div>

										<div class="form-group">
										<div class="col-md-2">Secondary Phone</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="secondary_phone" id="secondary_phone" value="{{$candidate->secondary_phone}}">
											</div>
											<div class="col-md-2">
												Address
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" name="address" id="address" required value="{{$candidate->address}}" >
											</div>
											
										</div>

										<div class="form-group">
										<div class="col-md-2 title">
												Country
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<select name="india_id" id="india_id" class="form-control" style="display:none!important;">
												@foreach($countries as  $country)
													@if($candidate->country_id=='')
													<option value="{{ $country->id }}" {{('India'== $country->name) ? 'selected' : '' }}>{{ $country->name }}</option>
													@endif
													<option value="{{ $country->id }}" {{($candidate->country_id == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
													@endforeach
											</select>
												<select name="country_id" id="country_id" class="form-control multi-select-select2" required onchange="listStates(this.value)">
													@foreach($countries as  $country)
													@if($candidate->country_id=='')
													<option value="{{ $country->id }}" {{('India'== $country->name) ? 'selected' : '' }}>{{ $country->name }}</option>
													@endif
													<option value="{{ $country->id }}" {{($candidate->country_id == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
													
													@endforeach
												</select>
											</div>
											<div class="col-md-2 title">
												State
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<select name="state_id" id="state_id" class="form-control multi-select-select2" required onchange="listCities(this.value)">
													@foreach($states as  $state)
													<option value="{{ $state->id }}" {{($candidate->state_id == $state->id) ? 'selected' : '' }}>{{ $state->name }}</option>
													@endforeach
												</select>
											</div>
											
										</div>
										<div class="form-group">
										<div class="col-md-2 title">
												City
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<select name="city_id" id="city_id" class="form-control multi-select-select2" required>
													<option value="">--</option>
													@foreach($cities as  $city)
													<option value="{{ $city->id }}" {{($candidate->city_id == $city->id) ? 'selected' : '' }} >{{ $city->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-2 title">Postal Code</div>
											<div class="col-md-3">
												<select name="postal_code" id="postal_code" class="form-control multi-select-select2 postal_code">
													<option value="">--</option>
													@foreach($postal_codes as  $postal_code)
													<option value="{{ $postal_code->id }}"{{( 
														$candidate->postal_code == $postal_code->id) ? 'selected' : '' }} >{{ $postal_code->name }}
													</option>
													@endforeach
												</select>
											</div>
											
										</div>

										<div class="form-group">
										<div class="col-md-2 title">
												Current City
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<select name="current_city" id="current_city" class="form-control multi-select-select2" required>
													<option value="">--</option>
													@foreach($allCities as  $allCity)
													<option value="{{ $allCity->id }}" {{($candidate->current_city == $allCity->id) ? 'selected' : '' }}>{{ $allCity->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="col-md-2 title">Religion</div>
											<div class="col-md-3">
												<input type="text" name="religion" id="religion" class="form-control" value="{{$candidate->religion}}" >
											</div>
											
										</div>

									<div class="form-group">
									<div class="col-md-2 title">Date Available</div>
										<div class="col-md-3">
											<input type="date" name="date_available" id="date_available" class="form-control" value="{{ ($candidate->date_available=='1970-01-01'||$candidate->date_available==null) ? ' ' : date('Y-m-d',strtotime( $candidate->date_available)) }}">

										</div>
										<div class="col-md-2 title">Website/Professional Profile </div>
										<div class="col-md-3">
											<input type="text" name="website" id="website" class="form-control" value="{{$candidate->web_site}}">
										</div>
										
									</div>

										<div class="form-group">
										<div class="col-md-2 title">Source</div>
											<div class="col-md-3">
												<select name="source" id="source" class="form-control">
													<option value="">--</option>
													@foreach($sources as  $source)
													<option value="{{ $source->id }}" {{($candidate->source == $source->id) ? 'selected' : '' }}>{{ $source->name }}</option>
													@endforeach
												</select>
											</div>
											
											<div class="col-md-2 title">
												Creator
												<span class='text-danger' title='This field is required'>*</span>
											</div>
											<div class="col-md-3">
												<select name="creator_id" id="creator_id" required="" class="form-control">
													<option value="">--</option>
													@foreach($creators as  $creator)
													<option value="{{ $creator->id }}" {{( $creator->id == $candidate->creator_id) ? 'selected': ''}}>{{ $creator->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>
					    	</div>
					    <div class="panel panel-default">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">PROFESSIONAL</a>
					        </h4>
					      </div>
					      <div id="collapse2" class="panel-collapse collapse">
					        <div class="panel-body">
					    	    <div class="form-group">
			                <div class="col-md-2 title">
			                	Head Line
			                </div>
			                <div class="col-md-8">
			                    <input type="text" name="head_line" id="head_line" class="form-control" value="{{$candidate->head_line}}">
			                </div>
			                
			            </div>
			           <!--  <div class="form-group">
			               <div class="col-md-2 title">
			               	Experience in years
			               	<span class='text-danger' title='This field is required'>*</span>
			               </div>
			               <div class="col-md-3">
			                   <input type="text" name="experience_years" onkeypress="return checkIsNumber(event)" id="experience_years" class="form-control" required="" value="{{$candidate->experience_years}}">
			               </div>
			               <div class="col-md-2 title">
			               	Experience in months
			               	<span class='text-danger' title='This field is required'>*</span>
			               </div>
			               <div class="col-md-3">
			                   <input type="text" name="experience_months" id="experience_months" onkeypress="return checkIsNumber(event)" class="form-control" required="" value="{{$candidate->experience_months}}">
			               </div>
			           </div>
			            -->
			            <div class="form-group">
							<div class="col-md-2 title">
								Total Experience
							<span class='text-danger' title='This field is required'>*</span>
							</div>
							<input type="hidden" name="experience_years" id="experience_years" class="form-control" value="{{$candidate->experience_years}}">
							<input type="hidden" name="experience_months" id="experience_months" class="form-control" value="{{$candidate->experience_months}}">
							<input type="hidden"  id="experience_years1" class="form-control" value="{{$candidate->experience_years}}">
							<input type="hidden" id="experience_months1" class="form-control" value="{{$candidate->experience_months}}">
							<div class="col-md-8">
							   <div class="dropdown">
							    <button class="btn btn-experience form-control" id="experience" onclick="getExpVal()" type="button" data-toggle="dropdown" value="{{$candidate->experience_years}} years {{$candidate->experience_months}} months">{{$candidate->experience_years}} years {{$candidate->experience_months}} months
							  
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
								  <label>
								  	<input type="radio" value="{{$x}}"  {{($candidate->experience_years==$x)?'checked="checked"':''}} name="year"   onclick="getExpVal()">{{$x}}
								  </label>
								</div></li>
								    @endfor
								     </div>
								      <div class="col-md-6 btn-scroll">
								      <li><b><h4>Month</h4></b></li>
								       
								@for($x = 0; $x <= 11; $x++) 
								      <li>
								<div class="radio">
								  <label><input type="radio" value="{{$x}}" {{($candidate->experience_months==$x)?'checked="checked"':''}} name="month" onclick="getExpVal()">{{$x}}</label>
								</div></li>
								   @endfor
								</div>
							  <p class="pull-right">
							        <a class="btn btn-danger btn-sm" id="experience_remove">
							          <span class="glyphicon glyphicon-remove"></span> Clear Selection
							        </a>
							      </p>

							    </ul>
									 </div></div>
						</div>
			            <div class="form-group">
			                <div class="col-md-2 title">Current CTC
			                	<span class='text-danger' title='This field is required'>*</span>
			                </div>
			                <div class="col-md-3">
			                    <input type="number" name="current_ctc" id="current_ctc" placeholder="in lakhs" class="form-control" step="0.01"value="{{$candidate->current_ctc}}" required="" min="0">
			                </div>
			                <div class="col-md-2 title">Expected CTC
			                	<span class='text-danger' title='This field is required'>*</span>
			                </div>
			                <div class="col-md-3">
			                    <input type="number" name="expected_ctc" id="expected_ctc" step="0.01" placeholder="in lakhs" class="form-control" value="{{$candidate->expected_ctc}}" required="" min="0">
			                </div>
			            </div>

			            <div class="form-group">
			                <div class="col-md-2 title">First Job Start Date</div>
			                <div class="col-md-3">
			                    <input type="date" name="first_job_start_date" id="first_job_start_date" class="form-control" value="{{$candidate->first_job_start_date}}">
			                </div>
			                <div class="col-md-1">
		                    	Can Relocate 
		                    	&nbsp; <input type ="checkbox" name="can_relocate" value="1" {{ ( $candidate->can_relocate == 1 )? 'checked' : '' }}>
			                </div>
			                <div class="col-md-2 title">Preferred City</div>
			                <div class="col-md-2">
			                    <select name="preferred_city" id="preferred_city" class="form-control">
									<option value="">--</option>
									@foreach($allCities as  $preferredCity)
									<option value="{{ $preferredCity->id }}" {{($candidate->preferred_city == $preferredCity->id)? 'selected' :'' }}>{{ $preferredCity->name }}</option>
									@endforeach
								</select>
			                </div>
			            </div>

			            <div class="form-group">
			                <div class="col-md-2 title">Current/Previous Employer
							<span class='text-danger required_field' title='This field is required' id="required_field" style="display:none">*</span>
							</div>

			                <div class="col-md-3">
			                    <input type="text" name="current_employer" id="current_employer" class="form-control" value="{{$candidate->current_employer}}">
			                </div>
			                <div class="col-md-2 title">Current/Previous Designation
							<span class='text-danger required_field' title='This field is required' id="required_field" style="display:none">*</span>


							</div>
			                <div class="col-md-3">
			                    <input type="text" name="current_designation" id="current_designation" class="form-control" value="{{$candidate->current_designation}}">
			                </div>
			            </div>
			            <div class="form-group">
							<div class="col-md-2 title">Notice Period
							<span class='text-danger required_field' title='This field is required' id="required_field" style="display:none">*</span>
							</div>
							<div class="col-md-3">
								<input type="number" name="notice_period" id="notice_period" class="form-control"value="{{$candidate->notice_period}}" min="0">
							</div>
						</div>
					    	</div>
					      </div>
					    </div>
					    <div class="panel panel-default">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">PROFESSIONAL SKILLS</a>
					        </h4>
					      </div>
					      <div id="collapse3" class="panel-collapse collapse">
					        <div class="panel-body">
					        	<div class="form-group">
			                <div class="col-md-2 title">General Skills
			                <span class='text-danger' title='This field is required'>*</span></div>
			                <div class="col-md-3">
			                	<select name="general_skill_id[]"  multiple="multiple" id="general_skill_id" class="form-control multi-select-select2" required="">
			                		@foreach($general_skills as  $general_skill)
										<option value="{{ $general_skill->id }}" {{ (in_array($general_skill->id, $candidate->generalSkillIds) )? 'selected':''}}>{{ $general_skill->name }}</option>
									@endforeach
								</select>
			                </div>
			                <div class="col-md-2 title">Industry
			                <span class='text-danger' title='This field is required'>*</span></div>
			                <div class="col-md-3">
			                    <select name="industry_id[]" id="industry_id" multiple="multiple"  class="form-control multi-select-select2" required="">
			                    	@foreach($industries as  $industry)
										<option value="{{ $industry->id }}" {{ (in_array($industry->id, $candidate->industryIds))? 'selected':''}} >{{ $industry->name }}</option>
									@endforeach
								</select>
			                </div>
			            </div>

						<div class="form-group">
			                <div class="col-md-2 title">Functional Area
			                <span class='text-danger' title='This field is required'>*</span></div>
			                <div class="col-md-3">
			                    <select name="functional_area_id[]" multiple="multiple" id="functional_area_id" class="form-control multi-select-select2" onchange="listFunctionalAreaRolesAndSkills(this.value)" required="">
			                    	@foreach($functional_areas as  $functional_area)
									<option value="{{ $functional_area->id }}" {{ (in_array($functional_area->id, $candidate->functional_areaIds)) ? 'selected':''}}
										>{{ $functional_area->name }}</option>
									@endforeach
								</select>
			                </div>
			                <div class="col-md-2 title">Functional Roles
			                <span class='text-danger' title='This field is required'>*</span></div>
			                <div class="col-md-3">
			                    <select name="functional_area_role_id[]" id="functional_area_role_id" multiple="multiple"  class="form-control multi-select-select2" required="">
			                    	@foreach($functional_area_roles as $functional_area_role)
			                    		<option value="{{$functional_area_role->id}}" {{ (in_array($functional_area_role->id, $candidate->functional_area_roleIds)) ? 'selected':''}}
			                    			>{{$functional_area_role->name}}</option>
									@endforeach
								</select>
			                </div>
			            </div>

			            <div class="form-group">
			            	<div class="col-md-2 title">Functional Skills
			            	<span class='text-danger' title='This field is required'>*</span></div>
			                <div class="col-md-3">
			                    <select name="functional_area_skill_id[]" id="functional_area_skill_id" multiple="multiple"  class="form-control multi-select-select2" required="">
			                    	@foreach($functional_area_skills as $functional_area_skill)
			                    		<option value="{{$functional_area_skill->id}}" {{ (in_array($functional_area_skill->id, $candidate->functional_area_skillIds)) ? 'selected':''}}>{{$functional_area_skill->name}}</option>
									@endforeach
								</select>
			                </div>
			            </div>
					        </div>
					      </div>
					    </div>
					    <div class="panel panel-default">
					      <div class="panel-heading">
					        <h4 class="panel-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">EDUCATIONAL DETAILS</a>
					        </h4>
					      </div>
					      <div id="collapse4" class="panel-collapse collapse">
					        <div class="panel-body">
					        	<div class="form-group">
				        	<div class="col-md-2 title">
								Highest Qualification
								<span class='text-danger' title='This field is required'>*</span>
							</div>
							<div class="col-md-3">
								<select name="highest_qualification" id="highest_qualification" class="form-control" required>
									<option value="">--</option>
									@foreach($allQualifications as  $qualification)
									<option value="{{ $qualification->id }}" {{($candidate->highest_qualification == $qualification->id ) ? 'selected' : '' }}>{{ $qualification->qualification }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-xs btn-primary pull-right btn-clone-qual-div" title="Add">
				                    		<i class="fa fa-plus"></i>
				                </button>
				            </div>
						</div>
				        @if(count($candidate->qualifications) > 0)
							@foreach($candidate->qualifications as $candidate_qualification)
						        <div class="form-group candidate-qual-div-class" id = "candidate-qual-div">
					                <div class="col-md-2">
					                	<select name="qualification_level_id[]" class="form-control qualification_level_id" required="">
					                		<!-- onchange="listQualifications(this.value)" -->
											<option value=""> Select Qualification Level </option>
											@foreach($qualification_levels as $qualification_level)
												<option value="{{$qualification_level->id}}" 
													{{ ($qualification_level->id == $candidate_qualification->qualification_level_id) ? 'selected':''}}>
													{{$qualification_level->qual_level}}
												</option>
											@endforeach
										</select>
					                </div>
					                <div class="col-md-2">
					                    <select name="qualification_id[]" class="form-control qualification_id" required="">
											<option value=""> Qualification </option>
											@foreach($qualifications as $qualification)
			                    				<option value="{{$qualification->id}}"
			                    					{{ ($qualification->id == $candidate_qualification->qualification_id) ? 'selected':''}}>
			                    					{{$qualification->qualification}}
			                    				</option>
											@endforeach
										</select>
					                </div>
					                <div class="col-md-2">
					                    <span class="">
					                    	Is Completed 
					                    	&nbsp; <input type ="checkbox" name="is_completed[]" value="1" id="is_completed" {{ ( $candidate_qualification->is_completed == 1 )? 'checked' : '' }} class="is-completed-check">
					                    	<input type="hidden" value="{{$candidate_qualification->is_completed}}" name="is-completed-hidden[]" class="is-completed-hidden">
					                	</span>
					                </div>
					                <div class="col-md-2">
					                    <input type="text" name="completed_year[]" class="form-control completed_year" placeholder="Year" value="{{$candidate_qualification->completed_year}}">
					                </div>
					                <div class="col-md-2">
					                    <input type="text" name="score[]" class="form-control score" placeholder="Score" value="{{$candidate_qualification->score}}">
					                </div>
					            </div>
				            @endforeach
				        @else
				        <div class="form-group candidate-qual-div-class" id = "candidate-qual-div">
				        	<div class="col-md-2">
				        		<select name="qualification_level_id[]" class="form-control qualification_level_id" required="">
				        			<!-- onchange="listQualifications(this.value)" -->
				        			<option value=""> Select Qualification Level </option>
				        			@foreach($qualification_levels as $qualification_level)
				        			<option value="{{$qualification_level->id}}">
				        				{{$qualification_level->qual_level}}
				        			</option>
				        			@endforeach
				        		</select>
				        	</div>
				        	<div class="col-md-2">
				        		<select name="qualification_id[]" class="form-control qualification_id" required="">
				        			<option value=""> Qualification </option>
				        		</select>
				        	</div>
				        	<div class="col-md-2">
				        		<span class="">
				        			Is Completed 
				        			&nbsp; <input type ="checkbox" name="is_completed[]" value="1" class="is_completed is-completed-check">
				        			<input type="hidden" value="0" name="is-completed-hidden[]" class="is-completed-hidden">
				        		</span>
				        	</div>
				        	<div class="col-md-2">
				        		<input type="text" name="completed_year[]" class="form-control completed_year" placeholder="Year" required="">
				        	</div>
				        	<div class="col-md-2">
				        		<input type="text" name="score[]" class="form-control score" placeholder="Score" required="">
				        	</div>
				        </div>
				        @endif
					        </div>
					      </div>
					    </div>
					      	<div class="panel panel-default">
						      <div class="panel-heading">
						        <h4 class="panel-title">
						          <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">UPLOADS</a>
						        </h4>
						      </div>
						      <div id="collapse5" class="panel-collapse collapse">
						        <div class="panel-body">
						        	<div class="form-group">
						                <div class="col-md-2 title">Photo</div>
						                <div class="col-md-3 photo">
										@if($candidate->photo_url)
											<img src="/{{$candidate->photo_url}}" style="max-width: 100%; margin: 5px;">
										@endif
											<input type="file"  name="photo_url" id="photo_url" class="form-control" value="{{$candidate->photo_url}}" @if($candidate->photo_url) style="width:100%;" @endif>
						                </div>
						              
						            </div>
						            <input type="hidden" name="candidate_id" value="{{$candidate->id}}" id="candidate_id">
						        </div>
						      </div>
					    	</div>
					    	<div class="form-group">
					    		<div class="panel-body">
									<div class="col-md-2">
										<input type="button" id="submit-candidate-personal" name="submit-candidate-personal" value="Save" class="btn btn-success">
									</div>
								</div>
							</div>
					  	</div> 
					<!-- ** -->

					<!-- <div class="col-md-12">
						<hr>
				            <div class="form-group">
				                <div class="col-md-8 title"> <u> <b>  </b> </u> </div>
				            </div>
				        <hr>
						<hr>
				            <div class="form-group">
				                <div class="col-md-8 title"> <u> <b>  </b> </u> </div>
				            </div>
				        <hr>

			            

			            <hr>
				            <div class="form-group">
				                <div class="col-md-8 title"> <u> <b>  </b> </u> </div>
				            </div>
				        <hr>

			            

			            <hr>
				            <div class="form-group">
				                <div class="col-md-8 title"> <u> <b>  </b> </u> 
				                	
				                </div>
				            </div>
				        <hr>
					</div> -->
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
	  var year=$('input[name=year]:checked').val();
    var month=$('input[name=month]:checked').val();


	if((year>0) || (month>0)){
		$('.required_field').show();
	}
	/*
	$(document).ready(function() {
    	$("#birth_date").datepicker();
  	});*/
  		var parseCity = '';
    	var parseCityText = '';
    $(document).ready(function() {
    	$('.multi-select-select2').select2();
    	var indian_country_id= $('#country_id').val();
		$( "#experience_remove" ).click(function() {
			var ayears= $('#experience_years1').val();
    		var amonth= $('#experience_months1').val();
    		var buttonValue=ayears+' years'+' '+ amonth+' months';
   		$('#experience').html(buttonValue);
   		$('#experience').val(buttonValue);
   		$('#experience_years').val("");
   		$('#experience_months').val("");
   		$('#experience_years').val(ayears);
   		$('#experience_months').val(amonth);
        $("input[name=year][value=" + ayears + "]").prop('checked', true);
        $("input[name=month][value=" + amonth + "]").prop('checked', true);
               
		});

    	$(document).on("change","#resume_url",function () {
		    $('.msg').html(' ');
		    $('.phone_msg').html(' ');  
		    $("#primary_email").val('');
		   	$("#birth_date").val('');
		   	$("#primary_phone").val('');
		  	$("#secondary_phone").val('');
		  	$("#country_id").val(indian_country_id).trigger('change.select2');
		  	$('#postal_code,#state_id,#city_id').val('').trigger('change');
    	});
    $(document).on("click","#parse",function () {
    		var data = new FormData();
		//Form data
			var form_data = $('#form').serializeArray();
			$.each(form_data, function (key, input) {
				data.append(input.name, input.value);
			});
		//File data
		var file_data = $('input[name="resume_url"]')[0].files;
		for (var i = 0; i < file_data.length; i++) {
		    data.append("resume_url", file_data[i]);
		}
		//Custom data
		data.append('key', 'value');
		var resume_value=$('input[name="resume_url"]').val();
			if(resume_value!='')
		{
				$.ajax({
		    type: "POST",
		    url: "/admin/resume-parsing",
		    contentType: false,
		    processData: false,
		   data: data,
		   success: function(response){
		   if(response)
		   {
		   	var result=JSON.parse(response);
		   	var content=result['content'];
		   	if(content.length==0 && resume_value!=''){
			var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Cannot able to parse the resume!</strong></div>';
		    $('.parse_msg').html(html); 
			}
			else{
			$('.parse_msg').html(' '); 	
			}
		   	var birthdate=result['dob']['dob'];
		   	var email=result['email'];
		   		$("#primary_email").val(email);
							if(result['email_status']=='false'){
								$('#primary_email').removeClass('validate-error');
								$('.msg').html(' '); 
							} else {
								var response=JSON.parse(result['email_status']);
								var html = '<br/> <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Already Exists!<br/><a href="/admin/candidates/detail/'+response.result1+'" rel="View Detais" target="_blank">'+response.fullname+'</a></strong></div>';
		    					$('.msg').html(html); 
								$("#primary_email").addClass('validate-error').focus();
				  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
				  				$('#collapse1').parent().find('.panel-heading a').click();
				  				}
							}
				
							$("#birth_date").val(birthdate);
							if(result['zip']!='')
							{
								var country_id;
								$("#country_id option").each(function () {
									if ($(this).html() == $.trim(result['country'])) {
										country_id=$(this).attr('value');
										$(this).attr("selected", "selected");
										return ;
									}
								});
								var state_id;
								$("#state_id option").each(function () {
									if ($(this).html() == $.trim(result['state'])) {
										state_id=$(this).attr('value');
										$(this).attr("selected", "selected");
										return ;
									}
								});
								parseCityText = result['city'];
								$("#state_id").val(state_id).trigger('change');

								var postal_code;
								$("#postal_code option").each(function () {
									console.log($(this).html());
									if ($.trim($(this).html()) == $.trim(result['zip'])) {
										postal_code=$(this).attr('value');
										$(this).attr("selected", "selected");
										return;
									}
								});
								$("#postal_code").val(postal_code).trigger('change');
							}
							else{

							}

							var mobiles=result['mobile']['mobile'];
							for (i=0;i<mobiles.length;i++)
							{
								$("#primary_phone").val(mobiles[0]);
								if(result['phone_status']=='false'){
								$('#primary_phone').removeClass('validate-error');
								$('.phone_msg').html(' '); 
							} else {
								var response=JSON.parse(result['phone_status']);
								var html = '<br/> <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Already Exists!<br/><a href="/admin/candidates/detail/'+response.result1+'" rel="View Detais" target="_blank">'+response.fullname+'</a></strong></div>';
		    					$('.phone_msg').html(html); 
								$("#primary_phone").addClass('validate-error').focus();
				  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
				  				$('#collapse1').parent().find('.panel-heading a').click();
				  				}
							}
								$("#secondary_phone").val(mobiles[1]);
							}	


						}
						else{
							var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Cannot able to parse the resume!</strong></div>';
							$('.parse_msg').html(html);	
						}
					}
				});

			}
			else{

				var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Please upload resume to parse!</strong></div>';
				$('.parse_msg').html(html);	
			}		   	
});

		$(document).on('click', '.dropdown-menu', function (e) {
  		  e.stopPropagation();
	   });
    
	    $(document).on("change",".qualification_level_id",function () {
	    	var select = $(this).parent().next('div').find('.qualification_id');
	        select.empty();
	        select.append("<option value=''>--</option>");
	        $.get('{{CRUDBooster::mainpath()}}/add', {
	            qualification_level_id: $(this).val(),
	            current_action: 'list_qualifications',
	        }, function(_dataQualifications) {
		 		$.each(_dataQualifications,function(key, value) {
	                select.append('<option value=' + value.id + '>' + value.qualification + '</option>');
	            });
	        });    	
	    });
	    
		$(document).on("click",".btn-clone-qual-div",function () {
			candidateQualDiv =  $('#candidate-qual-div').clone()
                          		.find("input, select").val("").attr("checked",false)
                          		.end();
            candidateQualDiv.find(".is_completed").val('1');
            candidateQualDiv.find(".is-completed-hidden").val('0');
             candidateQualDiv.append("<button type='button' class='remove-qual-div btn btn-xs btn-danger' title='Remove'><i class='fa fa-trash'></i></button>");
			$('.candidate-qual-div-class').last().append().after(candidateQualDiv);
  		});

  		$(document).on("click",".remove-qual-div",function(){
  			$(this).parent().remove();
  		});

  		// $('#primary_email').change(function(){
		  //   var email = $.trim($(this).val());
		  //   return checkEmailNotExists(email);
  		// });
		
		// $('#submit-candidate-personal').click(function(){
		//     var email = $("#primary_email").val();
		//     if(checkEmailNotExists(email)){
		//     	$('form').submit();
		//     }
		//     else{
		//     	return false;
		//     }
  // 		});
 	 $("#primary_email").on("blur", function() {
 	 	$("#form").find('.validate-error').removeClass('validate-error');
 	 	if(!(validateEmail($.trim($("#primary_email").val())))||($.trim($("#primary_email").val())=='')) {
 	 	$('.msg').html(' ');
 	 	}
   		if($.trim($("#primary_email").val())!='') {
   			if((validateEmail($("#primary_email").val()))) {
   				var email = $.trim($("#primary_email").val());
  				$.get('/candidates/CheckMailExists', {
  					id : $('#candidate_id').val(),
			    	email: email
			    }, function(_result) {
					var response=JSON.parse(_result);
					if(_result== 'false'){
						$('.msg').html(' '); 
					} else {
						var html = '<br/> <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Already Exists!<br/><a href="/admin/candidates/detail/'+response.result1+'" rel="View Detais" target="_blank">'+response.fullname+'</a></strong></div>';
    					$('.msg').html(html);
						$("#primary_email").addClass('validate-error').focus();
		  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
		  					$('#collapse1').parent().find('.panel-heading a').click();

		  				}
		  				return false;
					}
				});
  				
  			}
  			}
	});
 	  $("#primary_phone").on("blur", function() {
 	 	$("#primary_phone").removeClass('validate-error');
 	 	if(!(validatePhone($.trim($("#primary_phone").val())))||($.trim($("#primary_phone").val())=='')) {
 	 	$('.phone_msg').html(' ');
 	 	}
   		if($.trim($("#primary_phone").val())!='') {
   			if((validatePhone($("#primary_phone").val()))) {
   				var phone = $.trim($("#primary_phone").val());
  				$.get('/candidates/CheckPhoneExists', {
  					id : $('#candidate_id').val(),
			    	phone: phone
			    }, function(_result) {
			    	var response=JSON.parse(_result);
			    	console.log(response);
					if(_result== 'false'){
						$('#primary_phone').removeClass('validate-error');
						$('.phone_msg').html(' '); 
					} else {
						var html = '<br/> <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Phone Number Already Exists!<br/><a href="/admin/candidates/detail/'+response.result1+'" rel="View Detais" target="_blank">'+response.fullname+'</a></strong></div>';
    					$('.phone_msg').html(html);
						$("#primary_phone").addClass('validate-error').focus();
		  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
		  					$('#collapse1').parent().find('.panel-heading a').click();

		  				}
		  				return false;
					}
				});
  				
  			}
  			}
	});
 	 jQuery.fn.preventDoubleSubmission = function() {

	    var last_clicked, time_since_clicked;

	    $(this).bind('submit', function(event){

	    if(last_clicked) 
	      time_since_clicked = event.timeStamp - last_clicked;

	    last_clicked = event.timeStamp;

	    if(time_since_clicked < 2000)
	      return false;

	     return true;
	      });   
	      };
  		$('#submit-candidate-personal').click(function() {
  			$("#form").find('.validate-error').removeClass('validate-error');
  			$('#form').preventDoubleSubmission();
  			if($.trim($("#first_name").val()) == ''){
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				$("#form").find("#first_name").addClass('validate-error').focus();
  				return false;
  			}
  			if(!$.trim($("#last_name").val())){
  				$("#form").find("#last_name").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			/*if(!$.trim($("#birth_date").val())){
  				$("#form").find("#birth_date").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}*/
  			if(!$.trim($("#gender").val())){
  				$("#form").find("#gender").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!(validateEmail($("#primary_email").val()))) {
  				$('.msg').html(' ');
  				$("#form").find("#primary_email").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  				var email = $.trim($("#primary_email").val());
  				$.get('/candidates/CheckMailExists', {
  					id : $('#candidate_id').val(),
			    	email: email
			    }, function(_result) {
					var response=JSON.parse(_result);
			        if(_result== 'false'){
				$('#primary_email').removeClass('validate-error');
				$('.msg').html(' ');
			if( $("#secondary_email").val() && !validateEmail($("#secondary_email").val()) ) {
  				$("#form").find("#secondary_email").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!validatePhone($.trim($("#primary_phone").val()))) {
  				$('.phone_msg').html(' ');
  				$('.msg').html(' ');
  				if(!validatePhone($("#primary_phone").val())) {
  					$("#form").find("#primary_phone").addClass('validate-error').focus();
  					if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  						$('#collapse1').parent().find('.panel-heading a').click();
  					}
  				}
  				return false;
  			}

   				var phone = $.trim($("#primary_phone").val());
  				$.get('/candidates/CheckPhoneExists', {
  					id : $('#candidate_id').val(),
			    	phone: phone
			    }, function(_result) {
			    	var response=JSON.parse(_result);
			    	console.log(response);
					if(_result== 'false'){
						$('#primary_phone').removeClass('validate-error');
						$('.phone_msg').html(' ');
						$('.msg').html(' '); 
	if(($("#secondary_phone").val()) && !validatePhone($("#secondary_phone").val())) {
  				$("#form").find("#secondary_phone").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#address").val())){
  				$("#form").find("#address").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#country_id").val())){
  				$("#country_id").next(".select2").addClass('validate-error').trigger('focus.select2');
  				/*$(this).find("#country_id").addClass('validate-error').focus();*/
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#state_id").val())){
  				$("#state_id").next(".select2").addClass('validate-error').trigger('focus.select2');
  				/*$(this).find("#state_id").addClass('validate-error').focus();*/
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#city_id").val())){
  				$("#city_id").next(".select2").addClass('validate-error').trigger('focus.select2');
  				/*$(this).find("#city_id").addClass('validate-error').focus();*/
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#current_city").val())){
  				/*$(this).find("#current_city").addClass('validate-error').focus();*/
  			$("#current_city").next(".select2").addClass('validate-error').trigger('focus.select2');
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#creator_id").val())){
  				$("#form").find("#creator_id").addClass('validate-error').focus();
  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
  					$('#collapse1').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			/*if(!$.trim($("#experience_years").val())){
  				$(this).find("#experience_years").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if((!$.trim($("#experience_months").val()) || $("#experience_months").val() > 11) ) {
  				$(this).find("#experience_months").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}*/
  			if(!$.trim($("#experience").val())) {
  				$("#form").find("#experience").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}

			  var year=$('input[name=year]:checked').val();
    var month=$('input[name=month]:checked').val();


	if((year>0) || (month>0)){
		$('.required_field').show();
  
		if(!$.trim($("#current_employer").val())) {
		$("#form").find("#current_employer").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
		}
		if(!$.trim($("#current_designation").val())) {
		$("#form").find("#current_designation").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
		}
		if(!$.trim($("#notice_period").val())) {
		$("#form").find("#notice_period").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
		}
	//$('#current_employer').prop('required',true).addClass('validate-error').focus();
	//$("#form").find("#current_employer").attr('required', 'required');
	//$("#form").find("#current_designation").addClass('validate-error').focus();
	//$("#form").find("#notice_period").addClass('validate-error').focus();
   }




  			if(!$.trim($("#current_ctc").val())){
  				$("#form").find("#current_ctc").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#expected_ctc").val())){
  				$("#form").find("#expected_ctc").addClass('validate-error').focus();
  				if($('#collapse2').attr("class") == 'panel-collapse collapse'){
  					$('#collapse2').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#general_skill_id").val())){
  				$("#general_skill_id").next(".select2").addClass('validate-error').focus();
  				if($('#collapse3').attr("class") == 'panel-collapse collapse'){
  					$('#collapse3').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#industry_id").val())){
  				$("#industry_id").next(".select2").addClass('validate-error').focus();
  				if($('#collapse3').attr("class") == 'panel-collapse collapse'){
  					$('#collapse3').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#functional_area_id").val())){
  				$("#functional_area_id").next(".select2").addClass('validate-error').focus();
  				if($('#collapse3').attr("class") == 'panel-collapse collapse'){
  					$('#collapse3').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#functional_area_role_id").val())){
  				$("#functional_area_role_id").next(".select2").addClass('validate-error').focus();
  				if($('#collapse3').attr("class") == 'panel-collapse collapse'){
  					$('#collapse3').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#functional_area_skill_id").val())){
  				$("#functional_area_skill_id").next(".select2").addClass('validate-error').focus();
  				if($('#collapse3').attr("class") == 'panel-collapse collapse'){
  					$('#collapse3').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			if(!$.trim($("#highest_qualification").val())){
  				$('#form').find("#highest_qualification").addClass('validate-error').focus();
  				if($('#collapse4').attr("class") == 'panel-collapse collapse'){
  					$('#collapse4').parent().find('.panel-heading a').click();
  				}
  				return false;
  			}
  			var validator = true;

  			$(".qualification_level_id").each(function() {
  				if(!$(this).val()){
  					$(this).addClass('validate-error').focus();
  					validator = false;
  					return false;
  				}
  			});

  			$(".qualification_id").each(function() {
  				if(!$(this).val()){
  					$(this).addClass('validate-error').focus();
  					validator = false;
  					return false;
  				}
  			});

  			$(".completed_year").each(function() {
  				if(!$(this).val()){
  					$(this).addClass('validate-error').focus();
  					validator = false;
  					return false;
  				}
  			});

  			$(".score").each(function() {
  				if(!$(this).val()){
  					$(this).addClass('validate-error').focus();
  					validator = false;
  					return false;
  				}
  			});

			// if(!$("#photo_url").val()){
			// 	$(this).find("#photo_url").addClass('validate-error').focus();
			// 	return false;
			// }
			if($("#resume_url").val()) {
				myfile= $('#resume_url' ).val();
				var ext = myfile.split('.').pop();
				if(!(ext=="docx" || ext=="pdf" || ext=="doc" || ext=="rtf")){
					alert("Please Upload Docx, Doc, rtf Or Pdf");
					$("#form").find("#resume_url").addClass('validate-error').focus();
					if($('#collapse5').attr("class") == 'panel-collapse collapse'){
  						$('#collapse5').parent().find('.panel-heading a').click();
  					}
					return false;
				}
			}
			if(!validator) {
				if($('#collapse4').attr("class") == 'panel-collapse collapse'){
  					$('#collapse4').parent().find('.panel-heading a').click();
  				}
				return false;
			} 
			$('form').submit();

						
					} else {
						var html = '<br/> <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Phone Number Already Exists!<br/><a href="/admin/candidates/detail/'+response.result1+'" rel="View Detais" target="_blank">'+response.fullname+'</a></strong></div>';
    					$('.phone_msg').html(html);
						$("#primary_phone").addClass('validate-error').focus();
		  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
		  					$('#collapse1').parent().find('.panel-heading a').click();

		  				}
		  				return false;
					}
				});
					} else {
						var html = '<br/> <div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close"></a><strong>Email Already Exists!<br/><a href="/admin/candidates/detail/'+response.result1+'" rel="View Detais" target="_blank">'+response.fullname+'</a></strong></div>';
    					$('.msg').html(html); 
						$("#primary_email").addClass('validate-error').focus();
		  				if($('#collapse1').attr("class") == 'panel-collapse collapse'){
		  					$('#collapse1').parent().find('.panel-heading a').click();

		  				}
		  				return false;
					}
				});
  			
		});

  				
  		
		$('.jo-panel').on('change', '.is-completed-check', function() {
		  console.log($(this).val(), $(this).prop('checked'));	
		  if($(this).prop('checked')) {
		  	$(this).closest('span').find('.is-completed-hidden').val('1');
		  } else {
		  	$(this).closest('span').find('.is-completed-hidden').val('0');
		  }
	    });
	});

function getExpVal()
{
    var year=$('input[name=year]:checked').val();
    var month=$('input[name=month]:checked').val();
    if(year!== undefined)
   {
     var buttonValue=year+' years';
      $('#experience').html(buttonValue);
      $('#experience_years').val(year);

   }
  if(month!== undefined)
   {
     var buttonValue=month+' months';
      $('#experience').html(buttonValue);
      $('#experience_months').val(month);
   }
   if((year!== undefined) && (month!== undefined))
   {
    var buttonValue= year+' years'+' '+ month+' months';
    $('#experience').html(buttonValue);
    $('#experience').val(buttonValue);
    $('#experience_years').val(year);
    $('#experience_months').val(month);
   }
    if((year== undefined) && (month== undefined)) 
    { 
    var ayears= $('#experience_years1').val();
    		var amonth= $('#experience_months1').val();
    		var buttonValue=ayears+' years'+' '+ amonth+' months';
   		$('#experience').html(buttonValue);
      $('#experience').val(buttonValue);
   }

   if((year>0) || (month>0)){
	$('.required_field').show();

	
   }
   else if((year<=0) || (month<=0)){
	$('.required_field').hide();
   }
   else if((year== 0) && (month == undefined) ){ 
	
	$('.required_field').hide();
   
   }
   else if((year== 0) &&(month!== 0) ){ 
	
	$('.required_field').show();
   
   }
   else if((month== 0) && (year!== 0)){ 
	$('.required_field').show();
   
   }
   else if((year== 0) && (month== 0)){ 
	   
	$('.required_field').hide();
   
   }


   }
	// function checkEmailNotExists(_email){
	// 	var email = _email;
	// 	if(email){
	// 	    $.get('/candidates/CheckMailExists', {
	// 	    	id : $('#candidate_id').val(),
	// 	    	email: email
	// 	    }, function(_result) {
	// 			if(_result !== 'true'){
	// 				$('#primary_email').removeClass('validate-error').focus();
	// 				return true;
	// 			}
	// 			else{
	// 				alert('Email Already Exists');
	// 				$('#primary_email').addClass('validate-error').val('').focus();
	// 				return false;
	// 			}
	// 	    });
	//     }
	// }

    function listStates(country_id) {
	console.log(country_id);
	$.get('{{CRUDBooster::mainpath()}}/add', {
		country_id: country_id,
		current_action: 'list_states',
	}, function(_data) {
		var select = $('form select[name= state_id]');
		select.empty();
		select.append('<option value=' +' '+ '>' +'--'+ '</option>');
		var select2= $('form select[name= city_id]');
		select2.empty();
		select2.append('<option value=' +' '+ '>' +'--'+ '</option>');
		$.each(_data,function(key, value) {
			select.append('<option value=' + value.id + '>' + value.name + '</option>');
		});
	});
}

    function listCities(state_id) {
		$.get('{{CRUDBooster::mainpath()}}/add', {
			state_id: state_id,
			current_action: 'list_cities',
		}, function(_dataCity) {
			var select = $('form select[name= city_id]');
			select.empty();
			select.append('<option value=' +' '+ '>' +'--'+ '</option>');
			$.each(_dataCity,function(key, value) {
				select.append('<option value=' + value.id + '>' + value.name + '</option>');
			});
			if(parseCityText != '') {
				$("#city_id option").each(function () {
			        if ($(this).html().trim() == $.trim(parseCityText)) {
			            $(this).attr("selected", "selected");
			            parseCity = $(this).attr('value');
						$("#city_id").val(parseCity).change();
			        } else {
			        	parseCity = '';
			        }
				});
				parseCityText = '';
			}
		});
	}
    function listFunctionalAreaRolesAndSkills(functional_area_id) {
    	$.get('{{CRUDBooster::mainpath()}}/add', {
            functional_area_id: $('#functional_area_id').val(),
            current_action: 'list_functional_roles_skills',
        }, function(_dataFunctionalArea) {
        	var selectRoles = $('#functional_area_role_id');
        	selectRoles.empty();
	 		$.each(_dataFunctionalArea['roles'],function(key, value) {
                selectRoles.append('<option value=' + value.id + '>' + value.name + '</option>');
            });

            var selectSkills = $('#functional_area_skill_id');
        	selectSkills.empty();
        	$.each(_dataFunctionalArea['skills'],function(key, value) {
                selectSkills.append('<option value=' + value.id + '>' + value.name + '</option>');
            });
        });
    }

    
    	
</script>
@endpush
@include('override.candidates._scripts')