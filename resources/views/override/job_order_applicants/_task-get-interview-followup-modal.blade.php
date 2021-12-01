<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_get_interview_followup_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Get Interview Followup</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<div class="task_interview_followup">
						<label for="">Followup Date:</label>
						<input type="text" readonly="" required="" class="" name="task_interview_followup" id="task_interview_followup">
					</div>
					<textarea placeholder="Notes" id="task_get_interview_followup_notes"></textarea>
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
	
		$('#task_get_interview_followup_modal #task_interview_followup').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_get_interview_followup_modal .btn-apply-task').click(function() {
			var task_interview_followup = $('#task_get_interview_followup_modal #task_interview_followup').val().trim();
				if(!task_interview_followup){ 
				alert('Followup Date should not be blank.'); 
				return false; 
			   }
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: 'Interview',
				secondary_status:'Interview Done',
				next_action: 'Get Interview Feedback',
				interview_followup_date:$('#task_get_interview_followup_modal #task_interview_followup').val(),
				note: $('#task_get_interview_followup_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>