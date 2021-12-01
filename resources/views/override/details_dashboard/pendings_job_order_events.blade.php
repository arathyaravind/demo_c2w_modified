@extends('crudbooster::admin_template')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Pending JobOrder Events" }}</title>
@section('content')
<script>
    window.initers = [];
</script>
@include('override.details_dashboard._styles')
@include('override.job_order_applicants._styles')
@include('override.candidates._styles')
@if(count( $events)>0)
<div class="container-fluid">
    <form method="get" action='/admin/pending-joborder-events-csv-view' target="_blank" class="form-horizontal">
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
    <div class="row">
        <p class="search-fixed-pace"></p>
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
                        <th> Sl No. </th>
                        <th>Events</th>
                        <th>Date</th>
                        <th><span class="jo-submission-date"><b>Next Action</b></span></th>
                        <th>Owner</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = ($events->currentpage()-1)* $events->perpage() + 1; ?>
                     @if(count( $events)>0)
                    @foreach($events as $event)
                    <tr>
                        <td> {{$i}}{{--  - {{$event->id}} --}} </td>
                        <td class="detail">
                            <div class="events-details">
                                <u> <b> <span class="jo-type"> {{$event->type}} </span> </b></u> <br>
                                <b>Company:</b> <a href="/admin/companies/detail/{{ $event->company->id }}"><span class="jo-company"> {{$event->company->name }} </span></a><br>
                                <b>Joborder:</b>  <a href="/admin/job_order_applicants?job_order_id={{ $event->job_order->id }}&candidate_id={{$event->candidate->id }}"><span class="jo-order"> {{$event->job_order->title }} </span></a> <br>
                                 @if(!empty($event->candidate))
                                <b>Candidate:</b> <span class="jo-candidate"> {{$event->candidate->first_name }}
                                {{$event->candidate->last_name }} </span>
                                @else
                                <span class="no-candidate">--</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            {{ $event->event_date ? date('d/m/Y',strtotime($event->event_date)) : ''}}
                        </td>
                        <td>
                            @if($event->type==='Intro Call'&& $event->job_order->status==='Intro Call Scheduled')
                            <span class="jo-submission-date">
                            <button class="btn btn-xs btn-primary" onclick="$('#submission_modal').modal('show');$('#submission_modal .submission-event').val({{ $event->job_order->id }});$('#submission_modal #intro_call').val('{{($event->job_order->intro_call_date != '0000-00-00')? date('d/m/Y',strtotime($event->job_order->intro_call_date)): '' }}');$('#submission_modal #submission').val('{{ $event->job_order->submission_date ? date('d/m/Y',strtotime($event->job_order->submission_date)) : ''}}');">
                              Submission&nbsp;&nbsp;
                            </button>
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
                                <button class="btn btn-xs btn-success" data-eventjoborderid="{{ $event->job_order->id }}" onclick="$('#resubmission-date_modal').modal('show'); $('#resubmission-date_modal #resubmission-event').val('{{ $event->job_order->id }}');$('#resubmission-date_modal .resubmission-type').val('{{$resubmission_status}}')">
                                    Resubmission/Follow-Up Date
                                </button>
                            @endif 
                            </span>  
                        </td>
                        <td>
                            {{$event->owner}}
                        </td>
                    </tr>
                   
                    <?php $i++; ?>
                    @endforeach
                     @else
                    <tr class="no_data">
                    <td colspan="5"><h4><center>No Data Available.</center></h4></td></tr> {{-- class="text-danger" --}}
                    @endif
                </tbody>
            </table>
            <p>{!! urldecode(str_replace("/?","?",$events->appends(Request::all())->render())) !!}</p>
        </div>
    </div>
</div>
{{-- 

    approved By Client
    interview -> to be offered
    one step above the Place->joined

 --}}
@include('override.job_order_applicants._resubmission-date-modal')

@endsection
@push('bottom')
<script>	
    var html = '<h1><i class="fa fa-dashboard"></i> Pending JobOrder Events List</h1>';
    $(".content-header h1").remove();
    $('.content-header').append(html);
   // $('td.detail').find('span.no-candidate').closest('tr').attr('id', 'highlight');
    $("tr").not(':first').hover(
        function () {
            if($('#submission_modal').hasClass('in')){
             $(this).css("background","");    
            }
            else if($('tr').hasClass('no_data')){
             $(this).css("background","");    
            }
            else{
             $(this).css('background-color', '#ca868c');    
            }
        }, 
        function () {
            $(this).css("background","");
        }
    );
    
   window.initers.push(function() {
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
        $('#intro_call, #submission').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            startDate: '0d',
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
    });
   if(window.initers && window.initers.length) {
        window.initers.forEach(function(_initer) {
            _initer();
        });
    }
    </script>
    @endpush