@extends('crudbooster::admin_template')
@section('content')
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Job Order Introcall Scheduled List" }}</title>
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
@include('override.job_order_applicants._styles')
@include('override.candidates._styles')
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
        <!-- @if(count($jobOrders)>0)
        			<form method="get" action='/admin/job-orders-introcall-scheduled-csv-view' target="_blank" class="form-horizontal">
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
						<th> Company </th>
						<th> Owner </th>
						<th> Introcall Scheduled Date</th>
						<th>Current Status </th>
						<th>Next Action</th>
					</tr>
				</thead>
				<tbody>
				 <?php $i = 1; /* ($jobOrders->currentpage()-1)*  $jobOrders->perpage() + 1;*/ ?>
					@if(count($jobOrders)>0)
					@foreach($jobOrders  as $jobOrder)
						<tr>
							<td> {{$i}} </td>
							<td> <a href='/admin/job_order_applicants?job_order_id={{$jobOrder->id}}'target="_blank">{{$jobOrder->title}} </a></td>
							<td> 
							@if(CRUDBooster::myPrivilegeId()==4)
        				<a href='/admin/companies/detail/{{ $jobOrder->companyId}}' target="_blank">{{$jobOrder->companyName}}</a>
                			 @else
               				<a href='/admin/companies/detail/{{ $jobOrder->companyId}}' target="_blank">{{$jobOrder->companyName}}</a>
                			@endif</td>
							<td> {{$jobOrder->recruiterName }} </td>
							<td> 
								@if(!empty($jobOrder->intro_call_date)&&($jobOrder->intro_call_date != '0000-00-00'))
									{{date('d/m/Y',strtotime($jobOrder->intro_call_date))}}
								@else
									--
								@endif		
							</td>
							<td> {{$jobOrder->status}} </td>
							<td>
							@if($jobOrder->status==='Intro Call Scheduled')
                            <span class="jo-submission-date">
                            <button class="btn btn-xs btn-primary" onclick="$('#submission_modal').modal('show');$('#submission_modal .submission-event').val({{ $jobOrder->id}});$('#submission_modal .submission_status').val('1');$('#submission_modal .introcall_status').val('2');$('#submission_modal #intro_call').val('{{($jobOrder->intro_call_date != '0000-00-00')? date('d/m/Y',strtotime($jobOrder->intro_call_date)): '' }}');$('#submission_modal #submission').val('{{$jobOrder->submission_date ? date('d/m/Y',strtotime($jobOrder->submission_date)) : ''}}');$('#submission_modal #cancel_intro_call').attr('href','/custom/cancel-intro-call-date/{{ $jobOrder->id}}');">
                              Submission&nbsp;&nbsp;
                            </button>
                            </span>
                            @endif
                         </td>
						</tr>
					<?php $i++ ?>
					@endforeach
{{-- 					@else --}}
                   <!--  <tr>
                     <td colspan="6"class="text-danger"><h4><center>No Data Available.</center></h4></td>
                   </tr> -->
                    @endif
				</tbody>
				<tfoot>
		            <tr>
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
			<p>{{-- {!! urldecode(str_replace("/?","?",$jobOrders->appends(Request::all())->render())) !!} --}}</p>
		</div>
		</div>
	</div>
</div>
 @include('override.job_order_applicants._submission-date-modal')
@endsection
@push('bottom')

<script type="text/javascript">	
var html = '<h1><i class="fa fa-dashboard"></i> Job Order Introcall Scheduled List</h1>';
 $(".content-header h1").remove();

    $('.content-header').append(html);
	
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
	            { extend: 'csv', className: 'btn btn-primary btn-xs csv', text: 'Export CSV', title: 'Job Order Introcall Scheduled List' }
	        ],
	        lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
	        pageLength: 20,
    	});

		$('#candidate-joined-table tfoot th').each( function () {
			var title = $(this).text();
			if(title !== ' '&& title=='Owner'){
				$(this).html( '<input type="text" class="form-control col-sm-3" placeholder="Search '+title+'" />' );
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
</script>
@endpush