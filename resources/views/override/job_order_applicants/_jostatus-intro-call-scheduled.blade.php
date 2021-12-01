@if($jobOrder->status === 'Intro Call Scheduled')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default jo-panel">
				<div class="panel-body">
					<form class="form-horizontal" method="post" id="intro" enctype="multipart/form-data" action="/custom/set-intro-call-date">
						<input type="hidden" name="job_order_id" value="{{ $jobOrder->id }}">
						<!-- <div class="form-group">
							Intro Call Scheduled for <b>{{ $jobOrder->intro_call_date }}</b>
						</div> -->
						<div class="form-group form-datepicker header-group-0 " id="form-group-intro_call" style="">
							<label class="control-label col-sm-2">Postpone Intro Call <span class="text-danger" title="This field is required">*</span></label>
							<div class="col-sm-4">
								<div class="input-group">
									<span class="input-group-addon open-datetimepicker"><a><i class="fa fa-calendar "></i></a></span>
									<input type="text" title="Schedule Intro Call" readonly="" required="" class="form-control notfocus input_date" name="intro_call" id="intro_call" value="{{ ($jobOrder->intro_call_date != '0000-00-00')? date('d/m/Y',strtotime($jobOrder->intro_call_date)): '' }}">
								</div>
							<div class="text-danger"><p class="msg-intro"></p></div>
							<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                            	<input type="submit" name="submit" value="Save" class="btn btn-success">
								<a href="/custom/cancel-intro-call-date/{{ $jobOrder->id }}" class="btn btn-default">Cancel Intro Call</a>
							</div>
						</div>
					</form>
					<form class="form-horizontal" method="post" id="setform" enctype="multipart/form-data" action="/custom/set-submission-date">
						<input type="hidden" name="job_order_id" value="{{ $jobOrder->id }}">
						<div class="form-group">
							<p class="jo-intro-call-done-p">Intro Call Done? If yes, set submission date below:</p>
						</div>
						<div class="form-group form-datepicker header-group-0 " id="form-group-submission" style="">
							<label class="control-label col-sm-2">Set Submission Date <span class="text-danger" title="This field is required">*</span></label>
							<div class="col-sm-4">
								<div class="input-group">
									<span class="input-group-addon open-datetimepicker"><a><i class="fa fa-calendar "></i></a></span>
									<input type="text" title="Set Submission Date" readonly="" required="" class="form-control notfocus input_date" 
										name="submission" id="submission" value="{{ $jobOrder->submission_date ? date('d/m/Y',strtotime($jobOrder->submission_date)) : ''}}">
								</div>
							<div class="text-danger"><p class="msg"></p></div>
							<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">                                                                                   
								<input type="submit" name="submit" value="Save" class="btn btn-success">
								<input type="reset" name="reset" value="Cancel" id="reseting" class="btn btn-default">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
	window.initers.push(function() {
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
@endif