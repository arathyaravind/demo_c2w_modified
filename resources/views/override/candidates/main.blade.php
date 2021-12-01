@extends('crudbooster::admin_template')
@section('content')
<script>
    window.initers = [];
</script>
@include('override.details_dashboard._styles')
@include('override.candidates._styles')
@include('override.job_order_applicants._styles')
{{-- <div class="row">
	<div class="col-md-12"> 
		<div class="col-md-2 photo">
			<img src="/{{$row->photo_url}}" class="img-thumbnail">
		</div>
	</div>
</div> --}}

<style type="text/css">
	.userview-row{
		
	}
	.userview-row .userview-details-left{
		
	}
	.userview-row  .userview-pdf-right{
		padding-bottom: 10px;		
		position: relative;
	}
	.userview-row  .userview-pdf-right .user-resume-pdf{
		height: 600px;
		width: 100%;
	}
	.userview-row .userview-details-left .userview-details-inner{
		padding: 0;
		padding-right: 10px;
	}
	.userview-row .userview-details-left .userview-details-inner .title{
		padding-left: 0;
		padding-right: 0;
	}
	.userview-row .userview-details-left .candidates-status-row{
		border-bottom: solid 1px #dcdcdc;
	}
	.userview-row .userview-details-left .userview-details-inner-border{
		border-right: solid 1px #dcdcdc;
	}
	.userview-row .userview-details-left .userview-details-inner:nth-child(2){
		padding-left: 10px;
	}
	.userview-notes-row{
		border-top: solid 2px #dcdcdc;
		padding-top: 5px;
	}
	/* .userview-accordion-row{
		border-top: solid 2px #dcdcdc;
		padding-top: 5px;
	} */
	.userview-accordion-row{
		padding: 10px;
		width: 100%;
	}
	.userview-row .userview-details-left .candidate-photo{
		width: 60px;
	}
	.ndfHFb-c4YZDc-ujibv-nUpftc{
		display:none;
	}
</style>

                                        <!-- Modal Add To Joborder -->
                                        <div id="addToJobOrderModal{{ $row->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-add-to-job">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Add Candidate to Job Order</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="candidate-modal-content">
                                                        <div class="add-msg"></div>
                                                        <div class="candidate-modal-items">Select Any Job Order</div>
                                                        <div class="candidate-modal-items cand-jo-select">
                                                            <select name="jo_id" class='form-control select2'>
                                                                <option value="0">Job Orders (Company)</option>

                                                                @foreach($jobOrders as $jobOrder)
                                                                <?php $companyName = \DB::table('companies')->find($jobOrder->company_id)->name;?>
                                                                <option value="{{$jobOrder->id}}">   {{ $jobOrder->id.'-'.$jobOrder->title.' ('.$companyName.')'}}    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <?php $name=str_replace(array("'"), "\'",$row->first_name.' '.$row->last_name)?>
                                                        <div class="candidate-modal-items">
                                                    <button type="button" class="btn btn-success" id="addTojobOrderBtn" onclick="addTojobOrder({{ $row->id }}, ' {{$name}} ')"> Submit</button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                            </div>
                                        </div>
 
                                       <!-- End Modal -->
    <p>
		<a href="/admin/candidates"> 
		<i class="fa fa-chevron-circle-left"></i>
		Back To List Data Candidates
	    </a>
	</p>
<div class="panel panel-default">
	<div class="panel-heading">
			<strong><i class="fa fa-user"></i>&nbsp;&nbsp;Detail Candidates &nbsp;&nbsp;</strong>
		</div>
<div class="panel-body" style="padding:20px 0px 0px 0px">
				<div class="box-body" id="parent-form-area" >
  <div class="row userview-row">
	<div class="col-md-6 userview-details-left">

		<div class="col-md-6 userview-details-inner userview-details-inner-border">
			@if($row->photo_url)
			<div class="candidates-status-row">
				<img src="/{{$row->photo_url}}" class="img-thumbnail candidate-photo">
			</div>
			@endif
			<div class="candidates-status-row">
				<div class="col-md-5 title">Name:</div>
				<div class="col-md-7">{{ $row->first_name.' '.$row->last_name }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Primary E-Mail:</div>
				<div class="col-md-7" style="word-wrap: break-word;">{{ $row->primary_email }}</div>
			</div>
			
			<div class="candidates-status-row">
				<div class="col-md-5 title">Secondary E-Mail:</div>
				<div class="col-md-7" style="word-wrap: break-word;">{{ $row->secondary_email }}</div>
			</div>

			<div class="candidates-status-row">
				<div class="col-md-5 title">Primary Phone:</div>
				<div class="col-md-7">{{ $row->primary_phone }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Secondary Phone:</div>
				<div class="col-md-7">{{ $row->secondary_phone }}</div>
			</div>
			<!-- <div class="candidates-status-row">
				<div class="col-md-5 title">Work Phone:</div>
				<div class="col-md-7">{{ $row->first_name }}</div>
			</div> -->
			<div class="candidates-status-row">
				<div class="col-md-5 title">Date of Birth:</div>
				<div class="col-md-7">
				{{ ($row->birth_date=='1970-01-01'||$row->birth_date==null||$row->birth_date=='0000-00-00') ? ' ' : date('d/m/Y',strtotime( $row->birth_date)) }}
					</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Gender:</div>
				<div class="col-md-7">{{ $row->gender }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Relationship Status:</div>
				<div class="col-md-7">{{ $row->relationship_status }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Address:</div>
				<div class="col-md-7">{{ $row->address }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Postal Code:</div>
				<div class="col-md-7">{{ $row->postal_code }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Location:</div>
				<div class="col-md-7">{{$row->city.', '.$row->state.', '.$row->country}}</div>
			</div>
			
			<div class="candidates-status-row">
				<div class="col-md-5 title">Current City:</div>
				<div class="col-md-7">{{ $row->current_city }}</div>
			</div>
		   <div class="candidates-status-row">
			<div class="col-md-5 title">Religion:</div>
			<div class="col-md-7">{{ $row->religion }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Created:</div>
				<div class="col-md-7">{{ date("d/m/Y", strtotime($row->created_at)) }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Creator:</div>
				<div class="col-md-7">{{ $row->creator }}</div>
			</div>
			<!-- <div class="candidates-status-row">
				<div class="col-md-5 title">Best Time To Call:</div>
				<div class="col-md-7">{{ $row->first_name }}</div>
			</div> -->
			
			<div class="candidates-status-row">
				<div class="col-md-5 title">Website/Professional Profile :</div>
				<div class="col-md-7">{{ $row->web_site }}</div>
			</div>
			
			
		
			<div class="candidates-status-row">
				<div class="col-md-5 title">Source:</div>
				<div class="col-md-7">{{ $row->source }}</div>
			</div>
			<!-- <div class="candidates-status-row">
				<div class="col-md-5 title">Category:</div>
				<div class="col-md-7">{{ $row->category }}</div>
			</div> -->

			<div class="candidates-status-row">
				<div class="col-md-5 title">Date Available:</div>
				<div class="col-md-7">
				{{ ($row->date_available=='1970-01-01'||$row->date_available==null) ? ' ' : date('d/m/Y',strtotime( $row->date_available)) }}
					</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Modified:</div>
				<div class="col-md-7">{{ date("d/m/Y", strtotime($row->updated_at)) }}</div>
			</div>

		</div>

		<div class="col-md-6 userview-details-inner">
			<div class="candidates-status-row">
			<div class="col-md-5 title">CV Title:</div>
			<div class="col-md-7" style="word-wrap: break-word;">{{ $row->head_line }}</div>
			</div>
			
			<div class="candidates-status-row">
				<div class="col-md-5 title">Course(Highest Education):</div>
				<div class="col-md-7">{{ $row->highest_qualification }}</div>
			</div>

		
			<!-- <div class="candidates-status-row">
				<div class="col-md-5 title">Date Available:</div>
				<div class="col-md-7">{{ $row->first_name }}</div>
			</div> -->
			<div class="candidates-status-row">
				<div class="col-md-5 title">Industry:</div>
				<div class="col-md-7">
					@foreach($industries as $industry) 
					  {{ $industry->industry }}
					<br>
					@endforeach
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Areas:</div>
				<div class="col-md-7">
					@foreach($row->candidate_industry_functional_areas as $candidate_industry_functional_area) 
					  {{ $candidate_industry_functional_area->industry_functional_area }} <br>
					@endforeach
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Role:</div>
				<div class="col-md-7">
					@foreach($row->candidate_industry_functional_area_roles as $candidate_industry_functional_area_role) 
					  {{ $candidate_industry_functional_area_role->role }} <br>
					@endforeach
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Key Skills:</div>
				<div class="col-md-7">
					@foreach($row->candidate_industry_functional_area_skills as $candidate_industry_functional_area_skill) 
					  {{ $candidate_industry_functional_area_skill->industry_functional_area_skill }}
					 <br>
					@endforeach
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Can Relocate:</div>
				<div class="col-md-7">{{ $row->can_relocate }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Preferred City:</div>
				<div class="col-md-7">{{ $row->preferred_city}}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Current Pay:</div>
				<div class="col-md-7">
					INR {{ $row->current_ctc }} lakhs
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Desired Pay:</div>
				<div class="col-md-7">INR {{ $row->expected_ctc }} lakhs</div>
			</div>
			<!-- <div class="candidates-status-row">
				<div class="col-md-5 title">Pipeline:</div> -->
				<!-- <div class="col-md-7">{{ $row->first_name }}</div> -->
			<!-- </div> -->
			<!-- <div class="candidates-status-row">
				<div class="col-md-5 title">Submitted:</div> -->
				<!-- <div class="col-md-7">{{ $row->first_name }}</div> -->
			<!-- </div> -->
			
			
		<!-- 	<div class="candidates-status-row">
				<div class="col-md-5 title">General status:</div>
				<div class="col-md-7">{{ $row->first_name }}</div>
			</div> -->
			<div class="candidates-status-row">
				<div class="col-md-5 title">Exp:</div>
				<div class="col-md-7">{{ $row->experience_years }} Years {{ $row->experience_months }} Months</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Current Employer:</div>
				<div class="col-md-7">
					{{ $row->current_employer }}
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Current Designation:</div>
				<div class="col-md-7">{{
					$row->current_designation }}
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Notice Period:</div>
				<div class="col-md-7">{{($row->notice_period > 0)? $row->notice_period. ' days': '-' }}
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 userview-pdf-right"> 
		@php 
			$resumeSrc = ($row->resume_url)? "src=https://docs.google.com/viewer?url=". Config::get('app.url'). '/' .$row->resume_url . "&embedded=true": '';
		@endphp
		<iframe class="user-resume-pdf" {{$resumeSrc}} frameborder='0'></iframe>
	</div>
</div>
 
<!-- <div class="row userview-notes-row">
	<div class="candidates-status-row">
		<div class="col-md-2 col-sm-4 col-xs-6 title">Current Designation:</div>
		<div class="col-md-10 col-sm-8 col-xs-6">{{ $row->first_name.' '.$row->last_name }}</div>
	</div>
	<div class="candidates-status-row">
		<div class="col-md-2 col-sm-4 col-xs-6 title">Upcoming Events:</div>
		<div class="col-md-10 col-sm-8 col-xs-6">{{ $row->first_name.' '.$row->last_name }}</div>
	</div>
	<div class="candidates-status-row">
		<div class="col-md-2 col-sm-4 col-xs-6 title">Attachments:</div>
		<div class="col-md-10 col-sm-8 col-xs-6">{{ $row->first_name.' '.$row->last_name }}</div>
	</div>
	<div class="candidates-status-row">
		<div class="col-md-2 col-sm-4 col-xs-6 title">Tags:</div>
		<div class="col-md-10 col-sm-8 col-xs-6">{{ $row->first_name.' '.$row->last_name }}</div>
	</div>
</div> -->
@if(count($row->candidate_qualifications) > 0)
	<div class="row userview-accordion-row">
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Educational Details</a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse in">
					<div class="panel-body">
						@foreach($row->candidate_qualifications as $candidate_qualification) 
						<div class="candidates-status-row">
							<div class="col-md-2 title">Qualification Level:</div>
							<div class="col-md-4">{{ $candidate_qualification->qualification_level }}</div>
							<div class="col-md-2 title">Qualification: </div>
							<div class="col-md-4">{{ $candidate_qualification->qualification }} </div>
						</div>
						<div class="candidates-status-row">
							<div class="col-md-2 title">Is Completed:</div>
							<div class="col-md-4">
								@if($candidate_qualification->is_completed==1) 
									Yes
								@else
									No
								@endif
							</div>
							<div class="col-md-2 title">Completed <br>Year/Score:</div>
							<div class="col-md-4">
								{{ $candidate_qualification->completed_year }}/
								{{ $candidate_qualification->score }}
							</div>
						</div> 
						@endforeach
					</div>
				</div>
			</div>
			<!-- <div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Collapsible Group 2</a>
					</h4>
				</div>
				<div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
					sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
				</div>
			</div> -->
			<!-- <div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Collapsible Group 3</a>
					</h4>
				</div>
				<div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
					sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
				</div>
			</div> -->
		</div>
	</div>
@endif


{{-- <div class="row">
	<div class="col-md-12">
		<div class="candidates-status-row">
			<div class="col-md-2 title">Name:</div>
			<div class="col-md-4">{{ $row->first_name.' '.$row->last_name }}</div>
			<div class="col-md-2 title">Primary Email:</div>
			<div class="col-md-4">{{ $row->primary_email }}</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Date of Birth:</div>
			<div class="col-md-4">{{ $row->birth_date }}</div>
			<div class="col-md-2 title">Secondary Email:</div>
			<div class="col-md-2">{{ $row->secondary_email }}</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Address:</div>
			<div class="col-md-4">{{ $row->address }} </div>
			<div class="col-md-2 title">Primary Phone:</div>
			<div class="col-md-4">{{ $row->primary_phone }}</div>
			
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Location:</div>
			<div class="col-md-4">{{ $row->city.','.$row->state.','.$row->country }}</div>
			<div class="col-md-2 title">Secondary Phone:</div>
		<div class="col-md-4">{{ $row->secondary_phone }}</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Postal Code:</div>
			<div class="col-md-4">{{ $row->postal_code }}</div>
			<div class="col-md-2 title">Gender:</div>
			<div class="col-md-4">{{ $row->gender }}</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Source:</div>
			<div class="col-md-4">{{ $row->source }}</div>
			<div class="col-md-2 title">Category:</div>
			<div class="col-md-4">{{ $row->category }}</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="title-main"> PROFESSIONAL DETAILS</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="candidates-status-row">
			<div class="col-md-2 title">Current Employer:</div>
			<div class="col-md-4">{{ $row->current_employer }}</div>
			<div class="col-md-2 title">Current CTC:</div>
			<div class="col-md-4">INR {{ $row->current_ctc }} lakhs</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Current Designation:</div>
			<div class="col-md-4">{{ $row->current_designation }}</div>
			<div class="col-md-2 title">Expected CTC:</div>
			<div class="col-md-4">INR {{ $row->expected_ctc }} lakhs</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Current City:</div>
			<div class="col-md-4">{{ $row->current_city }} </div>
			<div class="col-md-2 title">Experience:</div>
			<div class="col-md-4">{{ $row->experience_years }} Years {{ $row->experience_months }} Months</div>
			
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">First Job Start Date:</div>
			<div class="col-md-4">{{ $row->first_job_start_date }}</div>
			<div class="col-md-2 title">Preferred City:</div>
			<div class="col-md-4">{{ $row->preferred_city }}</div>
		</div>
		
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="title-main"> PROFESSIONAL SKILLS</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="candidates-status-row">
			<div class="col-md-2 title">Industry:</div>
			<div class="col-md-4">
				@foreach($industries as $industry) 
					  {{ $industry->industry }} <br>
				@endforeach
				
			</div>
			<div class="col-md-2 title">Functional Area:</div>
			<div class="col-md-4">
				@foreach($row->industry_functional_areas as $industry_functional_area) 
					  {{ $industry_functional_area->industry_functional_area }} <br>
				@endforeach
			</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">General Skills:</div>
			<div class="col-md-4">
				@foreach($row->general_skills as $general_skill) 
					  {{ $general_skill }} <br>
				@endforeach
			</div>
			<div class="col-md-2 title">Functional Area Role:</div>
			<div class="col-md-4">
				@foreach($row->candidate_industry_functional_area_roles as $candidate_industry_functional_area_role) 
					  {{ $candidate_industry_functional_area_role->role }} <br>
				@endforeach
			</div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Functional Area Skills:</div>
			<div class="col-md-4">
				@foreach($row->candidate_industry_functional_area_skills as $candidate_industry_functional_area_skill) 
					  {{ $candidate_industry_functional_area_skill->industry_functional_area_skill }} 
					  ({{$candidate_industry_functional_area_skill->experience_years }} years
					  {{$candidate_industry_functional_area_skill->experience_months }} months)<br>
				@endforeach
			</div>
			<div class="col-md-2 title"></div>
			<div class="col-md-4"></div>
		</div>
		
		
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="title-main"> EDUCATIONAL QUALIFICATIONS</div>
	</div>
</div> --}}

{{-- <div class="row">
	<div class="col-md-12">
		
		<div class="candidates-status-row">
			<div class="col-md-2 title">Highest Qualification <br>Level:</div>
			<div class="col-md-4">{{ $row->highest_qualification_level }}</div>
			<div class="col-md-2 title">Highest Qualification: </div>
			<div class="col-md-4">{{ $row->highest_qualification }}</div>
		</div>
		@foreach($row->candidate_qualifications as $candidate_qualification) 
		<div class="candidates-status-row">
			<div class="col-md-2 title">Qualification Level:</div>
			<div class="col-md-4">{{ $candidate_qualification->qualification_level }}</div>
			<div class="col-md-2 title">Qualification: </div>
			<div class="col-md-4">{{ $candidate_qualification->qualification }} </div>
		</div>
		<div class="candidates-status-row">
			<div class="col-md-2 title">Is Completed:</div>
			<div class="col-md-4">
				@if($candidate_qualification->is_completed==1) 
					Yes
				@else
					No
				@endif
			</div>
			<div class="col-md-2 title">Completed <br>Year/Score:</div>
			<div class="col-md-4">
				{{ $candidate_qualification->completed_year }}/
				{{ $candidate_qualification->score }}
			</div>
		</div> 
		@endforeach
	</div>
</div> --}}

@include('override.candidates._joassociations')
</div>
<div class="box-footer" style="background: #F5F5F5">  

					<div class="form-group">
						<label class="control-label col-sm-2"></label>
						<div class="col-sm-10">

						</div>
					</div>                             

				</div>
</div>
</div>
@include('override.candidates._scripts')
@include('override.job_order_applicants._status-modal')
@include('override.job_order_applicants._log-modal')
@include('override.job_order_applicants._filter-modal')
@include('override.job_order_applicants._resubmission-date-modal')

@include('override.job_order_applicants._task-send-invoice-modal')
@include('override.job_order_applicants._task-qualify-modal')
@include('override.job_order_applicants._task-submit-modal')
@include('override.job_order_applicants._task-get-submission-feedback-modal')
@include('override.job_order_applicants._task-schedule-interview-modal')
@include('override.job_order_applicants._task-confirm-interview-schedule-modal')
@include('override.job_order_applicants._task-confirm-attendance-modal')
@include('override.job_order_applicants._task-get-interview-feedback-modal')
@include('override.job_order_applicants._task-roll-out-offer-modal')
@include('override.job_order_applicants._task-confirm-offer-modal')
@include('override.job_order_applicants._task-confirm-joining-modal')
@endsection
@push(bottom)
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
	var job_order="{{$_REQUEST['job_order_id']}}";
	var status_datavalue='';
	$(document).ready(function(){
		$('.select2').select2();
		    $('.content-header h1').append('<a class="glyphicon glyphicon-pencil" title="Edit Candidate" href="{{CRUDBooster::mainpath("edit/$row->id")}}" rel="Edit" target="_blank" style="padding-left: 20px; font-size: 18px;"></a>');
			if(job_order){
			   $('.add_to_joborder').hide();
		       $.post('/custom/check-joborder-openings', {
		            job_order_id: "{{$_REQUEST['job_order_id']}}",
		            candidate_id: "{{$row->id}}"
		        }, function(response) {
		        	if(response=='yes'){
		        $('.content-header h1').append("&nbsp;&nbsp;<button class='btn btn-info btn-sm btn-associate-alert'>Associate To JobOrder</button>");
		        $('.btn-associate-alert').click(function() {
		     	 alert('No Openings Available!');
		        });
		        }
		        else{
		        $('.content-header h1').append("&nbsp;&nbsp;<button class='btn btn-info btn-sm btn-associate'>Associate To JobOrder</button>");
		        $('.btn-associate').click(function() {
		        $.post('/custom/associate-candidate', {
		            job_order_id: "{{$_REQUEST['job_order_id']}}",
		            candidate_id: "{{$row->id}}"
		        }, function() {
		        	alert('Candidate has been successfully associated to Job Order');
		        	window.location.href = "/admin/job_order_applicants?job_order_id="+job_order;
		        });
		        });
		        }
		        });
			}
			else{
			    $('.content-header h1').append('&nbsp;&nbsp;<button class="btn btn-sm btn-info add_to_joborder" data-toggle="modal" data-toggle="modal" data-target="#addToJobOrderModal{{ $row->id}}" style="padding-left: 20px;">Add To JobOrder</button>');	
			}
			
			
			 window.initers.push( function(){
        // functionalAreaSkills('');
        window.allStatuses = {
        'Pipeline': [
        'Associated'
        ],
        'Qualify': [
        'Pending Review',
        'Qualified',
        'Declined by C2W',
        'Schedule Call Back'
        ],
        'Submission': [
        'Submitted to Client',
        'Approved by the client',
        'Reschedule Submission',
        'Rejected by the client'
        ],
        'Interview': [
        'Interview Scheduled',
        'Interview in Progress',
        'Interview Done',
        'Interview Rescheduled',
        'Backed Out',
        'On Hold',
        'Interview Feedback Rescheduled',
        'Shortlisted for Next Round',
        'To be Offered',
        'Rejected by the client',
        'Rejected Hirable'
        ],
        'Offer': [
        'Offer Made',
        'Confirm Offer Follow Up',
        'Offer Accepted',
        'Offer Declined',
        'Offer Withdrawn',
        'No Show',
        'Un Qualified'
        ],
        'Place': [
        'Joined',
        'Joining Extended',
        'Backed Out'
        // 'Converted Employee'
        ]
    };
       $('.close-check').on('hidden.bs.modal', function () {
        location.reload();
       });
        $('.close-btn').click(function(){
        location.reload();
       });
        $('#primary_status').change(function() {
        $('#secondary_status option')
        .hide()
        .filter(function() {
            return (this.value == '-' || window.allStatuses[$('#primary_status').val()].indexOf(this.value) !== -1);
        })
        .show();
        $('#secondary_status option').first()[0].selected = true;
        $('#next_action').val('');
    });

       $('#secondary_status').change(function() {
       	 if(!$('#interview_date-'+status_datavalue).val()){
            $('#status_modal  #task_confirm_attendance').val($('#interview_date-'+status_datavalue).val());
            $("#status_modal  #task_confirm_attendance").prop("readonly", false);
            $("#status_modal  #task_confirm_attendance").prop('disabled', false);
        }else{
           $('#status_modal  #task_confirm_attendance').val($('#interview_date-'+status_datavalue).val());
           $("#status_modal  #task_confirm_attendance").prop("readonly", true);
           $("#status_modal  #task_confirm_attendance").prop('disabled', true);
        }
          $('#next_action').val($(this).find('option:selected').attr('data-next-step'));

    });

        $('.btn-change-status').click(function() {
        var status_modal_id='#status_modal';
        resetTaskModals(status_modal_id);
        var datavalue='';
        datavalue=$(this).attr('data-id');
        status_datavalue=datavalue;
        var openings=$('#openings'+datavalue).val();
        var task = $.trim($('.btn-applicant-task[data-id="'+datavalue+'"]').text());
        var order = $('.btn-applicant-task[data-id="'+datavalue+'"]').closest('tr').find('td .jo-order').text();
        if(openings<=0)
        {
            if(task=='Send Invoice')
            {
                $('.pmsg').html(' ');
                $('.status_pmsg').html(' ');
                $('.btn-change-status[data-id="'+datavalue+'"]').prop("disabled",false);
                $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled",false);
                $.get('/custom/get-applicant-details/' + $(this).attr('data-id'), function(_data) {
                    if(_data == '') return;
                    _data = JSON.parse(_data);
                    $('#status_modal .jo-applicant-value').text(_data.details.first_name + ' ' + _data.details.last_name);
                    $('#status_modal .jo-title-value').text(order);
                    /*$('#primary_status option').each(function() {
                    if(this.value === _data.primary_status) {
                    this.selected = true;
                    $('#primary_status').change();
                    return false;
                    }
                    });

                    $('#secondary_status option').each(function() {
                    if(this.value === _data.secondary_status) {
                    this.selected = true;
                    $('#secondary_status').change();
                    return false;
                    }
                    });*/
                    $('#primary_status option').each(function() {
                        if(this.value.trim()==_data.primary_status.trim()) {
                            this.selected = true;
                            $('#primary_status').change();
                            return false;
                        }
                    });
                    $('#secondary_status option').each(function() {
                        if(this.value.trim()) {
                            var str1=this.value;
                            var str2=_data.secondary_status;
                            if(str1.toUpperCase()===str2.toUpperCase())
                            {
                                console.log('tggest',_data.secondary_status);
                                this.selected = true;
                                $('#secondary_status').change();
                                return false;
                            }
                        }
                    });
                    $('#status_modal .btn-save-status').attr('data-id', _data.id);

                    $('#status_modal').modal('show');
                }); 
            }
            else{
                var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
                //$('.pmsg').html(html);
                $('.status_pmsg').html(html);
                //$(".pmsg").get(0).scrollIntoView();
/*                $(document).ready(function(){
                    // $(this).scrollTop(0);
                });*/
                //$('.btn-change-status[data-id="'+datavalue+'"]').prop("disabled", true);
                $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", true); 
                $.get('/custom/get-applicant-details/' + $(this).attr('data-id'), function(_data) {
                if(_data == '') return;
                _data = JSON.parse(_data);
                $('#status_modal .jo-applicant-value').text(_data.details.first_name + ' ' + _data.details.last_name);
                $('#status_modal .jo-title-value').text(order);
                $('#primary_status option').each(function() {
                    if(this.value.trim()==_data.primary_status.trim()) {
                        this.selected = true;
                        $('#primary_status').change();
                        return false;
                    }
                });
                $('#secondary_status option').each(function() {
                    if(this.value.trim()) {
                        var str1=this.value;
                        var str2=_data.secondary_status;
                        if(str1.toUpperCase()===str2.toUpperCase())
                        {
                            console.log('tggest',_data.secondary_status);
                            this.selected = true;
                            $('#secondary_status').change();
                            return false;
                        }
                    }
                });

                $('#status_modal .btn-save-status').attr('data-id', _data.id);

                $('#status_modal').modal('show');
            });
            }
        }
        else{
            $('.pmsg').html(' ');
            $('.status_pmsg').html(' ');
            $.get('/custom/get-applicant-details/' + $(this).attr('data-id'), function(_data) {
                if(_data == '') return;
                _data = JSON.parse(_data);
                $('#status_modal .jo-applicant-value').text(_data.details.first_name + ' ' + _data.details.last_name);
                $('#status_modal .jo-title-value').text(order);
                $('#primary_status option').each(function() {
                    if(this.value.trim()==_data.primary_status.trim()) {
                        this.selected = true;
                        $('#primary_status').change();
                        return false;
                    }
                });
                $('#secondary_status option').each(function() {
                    if(this.value.trim()) {
                        var str1=this.value;
                        var str2=_data.secondary_status;
                        if(str1.toUpperCase()===str2.toUpperCase())
                        {
                            console.log('tggest',_data.secondary_status);
                            this.selected = true;
                            $('#secondary_status').change();
                            return false;
                        }
                    }
                });

                $('#status_modal .btn-save-status').attr('data-id', _data.id);

                $('#status_modal').modal('show');
            });
        }

    });

        $('.btn-applicant-task').click(function() {
            var datavalue='';
            var task = $.trim($(this).text());
            var current_status = $(this).closest('tr').find('td .jo-type').text();
            var company = $(this).closest('tr').find('td .jo-company').text();
            var order = $(this).closest('tr').find('td .jo-order').text();
            var candidate = $(this).closest('tr').find('td .jo-candidate').text();
            datavalue=$(this).attr('data-id');
            var openings=$('#openings'+datavalue).val();
            if(openings<=0)
            {

                if(task=='Send Invoice')
                {
                	$('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", false);
                    $('.pmsg').html(' ');
                    var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                    var modal = $('#' + modalID);
                    var modalId='#' + modalID;
                    modal.find('.jo-task-name').text(task);
                    modal.find('.jo-title-value').text(order);
                    modal.find('.jo-order-title').text(order); 
                	modal.find('.jo-company-name').text(company);
                    modal.find('.jo-applicant-value').text(candidate);
                    modal.find('.send_invoice_candidate_id').val($('#candidate_id-'+datavalue).val());
                    if($(this).closest('tr').find('td .jo_applicant_join_date').val() != ''){
                        modal.find('.jo-applicant-join-date').text($(this).closest('tr').find('td .jo_applicant_join_date').val());
                    }
                    else{
                        $(this).closest('tr').find('td .jo_applicant_join_date').val('');
                    }
                    modal.find('.jo-ctc-value').text($(this).closest('tr').find('td .jo_applicant_ctc_value').val());
                    modal.find('.btn-apply-task').attr('data-id', $(this).attr('data-id'));
                    resetTaskModals(modalId);
                    modal.modal('show');
                    $('.pmsg').html(' ');
                    $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", false);
                }
                else{
                    //var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Opening Vacancy already filled!</strong></div>';
                    //$('.pmsg').html(html);
                    var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                    var modal = $('#' + modalID);
                    modal.find('.jo-task-name').text(task);
                    modal.find('.jo-title-value').text(order);
 					modal.find('.jo-order-title').text(order); 
                	modal.find('.jo-company-name').text(company);
                    modal.find('.jo-applicant-value').text(candidate);
                    modal.find('.btn-apply-task').attr('data-id', $(this).attr('data-id'));
                    modal.modal('hide');
                    $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", true);
                    var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
                    $('.pmsg').html(html);
                    $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", true);
                }
            }
            else{

// $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(8)').find('td:nth-last-child(1)').text().trim();
				$('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", false);
                $('.pmsg').html(' ');
                var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                var modal = $('#' + modalID);
                var modalId='#' + modalID;
                modal.find('.jo-task-name').text(task);
                modal.find('.jo-title-value').text(order);
                modal.find('.jo-order-title').text(order); 
                modal.find('.jo-company-name').text(company);
                modal.find('.jo-applicant-value').text(candidate);
                modal.find('.send_invoice_candidate_id').val($('#candidate_id-'+datavalue).val());
                if($(this).closest('tr').find('td .jo_applicant_join_date').val() != ''){
                    modal.find('.jo-applicant-join-date').text($(this).closest('tr').find('td .jo_applicant_join_date').val());
                }
                else{
                    $(this).closest('tr').find('td .jo_applicant_join_date').val('');
                }
                modal.find('.jo-ctc-value').text($(this).closest('tr').find('td .jo_applicant_ctc_value').val());
                modal.find('.btn-apply-task').attr('data-id', $(this).attr('data-id'));
                resetTaskModals(modalId);
                modal.modal('show');        
            }
        });
    });

    if(window.initers && window.initers.length) {
        window.initers.forEach(function(_initer) {
            _initer();
        });
    }
		    });
    function resetTaskModals(modal_id){
    	var datavalue='';
        if(modal_id=='#task_get_interview_feedback_modal'){
            $("#task_get_interview_feedback_modal .modal-body select").val('-');
            $("#task_get_interview_feedback_modal .modal-body input").val('');
            $("#task_get_interview_feedback_modal .modal-body textarea").val('');
            $('.task_get_interview_feedback_onhold').hide();
            $('.task_get_interview_feedback_to_be_offered').hide();
            $('.task_get_interview_feedback_reschedule').hide();
            $('.task_get_interview_feedback_round2').hide();
            $('.task_interview_reschedule').hide();
            $('#task_get_interview_feedback_modal #task_get_interview_feedback_onhold, #task_get_interview_feedback_modal #task_get_interview_feedback_reschedule, #task_get_interview_feedback_modal #task_schedule_interview_interview_r2_date,#task_get_interview_feedback_modal #task_get_interview_feedback_to_be_offered,#task_get_interview_feedback_modal #task_reschedule_interview_interview_date,#task_get_interview_feedback_modal #task_reschedule_interview_confirmation_date,#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').datepicker('startDate','0d');
            $('#task_get_interview_feedback_modal #task_get_interview_feedback_onhold, #task_get_interview_feedback_modal #task_get_interview_feedback_reschedule, #task_get_interview_feedback_modal #task_schedule_interview_interview_r2_date,#task_get_interview_feedback_modal #task_get_interview_feedback_to_be_offered,#task_get_interview_feedback_modal #task_reschedule_interview_interview_date,#task_get_interview_feedback_modal #task_reschedule_interview_confirmation_date,#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').datepicker('setDate', null);
        }
        if(modal_id=='#status_modal'){
            $("#status_modal .modal-body input").val('');
            $("#status_modal .modal-body textarea").val('');
            $('#status_modal .callback input, #status_modal .submission input,#status_modal .task_feedback_reschedule input,#status_modal .task_feedback_set_interview input,#status_modal #task_schedule_interview_interview_date,#status_modal #task_schedule_interview_confirmation_date,#status_modal #task_reschedule_interview_interview_date,#status_modal #task_interview_followup,#status_modal #task_get_interview_feedback_reschedule,#status_modal #task_roll_out_offer_confirmation_date,#status_modal #task_confirm_offer_joining_date,#status_modal #task_confirm_attendance').datepicker('startDate','0d');
            $('#status_modal .callback input, #status_modal .submission input,#status_modal .task_feedback_reschedule input,#status_modal .task_feedback_set_interview input,#status_modal #task_schedule_interview_interview_date,#status_modal #task_schedule_interview_confirmation_date,#status_modal #task_reschedule_interview_interview_date,#status_modal #task_interview_followup,#status_modal #task_get_interview_feedback_reschedule,#status_modal #task_roll_out_offer_confirmation_date,#status_modal #task_confirm_offer_joining_date,#status_modal #task_confirm_attendance').datepicker('setDate', null);
        }
        if(modal_id=='#task_qualify_modal'){
            $("#task_qualify_modal .modal-body select").val('-');
            $("#task_qualify_modal .modal-body textarea").val('');
            $('#task_qualify_modal .callback').hide();
            $('#task_qualify_modal .submission').hide();
            $('#task_qualify_modal .callback input, #task_qualify_modal .submission input').datepicker('startDate','0d');
            $('#task_qualify_modal .callback input, #task_qualify_modal .submission input').datepicker('setDate', null);
        }
        if(modal_id=='#task_submit_modal'){
            $('#task_submit_modal .get-feedback-date input').val('{{ date('d/m/Y', strtotime('tomorrow')) }}');
            $('#task_submit_modal .get-feedback-date input').datepicker('setDate', '{{ date('d/m/Y', strtotime('tomorrow')) }}');
        }
        if(modal_id=='#task_get_submission_feedback_modal'){
            $("#task_get_submission_feedback_modal .modal-body select").val('-');
            $("#task_get_submission_feedback_modal .modal-body textarea").val('');
            $('.task_feedback_reschedule').hide();
            $('.task_feedback_set_interview').hide();
            $('.task_feedback_reschedule input, .task_feedback_set_interview input').datepicker('startDate','0d');
            $('.task_feedback_reschedule input, .task_feedback_set_interview input').datepicker('setDate', null);
        }
        if(modal_id=='#task_schedule_interview_modal'){
            $("#task_schedule_interview_modal .modal-body input").val('');
            $("#task_schedule_interview_modal .modal-body textarea").val('');
            $('#task_schedule_interview_modal .modal-body select').val('AM');
            $('#task_schedule_interview_modal #task_schedule_interview_interview_date, #task_schedule_interview_modal #task_schedule_interview_confirmation_date').datepicker('startDate','0d');
            $('#task_schedule_interview_modal #task_schedule_interview_interview_date, #task_schedule_interview_modal #task_schedule_interview_confirmation_date').datepicker('setDate', null);
        }
        if(modal_id=='#task_confirm_interview_schedule_modal'){
            $("#task_confirm_interview_schedule_modal .modal-body input").val('');
            $("#task_confirm_interview_schedule_modal .modal-body textarea").val('');
            $('#task_confirm_interview_schedule_modal .modal-body select').val('-');
            $('#task_confirm_interview_schedule_modal .modal-body select#task_reschedule_interview_interview_time_ampm').val('AM');
            datavalue= $('#task_confirm_interview_schedule_modal button.btn-apply-task').attr('data-id');
            $('#task_confirm_interview_schedule_modal #task_interview_followup').val($('#interview_date-'+datavalue).val());
            $('.task_interview_followup').hide();
            $('.task_interview_reschedule').hide();
            $('#task_confirm_interview_schedule_modal #task_reschedule_interview_interview_date,#task_confirm_interview_schedule_modal #task_reschedule_interview_confirmation_date').datepicker('startDate','0d');
            $('#task_confirm_interview_schedule_modal #task_reschedule_interview_interview_date,#task_confirm_interview_schedule_modal #task_reschedule_interview_confirmation_date').datepicker('setDate', null);
        }
        if(modal_id=='#task_roll_out_offer_modal'){
            $("#task_roll_out_offer_modal .modal-body input").val('');
            $("#task_roll_out_offer_modal .modal-body textarea").val('');
            $('#task_roll_out_offer_modal #task_roll_out_offer_confirmation_date').datepicker('startDate','0d');
            $('#task_roll_out_offer_modal #task_roll_out_offer_confirmation_date').datepicker('setDate', null);
        }
        if(modal_id=='#task_confirm_offer_modal'){
            $("#task_confirm_offer_modal .modal-body input").val('');
            $("#task_confirm_offer_modal .modal-body textarea").val('');
            $('#task_confirm_offer_modal .modal-body select').val('-');
            $('.task_confirm_offer_joining_date').hide();
            $('.task_confirm_offer_ctc').hide();
            $('.task_confirm_offer_feedback_followup').hide();
            $('#task_confirm_offer_modal #task_confirm_offer_joining_date,#task_confirm_offer_modal #task_confirm_offer_feedback_followup').datepicker('startDate','0d');
            $('#task_confirm_offer_modal #task_confirm_offer_joining_date,#task_confirm_offer_modal #task_confirm_offer_feedback_followup').datepicker('setDate', null);
        }
        if(modal_id=='#task_confirm_joining_modal'){
            $("#task_confirm_joining_modal .modal-body input").val('');
            $("#task_confirm_joining_modal .modal-body select").val('-');
            $("#task_confirm_joining_modal .modal-body textarea").val('');
            $('.task_confirm_joining_joining_date').hide();
            $('#task_confirm_joining_modal #task_confirm_joining_joining_date').datepicker('startDate','0d');
            $('#task_confirm_joining_modal #task_confirm_joining_joining_date').datepicker('setDate', null);
        }
        if(modal_id=='#task_send_invoice_modal'){
            $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(3)').find('td:nth-last-child(1)').text('');
        }
        if(modal_id=='#task_confirm_attendance_modal'){
            $("#task_confirm_attendance_modal  .modal-body input").val('');
            $("#task_confirm_attendance_modal  .modal-body textarea").val('');
            $('#task_confirm_attendance_modal .modal-body select').val('-');
            $('#task_confirm_attendance_modal .modal-body select#task_reschedule_interview_interview_time_ampm').val('AM');
            $('.task_interview_followup').hide();
            $('.task_interview_reschedule').hide();
            $('#task_confirm_attendance_modal  #task_reschedule_interview_interview_date,#task_confirm_attendance_modal  #task_reschedule_interview_confirmation_date,#task_confirm_attendance_modal  #task_interview_followup').datepicker('setDate', null);
            $('#task_confirm_attendance_modal #task_reschedule_interview_interview_date,#task_confirm_attendance_modal #task_reschedule_interview_confirmation_date,#task_confirm_attendance_modal  #task_interview_followup').datepicker('startDate','0d');
        }

    }
    function addTojobOrder(candidate_id, _cname) {
        $( "div.add-msg" ).text("");
        if($("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val() == 0 ) {
            $( "div.add-msg" ).text( "No Job Order Selected!!" );
            return false;
        }
        $.get('{{CRUDBooster::mainpath()}}', {
            candidate_id: candidate_id,
            job_order_id: $("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val(),
            current_action: 'add_to_joborder',
        }, function(_data) {
            if(_data=='mainfailed1') {
            $( "div.add-msg" ).html( "<div class='text-danger'>No Openings Available and Candidate '"+_cname+"' cannot be added to Job Order.</div>" );
            }
            if(_data=='mainfailed2') {
                $( "div.add-msg" ).html( "<div class='text-danger'>No Openings Available and Candidate '"+_cname+"' already assigned to Job Order.</div>" );
            }
            if(_data=='failed1') {
                $( "div.add-msg" ).text( "Candidate '"+_cname+"' cannot be added to Job Order." );
            }
            if(_data=='failed2') {
                $( "div.add-msg" ).html( "Candidate '"+_cname+"' already assigned to Job Order." );
            }
            if(_data=='success') {
                $( "div.add-msg" ).html( "Candidate '"+_cname+"' added to the Job Order." );
            }
        });
    }
   
</script>
@endpush
