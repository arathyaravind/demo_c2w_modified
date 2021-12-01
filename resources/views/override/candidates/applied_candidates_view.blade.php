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
	.userview-accordion-row{
		padding: 10px;
		width: 100%;
	}
	.userview-row .userview-details-left .candidate-photo{
		width: 60px;
	}
	td{
	    padding: 3px;
	}
	.ndfHFb-c4YZDc-ujibv-nUpftc{
		display:none;
	}
</style>
<p>
		<a title='Return' href='/admin/view-applicants?job_order_id={{$row->job_order_id}}'> 
			<i class="fa fa-chevron-circle-left "></i>
			Back To List Data View Applicants
		</a>
	</p>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong><i class="fa fa-users"></i>&nbsp;&nbsp;Applicant Details&nbsp;&nbsp;</strong>
		</div> 

		<div class="panel-body" style="padding:20px 0px 0px 0px">
				<div class="box-body" id="parent-form-area" >
  <div class="row userview-row">
	 <div class="col-md-6 userview-details-left">
		 <div class="col-md-6 userview-details-inner userview-details-inner-border">
			@if($row->photo_url)
			<div class="candidates-status-row">
				<img src="{{$row->photo_url}}" class="img-thumbnail candidate-photo">
			</div>
			@endif
			<div class="candidates-status-row">
				<div class="col-md-5 title">Name:</div>
				<div class="col-md-7">{{ $row->first_name.' '.$row->last_name }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Primary E-Mail:</div>
				<div class="col-md-7" style="word-wrap: break-word;">{{ $row->primary_email }}&nbsp;<span class="msg"></span></div>
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
			<div class="candidates-status-row">
				<div class="col-md-5 title">Date of Birth:</div>
				<div class="col-md-7">{{ ($row->birth_date=='1970-01-01'||$row->birth_date==null||$row->birth_date=='0000-00-00') ? ' ' : date("d/m/Y", strtotime($row->birth_date)) }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Gender:</div>
				<div class="col-md-7">{{ $row->gender }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Address:</div>
				<div class="col-md-7" style="word-wrap: break-word;">{{ $row->address }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Postal Code:</div>
				<div class="col-md-7">{{ $row->postal_code }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Location:</div>
				<div class="col-md-7" style="word-wrap: break-word;">{{$row->city.', '.$row->state.', '.$row->country}}</div>
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
				<div class="col-md-5 title">Web Site:</div>
				<div class="col-md-7">{{ $row->web_site }}</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Date Available:</div>
				<div class="col-md-7">
				{{ ($row->date_available=='1970-01-01'||$row->date_available==null) ? ' ' : date('d/m/Y',strtotime( $row->date_available)) }}
					</div>
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
			<div class="candidates-status-row">
				<div class="col-md-5 title">Industry:</div>
				<div class="col-md-7">
					@foreach($industries as $industry) 
					  {{ $industry->name }}
					<br>
					@endforeach
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Areas:</div>
				<div class="col-md-7">
					@foreach($areas as $area) 
					  {{ $area->name }} <br>
					@endforeach
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Role:</div>
				<div class="col-md-7"style="word-wrap: break-word;">
					@foreach($roles as $role) 
					 {{ $role->name }}
					 <br>
					@endforeach
				</div>
			</div>
		    <div class="candidates-status-row">
				<div class="col-md-5 title">Key Skills:</div>
				<div class="col-md-7">
					@foreach($skills as $skill) 
					 {{ $skill->name }}
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
				<div class="col-md-7">{{$row->current_designation }}
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Notice Period:</div>
				<div class="col-md-7">{{($row->notice_period > 0)? $row->notice_period. ' days': '-' }}
				</div>
			</div>
			<div class="candidates-status-row">
				<div class="col-md-5 title">Modified:</div>
				<div class="col-md-7">{{ date("d/m/Y", strtotime($row->updated_at)) }}</div>
			</div>
			
		</div>
	</div>

	<div class="col-md-6 userview-pdf-right"> 
		@php 
			$resumeSrc = (($row->resume))? "src=https://docs.google.com/viewer?url=". Config::get('app.url'). '/' .($row->resume) . "&embedded=true": '';
		@endphp
		<iframe class="user-resume-pdf" {{$resumeSrc}} frameborder='0'></iframe>
	</div>

</div>
<?php  $web_qualification_levels=json_decode($row->qualification_level_id, true);
                        $qualifications_web=json_decode($row->qualification_id, true);
                        $is_completed=json_decode($row->is_completed, true);
                        $years=json_decode($row->completed_year, true);
                        $scores=json_decode($row->score, true);
                        $i=0;?>    
  @if(count($web_qualification_levels) > 0)
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
						  @foreach($web_qualification_levels as $web_qualification_level)
				<?php $qualifications = \DB::table('qualifications')->find($qualifications_web[$i]);
				$qualification_levels = \DB::table('qualification_levels')->find($web_qualification_levels[$i]); ?>
						<div class="candidates-status-row">
							<div class="col-md-2 title">Qualification Level:</div>
							<div class="col-md-4"> {{$qualification_levels->qual_level}}</div>
							<div class="col-md-2 title">Qualification: </div>
							<div class="col-md-4">{{$qualifications->qualification}} </div>
						</div>
						<div class="candidates-status-row">
							<div class="col-md-2 title">Is Completed:</div>
							<div class="col-md-4">
								@if($is_completed[$i] == 1) 
									Yes
								@else
									No
								@endif
							</div>
							<div class="col-md-2 title">Completed <br>Year/Score:</div>
							<div class="col-md-4">
								{{ $years[$i] }}/
								{{ $scores[$i]  }}
							</div>
						</div> 
						<?php $i++;?>
						@endforeach
					</div>
				</div>
			</div>
			</div>
	</div>
@endif
@if($row->candidate_association_count> 0)
 <div class="row userview-accordion-row">
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
				<div class="title-main"> TOTAL ASSOCIATIONS ({{$row->candidate_association_count}})</div>
				    <div class="text-danger"><p class="pmsg"></p></div>
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"></a>
					</h4>
				</div>
				<div id="collapse1" class="panel-collapse collapse in">
					<div class="panel-body">			 
<div class="row">
    <div class="col-md-12"> 
         <table class="table table-custom-bordered table-candidate-details" width="100%">
            <tr>
                <th>Title</th>
                <th>Company</th>
                <th>Office</th>
                <th>Owner</th>
                <th>Added On</th>
                <th>Next Action</th>
                <th>Last Activity</th>
                <th>Current Status</th>
                <th>&nbsp;</th>
            </tr>
            @foreach($row->candidate_jo as $jo) 
            <tr>
                <td>
                <?php 
                      $recruiter = \DB::table('cms_users')->find($jo->recruiter); 
                      $job_order_owner=\DB::table('cms_users')->find($jo->owner); 
                      $owner = \DB::table('cms_users')->find($jo->addedBy); 
                      $openings= \DB::table('job_orders')->find($jo->job_order_id);
                      $openings_available=$openings->openings_available;
                      $job_order_status=$openings->status;
                      $state = '';
                      if($openings_available<=0 && $jo->job_order_applicant->next_action!='Send Invoice'&&$job_order_status=='Hiring In Progress'||$job_order_status=='On Hold'||$job_order_status=='Completed'||$job_order_status=='Cancelled'){
                                 $state = 'disabled';
                       }
                 ?>
                <input type="hidden" name="openings" value='{{$openings_available}}' id="openings{{$jo->job_order_applicant->id }}">
                <input type="hidden" id="candidate_id-{{$jo->job_order_applicant->id}}"  value="{{$jo->candidate->id}}">
                @if(!empty($jo->job_order_applicant->interview_date))  
                <input type="hidden" id="interview_date-{{$jo->job_order_applicant->id}}" value="{{date("d/m/Y", strtotime($jo->job_order_applicant->interview_date))}}"/>
                @endif
                @if(CRUDBooster::myPrivilegeId()==4)
                @if($recruiter->id==CRUDBooster::myId()|| $job_order_owner->id==CRUDBooster::myId()||$owner->id==CRUDBooster::myId())
                <a href='/admin/job_order_applicants?job_order_id={{$jo->job_order_id}}&candidate_id={{$jo->candidate->id}}' target="_blank"><span class="jo-order">{{ $jo->title }}</span></a>
                @else
                <span class="jo-order">{{ $jo->title }}</span>
                @endif
                @else
                <a href='/admin/job_order_applicants?job_order_id={{$jo->job_order_id}}&candidate_id={{$jo->candidate->id}}' target="_blank"><span class="jo-order">{{ $jo->title }}</span></a>
                @endif
               </td>
                <td style="display: none;"><span class="jo-type">{{ $jo->primary_status }}</span></td>
                <td style="display: none;"> @if(!empty($jo->candidate))
                                <b>Candidate:</b> <span class="jo-candidate"> {{$jo->candidate->first_name }}
                                {{$jo->candidate->last_name }} </span>
                                @else
                                <span class="no-candidate">--</span>
                                @endif</td>
                <td>
                @if(CRUDBooster::myPrivilegeId()==4)
                  @if($recruiter->id==CRUDBooster::myId()|| $job_order_owner->id==CRUDBooster::myId()||$owner->id==CRUDBooster::myId())
        			<a href='/admin/companies/detail/{{$jo->company_id}}'><span class="jo-company">{{ $jo->company }}</span></a>
        		  @else
                    <span class="jo-company">{{ $jo->company }}</span>
                  @endif
                 @else
                <a href='/admin/companies/detail/{{$jo->company_id}}'><span class="jo-company">{{ $jo->company }}</span></a>
                @endif</td>
                <td><!-- <a href='/admin/offices/detail/{{$jo->office_id}}'> -->{{ $jo->office }}<!-- </a> --></td>
                <td><!-- <a href='/admin/users/detail/{{$owner->id}}' --> {{$owner->name }}<!-- </a> --></td>
                <td>{{ date("d/m/Y", strtotime($jo->addedOn)) }}</td>
                <td>       
                            @if(!empty($jo->job_order_applicant))
                            @if(CRUDBooster::myPrivilegeId()==4)
                            @if($recruiter->id==CRUDBooster::myId()|| $job_order_owner->id==CRUDBooster::myId()||$owner->id==CRUDBooster::myId())
                            @if(($jo->job_order_applicant->next_action!= " ")&&(trim($jo->job_order_applicant->next_action)!='-'))
                            <p>
                            <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$jo->job_order_applicant->id }}"{{$state}}>{{ $jo->job_order_applicant ->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                            </p>
                                <p style="width: 200px!important;">
                            @if($jo->job_order_applicant->callback_date)
                            <span class="jo-date-highlight">Call back on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->callback_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->feedback_date)
                            <span class="jo-date-highlight">Feedback on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->feedback_date)) }}</b></span>
                             @endif
                            @if($jo->job_order_applicant->scheduled_interview_date)
                            <span class="jo-date-highlight">Set interview on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->scheduled_interview_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->scheduled_feedback_date)
                            <span class="jo-date-highlight">Rescheduled for <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->scheduled_feedback_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->interview_reschedule_date)
                            <span class="jo-date-highlight">Interview rescheduled for <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->interview_reschedule_date)) }}</b></span>
                            @endif
                           @if($jo->job_order_applicant->interview_date)
                                @if($jo->job_order_applicant && $jo->job_order_applicant->next_action =='Confirm Attendance')
                                <span class="jo-date-highlight">Attend on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->interview_date)) }}</b></span>
                                @else
                                <span class="jo-date-highlight jo-date-highlight-gray">Interview round: <b>{{$jo->job_order_applicant->interview_round }}</b></span>
                                <span class="jo-date-highlight jo-date-highlight-blue">Interview on <b>{{ date("d/m/Y h:i:s A", strtotime($jo->job_order_applicant->interview_date)) }}</b></span>
                                @endif
                            @endif
                            @if($jo->job_order_applicant->interview_followup_date)
                            <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->interview_followup_date)) }}</b></span>
                            @endif
                             @if($jo->job_order_applicant->confirm_offer_followup_date)
                            <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->confirm_offer_followup_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->offer_confirmation_date)
                            <span class="jo-date-highlight">Confirm on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->offer_confirmation_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->joining_date)
                            <span class="jo-date-highlight jo-date-highlight-blue">Joining on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->joining_date)) }}</b></span>
                            @endif
                            @if(($jo->job_order_applicant ->lastActivity->new_primary_status == 'Place') && ($jo->job_order_applicant ->lastActivity->new_secondary_status == 'Joined'))
                                <input type="hidden" name="jo_applicant_join_date" class="jo_applicant_join_date" value="{{ $jo->job_order_applicant->lastActivity->prev_joining_date ? date("d/m/Y", strtotime($jo->job_order_applicant->lastActivity->prev_joining_date)) : ' ' }}">
                            @endif
                            </p>
                            <input type="hidden" name="jo_applicant_ctc_value" class="jo_applicant_ctc_value" value="{{ $jo->job_order_applicant->approved_ctc ? $jo->job_order_applicant->approved_ctc : ' ' }}">
                            @else
                            --
                            @endif
                            @else
                            <p>--</p>
                            @endif
                            @else
                          @if(($jo->job_order_applicant->next_action!= " ")&&(trim($jo->job_order_applicant->next_action)!='-'))
                            <p>
                            <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$jo->job_order_applicant->id }}"{{$state}}>{{ $jo->job_order_applicant ->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                            </p>
                            <p style="width: 200px!important;">
                            @if($jo->job_order_applicant->callback_date)
                            <span class="jo-date-highlight">Call back on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->callback_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->feedback_date)
                            <span class="jo-date-highlight">Feedback on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->feedback_date)) }}</b></span>
                             @endif
                            @if($jo->job_order_applicant->scheduled_interview_date)
                            <span class="jo-date-highlight">Set interview on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->scheduled_interview_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->scheduled_feedback_date)
                            <span class="jo-date-highlight">Rescheduled for <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->scheduled_feedback_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->interview_reschedule_date)
                            <span class="jo-date-highlight">Interview rescheduled for <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->interview_reschedule_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->interview_date)
                                @if($jo->job_order_applicant && $jo->job_order_applicant->next_action =='Confirm Attendance')
                                <span class="jo-date-highlight">Attend on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->interview_date)) }}</b></span>
                                @else
                                <span class="jo-date-highlight jo-date-highlight-gray">Interview round: <b>{{$jo->job_order_applicant->interview_round }}</b></span>
                                <span class="jo-date-highlight jo-date-highlight-blue">Interview on <b>{{ date("d/m/Y h:i:s A", strtotime($jo->job_order_applicant->interview_date)) }}</b></span>
                                @endif
                            @endif
                            @if($jo->job_order_applicant->interview_followup_date)
                            <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->interview_followup_date)) }}</b></span>
                            @endif
                             @if($jo->job_order_applicant->confirm_offer_followup_date)
                            <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->confirm_offer_followup_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->offer_confirmation_date)
                            <span class="jo-date-highlight">Confirm on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->offer_confirmation_date)) }}</b></span>
                            @endif
                            @if($jo->job_order_applicant->joining_date)
                            <span class="jo-date-highlight jo-date-highlight-blue">Joining on <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant->joining_date)) }}</b></span>
                            @endif
                            @if(($jo->job_order_applicant ->lastActivity->new_primary_status == 'Place') && ($jo->job_order_applicant ->lastActivity->new_secondary_status == 'Joined'))
                            <input type="hidden" name="jo_applicant_join_date" class="jo_applicant_join_date" value="{{ $jo->job_order_applicant->lastActivity->prev_joining_date ? date("d/m/Y", strtotime($jo->job_order_applicant->lastActivity->prev_joining_date)) : ' ' }}">
                            @endif
                            </p>
                            <input type="hidden" name="jo_applicant_ctc_value" class="jo_applicant_ctc_value" value="{{ $jo->job_order_applicant->approved_ctc ? $jo->job_order_applicant->approved_ctc : ' ' }}">
                            @else
                            --
                            @endif
                            @endif
                            @else
                            --
                            @endif
                        </td>
                  <td>    
                    @if($jo->job_order_applicant->lastActivity)
                        {{ date("d/m/Y", strtotime($jo->job_order_applicant ->lastActivity->created_at)) }} by <u>{{ $owner->name }}</u><br>
                        Status: {{ $jo->job_order_applicant ->lastActivity->new_primary_status }} <i class="fa fa-angle-right"></i> {{ $jo->job_order_applicant ->lastActivity->new_secondary_status }}<br>
                        {{ $jo->job_order_applicant ->lastActivity->note }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $jo->secondary_status }}</td>
                <td>
                    @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                        <button class="btn btn-xs btn-primary btn-change-status" data-id="{{$jo->job_order_applicant->id }}">Status</button>
                    @endif
                  <button type="button" class="btn btn-xs btn-info pull-right mail_modal" data-toggle="modal" data-toggle="modal" data-target="#emailToCandidate{{$jo->job_order_id}}" title="Mail to candidate"><i class="fa fa-envelope"></i>
                  </button>
               </td>
              @include('override.candidates._associated-candidate-mail-modal')
            </tr>
            @endforeach
        </table>
    </div>
					</div>
				</div>
			</div>
			</div>
	</div>  
@endif
</div>

</div><!-- /.box-body -->
	<div class="box-footer" style="background: #F5F5F5">  

					<div class="form-group">
						<label class="control-label col-sm-2"></label>
						<div class="col-sm-10">

						</div>
					</div>                             

				</div>
</div>
</div>

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
<script type="text/javascript">
	$(document).ready(function(){
			var primaryEmail='{{ $row->primary_email }}';
			var status_datavalue='';
   		if($.trim(primaryEmail!='')) {
   				var email = $.trim(primaryEmail);
  				$.get('/candidates/CheckMailExists', {
  					id : $('#candidate_id').val(),
			    	email: email
			    }, function(_result) {
					if(_result != 'true'){
						$('.msg').html(' '); 
					} else {
						var html ='<a href="#" style="color: #75d422!important;" title="Email Already Exist!."><span class="glyphicon glyphicon-info-sign"></span></a>';
    					$('.msg').html(html);	
					}
				});	
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
                    //var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
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
                }
            }
            else{

// $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(8)').find('td:nth-last-child(1)').text().trim();
                var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                var modal = $('#' + modalID);
                var modalId='#' + modalID;
                modal.find('.jo-task-name').text(task);
                modal.find('.jo-order-title').text(order);
                modal.find('.jo-title-value').text(order); 
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

</script>
@endpush

