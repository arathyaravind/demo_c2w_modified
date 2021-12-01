@extends('crudbooster::admin_template')
@section('content')
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Job Order Interview Feedback List" }}</title>
@show
<script>
    window.initers = [];
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<style type="text/css">
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0 !important;
  }
  thead{
    display: table-row-group !important; 
  }
  tfoot {
    display: table-header-group !important;
  }
  tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    #candidate-joined-table_filter input{
      width: 190px !important;
    }
    .dataTables_filter{
      display: none;
    }
    .dt-buttons{
      text-align: right;
    }
    .owner{
      width: 130px !important;
    }
</style>
@include('override.details_dashboard._styles')
{{-- <div class="" data-spy="affix" data-offset-top="197">
     <div class="">    
      <form action="{{Request::fullUrl()}}" method="get">             
            
               <div class="col-md-2 pad0 pull-right filter-select">
                  <select class='form-control select2' name='owner' id = 'owner' onchange="this.form.submit();">
                     <option value = ''> Owner </option>
                      @foreach($owners as $owner)
                     <option value = '{{ $owner->id}}' {{ $_REQUEST['owner'] == $owner->id ? 'selected' : ''}} > {{ $owner->name}} </option>
                     @endforeach     
                  </select>
               </div>
                 <div class="col-md-2 pad0 pull-right filter-select">
                  <select class='form-control select2' name='company' id = 'company' onchange="this.form.submit();">
                     <option value = ''>Company</option>
                      @foreach($companies as $company)
                     <option value = '{{ $company->id}}' {{ $_REQUEST['company'] == $company->id ? 'selected' : ''}} > {{$company->name}} </option>
                     @endforeach     
                  </select>
               </div>
                 <div class="col-md-1 pad0 pull-right filter-select">
                  <input type="text" class="form-control date-picker" autocomplete="off" id="fromdate" value="{{$_REQUEST['date']}}" name='date' placeholder="dd/mm/yyyy"onchange="this.form.submit();">
               </div>
               </form>      

     </div>
</div> --}}
<div class="container-fluid">
    <div class="row">
    	{{-- <p class="search-fixed-pace"></p> --}}
        <div class="table-responsive">
        	<!-- <form method="get" action='/admin/backout-candidates-pdf-view' target="_blank" class="form-horizontal">
        					<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
        						Print PDF
        					</button>
        					<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
        					<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
        					<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
        	
        				</form> -->
  {{--   @if(count($feedbacks)>0)
			<form method="get" action='/admin/job-orders-interview-feedback-csv-view' target="_blank" class="form-horizontal">
			<input type="hidden" name="date" value="{{ $_REQUEST['date'] }}">
        	<input type="hidden" name="company" value="{{ $_REQUEST['company'] }}">
        	<input type="hidden" name="owner" value="{{ $_REQUEST['owner'] }}">
				<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
					Export CSV
				</button>
			</form>
		@endif --}}
			<table class="table table-striped" id="candidate-joined-table">
				<thead>
					<tr>
						<th>Sl No.</th>
						<th>Job Order</th>
						<th>Candidate Name</th>
            <th>Company</th>
						<th>Owner</th>
						<th>Interview Feedback/Rescheduled Date</th>
						<th>Next Action</th>
					</tr>
				</thead>
				<tbody>
          <?php $i = 1; /* ($feedbacks->currentpage()-1)*  $feedbacks->perpage() + 1;*/ ?> 
					@if(count($feedbacks)>0)
					@foreach($feedbacks as $feedback)
						<tr>
							<td><input type="hidden" name="openings" value='{{$feedback->opening_count}}' class="openings{{$feedback->applicant_id}}">{{$i}} </td>
							<td> <a href='/admin/job_order_applicants?job_order_id={{$feedback->job_order_id}}&candidate_id={{$feedback->candidate_id}}'target="_blank"><span class="jo-order">{{$feedback->title}}</span></a></td>
							<td><a href='/admin/candidates/detail/{{$feedback->candidate_id}}'target="_blank">  <span class="jo-candidate"> {{$feedback->candidateName}} </span></a></td>
              <td> 
              @if(CRUDBooster::myPrivilegeId()==4)
                <a href='/admin/companies/detail/{{$feedback->companyId}}'><span class="jo-company"> {{$feedback->companyName}}</span></a>
              @else
                <a href='/admin/companies/detail/{{$feedback->companyId}}' target="_blank"><span class="jo-company"> {{$feedback->companyName}}</span></a>
              @endif</td>
							<td> {{$feedback->recruiterName }} </td>
							<td> 
                @if(!empty($feedback->interview_followup_date)&&($feedback->interview_followup_date!='0000-00-00'))
									{{date('d/m/Y',strtotime($feedback->interview_followup_date))}}
                @elseif(!empty($feedback->interview_reschedule_date)&&($feedback->interview_reschedule_date!='0000-00-00'))
									{{date('d/m/Y',strtotime($feedback->interview_reschedule_date))}}
								@else
									--
								@endif		
							</td>
							<td>
                @if(!empty($feedback->next_action=='Get Interview Feedback'))
                    @if(($feedback->next_action != " ") || ($feedback->next_action != '-'))
                      <span class="jo-submission-date">
                        <?php
                            $state = '';
                            if(!empty($feedback->opening_status)){
                                $state = $feedback->opening_status ;
                            }
                            else{
                                $state=' ';
                            }
                        ?>
                      <button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$feedback->applicant_id}}" {{$state}}>{{$feedback->next_action}}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
                    @else
                      -
                    @endif
                    @if($feedback->interview_followup_date)
                      <span class="jo-date-highlight">Follow up on <b>{{ date("d/m/Y", strtotime($feedback->interview_followup_date)) }}</b></span>
                    @endif
                    @if($feedback->interview_reschedule_date)
                      <span class="jo-date-highlight">Interview feedback rescheduled for <b>{{ date("d/m/Y", strtotime($feedback->interview_reschedule_date)) }}</b>
                      </span>
                    @endif
                @endif
              </td>
						</tr>
					<?php $i++ ?>
					@endforeach
					{{-- @else
                    <tr>
                      <td colspan="7"class="text-danger"><h4><center>No Data Available.</center></h4></td>
                    </tr> --}}
                    @endif
				</tbody>
         <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Company</th>
                        <th>Owner</th>
                        <th>Interview Feedback/Rescheduled Date</th>
                        <th></th>
                    </tr>
                </tfoot>
			</table>
       <p>{{-- {!! urldecode(str_replace("/?","?",$feedbacks->appends(Request::all())->render())) !!} --}}</p>
		</div>
	</div>
</div>
@include('override.job_order_applicants._task-get-interview-feedback-modal')
@endsection
@push('bottom')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js "></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">	
var html = '<h1><i class="fa fa-dashboard"></i> Job Order Interview Feedback List</h1>';
 $(".content-header h1").remove();
 $('.content-header').append(html);
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
    }
 $(document).ready(function(){
  //    $('.select2').select2();
  //    $('input').blur();
	 // $('.date-picker').datepicker({
  //        format: 'dd/mm/yyyy',
  //        minDate:$('#fromdate').val(),
  //     });
   $('#candidate-joined-table').addClass('display');
        var table = $('#candidate-joined-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', className: 'btn btn-primary btn-xs csv', text: 'Export CSV', title: 'Job Order Interview Feedback List' }
            ],
            /* lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
          iDisplayLength: 20,*/
            aLengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
            iDisplayLength: 20, 
        });

        $('#candidate-joined-table tfoot th').each( function () {
            var title = $(this).text();
            if(title !== ' '){
                if(title=='Owner'||title=='Company'){
                  $(this).html( '<input type="text" class="form-control owner" placeholder="Search '+title+'" />' );
                }
                if(title=='Interview Feedback/Rescheduled Date'){
                  $(this).html( '<input type="text" class="form-control owner date-picker" placeholder="dd/mm/yyyy" />' );  
                }
            }
        });

        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                    .search( this.value )
                    .draw();
                }
            });
        });
        $('.date-picker').datepicker({
            format: 'dd/mm/yyyy',
        });
        $('#candidate-joined-table tfoot th input').on( 'keyup change', function () {

            if ($('#candidate-joined-table tbody tr.odd td').hasClass('dataTables_empty')) {
                    $('.csv').hide();
            }
            else{
                    $('.csv').show();
            }           
        });
        if ($('#candidate-joined-table tbody tr.odd td').hasClass('dataTables_empty')) {
                $('.csv').hide();
        }
        else{
                $('.csv').show();
        }
        $("#candidate-joined-filter").select2();
        $("#joborder-joined-filter").select2();

        $('#candidate-joined-table').on('click', '.btn-applicant-task', function() {
            var datavalue='';
            var openings='';
            var task = $.trim($(this).text());
            var current_status = $(this).closest('tr').find('td .jo-type').text();
            var company = $(this).closest('tr').find('td .jo-company').text();
            var order = $(this).closest('tr').find('td .jo-order').text();
            var candidate = $(this).closest('tr').find('td .jo-candidate').text();

            datavalue=$(this).attr('data-id');
            openings=$('.openings'+datavalue).val();
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
@endpush