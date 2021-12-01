    <div class="modal fade" tabindex="-1" role="dialog" id="status_modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Change Applicant Status</h4>
				</div>
				<div class="modal-body">
					<div class="text-danger"><p class="status_pmsg"></p></div>
					<div class="well">
						<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
						<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
						<input type="hidden" id="increment_interview_round" name="increment_interview_round"	value=""/>	
					</div>
					<div class="jo-col-primary-status">
						<label for="">Primary Status</label>
						<select name="" id="primary_status">
							<option value="">Choose..</option>
							<!-- <option value="Pipeline">Pipeline</option> -->
							<option value="Qualify">Qualify</option>
							<option value="Submission">Submission</option>
							<option value="Interview">Interview</option>
							<option value="Offer">Offer</option>
							<option value="Place">Place</option>
						</select>
					</div>
					<div class="jo-col-secondary-status">
						<label for="">Secondary Status</label>
						<select name="" id="secondary_status">
							<option value="">Choose..</option>
							<!-- <option value="Associated" data-next-step="Review">
								Associated
							</option> -->
							<!-- <option value="Reviewed" data-next-step="Qualify">
								Reviewed
							</option>
							
							<option value="Schedule Call Back" data-next-step="Qualify">
								Schedule Call Back
							</option>
							
							<option value="Declined by C2W" data-next-step="-">
								Declined by C2W
							</option>
							<option value="Qualified" data-next-step="Submit">
								Qualified
							</option>
							<option value="Submitted to client" data-next-step="Get Submission Feedback">
								Submitted to client
							</option>
							<option value="Approved by the client" data-next-step="Get Submission Feedback">
								Approved by client
							</option>
							<option value="Reschedule Submission" data-next-step="Get Submission Feedback">
								Reschedule Submission
							</option>
							<option value="Rejected by the client" data-next-step="-">
								Rejected by client
							</option>
							<option value="Interview to be Scheduled" data-next-step="Schedule Interview">
								Interview to be Scheduled
							</option> -->
							<option value="Pending Review" data-next-step="Qualify">
								Pending Review
							</option>
							<option value="Qualified" data-next-step="Submit">
								Qualified
							</option>
							<option value="Schedule Call Back" data-next-step="Qualify">
								Schedule Call Back
							</option>
							<option value="Declined by C2W" data-next-step="-">
								Declined by C2W
							</option>
							<option value="Submitted to Client" data-next-step="Get Submission Feedback">
								Submitted to Client
							</option>
						    <option value="Approved by the client" data-next-step="Schedule Interview">
								Approved by the client
							</option>
							<option value="Reschedule Submission" data-next-step="Get Submission Feedback">
								Reschedule Submission
							</option>
							<option value="Interview Scheduled" data-next-step="Confirm Interview Schedule">
								Interview Scheduled
							</option>
							<option value="Interview Rescheduled" data-next-step="Confirm Interview Schedule">
								Interview Rescheduled
							</option>
							<option value="Interview in Progress" data-next-step="Confirm Attendance">
								Interview in Progress
							</option>
							<option value="Interview Done" data-next-step="Get Interview Feedback">
								Interview Done
							</option>
							<option value="On Hold" data-next-step="Get Interview Feedback">
								On Hold
							</option>
							<option value="Shortlisted for Next Round" data-next-step="Confirm Interview Schedule">
								Shortlisted for Next Round
							</option>
							<!-- <option value="Rejected for Interview" data-next-step="-">
								Rejected for Interview
							</option>
							
							<option value="Waiting for Consensus" data-next-step="-">
								Waiting for Consensus
							</option> -->
							
							<option value="Interview Feedback Rescheduled" data-next-step="Get Interview Feedback">
							Interview Feedback Rescheduled
							</option>
							<option value="To be Offered" data-next-step="Roll Out Offer">
								To be Offered
							</option>
							<option value="Rejected by the client" data-next-step="-">
								Rejected by the client
							</option>
							<!-- <option value="Rejected" data-next-step="-">
								Rejected
							</option>-->
							<!-- <option value="Rejected Hirable" data-next-step="-">
								Rejected Hirable
							</option>  -->
							<option value="Offer Made" data-next-step="Confirm Offer">
								<!-- Inform Candidate -->
								Offer Made
							</option>
							<option value="Confirm Offer Follow Up" data-next-step="Confirm Offer">
								<!-- Inform Client -->
								Confirm Offer Follow Up 
							</option>
							<option value="Offer Accepted" data-next-step="Confirm Joining">
								<!-- Inform Client -->
								Offer Accepted
							</option>
							<option value="Offer Declined" data-next-step="-">
								<!-- Inform Client -->
								Offer Declined
							</option>
							<option value="Offer Withdrawn" data-next-step="-">
								<!-- Inform Candidate -->
								Offer Withdrawn
							</option>
							<option value="No Show" data-next-step="-">
								<!-- Call Candidate -->
								No Show
							</option>
							<option value="Un Qualified" data-next-step="-">
								<!-- Inform Candidate -->
								Un Qualified
							</option>
							<option value="Joined" data-next-step="Send Invoice">
								<!-- Post Hire Follow up -->
								Joined
							</option>
							<option value="Joining Extended" data-next-step="Confirm Joining">
								<!-- Post Hire Follow up -->
								Joining Extended
							</option>
							<option value="Backed Out" data-next-step="-">
								<!-- Post Hire Follow up -->
							Backed Out 
							</option>
							<!-- <option value="Converted Employee" data-next-step="All done. :)">
								Converted - Employee
							</option> -->
						</select>
					</div>
					<div class="jo-col-next-action">
						<label for="">Next Action</label>
						<input type="text" id="next_action" readonly="readonly">
					</div>
					<div class="clearfix"></div>
					<div class="callback conditional-task-field">
						<label for="">Schedule Call Back:</label>
						<input type="text" readonly="" required="" class="" name="task_qualify_callback" id="task_qualify_callback">
					</div>
					<div class="submission conditional-task-field">
						<label for="">Submission Date:</label>
						<input type="text" readonly="" required="" class="" name="task_qualify_submission" id="task_qualify_submission"
							value="{{ $date}}">
					</div>
					<div class="get-feedback-date conditional-task-field">
						<br/><div>
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
						<label for="">Get Feedback On:</label>
						<input type="text" readonly="" required="" class="" name="task_submit_feedback" id="task_submit_feedback"
							value="{{ date('d/m/Y', strtotime('tomorrow')) }}">
					</div>
					<div class="task_feedback_reschedule conditional-task-field">
						<label for="">Reschedule:</label>
						<input type="text" readonly="" required="" class="" name="task_feedback_reschedule" id="task_feedback_reschedule">
					</div>
					<div class="task_feedback_set_interview conditional-task-field">
						<label for="">Schedule Interview:</label>
						<input type="text" readonly="" required="" class="" name="task_feedback_set_interview" id="task_feedback_set_interview" 
							value="">
					</div>
					<div class="task_schedule_interview conditional-task-field">
					<label for="">Interview Date &amp; Time:</label>
					<div>
						<input placeholder="Date" type="text" readonly="" required="" class="smaller" name="task_schedule_interview_interview_date" id="task_schedule_interview_interview_date">
						<input placeholder="HH"type="number" min="1" max="12" required="" class="smallest" name="task_schedule_interview_interview_time_hour" id="task_schedule_interview_interview_time_hour">
						<input placeholder="MM" type="number" min="0" max="60" required="" class="smallest" name="task_schedule_interview_interview_time_minute" id="task_schedule_interview_interview_time_minute">
						<select class="smallest" id="task_schedule_interview_interview_time_ampm">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>	
						<div class="clearfix"></div>
					</div>
					<div class="task-field interview_confirmation_div">
						<label for="">Interview Confirmation Date:</label>
						<input placeholder="Date" type="text" readonly="" required="" class="" name="task_schedule_interview_confirmation_date" id="task_schedule_interview_confirmation_date">
					</div>
				</div>
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
						<input type="text" readonly="" required="" class="" name="task_interview_followup" id="task_interview_followup" value=' '>
					</div>
					<div class="task_confirm_attendance conditional-task-field">
						<label for="">Interview Date:</label>
						<input type="text" readonly="" required="" class="" name="task_confirm_attendance" id="task_confirm_attendance" value=' '>
					</div>
					<div class="task_get_interview_feedback_reschedule conditional-task-field">
						<label for="">Reschedule To:</label>
						<input type="text" readonly="" required="" class="" name="task_get_interview_feedback_reschedule" id="task_get_interview_feedback_reschedule">
					</div>
					<div class="task_get_roll_out_offer_confirmation conditional-task-field">
						<div class="task-field">
						<label for="">Offer Confirmation Date:</label>
						<input placeholder="Date" type="text" readonly="" required="" class="" name="task_roll_out_offer_confirmation_date" id="task_roll_out_offer_confirmation_date">
					</div>
					</div>
					<div class="task_confirm_offer_joining_date conditional-task-field">
						<label for="">Date of Joining:</label>
						<input type="text" readonly="" required="" class="" name="task_confirm_offer_joining_date" id="task_confirm_offer_joining_date">
					</div>
					<div class="task_confirm_offer_ctc conditional-task-field">
						<label for="ctc">CTC:</label>
						<input type="number" required="" Placeholder="Lakhs" step="0.01"class="confirm_offer_ctc" name="task_confirm_offer_ctc" id="task_confirm_offer_ctc" onkeypress="return checkIsNumber(event)">
					</div>
					<textarea placeholder="Notes" id="status_notes"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success btn-save-status">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	window.initers.push(function() {
		$('#status_modal #primary_status').change(function() {
			$('#status_modal #secondary_status').val('');
			$("#status_modal .modal-body input").val('');
			$('#status_modal .callback').hide();
			$('#status_modal .submission').hide();
			$('#status_modal .get-feedback-date').hide();
			$('#status_modal .task_feedback_reschedule').hide();
			$('#status_modal .task_feedback_set_interview').hide();
			$('#status_modal .task_schedule_interview').hide();
			$('#status_modal .task_interview_reschedule').hide();
			$('#status_modal .task_interview_followup').hide();
			$('#status_modal .task_confirm_attendance').hide();
			$('#status_modal .task_get_interview_feedback_reschedule').hide();
			$('#status_modal .task_get_roll_out_offer_confirmation').hide();
			$('#status_modal .task_confirm_offer_joining_date').hide();
			$('#status_modal .task_confirm_offer_ctc').hide();
		});
		$('#status_modal #secondary_status').change(function() {
			$("#status_modal .modal-body input").val('');
			$('#status_modal .callback').hide();
			$('#status_modal .submission').hide();
			$('#status_modal .get-feedback-date').hide();
			$('#status_modal .task_feedback_reschedule').hide();
			$('#status_modal .task_feedback_set_interview').hide();
			$('#status_modal .task_schedule_interview').hide();
			$('#status_modal .task_interview_reschedule').hide();
			$('#status_modal .task_interview_followup').hide();
			$('#status_modal .task_confirm_attendance').hide();
			$('#status_modal .task_get_interview_feedback_reschedule').hide();
			$('#status_modal .task_get_roll_out_offer_confirmation').hide();
			$('#status_modal .task_confirm_offer_joining_date').hide();
			$('#status_modal .task_confirm_offer_ctc').hide();
			if(this.value === 'Schedule Call Back') {
				$('#status_modal .callback').show();
			}
			else if(this.value === 'Qualified') {
				$('#status_modal .submission').show();
			}
			else if(this.value === 'Submitted to Client') {
				$('#status_modal .get-feedback-date input').val('{{ date('d/m/Y', strtotime('tomorrow')) }}');
                $('#status_modal .get-feedback-date input').datepicker('setDate', '{{ date('d/m/Y', strtotime('tomorrow')) }}');
				$('#status_modal .get-feedback-date').show();
			}
			else if(this.value === 'Approved by the client') {
				$('#status_modal .task_feedback_set_interview').show();
			}
			else if(this.value === 'Reschedule Submission') {
				$('#status_modal .task_feedback_reschedule').show();
			}
			else if(this.value === 'Interview Scheduled'||this.value === 'Shortlisted for Next Round') {
				$('#status_modal .task_schedule_interview').show();
				/*if(this.value === 'Shortlisted for Next Round'){
					$('#status_modal .task_schedule_interview .interview_confirmation_div').hide();
				}
				else{
					$('#status_modal .task_schedule_interview .interview_confirmation_div').show();
				}*/
			}
			else if(this.value === 'Interview Rescheduled') {
				$('#status_modal .task_interview_reschedule').show();
			}
			else if(this.value === 'Interview Done'||this.value === 'On Hold'||this.value === 'To be Offered'||this.value === 'Confirm Offer Follow Up') {
				$('#status_modal .task_interview_followup').show();
			}
			else if(this.value === 'Interview in Progress') {
				$('#status_modal .task_confirm_attendance').show();
			}
			else if(this.value === 'Interview Feedback Rescheduled') {
			    $('#status_modal .task_get_interview_feedback_reschedule').show();
			}
			else if(this.value === 'Offer Made') {
			     $('#status_modal .task_get_roll_out_offer_confirmation').show();	
			}
			else if(this.value === 'Offer Accepted'||this.value==='Joining Extended') {
			     $('#status_modal .task_confirm_offer_joining_date').show();
			     if (this.value === 'Offer Accepted') {
			     	 $('#status_modal .task_confirm_offer_ctc').show();	
			     }
			    
			}
		});
		$('#status_modal .callback input, #status_modal .submission input,#status_modal .get-feedback-date input,#status_modal .task_feedback_reschedule input,#status_modal .task_feedback_set_interview input,#status_modal #task_schedule_interview_interview_date,#status_modal #task_schedule_interview_confirmation_date,#status_modal #task_reschedule_interview_interview_date,#status_modal #task_interview_followup,#status_modal #task_get_interview_feedback_reschedule,#status_modal #task_roll_out_offer_confirmation_date,#status_modal #task_confirm_offer_joining_date,#status_modal #task_confirm_attendance,#status_modal #task_reschedule_interview_confirmation_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('.btn-save-status').click(function() {
        	var status_check = $('#status_modal #secondary_status').val().trim();
			var call_back = $('#status_modal  #task_qualify_callback').val().trim();
			var qualify_date = $('#status_modal #task_qualify_submission').val().trim();
			var submit_feedback_date = $('#status_modal #task_submit_feedback').val().trim();
			var submitted_call_back = $('#status_modal #task_feedback_set_interview').val().trim();
			var submitted_reschedule_date = $('#status_modal #task_feedback_reschedule').val().trim();
			var interview_date=$('#status_modal #task_schedule_interview_interview_date').val().trim();
			var interview_hour=$('#status_modal #task_schedule_interview_interview_time_hour').val().trim();
			var interview_minute=$('#status_modal #task_schedule_interview_interview_time_minute').val().trim();
			var interview_confirmation=$('#status_modal #task_schedule_interview_confirmation_date').val().trim();
			var rinterview_date=$('#status_modal #task_reschedule_interview_interview_date').val();
			var rinterview_hour=$('#status_modal #task_reschedule_interview_interview_time_hour').val();
			var rinterview_minute=$('#status_modal #task_reschedule_interview_interview_time_minute').val();
			var rinterview_confirmation=$('#status_modal #task_reschedule_interview_confirmation_date').val().trim();
			var task_interview_followup = $('#status_modal #task_interview_followup').val().trim();
			var task_confirm_attendance= $('#status_modal #task_confirm_attendance').val().trim();
			var task_interview_reschedule = $('#status_modal #task_get_interview_feedback_reschedule').val().trim();
			var offer_confirm_date = $('#status_modal #task_roll_out_offer_confirmation_date').val().trim();
			var joining_date = $('#status_modal #task_confirm_offer_joining_date').val().trim();
			var ctc = $('#status_modal #task_confirm_offer_ctc').val().trim();
			if(status_check=='-'){ 
				alert('Confirm Interview Schedule should not be blank.'); 
				return false; 
			}
			if(!($('#status_modal #primary_status').val())){
				alert('Kindly Select The Primary Status!');
	            return false;	
			}
			if(!status_check) {
	            alert('Kindly Select The Secondary Status!');
	            return false;
            }
			if(status_check==='Schedule Call Back')
			{
				if(!call_back){ 
				alert('Schedule Call Back Date should not be blank.'); 
				return false; 
			    }
			}
			else if(status_check==='Qualified')
			{
				if(!qualify_date){ 
				alert('Submission Date should not be blank.'); 
				return false; 
			    }
			}
			else if(status_check==='Submitted to Client')
			{
				if(!submit_feedback_date){ 
					alert('Get Feedback Date should not be blank!'); 
					return false; 
			    }
			}
			else if(status_check==='Approved by the client')
			{
				if(!submitted_call_back){ 
				alert('Schedule Interview Date should not be blank.'); 
				return false; 
			}
			}
			else if(status_check==='Reschedule Submission')
			{
				if(!submitted_reschedule_date){ 
				alert('Reschedule Date should not be blank.'); 
				return false; 
			}
			}
			else if(status_check==='Interview Scheduled'||status_check==='Shortlisted for Next Round')
			{
			$('#increment_interview_round').val('1');
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
			var interviewDate = $('#status_modal #task_schedule_interview_interview_date').val() + ' ';
			if($('#status_modal #task_schedule_interview_interview_time_hour').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#status_modal #task_schedule_interview_interview_time_hour').val() + ':';
			if($('#status_modal #task_schedule_interview_interview_time_minute').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#status_modal #task_schedule_interview_interview_time_minute').val() + ' ';
			interviewDate += $('#status_modal #task_schedule_interview_interview_time_ampm').val();
		   }
		   else if(status_check==='Interview Rescheduled')
			{
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
			var interviewDate = $('#status_modal #task_reschedule_interview_interview_date').val() + ' ';
			if($('#status_modal #task_reschedule_interview_interview_time_hour').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#status_modal #task_reschedule_interview_interview_time_hour').val() + ':';
			if($('#status_modal #task_reschedule_interview_interview_time_minute').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#status_modal #task_reschedule_interview_interview_time_minute').val() + ' ';
			interviewDate += $('#status_modal #task_reschedule_interview_interview_time_ampm').val();
			interview_confirmation=rinterview_confirmation;
		   }
		   else if(status_check==='Interview Done'||status_check==='On Hold'||status_check==='To be Offered'||status_check==='Confirm Offer Follow Up')
			{   
				var offer_followup_date='';

				if(!task_interview_followup){
					if(status_check==='To be Offered'){
	                   alert('Offer Followup Date should not be blank.');
					}
					else if(status_check==='Confirm Offer Follow Up'){ 
	                   alert('Confirm Offer Followup Date should not be blank.');
					}
					else{
					   alert('Followup Date should not be blank.'); 	
					}
				return false; 
			    }
			    else{
			         if(status_check==='Confirm Offer Follow Up'){ 
					   offer_followup_date=task_interview_followup;
					   task_interview_followup='';
					 }	
			    }
			}
			else if(status_check==='Interview Feedback Rescheduled')
			{
				if(!task_interview_reschedule){ 
				alert('Reschedule Date should not be blank.'); 
				return false; 
			    }
			}
			else if(status_check==='Offer Made')
			{
				if(!offer_confirm_date){ 
				alert('Offer Confirmation Date should not be blank.'); 
				return false; 
			    }
			}
			else if(status_check==='Interview in Progress')
			{
				if(!task_confirm_attendance){ 
				alert('Interview Date should not be blank.'); 
				return false; 
			    }
			}
			else if(status_check==='Offer Accepted'||status_check==='Joining Extended')
			{
				if(!joining_date){
					alert('Joining Date should not be blank.');
					$('#status_modal .task_confirm_offer_joining_date').val('');
					return false;
				}
				if(status_check==='Offer Accepted'){
					if(!ctc) {
						alert('Enter CTC in correct format.');
						$('#status_modal #task_confirm_offer_ctc').val('');
						return false;
					}	
				}
				
			}
			    var value=$(this).attr('data-id');
        $.post('/custom/set-applicant-status', {
                id: $(this).attr('data-id'),
                primary_status: $('#primary_status').val(),
                secondary_status: $('#secondary_status').val(),
                next_action: $('#next_action').val(),
                callback: (call_back ? call_back: ' '),
				submission:(qualify_date ? qualify_date: ' '),
				feedback_date: (submit_feedback_date ? submit_feedback_date: ' '),
				scheduled_interview_date:(submitted_call_back ? submitted_call_back: ' '),
				scheduled_feedback_date:(submitted_reschedule_date ? submitted_reschedule_date: ' '),
				interview_date: (interviewDate ? interviewDate: ' '),
				interview_confirmation_date: (interview_confirmation ? interview_confirmation: ' '),
				increment_interview_round:$('#status_modal #increment_interview_round').val(),
				interview_followup_date: (task_interview_followup ? task_interview_followup: ' '),
				confirm_offer_followup_date:(offer_followup_date ? offer_followup_date: ' '),
				interview_reschedule_date:(task_interview_reschedule ? task_interview_reschedule: ' '),
				offer_confirmation_date:(offer_confirm_date ? offer_confirm_date: ' '),
				joining_date:(joining_date  ? joining_date: ' '),
				approved_ctc: (ctc ? ctc: ' '),
				task_confirm_attendance:(task_confirm_attendance ? task_confirm_attendance:' '),
                note: $('#status_notes').val(),
            }, function(_data) {
                if(_data==='OK') {
                	console.log(_data);
                   window.location.reload();
                }
            });
    });
	});
</script>