<div class="modal fade"  role="dialog" id="changeOwner{{$jo->job_order_applicant->id}}">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Change Owner</h4>
			</div>
                    <div class='modal-body'> 
                    <div class="well">
					<div><span class="modal-top-label">Job Order:</span><span class="jo-title-value">{{ $jo->title }}</span></div>
					<div><span class="modal-top-label">Applicant:</span><span class="jo-applicant-value"> {{ $jo->candidate->first_name }}&nbsp;{{$jo->candidate->last_name }}</span></div>
				</div>
				<div class='message-container'></div>
                    <input type="hidden" value="{{$jo->job_order_applicant->id}}" id="applicant_id">
					<input type="hidden" value="{{$jo->job_order_applicant->job_order_id}}" id="job_order_id">
					<input type="hidden" value="{{$jo->job_order_applicant->candidate_id}}" id="candidate_id">
                    <?php 
                     $creator=DB::table('job_order_applicants')->where('id',$jo->job_order_applicant->id)->first()->creator_id;
                  $recruiter =DB::table('cms_users')->get();
                  $owner =\DB::table('cms_users')->find($jo->addedBy);
                    ?>    

                        <select class ='form-control ownerId' name="ownerid" id="owner_name">
                            @foreach($recruiter as $recruiter) { 
                           <option value = "{{$recruiter->id}}"{{($creator==$recruiter->id)? 'selected':''}}>{{$recruiter->name }}</option>
                            @endforeach
                        </select>

                        <div class='clearfix'></div>
                    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success change_owner{{$jo->job_order_applicant->id}}" value="{{$jo->job_order_applicant->id}}"  data-candidate_id="{{$jo->job_order_applicant->candidate_id}}"   data-job_order_id="{{$jo->job_order_applicant->job_order_id}}">Submit</button>
				<button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	window.initers.push(function() {
		$('.close-btn').click(function(){
        location.reload();
        });
		$('.change_owner{{$jo->job_order_applicant->id}}').click(function() {
			var job_order_id = $(this).data('job_order_id');  
			var candidate_id = $(this).data('candidate_id');   
			var owner_name =$("#changeOwner{{$jo->job_order_applicant->id}}").find('#owner_name option:selected').text();
			

			$( "div.message-container").html('');
			$.post('/custom/change-owner', {
				id: $("#changeOwner{{$jo->job_order_applicant->id}}").find('select[name="ownerid"]').val(),
				owner_name:owner_name,
				applicant_id:$(this).val(),
				candidate_id :candidate_id,
				job_order_id :job_order_id,
			}, function(_data) {
				if(_data=='ok') {
                        $( "div.message-container" ).append('<br><div class="col-sm-12 alert alert-success alert-dismissible pull-left"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Successfully Changed The Owner.!</strong></div><br>');
                }
			});
		});
	});
</script>