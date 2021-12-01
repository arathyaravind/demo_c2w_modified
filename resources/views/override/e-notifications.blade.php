<?php
$events_ids = [];
$today = date('Y-m-d', strtotime(NOW()));
$allEvents = DB::table('events')->where('event_date', '<=', $today)->orderBy('event_date', 'asc')->get();

$eventIds = [];

foreach ($allEvents as $allEvent) {
  $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
  if ($allEvent->job_order->owner) {
    $eventIds[] = $allEvent->id;
  }
}

$fullEvents = DB::table('events')->whereIn('id', $eventIds)->where('event_date', '<=', $today)->where('status', 'pending')->orderBy('event_date', 'asc')->get();
$secondaryStatus = array("Declined by C2W", "Rejected by client", "Rejected for Interview", "Waiting for Consensus", "Rejected", "Rejected Hirable", "Offer Declined", "Offer Withdrawn", "No Show", "Un Qualified", "Rejected by the client");
foreach ($fullEvents as $fullEvent) {
  // $jobOrderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$fullEvent->job_order_id)->whereNull('deleted_at')->first();/*->where('candidate_id', $fullEvent->candidate_id)*/
  $jobOrderApplicant = \DB::table('job_order_applicants')->where('job_order_id', $fullEvent->job_order_id)->where('candidate_id', $fullEvent->candidate_id)->whereNull('deleted_at')->orderBy('updated_at', 'desc')->first(); /**/
  if ($jobOrderApplicant) {
    if (!in_array($jobOrderApplicant->secondary_status, $secondaryStatus)) {
      // $events[] = $fullEvent;
      $events_ids[] = $fullEvent->id;
    }

  } elseif ($fullEvent->type == 'Submission' || $fullEvent->type == 'Job Order Re-submission' ||
    $fullEvent->type == 'Job Order Follow-up' || $fullEvent->type == 'Intro Call') {
    if ($fullEvent->type == 'Submission' || $fullEvent->type == 'Job Order Re-submission' ||
      $fullEvent->type == 'Job Order Follow-up') {
      $jobOrderSubmissionHistory = \DB::table('job_order_submission_history')
        ->where('job_order_id', $fullEvent->job_order_id)
        ->where('date', $fullEvent->event_date)
        ->where('submission_status', $fullEvent->type)
        ->where('active', 1)
        ->first();
      if ($jobOrderSubmissionHistory->active == 1) {
        $events_ids[] = $fullEvent->id;
      }
    } elseif ($fullEvent->type == 'Intro Call') {
      $events_ids[] = $fullEvent->id;
    }

  }

}

$events_ids = array_unique($events_ids);
$events = DB::table('events')->whereIn('id', $events_ids)->where('event_date', '<=', $today)->orderBy('event_date', 'asc')->count();
?>
@if(@$events>0)
    <!-- <a class="cart" id="CartShortCut" href="/admin/pending-events" style="display: block;" data-original-title=""
       title="">
        <span class="glyphicon glyphicon-bell" aria-hidden="true" style="font-size: 25px;"></span> <span
                style="font-size: 23px; ">You have {{ $events}} Pending Events..!</span>
    </a> -->
@endif
