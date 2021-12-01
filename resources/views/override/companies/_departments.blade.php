<div class="row">
	<div class="col-md-6">
		<div class="title-main"> DEPARTMENTS ({{$company->department_count}})&nbsp;&nbsp;&nbsp;
			<button class="btn btn-xs btn-primary pb-3" 
			onclick="$('.add-department-row').toggleClass('hidden'); $('input[name=name]:visible').focus();">Add Department</button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8 table-responsive"> 
		<table class="table table-bordered table-striped">
			<tr>
				<th>Department</th>
				<th>Created On</th>
				<th>Created By</th>
			</tr>

			@foreach($office->company_departments as $company_department) 
			<tr>
				<td>{{ $company_department->name }}</td>
				<td>{{ date("d/m/Y", strtotime($company_department->created_at)) }}</td>
				<td>{{ $company_department->created_by }}</td>
				<td>
					<a class="btn btn-xs btn-success" href="/admin/companies/detail/{{ $company_department->company_id }}?edit_department={{ $company_department->id }}">Edit</a>&nbsp;
					<button class="btn btn-xs btn-danger" onclick="deleteDepartment({{ $company_department->id }})">Delete</button>
				</td>
			</tr>
			@endforeach
			<tr class="hidden add-department-row">
				<td colspan="4"><h4>Add Department</h4></td>
			</tr>
			<tr class="hidden add-department-row">
				<td>
					<input class="form-control" type="text" placeholder="Department" name="name" id="name"><br>
				</td>
				<td colspan="2">
					<button class="btn btn-sm btn-success" type="button" onclick="saveDepartment()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="$('.add-department-row').toggleClass('hidden')">Cancel</button>
				</td>
			</tr>
			@if(request()->input('edit_department'))
			<?php $eDepartment = \DB::table('office_departments')->where('id', request()->input('edit_department'))->first(); ?>
			<tr class="edit-department-row">
				<td colspan="4"><h4>Edit Department</h4></td>
			</tr>
			<tr class="edit-department-row">
				<td>
					<input class="form-control" type="text" placeholder="Department" name="name" id="e_name" value="{{ $eDepartment->name }}"><br>
				</td>
				<td colspan="2">
					<button class="btn btn-sm btn-success" type="button" onclick="updateDepartment()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="window.location.href = '/admin/companies/detail/{{ $company_department->company_id }}'">Cancel</button>
				</td>
			</tr>
			@endif
		</table>
	</div>
</div>

<script>
function saveDepartment() {
	var dname = $("#name").val();
	if(dname==''){
		$("#name").focus();
		$("#name").css("border","1px solid red");
		return false;
	}
	var payload = {
		company_id: {{ $company->id }},
		office_id: {{ $office->id }}
	};
	$('.add-department-row input').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	console.log(payload);
	$.post('/custom/save-company-department', payload, function() {
		window.location.reload();
	});
}
@if(request()->input('edit_department'))
function updateDepartment() {
	var e_dname = $("#e_name").val();
	if(e_dname==''){
		$("#e_name").focus();
		$("#e_name").css("border","1px solid red");
		return false;
	}
	var payload = {
		company_id: {{ $company_department->company_id }}
	};
	$('.edit-department-row input').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	$.post('/custom/update-company-department/' + {{ request()->input('edit_department') }}, payload, function() {
		window.location.href = '/admin/companies/detail/{{ $company_department->company_id }}';
	});
}
@endif
function deleteDepartment(_id) {
	if(window.confirm('Are you sure?')) {
		$.post('/custom/delete-company-department/' + _id, {}, function() {
			window.location.href = '/admin/companies/detail/{{ $company_department->company_id }}';
		});
	}
}
</script>
