<div class="modal fade" tabindex="-1" role="dialog" id="task_send_invoice_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Send Invoice</h4>
				<input type="hidden" value=""	class="send_invoice_candidate_id">
			</div>
			<div class="modal-body">
				<div>
					<?php
						$loggedInUser = CRUDBooster::me();

						$template = \DB::table('cms_email_templates')
										->where('slug', 'send_invoice')
										->first()
										->content;
						$template = str_replace('[candidate_name]', '<span class="jo-applicant-value"></span>', $template);
						$template = str_replace('[job_order]', '<span class="jo-order-title">'.$jobOrder->title.'</span>', $template);
						$template = str_replace('[company_name]', '<span class="jo-company-name">'.$company->name.'</span>', $template);
						$template = str_replace('[joining_date]', '<span class="jo-applicant-join-date"></span>', $template);
						$template = str_replace('[annual_ctc]', '<span class="jo-ctc-value"></span>', $template);
						$template = str_replace('[service_charge]', '', $template); // <span class="jo-service-value"></span>
						$template = str_replace('[billing_contact]', '<span class="jo-company-name">'.$company->name.'</span>', $template);
						// $template = str_replace('[recruiter_name]', '<span class="jo-recruiter-name">'.$recruiter->name.'</span>', $template);
						$template = str_replace('[recruiter_name]', '<span class="jo-recruiter-name">'.$loggedInUser->name.'</span>', $template);
						$template = str_replace('[regards_name]', $loggedInUser->name, $template);
						// $template = str_replace('[recruiter_name]', '<span class="jo-recruiter-name">'.\CRUDBooster::myName().'</span>', $template);

					?>
					<div contenteditable="true" placeholder="Mail content here" class="task_qualify_notes">
						{!! $template !!}
					</div>
					{{-- <div class="hint">The resume of of the candidate will be automatically attached with the email</div> approved_ctc--}}
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-apply-task">Submit</button>
				<button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div id='loadindDiv' style="position: fixed; width: 100%; height: 100%; background: rgba(4, 4, 4, 0.6); top: 0; left: 0; z-index: 10000; text-align: center; display: none;">
  <div style="border-top: 16px solid #49a9c5; border-bottom: 16px solid #005495; border-radius: 50%; width: 105px; height: 105px; animation: spin 2s linear infinite; margin-top: 20%; margin-left: 45%; -webkit-animation: spin 2s linear infinite;"></div>
  {{-- <img src="{{URL::asset('images/loading.gif')}}" style="margin-top: 15%; width: 150px;"> --}}
  {{--  border: 16px solid rgba(104, 104, 104, 0);  --}}

</div>
<style>
#task_send_invoice_modal .task_qualify_notes {
	border: 1px solid #bbb;
    padding: 6px 10px;
}
#task_submit_modal .hint {
	background: #ddd;
    padding: 3px 10px;
    font-size: 95%;
    text-align: center;
}
#table-modal-detail td{
	border: 1px solid #000;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<script>
	window.initers.push(function() {
		$('#task_send_invoice_modal .btn-apply-task').click(function() {

			var candidate_name = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(8)').find('td:nth-last-child(1)').text().trim();
			var job_order = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(7)').find('td:nth-last-child(1)').text().trim();
			var company_name = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(6)').find('td:nth-last-child(1)').text().trim();
			var joining_date = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(5)').find('td:nth-last-child(1)').text().trim();
			var annual_ctc = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(4)').find('td:nth-last-child(1)').text().trim();
			var service_charge = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(3)').find('td:nth-last-child(1)').text().trim();
			var billing_contact = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(2)').find('td:nth-last-child(1)').text().trim();
			var recruiter_name = $('#task_send_invoice_modal #table-modal-detail tbody tr:nth-last-child(1)').find('td:nth-last-child(1)').text().trim();
			var regards_name = $('#task_send_invoice_modal').find('.jo-regards-name').text().trim();
			var candidate_id=$('#task_send_invoice_modal .send_invoice_candidate_id').val();
			if(!candidate_name){ 
				alert('Candidate Name should not be blank'); 
				return false; 
			}
			if(!job_order){
				alert('Job Order should not be blank');
				return false;
			}
			if(!company_name){
				alert('Company Name should not be blank');
				return false;
			}
			if(!joining_date){
				alert('Joining Date should not be blank');
				return false;
			}
			if(!annual_ctc){
				alert('Annual CTC should not be blank');
				return false;
			}
			if(!service_charge){
				alert('Service Charge should not be blank');
				return false;
			}
			if(!billing_contact){
				alert('Billing Contact should not be blank');
				return false;
			}
			if(!recruiter_name){
				alert('Recruiter should not be blank');
				return false;
			}
			if(!regards_name){
				alert('Recruiter Name in Regards should not be blank');
				return false;
			}

			$('#loadindDiv').show();

			$.post('/custom/set-invoice-mail', {
				candidate_id:candidate_id,
				candidate_name : candidate_name, 
				job_order : job_order, 
				company_name : company_name, 
				joining_date : joining_date, 
				annual_ctc : annual_ctc, 
				service_charge : service_charge, 
				billing_contact : billing_contact, 
				recruiter_name : recruiter_name, 
				regards_name : regards_name, 
			}, function(_data) {
				console.log(_data);
				if(_data == "OK"){
					alert("Mail send Successfully!..");
					window.location.reload();
					$('#loadindDiv').hide();
				}
			});
		});
	});
</script>