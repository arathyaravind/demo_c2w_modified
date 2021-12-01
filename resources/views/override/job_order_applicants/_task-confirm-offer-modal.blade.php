<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_confirm_offer_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Confirm Offer</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<label for="">Confirm Offer:</label>
					<select id="task_confirm_offer_options">
						<option value="-">Choose..</option>
						<option value="Offer|Confirm Offer Follow Up|Confirm Offer">Confirm Offer Follow Up</option>
						<option value="Offer|Offer Accepted|Confirm Joining">Offer Accepted</option>
						<option value="Offer|Offer Declined|-">Offer Declined</option>
						<option value="Offer|Offer Withdrawn|-">Offer Withdrawn</option>
						<option value="Offer|No Show|-">No Show</option>
						<option value="Offer|Un Qualified|-">Un Qualified</option>
					</select>
					<div class="task_confirm_offer_joining_date conditional-task-field">
						<label for="">Date of Joining:</label>
						<input type="text" readonly="" required="" class="" name="task_confirm_offer_joining_date" id="task_confirm_offer_joining_date">
					</div>
					<div class="task_confirm_offer_ctc conditional-task-field">
						<label for="ctc">CTC:</label>
						<input type="number" required="" Placeholder="Lakhs" step="0.01"class="confirm_offer_ctc" name="task_confirm_offer_ctc" id="task_confirm_offer_ctc" onkeypress="return checkIsNumber(event)">
					</div>
					<div class="task_confirm_offer_feedback_followup conditional-task-field">
						<label for="">Follow up Date:</label>
						<input type="text" readonly="" required="" class="" name="task_confirm_offer_feedback_followup" id="task_confirm_offer_feedback_followup">
					</div>
					<textarea placeholder="Notes" id="task_confirm_offer_notes"></textarea>
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
	
	function checkIsNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}
		return true;
	}

	window.initers.push(function() {

		$('#task_confirm_offer_options').change(function() {
			if(this.value === 'Offer|Offer Accepted|Confirm Joining') {
				$('.task_confirm_offer_joining_date').show();
				$('.task_confirm_offer_ctc').show();
				$('.task_confirm_offer_feedback_followup').hide();
				$('#task_confirm_offer_modal #task_confirm_offer_feedback_followup').val('');
			}
			else if(this.value === 'Offer|Confirm Offer Follow Up|Confirm Offer') {
				$('.task_confirm_offer_joining_date').hide();
				$('.task_confirm_offer_ctc').hide();
				$('.task_confirm_offer_feedback_followup').show();
				$('#task_confirm_offer_modal .task_confirm_offer_joining_date #task_confirm_offer_joining_date').val('');
				$('#task_confirm_offer_modal .task_confirm_offer_ctc #task_confirm_offer_ctc').val('');
			}
			else {
				$('.task_confirm_offer_joining_date').hide();
				$('.task_confirm_offer_ctc').hide();
				$('.task_confirm_offer_feedback_followup').hide();
				$('#task_confirm_offer_modal .task_confirm_offer_joining_date #task_confirm_offer_joining_date').val('');
				$('#task_confirm_offer_modal .task_confirm_offer_ctc #task_confirm_offer_ctc').val('');
				$('#task_confirm_offer_modal #task_confirm_offer_feedback_followup').val('');
			}
		});
		$('#task_confirm_offer_modal #task_confirm_offer_joining_date,#task_confirm_offer_modal #task_confirm_offer_feedback_followup').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_confirm_offer_modal .btn-apply-task').click(function() {
			var task_confirm_offer_options = $('#task_confirm_offer_options').val();
			if(task_confirm_offer_options == '-'){
				alert('Confirm Offer should not be blank.');
				return false;
			}
			if(task_confirm_offer_options == 'Offer|Offer Accepted|Confirm Joining'){
				var joining_date = $('#task_confirm_offer_modal #task_confirm_offer_joining_date').val().trim();
				if(!joining_date){
					alert('Joining Date should not be blank.');
					$('#task_confirm_offer_modal .task_confirm_offer_joining_date').val('');
					return false;
				}
				var ctc = $('#task_confirm_offer_modal #task_confirm_offer_ctc').val().trim();
				if(!ctc) {
					alert('Enter CTC in correct format.');
					$('#task_confirm_offer_modal #task_confirm_offer_ctc').val('');
					return false;
				}
			}
			if(task_confirm_offer_options == 'Offer|Confirm Offer Follow Up|Confirm Offer'){
				var offer_date = $('#task_confirm_offer_modal #task_confirm_offer_feedback_followup').val().trim();
				if(!offer_date){
					alert('Confirm Offer Followup Date should not be blank.');
					$('#task_confirm_offer_modal .task_confirm_offer_feedback_followup').val('');
					return false;
				}
			}
			var status = $('#task_confirm_offer_options').val().split('|'), 
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
				joining_date: (next_action === 'Confirm Joining' ? $('#task_confirm_offer_modal #task_confirm_offer_joining_date').val() : 0),
				confirm_offer_followup_date: (next_action === 'Confirm Offer' ? $('#task_confirm_offer_modal #task_confirm_offer_feedback_followup').val() : 0),
				approved_ctc: (next_action === 'Confirm Joining' ? $('#task_confirm_offer_modal #task_confirm_offer_ctc').val() : 0),
				note: $('#task_confirm_offer_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});

</script>