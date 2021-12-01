@if($jobOrder->status === 'Hiring In Progress')
<div class="panel panel-default jo-panel">
	<div class="table-responsive">
		<table class="table table-hovered stats-table" border="1">
			<thead>
				<tr>
					<th> Pipelined </th>
					<th> Qualify </th>
					<th> Submission </th>
					<th> Interview </th>
					<th> Offer </th>
					<th> Place </th>
				</tr>
			</thead>
			<tbody>
				<tr class='main-count'> 
					<td> {{ $count_pipelined }} </td>
					<td> {{ $count_qualify }} </td>
					<td> {{ $count_submission }} </td>
					<td> {{ $count_interview }} </td>
					<td> {{ $count_offer }} </td>
					<td> {{ $count_place }} </td>
				</tr>		
				<tr>
					<td>
						<table class = "table table-hovered stats-table">
							<tr>
								<!-- <td>Associated - {{ $count_associated }}
								</td> -->
								{{$count_pipelined}}
							</tr>
						</table>
					</td>
					<td>
						<table class = "table table-hovered stats-table">
							<tr>
								<td>Pending Review - {{$count_pending_review}}
								</td>
							</tr>
							<tr>
								<td>Reviewed - {{$count_reviewed}}
								</td>
							</tr>
							<tr>
								<td>Declined by C2W - {{$count_declined_by_c2w}}
								</td>
							</tr>
							<tr>
								<td>Qualified - {{$count_qualified}}
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table class = "table table-hovered stats-table">
							<tr>
								<td>Submitted-to-client - {{$count_submitted_to_client}}
								</td>
							</tr>
							<tr>
								<td>Approved by client - {{$count_approved_by_client}}
								</td>
							</tr>
							<tr>
								<td>Rejected by client - {{$count_rejected_by_client}}
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table class = "table table-hovered stats-table">
							<tr>
								<td>Interview-to-be-Scheduled - {{$count_interview_to_be_Scheduled}}
								</td>
							</tr>
							<tr>
								<td>Interview-Scheduled - {{$count_interview_scheduled}}
								</td>
							</tr>
							<tr>
								<td>Rejected-for-Interview - {{$count_rejected_for_interview}}
								</td>
							</tr>
							<tr>
								<td>Interview-in-Progress - {{$count_interview_in_progress}} 
								</td>
							</tr>
							<tr>
								<td>Waiting-for-Consensus - {{$count_waiting_for_consensus}}
								</td>
							</tr>
							<tr>
								<td>To-be-Offered - {{$count_to_be_offered}}
								</td>
							</tr>
							<tr>
								<td>On-Hold - {{$count_on_hold}}
								</td>
							</tr>
							<tr>
								<td>Rejected - {{$count_rejected}}
								</td>
							</tr>
							<tr>
								<td>Rejected-Hirable - {{$count_rejected_hirable}}
								</td>
							</tr>
						</table>
					</td>
					
					<td>
						<table class = "table table-hovered stats-table">
							<tr>
								<td>Offer-Made  - {{$count_offer_made}}
								</td>
							</tr>
							<tr>
								<td>Offer-Accepted - {{$count_offer_accepted}}
								</td>
							</tr>
							<tr>
								<td>Offer-Declined  - {{$count_offer_declined}}
								</td>
							</tr>
							<tr>
								<td>Offer-Withdrawn  - {{$count_offer_withdrawn}} 
								</td>
							</tr>
							<tr>
								<td>No-Show  - {{$count_no_show}}
								</td>
							</tr>
							<tr>
								<td>Un-Qualified - {{$count_un_qualified}}
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table class = "table table-hovered stats-table">
							<tr>
								<td>Hired - {{$count_hired}}
								</td>
							</tr>
							<tr>
								<td>Converted - Employee - {{$count_converted_employee}}
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endif