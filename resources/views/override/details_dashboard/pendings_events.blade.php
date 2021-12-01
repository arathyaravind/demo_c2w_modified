@extends('crudbooster::admin_template')
@section('content')
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Pending Events" }}</title>
@show
<script>
    window.initers = [];
</script>
@include('override.details_dashboard._styles')
@include('override.job_order_applicants._styles')
@include('override.candidates._styles')
@if(count( $events)>0)
<div class="container-fluid">
    <form method="get" action='/admin/pending-events-csv-view' target="_blank" class="form-horizontal">
        <input type="hidden" name="status" value="{{ $_REQUEST['status'] }}">
        <input type="hidden" name="owner" value="{{ $_REQUEST['owner'] }}">
        <button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
            Export CSV
        </button>
    </form>
</div>
@endif
<div class="" data-spy="affix" data-offset-top="197">
    <div class="">    
        <form action="{{Request::fullUrl()}}" method="get">
            <div class="pull-right" style="margin-top: 12px;padding-left: 10px;">
                <button type="button" class="filter-reset-btn" onClick="window.location='{{Request::url()}}'"><span> Reset </span></button>
            </div>
            <div class = "col-md-2 pad0 pad-right6 pull-right filter-select">
                <select class='form-control' name='status' id ='status' onchange="this.form.submit();">
                    <option value = ''> Status </option>
                    <option value ='Intro Call' {{ ($_REQUEST['status'] == 'Intro Call')? 'selected' : '' }} > Intro Call   </option>    
                    <option value ='Submission' {{ ($_REQUEST['status'] == 'Submission')? 'selected' : '' }} > Submission   </option> 
                    <option value ='Job Order Re-submission' {{ ($_REQUEST['status'] == 'Job Order Re-submission')? 'selected' : '' }}> Job Order Re-submission   </option>  
                    <option value ='Job Order Follow-up' {{ ($_REQUEST['status'] == 'Job Order Follow-up')? 'selected' : '' }} > Job Order Follow-up  </option>     
                    <option value ='Call Back' {{ ($_REQUEST['status'] == 'Call Back')? 'selected' : '' }} > Call Back   </option>
                    <option value ='Submit' {{ ($_REQUEST['status'] == 'Submit')? 'selected' : '' }} > Submit   </option> 
                    <option value ='Get Submission Feedback' {{ ($_REQUEST['status'] == 'Get Submission Feedback')? 'selected' : '' }} > Get Submission Feedback   </option> 
                    <option value ='Interview' {{ ($_REQUEST['status'] == 'Interview')? 'selected' : '' }} > Interview   </option>
                    <option value ='Rescheduled Interview' {{ ($_REQUEST['status'] == 'Rescheduled Interview')? 'selected' : '' }} > Rescheduled Interview </option>     
                    <option value ='Confirm Interview' {{ ($_REQUEST['status'] == 'Confirm Interview')? 'selected' : '' }} > Confirm Interview   </option>     
                    <option value ='Set Interview' {{ ($_REQUEST['status'] == 'Set Interview')? 'selected' : '' }} > Set Interview   </option>  
                    <option value ='Confirm Attendance' {{ ($_REQUEST['status'] == 'Confirm Attendance')? 'selected' : '' }} > Confirm Attendance   </option>  
                    <option value ='Interview Follow-up' {{ ($_REQUEST['status'] == 'Interview Follow-up')? 'selected' : '' }} >Interview Follow-up</option> 
                    <option value ='Interview On Hold' {{ ($_REQUEST['status'] == 'Interview On Hold')? 'selected' : '' }} >Interview On Hold</option>  
                    <option value ='Interview Feedback Rescheduled' {{ ($_REQUEST['status'] == 'Interview Feedback Rescheduled')? 'selected' : '' }} >Interview Feedback Rescheduled</option>
                    <option value ='Interview Next Round' {{ ($_REQUEST['status'] == 'Interview Next Round')? 'selected' : '' }} >Interview Next Round</option>   
                    <option value ='Offer Follow-up' {{ ($_REQUEST['status'] == 'Offer Follow-up')? 'selected' : '' }} >Offer Follow-up</option>    
                    <option value ='Confirm Offer' {{ ($_REQUEST['status'] == 'Confirm Offer')? 'selected' : '' }} > Confirm Offer   </option>
                    <option value ='Confirm Offer Follow-up' {{ ($_REQUEST['status'] == 'Confirm Offer Follow-up')? 'selected' : '' }} >Confirm Offer Follow-up</option>       
                    <option value ='Confirm Joining' {{ ($_REQUEST['status'] == 'Confirm Joining')? 'selected' : '' }} > Confirm Joining   </option>    
                </select>
            </div>
            <div class="col-md-2 pad0 pull-right filter-select">
                <select class='form-control' name='owner' id = 'owner' onchange="this.form.submit();">
                    <option value = ''> Owner </option>
                    @foreach($owners as $owner)
                    <option value = '{{ $owner->id}}' {{ $_REQUEST['owner'] == $owner->id ? 'selected' : ''}} > {{ $owner->name}} </option>
                    @endforeach    
                </select>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="owners-stats-main">
        <!-- <div class="col-md-8 owner-stats padding0">
            <div class="panel panel-default margin-top15">
                 <div class="panel-heading panel-hed-custom"> 
                    <b>Owner Stats</b>
                </div>               -->
                <!-- <div class="panel-body">
                    <canvas id="owner-stats" width="700" height="200"></canvas>
                </div> -->
            <!-- </div>
        </div> --> 
    </div>
</div>

<div class="container-fluid">
    <div class="row">
       
        {{-- <p class="search-fixed-pace"></p> --}}

        <div class="col-md-12">
        <div class="table-responsive">
            {{-- @if($candidatesCount<100)
            <form method="get" action='/admin/candidateListPdfView' target="_blank" class="form-horizontal">
            <button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
            Print PDF
            </button>
            <input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
            <input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
            <input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
            </form>
            @endif --}} 

            <table class="table table-striped" id="pending-task-table">
                <thead>
                    <tr>
                    @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                        <th> </th>
                    @endif
                        <th> Sl No. </th>
                        <th>Events</th>
                        <th>Date</th>
                        <th><span class="jo-submission-date"><b>Next Action</b></span></th>
                        <th>Owner</th>
                    </tr>
                </thead>
                <tbody>
                    @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                      <tr>
                       {{--  <span class="jo-submission-date pull-left" style="margin-left:3px; ">
                            <input type="checkbox" name="check_all" id="check_all" autocomplete="off"> &nbsp;
                            <label> Bulk Action </label>
                        </span> --}}
                     
                            <span style="border:1px solid #ccc; padding: 10px;">
                                <div class="checkbox" style="display: inline-block;">
                                 <label><input type="checkbox" name="check_all" id="check_all" autocomplete="off">Bulk Action</label>
                                </div>
                                <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-toggle="modal" data-target="#changeOwner" title="Change Owner" style="margin-left: 30px;"><i class="fa fa-user"></i></button>
                                @include('override.job_order_applicants._bulk-owner-edit-modal')
                            </span>
                      </tr>
                    @endif
                    <tr>
                    <?php $i = ($events->currentpage()-1)* $events->perpage() + 1; ?>
                    @if(count( $events)>0)
                    @foreach($events as $event)
                    <?php  
                     $openings= \DB::table('job_orders')->find($event->job_order->id);
                     $openings_available=$openings->openings_available;
                 ?>
               <input type="hidden" name="openings" value='{{$openings_available}}' id="openings{{$event->job_order_applicant->id }}"> 
                    @if(CRUDBooster::myPrivilegeName() === 'Super Administrator')
                        @if(!empty($event->candidate))
                            <td>
                             <input type="checkbox" name="aid[]" value="{{$event->job_order_applicant->id}}" data-name="{{$event->job_order_applicant->job_order_id}}"data-candidate-id="{{ $event->job_order_applicant->candidate_id }}" data-event-id="{{$event->id}}"class="candidate_checkbox cursor-pointer">
                            </td>
                            @else
                            <td></td>
                        @endif
                    @endif
                        <td> {{$i}}{{--  - {{$event->id}} --}} </td>
                        <td class="detail">
                            <div class="events-details">
                                <u> <b> <span class="jo-type"> {{$event->type}} </span> </b></u> <br>
                                <b>Company:</b> <a href="/admin/companies/detail/{{ $event->company->id }}"><span class="jo-company"> {{$event->company->name }} </span></a> <br>
                                @if(!empty($event->candidate))
                                <b>Joborder:</b> <a href="/admin/job_order_applicants?job_order_id={{ $event->job_order->id }}&candidate_id={{$event->candidate->id }}"><span class="jo-order"> {{$event->job_order->title }} </span></a> <br>
                                @else
                                <b>Joborder:</b><a href="/admin/job_order_applicants?job_order_id={{ $event->job_order->id }}"><span class="jo-order"> {{$event->job_order->title }} </span></a> <br>
                                @endif
                                @if(!empty($event->candidate))
                                <b>Candidate:</b> <a href="/admin/candidates/detail/{{ $event->candidate->id }}"><span class="jo-candidate"> {{$event->candidate->first_name }}
                                {{$event->candidate->last_name }} </span></a>
                                @else
                                <span class="no-candidate">--</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            {{ $event->event_date ? date('d/m/Y',strtotime($event->event_date)) : ''}}
                        </td>
                        <td>
                            @if(!empty($event->job_order_applicant))
                            @if(($event->job_order_applicant->next_action != " ") || ($event->job_order_applicant->next_action != '-'))
                            <span class="jo-submission-date">
                                <?php
                                $state = '';
                                if($event->opening_status=='inactive' && $event->job_order_applicant->next_action!='Send Invoice'){
                                    $state = 'disabled';
                                }
                                ?>
                                <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{ $event->job_order_applicant->id }}" {{ $state }}>{{ $event->job_order_applicant->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                            @else
                            -
                            @endif
                            @if($event->job_order_applicant->callback_date)
                            <span class="jo-date-highlight">Call back on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->callback_date)) }}</b></span>
                            @endif
                            @if($event->job_order_applicant->feedback_date)
                            <span class="jo-date-highlight">Feedback on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->feedback_date)) }}</b></span>
                             @endif
                            @if($event->job_order_applicant->scheduled_interview_date)
                            <span class="jo-date-highlight">Set interview on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->scheduled_interview_date)) }}</b></span>
                            @endif
                            @if($event->job_order_applicant->scheduled_feedback_date)
                            <span class="jo-date-highlight">Rescheduled for <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->scheduled_feedback_date)) }}</b></span>
                            @endif
                            @if($event->job_order_applicant->interview_reschedule_date)
                            <span class="jo-date-highlight">Interview feedback rescheduled for <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->interview_reschedule_date)) }}</b></span>
                            @endif
                            @if($event->job_order_applicant->interview_date)
                                @if($event->job_order_applicant && $event->job_order_applicant->next_action =='Confirm Attendance')
                                <span class="jo-date-highlight">Attend on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->interview_date)) }}</b></span>
                                @else
                                <input type="hidden" id="interview_date-{{$event->job_order_applicant->id}}" value="{{date("d/m/Y", strtotime($event->job_order_applicant->interview_date))}}"/>
                                <span class="jo-date-highlight jo-date-highlight-gray">Interview round: <b>{{$event->job_order_applicant->interview_round }}</b></span>
                                <span class="jo-date-highlight jo-date-highlight-blue">Interview on <b>{{ date("d/m/Y h:i:s A", strtotime($event->job_order_applicant->interview_date)) }}</b></span>
                                @endif
                            @endif
                            @if($event->job_order_applicant->interview_followup_date)
                            <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->interview_followup_date)) }}</b></span>
                            @endif
                             @if($event->job_order_applicant->confirm_offer_followup_date)
                            <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->confirm_offer_followup_date)) }}</b></span>
                            @endif
                            @if($event->job_order_applicant->offer_confirmation_date)
                            <span class="jo-date-highlight">Confirm on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->offer_confirmation_date)) }}</b></span>
                            @endif
                            @if($event->job_order_applicant->joining_date)
                            <span class="jo-date-highlight jo-date-highlight-blue">Joining on <b>{{ date("d/m/Y", strtotime($event->job_order_applicant->joining_date)) }}</b></span>
                            @endif
                            @if(($event->job_order_applicant->lastActivity->new_primary_status == 'Place') && ($event->job_order_applicant->lastActivity->new_secondary_status == 'Joined'))
                                <input type="hidden" name="jo_applicant_join_date" class="jo_applicant_join_date" value="{{ $event->job_order_applicant->lastActivity->prev_joining_date ? date("d/m/Y", strtotime($event->job_order_applicant->lastActivity->prev_joining_date)) : ' ' }}">
                            @endif
                            <input type="hidden" name="jo_applicant_ctc_value" class="jo_applicant_ctc_value" value="{{ $event->job_order_applicant->approved_ctc ? $event->job_order_applicant->approved_ctc : ' ' }}">
                            </span>
                            @else
                            @if($event->type==='Intro Call'&& $event->job_order->status==='Intro Call Scheduled')
                            <span class="jo-submission-date">
                            <button class="btn btn-xs btn-primary" onclick="$('#submission_modal').modal('show');$('#submission_modal .submission-event').val({{ $event->job_order->id }});$('#submission_modal #intro_call').val('{{($event->job_order->intro_call_date != '0000-00-00')? date('d/m/Y',strtotime($event->job_order->intro_call_date)): '' }}');$('#submission_modal #submission').val('{{ $event->job_order->submission_date ? date('d/m/Y',strtotime($event->job_order->submission_date)) : ''}}');">
                              Submission&nbsp;&nbsp;
                            </button>
                            @php
                            $submission='0';
                            @endphp
                            @include('override.job_order_applicants._submission-date-modal')
                            </span>
                            @endif
                            @if($event->type==='Submission'||$event->type==='Job Order Re-submission'|| $event->type==='Job Order Follow-up'&& $event->job_order->status==='Hiring In Progress')
                            @php
                            $resubmission_followup = DB::table('job_order_submission_history')
                            ->where('job_order_id', $event->job_order->id)
                            ->where('active', 1)
                            ->orderBy('id', 'desc')
                            ->first();
                            $pending_event=0;
                            if($resubmission_followup->submission_status == SUBMISSION_RESUBMISSION){
                                $submissionType = 'Re-submission';
                                $resubmission_status=SUBMISSION_RESUBMISSION;
                            }
                            elseif($resubmission_followup->submission_status == SUBMISSION_FOLLOW_UP){
                                $submissionType = 'Follow-up' ;
                                $resubmission_status=SUBMISSION_FOLLOW_UP;
                            }
                            elseif($resubmission_followup->submission_status =='Submission'){
                                $submissionType = 'Submission' ;
                                $resubmission_status=' ';
                            }
                            @endphp
                            <span class="jo-submission-date"> 
                            @if(($resubmission_followup) && ($resubmission_followup->submission_status != 'Submission'))
                            {{ $submissionType }} Date :
                                <span>{{ date('d/m/Y',strtotime($resubmission_followup->date))}}</span><br/>
                            @endif
                                <button class="btn btn-xs btn-success" data-eventjoborderid="{{ $event->job_order->id }}" onclick="
                                   $('#resubmission-date_modal').modal('show'); 
                                   $('#resubmission-date_modal #resubmission-pendingevent').val('{{ $event->job_order->id }}');$('#resubmission-date_modal .resubmission-type').val('{{$resubmission_status}}')">
                                    Resubmission/Follow-Up Date
                                </button>
                            @endif 
                            </span>   
                            @endif
                        </td>
                        <td>
                            {{$event->owner}}
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    @else
                    <tr class="no_data">
                    <td colspan="5"><h4><center>No Data Available.</center></h4></td></tr> {{--  class="text-danger" --}}
                    @endif
                </tbody>
            </table>
            <p>{!! urldecode(str_replace("/?","?",$events->appends(Request::all())->render())) !!}</p>
        </div>
    </div>
    </div>
</div>
{{-- 

    approved By Client
    interview -> to be offered
    one step above the Place->joined

 --}}
@include('override.job_order_applicants._resubmission-date-modal')
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
@push('bottom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>	
        var html = '<h1><i class="fa fa-dashboard"></i> Pending Events List</h1>';
        $(".content-header h1").remove();
        $('.content-header').append(html);
        $('td.detail').find('span.no-candidate').closest('tr').attr('id', 'highlight');
    

        window.initers.push( function(){
            if($('#pending-task-table tr').hasClass('no_data')){
                var url = window.location.href;
                domainUrl = url.split('?');
                var urlParams = new URLSearchParams(window.location.search);
                if(urlParams.has('page')){
                    var page = urlParams.get('page');
                    if(page > 1){
                        page = page - 1;
                    }
                    urlParams.delete('page');
                    urlParams.set('page', page);
                    window.location = (domainUrl[0]+'?'+urlParams);
                }
            }
            /*var fromdate=$("#fromdate").val();
            var todate=$("#todate").val();
            var recruiter=$("#owner").val();
           //alert(fromdate);
           if(fromdate==' '||todate==' '||recruiter==' ')
           {
       
           }
           else{
            var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
            }
            }*/
            $("tr").not(':first').hover(
            function () {
            var detail=$(this).find('td.detail span.no-candidate').length;
            if($('tr').hasClass('no_data')){
                $(this).css("background","");    
            }
            else{
            if(detail>0){
            if($('#submission_modal').hasClass('in')){
                $(this).css("background","");    
            }
            else{
            $(this).find('td.detail span.no-candidate').closest('tr#highlight').css('background-color', '#ca868c');  
            }
            }
            else{
                $(this).css("background","#ddeae4");
            }
            }
            }, 
            function () {
                $(this).css("background","");
            }
        );
        // functionalAreaSkills('');
        window.allStatuses = {
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
                'Rejected by the client'
            ],
            'Interview': [
                'Interview to be Scheduled',
                'Interview Scheduled',
                'Rejected for Interview',
                'Interview in Progress',
                'Waiting for Consensus',
                'To be Offered',
                'On Hold',
                'Rejected',
                'Rejected Hirable',
                'Backed Out'
            ],
            'Offer': [
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
        };
        $('#intro_call, #submission').datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                startDate: '0d',
        });

        $('.ownerId').select2();

        $(document).on('click', '#check_all', function(e){
            $(".candidate_checkbox").prop('checked', this.checked);
            $(".next_action_applicant_id").each(function() {
                $(".next-action-nil"+$(this).val()).find('.candidate_checkbox').prop("checked", false);
            });
       });
        $(document).on('click', '#changeOwner .change_owner', function() {  
            if ($('.candidate_checkbox:checkbox:checked').length > 0){

                    $('.candidate_checkbox:checkbox:checked').each(function(index, value){     
                          $( "div.message-container").html('');
                          var ownerid=$("#changeOwner").find('select[name="bulkownerid"]').val();
                          if(ownerid){
                            $.post('/custom/change-event-owner', {
                                id: $("#changeOwner").find('select[name="bulkownerid"]').val(),
                                applicant_id:$(this).val(),
                                event_id:$(this).data('event-id'),
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

        $('#intro').submit(function () {

            if( $('#intro_call').val().length === 0 ) {
               var html = '<br/><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select any date for <strong>Reschedule Intro Call!</strong></div>';
                $('.msg-intro').html(html);  
               return false;
            }
       });
    
        $('#reseting').click(function () {
            $('.msg').html(''); 
        });
        $('#setform').submit(function () {

            if( $('#submission').val().length === 0 ) {
                 var html = '<br/><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select any date for <strong>Submission!</strong></div>';
                 $('.msg').html(html); 
                 return false;
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
                    modal.find('.jo-applicant-value').text(candidate);
                    if($(this).closest('tr').find('td .jo_applicant_join_date').val() != ''){
                        modal.find('.jo-applicant-join-date').text($(this).closest('tr').find('td .jo_applicant_join_date').val());
                    }
                    else{
                        $(this).closest('tr').find('td .jo_applicant_join_date').val('');
                    }
                    modal.find('.jo-ctc-value').text($(this).closest('tr').find('td .jo_applicant_ctc_value').val());
                    modal.find('.btn-apply-task').attr('data-id', $(this).attr('data-id'));
                    modal.find('.jo-applicant-value').text(candidate);
                    resetTaskModals(modalId);
                    modal.modal('show');
                    $('.pmsg').html(' ');
                    $('.btn-applicant-task[data-id="'+datavalue+'"]').prop("disabled", false);
                }
                else{
                    var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No Openings Available!</strong></div>';
                    $('#pmsg'+datavalue).html(html);
                    var modalID = ['task', task.toLowerCase().replace(/\s+/g, '_'), 'modal'].join('_');
                    var modal = $('#' + modalID);
                    modal.find('.jo-task-name').text(task);

                    modal.find('.jo-title-value').text(order);
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
                    modal.find('.jo-title-value').text(order);
                modal.find('.jo-applicant-value').text(candidate);
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
    </script>
    <script src="{{ asset ('/js/chart2.7.2.js')}}"></script>
    <script type="text/javascript">
        
        var chartArray = [];
        $(document).ready(function() {

            // $(".content-header").html('Owner Stats Reports');
            getOwnerReports();

        });
        function getOwnerReports() {

            // $('.loader-container').show();
            if(chartArray.length > 0)  {
                $.each(chartArray,function(key,val){
                    if(val) val.destroy();
                });
            }
            var owners = [];
            var owner = [];
            var ownerIds = [];
            var ownerNames = [];
            var ownerCounts = [];
            var graphColors = [];

            $.get('/pending-events/owner-reports',{},function(_result) {
                $('.loader-container').hide();
                $('.custom-report-continer').show();
                var ownerReports = JSON.parse(_result);
                $.each(ownerReports, function (key, val) {
                    owner = key.split("_")
                    owners.push(key)
                    ownerIds.push(owner[0])
                    ownerNames.push(owner[1])
                    ownerCounts.push(val.length)
                    graphColors.push('#6ccff0')
                    // if (val.length > 0 && val.length <= 20) graphColors.push('#6ccff0')
                    // else if (val.length >= 21 && val.length <= 30) graphColors.push('#389fc1')
                    // else if (val.length >= 31) graphColors.push('#1681a4')
                    
                });
                chartArray.push(barGraph('owner-stats','Pending Events',ownerNames,ownerCounts,graphColors,owners));
            });
        }

        function barGraph(_container, _label, _Xlabels, _data, _backgroundColor, _owners=null) {
            // var canvas = document.getElementById(_container);
            // var ctx = canvas.getContext('2d');
            // ctx.clearRect(0, 0, canvas.width, canvas.height);

            // if(_backgroundColor.length > 1) { 
            //     backgroundColor = _backgroundColor; 
            // } else {
            //     backgroundColor = _backgroundColor[0]; 
            // }
            var options = {
                type: 'bar',
                data: {
                    labels: _Xlabels,
                    datasets: [{
                        label: _label,
                        backgroundColor: _backgroundColor,
                        data: _data
                    }]
                },
                options: {
                    responsive: true,
                    legend: { display: false },
                    scales : {
                        xAxes: [{
                            ticks: {
                                autoSkip: false,
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                            }
                        }]   
                    },
                }
            }    
            var ctx = document.getElementById(_container);
            
            var myChart = new Chart(ctx, options);
            var canvas = document.getElementById('owner-stats');
            var ownerId = '';
            canvas.onclick = function(evt) {
                var activePoint = myChart.getElementAtEvent(evt)[0];
                var data = activePoint._chart.data;
                var datasetIndex = activePoint._datasetIndex;
                // var label = data.datasets[datasetIndex].label;
                // var value = data.datasets[datasetIndex].data[activePoint._index];
                // var label = data.datasets[datasetIndex]._meta[activePoint._index].data[activePoint._index]._model.label;
                var label = activePoint._model.label;
                $.each(_owners, function (key, val) {
                    owner = val.split("_")
                    if(label == owner[1]){
                        ownerId = owner[0]
                    }
                });

/*    console.log(activePoint);
    console.log(data);
    console.log(datasetIndex); //0*/
    console.log(label);
    console.log(ownerId);
    // console.log(labelValue);

                window.location.href='/admin/pending-events?status=&owner='+ownerId;
            }
            return new Chart(ctx, options);
        }
    function resetTaskModals(modal_id)
    {   

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
            var datavalue='';
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