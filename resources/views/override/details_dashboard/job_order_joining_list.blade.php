@extends('crudbooster::admin_template')
@section('content')
<script>
    window.initers = [];
</script>
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Scheduled Joining List" }}</title>
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
    .owner{
    	width: 124px !important;
    }
</style>
@include('override.details_dashboard._styles')
<div class="container-fluid">
    <div class="row">
        <div class="table-responsive">
        	<!-- <form method="get" action='/admin/backout-candidates-pdf-view' target="_blank" class="form-horizontal">
        					<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
        						Print PDF
        					</button>
        					<input type="hidden" name="fromDate" value="{{ $_REQUEST['fromDate'] }}">
        					<input type="hidden" name="toDate" value="{{ $_REQUEST['toDate'] }}">
        					<input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
        	
        				</form> -->
        <!-- @if(count($joins)>0)
        				<form method="get" action='/admin/job-orders-joining-csv-view' target="_blank" class="form-horizontal">
        					<button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
        						Export CSV
        					</button>
        				</form>
        			@endif -->	
			<table class="table table-striped" id="candidate-joined-table">
				<thead>
					<tr>
						<th> Sl No. </th>
						<th> Job Order</th>
						<th> Candidate Name</th>
						<th> Company </th>
						<th> Owner </th>
						<th> Joining Date </th>
						<th>Current Status </th>
						<th>Next Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; /* ($joins->currentpage()-1)* $joins->perpage() + 1;*/ ?>
					@if(count($joins)>0)
					@foreach($joins  as $join)
						<tr>
							<td><input type="hidden" name="openings" value='{{$join->opening_count}}' class="openings{{$join->applicant_id}}"> {{$i}} </td>
							<td> <a href='/admin/job_order_applicants?job_order_id={{$join->job_order_id}}&candidate_id={{$join->candidate_id}}'target="_blank"><span class="jo-order">{{$join->title}}</span></a></td>
							<td><a href='/admin/candidates/detail/{{$join->candidate_id}}'target="_blank"><span class="jo-candidate">{{$join->candidateName}}</span></a></td>
							<td> 
							@if(CRUDBooster::myPrivilegeId()==4)
        				    <a href='/admin/companies/detail/{{$join->companyId}}' target="_blank"><span class="jo-company">{{$join->companyName}}</span></a>
                			 @else
               				<a href='/admin/companies/detail/{{$join->companyId}}' target="_blank"><span class="jo-company">{{$join->companyName}}</span></a>
                			@endif</td>
							<td> {{$join->recruiterName }} </td>
							<td> 
								@if(!empty($join->joining_date)&&($feedback->$join->joining_date!='0000-00-00'))
									{{date('d/m/Y',strtotime($join->joining_date))}}
							    @else
									--
								@endif		
							</td>
							<td> {{$join->secondary_status}} </td>
							<td>
								@if(!empty($join->next_action=='Confirm Joining'))
								@if(($join->next_action != " ") || ($join->next_action != '-'))
								<span class="jo-submission-date">
                                     <?php
                                        $state = '';
                                        if(!empty($join->opening_status)){
                                            $state =$join->opening_status;
                                        }
                                        else{
                                            $state=' ';
                                        }
                                    ?>
									<button class="btn btn-xs btn-primary btn-applicant-task" data-id="{{$join->applicant_id}}" {{$state}}>{{$join->next_action }}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i></button>
									@else
									-
									@endif
									@if($join->joining_date)
                            		<span class="jo-date-highlight jo-date-highlight-blue">Joining on <b>{{ date("d/m/Y", strtotime($join->joining_date)) }}</b></span>
                            		@endif
									@endif
                        </td>
						</tr>
					<?php $i++ ?>
					@endforeach
					{{-- @else --}}
                  <!--   <tr>
                    <td colspan="7"class="text-danger"><h4><center>No Data Available.</center></h4></td>
                  </tr> -->
                    @endif
				</tbody>
				<tfoot>
		            <tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Owner</th>
						<th></th>
						<th></th>
						<th></th>
		            </tr>
		        </tfoot>
			</table>
			<p>{{-- {!!  urldecode(str_replace("/?","?",$joins->appends(Request::all())->render())) !!} --}}</p>
		</div>
	</div>
</div>
@include('override.job_order_applicants._task-confirm-joining-modal')
@endsection
@push('bottom')

<script type="text/javascript">	
var html = '<h1><i class="fa fa-dashboard"></i> Scheduled Joining List</h1>';
 $(".content-header h1").remove();

    $('.content-header').append(html);
function resetTaskModals(modal_id)
    {
        if(modal_id=='#task_send_invoice_modal'){
            $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(3)').find('td:nth-last-child(1)').text('');
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
	            { extend: 'csv', className: 'btn btn-primary btn-xs csv', text: 'Export CSV', title: 'Scheduled Joining List' }
	        ],
	        /* lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
            iDisplayLength: 20,*/
            aLengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
            iDisplayLength: 20, 
    	});

		$('#candidate-joined-table tfoot th').each( function () {
			var title = $(this).text();
			if(title !== ' '&& title=='Owner'){
				$(this).html( '<input type="text" class="form-control owner" placeholder="Search '+title+'" />' );
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
            var openings='';
            var task = $.trim($(this).text());
            var current_status = $(this).closest('tr').find('td .jo-type').text();
            var company = $(this).closest('tr').find('td .jo-company').text();
            var order = $(this).closest('tr').find('td .jo-order').text();
            var candidate = $(this).closest('tr').find('td .jo-candidate').text();

            datavalue=$(this).attr('data-id');
            openings=$('#openings'+datavalue).val();
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