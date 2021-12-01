<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_get_interview_feedback_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Interview Feedback</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<label for="">Interview Feedback:</label>
					<select id="task_get_interview_feedback_options">
						<option value="-">Choose..</option>
						<option value="Interview|On Hold|Get Interview Feedback">On Hold</option>
						<option value="Interview|Interview Rescheduled|Confirm Interview Schedule">Interview Reschedule</option>
						<option value="Interview|Shortlisted for Next Round|Confirm Interview Schedule">Shortlisted for Next Round</option>
						<option value="Interview|Interview Feedback Rescheduled|Get Interview Feedback">Interview Feedback Rescheduled</option>
						<option value="Interview|To be Offered|Roll Out Offer">To be Offered</option>
						<option value="Interview|Rejected by the client|-">Rejected by the Client</option>
					</select>
					<div class="task_get_interview_feedback_onhold conditional-task-field">
						<label for="">Follow up Date:</label>
						<input type="text" readonly="" required="" class="" name="task_get_interview_feedback_onhold" id="task_get_interview_feedback_onhold">
					</div>
					<div class="task_get_interview_feedback_to_be_offered conditional-task-field">
						<label for="">Follow up Date:</label>
						<input type="text" readonly="" required="" class="" name="task_get_interview_feedback_to_be_offered" id="task_get_interview_feedback_to_be_offered">
					</div>
					<div class="task_get_interview_feedback_reschedule conditional-task-field">
						<label for="">Reschedule To:</label>
						<input type="text" readonly="" required="" class="" name="task_get_interview_feedback_reschedule" id="task_get_interview_feedback_reschedule">
					</div>
					<div class="task_get_interview_feedback_round2 conditional-task-field">
						<label for="">Interview Date &amp; Time:</label>
						<div>
							<input placeholder="Date" type="text" readonly="" required="" class="smaller" name="task_schedule_interview_interview_r2_date" id="task_schedule_interview_interview_r2_date">
							<input placeholder="HH"type="number" min="1" max="12" required="" class="smallest" name="task_schedule_interview_interview_r2_time_hour" id="task_schedule_interview_interview_r2_time_hour">
							<input placeholder="MM" type="number" min="0" max="60" required="" class="smallest" name="task_schedule_interview_interview_r2_time_minute" id="task_schedule_interview_interview_r2_time_minute">
							<select class="smallest" id="task_schedule_interview_interview_r2_time_ampm">
								<option value="AM">AM</option>
								<option value="PM">PM</option>
							</select>
							<div class="clearfix"></div>
						</div>
						<div class="task-field">
						<label for="">Interview Confirmation Date:</label>
						<input placeholder="Date" type="text" readonly="" required="" class="" name="task_schedule_interview_interview_r2_confirmation_date" id="task_schedule_interview_interview_r2_confirmation_date">
					</div>
					</div>
					<div class="task_interview_reschedule conditional-task-field">
						<label for="">Reschedule Interview Date &amp; Time:</label>
						<div class="interiew_reschedule">
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
					<textarea placeholder="Notes" id="task_get_interview_feedback_notes"></textarea>
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
		$('#task_get_interview_feedback_options').change(function() {
/*			if(this.value === 'Interview|On Hold|Get Interview Feedback') {
				$('.task_get_interview_feedback_onhold').show();
			}
			else {
				$('.task_get_interview_feedback_onhold').hide();
			}
			if(this.value === 'Interview|To be Offered|Roll Out Offer') {
				$('.task_get_interview_feedback_to_be_offered').show();
			}
			else {
				$('.task_get_interview_feedback_to_be_offered').hide();
			}
			if(this.value === 'Interview|Rescheduled|Get Interview Feedback') {
				$('.task_get_interview_feedback_reschedule').show();
			}
			else {
				$('.task_get_interview_feedback_reschedule').hide();
			}
			if(this.value === 'Interview|Shortlisted for Next Round|Confirm Interview Schedule') {
				$('.task_get_interview_feedback_round2').show();
			}
			else {
				$('.task_get_interview_feedback_round2').hide();
			}*/

			$('.task_get_interview_feedback_onhold').hide();
			$('.task_get_interview_feedback_to_be_offered').hide();
			$('.task_get_interview_feedback_reschedule').hide();
			$('.task_get_interview_feedback_round2').hide();
            $('#task_schedule_interview_interview_r2_time_ampm').val('AM');
            $('.interiew_reschedule #task_reschedule_interview_interview_time_ampm').val('AM');
            $('.task_interview_reschedule').hide();
			if(this.value === 'Interview|On Hold|Get Interview Feedback') {
				$('.task_get_interview_feedback_onhold').show();
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_reschedule #task_get_interview_feedback_reschedule').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_minute').val('');
				$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_to_be_offered #task_get_interview_feedback_to_be_offered').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
			else if(this.value === 'Interview|To be Offered|Roll Out Offer') {
				$('.task_get_interview_feedback_to_be_offered').show();
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_onhold #task_get_interview_feedback_onhold').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_reschedule #task_get_interview_feedback_reschedule').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_minute').val('');
				$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
			else if(this.value === 'Interview|Interview Feedback Rescheduled|Get Interview Feedback') {
				$('.task_get_interview_feedback_reschedule').show();
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_onhold #task_get_interview_feedback_onhold').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_minute').val('');
				$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_to_be_offered #task_get_interview_feedback_to_be_offered').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
			else if(this.value === 'Interview|Shortlisted for Next Round|Confirm Interview Schedule') {
				$('.task_get_interview_feedback_round2').show();
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_onhold #task_get_interview_feedback_onhold').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_reschedule #task_get_interview_feedback_reschedule').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_to_be_offered #task_get_interview_feedback_to_be_offered').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
			else if(this.value === 'Interview|Interview Rescheduled|Confirm Interview Schedule') {
				$('.task_interview_reschedule').show();
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_onhold #task_get_interview_feedback_onhold').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_reschedule #task_get_interview_feedback_reschedule').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_to_be_offered #task_get_interview_feedback_to_be_offered').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_minute').val('');
				$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').val('');
			}
			else if(this.value === 'Interview|Rejected by the client|-') {
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_onhold #task_get_interview_feedback_onhold').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_reschedule #task_get_interview_feedback_reschedule').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_round2 #task_schedule_interview_interview_r2_time_minute').val('');
				$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').val('');
				$('#task_get_interview_feedback_modal .task_get_interview_feedback_to_be_offered #task_get_interview_feedback_to_be_offered').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_date').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_hour').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_interview_time_minute').val('');
				$('#task_get_interview_feedback_modal .task_interview_reschedule #task_reschedule_interview_confirmation_date').val('');
			}
		});
		$('#task_get_interview_feedback_modal #task_get_interview_feedback_onhold,#task_get_interview_feedback_modal  #task_get_interview_feedback_reschedule, #task_get_interview_feedback_modal #task_schedule_interview_interview_r2_date,#task_get_interview_feedback_modal #task_get_interview_feedback_to_be_offered,#task_get_interview_feedback_modal #task_reschedule_interview_interview_date,#task_get_interview_feedback_modal #task_reschedule_interview_confirmation_date,#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_get_interview_feedback_modal .btn-apply-task').click(function() {
			var status_check = $('#task_get_interview_feedback_options').val();
			var task_interview_followup = $('#task_get_interview_feedback_onhold').val().trim();
			var task_interview_offered_followup = $('#task_get_interview_feedback_to_be_offered').val().trim();
			var task_interview_reschedule = $('#task_get_interview_feedback_modal #task_get_interview_feedback_reschedule').val().trim();
			if(status_check=='Interview|On Hold|Get Interview Feedback'){
				if(!task_interview_followup){ 
				alert('Followup Date should not be blank.'); 
				return false; 
			}
			}
			if(status_check=='Interview|To be Offered|Roll Out Offer'){
				if(!task_interview_offered_followup){ 
				alert('Offer Followup Date should not be blank.'); 
				return false; 
			}
			}
			if(status_check=='Interview|Interview Feedback Rescheduled|Get Interview Feedback'){
				if(!task_interview_reschedule){ 
				alert('Reschedule Date should not be blank.'); 
				return false; 
			}
			}
			if(status_check=='Interview|Shortlisted for Next Round|Confirm Interview Schedule'){
			var interview_date=$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_date').val().trim();
			var interview_hour=$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_hour').val().trim();
			var interview_minute=$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_minute').val().trim();
			var interview_confirmation=$('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_confirmation_date').val().trim();
			if(!interview_date){ 
				alert('Interview Date should not be blank.'); 
				return false; 
			}
			if(!interview_hour){ 
				alert('Interview Hour should not be blank.'); 
				return false; 
			}
			if(interview_hour>12){ 
				alert('Interview Hour should not be greater than 12.'); 
				return false; 
			}
			if(!interview_minute){ 
				alert('Interview Minutes should not be blank.'); 
				return false; 
			}
			if(interview_minute>60){ 
				alert('Interview Minutes should not be greater than 60.'); 
				return false; 
			}
			if(!interview_confirmation){ 
				alert('Interview Confirmation Date should not be blank.'); 
				return false;  
			}
			}
			if(status_check=='Interview|Interview Rescheduled|Confirm Interview Schedule'){
			var rinterview_date=$('.interiew_reschedule #task_reschedule_interview_interview_date').val().trim();
			var rinterview_hour=$('.interiew_reschedule #task_reschedule_interview_interview_time_hour').val().trim();
			var rinterview_minute=$('.interiew_reschedule #task_reschedule_interview_interview_time_minute').val().trim();
			var rinterview_confirmation=$('#task_get_interview_feedback_modal #task_reschedule_interview_confirmation_date').val().trim();
			if(!rinterview_date){ 
				alert('Reschedule Interview Date should not be blank.'); 
				return false; 
			}
			if(!rinterview_hour){ 
				alert('Reschedule Interview Hour should not be blank.'); 
				return false; 
			}
			if(rinterview_hour>12){ 
				alert('Reschedule Interview Hour should not be greater than 12.'); 
				return false; 
			}
			if(!rinterview_minute){ 
				alert('Reschedule Interview Minutes should not be blank.'); 
				return false; 
			}
			if(rinterview_minute>60){ 
				alert('Reschedule Interview Minutes should not be greater than 60.'); 
				return false; 
			}
			if(!rinterview_confirmation){ 
				alert('Reschedule Interview Confirmation Date should not be blank.'); 
				return false;  
			}
			}
			if(status_check=='-'){ 
				alert('Interview Feedback should not be blank.'); 
				return false; 
			}
			var status = $('#task_get_interview_feedback_options').val().split('|'), 
				primary = '',
				secondary = '',
				next_action = '-'
			primary = status[0];
			secondary = status[1];
			next_action = status[2];

			var interviewDate = $('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_date').val() + ' ';
			if($('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_hour').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_hour').val() + ':';
			if($('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_minute').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_minute').val() + ' ';
			interviewDate += $('#task_get_interview_feedback_modal #task_schedule_interview_interview_r2_time_ampm').val();

			var rinterviewDate = $('.interiew_reschedule #task_reschedule_interview_interview_date').val() + ' ';
			if($('.interiew_reschedule #task_reschedule_interview_interview_time_hour').val().length === 1) {
				rinterviewDate += '0';
			}
			rinterviewDate += $('.interiew_reschedule #task_reschedule_interview_interview_time_hour').val() + ':';
			if($('.interiew_reschedule #task_reschedule_interview_interview_time_minute').val().length === 1) {
				rinterviewDate += '0';
			}
			rinterviewDate += $('.interiew_reschedule #task_reschedule_interview_interview_time_minute').val() + ' ';
			rinterviewDate += $('.interiew_reschedule #task_reschedule_interview_interview_time_ampm').val();

			var followupDate = 0;
			var rescheduleDate = 0;
			var interviewConfirmationDate='';
			if(secondary === 'Interview Rescheduled')
				interviewDate=rinterviewDate;
			    interviewConfirmationDate=$('#task_get_interview_feedback_modal  #task_reschedule_interview_confirmation_date').val();
			if(secondary === 'Shortlisted for Next Round')
				interviewConfirmationDate=interview_confirmation;
			if(secondary === 'To be Offered')
				followupDate = $('#task_get_interview_feedback_to_be_offered').val();
			if(secondary === 'On Hold')
				followupDate = $('#task_get_interview_feedback_onhold').val();
			if(secondary === 'Interview Feedback Rescheduled')
				rescheduleDate = $('#task_get_interview_feedback_modal #task_get_interview_feedback_reschedule').val();
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: primary,
				secondary_status: secondary,
				next_action: next_action,
				interview_date: (next_action === 'Confirm Interview Schedule' ? interviewDate : 0),
				interview_confirmation_date:(next_action === 'Confirm Interview Schedule' ? interviewConfirmationDate : 0),
				interview_followup_date: followupDate,
				interview_reschedule_date: rescheduleDate,
				increment_interview_round: (secondary === 'Shortlisted for Next Round' ? 1 : 0),
				note: $('#task_get_interview_feedback_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>