<?php

?>

<style type="text/css">
	.count-job-order
	{
		text-align: center;width: 70px;display: inline-block;background-color: #fff;padding: 2px 3px 6px 3px;
	}
	.count-job-order1
	{
		text-align: center;width: 116px;display: inline-block;background-color: #fff;padding: 2px 3px 6px 3px;
	}
	.count-job-order2
	{
		text-align: center;width: 105px;display: inline-block;background-color: #fff;padding: 2px 3px 6px 3px;
	}
	.count-job-order3
	{
		text-align: center;width: 100px;display: inline-block;background-color: #fff;padding: 2px 3px 6px 3px;
	}
	.count-subtext
	{
		margin: 1px 0px 0px 0px; font-size: 12px; font-weight: 600;
	}
	.margin0
	{
     margin: 0px;
	}
</style>


<div class="count-job-order">
	<p class="joborder_stats_new margin0"></p>
	<p class="count-subtext">New</p>
</div>
<div class="count-job-order1">
	<p class="joborder_stats_intro_call_scheduled margin0"></p>
	<p class="count-subtext">Intro Call Scheduled</p>
</div>
<div class="count-job-order2">
	<p class="joborder_stats_hiring_in_progress margin0"></p>
	<p class="count-subtext">Hiring In Progress</p>
</div>
<div class="count-job-order">
	<p class="joborder_stats_on_hold margin0"></p>
	<p class="count-subtext">Hold</p>
</div>
<div class="count-job-order3">
	<p class="joborder_stats_cancelled margin0"></p>
	<p class="count-subtext">Cancelled</p>
</div>
<div class="count-job-order3">
	<p class="joborder_stats_completed margin0"></p>
	<p class="count-subtext">Completed</p>
</div>


@push('bottom')

<script type="text/javascript">
   	
   	// $(document).ready(function(){
      // getJobOrderReports();
    // });

/*	function getJobOrderReports() {
        data ="";
		$.get("/custom/get-joborders-status",data,function(_result) {
            var resultArray = JSON.parse(_result);
			
			$('#job-ordes-counts .joborder_stats_new').html(resultArray.new);
			$('#job-ordes-counts .joborder_stats_intro_call_scheduled').html(resultArray.intro_call_scheduled);
			$('#job-ordes-counts .joborder_stats_hiring_in_progress').html(resultArray.hiring_in_progress);
			$('#job-ordes-counts .joborder_stats_on_hold').html(resultArray.on_hold);
			$('#job-ordes-counts .joborder_stats_cancelled').html(resultArray.cancelled);
			$('#job-ordes-counts .joborder_stats_completed').html(resultArray.completed);
			
		});
    }*/

</script>
