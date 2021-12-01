<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_schedule_interview_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Schedule Interview</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
					<input type="hidden" id="increment_interview_round" name="increment_interview_round"	value=""/>			
				</div>
				<div>
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
					<div class="task-field">
						<label for="">Interview Confirmation Date:</label>
						<input placeholder="Date" type="text" readonly="" required="" class="" name="task_schedule_interview_confirmation_date" id="task_schedule_interview_confirmation_date">
					</div>
					<textarea placeholder="Notes" id="task_schedule_interview_notes"></textarea>
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
		$('#task_schedule_interview_modal #task_schedule_interview_interview_date, #task_schedule_interview_modal #task_schedule_interview_confirmation_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_schedule_interview_modal .btn-apply-task').click(function() {
			$('#task_schedule_interview_modal  #increment_interview_round').val('1');
			var primary = 'Interview',
				secondary = 'Interview Scheduled',
				next_action = 'Confirm Interview schedule';
			var interview_date=$('#task_schedule_interview_modal #task_schedule_interview_interview_date').val().trim();
			var interview_hour=$('#task_schedule_interview_modal #task_schedule_interview_interview_time_hour').val().trim();
			var interview_minute=$('#task_schedule_interview_modal #task_schedule_interview_interview_time_minute').val().trim();
			var interview_confirmation=$('#task_schedule_interview_modal #task_schedule_interview_confirmation_date').val().trim();
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
			var interviewDate = $('#task_schedule_interview_modal #task_schedule_interview_interview_date').val() + ' ';
			if($('#task_schedule_interview_modal #task_schedule_interview_interview_time_hour').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#task_schedule_interview_modal #task_schedule_interview_interview_time_hour').val() + ':';
			if($('#task_schedule_interview_modal #task_schedule_interview_interview_time_minute').val().length === 1) {
				interviewDate += '0';
			}
			interviewDate += $('#task_schedule_interview_modal #task_schedule_interview_interview_time_minute').val() + ' ';
			interviewDate += $('#task_schedule_interview_modal #task_schedule_interview_interview_time_ampm').val();
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: 'Interview',
				secondary_status: 'Interview Scheduled',
				next_action: 'Confirm Interview Schedule',
				interview_date: interviewDate,
				interview_confirmation_date: $('#task_schedule_interview_modal #task_schedule_interview_confirmation_date').val(),
				increment_interview_round:$('#task_schedule_interview_modal #increment_interview_round').val(),
				note: $('#task_schedule_interview_notes').val()
			}, function(_data) {
			    window.location.reload();
			});
		});
	});
</script>