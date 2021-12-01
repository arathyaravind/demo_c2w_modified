<div class="modal fade" tabindex="-1" role="dialog" id="resubmission-date_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Re-Submission Date</h4>
			</div>
			<?php
				($resubmission_followup->date) ? $submissionDate = $resubmission_followup->date : $submissionDate = $jobOrder->submission_date;
				if($submission_date){
					$submission_date = new DateTime($submissionDate);
					$convertedSubmissionDate = $submission_date->format('d/m/Y');
					$formatedSubmissionDate = \DateTime::createFromFormat('d/m/Y', $convertedSubmissionDate)->format('m-d-Y');
				}
			?>
			<div class="modal-body">
				@if($event->job_order->id)
					@if($pending_event=='0')
					<form class="form-horizontal" method="post" id="resubform" action="/custom/resubmission-pendingevent">
					<input type="hidden" name="job_order_id" id="resubmission-pendingevent" value="{{$event->job_order->id}}">
					@else
					<form class="form-horizontal" method="post" id="resubform" action="/custom/resubmission-event">
					<input type="hidden" name="job_order_id" id="resubmission-event" value="{{$event->job_order->id}}">
					@endif
				@else
				<form class="form-horizontal" method="post" id="resubform" action="/custom/resubmission">
				<input type="hidden" name="job_order_id" id="submission_job_order_id" value="{{ $jobOrder->id }}">
				<input type="hidden" name="submission_status" id="submission_status" value="">
				@endif
					<div class="form-group header-group-0 " id="form-group-submission" style="">
						<label class="control-label col-sm-6">Set Re-Submission/Follow-Up <span class="text-danger" title="This field is required">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<select class="form-control resubmission-type" name="resubmission_type" id="resubmission-type" style='width: 170px;'>
									<option value=" ">--- Select ---</option>
									<option value="{{ SUBMISSION_RESUBMISSION }}" {{ $resubmission_followup->submission_status == SUBMISSION_RESUBMISSION ? 'selected' : '' }}>Re-Submission</option>
									<option value="{{ SUBMISSION_FOLLOW_UP }}" {{ $resubmission_followup->submission_status == SUBMISSION_FOLLOW_UP ? 'selected' : '' }}>Follow-up</option>
								</select>
							</div>
							<div class="text-danger"><p class="resubmission-type-msg"></p></div>
							<p class="help-block"></p>
						</div>
					</div>
					<div class="form-group form-datepicker header-group-0 " id="form-group-submission-date" style="">
						<label class="control-label col-sm-6">Set Re-Submission/Follow-Up Date <span class="text-danger" title="This field is required">*</span></label>
						<div class="col-sm-4">
							<div class="input-group">
								<span class="input-group-addon open-datetimepicker"><a><i class="fa fa-calendar "></i></a></span>
								<input type="text" title="Set ReSubmission Date" readonly="" required="" class="form-control notfocus input_date" 
								name="resubmission_date" id="resubmission-date" value="{{ $convertedSubmissionDate }}">
							</div>
							<div class="text-danger"><p class="resubmission-date-msg"></p></div>
							<p class="help-block"></p>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="modal-footer">
						{{-- <label class="control-label col-sm-2"></label>
						<div class="col-sm-10 pull-right">
							<input type="submit" name="submit" value="Save" class="btn btn-success">
							<input type="reset" name="reset" value="Cancel" id="reseting" class="btn btn-default" data-dismiss="modal">
						</div> --}}
						<button type="submit" class="btn btn-success btn-save-filter">Apply</button>
						<button type="button" class="btn btn-default" id="reseting" data-dismiss="modal">Cancel</button>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
{{-- {{ $convertedSubmissionDate }} --}}
		</div>
	</div>
</div>
<script>
	window.initers.push(function() {

		var formatedSubmissionDate = new Date('{{ $formatedSubmissionDate }}');
		var today    = new Date();

		var tommorow = new Date(today);
		tommorow.setDate(today.getDate()+1);

		today >= formatedSubmissionDate ? startDate = tommorow : startDate = formatedSubmissionDate;

		$('#resubmission-date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy',
			startDate:startDate,
			{{-- startDate:'{{ $convertedSubmissionDate }}', --}}
		});

		$('#reseting').click(function () {
			$('.resubmission-type-msg').html(''); 
			$('.resubmission-date-msg').html('');

		});

		$('#resubform').submit(function (e) {

			var reSubmissionDate = $('#resubmission-date').val().split("/");
			var convertedReSubmissionDate = new Date(reSubmissionDate[2], reSubmissionDate[1] - 1, reSubmissionDate[0])

			if( $('#resubmission-type').val() == ' ' ){
				// var html = '<br/><div class="form-group alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select submission type for <strong>Re-Submission/Follow-Up!</strong></div>';
				// $('.resubmission-type-msg').html(html); 
				alert("Please select submission type for Re-Submission/Follow-Up!");
				return false;
			}


			if( $('#resubmission-date').val().length === 0 ) {
				// var html = '<br/><div class="form-group alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please select any date for <strong>Re-Submission/Follow-Up!</strong></div>';
				// $('.resubmission-date-msg').html(html); 
				alert("Please select upcoming date for Re-Submission/Follow-Up!");
				return false;
			}

			if(today >= convertedReSubmissionDate){
				alert("Please select upcoming date for Re-Submission/Follow-Up!");
				$('#resubmission-date').val('').focus();
				return false;
			}
			 var form = jQuery(e.target);
             if(form.is("#resubform")){ // check if this is the form that you want (delete this check to apply this to all forms)
             e.preventDefault();
                $.ajax({
		            type: "POST",
		            url: form.attr("action"), 
		            data: form.serialize(), // serializes the form's elements.
		            success: function(data) {
		                window.location.reload(); // show response from the php script. (use the developer toolbar console, firefox firebug or chrome inspector console)
		            }
	            });
            }

		});
	});
</script>
