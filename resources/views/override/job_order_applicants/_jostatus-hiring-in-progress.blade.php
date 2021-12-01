@include('override.candidates._styles')
@if($jobOrder->status === 'Hiring In Progress')
<?php 
if($_REQUEST['functional_area']!='') {
    $industry_functional_area_name = explode('--', $_REQUEST['functional_area']);
}
$industry_functional_area_skill_names = [];
$functional_area_skill_name = [];
$functional_area_skill_ids = [];
if($_REQUEST['functional_area_skills']!='') {
    foreach ($_REQUEST['functional_area_skills'] as $functional_area_skill) {
        $industry_functional_area_skill_names[] = explode('--', $functional_area_skill);
    } 
    foreach($industry_functional_area_skill_names as $industry_functional_area_skill_name) {
        $functional_area_skill_name[] = $industry_functional_area_skill_name[1];
    }
    foreach($industry_functional_area_skill_names as $industry_functional_area_skill_name) {
        $functional_area_skill_ids[] = $industry_functional_area_skill_name[0];
    }
}

$industry_functional_area_role_names = [];
$functional_area_role_name = [];
$functional_area_role_ids = [];
if($_REQUEST['functional_area_roles']!='') {
    foreach ($_REQUEST['functional_area_roles'] as $functional_area_role) {
        $industry_functional_area_role_names[] = explode('--', $functional_area_role);
    } 
    foreach($industry_functional_area_role_names as $industry_functional_area_role_name) {
        $functional_area_role_name[] = $industry_functional_area_role_name[1];
    }
    foreach($industry_functional_area_role_names as $industry_functional_area_role_name) {
        $functional_area_role_ids[] = $industry_functional_area_role_name[0];
    }
}
if($_REQUEST['industry']!='') {
    $industry_name = explode('--', $_REQUEST['industry']);
}
?>
<div class="row jo-toggle-section jo-jd-section">
    <div class="col-md-12">
        <div class="panel panel-default jo-panel">
            <div class="panel-heading jo-panel-heading">
                Job Order Details
                <a class="pull-right jo-link" onclick="$('[data-target=jd]').click(); return false;">Close</a>
            </div>
            <div>
                <div id="parent-form-area">
<!-- <div class="table-responsive">
<table id="table-detail" class="table table-striped table-jo-details" style="text-align: left;">
<tbody>
<tr>
<td> <b> Client :</b><br><b> Job&nbsp;Location&nbsp;:</b> </td><td><a href='/admin/companies/detail/{{$jobOrder->company_id}}' target="_blank">{{ $company->name }}</a><br>{{ $office->name }}, {{ $office->cityName }}</td>
<td><b>Functional Area :</b> </td><td>
<?php 
$industry = \DB::table('industries')->find($jobOrder->industry)->name;
?>
{{ $industry }} 
<i class="fa fa-play inilne-font-icon"></i>
{{ implode(', ', $functionalAreas) }}
</td>
</tr>
<tr>
<td> <b> Skills :</b> </td>
<td>
{!! count($functionalAreaSkills) ? implode(', ', $functionalAreaSkills) . '<br>' : '' !!}
{!! count($generalSkills) ? implode(', ', $generalSkills) : '' !!}
</td>

{{ implode('<br>', $preferences) }}

<input type="hidden" name="openings" id="openings" value="{{$jobOrder->openings_available}}"/>
<td> <b> Openings Available :</b> </td>
<td>
{{$jobOrder->openings_available}}
</td>
</tr>
<tr>
<td><b> Description&nbsp;:</b></td>
<td colspan="4">
{!!$jobOrder->description!!}
</td>
</tr>
</tbody>
</table>
</div> -->

<div class="row table-jo-details margin0" id="table-detail">
    <div class="col-md-4">
        <div class="form-horizontal">
            <div class="form-group margin0">
                <label class="col-sm-3 control-label align-left">Client  </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <b>: &nbsp;</b> <a href='/admin/companies/detail/{{$jobOrder->company_id}}' target="_blank">{{ $company->name }}</a>
                    </p>
                </div>
            </div>
            <?php $contacts= $contacts = DB::table('contacts')
            ->where('id', $jobOrder->contact_id)
            ->orderby('first_name','asc')
            ->first();
            ?>
            <div class="form-group margin0">
                <label class="col-sm-3 control-label align-left">Contact  </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <b>: &nbsp;</b> {{$contacts->first_name.' '.$contacts->last_name}}
                    </p>
                </div>
            </div>                            
            <div class="form-group margin0">
                <label class="col-sm-3 control-label align-left">Job Location  </label>
                <div class="col-sm-9">
                    <p class="form-control-static"><b>: &nbsp;</b> {{ $office->name }}, {{ $office->cityName }}</p>
                </div>
            </div>
            <div class="form-group margin0">
                <label class="col-sm-3 control-label align-left">Openings Available  </label>
                <div class="col-sm-9">
                    <p class="form-control-static"><b>: &nbsp;</b> {{$jobOrder->openings_available}}</p>
                    <input type="hidden" name="openings" value="{{$jobOrder->openings_available}}">     
                </div>
            </div>
            <div class="form-group margin0">
                <label class="col-sm-3 control-label align-left">Functional Role</label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <b>: &nbsp;</b> 
                        @foreach($all_industry_functional_area_roles as $all_industry_functional_area_role)
                        @if($jobOrder->functional_area_role_id == $all_industry_functional_area_role->id)
                        {{$all_industry_functional_area_role->name}}
                        @endif  
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="form-group margin0">
                <label class="col-sm-3 control-label align-left">Functional Area </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <b>: &nbsp;</b> <?php 
                        $industry = \DB::table('industries')->find($jobOrder->industry)->name;
                        ?>
                        {{ $industry }} 
                        <i class="fa fa-play inilne-font-icon"></i>
                        {{ implode(', ', $functionalAreas) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-horizontal">

            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left">Start Date  </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b> {{$jobOrder->start_date}}</p>
                </div>
            </div> 
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Expiry Date </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b> {{$jobOrder->expiry_date}}</p>
                </div>
            </div> 
            <?php $owner=DB::table('cms_users')->find($jobOrder->owner)->name;
            $recruiter=DB::table('cms_users')->find($jobOrder->recruiter)->name;
            ?>
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Owner  </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b> {{$owner}}</p>
                </div>
            </div>
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Recruiter  </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b> {{$recruiter}}</p>
                </div>
            </div> 
        </div>                          
    </div>
    <div class="col-md-4">
        <div class="form-horizontal">
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Min Exp </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b>{{$jobOrder->min_exp_years.'&nbsp;years&nbsp;'.$jobOrder->min_exp_months.' &nbsp;months'}}</p>
                </div>
            </div> 
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Max Exp  </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b>{{$jobOrder->max_exp_years.'&nbsp;years&nbsp;'.$jobOrder->max_exp_months.'&nbsp;months'}}</p>
                </div>
            </div> 
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Min CTC  </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b>{{$jobOrder->min_ctc}}</p>
                </div>
            </div> 
            <div class="form-group margin0">
                <label class="col-sm-4 control-label align-left"> Max CTC  </label>
                <div class="col-sm-8">
                    <p class="form-control-static"><b>: &nbsp;</b>{{$jobOrder->max_ctc}}</p>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-md-12">
        <div class="form-horizontal">
            <div class="form-group margin0">
                <label class="col-sm-1 control-label align-left">Skills  </label>
                <div class="col-sm-11">
                    <p class="form-control-static"><b>: &nbsp;</b> 
                        {!! count($functionalAreaSkills) ? implode(', ', $functionalAreaSkills) . '<br>' : '' !!}
                        {!! count($generalSkills) ? implode(', ', $generalSkills) : '' !!}
                    </p>
                </div>
            </div>
            <div class="form-group margin0">
                <label class="col-sm-1 control-label align-left">Notes  </label>
                <div class="col-sm-11">
                    <p class="form-control-static"><b>: &nbsp;</b>  {!!$jobOrder->notes!!}</p>
                </div>
            </div>
            <div class="form-group margin0">
                <label class="col-sm-2 col-md-1 control-label align-left">Description<b style="margin-left:20px;">: &nbsp;</b></label>
                <?php
                   $joborderFilteredDescription=str_replace("<br>","",$jobOrder->description);
                   $joborderFilteredDescription=str_replace("<p></p>","",$joborderFilteredDescription);
                   $joborderFilteredDescription=str_replace("<p> </p>","",$joborderFilteredDescription);
                   $joborderFilteredDescription=trim($joborderFilteredDescription);
                ?>
                <div class="col-sm-10 col-md-11" style="margin-top:-2px;padding-left: 30px; ">
                   <p> {!!$joborderFilteredDescription!!}</p>
                </div>
            </div>
        </div>          
    </div>
</div> 
</div>
</div>
</div>
</div>
</div>

<div class="row jo-toggle-section jo-applicants-section">
    <div class="col-md-12">
        <div class="panel panel-default jo-panel">
            <div class="panel-heading jo-panel-heading">
                Applicants&nbsp;&nbsp;[{{ count($applicants) }}]
                <span class="jo-submission-date">Submission Date : 
                    <span>{{date('d-m-Y',strtotime($jobOrder->submission_date))}}</span>
                </span>
                @php
                if($resubmission_followup->submission_status == SUBMISSION_RESUBMISSION){
                    $submissionType = 'Re-submission';
                }
                elseif($resubmission_followup->submission_status == SUBMISSION_FOLLOW_UP){
                    $submissionType = 'Follow-up' ;
                }
                elseif($resubmission_followup->submission_status =='Submission'){
                    $submissionType = 'Submission' ;
                }
                @endphp

                @if(($resubmission_followup) && ($resubmission_followup->submission_status != 'Submission'))
                <span class="jo-submission-date"> {{ $submissionType }} Date :
                    <span>{{ date('d-m-Y',strtotime($resubmission_followup->date))}}</span>
                </span>
                @endif
                <span class="jo-submission-date">
                    <button class="btn btn-xs btn-success" onclick="$('#resubmission-date_modal').modal('show')">
                        Resubmission/Follow-Up Date
                    </button>      
                </span>
                <span class="jo-submission-date" style="margin-left: 3px; width: 130px;">
                    <form action="{{Request::fullUrl()}}" method="get">
                        <input type="hidden" name="job_order_id" value="{{$_REQUEST['job_order_id']}}"/>
                        <select class ='ownerId' name="added_by"  onchange="this.form.submit();">
                            <option value = "">Added By</option>
                            @foreach($owners as $owner) { 
                            <option value = "{{$owner->id}}" {{ ($_REQUEST['added_by'] == $owner->id)? 'selected' : '' }}>{{$owner->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </span>
                <a class="pull-right jo-link" onclick="$('[data-target=applicants]').click();  return false;">Close</a>
                <a class="pull-right jo-link" onclick="$('#filter_modal').modal('show'); return false;" style="margin-right: 10px;">Filters</a>
            </div> 
            <div>
                <div class="text-danger"><p class="pmsg"></p></div>
                <div id="candidate-table-div">
                    <div class="table-responsive">
                        <table id="table-detail" class="table table-custom-bordered table-striped table-jo-details custom-table">
                            <thead>
                                <tr>
                                    <span class="jo-submission-date pull-left" style="margin-left:3px; ">
                                        <input type="checkbox" name="check_all" id="check_all" autocomplete="off"> &nbsp;
                                        <label> Bulk Action </label>
                                    </span>
                                    <span class="jo-submission-date pull-left" style="margin-left:6px;padding-bottom: 20px; width: 160px;">
                                        <select name="next_action_status" id="next_action_status" class="bulk_secondary_status">
                                            <option value="0">Choose Next Action</option>
                                            <option value="Qualify">
                                                Qualify
                                            </option>
                                            <option value="Submit">
                                                Submit
                                            </option>
                                            <option value="Get Submission Feedback">
                                                Get Submission Feedback
                                            </option>
                                            <option value="Schedule Interview">
                                                Schedule Interview
                                            </option>
                                            <option value="Confirm Interview Schedule">
                                                Confirm Interview Schedule
                                            </option>
                                            <option value="Confirm Attendance">
                                                Confirm Attendance
                                            </option>
                                            <option value="Get Interview Feedback">
                                                Get Interview Feedback
                                            </option>
                                            <option value="Roll Out Offer" data-next-step="">
                                                Roll Out Offer
                                            </option>
                                            <option value="Confirm Offer">
                                                Confirm Offer
                                            </option>
                                            <option value="Confirm Joining">
                                                Confirm Joining
                                            </option>
                                            <!--  <option value="Send Invoice">
                                            Send Invoice
                                        </option> -->
                                    </select>
                                </span>
                                @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-toggle="modal" data-target="#changeOwner" title="Change Owner" style="margin-left: 50px;"><i class="fa fa-user"></i></button>
                                @include('override.job_order_applicants._bulk-owner-edit-modal')
                                @endif
                                @if($jobOrder->openings_available<=0)
                                <div class="nb-weekly" style="color: red;">*** All Vacancies in this Job Order is filled ***</div>
                                @endif
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Added</th>
                                <th>Updated</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Last Activity</th>
                                <th>Next Step</th>
                                <th><button type="button" class="btn btn-xs btn-info" id="show_full_list"><span>Show Full List</span></button></th>
                                <th><button class="btn btn-xs btn-success pull-right details-email" data-toggle="modal" data-target="#email-Details">
                                    Details For Email
                                </button>
                                <div class="modal fade" role="dialog" id="email-Details" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title email-detail-hed-txt">Details For Email</h4>
                                            </div>
                                            <div class="modal-body email-detail-table-body">
                                                <div class="table-responsive">
                                                    <textarea id='textarea_content' id="content" required   name="content" class='form-control' rows='5'> 
                                                        <table class="table email-detail-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Position</th>
                                                                    <th>Name</th>
                                                                    <th>Designation</th>
                                                                    <th>Total EXP</th>
                                                                    <th>Current Employer</th>
                                                                    <th>Current CTC</th>
                                                                    <th>Expected CTC</th>
                                                                    <th>Notice Period</th>
                                                                    <th>Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </textarea>            
                                                </div>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div></th>
                            </tr>
                        </thead>
                        <tbody id="candidate_det_tbody">
                            @if(count($applicants)>0)
                            @foreach($applicants as $applicant)
                            @php
                            $trBgcolor = '';
                            if($_REQUEST['candidate_id'] && $applicant->details->id == $_REQUEST['candidate_id']){
                                $trBgcolor = 'candidate-tr-bg-color showonscreen ';
                            }
                            @endphp

                            <tr class="{{ $trBgcolor }}next-action-nil{{$applicant->id}}">
                                <td> {{--  {{ $tdBgcolor }} --}}
                                    <div class="checkbox margin0">
                                        <label>
                                        <input type="hidden" class="next_action_joborder_id" id="joborder_id" value="{{$applicant->job_order_id}}"/>

                                            <input type="checkbox" name="aid[]" value="{{$applicant->id}}" data-name="{{$applicant->job_order_id}}"data-secondary-status="{{ $applicant->secondary_status }}" data-next-action="{{ $applicant->next_action }}"  class="candidate_checkbox cursor-pointer">
                                            <input type="hidden" id="candidate_id-{{$applicant->id}}"  value="{{$applicant->details->id}}">
                                            @if(!empty($applicant->interview_date))  
                                            <input type="hidden" id="candidate_Interview_date-{{$applicant->id}}"  value="{{date("d/m/Y", strtotime($applicant->interview_date))}}">
                                            @else
                                            <input type="hidden" id="candidate_Interview_date-{{$applicant->id}}"  value="">
                                            @endif                                           
                                            <a href="/admin/candidates/detail/{{$applicant->details->id}}" target="_blank">
                                                {{ $applicant->details->first_name }}&nbsp;{{ $applicant->details->last_name }}
                                            </a>
                                        </label>
                                    </div>                                  
                                </td>
                                <td>
                                    {{ $applicant->details->cityName }}, {{ $applicant->details->stateName }}
                                </td>
                                <td>
                                    {{ date("d/m/Y", strtotime($applicant->created_at)) }}
                                </td>
                                <td>
                                    {{ date("d/m/Y", strtotime($applicant->updated_at)) }}
                                </td>
                                <td>
                                    {{ $applicant->creator }}
                                    @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-toggle="modal" data-target="#changeOwner{{$applicant->id}}" title="Change Owner"><i class="fa fa-user"></i></button>
                                    @include('override.job_order_applicants._owner-edit-modal')
                                    @endif  
                                </td>
                                <td>
                                    {{ $applicant->secondary_status }}
                                </td>
                                <td>
                                    @if($applicant->lastActivity)
                                    {{ date("d/m/Y", strtotime($applicant->lastActivity->created_at)) }} by <u>{{ $applicant->lastActivity->creator }}</u>
                                    &nbsp;<span class="toggle"><i class="fa fa-plus-circle pointer" aria-hidden="true" ></i> </span>
                                    <div class="popover fade in hiddenRow popover-custom" role="tooltip">
                                        <div class="popover-content extra-content">
                                            <p class="closebtn-comment close-comment"><i class="fa fa-times-circle" aria-hidden="true"></i> </p>
                                            Status: {{ $applicant->lastActivity->new_primary_status }} <i class="fa fa-angle-right"></i> {{ $applicant->lastActivity->new_secondary_status }}<br>
                                            <span id="note-{{$applicant->id}}">{{ $applicant->lastActivity->note }}</span>
                                            @if(($applicant->lastActivity->new_primary_status == 'Place') && ($applicant->lastActivity->new_secondary_status == 'Joined'))
                                            <input type="hidden" name="jo_applicant_join_date" class="jo_applicant_join_date" value="{{ $applicant->lastActivity->prev_joining_date ? date("d/m/Y", strtotime($applicant->lastActivity->prev_joining_date)) : ' ' }}">
                                            @endif
                                            @else
                                            -
                                            @endif
                                            <input type="hidden" name="jo_applicant_join_date1" class="jo_applicant_join_date1" value="{{ $applicant->lastActivity->prev_joining_date ? date("d/m/Y", strtotime($applicant->lastActivity->prev_joining_date)) : ' ' }}">
                                            <input type="hidden" name="jo_applicant_ctc_value" class="jo_applicant_ctc_value" value="{{ $applicant->approved_ctc ? $applicant->approved_ctc : ' ' }}">
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <?php
                                    $state = '';
                                    if($jobOrder->openings_available<=0 && $applicant->next_action!='Send Invoice'){
                                        $state = 'disabled';
                                    }
                                    ?>
                                    @if($applicant->next_action != '-')
                                    <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{ $applicant->id }}" {{$state}}>{{ $applicant->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                                    @else
                                    <input type="hidden" class="next_action_applicant_id" value="{{$applicant->id}}"/>
                                    -
                                    @endif
                                    @if($applicant->callback_date)
                                    <span class="jo-date-highlight">Call back on <b>{{ date("d/m/Y", strtotime($applicant->callback_date)) }}</b></span>
                                    @endif
                                    @if($applicant->feedback_date)
                                    <span class="jo-date-highlight">Feedback on <b>{{ date("d/m/Y", strtotime($applicant->feedback_date)) }}</b></span>
                                    @endif
                                    @if($applicant->scheduled_interview_date)
                                    <span class="jo-date-highlight">Set interview on <b>{{ date("d/m/Y", strtotime($applicant->scheduled_interview_date)) }}</b></span>
                                    @endif
                                    @if($applicant->scheduled_feedback_date)
                                    <span class="jo-date-highlight">Rescheduled for <b>{{ date("d/m/Y", strtotime($applicant->scheduled_feedback_date)) }}</b></span>
                                    @endif
                                    @if($applicant->interview_reschedule_date)
                                    <span class="jo-date-highlight">Interview feedback rescheduled for <b>{{ date("d/m/Y", strtotime($applicant->interview_reschedule_date)) }}</b></span>
                                    @endif
                                    @if($applicant->interview_date)
                                    @if($applicant->interview_date && $applicant->next_action =='Confirm Attendance')
                                    <span class="jo-date-highlight">Attend on <b>{{ date("d/m/Y", strtotime($applicant->interview_date)) }}</b></span>
                                    @else
                                    <span class="jo-date-highlight jo-date-highlight-gray">Interview round: <b>{{ $applicant->interview_round }}</b></span>
                                    <span class="jo-date-highlight jo-date-highlight-blue">Interview on <b>{{ date("d/m/Y h:i:s A", strtotime($applicant->interview_date)) }}</b></span>
                                    @endif
                                    @endif
                                    @if($applicant->interview_followup_date)
                                    <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($applicant->interview_followup_date)) }}</b></span>
                                    @endif
                                    @if($applicant->confirm_offer_followup_date)
                                    <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($applicant->confirm_offer_followup_date)) }}</b></span>
                                    @endif
                                    @if($applicant->offer_confirmation_date)
                                    <span class="jo-date-highlight">Confirm on <b>{{ date("d/m/Y", strtotime($applicant->offer_confirmation_date)) }}</b></span>
                                    @endif
                                    @if($applicant->joining_date)
                                    <span class="jo-date-highlight jo-date-highlight-blue">Joining on <b>{{ date("d/m/Y", strtotime($applicant->joining_date)) }}</b></span>
                                    @endif
                                </td>
                                <td>
                                    @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                                    <button class="btn btn-xs btn-primary btn-change-status" data-id="{{$applicant->id}}">Status</button>
                                    @endif
                                    <button class="btn btn-xs btn-info btn-log" data-id="{{ $applicant->id }}">Log</button>
                                    <button class="btn btn-xs btn-danger btn-unassociate" data-id="{{ $applicant->id }}"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td><button type="button" class="btn btn-xs btn-info pull-right" data-toggle="modal" data-toggle="modal" data-target="#emailToCandidate{{$applicant->candidate_id}}" title="Mail to candidate"><i class="fa fa-envelope"></i></button></td>
                                @include('override.job_order_applicants._associated-candidate-mail-modal')  
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10"class="text-danger"><h4><center>No Data Available.</center></h4></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row jo-toggle-section jo-search-section">
    <div class="col-md-12">
        <div class="panel panel-default jo-panel">
            <div class="panel-heading jo-panel-heading">
                Search Candidates
                <a class="pull-right jo-link" onclick="$('[data-target=search]').click();  return false;">Close</a>
            </div>
            <div>
                <form method="get" id="search_form" action="{{CRUDBooster::mainpath()}}" class="form-horizontal">
                    <input type="hidden" name="job_order_id" id="job_order_id" value="{{ $jobOrder->id }}">
                    <div class="jo-search-fields-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control key-word-input" id="key-word-input" placeholder="Raw Text" name="q" value="{{$_REQUEST['q']}}">
                            </div>
                        </div>
                    </div>
                    <div class="jo-search-fields-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="functional_area" class="form-control" onchange="listFunctionalAreaRolesAndSkills(this.value)">
                                    <option value="">Select Functional Area</option>
                                    @foreach($industry_functional_areas as $industry_functional_area)
                                    <option value='{{$industry_functional_area->id.'--'.$industry_functional_area->name}}' {{($industry_functional_area_name[0] == $industry_functional_area->id)?'selected':''}} >
                                        {{$industry_functional_area->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="functional_area_skills[]" class="form-control" id = "functional_area_skills" name="functional_area_skills" multiple="multiple">
                                    <option value="">Functional Area Skills</option>
                                    @foreach($industry_functional_area_skills as $industry_functional_area_skill)
                                    <option value="{{$industry_functional_area_skill->id.'--'.$industry_functional_area_skill->name}}" {{ (in_array($industry_functional_area_skill->id, $functional_area_skill_ids)) ? 'selected':''}} >
                                        {{$industry_functional_area_skill->name}}
                                    </option>
                                    @endforeach                        
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="margin-left: -7px;">
                                <select name="industry" class="form-control">
                                    <option value="">Select Industry</option>
                                    @foreach($industries as $industry)
                                    <option value="{{$industry->id.'--'.$industry->name}}" {{ $industry->id== $industry_name[0]? 'selected': ''}} >
                                        {{$industry->name}}
                                    </option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="jo-search-fields-row">
                        <div class="col-md-12"  style="padding-left: 5px; padding-right: 25px;">
                            <div class="form-group">
                                <select name="functional_area_roles[]" id="functional_area_role" class="form-control" multiple="multiple">
                                    @foreach($industry_functional_area_roles as $industry_functional_area_role)
                                    <option value='{{$industry_functional_area_role->id.'--'.$industry_functional_area_role->name}}' {{ (in_array($industry_functional_area_role->id, $functional_area_role_ids)) ? 'selected':''}} >
                                        {{$industry_functional_area_role->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="jo-search-fields-row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Min Experience" name="minExpY" value="{{$_REQUEST['minExpY']}}" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Max Experience" name="maxExpY" value="{{$_REQUEST['maxExpY']}}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Min CTC" name="minCtc" value="{{$_REQUEST['minCtc']}}" step="0.01" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Max CTC" name="maxCtc" value="{{$_REQUEST['maxCtc']}}"step="0.01" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-sm btn-primary" name="search_submit" value="1">Search</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="form-control btn btn-sm btn-default" name="reset_search" value="1">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            {{-- search results div --}}
 {{-- <div class="row">
   <div class="col-md-12 padding25">
      <div class="panel panel-default">
         <div class="panel-body box-shadow">
            <div class="col-md-12 client-name">
               <a href="" class="head-name">Jyothy Saseendran</a>
            </div>
            <div class="col-md-8 padding0" >
               <p>
                  <span><img src="/images/box.png"> 4yr 8m </span> 
                  <span class="pad-left25"><img src="/images/location.png"> 4.10 lacs </span> 
                  <span class="pad-left25"><img src="/images/price.png"> Cochin </span>
               </p>
               <div class="form-horizontal" action="/action_page.php">
                  <div class="form-group margin-bot0">
                     <label class="control-label col-sm-2 box-title" for="">Current </label>
                     <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">Customer Support executive / Technical support executive.</p>
                     </div>
                  </div>
                  <div class="form-group margin-bot0">
                     <label class="control-label col-sm-2 box-title" for="">Previous </label>
                     <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">Customer Support executive / Technical support executive.</p>
                     </div>
                  </div>
                  <div class="form-group margin-bot0">
                     <label class="control-label col-sm-2 box-title" for="">Education </label>
                     <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">Customer Support executive / Technical support executive. Customer Support executive / Technical support executive</p>
                     </div>
                  </div>
                  <div class="form-group margin-bot0">
                     <label class="control-label col-sm-2 box-title" for="">Pref Loc </label>
                     <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">Customer Support executive / Technical support executive. Customer Support executive / Technical support executive</p>
                     </div>
                  </div>
                  <div class="form-group margin-bot0">
                     <label class="control-label col-sm-2 box-title" for="">Key Skills </label>
                     <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">Customer Support executive / Technical support executive. Customer Support executive / Technical support executive Customer Support executive / Technical support executive. Customer Support executive / Technical support executive</p>
                     </div>
                  </div>
                  <div class="form-group margin-bot0">
                     <label class="control-label col-sm-2 box-title" for="">May also know </label>
                     <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">Customer Support executive / Technical support executive</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 photo-section">
               <img src="/images/user.png" class="img-circle" alt="User" width="60">
               <p class="photo-title"> Technical Support , IT Help Desk, Trouble Shooting, Hardware </p>
               <p class="margin-top30">
                  <span class="detail-box">
                     <span class="icon-box"> <i class="fa fa-phone" aria-hidden="true" style=""></i> </span>
                     <spam class="pad10"> +918796541235</spam>
                  </span>
               </p>
               <p class="margin-top30">
                  <span class="detail-box">
                     <span class="icon-box"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
                     <spam class="pad10"> sample123@gmail.com </spam>
                  </span>
               </p>
            </div>
            <div class="col-md-12 padding0">
               <hr class="associate-section">
               <p><b>TOTAL ASSOCIATIONS (1)</b></p>
               <div class="col-md-2 associate-sec">
                  <p><b>Title</b></p>
                  <div>
                     <p>Tester</p>
                  </div>
               </div>
               <div class="col-md-2 associate-sec">
                  <p><b>Company</b></p>
                  <div>
                     <p> Autram Infotech Private Limited</p>
                  </div>
               </div>
               <div class="col-md-2 associate-sec">
                  <p><b>Office</b></p>
                  <div>
                     <p>Autram Infotech Private Limited</p>
                  </div>
               </div>
               <div class="col-md-2 associate-sec">
                  <p><b>Owner</b></p>
                  <div>
                     <p>veena</p>
                  </div>
               </div>
               <div class="col-md-2 associate-sec">
                  <p><b>Added On</b></p>
                  <div>
                     <p> 09/10/2018</p>
                  </div>
               </div>
               <div class="col-md-2 associate-sec">
                  <p><b>Current Status</b></p>
                  <div>
                     <p>Pending Review</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> --}}
{{-- search results div ends--}}


<div>
    <div id="parent-form-area">
        <div class="table-responsive search-result-table-container">
            <table id="table-detail" class="table table-striped table-bordered table-jo-details table-search-results">
                <tbody>
                  <?php

                  $wordlist = array("is", "on", "the");
                  foreach ($wordlist as &$word) {
                      $word = '/\b' . preg_quote($word, '/') . '\b/';
                  }
                  $_REQUEST['q'] = preg_replace($wordlist,'',  $_REQUEST['q']);

                  ?>
                  @if(count($searchResults) > 0 && $_REQUEST['search_submit'] == 1)
                  @foreach($searchResults as $row)
                  <tr>
                    <td class="candidate-td">
                      {{-- search results div --}}
                      <div class="row">
                         <div class="col-md-12">
                          <div class="panel panel-default margin0">
                           <div class="panel-body box-shadow">
                            <div class="col-md-12 client-name">
                                <?php 
                                $assigned = DB::table('job_order_applicants')->where('job_order_id',$_REQUEST['job_order_id'])->where('candidate_id',$row->id)->whereNull('deleted_at')->first();
                                ?>
                                @if($assigned)
                                <a href="/admin/candidates/detail/{{$row->id}}" rel="Edit" target="_blank">
                                    <span class="head-name">{!! highlight($row->first_name, $_REQUEST['q']) !!} {!! highlight($row->last_name, $_REQUEST['q']) !!}
                                    </span>
                                </a>
                                @else
                                <a href="/admin/candidates/detail/{{$row->id}}?job_order_id={{$_REQUEST['job_order_id']}}" target="_blank">
                                    <span class="head-name">{!! highlight($row->first_name, $_REQUEST['q']) !!}
                                        {!! highlight($row->last_name, $_REQUEST['q']) !!}
                                    </span>
                                </a>
                                @endif
                                <?php
                                $associate_state = '';
                                if($jobOrder->openings_available<=0){
                                    $associate_state = 'disabled';
                                }
                                ?>
                                @if(!$assigned)
                                <button class="btn btn-info pull-right btn-associate" data-id="{{ $row->id }}" {{$associate_state}}>Associate</button>
                                @else
                                <label class="pull-right">Associated</label>
                                @endif
                            </div>
                            <div class="col-md-8 padding0" >
                             <p>
                              <span><img src="/images/box.png"><b>{{ $row->Exp }}</b>
                                {{ $row->experience_years }} years,
                                {{$row->experience_months }} months</span> 
                                <span class="pad-left25"><img src="/images/location.png">
                                    {!! highlight($row->current_city_name, $_REQUEST['q']) !!}
                                </span> 
                                <span class="pad-left25"><img src="/images/price.png">
                                    <b>
                                       {!! highlight('INR '.$row->current_ctc.' lakhs', $_REQUEST['q']) !!}
                                   </b>
                               </span>
                           </p>
                           <div class="form-horizontal" action="/action_page.php">
                              <div class="form-group margin-bot0">
                               <label class="control-label col-sm-2 box-title" for="">Current:&nbsp;</label>
                               <div class="col-sm-10 pad-lef5">
                                <p class="form-control-static"> 
                                 @if($row->current_designation =='')
                                 <i>Not Mentioned</i>
                                 @else
                                 {!! highlight($row->current_designation,$_REQUEST['q']).' at '.$row->current_employer !!}
                                 @endif

                             </p>
                         </div>
                     </div>

                 <?php
                    $row->prefCity = DB::table('cities')->where('id',$row->preferred_city)->first();
                    if($row->prefCity) {
                        $row->prefCity = $row->prefCity->name;
                    }
                    else {
                        $row->prefCity = '-';
                    }
                ?>
            <div class="form-group margin-bot0">
                           <label class="control-label col-sm-2 box-title" for="">Pref Loc:&nbsp;</label>
                           <div class="col-sm-10 pad-lef5">
                            <p class="form-control-static">{!! highlight($row->prefCity, $_REQUEST['q']) !!}</p>
                        </div>
                    </div>
                     <div class="form-group margin-bot0">
                           <label class="control-label col-sm-2 box-title" for="">Notice Period:&nbsp;</label>
                           <div class="col-sm-10 pad-lef5">
                            <p class="form-control-static">
                                   {{($row->notice_period > 0)? $row->notice_period. ' days': ' - ' }}
                            </p>
                        </div>
                    </div>
                     <div class="form-group margin-bot0">
                                   <label class="control-label col-sm-2 box-title" for="">Education:&nbsp;</label>
                                   <div class="col-sm-10 pad-lef5">
                                    <p class="form-control-static">
                                     {!! highlight($row->highest_qualification, $_REQUEST['q']) !!}
                                 </p>
                             </div>
                    </div>
                     <div class="form-group margin-bot0">
                           <label class="control-label col-sm-2 box-title" for="">Areas:&nbsp;</label>
                           <div class="col-sm-10 pad-lef5">
                            <p class="form-control-static">    
                            @foreach($row->candidate_industry_functional_areas as $area)
                            {!! highlight($area->industry_functional_area, $_REQUEST['q']) !!}@if(!$loop->last), @endif
                            @endforeach
                            </p>
                        </div>
                    </div>

                    <div class="form-group margin-bot0">
                           <label class="control-label col-sm-2 box-title" for="">Industry:&nbsp;
                           </label>
                           <div class="col-sm-10 pad-lef5">
                            <p class="form-control-static"> 
                                @foreach($row->candidate_industries as $industry)
                                {!! highlight($industry->industry, $_REQUEST['q']) !!}
                                @if(!$loop->last), @endif
                                @endforeach
                           </p>
                        </div>
                    </div>
                   
                    <div class="form-group margin-bot0">
                           <label class="control-label col-sm-2 box-title" for="">Roles:&nbsp; 
                           </label>
                           <div class="col-sm-10 pad-lef5">
                            <p class="form-control-static">
                            @foreach($row->candidate_industry_functional_area_roles as $role)
                            {!! highlight($role->role, $_REQUEST['q']) !!}@if(!$loop->last), @endif
                            @endforeach
                           </p>
                        </div>
                    </div>
                    <div class="form-group margin-bot0">
                       <label class="control-label col-sm-2 box-title" for="">Skills: &nbsp; 
                      </label>
                      <div class="col-sm-10 pad-lef5">
                        <p class="form-control-static">
                           @if($row->candidate_industry_functional_area_skills!= '')
                           @foreach($row->candidate_industry_functional_area_skills as $skill)
                           @if($industry_functional_area_skill_name[1]!='' && $industry_functional_area_skill_name[1] === $skill->industry_functional_area_skill)
                           {!! highlight($skill->industry_functional_area_skill, $_REQUEST['q']) !!} 
                           @endif
                           {!! highlight($skill->industry_functional_area_skill, $_REQUEST['q']) !!}
                           (Exp: {{$skill->experience_years}} years &amp; {{$skill->experience_months}} months)@if(!$loop->last), @endif
                           @endforeach
                           @endif
                   </p>
               </div>
           </div>
</div>
</div>
<div class="col-md-4 photo-section">
    @if($row->photo_url)
    <img src="/{{$row->photo_url}}" class="img-circle" alt="User" width="60">
    @else
    <img src="/images/user.png" class="img-circle" alt="User" width="60">
    @endif
    <p class="photo-title">
        @if($row->current_designation =='')
        <i>Not Mentioned</i>
        @else
        {!! highlight($row->current_designation,$_REQUEST['q']) !!} 
        @endif
    </p>
    @if(!empty($row->primary_phone))
    <p class="margin-top30">
      <span class="detail-box">
       <span class="icon-box"> <i class="fa fa-phone" aria-hidden="true" style=""></i> </span>
       <span class="pad10"> 
          {!! highlight($row->primary_phone, $_REQUEST['q'])!!}
      </span>
  </span>
</p>
@endif
@if(!empty($row->secondary_phone))
<p class="margin-top30">
  <span class="detail-box">
   <span class="icon-box"> <i class="fa fa-phone" aria-hidden="true" style=""></i> </span>
   <span class="pad10"> 
       {!!highlight($row->secondary_phone, $_REQUEST['q']) !!}
   </span>
</span>
</p>
@endif
@if(!empty($row->primary_email))
<p class="margin-top30">
  <span class="detail-box">
   <span class="icon-box"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
   <span class="pad10">
    {!!highlight($row->primary_email, $_REQUEST['q']) !!}
</span>
</span>
</p>
@endif
@if(!empty($row->secondary_email))
<p class="margin-top30">
  <span class="detail-box">
   <span class="icon-box"> <i class="fa fa-envelope" aria-hidden="true"></i> </span>
   <span class="pad10">
     {!!highlight($row->secondary_email, $_REQUEST['q']) !!}
 </span>
</span>
</p>
@endif
</div>
<div class="col-md-12 padding0">
    <hr class="associate-section">
    @if($row->totalAssociation > 0)
    <div class="row">
        <div class="col-md-12">
          <p><b>TOTAL ASSOCIATIONS ({{$row->totalAssociation}})</b></p>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12"> 
        <table class="table-candidate-details" width="100%">
            <tr>
                <th>Title</th>
                <th>Company</th>
                <th>Office</th>
                <th>Owner</th>
                <th>Added On</th>
                <th>Current Status</th>
            </tr>
            @foreach($row->latestAssociation as $jo) 
            <?php 
            $creator= DB::table('job_order_applicant_statuses')
            ->where('job_order_applicant_id', $jo->applicant_id)
            ->orderBy('id', 'desc')
            ->first();
            $recruiter = \DB::table('cms_users')->find( $creator->creator_id); ?>
            <tr>
                <td><a href='/admin/job_order_applicants?job_order_id={{$jo->job_order_id}}'>{{ $jo->title }}</a></td>
                <td>
                    @if(CRUDBooster::myPrivilegeId()==4)
                    <!-- <a href='/admin/companies/detail/{{$jo->company_id}}'>-->{{ $jo->company }}<!-- </a> -->
                    @else
                    <a href='/admin/companies/detail/{{$jo->company_id}}'>{{ $jo->company }}</a>
                @endif</td>
                <!-- <td><a href='/admin/companies/detail/{{$jo->company_id}}'>{{ $jo->company }}</a></td> -->
                <td><!-- <a href='/admin/offices/detail/{{$jo->office_id}}'> -->{{ $jo->office }}<!-- </a> --></td>
                <td><!-- <a href='/admin/users/detail/{{$recruiter->id}}'> -->{{ $recruiter->name }}<!-- </a> --></td>
                <td>{{ date("d/m/Y", strtotime($jo->addedOn)) }}</td>
                <td>{{ $jo->secondary_status }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endif
</div>
</div>
</div>
</div>
</div>
{{-- search results div ends--}}
</td>
</tr>
@endforeach
@elseif($_REQUEST['search_submit'] == 1)
<tr id="msg">
    <td style="text-align: center;">
        <p style ="color: red;">
            No Search Result Found
        </p>
    </td>
</tr>
@endif
</tbody>
</table>
<p>
    @if(count($searchResults) > 0)
    {!! urldecode(str_replace("/?","?",$searchResults->appends(Request::all())->render())) !!}
    @endif
</p>
</div>
</div>
</div>
{{-- search result div end --}}
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

@push(bottom)
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />
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
<script>
    $(document).ready(function(){
        sessionStorage['show-seciotn-jd'] = 1;
        sessionStorage['show-seciotn-applicants'] = 1;
        sessionStorage['show-seciotn-search'] = 1;
        var secondary_status_filter="{{$_REQUEST['secondary_status_filter'][0]}}"; 
        var status_datavalue='';
        $(".next_action_applicant_id").each(function(){
          if(secondary_status_filter!=''){
            $(".next-action-nil"+$(this).val()).show(); 
        }
        else{
            $(".next-action-nil"+$(this).val()).hide();
        }
    });
        $('.ownerId').select2();
        $(this).scrollTop(0);

        $('#candidate_det_tbody tr').each(function(){
            if($(this).hasClass('showonscreen')){
                showOnScreen(); // :first
            }
        });
        // $(this).scrollTop(0);

        $('#textarea_content').summernote({
            height: 150,   //set editable area's height
            codemirror: { // codemirror options
                theme: 'monokai'
            }
        });

        $(document).on('click', '#show_full_list', function(){
            $(".next_action_applicant_id").each(function() {
                if($("#show_full_list span").html() == 'Show Full List'){
                    if($('#check_all').prop('checked')){
                        $(".next-action-nil"+$(this).val()).find('.candidate_checkbox').prop("checked", true);
                    } 
                }
                if($("#show_full_list span").html() == 'Hide Full List'){
                    $(".next-action-nil"+$(this).val()).find('.candidate_checkbox').prop("checked", false);
                }
                if((secondary_status_filter!='')&&(($("#show_full_list span").html() == 'Show Full List')||$("#show_full_list span").html() == 'Hide Full List')){
                    $(".next-action-nil"+$(this).val()).show(); 
                }
                else{
                    $(".next-action-nil"+$(this).val()).toggle();  
                }
                
            });
            $("#show_full_list span").html($("#show_full_list span").html() == 'Show Full List' ? 'Hide Full List' : 'Show Full List');
        });

        $(document).on('click', '#check_all', function(e){
            $(".candidate_checkbox").prop('checked', this.checked);
            if($('.candidate_checkbox:checkbox:checked').length==0){

               $('.email-detail-table tbody').empty();

           }

           $(".next_action_applicant_id").each(function() {
            $(".next-action-nil"+$(this).val()).find('.candidate_checkbox').prop("checked", false);
        });
       }); 

        
        $(document).on('click', '.close-btn', function() {
            window.location.reload();
        });

        $('.close-check').on('hidden.bs.modal', function () {
            location.reload();
        });
        
        $(document).on('click', '.candidate_checkbox', function() {
         var aid = $(this).val();
         var jid = $(this).data('name');
         if($(this).prop('checked')){
            $.ajax({
                type: "POST",
                url: "/view-email-details",
                data: {candidate_applicant_id: aid,
                    job_order_id: jid},
                    /*dataType: "json",*/
                    success: function (data) {
                        var notes=$('#note-'+aid).text();
                        $('.email-detail-table tbody').append('<tr id="details-'+aid+'">');

                        $.each(data, function(index, element) {
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.title
                            }));
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.first_name+' '+element.last_name 
                            }));
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.current_designation 
                            }));
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.experience_years+' years '+element.experience_months+' months' 
                            }));
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.current_employer 
                            }));
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.current_ctc 
                            }));
                            $('#details-'+aid+'').append($('<td>', {
                                text: element.expected_ctc 
                            }));

                            if(element.notice_period!=null)
                            {
                                $('#details-'+aid+'').append($('<td>', {
                                    text: element.notice_period+' days' 
                                }));
                            }
                            else{
                                $('#details-'+aid+'').append($('<td>', {
                                    text: ' ' 
                                })); 
                            }

                            $('#details-'+aid+'').append($('<td>', {
                                text: notes 
                            }));
                        });
                        $('.email-detail-table tbody').append('</tr>');     
                    },
                });
        }
        else{
         $('.email-detail-table tbody').find('#details-'+aid).remove();
     }
 });
        $(document).on('click', '#changeOwner .change_owner', function() {  
            if ($('.candidate_checkbox:checkbox:checked').length > 0){

                $('.candidate_checkbox:checkbox:checked').each(function(index, value){     
                  $( "div.message-container").html('');
                  var ownerid=$("#changeOwner").find('select[name="bulkownerid"]').val();
                  if(ownerid){
                    $.post('/custom/change-owner', {
                        id: $("#changeOwner").find('select[name="bulkownerid"]').val(),
                        applicant_id:$(this).val(),
                        joborder_id :$("#joborder_id").val(),
                      
                    }, function(_data) {
                        if(_data=='ok') {
                            $( "div.message-container" ).html('<br><div class="col-sm-12 alert alert-success alert-dismissible pull-left"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Successfully Changed The Owner.!</strong></div><br>');
                        }
                    }); 
                }
                else{
                   $( "div.message-container" ).html('<br><div class="col-sm-12 alert alert-danger alert-dismissible pull-left"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Choose Any Owner.!</strong></div><br>');
               }

           });
            }
            else{
                $('.bulk_owner_id').val('').trigger('change');
                alert('Select Any Candidate.');
                return false;
            } 
        });
        $(document).on('change', '#next_action_status', function() { 
            var applicant_ids = [];
            var secondary_status=[];
            var next_action=[];
            var applicant_names=[];
            var status_check='';
            if($(this).val()==0){
                $(this).val(0);
                return false;
            } 
            if ($('.candidate_checkbox:checkbox:checked').length > 0){
                $('.candidate_checkbox:checkbox:checked').each(function(index, value){
                  applicant_ids[index] = $(this).val();
                  secondary_status[index]=$(this).data('secondary-status');
                  next_action[index]=$(this).data('next-action');
              });
                var status_count=secondary_status.every( (val, i, arr) => val === arr[0]);
                var next_action_count= next_action.every( (val, i, arr) => val === arr[0]);
                if(status_count==true&& secondary_status[0]==='Joined' ){
                    alert('Joined Candidates are not able to Process!');
                    status_check='YES';
                    window.location.reload();
                    return false;
                } 
                if(status_count==true&&next_action_count==true&& next_action[0]==='-' ){
                    alert('Candidates has No Next Action Step to Process !');
                    status_check='YES';
                    window.location.reload();
                    return false;
                }
                if(status_count==false){
                    alert('Current Status of Candidates are different!');
                    status_check='YES';
                    window.location.reload();
                    return false;   
                } 
            }
            else{
                $(this).val(0);
                alert('Select Any Candidate.');
                return false;
            } 
            if(($('.candidate_checkbox:checkbox:checked').length > 0) && ($(this).val()!=0)&&(status_check!='YES')){
                $.ajax({
                    type: "POST",
                    url: "/bulk-next-action-change",
                    data: {applicant_ids: applicant_ids,
                        next_action:$('#next_action_status').val()
                    },
                    /*dataType: "json",*/
                    success: function (data) {
                        console.log(data);
                        if(jQuery.inArray("Unequal",data) != -1) {
                            alert('Next Step of Candidates are not same!');
                            window.location.reload();
                            return false;   
                        }
                        else{
                            var task = $('#next_action_status').val();
                            var openings=$('input[name="openings"]').val();
                            if(openings<=0)
                            {
                                var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
                                $('.pmsg').html(html);
                            }
                            else{
                                $('.pmsg').html('');
                                var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                                var modal = $('#' + modalID);
                                var modalId='#' + modalID;
                                modal.find('.jo-task-name').text(task);
                                modal.find('.jo-applicant-value').text('');
                                $.each(applicant_ids, function(index, value){
                                 applicant_names[index] = $('.btn-applicant-task[data-id="'+ value+'"]').closest('tr').find('td').first().text(); 
                            //modal.find('.jo-applicant-value').append($('.btn-applicant-task[data-id="'+ value+'"]').closest('tr').find('td').first().text()+',');
                        });
                                var str= applicant_names.join(" , ");
                                str = str.replace(/,\s*$/, "");
                                if(task=='Submit'){
                                   modal.find('.jo-applicant-value').text('[candidate_name]');
                                   modal.find('#applicants').text(str);     
                               }
                               else{
                                   modal.find('.jo-applicant-value').text(str);    
                               }
                               modal.find('.close').addClass("close-btn"); 
                               modal.find('.btn-default').addClass("close-btn");
                               modal.find('.btn-apply-task').attr('data-id',applicant_ids);
                               resetTaskModals(modalId);
                               modal.modal('show');
                           }
                       }

                   },
               });
            }

        });
});

function listFunctionalAreaRolesAndSkills(functional_area_id) {
    $.get('{{CRUDBooster::mainpath()}}', {
        functional_area_id: functional_area_id,
        current_action: 'list_functional_roles_skills',
    }, function(_dataFunctionalArea) {
        var selectRoles = $('#functional_area_role');
        selectRoles.empty();
        $.each(_dataFunctionalArea['roles'],function(key, value) {
            selectRoles.append("<option value='" + value.id+"--"+value.name + "'>" + value.name + "</option>");
        });

        var select = $('#functional_area_skills');
        select.empty();
        select.append('<option value="">Functional Area Skills</option>');
        $.each(_dataFunctionalArea['skills'],function(key, value) {
            select.append("<option value='" + value.id+"--"+value.name + "'>" + value.name + "</option>");
        });
    });
}

function resetTaskModals(modal_id)
{   
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
    $('#task_confirm_interview_schedule_modal #task_interview_followup').val($('#candidate_Interview_date-'+datavalue).val());
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

window.initers.push( function(){
    // functionalAreaSkills('');
    $('<button class="btn btn-xs btn-primary" data-target="jd">Job Details</button>').appendTo('.jo-buttons-top-right');
    $('<button class="btn btn-xs btn-primary" data-target="applicants">Applicants [{{ count($applicants) }}]</button>').appendTo('.jo-buttons-top-right');
    $('<button class="btn btn-xs btn-primary" data-target="search">Search Candidates</button>').appendTo('.jo-buttons-top-right');

    if(sessionStorage['show-seciotn-jd'] == '0') $('.jo-toggle-section.jo-jd-section').hide();
    if(sessionStorage['show-seciotn-applicants'] == '0') $('.jo-toggle-section.jo-applicants-section').hide();
    if(sessionStorage['show-seciotn-search'] == '0') $('.jo-toggle-section.jo-search-section').hide();

    $('.jo-buttons-top-right>button').click(function() {
        $('.jo-toggle-section.jo-' + $(this).attr('data-target') + '-section').toggle();
        sessionStorage['show-seciotn-' + $(this).attr('data-target')] = ($('.jo-toggle-section.jo-' + $(this).attr('data-target') + '-section').is(':visible') ? '1' : '0');
        return false;
    });
   /* window.allStatuses = {
        'Pipeline': [
        'Associated'
        ],
        'Qualify': [
        'Pending Review',
        'Reviewed',
        'Declined by C2W',
        'Schedule Call Back',
        'Qualified'
        ],
        'Submission': [
        'Submitted to client',
        'Approved by the client',
        'Reschedule Submission',
        'Rejected by the client'
        ],
        'Interview': [
        'Interview to be Scheduled',
        'Interview Scheduled',
        'Interview Rescheduled',
        'Interview Feedback Rescheduled',
        'Rejected for Interview',
        'Interview in Progress',
        'Shortlisted for Next Round',
        'Waiting for Consensus',
        'To be Offered',
        'On Hold',
        'Rejected',
        'Rejected Hirable',
        'Backed Out'
        ],
        'Offer': [
        'Confirm Offer Follow Up',
        'Offer Made',
        'Offer Accepted',
        'Offer Declined',
        'Offer Withdrawn',
        'No Show',
        'Un Qualified'
        ],
        'Place': [
        'Joined',
        'Backed Out'
        // 'Converted Employee'
        ]
    };*/
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
    $('.btn-change-status').click(function() {
        var status_modal_id='#status_modal';
        resetTaskModals(status_modal_id);
        var openings=$('input[name="openings"]').val();
        var datavalue='';
        datavalue=$(this).attr('data-id');
        status_datavalue=datavalue;
        var task = $.trim($('.btn-applicant-task[data-id="'+datavalue+'"]').text());
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
                        if(str1.toUpperCase()===str2.toUpperCase()){
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
                            if(str1.toUpperCase()===str2.toUpperCase()){
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
                        if(str1.toUpperCase()===str2.toUpperCase()){
                            console.log('tggest',str1.toUpperCase()); 
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

$('.btn-log').click(function() {
    $('.jo-log-table tbody').empty();
    $.get('/custom/get-applicant-log/' + $(this).attr('data-id'), function(_data) {
        if(_data == '') return;
        _data = JSON.parse(_data);
        $('#log_modal .jo-applicant-value').text(_data.details.first_name + ' ' + _data.details.last_name);

        if(_data.log && _data.log.length) {
            var tr = false;
            _data.log.forEach(function(_item) {
                tr = $('<tr/>');
                tr.append('<td>' + _item.created_at + '</td>');
                tr.append('<td>' + _item.creator + '</td>');
                if(_item.prev_primary_status.length) {
                    tr.append('<td>' + _item.prev_primary_status + ' <i class="fa fa-angle-right"></i> ' + _item.prev_secondary_status + '</td>');
                } else {
                    tr.append('<td> - </td>');
                }                   
                tr.append('<td>' + _item.new_primary_status + ' <i class="fa fa-angle-right"></i> ' + _item.new_secondary_status + '</td>');
                tr.append('<td>' + (_item.note ? _item.note : '-') + '</td>');
                tr.appendTo('.jo-log-table tbody');
            });
        }
        $('#log_modal').modal('show');
    });
});

$('.btn-unassociate').click(function() {
    $.post('/custom/unassociate-applicant', {
        id: $(this).attr('data-id')
    }, function() {
        window.location.reload();
    });
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
    if(!$('#candidate_Interview_date-'+status_datavalue).val()){
        $('#status_modal  #task_confirm_attendance').val($('#candidate_Interview_date-'+status_datavalue).val());
        $("#status_modal  #task_confirm_attendance").prop("readonly", false);
        $("#status_modal  #task_confirm_attendance").prop('disabled', false);
    }else{
     $('#status_modal  #task_confirm_attendance').val($('#candidate_Interview_date-'+status_datavalue).val());
     $("#status_modal  #task_confirm_attendance").prop("readonly", true);
     $("#status_modal  #task_confirm_attendance").prop('disabled', true);
 }
 $('#next_action').val($(this).find('option:selected').attr('data-next-step'));
});
    /*$('.btn-save-status').click(function() {
        if($('#primary_status').val() && $('#secondary_status').val()) {
            $.post('/custom/set-applicant-status', {
                id: $(this).attr('data-id'),
                primary_status: $('#primary_status').val(),
                secondary_status: $('#secondary_status').val(),
                next_action: $('#next_action').val(),
                note: $('#status_notes').val()
            }, function(_data) {
                if(_data !== 'ERROR') {
                    window.location.reload();
                }
            });
        } else {
            alert('Kindly Select The Status!');
            return false;
        }
    });*/


    // function acSplit( val ) {
    //  return val.split( /,\s*/ );
    // }
    // function asExtractLast( term ) {
    //  return acSplit( term ).pop();
    // }

    // $( "[data-search-ac]").each(function() {
    //  var source = $(this).attr('data-source');
    //  $(this)
    //      .on( "keydown", function( event ) {
    //          if ( event.keyCode === $.ui.keyCode.TAB &&
    //              $( this ).autocomplete( "instance" ).menu.active ) {
    //              event.preventDefault();
    //          }
    //      })
    //      .autocomplete({
    //          source: function( request, response ) {
    //              $.getJSON( source, {
    //                  term: asExtractLast( request.term )
    //              }, response );
    //          },
    //          search: function() {
    //              var term = asExtractLast( this.value );
    //              if ( term.length < 2 ) {
    //                  return false;
    //              }
    //          },
    //          focus: function() {
    //              return false;
    //          },
    //          select: function( event, ui ) {
    //              var terms = acSplit( this.value );
    //              terms.pop();
    //              terms.push( ui.item.value );
    //              terms.push( "" );
    //              this.value = terms.join( ", " );
    //              return false;
    //          }
    //      });
    // });

    $('.btn-associate').click(function() {
        var openings=$('input[name="openings"]').val();
        if(openings<=0)
        {
            $('.btn-associate').prop("disabled", true);
            var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
            //$('.pmsg').html(html);
            $('.status_pmsg').html(html);
            //$('.pmsg').first().focus();
            //$(".pmsg").get(0).scrollIntoView();
           /* $(document).ready(function(){
                 $('.status_pmsg').scrollTop(0);
             }); */
         }
         else{
            $('.btn-associate').prop("disabled", false); 
            $('.pmsg').html(' '); 
            $('.status_pmsg').html(' ');
            $.post('/custom/associate-candidate', {
                job_order_id: $('#job_order_id').val(),
                candidate_id: $(this).attr('data-id')
            }, function() {
                window.location.reload();
            });
        }
    });

    $('.btn-applicant-task').click(function() {
        var datavalue='';
        var task = $.trim($(this).text());
        datavalue=$(this).attr('data-id');
        var openings=$('input[name="openings"]').val();
        if(openings<=0)
        {
            if(task=='Send Invoice')
            {
                var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                var modal = $('#' + modalID);
                var modalId='#' + modalID;
                modal.find('.jo-task-name').text(task);
                modal.find('.jo-applicant-value').text($(this).closest('tr').find('td').first().text());
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
                $('.status_pmsg').html(' ');
            }
            else{
                var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
                //$('.pmsg').html(html);
               // $(".pmsg").get(0).scrollIntoView();
                /*$(document).ready(function(){
                    // $(this).scrollTop(0);
                });*/
                $('.status_pmsg').html(html);
                var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                var modal = $('#' + modalID);
                modal.find('.jo-task-name').text(task);

                modal.find('.jo-applicant-value').text($(this).closest('tr').find('td').first().text());
                modal.find('.btn-apply-task').attr('data-id', $(this).attr('data-id'));
                modal.modal('hide');
               // $('.btn-change-status[data-id="'+datavalue+'"]').prop("disabled", true);
               // $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled",true); 
           }
       }
       else{
        var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
        var modal = $('#' + modalID);
        var modalId='#' + modalID;
        modal.find('.jo-task-name').text(task);
        modal.find('.jo-applicant-value').text($(this).closest('tr').find('td').first().text());
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
$('#functional_area_skills').select2({
    placeholder: "Select Functional Skills",
});
$('#functional_area_role').select2({    
    placeholder: "Select Functional Roles",
});
$('#functional_area_role').on('change', function (evt) {
    $('.select2-selection__choice').removeAttr('title');
});
$("button[name='reset_search']").click(function(){
    $(this).closest('form').find('input[type=text], select').val('');$('#msg').hide();
    $('li.select2-selection__choice').remove();
    $('#functional_area_skills').select2({
        placeholder: 'Select Functional Skills',
    });
    $('#functional_area_role').select2({    
        placeholder: 'Select Functional Roles',
    });

});

</script>


<script>
    $(document).ready(function(){
        $(".toggle").click(function (){
            $(this).closest('span').next('div.hiddenRow').toggle();
        });

        $(".close-comment").click(function (){
            $(this).closest('div.hiddenRow').hide();
        });
    }); 
    function showOnScreen() {

        // var itemRow = $('#candidate_det_tbody').closest('tr.candidate-tr-bg-color.showonscreen');
        var itemRow = $('.candidate-tr-bg-color.showonscreen').closest('tr');
        var screenshow = $('.candidate-tr-bg-color.showonscreen');

        if(itemRow && screenshow){
            // ensure item row and media row and within visible viewport
            var downPx = itemRow.offset().top - $(window).scrollTop();
            if(downPx < 0) {
                $(window).scrollTop($(window).scrollTop() + downPx - 350);
            }
            else {
                var upPx = $(window).height() - (screenshow.offset().top - $(window).scrollTop() + screenshow.outerHeight(true));
                if(upPx < 0) {
                    $(window).scrollTop($(window).scrollTop() - upPx + 350);
                }
            }
        }
    }

</script>

@endpush
@endif
