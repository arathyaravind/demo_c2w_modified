@extends('crudbooster::admin_template')
@section('content')
@push('head')
<style type="text/css">
.fc-today-button.fc-button.fc-state-default.fc-corner-left.fc-corner-right {
	text-transform:capitalize;
}
.filter-calendar{
	margin-top: 0px; 
	height: 50px;
}

.margin0 {
	margin: 0px;
}

.h3-event-stats {text-align: center;background: azure;margin-bottom: 0px;padding: 6px;border: 1px solid #ccc;border-bottom: 0px;}
.event-stats-col {border: 1px solid #ccc;text-align: center;
    background: beige;font-size: 15px;
    font-weight: 600;
    padding: 2px;}
 .align-center
 {
 	text-align: center;
 }
 .calendar-count {
    background-color: aliceblue;
    padding: 3px 5px 10px 5px;
   /* margin-bottom: 5px;*/
    height: 70px;
    overflow: hidden;
    line-height: 14px;
    cursor: pointer;
    margin-bottom: 0px;
    /*border: 1px solid aqua;*/
}
 .count
 {
 	color: #007bff;
    font-size: 27px;
    font-weight: 600;
    margin-bottom: 1px;
    margin-top: 6px;
 }
 .sub-text-count
 {
 	font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
 }
 .row-centered {
    text-align: center;
    margin-bottom: 15px;
  }
  .col-centered-calender {
    display: inline-block;
    float: none;
    text-align: left;
    margin-right: -4px;
    width: 11%;
    padding-right: 4px;
    padding-left: 4px;
}
.event-hed{
	font-size: 24px;
    padding: 10px 10px 3px 3px;
}
.filter-reset-btn{
	margin      : 0;
	padding     : 0;
	border      : 0;
	background  : transparent;
	font-family : inherit;
	font-size   : 1em;
	cursor      : pointer;
}
.filter-reset-btn span{
	padding: 6px 12px;
    line-height: 30px;
    color: white;
    text-shadow: 0 0 2px black;
    /* border: 1px solid rgb(249, 84, 84); */
    border-radius: 4px;
    background: rgb(222, 74, 74);
    background-image: linear-gradient( rgb(121, 115, 115),rgb(232, 103, 103) 50%,rgb(212, 71, 71) 50%,rgb(113, 58, 58));
}

.affix {
    top: 10px;
    right: 30px;
    z-index: 1000 !important;
    left: 250px;
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
    width: 18%;
    background-color: #3a87ad;
    margin: 1%;
    margin-top: .5%;
    margin-bottom: .5%;
    display: inline-block;
    float: none;
}
.fc .fc-row .fc-content-skeleton td
{
	display: block;
}


 /* .affix + .container-fluid {

    padding-top: 0px;
  }*/
</style>
<link rel='stylesheet' href='/css/fullcalendar.min.css'/>
<link rel='stylesheet' href='/css/calendar.css'/>
@endpush
<!-- <?php
	$datetime = new DateTime($_REQUEST['date']);
	$today = $datetime->format('Y-m-d'); // H:i:s
?> -->
<div class='col-md-12 col-sm-12 filter-calendar' data-spy="affix" data-offset-top="197">
	
	<form action="{{Request::fullUrl()}}" method="get">
		<div class = "col-md-3">
			<select class='form-control' name='status' id ='status'>
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
				<option value ='Interview Follow-up' {{ ($_REQUEST['status'] == 'Interview Follow-up')? 'selected' : '' }} > Interview Follow-up </option>
				<option value ='Interview On Hold' {{ ($_REQUEST['status'] == 'Interview On Hold')? 'selected' : '' }} > Interview On Hold </option>
				<option value ='Interview Feedback Rescheduled' {{ ($_REQUEST['status'] == 'Interview Feedback Rescheduled')? 'selected' : '' }} >Interview Feedback Rescheduled</option> 
				<option value ='Interview Next Round' {{ ($_REQUEST['status'] == 'Interview Next Round')? 'selected' : '' }} >Interview Next Round</option> 
				<option value ='Offer Follow-up' {{ ($_REQUEST['status'] == 'Offer Follow-up')? 'selected' : '' }} > Offer Follow-up </option>		
				<option value ='Confirm Offer' {{ ($_REQUEST['status'] == 'Confirm Offer')? 'selected' : '' }} > Confirm Offer   </option>	
				<option value ='Confirm Offer Follow-up' {{ ($_REQUEST['status'] == 'Confirm Offer Follow-up')? 'selected' : '' }} >Confirm Offer Follow-up</option>	
				<option value ='Confirm Joining' {{ ($_REQUEST['status'] == 'Confirm Joining')? 'selected' : '' }} > Confirm Joining   </option>		
			</select>
		</div>
		
		<div class="col-md-3">
			<select class='form-control' name='owner' id = 'owner'>
				<option value = ''> Owner </option>
				@foreach($owners as $owner)
				<option value = '{{ $owner->id}}' {{ $_REQUEST['owner'] == $owner->id ? 'selected' : ''}} > {{ $owner->name}} </option>
				@endforeach		
			</select>
		</div>
		<div class="col-md-3">
			<input type="date" class ="form-control date-select" name="date" value="{{$_REQUEST['date']}}">
		</div>
		<div class="col-md-3">
			<button type="button" class="filter-reset-btn" onClick="window.location.reload()"><span> Reset </span></button>
		</div>
	</form>
</div>
	 <div class="row margin0">
		<div class="event-stats-main"> {{-- col-sm-6 col-sm-offset-3 --}}
        
	  </div>
	</div> 


<div id="calendar"></div>

@push('bottom')
<script src='/js/moment.js'></script>
<script src='/js/fullcalendar.min.js'></script>
<script src='/js/calendar.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.date-select').change(function(){
			$('.fc-day').removeClass('fc-state-highlight');
			if($(this).val()) {
				$('#calendar').fullCalendar('gotoDate', $(this).val());
				var dateString = moment($('.date-select').val()).format('YYYY-MM-DD');
				$('.fc-day[data-date="' + dateString + '"]').addClass("fc-state-highlight");
			}
		});
		if("{{$_REQUEST['date']}}") {
			$('#calendar').fullCalendar('gotoDate', $('.date-select').val());
		}
	});
</script>
@endpush
@endsection