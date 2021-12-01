<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_get_submission_feedback_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Submission Feedback</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<label for="">Submission Feedback:</label>
					<select id="task_get_submission_feedback_options">
						<option value="-">Choose..</option>
						<option value="Submission|Approved by the client|Schedule Interview">Approved by the Client</option>
						<option value="Submission|Reschedule Submission|Get Submission Feedback">Reschedule Submission</option>
						<option value="Submission|Rejected by the client|-">Rejected by the Client</option>
					</select>
					<div class="task_feedback_reschedule conditional-task-field">
						<label for="">Reschedule:</label>
						<input type="text" readonly="" required="" class="" name="task_feedback_reschedule" id="task_feedback_reschedule">
					</div>
					<div class="task_feedback_set_interview conditional-task-field">
						<label for="">Schedule Interview:</label>
						<input type="text" readonly="" required="" class="" name="task_feedback_set_interview" id="task_feedback_set_interview" 
							value="">
					</div>
					<textarea placeholder="Notes" id="task_get_submission_feedback_notes"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-apply-task">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	window.initers.push(function() {
		$('#task_get_submission_feedback_options').change(function() {
			$('.task_feedback_reschedule').hide();
			$('.task_feedback_set_interview').hide();
			if(this.value === 'Submission|Reschedule Submission|Get Submission Feedback') {
				$('.task_feedback_reschedule').show();
				$('#task_get_submission_feedback_modal .task_feedback_set_interview #task_feedback_set_interview').val('');
			}
			else if(this.value === 'Submission|Approved by the client|Schedule Interview') {
				$('.task_feedback_set_interview').show();
				$('#task_get_submission_feedback_modal .task_feedback_reschedule #task_feedback_reschedule').val('');
			}
			else if(this.value === 'Submission|Rejected by the client|-') {
				$('#task_get_submission_feedback_modal .task_feedback_reschedule #task_feedback_reschedule').val('');
				$('#task_get_submission_feedback_modal .task_feedback_set_interview #task_feedback_set_interview').val('');
			}
		});
		$('.task_feedback_reschedule input, .task_feedback_set_interview input').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_get_submission_feedback_modal .btn-apply-task').click(function() {
			var status_check = $('#task_get_submission_feedback_options').val();
			var call_back = $('#task_get_submission_feedback_modal #task_feedback_set_interview').val().trim();
			var reschedule_date = $('#task_get_submission_feedback_modal #task_feedback_reschedule').val().trim();
			if(status_check=='Submission|Approved by the client|Schedule Interview')
			{
				if(!call_back){ 
				alert('Schedule Interview Date should not be blank.'); 
				return false; 
			}
			}
			if(status_check=='Submission|Reschedule Submission|Get Submission Feedback')
			{
				if(!reschedule_date){ 
				alert('Reschedule Date should not be blank.'); 
				return false; 
			}
			}
			if(status_check=='-'){ 
				alert('Submission Feedback should not be blank.'); 
				return false; 
			}
			var status = $('#task_get_submission_feedback_options').val().split('|'), 
				primary = '',
				secondary = '',
				next_action = '-'
			primary = status[0];
			secondary = status[1];
			next_action = status[2];
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: primary,
				secondary_status: secondary,
				next_action: next_action,
				scheduled_feedback_date: $('#task_get_submission_feedback_modal .task_feedback_reschedule input').val(),
				scheduled_interview_date: $('#task_get_submission_feedback_modal .task_feedback_set_interview input').val(),
				note: $('#task_get_submission_feedback_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>