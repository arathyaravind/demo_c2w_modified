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
                <?php $recruiter = \DB::table('cms_users')->find($jo->recruiter); ?>
                <?php 
                    //$owner = \DB::table('cms_users')->find($jo->job_order_applicant->lastActivity->creator_id);
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
                <a href='/admin/job_order_applicants?job_order_id={{$jo->job_order_id}}&candidate_id={{$jo->candidate->id}}'target="_blank"><span class="jo-order">{{ $jo->title }}</span></a>
                @else
                <span class="jo-order">{{ $jo->title }}</span>
                @endif
                @else
                <a href='/admin/job_order_applicants?job_order_id={{$jo->job_order_id}}&candidate_id={{$jo->candidate->id}}'target="_blank"><span class="jo-order">{{ $jo->title }}</span></a>
                @endif
               </td>
                <td style="display: none;"><span class="jo-type">{{ $jo->primary_status }}</span></td>
                <td style="display: none;"> @if(!empty($jo->candidate))
                                <b>Candidate:</b> <span class="jo-candidate"> {{$jo->candidate->first_name }}
                                {{$jo->candidate->last_name }} </span>
                                @else
                                <span class="no-candidate">--</span>
                                @endif              
               </td>
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
                {{-- <td><!-- <a href='/admin/users/detail/{{$recruiter->id}}' --> {{ $recruiter->name }}<!-- </a> --></td> --}}
                <td><!-- <a href='/admin/users/detail/{{$owner->id}}' --> {{ $owner->name }}
                @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-toggle="modal" data-target="#changeOwner{{$jo->job_order_applicant->id }}" title="Change Owner"><i class="fa fa-user"></i></button>
                                    @include('override.candidates._owner-edit-modal')
                                   
                                    @endif            
                <!-- </a> --></td>
                <td>{{ date("d/m/Y", strtotime($jo->addedOn)) }}</td>
                <td>       
                            @if(!empty($jo->job_order_applicant))
                            @if(CRUDBooster::myPrivilegeId()==4)
                            @if($recruiter->id==CRUDBooster::myId()|| $job_order_owner->id==CRUDBooster::myId()||$owner->id==CRUDBooster::myId())
                            @if(($jo->job_order_applicant->next_action != " ") || ($jo->job_order_applicant->next_action != '-'))
                            @if($jo->job_order_applicant->next_action == '-')
                            <p>
                            {{ $jo->job_order_applicant ->next_action}}
                            </p>
                            @else
                            <p>
                            <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$jo->job_order_applicant->id }}" {{$state}}>{{ $jo->job_order_applicant ->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                            </p>
                            @endif
                                <p style="width:200px!important;">
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
                            <span class="jo-date-highlight">Interview feedback rescheduled for <b>{{ date("d/m/Y", strtotime($jo->job_order_applicant ->interview_reschedule_date)) }}</b></span>
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
                            -
                            @endif
                            @else
                            <p>--</p>
                            @endif
                            @else
                            @if(($jo->job_order_applicant->next_action != " ") || ($jo->job_order_applicant->next_action != '-'))
                            @if($jo->job_order_applicant->next_action == '-')
                            <p>
                            {{ $jo->job_order_applicant ->next_action}}
                            </p>
                            @else
                            <p>
                            <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$jo->job_order_applicant->id }}" {{$state}}>{{ $jo->job_order_applicant ->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                            </p>
                            @endif
                            <p style="width:200px!important;">
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
                            -
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
    </div> 
@endif
