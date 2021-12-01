<div class="row">
	<div class="col-md-12">
		<div class="title-main"> OFFICES ({{$company->office_count}})</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive"> 
		<table class="table table-bordered table-striped">
			<tr>
				<th>Office</th>
				<th>Status</th>
				<th>Started Date</th>
				<th>Address</th>
				<!-- <th>Primary Contact</th>
				<th>Secondary Contact</th> -->
				<th>Industries</th>
			</tr>
			@foreach($offices as $office) 
			<tr>
				<td><a href='/admin/offices/detail/{{$office->id}}'> {{ $office->name }} </a></td>
				<td>{{ $office->status==1? 'Active' : 'Idle' }}</td>
				<td>{{ $office->started_date }}</td>
				<td>
					{{ $office->address }}<br> {{ $office->city }} <br>{{ $office->state }} <br> {{ $office->country .'-'. $office->postal_code }}
				</td>
				<!-- <td>Name: {{ $office->primary_contact_name }} <br>
					Email: {{ $office->primary_contact_email }} <br>
					Phone: {{ $office->primary_contact_phone }}
				</td>
				<td>Name: {{ $office->secondary_contact_name }} <br>
					Email: {{ $office->secondary_contact_email }} <br>
					Phone: {{ $office->secondary_contact_phone }}
				</td> -->
				<td>
					@foreach($office->mappedIndustries as $industry)
					{{ $industry->industry }}<br>
					@endforeach
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>