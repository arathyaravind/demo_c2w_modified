<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Pdf</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	}
	body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	}
	.pad
	{
	padding-left:10px;
	}
	a:link {
	color: #000000;
	text-decoration: none;
	}
	a:visited {
	text-decoration: none;
	color: #000000;
	}
	a:hover {
	text-decoration: underline;
	color: #000000;
	}
	a:active {
	text-decoration: none;
	color: #000000;
	}
	.main-body{
	}
	table tr {
		margin:10px;
	}
	table tr td{
		padding:1px;
	}
	table tr td p{
		padding: 2px;
		margin: 0px;
		line-height: 10px;
		font-size: 12px;
	}
	.table{
		border:1px solid black;
	}
	.table tr{
		border:1px solid black;
	}
	.table tr th{
		border:1px solid black;
	}
	.table tr td{
		border:1px solid black;
	}
	table ul {
		padding:2px;
		list-style: none;
	}
	table ul li{
		padding:2px;
		list-style: none;
	}
	table, th, td {
	border-collapse: collapse;
	}
	th, td {
		padding: 4px;
		font-size: 12px;
		text-align: left;    
	    line-height:15px;
	}
	.may{
		background-color: #d9d9d9;
		text-align: center;
		font-weight: 100;
	}
</style>
</head>

<body class="main-body">

		<table style="width:100%;margin:1px" cellpadding="20">
			<tr>
				<td width="100%" style="padding: 2px 2px;text-align:center;text-transform: uppercase;font-size: 20px;padding-top: 10px;font-weight: bold;"> {{$candidate->first_name}}  {{$candidate->last_name}}</td>
			</tr>
        </table>
        <table style="width:100%;margin:1px" cellpadding="20">
			<tr>
                <td width="50%" style="padding: 2px 2px;text-transform: uppercase;font-size: 20cm;"><p> EmailID : {{$candidate->primary_email}} </p></td>
                <td width="50%" style="padding: 2px 2px;text-transform: uppercase;font-size: 20px;text-align: right;"><p> Contact : {{$candidate->primary_phone}} </p></td>
            </tr>
        </table>
        <table style="width:100%;">
            <h3 style="background-color: #80808073;padding: 6px;font-size: 14px;margin-top: 3px;"> CAREER  </h3>
         </table>
        <table style="width:100%;margin:1px" cellpadding="20">
			<tr>
				<td width="25%"  style="padding: 4px 4px">
                    <p>DESIGNATION :  
					 @if($candidate->current_designation =='')
						<i>NILL</i>
					 @else
						{{ $candidate->current_designation .' at '.$candidate->current_employer }}
					 @endif
					</p>
				</td>
                <td width="25%"  style="padding: 4px 4px">
                    <p>Experiance : {{ $candidate->experience_years }} years, {{$candidate->experience_months }} months</p>
				</td>
				<td width="25%"  style="padding: 4px 4px">
                    <p>Location : {{$current_city_name}}</p>
				</td>
				<td width="25%"  style="padding: 4px 4px">
                    <p>Ctc : {{ 'INR '.$candidate->current_ctc.' lakhs' }}</p>
                </td>
			</tr>
		</table>
		@if($candidate_qualifications != '')
			<table style="width:100%;">
				<h3 style="background-color: #80808073;padding: 6px; font-size: 14px;margin-top: 3px;"> EDUCATIONAL PROFILE  </h3>
				<tr>
					<td></td>
				</tr>
			</table>

			<table style="width:100%;margin-top:15px;margin-bottom:15px" class="table">
				<tr style="width:100%;height:50px;background-color: #80808073;" >
					<th scope="col">Qualification Level</th>
					<th scope="col">Qualification</th>
					<th scope="col">Year of pass</th>
					<th scope="col">Score</th>
				</tr>
				@foreach ($candidate_qualifications as $qualification)
				    <tr>
						<td>{{$qualification->qualification_level}}</td>
						<td>{{$qualification->qualification}}</td>
						<td>{{$qualification->completed_year}}</td>
						<td>{{$qualification->score}}</td>
					</tr>
				@endforeach
			</table>
		@endif
		<table style="width:100%;">
            <h3 style="background-color: #80808073;padding: 6px;font-size: 14px;text-transform:uppercase;margin-top: 3px;"> Functional Area </h3>
         </table>

         <table style="width:100%;margin:1px" cellpadding="20">
			<tr>
                <td width="100%"  style="padding: 4px 4px">
                      @foreach($candidate_industry_functional_areas as $area)
						{{ $area->industry_functional_area }}@if(!$loop->last), @endif
					@endforeach   
                </td>
			</tr>
        </table>

         <table style="width:100%;">
            <h3 style="background-color: #80808073;padding: 6px;font-size: 14px;text-transform:uppercase;margin-top: 3px;"> Functional Roles </h3>
         </table>

         <table style="width:100%;margin:1px" cellpadding="20">
			<tr>
                <td width="100%"  style="padding: 4px 4px">
					@foreach($roles as $role)
					   {{ $role->role }}@if(!$loop->last), @endif
			    	@endforeach   
                </td>
			</tr>
        </table>

        <table style="width:100%;">
            <h3 style="background-color: #80808073;padding: 6px;font-size: 14px;text-transform:uppercase;margin-top: 3px;"> SKILLS </h3>
        </table>

         <table style="width:100%;margin:1px" cellpadding="20">
			<tr>
                <td width="100%" style="padding: 4px 4px">
					@foreach($skills as $skill)
					   {{ $skill->industry_functional_area_skill }}@if(!$loop->last), @endif
			    	@endforeach
                </td>
			</tr>
        </table>


	</body>
</html>