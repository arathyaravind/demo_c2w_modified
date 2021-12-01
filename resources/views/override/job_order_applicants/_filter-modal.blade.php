<div class="modal fade" tabindex="-1" role="dialog" id="filter_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Filter Applicants By Status</h4>
			</div>
			<?php 
				if(!$_REQUEST['secondary_status_filter']) $_REQUEST['secondary_status_filter'] = [];
			?>
			<form method="get" action="{{Request::fullUrl()}}">
				<input type="hidden" value="{{$_REQUEST['job_order_id']}}" name="job_order_id">
				<div class="modal-body">
					<div class="jo-filter-column">
						<label>
							<!-- 
								<input type="checkbox" name="primary_status_filter[]" value="Pipeline"> -->&nbsp;Pipeline {{ $count_pipelined }} 
							</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Associated" {{ (in_array('Associated', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Associated {{ $count_pipelined }}
						</label>
					</div>
					<div class="jo-filter-column">
						<label>
							<!-- 
								<input type="checkbox" name="primary_status_filter[]" value="Qualify"> -->&nbsp;Qualify {{ $count_qualify }} 
							</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Pending Review" {{ (in_array('Pending Review', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Pending Review {{$count_pending_review}} 
						</label>
						<!-- <label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Reviewed" {{ (in_array('Reviewed', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Reviewed {{$count_reviewed}}
						</label> -->
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Schedule Call Back" {{ (in_array('Schedule Call Back', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Schedule Call Back {{$count_callBack}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Qualified" {{ (in_array('Qualified', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Qualified {{$count_qualified}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Declined by C2W" {{ (in_array('Declined by C2W', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Declined by C2W {{$count_declined_by_c2w}}
						</label>
					</div>
					<div class="jo-filter-column">
						<label>
							<!-- 
								<input type="checkbox" name="primary_status_filter[]" value="Submission"> -->&nbsp;Submission {{ $count_submission }} 
							</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Submitted to client" {{ (in_array('Submitted to client', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Submitted to client {{$count_submitted_to_client}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Reschedule Submission" {{ (in_array('Reschedule Submission', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Reschedule Submission {{$count_reschedule_submission}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Approved by the client" {{ (in_array('Approved by the client', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Approved by the client {{$count_approved_by_client}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Submission Rejected by the client" {{ (in_array('Submission Rejected by the client', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Rejected by the client {{$count_rejected_by_client}}
						</label>
					</div>
					<div class="jo-filter-column">
						<label>
							<!-- 
								<input type="checkbox" name="primary_status_filter[]" value="Interview"> -->&nbsp;Interview {{ $count_interview }} 
							</label>
						<!-- <label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview to be Scheduled" {{ (in_array('Interview to be Scheduled', $_REQUEST['secondary_status_filter']) ? 'checked':'') }} >&nbsp;Interview to be Scheduled {{$count_interview_to_be_Scheduled}} 
						</label> -->
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview Scheduled" {{ (in_array('Interview Scheduled', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Interview Scheduled {{$count_interview_scheduled}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview Rescheduled" {{ (in_array('Interview Rescheduled', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Interview Rescheduled {{$count_interview_rescheduled}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview in Progress" {{ (in_array('Interview in Progress', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Interview in Progress {{$count_interview_in_progress}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview Done" {{ (in_array('Interview Done', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Interview Done {{$count_interview_done}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Shortlisted for Next Rounds" {{ (in_array('Shortlisted for Next Round', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Shortlisted for Next Round {{$count_interview_shortlisted }} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview Feedback Rescheduled" {{ (in_array('Interview Feedback Rescheduled', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Interview Feedback Rescheduled {{$count_on_interview_feedback_rescheduled}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="On Hold" {{ (in_array('On Hold', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;On Hold {{$count_on_hold}} 
						</label>
						<!-- <label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Rejected for Interview" {{ (in_array('Rejected for Interview', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Rejected for Interview {{$count_rejected_for_interview}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Waiting for Consensus" {{ (in_array('Waiting for Consensus', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Waiting for Consensus {{$count_waiting_for_consensus}} 
						</label> -->
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="To be Offered" {{ (in_array('To be Offered', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;To be Offered {{$count_to_be_offered}} 
						</label>
						<!-- <label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Rejected" {{ (in_array('Rejected', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Rejected {{$count_rejected}} 
						</label> -->
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Rejected by the client" {{ (in_array('Rejected by the client', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Rejected by the client {{$count_rejected}} 
						</label>
						<!-- <label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Rejected Hirable" {{ (in_array('Rejected Hirable', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Rejected Hirable {{$count_rejected_hirable}} 
						</label>
						 -->
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Interview Backed Out" {{ (in_array('Interview Backed Out', $_REQUEST['secondary_status_filter']) ? 'checked':'') }} >&nbsp;Backed Out {{$count_interview_backed_out}}
						</label>
						
					</div>
					<div class="jo-filter-column">
						<label>
							<!-- 
								<input type="checkbox" name="primary_status_filter[]" value="Offer"> -->&nbsp;Offer {{ $count_offer }}
							</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Offer Made" {{ (in_array('Offer Made', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Offer Made {{$count_offer_made}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Confirm Offer Follow Up" {{ (in_array('Confirm Offer Follow Up', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Confirm Offer Follow Up {{$count_offer_follow_up}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Offer Accepted" {{ (in_array('Offer Accepted', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Offer Accepted {{$count_offer_accepted}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Offer Declined" {{ (in_array('Offer Declined', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Offer Declined {{$count_offer_declined}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Offer Withdrawn" {{ (in_array('Offer Withdrawn', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Offer Withdrawn {{$count_offer_withdrawn}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="No Show" {{ (in_array('No Show', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;No Show {{$count_no_show}} 
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Un Qualified" {{ (in_array('Un Qualified', $_REQUEST['secondary_status_filter']) ? 'checked':'') }}>&nbsp;Un Qualified {{$count_un_qualified}} 
						</label>
					</div>
					<div class="jo-filter-column">
						<label>
							<!-- 
								<input type="checkbox" name="primary_status_filter[]" value="Place"> -->&nbsp;Place {{ $count_place }} 
							</label>
						<label class="level2">
						<input type="checkbox" name="secondary_status_filter[]" value="Joining Extended" {{ (in_array('Joining Extended', $_REQUEST['secondary_status_filter']) ? 'checked':'') }} >&nbsp;Joining Extended {{$count_joining_extended}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Joined" {{ (in_array('Joined', $_REQUEST['secondary_status_filter']) ? 'checked':'') }} >&nbsp;Joined {{$count_hired}}
						</label>
						<label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Backed Out" {{ (in_array('Backed Out', $_REQUEST['secondary_status_filter']) ? 'checked':'') }} >&nbsp;Backed Out {{$count_backed_out}}
						</label>
						<!-- <label class="level2">
							<input type="checkbox" name="secondary_status_filter[]" value="Converted Employee">&nbsp;Converted Employee {{$count_converted_employee}} 
						</label> -->
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-save-filter">Apply</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
