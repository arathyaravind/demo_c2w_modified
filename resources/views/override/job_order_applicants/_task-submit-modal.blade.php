<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_submit_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Submit</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value" id="applicants"></span></div>
				</div>
				<div>
					<?php
					$template = \DB::table('cms_email_templates')
									->where('slug', 'submit_resume')
									->first()
									->content;
					$template = str_replace('[contact_name]', $office->primary_contact_name, $template);
					$template = str_replace('[candidate_name]', '<span class="jo-applicant-value"></span>', $template);
					$template = str_replace('[your_name]', \CRUDBooster::myName(), $template);
					?>
					<div contenteditable="true" placeholder="Mail content here" class="task_qualify_notes">
						{!! $template !!}
					</div>
					<div class="hint">The resume of of the candidate will be automatically attached with the email</div>
				</div>
				<div class="get-feedback-date">
					<label for="">Get Feedback On:</label>
					<input type="text" readonly="" required="" class="" name="task_submit_feedback" id="task_submit_feedback"
						value="{{ date('d/m/Y', strtotime('tomorrow')) }}">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-apply-task submit_modal">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<style>
#task_submit_modal .task_qualify_notes {
	border: 1px solid #bbb;
    padding: 6px 10px;
}
#task_submit_modal .hint {
	background: #ddd;
    padding: 3px 10px;
    font-size: 95%;
    text-align: center;
}
</style>
<script>
	window.initers.push(function() {
		$('#task_submit_modal .btn-apply-task').click(function() {
			console.log("btn-appl= ", $('#task_submit_modal .btn-apply-task').length);
			var submit_feedback_date = $('#task_submit_modal #task_submit_feedback').val();
			
				if(!submit_feedback_date){ 
					alert('Get Feedback Date should not be blank....!'); 
					return false; 
			    }
			
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: 'Submission',
				secondary_status: 'Submitted to Client',
				next_action: 'Get Submission Feedback',
				feedback_date: $('#task_submit_modal .get-feedback-date input').val()
			}, function(_data) {
				window.location.reload();
			});
		});
		$('#task_submit_modal .get-feedback-date input').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate: '0d'
		});
	});
</script>