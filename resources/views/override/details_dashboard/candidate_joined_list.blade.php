@extends('crudbooster::admin_template')
@section('content')
<script>
    window.initers = [];
</script>
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Candidate Joined List" }}</title>
@show
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
</style>
@include('override.details_dashboard._styles')

<br>
<div class="container-fluid">
    <div class="row">
        {{-- <p class="search-fixed-pace"></p> --}}
        <div class="table-responsive">			
			<table class="table table-striped" id="candidate-joined-table">
				<thead>
					<tr>
						<th>Sl No.</th>
						<th>Job Order</th>
						<th>Candidate Name</th>
						<th>Company</th>
						<th>Owner</th>
						<th>Joined Date</th>
						<th>Current Status</th>
						<th>Next Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; /* ($joined->currentpage()-1)*  $joined->perpage() + 1; */ ?> 
					@if(count( $joined)>0)
					@foreach($joined as $joined_value)
       
						<tr>
						   <?php 
		                     $openings= \DB::table('job_orders')->find($joined_value->joborder_id);
		                     $openings_available=$openings->openings_available;
                           ?>
							<input type="hidden" name="openings" value='{{$openings_available}}' class="openings{{$joined_value->applicant_id}}">
                            <input type="hidden" id="candidate_id-{{$joined_value->applicant_id}}"  value="{{$joined_value->candidate_id}}">
							<td> {{$i}} </td>
							<td> <a href='/admin/job_order_applicants?job_order_id={{$joined_value->job_order_id}}&candidate_id={{$joined_value->candidate_id}}'target="_blank"><span class="jo-order">{{$joined_value->title}}</span></a></td>
							<td><a href='/admin/candidates/detail/{{$joined_value->candidate_id}}'target="_blank"><span class="jo-candidate">{{$joined_value->candidateName}}</span></a></td>
							<td> 
							@if(CRUDBooster::myPrivilegeId()==4)
        					<a href='/admin/companies/detail/{{$joined_value->companyId}}' target="_blank"><span class="jo-company">{{$joined_value->companyName}}</span></a>
                			@else
               				<a href='/admin/companies/detail/{{$joined_value->companyId}}' target="_blank"><span class="jo-company">{{$joined_value->companyName}}</span></a>
                			@endif</td>
							<td> {{ $joined_value->recruiter->name }} </td>
							<td>
								@if(!empty($joined_value->candidateJoinedDate)&&($joined_value->candidateJoinedDate!='0000-00-00')) 
									{{date('d/m/Y',strtotime($joined_value->candidateJoinedDate))}}
								@else
									--
								@endif		
							</td>
							<td> {{$joined_value->secondary_status}} </td>
							<td>  @if(!empty($joined_value->next_action=='Send Invoice'))
								@if(($joined_value->next_action != " ") || ($joined_value->next_action != '-'))
								<span class="jo-submission-date">
									<button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$joined_value->applicant_id}}">{{$joined_value->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
									@else
									-
									@endif
									@if(($joined_value->lastActivity->new_primary_status == 'Place') && ($joined_value->lastActivity->new_secondary_status == 'Joined'))
                                      <input type="hidden" name="jo_applicant_join_date" class="jo_applicant_join_date" value="{{$joined_value->lastActivity->prev_joining_date ? date("d/m/Y", strtotime($joined_value->lastActivity->prev_joining_date)) : ' ' }}">
                                      <input type="hidden" name="jo_applicant_ctc_value" class="jo_applicant_ctc_value" value="{{$joined_value->job_order_applicant->approved_ctc ? $joined_value->job_order_applicant->approved_ctc : ' ' }}">
                                    @endif
									@endif
								</td>
						</tr>
					<?php $i++ ?>
					@endforeach
					@endif
				</tbody>
				<tfoot>
		            <tr>
						<th> </th>
						<th>Job Order</th>
						<th>Candidate Name</th>
						<th>Company</th>
						<th>Owner</th>
						<th>Joined Date</th>
						<th>Current Status</th>
						<th> </th>
		            </tr>
		        </tfoot>
			</table>
			<p>{{-- {!! urldecode(str_replace("/?","?",$joined->appends(Request::all())->render())) !!} --}}</p>
		</div>
	</div>
</div>
@include('override.job_order_applicants._task-send-invoice-modal')
@endsection
@push('bottom')

<script type="text/javascript">	
	var html = '<h1><i class="fa fa-dashboard"></i> Candidate Joined List</h1>';
 	$(".content-header h1").remove();
    $('.content-header').append(html);
function resetTaskModals(modal_id)
    {
        if(modal_id=='#task_confirm_joining_modal'){
            $("#task_confirm_joining_modal .modal-body input").val('');
            $("#task_confirm_joining_modal .modal-body select").val('-');
            $("#task_confirm_joining_modal .modal-body textarea").val('');
            $('.task_confirm_joining_joining_date').hide();
            $('#task_confirm_joining_modal #task_confirm_joining_joining_date').datepicker('startDate','0d');
            $('#task_confirm_joining_modal #task_confirm_joining_joining_date').datepicker('setDate', null);
        }
    }
</script>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js "></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

    	$('#candidate-joined-table').addClass('display');
    	var table = $('#candidate-joined-table').DataTable({
    		dom: 'Bfrtip',
	        buttons: [
	            { extend: 'csv', className: 'btn btn-primary btn-xs csv', text: 'Export CSV', title: 'Candidate Joined List' }
	        ],
	        lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
	        pageLength: 20,
    	});

		$('#candidate-joined-table tfoot th').each( function () {
			var title = $(this).text();
			if(title !== ' '){
				if(title=='Joined Date'){
				  $(this).html( '<input type="text" class="date-picker" placeholder="dd/mm/yyyy" />' );	
				}
				else{
				  $(this).html( '<input type="text" placeholder="Search '+title+'" />' );	
				}
			}

		});
        $('.date-picker').datepicker({
          format: 'dd/mm/yyyy',
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
		$('#candidate-joined-table').on('click', '.btn-applicant-task', function(){
            var datavalue='';
            var task = $.trim($(this).text());
            var current_status = $(this).closest('tr').find('td .jo-type').text();
            var company = $(this).closest('tr').find('td .jo-company').text();
            var order = $(this).closest('tr').find('td .jo-order').text();
            var candidate = $(this).closest('tr').find('td .jo-candidate').text();
            datavalue=$(this).attr('data-id');
            var openings=$('.openings'+datavalue).val();
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
                modal.find('.jo-task-name').text(task)
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
</script>
@endpush