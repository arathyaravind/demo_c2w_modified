<div class="modal fade task_modal" tabindex="-1" role="dialog" id="task_confirm_joining_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Applicant: Confirm Joining</h4>
			</div>
			<div class="modal-body">
				<div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
				</div>
				<div>
					<label for="">Confirm Joining:</label>
					<select id="task_confirm_joining_options">
						<option value="-">Choose..</option>
						<option value="Place|Joined|Send Invoice">Joined</option>
						<option value="Place|Joining Extended|Confirm Joining">Joining Extended</option>
						<option value="Place|Backed Out|-">Backed Out</option>
					</select>
					<div class="task_confirm_joining_joining_date conditional-task-field">
						<label for="">Date of Joining:</label>
						<input type="text" readonly="" required="" class="" name="task_confirm_joining_joining_date" id="task_confirm_joining_joining_date">
					</div>
					<textarea placeholder="Notes" id="task_confirm_joining_notes"></textarea>
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
		$('#task_confirm_joining_options').change(function() {
			if(this.value === 'Place|Joining Extended|Confirm Joining') {
				$('.task_confirm_joining_joining_date').show();
			}
			else {
				$('.task_confirm_joining_joining_date').hide();
				$('#task_confirm_joining_modal .task_confirm_joining_joining_date #task_confirm_joining_joining_date').val('');
			}
		});
		$('#task_confirm_joining_modal #task_confirm_joining_joining_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			startDate:'0d',
		});
		$('#task_confirm_joining_modal .btn-apply-task').click(function() {
			var task_confirm_offer_options = $('#task_confirm_joining_options').val();
			var task_joining_date = $('#task_confirm_joining_modal #task_confirm_joining_joining_date').val().trim();
			if(task_confirm_offer_options == '-'){
				alert('Choose The Confirm Joining');
				return false;
			}
			if(task_confirm_offer_options=='Place|Joining Extended|Confirm Joining')
			{
				if(!task_joining_date){ 
					alert('Joining Date should not be blank.'); 
					return false; 
				}
			}
			var status = $('#task_confirm_joining_options').val().split('|'), 
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
				joining_date: (next_action === 'Confirm Joining' ? $('#task_confirm_joining_modal #task_confirm_joining_joining_date').val() : 0),
				note: $('#task_confirm_joining_notes').val()
			}, function(_data) {
				window.location.reload();
			});
		});
	});
</script>