@extends('crudbooster::admin_template')
@section('content')
@section('title')
<title>{{ isset($page_title) ? cbGetsetting('appname').': '.strip_tags($page_title) : "C2W: Job Order List" }}</title>
@show
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
                <select class='form-control select2' name='recruiter' id = 'recruiter' onchange="this.form.submit();">
                    <option value = ''> Recruiter</option>
                    @foreach($recruiters as $recruiter)
                    <option value = '{{ $recruiter->id}}' {{ $_REQUEST['recruiter'] == $recruiter->id ? 'selected' : ''}} > {{ $recruiter->name}} </option>
                    @endforeach
                </select>
            </div>

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
                <input type="text" class="form-control date-picker" autocomplete="off" id="fromdate" value="{{$_REQUEST['date']}}" name='date' placeholder="dd/mm/yyyy" onchange="this.form.submit();">
            </div>
        </form>

    </div>
</div> --}}
<div class="container-fluid">
    <div class="row">
        {{-- <p class="search-fixed-pace"></p> --}}
        <div class="table-responsive">
       {{--   @if(count($jobOrders)>0)
            <form method="get" action='/admin/job-orders-csv-view' target="_blank" class="form-horizontal">
                <input type="hidden" name="date" value="{{ $_REQUEST['date'] }}">
                <input type="hidden" name="company" value="{{ $_REQUEST['company'] }}">
                <input type="hidden" name="recruiter" value="{{ $_REQUEST['recruiter'] }}">
                <input type="hidden" name="owner" value="{{ $_REQUEST['owner'] }}">
                <button type ="submit" class="btn btn-md btn-primary btn-xs pull-right button_margin">
                    Export CSV
                </button>
            </form>
          @endif --}}
            <table class="table table-striped" id="candidate-joined-table">
                <thead>
                    <tr>
                        <th> Sl No. </th>
                        <th> Job Order</th>
                        <th> Company </th>
                        <th> Owner </th>
                        <th> Recruiter </th>
                        <th> Submission Date</th>
                        <th>Current Status </th>
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
                        <td> {{$jobOrder->ownerName }} </td>
                        <td> {{$jobOrder->recruiterName }} </td>
                        <td>@if(!empty($jobOrder->submission_date)&&($jobOrder->submission_date!='0000-00-00'))
                            {{date('d/m/Y',strtotime($jobOrder->submission_date))}}
                            @else
                            --
                            @endif		
                        </td>
                        <td> {{$jobOrder->status}} </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                   {{--  @else
                    <tr>
                      <td colspan="7"class="text-danger"><h4><center>No Data Available.</center></h4></td>
                   </tr> --}}
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Company</th>
                        <th>Owner</th>
                        <th>Recruiter</th>
                        <th>Submission Date</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <p>{{-- {!! urldecode(str_replace("/?","?",$jobOrders->appends(Request::all())->render())) !!} --}}</p>
        </div>
    </div>
</div>
@endsection
@push('bottom')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js "></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">	
    var html = '<h1><i class="fa fa-dashboard"></i> Job Order List</h1>';
    $(".content-header h1").remove();

    $('.content-header').append(html);
    $(document).ready(function(){
        //$('.select2').select2();
        //$('input').blur();
        $('#candidate-joined-table').addClass('display');
        var table = $('#candidate-joined-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csv', className: 'btn btn-primary btn-xs csv', text: 'Export CSV', title: 'Job Order List' }
            ],
            lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
            pageLength: 20,
        });

        $('#candidate-joined-table tfoot th').each( function () {
            var title = $(this).text();
            if(title !== ' '){
                if(title=='Owner'||title=='Company'||title=='Recruiter'){
                  $(this).html( '<input type="text" class="form-control owner" placeholder="Search '+title+'" />' );
                }
                if(title=='Submission Date'){
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
    });
</script>
@endpush