@if($jobOrder->status === 'New')
<?php
	$datetime = new DateTime('today');
	$today = $datetime->format('Y-m-d'); // H:i:s
?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default jo-panel">
				<div class="panel-body">
					<form class="form-horizontal" method="post" id="intro" enctype="multipart/form-data" action="/custom/set-intro-call-date">
						<input type="hidden" name="job_order_id" value="{{ $jobOrder->id }}">
						<div class="form-group form-datepicker header-group-0 " id="form-group-intro_call" style="">
							<label class="control-label col-sm-2">Schedule Intro Call <span class="text-danger" title="This field is required">*</span></label>
							<div class="col-sm-4">
								<div class="input-group">
									<span class="input-group-addon open-datetimepicker"><a><i class="fa fa-calendar "></i></a></span>
									<input type="text" title="Schedule Intro Call" readonly="" required="" class="form-control notfocus input_date" name="intro_call" id="intro_call">
								</div>
							<div class="text-danger"><p class="msg"></p></div>
							<p class="help-block"></p>
							</div>
						</div>
						<div class="form-group">
                            <label class="control-label col-sm-2"></label>

                            <div class="col-sm-10">                                                                                   
								<input type="submit" name="submit" value="Save" class="btn btn-success">
								<input type="reset" name="reset" id="reseting" value="Cancel" class="btn btn-default">

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
		window.initers.push(function() {
			$('#intro_call').datepicker({
				format: 'dd/mm/yyyy',
				startDate: '0d',
			});
			$('#intro').submit(function () {
					 if( $('#intro_call').val().length === 0 ) {
		 var html = '<br/><div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select any date for <strong>Schedule Intro Call!</strong></div>';
    $('.msg').html(html); 
    return false;
    }
	});	
	$('#reseting').click(function () {
    $('.msg').html(''); 
	});
	});

	</script>
@endif