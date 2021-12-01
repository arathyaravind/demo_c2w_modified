<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_confirm_attendance_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Confirm Attendance</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<label for="">Confirm Attendance:</label>
					<select id="task_confirm_attendance_options">
						<option value="-">Choose..</option>
						<option value="Interview|Interview Done|Get Interview Feedback">Interview Attended</option>
						<option value="Interview|Interview Rescheduled|Confirm Interview Schedule">Interview Reschedule</option>
						<option value="Interview|Backed Out|-">Backed Out</option>
					</select>
					<div class="task_interview_reschedule conditional-task-field">
						<label for="">Reschedule Interview Date &amp; Time:</label>
						<div>
							<input placeholder="Date" type="text" readonly="" required="" class="smaller" name="task_reschedule_interview_interview_date" id="task_reschedule_interview_interview_date">
							<input placeholder="HH"type="number" min="1" max="12" required="" class="smallest" name="task_reschedule_interview_interview_time_hour" id="task_reschedule_interview_interview_time_hour">
							<input placeholder="MM" type="number" min="0" max="60" required="" class="smallest" name="task_reschedule_interview_interview_time_minute" id="task_reschedule_interview_interview_time_minute">
							<select class="smallest" id="task_reschedule_interview_interview_time_ampm">
								<option value="AM">AM</option>
								<option value="PM">PM</option>
							</select>
							<div class="clearfix"></div>
						</div>
						<div class="task-field">
						<label for="">Reschedule Interview Confirmation Date:</label>
						<input placeholder="Date" type="text" readonly="" required="" class="" name="task_reschedule_interview_confirmation_date" id="task_reschedule_interview_confirmation_date">
					</div>
					</div>
					<div class="task_interview_followup conditional-task-field">
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
		$('#task_confirm_attendance_options').change(function() {

			$('.task_interview_followup').hide();
			$('.task_interview_reschedule').hide();
			if(this.value === 'Interview|Interview Done|Get Interview Feedback') {
				$('.task_interview_followup').show();
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
			else if(this.value === 'Interview|Interview Rescheduled|Confirm Interview Schedule') {
				$('.task_interview_reschedule').show();
				$('#task_confirm_attendance_modal .task_interview_followup #task_interview_followup').val('');
			}
			else if(this.value ==='Interview|Backed Out|-') {
				$('#task_confirm_attendance_modal .task_interview_followup #task_interview_followup').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_confirm_attendance_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
		});
		$('#task_confirm_attendance_modal #task_reschedule_interview_interview_date,#task_confirm_attendance_modal #task_reschedule_interview_confirmation_date,#task_confirm_attendance_modal #task_interview_followup').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_confirm_attendance_modal .btn-apply-task').click(function() {
			var status_check = $('#task_confirm_attendance_options').val();
			var task_interview_followup = $('#task_confirm_attendance_modal #task_interview_followup').val().trim();
			if(status_check=='Interview|Interview Done|Get Interview Feedback')
			{
				if(!task_interview_followup){ 
				alert('Followup Date should not be blank.'); 
				return false; 
			}
			}
			if(status_check=='Interview|Interview Rescheduled|Confirm Interview Schedule')
			{
			var interview_date=$('#task_confirm_attendance_modal #task_reschedule_interview_interview_date').val();
			var interview_hour=$('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_hour').val();
			var interview_minute=$('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_minute').val();
			var interview_confirmation=$('#task_confirm_attendance_modal #task_reschedule_interview_confirmation_date').val().trim();
			if(!interview_date){ 
				alert('Reschedule Interview Date should not be blank.'); 
				return false; 
			}
			if(!interview_hour){ 
				alert('Reschedule Interview Hour should not be blank.'); 
				return false; 
			}
			if(interview_hour>12){ 
				alert('Reschedule Interview Hour should not be greater than 12.'); 
				return false; 
			}
			if(!interview_minute){ 
				alert('Reschedule Interview Minutes should not be blank.'); 
				return false; 
			}
			if(interview_minute>60){ 
				alert('Reschedule Interview Minutes should not be greater than 60.'); 
				return false; 
			}
			if(!interview_confirmation){ 
				alert('Reschedule Interview Confirmation Date should not be blank.'); 
				return false;  
			}
			}
			if(status_check=='-'){ 
				alert('Confirm Attendance should not be blank.'); 
				return false; 
			}
			var status = $('#task_confirm_attendance_options').val().split('|'), 
				primary = '',
				secondary = '',
				next_action = '-'
			primary = status[0];
			secondary = status[1];
			next_action = status[2];
			var interviewDate = $('#task_confirm_attendance_modal #task_reschedule_interview_interview_date').val() + ' ';
			if($('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_hour').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_hour').val() + ':';
			if($('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_minute').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_minute').val() + ' ';
			interviewDate += $('#task_confirm_attendance_modal #task_reschedule_interview_interview_time_ampm').val();
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: primary,
				secondary_status: secondary,
				next_action: next_action,
				interview_date: (next_action === 'Confirm Interview Schedule' ? interviewDate : 0),
				interview_confirmation_date: $('#task_confirm_attendance_modal #task_reschedule_interview_confirmation_date').val(),
				interview_followup_date:$('#task_confirm_attendance_modal #task_interview_followup').val(),
				note: $('#task_get_interview_followup_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>