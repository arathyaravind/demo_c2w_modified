<?php
    $today = date('Y-m-d', strtotime(NOW()));
    $jobOderEvents=array('Submission','Intro Call','Job Order Re-submission','Job Order Follow-up');
    $allJoborderEvents= DB::table('events')->where('event_date','<=',$today)->whereIn('type', $jobOderEvents)->where('status','pending')->orderBy('event_date','asc')->get();
    $jobEventIds = [];

    foreach($allJoborderEvents as $allJoborderEvent) {
        $allJoborderEvent->job_order = \DB::table('job_orders')->find($allJoborderEvent->job_order_id);
        if($allJoborderEvent->job_order->owner) {
            $jobEventIds[] = $allJoborderEvent->id;
            if($allJoborderEvent->type=='Submission'||$allJoborderEvent->type=='Job Order Re-submission'||$allJoborderEvent->type=='Job Order Follow-up'){
                $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                ->where('job_order_id',$allJoborderEvent->job_order_id)
                ->where('date',$allJoborderEvent->event_date)
                ->where('submission_status',$allJoborderEvent->type)
                ->where('active',1)
                ->first();
                if($jobOrderSubmissionHistory->active==1){
                    $jobEventIds[] = $allJoborderEvent->id;
                }
            }
        }
    }
    $jobEventIds = array_unique($jobEventIds);
    $jobOrderEvents=  DB::table('events')->whereIn('id',$jobEventIds)->whereIn('type', $jobOderEvents)->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->count();
?>
@if(@$jobOrderEvents>0)
    <!-- <a class="pending-joborders" id="CartShortCut1" href="/admin/pending-joborder-events" style="display: block;" data-original-title="" title="">
        <span class="glyphicon glyphicon-bell" aria-hidden="true" style="font-size: 25px;"></span>  <span style="font-size: 23px; ">You have {{ $jobOrderEvents}} Pending JobOrder Events..!</span>
    </a> -->
@endif
