@extends('crudbooster::admin_template')
@section('content')
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "Connecting2Work: Dashboard" }}</title>
@show
@push('head')
<style type="text/css">
   .fc-today-button.fc-button.fc-state-default.fc-corner-left.fc-corner-right {
      text-transform:capitalize;
   }

   .applicant-process-details-container, .stats-container{
   border: 1px solid transparent;
   border-radius: 4px;
   -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
   box-shadow: 0 1px 1px rgba(0,0,0,.05);
   padding: 10px;
   margin-bottom: 10px;
   }
   .stats-count-container-single {
   padding: 6px;
   }
   /*.stas-count-content {
   min-height: 50px; 
   }*/
   .stats-count-row{
   padding: 15px;
   }
   .applicant-process-details-container{
   line-height: 2;
   }
   .calendar-container {
   border: none;
   margin-bottom: 10px; 
   }
   table.table-bordered.upcoming-events-table td{
   padding: 10px;
   }
   table.table-bordered.upcoming-events-table th, table.table-bordered.upcoming-events-table td {
   border: 1px solid #ddd;
   }
   table.table-bordered.upcoming-events-table{
   border: 1px solid #ddd;
   }
   .event-filters {
   padding: 1px;
   }
   .content-wrapper {
   min-height: 1700px !important;
   overflow: auto;
   }
   .panel-hed-cus{
   background-color: #222d32 !important;
   font-size: 18px;
   color: #fff !important;
   }
   .panal-subhed
   {
   font-size: 15px;
   font-weight: bold;
   text-align: center;
   }
   .status-no{
   font-size: 21px;
   font-weight: bold;
   text-align: center;
   }
   .panal-subhed1{
   font-size: 13px;
   text-align: center;
   font-weight: 700;
   }
   .pad0
   {
   padding: 0px;
   }
   .font18
   {
   font-size: 18px;
   }
   .sub-panel-hed
   {padding: 7px 15px;
   font-size: 17px;
   font-weight: 700;}
   .align-right
   {
   text-align: right;
   }
   .mar-top10
   {
   margin-top: 10px;
   }
   .list-candidate
   {
   border-bottom: 1px solid #e4e4e4;
   margin: 0px;
   font-size: 15px;
   color: #333;
   padding: 5px 0px 5px 0px;
   }
   .form-border
   {
   border-bottom: 1px solid #ddd;
   padding-bottom: 15px;
   }
   .pad-lef-rig-5
   {
   padding-left: 5px;
   padding-right: 5px; 
   }
   .mar-top15
   {
   margin-top: 15px;
   }
   .pad-right6
   {
   padding-right: 6px;
   }
   .activity-log
   {
   font-size: 15px;
   border-bottom: 1px solid #ddd;
   padding-bottom: 6px;
   padding-top: 6px;
   }
   .pad-top10{
   padding-top: 10px
   }
   .numberCircle {
   border-radius: 50%;
   behavior: url(PIE.htc);
   width: 49px;
   height: 49px;
   padding: 7px 0px 6px 0px;
   background: #fff;
   border: 2px solid #f39c12;
   color: #fff;
   text-align: center;
   font-size: 21px;
   margin: auto;
   background-color: #f39c12;
   margin-top: 3px;
   }

   .numberCircle1 {
    border-radius: 3px;
    behavior: url(PIE.htc);
    width: 54px;
    height: 30px;
    padding: 6px 0px 6px 0px;
    color: #000;
    text-align: center;
    font-size: 19px;
    margin: auto;
    /* background-color: #f39c12; */
    line-height: 16px;
    border: 1px solid #ccc;
    background-color: lightsteelblue;
}
   .color-white{
   color: #fff;
   }
   .padlet-rig3
   {
      padding: 0px 5px 0px 5px;
   }
   .padlet-rig5
   {
      padding: 0px 5px 0px 5px;
   }
   .second-section-joborder
   {
      padding: 0px;
    padding-top: 25px;
    padding-bottom: 25px;
   }  
   .pad-rig5{
      padding-right: 5px;
   }
   .to-input{
      padding-left: 0px; padding-right: 5px;
   }
   .pad-lef0
   {
      padding-left: 0px;
   }
   .candidate-sta
   {
      line-height: 15px;
    padding-top: 7px;
   }

   .activity-log {
       box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
       transition: 0.3s;
       border-radius: 5px;
       padding-bottom: 15px;
       margin-bottom: 5px;
       background: #f0f1ee;
   }

   .activity-log:hover {
       box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
   }
   .activity-log-container {
      height: 1050px;
      overflow-y: scroll;
   }
   .fc-row .fc-content-skeleton
   {
      overflow-y: auto;
      max-height: 380px;
      overflow-x: hidden;
   }

  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    margin-bottom: 21px;
    background-color: ghostwhite;
    border-radius: 15px;
  }

  .card:hover {
   box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  }

  .container-card {
   padding: 21px;
  }
  .margin0
  {
   margin: 0px;
  }
  .card-data{
   text-align: center;
    font-size: 55px;
    margin-bottom: 0px;
    line-height: 55px;
  }
  .align-center
  {
   text-align: center;
  }
  .card-hed
  {
   color: #6e6e6e;
  }

  .heading-data
  {
   padding-bottom: 5px;
    font-size: 21px;
    margin-top: 5px;
    border-bottom: 1px solid #ccc;
    margin-left: 15px;
    margin-right: 15px;
  }
  .default-color
  {
   color: inherit;
  }
  .default-color:focus
  {
   color: inherit;
  }
  .default-color:hover{
   color: #3c8dbc;
   }
   .box-width-dash
   {
    width: 20%;
    padding-right: 10px;
    padding-left: 10px;
   }
   .card-dashboard
   {
    height: 140px;
   }
   .custom-card-pad
   {
    padding-left: 12px; padding-right: 12px;
   }

   .fc-content-skeleton table {
    width: 100% !important;
    display: block;
    text-align: center;
}
.fc-content-skeleton table tbody {
    width: 100% !important;
    display: block;
    text-align: center;
}
.fc-content-skeleton table tbody tr {
    width: 32.3%;
    background-color: #3a87ad;
    margin: .5%;
    margin-top: .5%;
    margin-bottom: .5%;
    display: inline-block;
    float: none;
}
.fc .fc-row .fc-content-skeleton td
{
  display: block;
}
.bold-black
{
  font-weight: 700;
  color: #000;
}
input[type="date"].form-control
{
      line-height: inherit;
}



   
</style>
<link rel='stylesheet' href='/css/fullcalendar.min.css'/>
<link rel='stylesheet' href='/css/calendar.css'/>
@endpush


<div class="row margin0">
   <h3 class="heading-data">Joborder Status</h3>
   <div class="col-md-2 box-width-dash">
      <div class="card card-dashboard">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Open Job Orders</b></h4>
        <p class="card-data"><a href ="/admin/job-orders" target="_blank" class="default-color">{{$data['orderCount']}}</a></p>
        <p class="align-center margin0 card-hed">Live Job Orders</p> 
       </div>
      </div>
   </div>
   <div class="col-md-2 box-width-dash">
      <div class="card card-dashboard">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Submitted</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-submitted" target="_blank" class="default-color">{{$data['submittedClient']}}</a></p>
        <p class="align-center margin0 card-hed">Awaiting Feedback</p> 
       </div>
      </div>
   </div>
   <div class="col-md-2 box-width-dash">
      <div class="card card-dashboard">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Interviewing</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-interview-scheduled" target="_blank" class="default-color">{{$data['interviewing']}}</a></p>
        <p class="align-center margin0 card-hed">Schedule Interview</p> 
       </div>
      </div>
    </div>
   <div class="col-md-2 box-width-dash">
      <div class="card card-dashboard">
       <div class="container-card custom-card-pad">
        <h4 class="margin0 card-hed"><b>Interview Feedback</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-interview-feedback" target="_blank" class="default-color">{{$data['interviewFeedback']}}</a></p>
        <p class="align-center margin0 card-hed" style="line-height: 15px;">Awaiting Interview Feedback</p> 
       </div>
      </div>
   </div>
   <div class="col-md-2 box-width-dash">
      <div class="card">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Offered</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-offered" target="_blank" class="default-color">{{$data['confirmOffer']}}</a></p>
        <p class="align-center margin0 card-hed">Offered Candidates</p> 
       </div>
      </div>
   </div>
   <div class="clearfix"></div>
   <div class="col-md-3">
      <div class="card">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Joining</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-joining" target="_blank" class="default-color">{{$data['confirmJoining']}}</a></p>
        <p class="align-center margin0 card-hed">Scheduled Joining</p> 
       </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="card">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Joined</b></h4>
        <p class="card-data"><a href ="/admin/candidates-joined" target="_blank" class="default-color">{{$data['candidateJoined']}}</a></p>
        <p class="align-center margin0 card-hed">Candidate Joined</p> 
       </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="card">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Job Order Report</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-introcall-scheduled" target="_blank" class="default-color">{{$data['introCallScheduled']}}</a></p>
        <p class="align-center margin0 card-hed">Introcall Scheduled</p> 
       </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="card">
       <div class="container-card">
        <h4 class="margin0 card-hed"><b>Job Order Report</b></h4>
        <p class="card-data"><a href ="/admin/job-orders-scheduled-submission" target="_blank" class="default-color">{{$data['submissionDate']}}</a></p>
        <p class="align-center margin0 card-hed">Scheduled Submission</p> 
       </div>
      </div>
   </div>
   
</div>


<div id="Personal" class="col-md-4 padlet-rig5">
   {{-- <div class="panel panel-default">
      <div class="panel-heading panel-hed-cus">Joborder Status</div>
      <div class="panel-body">
         <div class="row stats-count-row pad0">
            <div class ="col-md-4 pad0">
               <div class="panal-subhed"><a href ="/admin/job-orders" target="_blank">
               Open Job Orders</a></div>
               <div class ="status-no ">
                  <div class="numberCircle">{{$data['orderCount']}}</div>
               </div>
               <div class ="panal-subhed1">Live Job Orders</div>
            </div>
            <div class ="col-md-4 pad0">
               <div class="panal-subhed"><a href ="/admin/job-orders-interview-scheduled" target="_blank">Interviewing</a></div>
               <div class ="status-no">
                  <div class="numberCircle">{{$data['interviewing']}}</div>
               </div>
               <div class ="panal-subhed1">Schedule Interview</div>
            </div>
            <div class ="col-md-4 pad0">
               <div class="panal-subhed"><a href ="/admin/job-orders-submitted" target="_blank">Submitted </a></div>
               <div class ="status-no">
                  <div class="numberCircle">{{$data['submittedClient']}}</div>
               </div>
               <div class ="panal-subhed1">Awaiting Feedback</div>
            </div>
         </div>
         <div class="row stats-count-row second-section-joborder">
            <div class = "col-md-4 pad0">
               <div class="panal-subhed"><a href ="/admin/job-orders-interview-feedback" target="_blank">Interview Feedback</a></div>
               <div class ="status-no">
                  <div class="numberCircle">{{$data['interviewFeedback']}}</div>
               </div>
               <div class ="panal-subhed1">Awaiting Interview <br>Feedback</div>
            </div>

            <div class = "col-md-4 pad0">
               <div class="panal-subhed"><a href ="/admin/job-orders-offered" target="_blank">Offered</a></div>
               <div class ="status-no">
                  <div class="numberCircle">{{$data['confirmOffer']}} </div>
               </div>
               <div class ="panal-subhed1">Offered Candidates</div>
            </div>
            <div class = "col-md-4 pad0">
               <div class="panal-subhed"><a href ="/admin/job-orders-joining" target="_blank">Joining</a></div>
               <div class ="status-no">
                  <div class="numberCircle">{{$data['confirmJoining']}} </div>
               </div>
               <div class ="panal-subhed1">Scheduled joining</div>
            </div>
         </div>
         <div class="panel panel-default">
            <div class="panel-heading sub-panel-hed">Job Order Report</div>
            <div class="panel-body">
               <div class = "col-md-6 pad0">
                  <div class="panal-subhed"><a href ="/admin/job-orders-introcall-scheduled" target="_blank"> Introcall Scheduled</a></div>
                  <div class ="status-no">
                     <div class="numberCircle">{{$data['introCallScheduled']}} </div>
                  </div>
               </div>
               <div class = "col-md-6 pad0">
                  <div class="panal-subhed"><a href ="/admin/job-orders-scheduled-submission" target="_blank">Scheduled Submission</a></div>
                  <div class ="status-no">
                     <div class="numberCircle">{{$data['submissionDate']}} </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> --}}
   <div class="panel panel-default" id="db-candidate-status">
      <div class="text-secondary pt-4 pb-4 text-center" style="padding: 30px 0">Please wait...</div>
   </div>
</div>
<div class="col-md-6 padlet-rig5">
   {{-- 
   <div class = "calendar-container col-md-12">
      <h3><u> Schedule </u> </h3>
   </div>
   --}}
   <div class="panel panel-default">
      <div class="panel-heading panel-hed-cus">Schedule</div>
      <div class="panel-body">
         <div id="calendar"></div>
      </div>
   </div>
   <div class="panel panel-default">
      <div class="panel-heading panel-hed-cus">Upcoming Events</div>
      <div class="panel-body">
         <div id="calendar row">
            <form action="{{Request::fullUrl()}}" method="get">
               <div class = "col-md-4 pad0 pad-right6">
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
               <?php $datetime = new DateTime('tomorrow');
               $today = $datetime->format('Y-m-d');?>
               <div class="col-md-4 pad0 pad-right6">
                  <input type="date" class ="form-control date-select" name="date" min="{{$today }}" value="{{$_REQUEST['date']}}" onchange="this.form.submit();">
               </div>
               <div class="col-md-4 pad0">
                  <select class='form-control' name='owner' id = 'owner' onchange="this.form.submit();">
                     <option value = ''> Owner </option>
                     @foreach($owners as $owner)
                     <option value = '{{ $owner->id}}' {{ $_REQUEST['owner'] == $owner->id ? 'selected' : ''}} > {{ $owner->name}} </option>
                     @endforeach    
                  </select>
               </div>
            </form>
         </div>
         <div class="row">
            <div class="col-md-12 table-responsive mar-top15">
               <table class="table table-bordered upcoming-events-table simple">
                  <thead>
                     <tr>
                        <th>Events</th>
                        <th>Date</th>
                        <th>Owner</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($events as $event)
                     <tr>
                        <td>
                           <div class="">
                              <u> <b> {{$event->type}} </b></u> <br>
                              <b>Company:</b> {{$event->company->name }} <br>
                              <b>Joborder:</b> {{$event->job_order->title }} <br>
                              @if(!empty($event->candidate))
                              <b>Candidate:</b> {{$event->candidate->first_name }}
                              {{$event->candidate->last_name }}
                              @else
                              --
                              @endif
                           </div>
                        </td>
                        <td>
                           {{$event->event_date}}
                        </td>
                        <td>
                           {{$event->owner}}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               
            </div>
         </div>
      </div>
   </div>
   {{-- 
   <div class="row">
      <div class = "col-md-12 event-filter-container">
         <h3><u> Events </u> </h3>
      </div>
   </div>
   --}}
</div>
<div class="col-md-2 padlet-rig5">
   <div class="panel panel-default">
      <div class="panel-heading panel-hed-cus">Activity Log</div>
      <div class="panel-body pad-top10 activity-log-container" >
         @foreach($activityLogs as $activityLog)      
         <div class="col-md-12 activity-log">
            <b> {{$activityLog->jobOrder}} </b> : Status of <b>  {{$activityLog->candidateName}} </b> changed to <b> {{$activityLog->new_secondary_status}} </b> by <b> {{$activityLog->creator}} </b>on <b>{{$activityLog->created_at}}</b>
         </div>
         @endforeach
      </div>
   </div>
</div>
@push('bottom')
<script src='/js/moment.js'></script>
<script src='/js/fullcalendar.min.js'></script>
<!-- <script src='/js/calendar.js'></script> -->
<script type="text/javascript">
    $(window).load(function() {
        $.get("/admin/db-candidate-status", function(_result) {
            $('#db-candidate-status').html(_result);
        });
    });
   $(document).ready(function(){
      $(this).scrollTop(0);
   
      $('input').blur();
      $('.date-picker').datepicker({
         format: 'dd/mm/yyyy',
      });
      $(function() {
   $('.simple').DataTable( {
    searching: false,
   "pageLength": 5,
   "bLengthChange": false,
   "iDisplayLength": -1,
    "aaSorting": [[ 1, "asc" ]] ,
     columnDefs:[{targets:1, render:function(data){
      return moment(data).format('DD/MM/YYYY');
    }}]
    });
      });
   var fromdate=$("#fromdate").val();
   var todate=$("#todate").val();
   var recruiter=$("#recruiter").val();
   //alert(fromdate);
   if(fromdate==' '||todate==' '||recruiter==' ')
   {
   
   }
   else{
       var url = window.location.href;
url = url.split('?')[0].split('&')[0].split('#')[0];
//alert(url);
//window.location.replace(url);  
history.pushState(null, null, url);
   }

   var html = '<h1><i class="fa fa-dashboard"></i> Dashboard</h1>';
 $(".content-header h1").remove();
    $('.content-header').append(html); 
      function getEvents(_start, _end, timezone, _callback) {
         $.ajax({
            url: "/custom/events",
            dataType: 'json',
            data: {
               start: _start.unix(),
               end: _end.unix()
            },
            success: function (_data) {
               var events = [];
               $.each(_data, function (idx, e) {
                  var jobOrderUrl = '/admin/job_order_applicants?job_order_id=' + e.job_order_id +'&candidate_id='+ e.candidate_id;
                  // if(e.candidate_id){
                  //    // jobOrderUrl = jobOrderUrl+'&candidate_id='+e.candidate['id'];
                  //    jobOrderUrl = jobOrderUrl+'&candidate_id='+ e.candidate_id;
                  // }
                  events.push({
                     title: e.type + '<b>' + e.job_order_id + '</b>',
                     start: e.event_date,
                     url: jobOrderUrl,
                     raw: e
                  });
               });
               _callback(events);
            }
         });
      }
   
      function renderEvent(_event, _element) {
   
         var holder = _element.find('.fc-content');
   
         _element.addClass(_event.raw.status);
   
         // clear it
         holder.empty();
   
         // type
         holder.append(
            $('<span/>').addClass('e-type').text(_event.raw.type)
            .append($('<span/>').addClass('e-assignees').text(_event.raw.assignees))
            .css("background-color", getStatusColour(_event.raw.type))
            );
         console.log(getStatusColour(_event.raw.type));
   
         // // client
         // holder.append($('<span/>').addClass('e-jo').text(_event.raw.company.name));
   
         // // job order
         // holder.append($('<span/>').addClass('e-jo').text(_event.raw.job_order.title));
   
         // // candidate
         // if(_event.raw.candidate) {
         //    holder.append($('<span/>').addClass('e-cand').text([_event.raw.candidate.first_name, _event.raw.candidate.last_name].join(' ')));
         // }
         // client
        holder.append($('<span/>').addClass('e-jo').text(_event.raw.company_name));

        // job order
        holder.append($('<span/>').addClass('e-jo').text(_event.raw.job_order_name));
        // holder.append($('<span/>').addClass('e-jo').text(_event.raw.job_order.title));

        // candidate
        holder.append($('<span/>').addClass('e-cand').text(_event.raw.candidate_name));
        // if(_event.raw.candidate) {
        //     holder.append($('<span/>').addClass('e-cand').text([_event.raw.candidate.first_name, _event.raw.candidate.last_name].join(' ')));
        // }

        //owner
        holder.append($('<span/>').addClass('e-jo').text(_event.raw.owner_name));
        // holder.append($('<span/>').addClass('e-jo').text('Owner: ' + ((_event.raw.owner == 'No owner')? 'No owner': _event.raw.owner.name)));
   
     }
   
     $('#calendar').fullCalendar({
   
         // value props
         // defaultView: 'basicWeek',
         defaultView: 'basicDay',
         weekends: true,
         //hiddenDays: [0],
         allDaySlot: true,
         allDayText: "Day\nEvents",
         minTime: '09:00:00',
         maxTime: '19:00:00',
         height: 'auto',
   
         // function props
         events: getEvents,
         eventRender: renderEvent,
   
     });
   
     window.setInterval(function() {
      window.setInterval(function() {
              
      }, 1000);
      $('#calendar').fullCalendar('refetchEvents');

     }, 15000);
     setInterval(function(){$('#CartShortCut').toggleClass('cart-hover');}, 5000);
   });

function getStatusColour(_status) {
    var colour;
        switch(_status){
            case "Confirm Interview":
                colour = "#a0eac1";
            break;
            case "Submission":
                colour = "#e8d870";
            break;
            case "Intro Call":
                colour = "#e89b70";
            break;
            case "Set Interview":
                colour = "#d0b3ec";
            break;
            case "Call Back":
                colour = "#ef3c3c";
            break;
            case "Submit":
                colour = "#1e6b25";
            break;
            case "Get Submission Feedback":
                colour = "#73b70e";
            break;
            case "Interview Follow-up":
                colour = "#0d49bf";
            break; 
            case "Interview On Hold":
                colour = "rgb(208, 127, 127)";
            break;
            case "Offer Follow-up":
                colour = "rgba(3, 169, 244, 0.99)";
            break;
            case "Confirm Offer":
                colour = "#eb1bf5";
            break;
            case "Confirm Offer Follow-up":
                colour = "#585c5f";
            break;
            case "Confirm Joining":
                colour = "#0ea972";
            break;
            case "Interview":
                colour = "#6dc1d6";
            break;
            case "Rescheduled Interview":
                colour = "rgb(97, 31, 8)";
            break;
            case "Job Order Re-submission":
                colour = "#bb6993";
            break;
            case "Job Order Follow-up":
                colour = "rgb(155, 204, 73)";
            break;
            case "Interview Feedback Rescheduled":
                colour = "rgb(228, 161, 54)";
            break;
            case "Interview Next Round":
                colour = "#b37700";
            break;
            case "Confirm Attendance":
                colour = "#FFC0CB";
            break;
            default:
                colour = "#000000";
            break;
        }
        return  colour;
    }
</script>
@endpush
@endsection
