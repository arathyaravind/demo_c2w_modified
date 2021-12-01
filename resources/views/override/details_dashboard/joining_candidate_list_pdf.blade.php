<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
	<title>
		Joining Candidate List
	</title>
	<style type="text/css">
	table{
		width: 100%;
		border: 1px solid black;
	}
	td, th{
		border: 1px solid black;
	}
</style>
</head>
<body>
	<h2><u><center>Joining Candidate List</center></u></h2>
	<table>
		<thead>
			<tr>
				<th> Sl No. </th>
				<th> Candidate Name </th>
				<th> Title </th>
				<th> Company </th>
				<th> Joining Date </th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			@foreach($jobOrderApplicants as $jobOrderApplicant)
			<tr>
				<td> {{$i}} </td>
				<td> {{$jobOrderApplicant->candidateName}} </td>
				<td> {{$jobOrderApplicant->jobOrder->title}} </td>
				<td> {{$jobOrderApplicant->companyName}} </td>
				<td> @if(!empty($jobOrderApplicant->joining_date))
							{{date('d-m-Y',strtotime($jobOrderApplicant->joining_date))}}          
							@endif</td>
			</tr>
			<?php $i++ ?>
			@endforeach
		</tbody>
	</table>
</body>
</html>