<div class="row">
	<div class="col-md-12">
		<div class="title-main"> Notes ({{$company->note_count}})&nbsp;&nbsp;&nbsp;<button class="btn btn-xs btn-primary pb-3" 
			onclick="$('.add-note-row').toggleClass('hidden'); $('input[name=note]:visible').focus();">Add Note</button></div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive"> 
		<table class="table table-bordered table-striped">
			<tr>
				<th>Note</th>
				<th>Created On</th>
				<th>Created By</th>
				<th>&nbsp;</th>
			</tr>
			@if($company_notes!='')
			@foreach($company_notes as $company_note) 
			<tr>
				<td style="max-width: 300px;">{{ $company_note->note }}</td>
				<td>{{ date("d/m/Y", strtotime($company_note->created_on)) }}</td>
				<td>{{ $company_note->created_by }}</td>
				<td>
					<a class="btn btn-xs btn-success" href="/admin/companies/detail/{{ $company_note->company_id }}?edit_note={{ $company_note->id }}">Edit</a>&nbsp;
					<button class="btn btn-xs btn-danger" onclick="deleteNote({{ $company_note->id }})">Delete</button>
				</td>
			</tr>
			@endforeach
			@endif
			<tr class="hidden add-note-row">
				<td colspan="6"><h4>Add New Note</h4></td>
			</tr>
			<tr class="hidden add-note-row">
				<td>
					<input class="form-control" type="text" placeholder="Note" name="note" id="note"><br>
				</td>
				<td>
					<button class="btn btn-sm btn-success" type="button" onclick="saveNote()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="$('.add-note-row').toggleClass('hidden')">Cancel</button>
				</td>
			</tr>
			@if(request()->input('edit_note'))
			<?php $eNote = \DB::table('company_notes')->where('id', request()->input('edit_note'))->first(); ?>
			<tr class="edit-note-row">
				<td colspan="6"><h4>Edit Note</h4></td>
			</tr>
			<tr class="edit-note-row">
				<td>
					<input class="form-control" type="text" placeholder="Note" name="note" id="e_note" value="{{ $eNote->note }}"><br>
				</td>
				<td>
					<button class="btn btn-sm btn-success" type="button" onclick="updateNote()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="window.location.href = '/admin/companies/detail/{{ $company_note->company_id }}'">Cancel</button>
				</td>
			</tr>
			@endif
		</table>
	</div>
</div>
<script>
function saveNote() {
	console.log('save note');
	var note = $("#note").val();
	if(note==''){
		$("#note").focus();
		$("#note").css("border","1px solid red");
		return false;
	}
	var payload = {
		company_id: {{ $company->id }},
		};
	$('.add-note-row input').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	console.log(payload);
	$.post('/custom/save-company-note', payload, function() {
		window.location.reload();
	});
}
@if(request()->input('edit_note'))
function updateNote() {
	var e_note = $("#e_note").val();
	if(e_note==''){
		$("#e_note").focus();
		$("#e_note").css("border","1px solid red");
		return false;
	}
	var payload = {
		company_id: {{ $company_note->company_id }}
	};
	$('.edit-note-row input').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	$.post('/custom/update-company-note/' + {{ request()->input('edit_note') }}, payload, function() {
		window.location.href = '/admin/companies/detail/{{ $company_note->company_id }}';
	});
}
@endif
function deleteNote(_id) {
	if(window.confirm('Are you sure?')) {
		$.post('/custom/delete-company-note/' + _id, {}, function() {
			window.location.href = '/admin/companies/detail/{{ $company_note->company_id }}';
		});
	}
}
</script>