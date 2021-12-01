<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/pdf; charset=utf-8"/>
	<title>
		Candidate Added List
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
	<h2><u><center>Candidate Added List</center></u></h2>
	<table>
		<thead>
			<tr>
				<th> Sl No. </th>
				<th> Name </th>
				<th> Email </th>
				<th> Phone </th>
				<th> Highest Qualification </th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			@foreach($candidates as $candidate)
			<tr>
				<td> {{$i}} </td>
				<td> {{$candidate->first_name}} &nbsp; {{ $candidate->last_name}} </td>
				<td> {{$candidate->primary_email}} </td>
				<td> {{$candidate->primary_phone}} </td>
				<td> {{$candidate->highest_qualification}} </td>
			</tr>
			<?php $i++ ?>
			@endforeach
		</tbody>
	</table>
</body>
</html>