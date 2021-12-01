<div class="row">
	<div class="col-md-6">
		<div class="title-main"> INDUSTRY &nbsp;&nbsp;&nbsp;
			@if($company->industries_count == 0)
			<button class="btn btn-xs btn-primary pb-3" 
			onclick="$('.add-industry-row').toggleClass('hidden'); $('input[name=industry_id]:visible').focus();">Add Industry</button>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 table-responsive"> 
		<table class="table table-bordered table-striped">
			@if($company_industries!='')
			@foreach($company_industries as $company_industry) 
			<tr>
				<td>{{ $company_industry->industry }}</td>
				<td>
					<a class="btn btn-xs btn-success" href="/admin/companies/detail/{{ $company_industry->company_id }}?edit_industry={{ $company_industry->id }}">Edit</a>&nbsp;
					<button class="btn btn-xs btn-danger" onclick="deleteIndustry({{ $company_industry->id }})">Delete</button>
				</td>
			</tr>
			@endforeach
			@endif
			<tr class="hidden add-industry-row">
				<td colspan="2"><h4>Add Industry</h4></td>
			</tr>
			<tr class="hidden add-industry-row">
				<td>
					<select name="industry_id" class="form-control select-select2">
						@foreach($industries as  $industry)
						<option value="{{ $industry->id }}">{{ $industry->name }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<button class="btn btn-sm btn-success" type="button" onclick="saveIndustry()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="$('.add-industry-row').toggleClass('hidden')">Cancel</button>
				</td>
			</tr>
			@if(request()->input('edit_industry'))
			<?php $eIndustry = \DB::table('company_industries')->where('id', request()->input('edit_industry'))->first(); ?>
			<tr class="edit-industry-row">
				<td colspan="2"><h4>Edit Industry</h4></td>
			</tr>
			<tr class="edit-industry-row">
				<td>
					<select name="industry_id" class="form-control select-select2" required="">
						@foreach($industries as  $industry)
						<option value="{{ $industry->id }}" {{ ($eIndustry->industry_id== $industry->id) ? 'selected' : '' }} >{{ $industry->name }}</option>
						@endforeach
					</select>
				</td>
				<td>
					<button class="btn btn-sm btn-success" type="button" onclick="updateIndustry()">Save</button>&nbsp;
					<button class="btn btn-sm btn-default" type="button" onclick="window.location.href = '/admin/companies/detail/{{ $company_industry->company_id }}'">Cancel</button>
				</td>
			</tr>
			@endif
		</table>
	</div>
</div>

<script>


function saveIndustry() {
	var payload = {
		company_id: {{ $company->id }},
	};
	$('.add-industry-row select').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	console.log(payload);
	$.post('/custom/save-company-industry', payload, function() {
		window.location.reload();
	});
}
@if(request()->input('edit_industry'))
function updateIndustry() {
	var payload = {
		company_id: {{ $company_industry->company_id }}
	};
	$('.edit-industry-row select').each(function() {
		payload[$(this).attr('name')] = $(this).val();
	});
	$.post('/custom/update-company-industry/' + {{ request()->input('edit_industry') }}, payload, function() {
		window.location.href = '/admin/companies/detail/{{ $company_industry->company_id }}';
	});
}
@endif
function deleteIndustry(_id) {
	if(window.confirm('Are you sure?')) {
		$.post('/custom/delete-company-industry/' + _id, {}, function() {
			window.location.href = '/admin/companies/detail/{{ $company_industry->company_id }}';
		});
	}
}
</script>
