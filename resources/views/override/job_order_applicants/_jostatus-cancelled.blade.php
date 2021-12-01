@if($jobOrder->status === 'Cancelled')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default jo-panel">
				<div class="panel-body">
					<h2 style="text-align: center;">Job Order has been Cancelled.</h2>
				</div>
			</div>
		</div>
	</div>
@endif