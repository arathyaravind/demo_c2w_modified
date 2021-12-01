   <div class="modal fade" tabindex="-1" role="dialog" id="submission_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Submission</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default jo-panel">
                            <div class="panel-body">
                             @if(isset($submission))
                                <form class="form-horizontal" method="post" id="intro" enctype="multipart/form-data" action="/custom/set-intro-call-date-by-pending-event">
                                    @else
                                    <form class="form-horizontal" method="post" id="intro" enctype="multipart/form-data" action="/custom/set-intro-call-date-by-event">
                                        @endif
                                        <input type="hidden" name="job_order_id" value="{{ $event->job_order->id }}" class="submission-event">
                                        <input type="hidden" name="introcall_status" value="" class="introcall_status">
                        <!-- <div class="form-group">
                        Intro Call Scheduled for <b>{{ $event->job_order->intro_call_date }}</b>
                        </div> -->
                        <div class="form-group form-datepicker header-group-0 " id="form-group-intro_call" style="">
                            <label class="control-label col-sm-4">Postpone Intro Call <span class="text-danger" title="This field is required">*</span></label>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon open-datetimepicker"><a><i class="fa fa-calendar "></i></a></span>
                                    <input type="text" title="Schedule Intro Call" readonly="" required="" class="form-control notfocus input_date" name="intro_call" id="intro_call" value="{{ ($event->job_order->intro_call_date != '0000-00-00')? date('d/m/Y',strtotime($event->job_order->intro_call_date)): '' }}">
                                </div>
                                <div class="text-danger"><p class="msg-intro"></p></div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="submit" value="Save" class="btn btn-success">
                                <a href="/custom/cancel-intro-call-date/{{$event->job_order->id }}" class="btn btn-default" id="cancel_intro_call">Cancel Intro Call</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    @if(isset($submission))
                    <form class="form-horizontal" method="post" id="setform" enctype="multipart/form-data" action="/custom/set-submission-date-by-pending-event">
                        @else
                        <form class="form-horizontal" method="post" id="setform" enctype="multipart/form-data" action="/custom/set-submission-date-by-event">
                            @endif
                            <input type="hidden" name="job_order_id" value="{{ $event->job_order->id }}" class="submission-event">
                             <input type="hidden" name="submission_status" value="" class="submission_status">
                            <div class="form-group">
                                <p class="jo-intro-call-done-p" style="padding-left: calc(42% - 37px)!important;">Intro Call Done? If yes, set submission date below:</p>
                            </div>
                            <div class="form-group form-datepicker header-group-0 " id="form-group-submission" style="">
                                <label class="control-label col-sm-4">Set Submission Date <span class="text-danger" title="This field is required">*</span></label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon open-datetimepicker"><a><i class="fa fa-calendar "></i></a></span>
                                        <input type="text" title="Set Submission Date" readonly="" required="" class="form-control notfocus input_date" 
                                        name="submission" id="submission" value="{{ $event->job_order->submission_date ? date('d/m/Y',strtotime($event->job_order->submission_date)) : ''}}">
                                    </div>
                                    <div class="text-danger"><p class="msg"></p></div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4"></label>
                                <div class="col-sm-6">                                                                                   
                                    <input type="submit" name="submit" value="Save" class="btn btn-success">
                                    <input type="reset" name="reset" value="Cancel" id="reseting" class="btn btn-default">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="reseting" data-dismiss="modal">Close</button>
                    </div>
        </div>
    </div>
</div>
 