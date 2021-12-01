<div class="modal fade"  role="dialog" id="changeOwner">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Change Owner</h4>
			</div>
                    <div class='modal-body'> 
				<div class='message-container'></div>
                        <select class ='form-control ownerId bulk_owner_id' name="bulkownerid">
                        	<option value = "">Choose Owner</option>
                            @foreach($owners as $owner) { 
                           <option value = "{{$owner->id}}">{{$owner->name }}</option>
                            @endforeach
                        </select>

                        <div class='clearfix'></div>
                    </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success change_owner" value="">Submit</button>
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
	});
</script>