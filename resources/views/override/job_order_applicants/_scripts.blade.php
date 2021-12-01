<script async defer>
window.onload = function() {
	var outer = $('<div class="jo-buttons-top-right"/>');
	outer.appendTo('.content-header');

	if(window.initers && window.initers.length) {
		window.initers.forEach(function(_initer) {
			_initer();
		});
	}
	$('<button class="btn btn-xs btn-danger btn-set-job-status" data-status="On Hold"{{$jobOrder->status =='On Hold'? 'style = display:none': '' }} >Put On-Hold</button>').prependTo('.jo-buttons-top-right');
	$('<button class="btn btn-xs btn-danger btn-set-job-status" data-status="Cancelled"{{$jobOrder->status =='Cancelled'? 'style = display:none': '' }}>Cancel</button>').prependTo('.jo-buttons-top-right');
	$('<button class="btn btn-xs btn-success btn-set-job-status" data-status="Hiring In Progress"{{$jobOrder->status =='Hiring In Progress'||$jobOrder->status == 'New'||$jobOrder->status=='Intro Call Scheduled'? 'style = display:none': '' }}>Set In-Progress</button>').prependTo('.jo-buttons-top-right');
	$('<button class="btn btn-xs btn-success btn-set-job-status" data-status="Completed"{{$jobOrder->status =='Completed'? 'style = display:none': '' }} >Set Completed</button>').prependTo('.jo-buttons-top-right');
	"@if($jobOrder->status === 'Hiring In Progress')"
		$('<a class="add-candidtate-btn-link" href="/admin/candidates/add?job_order_id={{$jobOrder->id}}" target="_blank"><button class="btn btn-xs btn-success">Add Candidate</button></a>').prependTo('.jo-buttons-top-right');
	"@endif"
	$('.btn-set-job-status').click(function() {
		var status=$(this).attr('data-status');
		if(status==='On Hold'){
			var confirm_message="Are you sure you want to Hold this JobOrder ?";
		}
		if(status==='Cancelled'){
			var confirm_message="Are you sure you want to Cancel this JobOrder ?";
		}
		if(status==='Completed'){
			var confirm_message="Are you sure you want to Complete this JobOrder ?";
		}
		if(status==='Hiring In Progress')
		{
			var confirm_message="Are you sure you want to Set In Progress this JobOrder ?";
		}
		var jobOrderStatus='{{$jobOrder->status}}';
		if(jobOrderStatus==status){
			//$(this).prop("disabled", true);
		}
		else{
		if(window.confirm(confirm_message)) {	
			$.post('/custom/set-job-status', {
				id:'{{ $jobOrder->id }}',
				status: $(this).attr('data-status')
			}, function(_data) {
				window.location.reload();
			});
		
		} 
	}
	});
	
};
</script>
<!-- <script async defer src="/jquery-ui.min-ac.js"></script> -->
