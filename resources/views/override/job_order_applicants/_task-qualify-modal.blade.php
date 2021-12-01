<?php $curdate=strtotime(date('Y-m-d'));
$mydate=strtotime($jobOrder->submission_date);

if($curdate > $mydate)
{
    $date=date('d/m/Y');
}
else{
	$date=date('d/m/Y', strtotime($jobOrder->submission_date));
}
 ?>

<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_qualify_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Qualify</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					{{-- <div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div> --}}
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title ? $jobOrder->title  : "" }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<label for="">Qualify Options:</label>
					<select id="task_qualify_options">
						<option value="-">Choose..</option>
						<option value="Qualify|Qualified|Submit">Qualified</option>
						<option value="Qualify|Schedule Call Back|Qualify">Schedule Call Back</option>
						<option value="Qualify|Declined by C2W|-">Declined by C2W</option>
						
					</select>
					<div class="callback conditional-task-field">
						<label for="">Schedule Call Back:</label>
						<input type="text" readonly="" required="" class="" name="task_qualify_callback" id="task_qualify_callback">
					</div>
					<div class="submission conditional-task-field">
						<label for="">Submission Date:</label>
						<input type="text" readonly="" required="" class="" name="task_qualify_submission" id="task_qualify_submission"
							value="{{ $date}}">
					</div>
					<textarea placeholder="Notes" id="task_qualify_notes"></textarea>
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
		$('#task_qualify_options').change(function() {
			$('#task_qualify_modal .callback').hide();
			$('#task_qualify_modal .submission').hide();
			if(this.value === 'Qualify|Schedule Call Back|Qualify') {
				$('#task_qualify_modal .callback').show();
				$('#task_qualify_modal .submission #task_qualify_submission').val(' ');
				$('#task_qualify_modal .submission').hide();
			}
			else if(this.value === 'Qualify|Qualified|Submit') {
				$('#task_qualify_modal .callback').hide();
				$('#task_qualify_modal .callback #task_qualify_callback').val(' ');
				$('#task_qualify_modal .submission').show();
			}
			else if(this.value === 'Qualify|Declined by C2W|-'){
				$('#task_qualify_modal .submission').hide();
				$('#task_qualify_modal .callback').hide();
				$('#task_qualify_modal .callback #task_qualify_callback').val(' ');
				$('#task_qualify_modal .submission #task_qualify_submission').val(' ');
			}
		});
		$('#task_qualify_modal .callback input, #task_qualify_modal .submission input').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_qualify_modal .btn-apply-task').click(function() {
			var status_check = $('#task_qualify_options').val();
			var call_back = $('#task_qualify_modal #task_qualify_callback').val().trim();
			var qualify_date = $('#task_qualify_modal #task_qualify_submission').val().trim();
			if(status_check=='-'){ 
				alert('Qualify Options should not be blank.'); 
				return false; 
			}
			if(status_check=='Qualify|Schedule Call Back|Qualify')
			{
				if(!call_back){ 
				alert('Schedule Call Back Date should not be blank.'); 
				return false; 
			    }
			}
			if(status_check=='Qualify|Qualified|Submit')
			{
				if(!qualify_date){ 
				alert('Submission Date should not be blank.'); 
				return false; 
			    }
			}
			var status = $('#task_qualify_options').val().split('|'), 
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
				callback: $('#task_qualify_modal .callback input').val(),
				submission: $('#task_qualify_modal .submission input').val(),
				note: $('#task_qualify_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>