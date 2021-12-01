<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_roll_out_offer_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Roll Out Offer</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<div class="task-field">
						<label for="">Offer Confirmation Date:</label>
						<input placeholder="Date" type="text" readonly="" required="" class="" name="task_roll_out_offer_confirmation_date" id="task_roll_out_offer_confirmation_date">
					</div>
					<textarea placeholder="Notes" id="task_roll_out_offer_notes"></textarea>
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
		$('#task_roll_out_offer_modal #task_roll_out_offer_confirmation_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_roll_out_offer_modal .btn-apply-task').click(function() {
			var offer_confirm_date = $('#task_roll_out_offer_modal #task_roll_out_offer_confirmation_date').val().trim();
				if(!offer_confirm_date){ 
				alert('Offer Confirmation Date should not be blank.'); 
				return false; 
			    }
			$.post('/custom/set-applicant-status', {
				id: $(this).attr('data-id'),
				primary_status: 'Offer',
				secondary_status: 'Offer Made',
				next_action: 'Confirm Offer',
				offer_confirmation_date: $('#task_roll_out_offer_modal #task_roll_out_offer_confirmation_date').val(),
				note: $('#task_roll_out_offer_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>