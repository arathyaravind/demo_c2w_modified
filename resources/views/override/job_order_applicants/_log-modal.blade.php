	<div class="modal fade" tabindex="-1" role="dialog" id="log_modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Applicant Log</h4>
				</div>
				<div class="modal-body">
					<div class="well">
						<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jobOrder->title }}</span></div>
						<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"></span></div>
					</div>
					<div class="jo-log-table">
						<table class="table table-striped table-jo-details jo-log-table">
							<thead>
								<tr>
									<th>Date</th>
									<th>User</th>
									<th>Old Status</th>
									<th>New Status</th>
									<th>Notes</th>
								</tr>
							</thead>
			    			<tbody>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>