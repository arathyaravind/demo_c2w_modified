<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;
use CRUDBooster;
use DB;
use PDF;
use Response;
use PdfParser;
use PhpOffice\PhpWord;
use Carbon;
use Mail;
// top of your controller
ini_set('max_execution_time', 0);
ini_set('date.timezone','Asia/Kolkata');

// Also you can increase memory
ini_set('memory_limit','2048M');
class CustomController extends BaseController
{
    public function setIntroCallDate(Request $_request) {       
        $jobOrder = \DB::table('job_orders')->where('id', $_request->input('job_order_id'))->first();
        if($jobOrder && $_request->input('intro_call')) {
            \DB::table('job_orders')
            ->where('id', $_request->input('job_order_id'))
            ->update([
                'intro_call_date' => $this->mdt($_request, 'intro_call'),
                'status' => 'Intro Call Scheduled'
            ]);
            $this->deleteEvent('Intro Call', $_request->input('job_order_id'));
            $this->addEvent($_request->input('job_order_id'), $this->mdt($_request, 'intro_call'), 'Intro Call','pending');
        }
        return redirect('/admin/job_order_applicants?job_order_id=' . $_request->input('job_order_id'));
    }
    public function setIntroCallDateByEvent(Request $_request) {       
        $jobOrder = \DB::table('job_orders')->where('id', $_request->input('job_order_id'))->first();
        if($jobOrder && $_request->input('intro_call')) {
            \DB::table('job_orders')
            ->where('id', $_request->input('job_order_id'))
            ->update([
                'intro_call_date' => $this->mdt($_request, 'intro_call'),
                'status' => 'Intro Call Scheduled'
            ]);
            $this->deleteEvent('Intro Call', $_request->input('job_order_id'));
            $this->addEvent($_request->input('job_order_id'), $this->mdt($_request, 'intro_call'), 'Intro Call','pending');
        }
        if($_request->input('introcall_status')=='2'){
          return redirect('/admin/job-orders-introcall-scheduled');
        }else{
         return redirect('/admin/pending-joborder-events');   
        }
        
    }
    public function setIntroCallDateByPendingEvent(Request $_request) {       
        $jobOrder = \DB::table('job_orders')->where('id', $_request->input('job_order_id'))->first();
        if($jobOrder && $_request->input('intro_call')) {
            \DB::table('job_orders')
            ->where('id', $_request->input('job_order_id'))
            ->update([
                'intro_call_date' => $this->mdt($_request, 'intro_call'),
                'status' => 'Intro Call Scheduled'
            ]);
            $this->deleteEvent('Intro Call', $_request->input('job_order_id'));
            $this->addEvent($_request->input('job_order_id'), $this->mdt($_request, 'intro_call'), 'Intro Call','pending');
        }
        return redirect('admin/pending-events');
    }
    public function cancelIntroCallDate($_id) {
        $jobOrder = \DB::table('job_orders')->where('id', $_id)->first();
        if($jobOrder) {
            \DB::table('job_orders')
            ->where('id', $_id)
            ->update([
                'intro_call_date' => NULL,
                'status' => 'New'
            ]);
            $this->deleteEvent('Intro Call', $_id);
        }
        return redirect('/admin/job_order_applicants?job_order_id=' . $_id);
    }

    public function setSubmissionDate(Request $_request) {
        $jobOrder = \DB::table('job_orders')->where('id', $_request->input('job_order_id'))->first();
        if($jobOrder && $_request->input('submission')) {
          \DB::table('job_orders')
          ->where('id', $_request->input('job_order_id'))
          ->update([
            'submission_date' => $this->mdt($_request, 'submission'),
            'status' => 'Hiring In Progress'
        ]);
          $this->deleteEvent('Intro Call', $_request->input('job_order_id'));
          $this->deleteEvent('Submission', $_request->input('job_order_id'));
          $this->addEvent($_request->input('job_order_id'), $this->mdt($_request, 'submission'), 'Submission','pending');
          $this->addOrderSubmissionHistory($_request->input('job_order_id'),'Submission',$this->mdt($_request, 'submission'));

      }
      return redirect('/admin/job_order_applicants?job_order_id=' . $_request->input('job_order_id'));
    }

    public function setSubmissionDateByEvent(Request $_request) {
        $jobOrder = \DB::table('job_orders')->where('id', $_request->input('job_order_id'))->first();
        if($jobOrder && $_request->input('submission')) {
          \DB::table('job_orders')
          ->where('id', $_request->input('job_order_id'))
          ->update([
            'submission_date' => $this->mdt($_request, 'submission'),
            'status' => 'Hiring In Progress'
            ]);
            $this->deleteEvent('Intro Call', $_request->input('job_order_id'));
            $this->deleteEvent('Submission', $_request->input('job_order_id'));
            $this->addEvent($_request->input('job_order_id'), $this->mdt($_request, 'submission'), 'Submission','pending');
            $this->addOrderSubmissionHistory($_request->input('job_order_id'),'Submission',$this->mdt($_request, 'submission'));

        }
        if($_request->input('submission_status')=='1'){
             return redirect('admin/job-orders-introcall-scheduled');
         }else{
             return redirect('/admin/pending-joborder-events');
        }
       
    }

    public function setSubmissionDateByPendingEvent(Request $_request) {
        $jobOrder = \DB::table('job_orders')->where('id', $_request->input('job_order_id'))->first();
        if($jobOrder && $_request->input('submission')) {
          \DB::table('job_orders')
          ->where('id', $_request->input('job_order_id'))
          ->update([
            'submission_date' => $this->mdt($_request, 'submission'),
            'status' => 'Hiring In Progress'
        ]);
        $this->deleteEvent('Intro Call', $_request->input('job_order_id'));
        $this->deleteEvent('Submission', $_request->input('job_order_id'));
        $this->addEvent($_request->input('job_order_id'), $this->mdt($_request, 'submission'), 'Submission','pending');
        $this->addOrderSubmissionHistory($_request->input('job_order_id'),'Submission',$this->mdt($_request, 'submission'));

        }
        return redirect('/admin/pending-events');
    }

    public function getJobOrderApplicantDetails($_id) {
        $applicant = \DB::table('job_order_applicants')->where('id', $_id)->first();
        if($applicant) {
            $applicant->details = \DB::table('candidates')->where('id', $applicant->candidate_id)->first();
        }
        return ($applicant ? json_encode($applicant) : '');
    }

    private function mdt($_request, $_input) {
        if(!$_request->input($_input)) return null;
        if($_input != 'interview_date')
            return \DateTime::createFromFormat('d/m/Y', $_request->input($_input))->format('Y-m-d');
        else
            return \DateTime::createFromFormat('d/m/Y h:i A', $_request->input($_input))->format('Y-m-d H:i:s');
    }

    public function setJobOrderApplicantStatus(Request $_request) {
        $ids=explode(',',$_request->input('id'));
        foreach($ids as $id){
            $applicant = \DB::table('job_order_applicants')->where('id',$id)->first();
            if($applicant) {
              if($applicant->secondary_status=='Joined'&& $_request->input('secondary_status')!='Joined'){
                    $applicant_joining_date=' ';
              }
              else{
                    $applicant_joining_date=$applicant->joining_date;
               }
               $logRecordID = \DB::table('job_order_applicant_statuses')
               ->insertGetId([
                'job_order_applicant_id' =>$id,
                'prev_primary_status' => $applicant->primary_status,
                'prev_secondary_status' => $applicant->secondary_status,
                'new_primary_status' => $_request->input('primary_status'),
                'new_secondary_status' => $_request->input('secondary_status'),
                'note' => $_request->input('note'),
                'prev_callback_date' => $applicant->callback_date,
                'prev_feedback_date' =>$applicant->feedback_date,
                'prev_scheduled_interview_date' => $applicant->scheduled_interview_date,
                'prev_scheduled_feedback_date' => $applicant->scheduled_feedback_date,
                'prev_interview_date' => $applicant->interview_date,
                'prev_interview_confirmation_date' => $applicant->interview_confirmation_date,
                'prev_interview_followup_date' => $applicant->interview_followup_date,
                'prev_confirm_offer_followup_date' => $applicant->confirm_offer_followup_date,
                'prev_interview_reschedule_date' => $applicant->interview_reschedule_date,
                'prev_offer_confirmation_date' => $applicant->offer_confirmation_date,
                'prev_joining_date' => $applicant_joining_date,
                'creator_id' => CRUDBooster::myId(),
                'created_at' => \DB::raw('NOW()')
                ]);
                   if(empty($applicant->interview_date) && $_request->input('secondary_status')=='Interview in Progress'){
                        $applicant->interview_date=$this->mdt($_request,'task_confirm_attendance');
                   }
                   \DB::table('job_order_applicants')
                   ->where('id', $id)
                   ->update([
                    'primary_status' => $_request->input('primary_status'),
                    'secondary_status' => $_request->input('secondary_status'),
                    'next_action' => $_request->input('next_action'),
                    'callback_date' => $this->mdt($_request, 'callback'),
                    'feedback_date' => $this->mdt($_request,'feedback_date'),
                    'scheduled_interview_date' => $this->mdt($_request, 'scheduled_interview_date'),
                    'scheduled_feedback_date' => $this->mdt($_request, 'scheduled_feedback_date'),
                    'interview_date' =>($_request->input('secondary_status')=='Interview in Progress'? $applicant->interview_date:$this->mdt($_request, 'interview_date')) ,
                    'interview_confirmation_date' => $this->mdt($_request, 'interview_confirmation_date'),
                    'interview_followup_date' => $this->mdt($_request, 'interview_followup_date'),
                    'confirm_offer_followup_date' => $this->mdt($_request, 'confirm_offer_followup_date'), 
                    'interview_reschedule_date' => $this->mdt($_request, 'interview_reschedule_date'),
                    'interview_round' => ($_request->input('increment_interview_round') ? $applicant->interview_round + intval($_request->input('increment_interview_round')) : $applicant->interview_round),
                    'offer_confirmation_date' => $this->mdt($_request, 'offer_confirmation_date'),
                    'joining_date' =>  $this->mdt($_request, 'joining_date'),
                    'approved_ctc' => ($_request->input('approved_ctc') ? $_request->input('approved_ctc') : $applicant->approved_ctc),

                    'date_submitted' => ($_request->input('submission')? $this->mdt($_request, 
                        'submission') : $applicant->date_submitted)
                ]);
                   \DB::table('job_order_applicant_statuses')
                   ->where('id', $logRecordID)
                   ->update([
                    'new_callback_date' => $this->mdt($_request,'callback'),
                    'new_feedback_date' => $this->mdt($_request,'feedback_date'),
                    'new_scheduled_interview_date' => $this->mdt($_request, 'scheduled_interview_date'),
                    'new_scheduled_feedback_date' => $this->mdt($_request, 'scheduled_feedback_date'),
                    'new_interview_date' => ($_request->input('secondary_status')=='Interview In Progress'? $applicant->interview_date:$this->mdt($_request, 'interview_date')),
                    'new_interview_confirmation_date' => $this->mdt($_request, 'interview_confirmation_date'),
                    'new_interview_followup_date' => $this->mdt($_request, 'interview_followup_date'), 
                    'new_confirm_offer_followup_date' => $this->mdt($_request, 'confirm_offer_followup_date'), 
                    'new_interview_reschedule_date' => $this->mdt($_request, 'interview_reschedule_date'),
                    'new_offer_confirmation_date' => $this->mdt($_request, 'offer_confirmation_date'),
                    'new_joining_date' => $this->mdt($_request, 'joining_date'),
                ]);
                if($_request->input('secondary_status')=='Interview in Progress') {
                  \DB::table('events')->where('job_order_id',$applicant->job_order_id)->where('candidate_id',$applicant->candidate_id)->where('status','pending')->where('type', '!=' ,'Interview')->delete();
                    if($_request->input('interview_date')==0){
                        if($_request->input('task_confirm_attendance')){
                          \DB::table('events')->where('job_order_id',$applicant->job_order_id)->where('candidate_id',$applicant->candidate_id)->where('status','pending')->where('type','Confirm Attendance')->delete();
                          $this->addApplicantEvent($applicant->job_order_id,$applicant->candidate_id,$applicant->creator_id,date('Y-m-d',strtotime($applicant->interview_date)), 'Confirm Attendance','pending');
                        }else{

                            $this->addApplicantEvent($applicant->job_order_id,$applicant->candidate_id,$applicant->creator_id,date('Y-m-d',strtotime($applicant->interview_date)), 'Confirm Attendance','pending');
                        }

                    }
                   
                } else{
                   $this->deleteApplicantEvents($applicant->job_order_id, $applicant->candidate_id);
                }
                //No Opening Vacancy- Delete Events
                $jobOrderVacancy=DB::table('job_orders')->where('id',$applicant->job_order_id)->first();
                $vacanices=$jobOrderVacancy->num_vacancies;
                $places =DB::table('job_order_applicants')
                            ->whereNull('job_order_applicants.deleted_at')
                            ->where('job_order_applicants.primary_status', 'Place')
                            ->where('job_order_applicants.secondary_status', 'Joined')
                            ->where('job_order_applicants.job_order_id',$applicant->job_order_id)
                            ->orderBy('job_order_applicants.id','desc')
                            ->get();
                $places_count=$places->count();
                $openings=$vacanices-$places_count;
                if($openings>=0){
                $updateVacancy=DB::table('job_orders')->where('id',$applicant->job_order_id)->update(array('openings_available' => $openings));
              if($openings=='0'){
                \DB::table('events')->where('job_order_id',$applicant->job_order_id)->whereNotNull('candidate_id')->delete();
                }
              }                       
            // add events
                if($_request->input('callback')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'callback'), 'Call Back','pending');
                }
                if($_request->input('submission')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'submission'), 'Submit','pending');
                    //return'submit';
                }
                if($_request->input('feedback_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id,$this->mdt($_request, 'feedback_date'), 'Get Submission Feedback','pending');
                }
                if($_request->input('scheduled_feedback_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'scheduled_feedback_date'), 'Get Submission Feedback','pending');
                }
                if($_request->input('scheduled_interview_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'scheduled_interview_date'), 'Set Interview','pending');
                }
                if($_request->input('interview_date')) {
                    if($_request->input('secondary_status')=='Interview Rescheduled') {
                      $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id,$this->mdt($_request, 'interview_date'), 'Rescheduled Interview','pending');  
                    }
                    if($_request->input('secondary_status')=='Interview Scheduled') {
                      $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_date'), 'Interview','pending');
                    }
                    if($_request->input('secondary_status')=='Shortlisted for Next Round') {
                      $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_date'), 'Interview Next Round','pending');
                    }
                    
                }
                if($_request->input('interview_confirmation_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_confirmation_date'), 'Confirm Interview','pending');
                }
                      /*  if($_request->input('interview_followup_date')) {
                            $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id, $this->mdt($_request, 'interview_followup_date'), 'Interview Follow-up','pending');
                        } */
                if($_request->input('interview_followup_date')) {
                   if($_request->input('secondary_status')=='On Hold') {
                       $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_followup_date'), 'Interview On Hold','pending');
                   }
                   if($_request->input('secondary_status')=='To be Offered') {
                       $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_followup_date'),'Offer Follow-up','pending');
                   }
                   /*if($_request->input('secondary_status')=='Interview In Progress') {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_followup_date'), 'Interview Follow-up','pending');
                   }*/
                   if($_request->input('secondary_status')=='Interview Done') {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_followup_date'), 'Interview Follow-up','pending');
                   }
                } 
                if($_request->input('interview_reschedule_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'interview_reschedule_date'), 'Interview Feedback Rescheduled','pending');
                }
                if($_request->input('offer_confirmation_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id,$this->mdt($_request, 'offer_confirmation_date'), 'Confirm Offer','pending');
                }
                if($_request->input('confirm_offer_followup_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id,$this->mdt($_request, 'confirm_offer_followup_date'), 'Confirm Offer Follow-up','pending');
                }
                if($_request->input('joining_date')) {
                    $this->addApplicantEvent($applicant->job_order_id, $applicant->candidate_id,$applicant->creator_id, $this->mdt($_request, 'joining_date'), 'Confirm Joining','pending');
                }

                //return "OK";
            }
            //return "ERROR";
        }
        return "OK";    
       
    }
    
    public function suggestFunctionalArea(Request $_request) {
        $result = \DB::table('industry_functional_areas')->where('name', 'LIKE', '%' . $_request->input('term') . '%')->select('name')->get();
        $items = [];
        foreach ($result as $item) {
            $items[] = $item->name;
        }
        return json_encode($items);
    }

    public function suggestFunctionalAreaSkill(Request $_request) {
        $result = \DB::table('industry_functional_area_skills')->where('name', 'LIKE', '%' . $_request->input('term') . '%')->select('name')->get();
        $items = [];
        foreach ($result as $item) {
            $items[] = $item->name;
        }
        return json_encode($items);
    }

    public function suggestGeneralSkill(Request $_request) {
        $result = \DB::table('general_skills')->where('name', 'LIKE', '%' . $_request->input('term') . '%')->select('name')->get();
        $items = [];
        foreach ($result as $item) {
            $items[] = $item->name;
        }
        return json_encode($items);
    }
    public function checkOpenings(Request $_request) {
        $jobOrderVacancy=DB::table('job_orders')->where('id', $_request->input('job_order_id'))
        ->first();
        $openings=$jobOrderVacancy->openings_available;
        if($openings<=0){
            return"yes";
        } 
    }
    public function associateCandidate(Request $_request) {                      
        $existing = \DB::table('job_order_applicants')
        ->where('job_order_id', $_request->input('job_order_id'))
        ->where('candidate_id', $_request->input('candidate_id'))
        ->whereNull('deleted_at')
        ->first();
        if(!$existing) {
            $newJobOrderApplicant =\DB::table('job_order_applicants')
            ->insertGetId([
                'job_order_id' => $_request->input('job_order_id'),
                'candidate_id' => $_request->input('candidate_id'),
                'primary_status' => 'Qualify',
                'secondary_status' => 'Pending Review',
                'next_action' => 'Qualify',
                'created_at' => \DB::raw('NOW()'),
                'updated_at' => \DB::raw('NOW()'),
                'creator_id' => CRUDBooster::myId()
            ]);
            \DB::table('job_order_applicant_statuses')->insert([
                'job_order_applicant_id' => $newJobOrderApplicant,
                'prev_primary_status' => '',
                'prev_secondary_status' => '',
                'new_primary_status' => 'Qualify',
                'new_secondary_status' => 'Pending Review',
                'note' => '',
                'creator_id' => CRUDBooster::myId(),
                'created_at' => \DB::raw('NOW()')
            ]);
        }
        else {
            $existing = \DB::table('job_order_applicants')
            ->where('job_order_id', $_request->input('job_order_id'))
            ->where('candidate_id', $_request->input('candidate_id'))
            ->update([
                'primary_status' => 'Qualify',
                'secondary_status' => 'Pending Review',
                'next_action' => 'Qualify',
                'created_at' => \DB::raw('NOW()'),
                'updated_at' => \DB::raw('NOW()'),
                'creator_id' => CRUDBooster::myId(),
                'deleted_at' => null
            ]);
        }
        return "OK";
    }

    public function unassociateCandidate(Request $_request) {
        $jobOrderApplicant = \DB::table('job_order_applicants')->find($_request->input('id'));

        \DB::table('events')->where('job_order_id',$jobOrderApplicant->job_order_id)->where('candidate_id',$jobOrderApplicant->candidate_id)->delete();

        \DB::table('job_order_applicants')
        ->where('id', $_request->input('id'))
        ->update([
            'deleted_at' => \DB::raw('NOW()')
        ]);

        \DB::table('job_order_applicant_statuses')
        ->insert([
            'job_order_applicant_id' => $jobOrderApplicant->id,
            'prev_primary_status' => $jobOrderApplicant->primary_status,
            'prev_secondary_status' => $jobOrderApplicant->secondary_status,
            'new_primary_status' => 'Unassociate',
            'new_secondary_status' => 'Deleted',
            'note' => '',
            'prev_callback_date' => $jobOrderApplicant->callback_date,
            'prev_scheduled_feedback_date' => $jobOrderApplicant->scheduled_feedback_date,
            'prev_interview_date' => $jobOrderApplicant->interview_date,
            'prev_interview_confirmation_date' => $jobOrderApplicant->interview_confirmation_date,
            'prev_interview_followup_date' => $jobOrderApplicant->interview_followup_date,
            'prev_confirm_offer_followup_date' => $jobOrderApplicant->confirm_offer_followup_date,
            'prev_offer_confirmation_date' => $jobOrderApplicant->offer_confirmation_date,
            'prev_joining_date' => $jobOrderApplicant->joining_date,
            'creator_id' => CRUDBooster::myId(),
            'created_at' => \DB::raw('NOW()')
        ]); 
        $website_applications= \DB::table('website_applications')
         ->join('website_candidates', 'website_candidates.id', '=', 'website_applications.web_candidate_id')
         ->where('job_order_id',$jobOrderApplicant->job_order_id)
         ->select('website_candidates.*','website_applications.*','website_candidates.id') 
         ->get();
        foreach ($website_applications as   $website_application) {
           $existingMail = \DB::table('candidates')->where('primary_email',$website_application->primary_email)->first();
           if($existingMail) {
            $id=$existingMail->id;
            $existingJoborderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$jobOrderApplicant->job_order_id)->where('candidate_id',$id)->wherenotNull('job_order_applicants.deleted_at')->first();
            \DB::table('website_applications')->where('job_order_id',$jobOrderApplicant->job_order_id)->where('web_candidate_id',$website_application->web_candidate_id)->update([
                        'status'=>'inactive',
                        'remove_status' =>'removed'    
                ]);;
        }
    }
        
  }

    public function getJobOrderApplicantLog($_id) {
        $applicant = \DB::table('job_order_applicants')->where('id', $_id)->first();
        if($applicant) {
            $applicant->details = \DB::table('candidates')->where('id', $applicant->candidate_id)->first();
            $applicant->log = \DB::table('job_order_applicant_statuses')
            ->where('job_order_applicant_id', $_id)
            ->orderBy('id', 'desc')
            ->get();
            foreach ($applicant->log as $item) {
                $item->creator = \DB::table('cms_users')->where('id', $item->creator_id)->first()->name;
                $item->created_at = date("d/m/Y", strtotime($item->created_at));
            }
        }
        return json_encode($applicant);
    }

    public function setJobOrderStatus(Request $_request) {

        $submission_date=\DB::table('job_orders')->where('id', $_request->input('id'))->first()->submission_date;
        $introcall_date=\DB::table('job_orders')->where('id', $_request->input('id'))->first()->intro_call_date;
        $currentStatus=\DB::table('job_orders')->where('id', $_request->input('id'))->first()->status;
        $today=date('Y-m-d');
        if($_request->input('status')=='Hiring In Progress'){
            if($currentStatus == 'On Hold') {
                $eventHiringUpdate=\DB::table('events')
                ->where('job_order_id', $_request->input('id'))
                ->update([
                        'status' =>'pending',
                        'event_date'=>$today
                ]);
            }
            if(!empty($submission_date&&$introcall_date))
            {
                \DB::table('job_orders')
                ->where('id', $_request->input('id'))
                ->update([
                    'status' => $_request->input('status')
                ]);
            }
            elseif((!empty($introcall_date) && empty($submission_date))) {
                \DB::table('job_orders')
                ->where('id', $_request->input('id'))
                ->update([
                    'status' => 'Intro Call Scheduled'
                ]); 
            }
            else{
                \DB::table('job_orders')
                ->where('id', $_request->input('id'))
                ->update([
                    'status' => 'New'
                ]); 
            }
        }
        else{ 
            \DB::table('job_orders')
            ->where('id', $_request->input('id'))
            ->update([
                'status' => $_request->input('status')
            ]);
        }

        if(($_request->input('status') == 'Cancelled') || ($_request->input('status') == 'On Hold') || ($_request->input('status') == 'Completed')){
          if($_request->input('status') == 'On Hold'){
            $eventUpdate=\DB::table('events')
            ->where('job_order_id', $_request->input('id'))
            ->update([
                        'status' =>'on-hold'
                ]);
          }
          else{
            if($currentStatus == 'Intro Call Scheduled') {
                \DB::table('job_orders')
                    ->where('id', $_request->input('id'))
                    ->update([
                        'intro_call_date' => null
                ]);
            }
            $eventDelete=\DB::table('events')
            ->where('job_order_id', $_request->input('id'))
            ->delete();
            $submissionHistories = \DB::table('job_order_submission_history')->where('job_order_id',$_request->input('id'))->get();
            if($submissionHistories->count() != 0) {
                foreach ($submissionHistories as $submissionHistory) {
                    $submissionType = $submissionHistory->submission_status;

                    $lastestHistory = \DB::table('job_order_submission_history')->where('job_order_id', $_request->input('id'))
                    ->orderBy('id', 'desc')
                    ->where('active', 1)
                    ->first();

                    $existing = \DB::table('job_order_submission_history')
                    ->where('id', $lastestHistory->id)
                    ->where('job_order_id', $_request->input('id'))
                    ->update([
                        'active' => 0,
                        'updated_at' => \DB::raw('NOW()')
                    ]);


                        // $this->removeResubmissionFromEvents($_request->input('id'), $submissionType); // , $_request->input('status')
                    $deleteEvent = $this->deleteEvent($submissionType, $_request->input('id'));
                }
            }
          }
            
        }
    }










    public function getEvents() {

 




       $loadIds = \DB::table('events') ->select(DB::raw('max(id) as id'))->where('status','pending')->groupBy('job_order_id', 'candidate_id')->orderBy('created_at', 'desc');
      
       
     
        $events = \DB::table('events')  ->whereIn('id', $loadIds);
       
        
        if($_REQUEST['status'] != ''){
            $events = $events->where('type',$_REQUEST['status']);
        }
        
        if($_REQUEST['owner'] != ''){
            $events = $events->where('owner_id',$_REQUEST['owner']);
        }

        if($_REQUEST['start'] != ''){
            $events = $events->whereDate('event_date',date('Y-m-d', $_REQUEST['start']));
        }
        $events = $events->get();
        
        // foreach($events as $event) {
        //     $event->job_order = \DB::table('job_orders')->find($event->job_order_id);
        //     $event->company = \DB::table('companies')->find($event->job_order->company_id);
        //     if($event->candidate_id) {
        //         $event->candidate = \DB::table('candidates')->find($event->candidate_id);
        //     }
        //     if($event->owner_id > 0){
        //         $event->owner = \DB::table('cms_users')->find($event->owner_id);
        //     } else {
        //         $event->owner = "No owner";
        //     }
        //     $event->colour = $this->getStatusColour($event->type);
        // }
        
        return $events;
    }

    public function addEvent($_jobOrderId,$_eventTime,$_type,$_status) {

        $jobOrderName = \DB::table('job_orders')->where('id',$_jobOrderId)->first();
        $ownerName = \DB::table('cms_users')->where('id',CRUDBooster::myId())->first();

        $companyId = $jobOrderName->company_id;
        $company = \DB::table('companies')->where('id',$companyId)->first();

        \DB::table('events')->insert([
            'job_order_id' => $_jobOrderId,
            'type' => $_type,
            'event_date' => $_eventTime,
            'status' => $_status,
            'created_at' => \DB::raw('NOW()'),
            'owner_id' =>CRUDBooster::myId(),
            'job_order_name' => $jobOrderName->title,
            'owner_name' => $ownerName->name,
            'company_name' => $company->name
        ]);
    }

    public function addApplicantEvent($_jobOrderId,$_candidateId,$_creatorId,$_eventTime,$_type,$_status) {

        $jobOrderName = \DB::table('job_orders')->where('id',$_jobOrderId)->first();
        $candidateName = \DB::table('candidates')->where('id',$_candidateId)->first();
        $ownerName = \DB::table('cms_users')->where('id',$_creatorId)->first();

        $companyId = $jobOrderName->company_id;
        $company = \DB::table('companies')->where('id',$companyId)->first();

        \DB::table('events')->insert([
            'job_order_id' => $_jobOrderId,
            'candidate_id' => $_candidateId,
            'type' => $_type,
            'event_date' => $_eventTime,
            'status' => $_status,
            'created_at' => \DB::raw('NOW()'),
            'owner_id' =>$_creatorId,
            'job_order_name' => $jobOrderName->title,
            'candidate_name' => $candidateName->first_name." ".$candidateName->last_name,
            'owner_name' => $ownerName->name,
            'company_name' => $company->name
        ]);
    }

    public function deleteEvent($_type, $_jobOrderId, $_candidateId = false) {
        $stmt = \DB::table('events')
        ->where('job_order_id', $_jobOrderId)
        ->where('type', $_type);
        if($_candidateId) {
            $stmt = $stmt->where('candidate_id', $_candidateId);
        }
        $stmt->delete();
    }

    public function deleteApplicantEvents($_jobOrderId, $_candidateId) {
        \DB::table('events')
        ->where('job_order_id', $_jobOrderId)
        ->where('candidate_id', $_candidateId)
        ->delete();
    }

    public function saveCompanyContact(Request $_request) {
        $payload = $_request->input();
        $payload['date_created'] = date('Y-m-d H:i:s');
        $payload['date_modified'] = date('Y-m-d H:i:s');
        \DB::table('contacts')->insert($payload);
        return "OK";
    }

    public function updateCompanyContact($_id, Request $_request) {
        $payload = $_request->input();
        \DB::table('contacts')->where('id', $_id)->update([
            'last_name' => $payload['last_name'],
            'first_name' => $payload['first_name'],
            'title' => $payload['title'],
            'email1' => $payload['email1'],
            'email2' => $payload['email2'],
            'phone_work' => $payload['phone_work'],
            'phone_cell' => $payload['phone_cell'],
            'phone_other' => $payload['phone_other'],
            'city' => $payload['city'],
            'company_id' => $payload['company_id'],
            'date_modified' => date('Y-m-d H:i:s')
        ]);
        return "OK";
    }

    public function deleteCompanyContact($_id, Request $_request) {
        \DB::table('contacts')->where('id', $_id)->delete();
        return "OK";
    }

    //Notes
    public function saveCompanyNote(Request $_request) {
        $payload = $_request->input();
        $payload['created_on'] = now();
        $payload['created_by'] = CRUDBooster::myId();
        \DB::table('company_notes')->insert($payload);
        return "OK";
    }

    public function updateCompanyNote($_id, Request $_request) {
        $payload = $_request->input();
        \DB::table('company_notes')->where('id', $_id)->update([
            'note' => $payload['note'],
        ]);
        return "OK";
    }

    public function deleteCompanyNote($_id, Request $_request) {
        \DB::table('company_notes')->where('id', $_id)->delete();
        return "OK";
    }

    //Industry
    public function saveCompanyIndustry(Request $_request) {
        $payload = $_request->input();
        $payload['industry'] = \DB::table('industries')->find($payload['industry_id'])->name;
        \DB::table('company_industries')->insert($payload);
        return "OK";
    }

    public function updateCompanyIndustry($_id, Request $_request) {
        $payload = $_request->input();
        $payload['industry'] = \DB::table('industries')->find($payload['industry_id'])->name;
        \DB::table('company_industries')->where('id', $_id)->update([
            'industry_id' => $payload['industry_id'],
            'industry' => $payload['industry'],
        ]);
        return "OK";
    }

    public function deleteCompanyIndustry($_id, Request $_request) {
        \DB::table('company_industries')->where('id', $_id)->delete();
        return "OK";
    }

    //Departments
    public function saveCompanyDepartment(Request $_request) {
        $payload = $_request->input();
        $payload['created_at'] = now();
        $payload['created_by'] = CRUDBooster::myId();
        \DB::table('office_departments')->insert($payload);
        return "OK";
    }

    public function updateCompanyDepartment($_id, Request $_request) {
        $payload = $_request->input();
        \DB::table('office_departments')->where('id', $_id)->update([
            'name' => $payload['name'],
        ]);
        return "OK";
    }

    public function deleteCompanyDepartment($_id, Request $_request) {
        \DB::table('office_departments')->where('id', $_id)->delete();
        return "OK";
    }

    public function getDashboard(Request $request) {

        $data = [];
        $fullEventsIds=[];
        $today = date('Y-m-d', strtotime(NOW()));
        $addedDays = date('Y-m-d', strtotime($today. ' + 7 days'));

        // $data['orderCount'] =   DB::table('job_orders')->where('status','Hiring In Progress')->count();

        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        $data['orderCount'] = $hiringInProgressOrders->count();

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }

        // $data['interviewing'] =   DB::table('job_order_applicants')
        // ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        // ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        // ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        // ->where('job_order_applicant_statuses.new_primary_status','Interview')
        // ->where('job_order_applicant_statuses.new_secondary_status','Interview Scheduled')
        // ->whereNull('job_order_applicants.deleted_at')
        // ->Groupby('job_order_applicants.id')
        // ->get()
        // ->count();

        $data['interviewing'] =   DB::table('job_order_applicants')
        ->whereIn('job_order_id',$hiringInProgressorderIds)
        ->where('primary_status','Interview')
        ->whereIn('job_order_applicants.secondary_status',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round','Interview in Progress'])
        ->whereNull('job_order_applicants.deleted_at')
        ->get()
        ->count();

        $data['submittedClient'] =   DB::table('job_order_applicants')
        ->whereIn('secondary_status',['Submitted to Client','Reschedule Submission'])
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('deleted_at')
        ->count();

        // $data['interviewFeedback'] =   DB::table('job_order_applicants')
        // ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        // ->where('job_order_applicants.next_action','Get Interview Feedback')
        // ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        // ->whereNull('job_order_applicants.deleted_at')
        // ->count();
        
        $data['interviewFeedback'] =   DB::table('job_order_applicants')
        ->where('next_action','Get Interview Feedback')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at')->get();

        $data['interviewFeedback'] =$data['interviewFeedback']->count();

        $data['confirmOffer'] = DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->where('job_order_applicant_statuses.new_primary_status','Offer')
        ->where('job_order_applicant_statuses.new_secondary_status','Offer Made')
        ->whereNull('job_order_applicants.deleted_at')
        ->Groupby('job_order_applicants.id')
        ->get()
        ->count();

        // $data['confirmJoining'] = DB::table('job_order_applicants')
        // ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        // ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        // ->where('job_order_applicant_statuses.new_primary_status','Place')
        // ->where('job_order_applicant_statuses.new_secondary_status','Joined')
        // ->where('job_order_applicants.joining_date' ,'>=', $today)
        // ->whereNull('job_order_applicants.deleted_at')
        // ->Groupby('job_order_applicants.id')
        // ->get()
        // ->count();        
    
        $data['confirmJoining'] = DB::table('job_order_applicants')
            // ->where('primary_status','Place')
            // ->where('secondary_status','Joined')
            ->where('joining_date' ,'>=', $today)
            ->whereNull('job_order_applicants.deleted_at')
            ->get()
            ->count();        

        $data['introCallScheduled'] = DB::table('job_orders')
        ->whereNull('submission_date')
        ->whereNotNull('intro_call_date')
        ->where('status', 'like', 'Intro Call Scheduled')
        ->get()
        ->count();

        $data['submissionDate'] = DB::table('job_orders')
        ->join('job_order_submission_history', 'job_orders.id', '=', 'job_order_submission_history.job_order_id')
        ->where('job_order_submission_history.active',1)
        ->where('job_order_submission_history.date','>=',$today)
        ->where('job_orders.status','Hiring In Progress')
        ->count();

        $candidatesJoined= DB::table('job_order_applicants')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id') 
        ->join('job_order_applicant_statuses', 'job_order_applicant_statuses.job_order_applicant_id', '=', 'job_order_applicants.id')
        ->where('job_order_applicants.secondary_status','Joined')
        // ->where('job_order_applicants.next_action','Send Invoice')
        ->whereNull('job_order_applicants.deleted_at')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_order_applicants.id as applicant_id','job_orders.title as title')
        ->where('job_order_applicant_statuses.new_secondary_status','Joined')
        ->where('job_order_applicant_statuses.new_primary_status','Place')
        ->whereNotNull('job_order_applicant_statuses.prev_joining_date')
        ->groupBy('job_order_applicant_statuses.job_order_applicant_id')
        ->orderBy('job_order_applicant_statuses.id','DESC')
        ->get();
        $data['candidateJoined']=$candidatesJoined->count();
        // $data['submissionDate'] = DB::table('job_orders')
        // ->where('submission_date','>=',$today)
        // ->where('status','Hiring In Progress')
        // ->count();

     /*   $data['submission'] = $this->countFromJobOrderApplicants(null, null,'date_submitted',$request);
        $data['interviewScheduled'] = $this->countFromJobOrderApplicantStatuses(null,null,'new_interview_date',$request);
        $data['joining'] = $this->countFromJobOrderApplicantStatuses(null,null,'new_joining_date',$request);
       */

        $fullEvents = DB::table('events')->where('event_date','>',$today)->where('event_date','<=',$addedDays)->where('status','pending')->orderBy('event_date','asc')->get();
        foreach($fullEvents as $fullEvent) {
            $fullEventsIds[] = $fullEvent->id;
            if($fullEvent->type=='Submission'||$fullEvent->type=='Job Order Re-submission'||
               $fullEvent->type=='Job Order Follow-up'){
               $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                ->where('job_order_id',$fullEvent->job_order_id)->where('date',$fullEvent->event_date)
                ->where('submission_status',$fullEvent->type)->first();
                if($jobOrderSubmissionHistory->active==1){
                    $fullEventsIds[]= $fullEvent->id; 
                }
            }
        }

        $fullEventsIds=array_unique($fullEventsIds);
        $events=DB::table('events')->where('event_date','>',$today)->where('event_date','<=',$addedDays)->whereIn('id',$fullEventsIds)->where('status','pending')->orderBy('event_date','asc')->get();
        $privilege=CRUDBooster::myPrivilegeId();
        if($_REQUEST['status'] || $_REQUEST['owner'] || $_REQUEST['date']) {
            $statusEventsIds = [];
            $ownerEventIds = [];
            $dateEventIds = [];
            foreach($events as $event) {
                $event->job_order = \DB::table('job_orders')->find($event->job_order_id);
                if($event->type ==$_REQUEST['status']) {
                    /*if($privilege==4){
                        if($event->job_order->owner == CRUDBooster::myId()||$event->job_order->recruiter == CRUDBooster::myId()) {
                            $statusEventsIds[] = $event->id;  
                       }
                   }
                   else{
                        $statusEventsIds[] = $event->id;  
                    }*/ 
                     $statusEventsIds[] = $event->id; 
                }
                /*if($event->job_order->owner == $_REQUEST['owner']) {
                    if($privilege==4){
                        if($event->job_order->owner == CRUDBooster::myId()||$event->job_order->recruiter == CRUDBooster::myId()) {
                            $ownerEventIds[] = $event->id;  
                        }
                    }
                    else{
                        $ownerEventIds[] = $event->id;  
                    }  
                }*/
                if($event->owner_id == $_REQUEST['owner']) {
                        $ownerEventIds[] = $event->id;    
                }
                if($event->event_date == $_REQUEST['date']) {
                  /*  if($event->job_order->owner == CRUDBooster::myId()||$event->job_order->recruiter == CRUDBooster::myId()) {
                        $dateEventIds[] = $event->id;  
                   }
                }
                else{
                    $dateEventIds[] = $event->id;  
                }*/
                    $dateEventIds[] = $event->id;  
                }
                if($_REQUEST['status'] && $_REQUEST['owner'] && $_REQUEST['date']) {
                    $eventIds = array_intersect($statusEventsIds,$ownerEventIds,$dateEventIds);
                }
                elseif($_REQUEST['status'] && $_REQUEST['owner']) {
                    $eventIds = array_intersect($statusEventsIds,$ownerEventIds);
                }
                elseif($_REQUEST['owner'] && $_REQUEST['date']) {
                    $eventIds = array_intersect($ownerEventIds,$dateEventIds);
                }
                elseif($_REQUEST['status'] && $_REQUEST['date']) {
                    $eventIds = array_intersect($statusEventsIds,$dateEventIds);
                }
                elseif($_REQUEST['status']) {
                    $eventIds = $statusEventsIds;
                }elseif($_REQUEST['owner']){
                    $eventIds = $ownerEventIds;
                }elseif($_REQUEST['date']){

                    $eventIds = $dateEventIds;
                }
                $eventIds = array_unique($eventIds);
                $events = \DB::table('events')->whereIn('id',$eventIds)->where('status','pending')->get();
            }
        }
        else{
            /*if($privilege==4)
            {
                $eventIds = [];
                foreach($events as $event) {
                    $event->job_order = \DB::table('job_orders')->find($event->job_order_id);
                    if($event->job_order->owner == CRUDBooster::myId()||$event->job_order->recruiter == CRUDBooster::myId()) {
                        $eventIds[] =$event->id;
                    }
                }
                $events =DB::table('events')->where('event_date','>',$today)->where('event_date','<=',$addedDays)->whereIn('id',$eventIds)->where('status','pending')->orderBy('event_date','asc')->get();
            }
            else{
                $events=$events;
            }*/
            $events=$events;
        }

        foreach($events as $event) {
            $event->job_order = \DB::table('job_orders')->find($event->job_order_id);
            $event->company = \DB::table('companies')->find($event->job_order->company_id);
            if($event->candidate_id) {
                $event->candidate = \DB::table('candidates')->find($event->candidate_id);
            }
            //$event->owner = DB::table('cms_users')->where('id',$event->job_order->owner)->first()->name;
            $event->owner = DB::table('cms_users')->where('id',$event->owner_id)->first()->name;
        }

        $owners = DB::table('cms_users')->get();
        $recruiters = DB::table('cms_users')->where('id_cms_privileges',4)->where('status',USER_ACTIVE)->get();
        $activityLogs = \DB::table('job_order_applicant_statuses')->orderBy('id','desc')->limit(20)->get();
// 
        foreach ($activityLogs as $activityLog) {
            $activityLog->creator = \DB::table('cms_users')->where('id', $activityLog->creator_id)->first()->name;
            $jobOrderApplicant = \DB::table('job_order_applicants')->where('id', $activityLog->job_order_applicant_id)->first();
            $activityLog->jobOrder = \DB::table('job_orders')->where('id', $jobOrderApplicant->job_order_id)->first()->title;
            $candidate = \DB::table('candidates')->where('id', $jobOrderApplicant->candidate_id)->first();
            $activityLog->candidateName = $candidate->first_name.' '.$candidate->last_name;

            //$date=date_create($activityLog->created_at);
            $activityLog->created_at=date('d F Y g:i A',strtotime("5 hours 30 minutes", strtotime($activityLog->created_at)));
            //$activityLog->created_at=date_format($date,"d F Y g:i A");
        }

        return view('override.dashboard',compact('data','events','owners','recruiters','activityLogs'));
    }

    public function JENotifications() {
      return view('override.je-notifications');
    }
    public function ENotifications() {
      return view('override.e-notifications');
    }
    public function dbCandidateStatus(Request $request) {
        // dump($request->all());
      $today = date('Y-m-d', strtotime(NOW()));

      $hipoItems = DB::table('job_orders')->whereIn('status',['Hiring In Progress','Completed','On Hold','Cancelled'])->get();
      $hipoItemIDs = [];
      foreach ($hipoItems as $hipoItem) {
        $hipoItemIDs[] = $hipoItem->id;
      }

      $data = [];
      $data['submission'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, 'Submission',['Submitted to Client','Submitted to client'],'created_at',$request);
      $data['interviewScheduled'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, 'Interview',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round'],'created_at',$request);
      $data['joining'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, null,['Offer Accepted','Joining Extended'],'created_at',$request);
      $data['offerMade'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, 'Offer',['Offer Made'],'created_at',$request);
      $data['rejected'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, null,['Rejected by the Client','Rejected by the client'],'created_at',$request);
      $data['interviewsDone'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, 'Interview',['Interview Done'] ,'created_at',$request);
      $data['interviewsBackout'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, 'Interview',["Backed Out"] ,'created_at',$request);
      $data['joiningBackout'] = $this->countFromJobOrderApplicantStatuses($hipoItems, $hipoItemIDs, 'Place',["Backed Out"] ,'created_at',$request);
      $candidateQuery = DB::table('candidates');
      if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
        $candidateQuery = $candidateQuery->whereDate('created_at','>=',$this->mdt($request, 'fromDate'))->whereDate('created_at','<=',$this->mdt($request, 'toDate'));
        // $candidateQuery = $candidateQuery->whereDate('created_at','>=',$_REQUEST['fromDate'])->whereDate('created_at','<=',$_REQUEST['toDate']);
      } else {
        $candidateQuery =  $candidateQuery->whereDate('created_at','=', $today);
        // $data['offerMade'] = $this->countFromJobOrderApplicantStatuses('Offer',['Offer Made'],'created_at',$request);
        // $data['rejected'] = $this->countFromJobOrderApplicantStatuses(null,['Rejected by the Client'],'created_at',$request);
        // $data['interviewsDone'] = $this->countFromJobOrderApplicantStatuses('Interview',["On Hold", "Rescheduled", "Rejected by the client", "Shortlisted for Next Round", "To be Offered"] ,'created_at',$request);
        // $data['interviewsBackout'] = $this->countFromJobOrderApplicantStatuses('Interview',["Backed Out"] ,'created_at',$request);
        // $data['joiningBackout'] = $this->countFromJobOrderApplicantStatuses('Place',["Backed Out"] ,'created_at',$request);
      }

      if($_REQUEST['recruiter']) {
        $candidateQuery = $candidateQuery->where('creator_id',$_REQUEST['recruiter']);
      }
      $data['candidatesAdded'] = $candidateQuery->count();

      $owners = DB::table('cms_users')->get();

      return view('override.db-candidate-status', compact('data', 'owners'));
    }

/*
    public function countFromJobOrderApplicants($_primaryStatus, $_secondaryStatus, $_field, Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses', 'job_order_applicant_statuses.job_order_applicant_id', '=', 'job_order_applicants.id')
        ->select('job_order_applicants.*','job_order_applicant_statuses.*')
        ->groupBy('job_order_applicant_statuses.job_order_applicant_id')
        ->whereNull('job_order_applicants.deleted_at');
        if($_primaryStatus) {
            $query = $query->where('job_order_applicants.primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('job_order_applicants.secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("job_order_applicants.$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("job_order_applicants.$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("job_order_applicants.$_field",'=',$today);
            }
        }

        if($_REQUEST['recruiter']) {
            $jobOrderIds = [];
            $recruiterJobOrderIds = [];
            //$jobOrderApplicants = $query->get(); 
            $jobOrderApplicants =  $query->where('job_order_applicant_statuses.creator_id',$_REQUEST['recruiter'])->get();
            foreach ($jobOrderApplicants as $jobOrderApplicant) {
                $jobOrderIds[] = $jobOrderApplicant->job_order_id;
            }            
            $recruiterJobOrders = DB::table('job_orders')->whereIn('id',$jobOrderIds)->get();
            foreach ($recruiterJobOrders as $recruiterJobOrder) {
                $recruiterJobOrderIds[] = $recruiterJobOrder->id;
            }
            $query = $query->whereIn('job_order_id',$recruiterJobOrderIds);

        }

        $query=$query->get();
        return $query->count();
    }*/ 
    public function countFromJobOrderApplicants($_primaryStatus, $_secondaryStatus, $_field, Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses', 'job_order_applicant_statuses.job_order_applicant_id', '=', 'job_order_applicants.id')
        ->select('job_order_applicants.*','job_order_applicant_statuses.*')
        ->groupBy('job_order_applicant_statuses.job_order_applicant_id')
        ->whereNull('job_order_applicants.deleted_at');
        if($_primaryStatus) {
            $query = $query->where('job_order_applicants.primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('job_order_applicants.secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("job_order_applicants.$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("job_order_applicants.$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("job_order_applicants.$_field",'=',$today);
            }
        }

        if($_REQUEST['recruiter']) {
            $jobOrderIds = [];
            $recruiterJobOrderIds = [];
            //$jobOrderApplicants = $query->get(); 
            $jobOrderApplicants =  $query->where('job_order_applicants.creator_id',$_REQUEST['recruiter'])->get();
            foreach ($jobOrderApplicants as $jobOrderApplicant) {
                $jobOrderIds[] = $jobOrderApplicant->job_order_id;
            }            
            $recruiterJobOrders = DB::table('job_orders')->whereIn('id',$jobOrderIds)->get();
            foreach ($recruiterJobOrders as $recruiterJobOrder) {
                $recruiterJobOrderIds[] = $recruiterJobOrder->id;
            }
            $query = $query->whereIn('job_order_id',$recruiterJobOrderIds);

        }

        $query=$query->get();
        return $query->count();
    }

    /*public function countFromJobOrderApplicantStatuses($_primaryStatus, $_secondaryStatus, $_field, Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = DB::table('job_order_applicant_statuses');
        if($_primaryStatus) {
            $query = $query->where('new_primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('new_secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("$_field",'=',$today);
            }
        }
          if($_REQUEST['recruiter']) {
            $query= $query->where('creator_id',$_REQUEST['recruiter']);*/
          /* $allJobOrderApplicantIds = [];
            $allJobOrderIds = [];
            $filteredJobOrderIds = [];
            //$allJobOrderApplicantStatus = $query->get();
            $allJobOrderApplicantStatus = $query->where('creator_id',$_REQUEST['recruiter'])->get();
            foreach ($allJobOrderApplicantStatus as $jobOrderApplicantStatus) {
                $allJobOrderApplicantIds[] = $jobOrderApplicantStatus->job_order_applicant_id;
            }
            $allJobOrderApplicants = DB::table('job_order_applicants')->whereIn('id',$allJobOrderApplicantIds)->get();
            foreach ($allJobOrderApplicants as $allJobOrderApplicant) {
                $allJobOrderIds[] =  $allJobOrderApplicant->job_order_id;
            }
            //$allJobOrders = DB::table('job_orders')->where('recruiter',$_REQUEST['recruiter'])->whereIn('id',$allJobOrderIds)->get();
            $allJobOrders = DB::table('job_orders')->whereIn('id',$allJobOrderIds)->get();
            foreach ($allJobOrders as $allJobOrder) {
                $filteredJobOrderIds[] = $allJobOrder->id;
            }
            $filteredCountQuery = $filteredCountQuery->whereIn('job_order_id',$filteredJobOrderIds);*/
       /* }          
        $jobOrderApplicantIds = [];
        $jobOrderApplicantsStatuses = $query->select('job_order_applicant_id')->distinct()->get();

        foreach($jobOrderApplicantsStatuses as $jobOrderApplicantsStatus) {
            $jobOrderApplicantIds[] = $jobOrderApplicantsStatus->job_order_applicant_id;
        }
          $filteredCountQuery = DB::table('job_order_applicants')->whereIn('id',$jobOrderApplicantIds)->whereNull('deleted_at');
        if($_primaryStatus) {
             $filteredCountQuery =  $filteredCountQuery->where('primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
             $filteredCountQuery=  $filteredCountQuery->whereIn('secondary_status',$_secondaryStatus);
        }     
        $filteredCount = $filteredCountQuery->get();
        $filteredCount=$filteredCount->count();
        return $filteredCount;
    }*/
    public function countFromJobOrderApplicantStatuses($hiringInProgressOrders, $hiringInProgressorderIds, $_primaryStatus, $_secondaryStatus, $_field, Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));

        $query = DB::table('job_order_applicant_statuses')
        ->select('job_order_applicants.*','job_order_applicant_statuses.*','job_order_applicant_statuses.created_at as applicant_created_at','job_order_applicants.creator_id as applicant_creator_id')
        ->join('job_order_applicants', 'job_order_applicants.id', '=', 'job_order_applicant_statuses.job_order_applicant_id')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at');
        if($_primaryStatus) {
            $query = $query->where('job_order_applicant_statuses.new_primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('job_order_applicant_statuses.new_secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("job_order_applicant_statuses.$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("job_order_applicant_statuses.$_field",'<=',$this->mdt($_request, 'toDate'));
                // $query = $query->whereDate("job_order_applicant_statuses.$_field",'>=', $_REQUEST['fromDate'])->whereDate("job_order_applicant_statuses.$_field",'<=',$_REQUEST['toDate']);
            } else {
                $query = $query->whereDate("job_order_applicant_statuses.$_field",'=',$today);
            }
        }
        if($_REQUEST['recruiter']) {
            $query=$query->where('job_order_applicants.creator_id',$_REQUEST['recruiter']);
        }

        $ids=array();
        $args=array();
        foreach($query->get() as $value){
            $args[] = array('job_order_applicant_id' => $value->job_order_applicant_id, 'created_date' =>date('Y-m-d',strtotime($value->applicant_created_at)).','.$value->id) ;
        }
        $tmp = array();
        foreach($args as $arg){
            $tmp[$arg['job_order_applicant_id']][] = $arg['created_date'];
        }

        $output = array();

        foreach($tmp as $applicant_id => $dateValues){  
            $output[] = array(
                'job_applicant_ids' =>$applicant_id,
                'dates' => $dateValues
            );
        }
        
        for ($x = 0; $x < count($output); $x++) {
            if($output[$x]['job_applicant_ids']){
                $i=0; 
                foreach($output[$x]['dates'] as $key=> $dates){
                      $currentArray = explode(',', $dates);
                      $nextArray=explode(',', $output[$x]['dates'][$key+1]);
                      if($nextArray[0]!=$currentArray[0] && $nextArray[0]<$currentArray[0]){
                         $ids[]=$currentArray[1];
                      }
                      /*if($nextArray[0]!=$currentArray[0] && $nextArray[0]>$currentArray[0]){
                         $ids[]=$nextArray[1];
                      }*/
                    $i++;
                }  
            }
        }
        if($ids){
            $query = $query->whereIn('job_order_applicant_statuses.id',$ids);
        }
        $query = $query->orderBY('job_order_applicant_statuses.created_at','DESC');    
        $filteredCount = $query->count();
        return $filteredCount;
    }
    /*public function countFromJobOrderApplicantStatuses($_primaryStatus, $_secondaryStatus, $_field, Request $_request) {
        $query = DB::table('job_order_applicant_statuses');
        if($_primaryStatus) {
            $query = $query->where('new_primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('new_secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("$_field",'=',$today);
            }
        }

        $jobOrderApplicantIds = [];
        $jobOrderApplicantsStatuses = $query->select('job_order_applicant_id')->distinct()->get();

        foreach($jobOrderApplicantsStatuses as $jobOrderApplicantsStatus) {
            $jobOrderApplicantIds[] = $jobOrderApplicantsStatus->job_order_applicant_id;
        }

        $filteredCountQuery = DB::table('job_order_applicants')->whereIn('id',$jobOrderApplicantIds)->whereNull('deleted_at');

        if($_REQUEST['recruiter']) {
            $allJobOrderApplicantIds = [];
            $allJobOrderIds = [];
            $filteredJobOrderIds = [];
            $allJobOrderApplicantStatus = $query->get();
            foreach ($allJobOrderApplicantStatus as $jobOrderApplicantStatus) {
                $allJobOrderApplicantIds[] = $jobOrderApplicantStatus->job_order_applicant_id;
            }
            $allJobOrderApplicants = DB::table('job_order_applicants')->whereIn('id',$allJobOrderApplicantIds)->get();
            foreach ($allJobOrderApplicants as $allJobOrderApplicant) {
                $allJobOrderIds[] =  $allJobOrderApplicant->job_order_id;
            }
            $allJobOrders = DB::table('job_orders')->where('recruiter',$_REQUEST['recruiter'])->whereIn('id',$allJobOrderIds)->get();
            foreach ($allJobOrders as $allJobOrder) {
                $filteredJobOrderIds[] = $allJobOrder->id;
            }
            $filteredCountQuery = $filteredCountQuery->whereIn('job_order_id',$filteredJobOrderIds);
        }          
        $filteredCount = $filteredCountQuery->count();
        return $filteredCount;
    }*/

   /* public function queryFromJobOrderApplicant($_primaryStatus, $_secondaryStatus, $_field,Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses', 'job_order_applicant_statuses.job_order_applicant_id', '=', 'job_order_applicants.id')
        ->select('job_order_applicants.*','job_order_applicant_statuses.*','job_order_applicants.updated_at as updated_date')
        ->groupBy('job_order_applicant_statuses.job_order_applicant_id')
        ->whereNull('job_order_applicants.deleted_at');
        if($_primaryStatus) {
            $query = $query->where('job_order_applicants.primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('job_order_applicants.secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("job_order_applicants.$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("job_order_applicants.$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("job_order_applicants.$_field",'=',$today);
            }
        }

        if($_REQUEST['recruiter']) {
            $jobOrderIds = [];
            $recruiterJobOrderIds = [];
            //$jobOrderApplicants = $query->get(); 
            $jobOrderApplicants =  $query->where('job_order_applicant_statuses.creator_id',$_REQUEST['recruiter'])->get();
            foreach ($jobOrderApplicants as $jobOrderApplicant) {
                $jobOrderIds[] = $jobOrderApplicant->job_order_id;
            }            
            $recruiterJobOrders = DB::table('job_orders')->whereIn('id',$jobOrderIds)->get();
            foreach ($recruiterJobOrders as $recruiterJobOrder) {
                $recruiterJobOrderIds[] = $recruiterJobOrder->id;
            }
            $query = $query->whereIn('job_order_id',$recruiterJobOrderIds);
        }
        return $query;
    } */
     public function queryFromJobOrderApplicant($_primaryStatus, $_secondaryStatus, $_field,Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses', 'job_order_applicant_statuses.job_order_applicant_id', '=', 'job_order_applicants.id')
        ->select('job_order_applicants.*','job_order_applicant_statuses.*','job_order_applicants.updated_at as updated_date')
        ->groupBy('job_order_applicant_statuses.job_order_applicant_id')
        ->whereNull('job_order_applicants.deleted_at');
        if($_primaryStatus) {
            $query = $query->where('job_order_applicants.primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('job_order_applicants.secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("job_order_applicants.$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("job_order_applicants.$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("job_order_applicants.$_field",'=',$today);
            }
        }

        if($_REQUEST['recruiter']) {
            $jobOrderIds = [];
            $recruiterJobOrderIds = [];
            //$jobOrderApplicants = $query->get(); 
            $jobOrderApplicants =  $query->where('job_order_applicants.creator_id',$_REQUEST['recruiter'])->get();
            foreach ($jobOrderApplicants as $jobOrderApplicant) {
                $jobOrderIds[] = $jobOrderApplicant->job_order_id;
            }            
            $recruiterJobOrders = DB::table('job_orders')->whereIn('id',$jobOrderIds)->get();
            foreach ($recruiterJobOrders as $recruiterJobOrder) {
                $recruiterJobOrderIds[] = $recruiterJobOrder->id;
            }
            $query = $query->whereIn('job_order_id',$recruiterJobOrderIds);
        }
        return $query;
    }

    /*public function queryFromJobOrderApplicantStatuses($_primaryStatus, $_secondaryStatus, $_field,Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = DB::table('job_order_applicant_statuses');
        
        if($_primaryStatus) {
            $query = $query->where('new_primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('new_secondary_status',$_secondaryStatus);
        }


        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("$_field",'=',$today);
            }
        }
        if($_REQUEST['recruiter']) {
            $query=$query->where('creator_id',$_REQUEST['recruiter']);*/
            /*$allJobOrderApplicantIds = [];
            $allJobOrderIds = [];
            $filteredJobOrderIds = [];
            $allJobOrderApplicantStatus = $query->where('creator_id',$_REQUEST['recruiter'])->get();
            foreach ($allJobOrderApplicantStatus as $jobOrderApplicantStatus) {
                $allJobOrderApplicantIds[] = $jobOrderApplicantStatus->job_order_applicant_id;
            }
            $allJobOrderApplicants = DB::table('job_order_applicants')->whereIn('id',$allJobOrderApplicantIds)->get();
            foreach ($allJobOrderApplicants as $allJobOrderApplicant) {
                $allJobOrderIds[] =  $allJobOrderApplicant->job_order_id;
            }
            $allJobOrders = DB::table('job_orders')->whereIn('id',$allJobOrderIds)->get();
            foreach ($allJobOrders as $allJobOrder) {
                $filteredJobOrderIds[] = $allJobOrder->id;
            }
            $jobOrderAppplicantQuery = $jobOrderAppplicantQuery->whereIn('job_order_id',$filteredJobOrderIds);*/
        /*}
        $jobOrderApplicantIds = [];
        $jobOrderApplicantDate = [];
        $jobOrderApplicantsStatuses = $query->distinct('job_order_applicant_id')->get();

        foreach($jobOrderApplicantsStatuses as $jobOrderApplicantsStatus) {
            $jobOrderApplicantIds[] = $jobOrderApplicantsStatus->job_order_applicant_id;
            $jobOrderApplicantDate[$jobOrderApplicantsStatus->job_order_applicant_id] = $jobOrderApplicantsStatus->$_field;
        }

        $jobOrderAppplicantQuery = DB::table('job_order_applicants')->whereIn('id',$jobOrderApplicantIds)->whereNull('deleted_at');
         if($_primaryStatus) {
            $jobOrderAppplicantQuery = $jobOrderAppplicantQuery->where('primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $jobOrderAppplicantQuery = $jobOrderAppplicantQuery->whereIn('secondary_status',$_secondaryStatus);
        }
        $detail['query'] = $jobOrderAppplicantQuery;
        $detail['jobOrderApplicantDate'] = $jobOrderApplicantDate;

        return $detail;
    }*/
    public function queryFromJobOrderApplicantStatuses($_primaryStatus, $_secondaryStatus, $_field,Request $_request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $hiringInProgressOrders = DB::table('job_orders')->whereIn('status',['Hiring In Progress','Completed','On Hold','Cancelled'])->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }
        $query = DB::table('job_order_applicant_statuses')
        ->select('job_order_applicants.*','job_order_applicant_statuses.*','job_order_applicant_statuses.created_at as applicant_created_at','job_order_applicants.creator_id as applicant_creator_id')
        ->join('job_order_applicants', 'job_order_applicants.id', '=', 'job_order_applicant_statuses.job_order_applicant_id')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at');
        if($_primaryStatus) {
            $query = $query->where('job_order_applicant_statuses.new_primary_status',$_primaryStatus);
        }
        if($_secondaryStatus){
            $query = $query->whereIn('job_order_applicant_statuses.new_secondary_status',$_secondaryStatus);
        }
        if($_field){
            if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
                $query = $query->whereDate("job_order_applicant_statuses.$_field",'>=', $this->mdt($_request, 'fromDate'))->whereDate("job_order_applicant_statuses.$_field",'<=',$this->mdt($_request, 'toDate'));
            } else {
                $query = $query->whereDate("job_order_applicant_statuses.$_field",'=',$today);
            }
        }
        if($_REQUEST['recruiter']) {
            $query=$query->where('job_order_applicants.creator_id',$_REQUEST['recruiter']);
        }

        $ids=array();
        $args=array();
        foreach($query->get() as $value){
           
            $args[] = array('job_order_applicant_id' => $value->job_order_applicant_id, 'created_date' =>date('Y-m-d',strtotime($value->applicant_created_at)).','.$value->id,'dates'=>date('Y-m-d',strtotime($value->applicant_created_at))) ;
        
        }
        $tmp = array();


        foreach($args as $arg){
                $tmp[$arg['job_order_applicant_id']][] = $arg['created_date']; 
            
        }
          $output = array();

        foreach($tmp as $applicant_id => $dateValues){
            $output[] = array(
                'job_applicant_ids' =>$applicant_id,
                'dates' =>$dateValues 
            );
        }
        for ($x = 0; $x <= count($output)-1; $x++) {
            if($output[$x]['job_applicant_ids']){
                $i=0; 
                foreach($output[$x]['dates'] as $key=> $dates){
                      $currentArray = explode(',', $dates);
                      $nextArray=explode(',', $output[$x]['dates'][$key+1]);
                      if($nextArray[0]!=$currentArray[0] && $nextArray[0]<$currentArray[0]){
                         $ids[]=$currentArray[1];
                      }
                      /*if($nextArray[0]!=$currentArray[0] && $nextArray[0]>$currentArray[0]){
                         $ids[]=$nextArray[1];
                      }*/
                    $i++;
                }  
            }
        }
        if($ids){
            $query = $query->whereIn('job_order_applicant_statuses.id',$ids);
        }
        $query = $query->orderBY('job_order_applicant_statuses.created_at','DESC');
        $detail['query'] = $query;
        return $detail;
    }

    public function testDoc() {

        $resume_filename = 'uploads\1\2018-06\Hari.docx';
        $ext = pathinfo($resume_filename, PATHINFO_EXTENSION);
        $directory = pathinfo($resume_filename, PATHINFO_DIRNAME);
        $nameWithoutExtension = pathinfo($resume_filename, PATHINFO_FILENAME);

        if($ext != 'pdf') {
            $phpWord = new \PhpOffice\PhpWord\PhpWord();            
            \PhpOffice\PhpWord\Settings::setCompatibility(true);
            \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(false);
            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
            \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');
            \PhpOffice\PhpWord\Style\Image::WRAPPING_STYLE_SQUARE;
            if($ext == "doc") {
                $phpWord = \PhpOffice\PhpWord\IOFactory::load(storage_path('app/'.$resume_filename),'MsDoc');
            } elseif($ext == "docx") {
                $phpWord = \PhpOffice\PhpWord\IOFactory::load(storage_path('app/'.$resume_filename));
            }
            $resume_filename = $directory.'/'.$nameWithoutExtension.'.pdf';
// $resume_filename = $directory.'/'.$nameWithoutExtension.'.html';
//Save it
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF', True);
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
            $objWriter->save(storage_path('app/'.$resume_filename));
        }
    }

    public function assignJobOrder(Request $request) {
        $jobOrderIds = $request->input('jobOrder_ids');
        $recruiterId = $request->input('recruiter_id');
        $data = [];
        $data['alreadyAssigned'] = [];
        $data['assignedJobOrder'] = [];
        foreach ($jobOrderIds as $jobOrderId) {
            $alreadyAssigned = \DB::table('job_orders')->where('id',$jobOrderId)->where('recruiter',$recruiterId)->first();
            if($alreadyAssigned) {
// $alreadyAssignedJos[] = $alreadyAssigned;
                $data['alreadyAssigned'][] = $alreadyAssigned;
            } else {

                \DB::table('job_orders')->where('id',$jobOrderId)->update([
                    'recruiter' => $recruiterId
                ]);
                $data['assignedJobOrder'][] = \DB::table('job_orders')->where('id',$jobOrderId)->first();
            }
        }
        return $data;
    }

    public function getStatusColour($_status) {
        switch($_status){
            case "Confirm Interview":
            $colour = "#a0eac1";
            break;
            case "Submission":
            $colour = "#e8d870";
            break;
            case "Intro Call":
            $colour = "#e89b70";
            break;
            case "Set Interview":
            $colour = "#d0b3ec";
            break;
            case "Call Back":
            $colour = "#ef3c3c";
            break;
            case "Submit":
            $colour = "#1e6b25";
            break;
            case "Get Submission Feedback":
            $colour = "#73b70e";
            break;
            case "Interview Follow-up":
            $colour = "#0d49bf";
            break; 
            case "Interview On Hold":
            $colour = "rgb(208, 127, 127)";
            break;
            case "Offer Follow-up":
            $colour = "rgba(3, 169, 244, 0.99)";
            break;
            case "Confirm Offer":
            $colour = "#eb1bf5";
            break;
            case "Confirm Offer Follow-up":
            $colour = "#585c5f";
            break;
            case "Confirm Joining":
            $colour = "#0ea972";
            break;
            case "Interview":
            $colour = "#6dc1d6";
            break;
            case "Rescheduled Interview":
            $colour = "rgb(97, 31, 8)";
            break;
            case "Job Order Re-submission":
            $colour = "#bb6993";
            break;
            case "Job Order Follow-up":
            $colour = "rgb(155, 204, 73)";
            break;
            case "Interview Feedback Rescheduled":
            $colour = "rgb(228, 161, 54)";
            break;
            case "Interview Next Round":
            $colour = "#b37700";
            break;
            case "Confirm Attendance":
            $colour = "#FFC0CB";
            break;
            default:
            $colour = "#000000";
            break;
        }
        return $colour;
    }

    public function getCandidatesQueryFromDateAndRecruiter(Request $request = null) {
        $today = date('Y-m-d', strtotime(NOW()));
        $candidateQuery = \DB::table('candidates');
        if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
            $candidateQuery=  $candidateQuery->whereDate('created_at','>=',$this->mdt($request, 'fromDate'))->whereDate('created_at','<=',$this->mdt($request, 'toDate'))->get();
            $candidates=[];
            $i = 0;
            foreach($candidateQuery as $candidateSelective) {
                $jobOrders = \DB::table('job_order_applicants')->whereNull('job_order_applicants.deleted_at')->where('candidate_id', $candidateSelective->id)->get();
                if($jobOrders->count()) {
                    foreach($jobOrders as $jobOrder){
                        $candidates[$i]['jobOrder'] = \DB::table('job_orders')->where('id', $jobOrder->job_order_id)->first();
                        $candidates[$i]['candidate'] = $candidateSelective;
                        $i++;
                    }
                }
                else{
                    $candidates[$i]['candidate'] = $candidateSelective;
                    $candidates[$i]['jobOrder'] = '';
                    $i++;
                }
            }

        }
        else {
            $candidateQuery=$candidateQuery->whereDate('created_at','=', $today)->get();
            $candidates=[];
            $i = 0;
            foreach($candidateQuery as $candidateSelective) {
                $jobOrders = \DB::table('job_order_applicants')->whereNull('job_order_applicants.deleted_at')->where('candidate_id', $candidateSelective->id)->get();
                if($jobOrders->count()) {
                    foreach($jobOrders as $jobOrder){
                        $candidates[$i]['jobOrder'] = \DB::table('job_orders')->where('id', $jobOrder->job_order_id)->first();
                        $candidates[$i]['candidate'] = $candidateSelective;
                        $i++;
                    }
                }
                else{

                    $candidates[$i]['candidate'] = $candidateSelective;
                    $candidates[$i]['jobOrder'] = '';
                    $i++;
                }
            }
        }
        if($_REQUEST['recruiter']) {
            $candidates=[];
            $i = 0;
            foreach($candidateQuery as $candidateSelective) {
                $jobOrders = \DB::table('job_order_applicants')->whereNull('job_order_applicants.deleted_at')->where('candidate_id', $candidateSelective->id)->get();
                if($jobOrders->count()) {
                    foreach($jobOrders as $jobOrder){
                        $candidates[$i]['jobOrder'] = \DB::table('job_orders')->where('id', $jobOrder->job_order_id)->where('recruiter',$_REQUEST['recruiter'])->first();
                        $candidates[$i]['candidate'] = $candidateSelective;
                        $i++;
                    }
                }
                else{
                    $candidates[$i]['candidate'] = $candidateSelective;
                    $candidates[$i]['jobOrder'] = '';
                    $i++;
                }

            }
        }
        return $candidates;

    }

    public function getJobOrderApplicantsQueryFromDateAndRecruiter(Request $request = null) {
        $today = date('Y-m-d', strtotime(NOW()));
        $query = \DB::table('job_order_applicant_statuses')
        ->join('job_order_applicants', 'job_order_applicants.id', '=', 'job_order_applicant_statuses.job_order_applicant_id')
        ->whereNull('job_order_applicants.deleted_at');

        if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
            $query = $query->whereDate('job_order_applicant_statuses.created_at','>=', $this->mdt($request, 'fromDate'))->whereDate('job_order_applicant_statuses.created_at','<=',$this->mdt($request, 'toDate'));
        } else {
            $query = $query->whereDate('job_order_applicant_statuses.created_at','=', $today);
        }

        if($_REQUEST['recruiter']) {
            $query = $query->where('job_order_applicant_statuses.creator_id',$_REQUEST['recruiter']);
        }
        return $query;
    }

    public function getJobOrderApplicantsFromQuery($_jobOrderApplicants) {
        foreach ($_jobOrderApplicants as $jobOrderApplicant) {            
            $candidate =  DB::table('candidates')->where('id',$jobOrderApplicant->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $jobOrder =  DB::table('job_orders')->where('id',$jobOrderApplicant->job_order_id)->first();
            $company = DB::table('companies')->where('id',$jobOrder->company_id)->first();
            $recruiter=DB::table('cms_users')->where('id',$jobOrder->recruiter)->where('status',USER_ACTIVE)->first();
            $jobOrderApplicant->candidateName = $candidateName;
            $jobOrderApplicant->jobOrder = $jobOrder;
            $jobOrderApplicant->companyName = $company->name;
            $jobOrderApplicant->recruiterName =  $recruiter->name;
        }
        return $_jobOrderApplicants;
    }

    public function getCandidateSubmitListFromDashboard(Request $request) {
        /*$query = $this->queryFromJobOrderApplicant(null, null,'date_submitted',$request);*/
        $query = $this->queryFromJobOrderApplicantStatuses('Submission',['Submitted to Client','Submitted to client'],'created_at',$request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants,[]);
        return view('override.details_dashboard.submitted_candidate_list',compact('jobOrderApplicants'));
    }

    public function submittedCandidateListCsvView (Request $request) {
        $filePath = public_path(). "/reports/";
        $query = $this->queryFromJobOrderApplicantStatuses('Submission',['Submitted to Client','Submitted to client'],'created_at',$request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants,[]);
        $filename = $filePath. "Candidate Submission List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Candidate Submission List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order ','Company', 'User', 'Submission Date ','Created Date','Next Action'));
        $i = 1;
        foreach($jobOrderApplicants as $jobOrderApplicant)
        {
            if($jobOrderApplicant->date_submitted) {
                $date =date('d/m/Y',strtotime($jobOrderApplicant->date_submitted));          
            } else {
                $date = ' ';
            }
            if(!empty($jobOrderApplicant->status_created_at)) {
                $updatedDate =date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $updatedDate = ' ';
            }
            if($nextAction=='Get Submission Feedback'){
               $nextAction=$jobOrderApplicant->next_action;
               $nextAction=$nextAction.' (Feedback on '.date('d/m/Y',strtotime($jobOrderApplicant->feedback_date)).')';   
            }
            else{
                $nextAction='Get Submission Feedback';
                $nextAction=$nextAction.' (Feedback on '.date('d/m/Y',strtotime($jobOrderApplicant->feedback_date)).')';
            }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName , $date,$updatedDate,$nextAction));
        }              
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Candidate Submission List.csv',$headers);
        ob_end_clean();
        return $response;
    }


    public function getCandidateInterviewListFromDashboard(Request $request) {
        /*$query = $this->queryFromJobOrderApplicantStatuses(null,null,'new_interview_date', $request);*/
        $query = $this->queryFromJobOrderApplicantStatuses('Interview',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round'],'created_at', $request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        return view('override.details_dashboard.interview_candidate_list',compact('jobOrderApplicants'));
    }

    public function getCandidateInterviewListCsvView(Request $request){ 
        $filePath = public_path(). "/reports/";                   
        $query = $this->queryFromJobOrderApplicantStatuses('Interview',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round'],'created_at', $request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        $filename = $filePath. "Interview Scheduled List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Interview Scheduled List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order ','Company', 'User', ' Scheduled Date','Created Date','Next Action'));
        $i = 1;
        foreach($jobOrderApplicants as $jobOrderApplicant)
        {
            if(!empty($jobOrderApplicant->status_created_at)) {
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
            if(!empty($jobOrderApplicant->interview_date)){
                $interviewDate = date('d/m/Y',strtotime($jobOrderApplicant->interview_date));          
            }
            else{
                $interviewDate=' ';
                if(!empty($jobOrderApplicant->new_interview_date)) {
                  $interviewDate = date('d/m/Y',strtotime($jobOrderApplicant->new_interview_date));  
               }
            }
           $nextAction=$jobOrderApplicant->next_action;
           if(!empty($jobOrderApplicant->interview_date)){
               if(!empty($jobOrderApplicant->interview_date))
               {
               $nextAction=$nextAction.' (Interview round:'.$jobOrderApplicant->interview_round.',Interview on '.date("d/m/Y h:i:s A", strtotime($jobOrderApplicant->interview_date)).')'; 
               }
           }
           else{
               $nextAction='Confirm Interview Schedule';
               if(!empty($jobOrderApplicant->new_interview_date))
               {
               $nextAction=$nextAction.' (Interview round:'.$jobOrderApplicant->interview_round.',Interview on '.date("d/m/Y h:i:s A", strtotime($jobOrderApplicant->new_interview_date)).')'; 
               }
           }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName , $interviewDate,$date,$nextAction));
        }              
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Interview Scheduled List.csv',$headers);
        ob_end_clean();
        return $response;
    }       

    public function getCandidateOfferListFromDashboard(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses('Offer',['Offer Made'],'created_at', $request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        return view('override.details_dashboard.offered_candidate_list',compact('jobOrderApplicants'));
    }

    public function getCandidateofferListCsvView(Request $request){
        $filePath = public_path(). "/reports/";    
        $query = $this->queryFromJobOrderApplicantStatuses('Offer',['Offer Made'],'created_at', $request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        $filename = $filePath. "Offer Made List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Offer Made List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order','Company', 'User', ' Offered Date','Created Date','Next Action'));
        $i = 1;

        foreach($jobOrderApplicants as $jobOrderApplicant) {
            if(!empty($jobOrderApplicant->status_created_at)) {
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
            if(!empty($jobOrderApplicant->offer_confirmation_date)) {
               $nextAction=$jobOrderApplicant->next_action;
               $_date=date('d/m/Y',strtotime($jobOrderApplicant->offer_confirmation_date)); 
               $nextAction=$nextAction.' (Confirm on '.$_date.')' ;  
            }
            else{
               $nextAction='Confirm Offer';
               $_date=date('d/m/Y',strtotime($jobOrderApplicant->new_offer_confirmation_date)); 
               $nextAction=$nextAction.' (Confirm on '.$_date.')' ;
            }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName,
             $date,$_date,$nextAction));
        }              
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );

        $response = Response::download($filename,'Offer Made List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getCandidateRejectedListFromDashboard(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses(null,['Rejected by the Client','Rejected by the client'],'created_at',$request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        return view('override.details_dashboard.rejected_candidate_list',compact('jobOrderApplicants'));
    }
    public function getCandidateRejectedListCsvView(Request $request) {        
        $filePath = public_path(). "/reports/";
        $query = $this->queryFromJobOrderApplicantStatuses(null,['Rejected by the Client','Rejected by the client'],'created_at',$request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        $filename = $filePath. "Rejected Candidate List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Rejected Candidate List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order','Company','User',' Rejected Date','Next Action'));
        $i = 1;

        foreach($jobOrderApplicants as $jobOrderApplicant) {
            if($jobOrderApplicant->status_created_at) {
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName ,$date,'-'));
        }              
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Rejected Candidate List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getCandidateInterviewDoneListFromDashboard(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses('Interview',['Interview Done'],'created_at',$request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        return view('override.details_dashboard.interview_done_candidate_list',compact('jobOrderApplicants'));
    }


    public function getCandidateInterviewDoneListCsvView(Request $request){
        $filePath = public_path(). "/reports/";    
        $query = $this->queryFromJobOrderApplicantStatuses('Interview',['Interview Done'],'created_at',$request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        $filename = $filePath. "Interview Done List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Interview Done List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order ','Company','User',' Created Date','Next Action'));
        $i = 1;
        foreach($jobOrderApplicants as $jobOrderApplicant) {
            if(!empty($jobOrderApplicant->status_created_at)) {
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
           if($jobOrderApplicant->next_action=='Get Interview Feedback'&& $jobOrderApplicant->secondary_status=='Interview Done'){
             $nextAction=$jobOrderApplicant->next_action;
             $nextAction= $nextAction.' (Follow up on '.date("d/m/Y", strtotime($jobOrderApplicant->interview_followup_date)).')';   
           } 
           else{
                $nextAction='Get Interview Feedback';
                $nextAction= $nextAction.' (Follow up on '.date("d/m/Y", strtotime($jobOrderApplicant->new_interview_followup_date)).')';
           }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName , $date,$nextAction));
        }              
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );

        $response = Response::download($filename,'Interview Done List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getCandidateJoiningListFromDashboard(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses(null,['Offer Accepted','Joining Extended'],'created_at',$request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        return view('override.details_dashboard.joining_candidate_list',compact('jobOrderApplicants'));
    }

    public function getCandidateJoiningListCsvView(Request $request){
        $filePath = public_path(). "/reports/";
        $query = $this->queryFromJobOrderApplicantStatuses(null,['Offer Accepted','Joining Extended'],'created_at',$request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        $filename = $filePath. "Joining Candidate List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Joining Candidate List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order ','Company','User',' Joining Date','Created Date','Next Action'));
        $i = 1;
        foreach($jobOrderApplicants as $jobOrderApplicant) {
            if(!empty($jobOrderApplicant->status_created_at)){
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
            if(!empty($jobOrderApplicant->joining_date)) {
                 $nextAction=$jobOrderApplicant->next_action;
                 $joiningDate = date('d/m/Y',strtotime($jobOrderApplicant->joining_date));
                 $nextAction=$nextAction.' (Joining on '. $joiningDate.')';          
            }
            else{
                $nextAction='Confirm Joining';
                $joiningDate = date('d/m/Y',strtotime($jobOrderApplicant->new_joining_date));
                $nextAction=$nextAction.' (Joining on '. $joiningDate.')';

            }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName,$joiningDate,$date,$nextAction));
        }              
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Joining Candidate List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getCandidateBackoutListFromDashboard(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses('Place',["Backed Out"] ,'created_at',$request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);        
        return view('override.details_dashboard.backout_candidate_list',compact('jobOrderApplicants'));
    }

    public function getCandidateBackoutListCsvView(Request $request) {
        $filePath = public_path(). "/reports/";    
        $query = $this->queryFromJobOrderApplicantStatuses('Place',["Backed Out"] ,'created_at',$request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']); 
        $filename = $filePath. "Backout Candidate List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Backout Candidate List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order ','Company', 'User', 'Backout Date','Next Action'));
        $i = 1;
        foreach($jobOrderApplicants as $jobOrderApplicant) {
           if($jobOrderApplicant->status_created_at) {
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName,$date,'-'));
        }            
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );

        $response = Response::download($filename,'Backout Candidate List.csv',$headers);
        ob_end_clean();
        return $response;
    }


    public function getCandidateInterviewBackoutListFromDashboard(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses('Interview',["Backed Out"] ,'created_at', $request);
        $jobOrderApplicants = $query['query']->paginate(20);
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        return view('override.details_dashboard.interview_backout_candidate_list',compact('jobOrderApplicants'));
    }


    public function getCandidateInterviewBackoutListCsvView(Request $request){
        $query = $this->queryFromJobOrderApplicantStatuses('Interview',["Backed Out"] ,'created_at', $request);
        $jobOrderApplicants = $query['query']->get();
        $jobOrderApplicants = $this->createJobOrderApplicantObject($jobOrderApplicants, $query['jobOrderApplicantDate']);
        $filePath = public_path(). "/reports/";  
        $filename = $filePath."Interview Backout List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Interview Backout List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name','Job Order ','Company','User',' Interview Backout Date','Next Action'));
        $i = 1;
        foreach($jobOrderApplicants as $jobOrderApplicant) {
            $jobOrderApplicant->addedDate=DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$jobOrderApplicant->job_order_applicant_id)->first()->created_at;
            if($jobOrderApplicant->status_created_at) {
                $date = date('d/m/Y',strtotime($jobOrderApplicant->status_created_at));          
            } else {
                $date = ' ';
            }
            fputcsv($handle, array($i++,$jobOrderApplicant->candidateName,$jobOrderApplicant->jobOrder->title,$jobOrderApplicant->companyName,$jobOrderApplicant->recruiterName,$date,'-'));
        }              
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );

        $response = Response::download($filename,'Interview Backout List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    /*public function getCandidateListFromDashboard(Request $request) {
        $candidates = $this->getCandidatesQueryFromDateAndRecruiter($request);
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $candidateCollection = collect($candidates);
        foreach($candidateCollection as $candidate){
            $candidate['candidate']->companyName = DB::table('companies')->find($candidate['jobOrder']->company_id)->name;
            $candidate['candidate']->recruiterName = DB::table('cms_users')->find($candidate['jobOrder']->recruiter)->name;
            $candidate['candidate']->addedAt = DB::table('job_order_applicants')->where('candidate_id',$candidate['candidate']->id)->where('job_order_id',$candidate['jobOrder']->id)->first()->created_at;
            $candidate['candidate']->currentStatus = DB::table('job_order_applicants')->where('candidate_id',$candidate['candidate']->id)->where('job_order_id',$candidate['jobOrder']->id)->first()->secondary_status;
        }

        // Define how many items we want to be visible in each page
        $perPage = 20;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $candidateCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedCandidates= new LengthAwarePaginator($currentPageItems , count($candidateCollection), $perPage);

        // set url path for generted links
        $paginatedCandidates->setPath($request->url());

        // return view('items_view', ['items' => $paginatedCandidates]);
        return view('override.details_dashboard.candidate_list',['candidates'=> $paginatedCandidates,'candidatesCount'=>count($candidates)]);
    }

    public function candidateListCsvView (Request $request) {
        // dd(public_path());
        $filePath = public_path(). "/reports/";
        $candidates = $this->getCandidatesQueryFromDateAndRecruiter($request);
        // $candidates = $candidateQuery->orderBy('job_order_applicants.id','desc')->get();
        $filename = $filePath. "Candidate Added List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Candidate Added List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name', ' Recruiter ', 'Company',' Job Order','Candidates Added Date','Current Status '));
        $i = 1;

        foreach($candidates as $candidate){
            $candidate['candidate']->companyName = DB::table('companies')->find($candidate['jobOrder']->company_id)->name;
            $candidate['candidate']->recruiterName = DB::table('cms_users')->find($candidate['jobOrder']->recruiter)->name;
            $candidate['candidate']->currentStatus = DB::table('job_order_applicants')->where('candidate_id',$candidate['candidate']->id)->where('job_order_id',$candidate['jobOrder']->id)->first()->secondary_status;
            
            $date = DB::table('job_order_applicants')->where('candidate_id',$candidate['candidate']->id)->where('job_order_id',$candidate['jobOrder']->id)->first()->created_at;
            
            if($date) {
                $date = date('d/m/Y',strtotime($date));
            } else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$candidate['candidate']->first_name.''.$candidate['candidate']->last_name, $candidate['candidate']->recruiterName, $candidate['candidate']->companyName,$candidate['jobOrder']->title,$date,$candidate['candidate']->currentStatus));
        }
        fclose($handle);

         $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'candidate_added_list.csv',$headers);
        ob_end_clean();
        return $response;
    }*/  

    public function getCandidateListFromDashboard(Request $request) {
        $today = date('Y-m-d', strtotime(NOW()));
        $candidateQuery = DB::table('candidates');
        if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
            $candidateQuery = $candidateQuery->whereDate('created_at','>=',$this->mdt($request, 'fromDate'))->whereDate('created_at','<=',$this->mdt($request, 'toDate'));
        } else {
            $candidateQuery =  $candidateQuery->whereDate('created_at','=', $today);

        }

        if($_REQUEST['recruiter']) {
            $candidateQuery = $candidateQuery->where('creator_id',$_REQUEST['recruiter']);
        }
        $candidatesCount=$candidateQuery->count();
        $candidatesAdded= $candidateQuery->paginate(20);

        // return view('items_view', ['items' => $paginatedCandidates]);
        return view('override.details_dashboard.candidate_list',['candidates'=> $candidatesAdded,'candidatesCount'=>$candidatesCount]);
    }

    public function candidateListCsvView (Request $request) {
        // dd(public_path());
        $today = date('Y-m-d', strtotime(NOW()));
        $filePath = public_path(). "/reports/";
        $candidate= DB::table('candidates');
        if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
            $candidate= $candidate->whereDate('created_at','>=',$this->mdt($request, 'fromDate'))->whereDate('created_at','<=',$this->mdt($request, 'toDate'));
        } else {
            $candidate =  $candidate->whereDate('created_at','=', $today);

        }

        if($_REQUEST['recruiter']) {
            $candidate = $candidate->where('creator_id',$_REQUEST['recruiter']);
        }
        $candidates= $candidate->get();
        $filename = $filePath. "Candidate Added List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Candidate Added List'));
        fputcsv($handle, array('Sl No.', 'Candidate Name', ' Email ', 'Contact Number',' Created By','Candidates Added Date'));
        $i = 1;
        foreach($candidates as $candidate){
            $candidate->recruiterName = DB::table('cms_users')->find($candidate->creator_id)->name;
            $date = date('d/m/Y',strtotime($candidate->created_at));
            $email="\t".$candidate->primary_email;
            $mobile_no="\t".$candidate->primary_phone;
            fputcsv($handle,array($i++,$candidate->first_name.' '.$candidate->last_name,$email,$mobile_no, $candidate->recruiterName,$date));
        }
        fclose($handle);

        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'candidate_added_list.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderListFromDashboard() {
        $jobOrders =   DB::table('job_orders')->where('status','Hiring In Progress')->orderBy('updated_at','desc');
        /*$owners=DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        $recruiters=DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        $companies=DB::table('companies')->get();
        if($_REQUEST['owner']) {
          $jobOrders =$jobOrders->where('owner',$_REQUEST['owner']);
        }
        if($_REQUEST['recruiter']) {
          $jobOrders =$jobOrders->where('recruiter',$_REQUEST['recruiter']);
        }
        if($_REQUEST['company']) {
          $jobOrders =$jobOrders->where('company_id',$_REQUEST['company']);
        }
        if($_REQUEST['date']) {
          $var= str_replace('/', '-', $_REQUEST['date']);
          $date=date('Y-m-d', strtotime($var));
          $jobOrders =$jobOrders->where('submission_date',$date);
        }*/
        //$jobOrders =$jobOrders->paginate(20);
        $jobOrders =$jobOrders->get();
        foreach($jobOrders  as $jobOrder)
        {
            $jobOrder->companyName = DB::table('companies')->find($jobOrder->company_id)->name; 
            $jobOrder->companyId = DB::table('companies')->find($jobOrder->company_id)->id;
            $jobOrder->recruiterName = DB::table('cms_users')->find($jobOrder->recruiter)->name;
            $jobOrder->ownerName = DB::table('cms_users')->find($jobOrder->owner)->name;
        }
        return view('override.details_dashboard.job_order_list',['jobOrders' =>$jobOrders,'owners'=>$owners,'recruiters'=>$recruiters,'companies'=>$companies]);
    }

    public function jobOrderListCsvView (Request $_request) {
        $filePath = public_path(). "/reports/";
        $jobOrders =   DB::table('job_orders')->where('status','Hiring In Progress')->orderBy('updated_at','desc');
        if($_request->input('owner')) {
          $jobOrders =$jobOrders->where('owner',$_request->input('owner'));
        }
        if($_request->input('recruiter')) {
          $jobOrders =$jobOrders->where('recruiter',$_request->input('recruiter'));
        }
        if($_request->input('company')) {
          $jobOrders =$jobOrders->where('company_id',$_request->input('company'));
        }
        if($_request->input('date')) {
          $var= str_replace('/', '-',$_request->input('date'));
          $date=date('Y-m-d', strtotime($var));
          $jobOrders =$jobOrders->where('submission_date',$date);
        }
        $jobOrders =$jobOrders->get();
        $filename = $filePath. "Job Order List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Company','Owner','Recruiter','Submission Date ','Current Status'));
        $i = 1;
        foreach($jobOrders  as $jobOrder)
        {
            $jobOrder->companyName = DB::table('companies')->find($jobOrder->company_id)->name;
            $jobOrder->recruiterName = DB::table('cms_users')->find($jobOrder->recruiter)->name;
            $jobOrder->ownerName = DB::table('cms_users')->find($jobOrder->owner)->name;
            if($jobOrder->submission_date) {
                $date =date('d/m/Y',strtotime($jobOrder->submission_date));          
            } else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$jobOrder->title,$jobOrder->companyName,$jobOrder->ownerName,$jobOrder->recruiterName,$date,$jobOrder->status));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderInterviewScheduledListFromDashboard() {
        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }
        /*$owners=DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        $companies=DB::table('companies')->get();*/
        $interviewSchedules= DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_order_applicants.id as applicant_id','job_orders.title as title','job_order_applicant_statuses.creator_id','job_orders.openings_available as opening_count')
        ->where('job_order_applicants.primary_status','Interview')
        ->whereIn('job_order_applicants.secondary_status',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round','Interview in Progress'])
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at');
       /* if($_REQUEST['owner']) {
          $interviewSchedules =$interviewSchedules->where('job_order_applicant_statuses.creator_id',$_REQUEST['owner']);
        }
        if($_REQUEST['company']) {
          $interviewSchedules =$interviewSchedules->where('company_id',$_REQUEST['company']);
        }
        if($_REQUEST['date']) {
          $var= str_replace('/', '-', $_REQUEST['date']);
          $date=date('Y-m-d', strtotime($var));
          $interviewSchedules =$interviewSchedules->whereDate('interview_date',$date);
        }*/
        //$interviewSchedules=$interviewSchedules->paginate(20);
        $interviewSchedules=$interviewSchedules->get();
        foreach($interviewSchedules  as $interviewSchedule)
        {
            $interviewSchedule->companyId = DB::table('companies')->find($interviewSchedule->company_id)->id;
            $interviewSchedule->companyName = DB::table('companies')->find($interviewSchedule->company_id)->name;
            $creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $interviewSchedule->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;
            $interviewSchedule->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$interviewSchedule->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $candidatePhone = $candidate->primary_phone;
            $interviewSchedule->candidateName=$candidateName;
            if(!empty($candidatePhone)){
               $interviewSchedule->candidatePhone=$candidatePhone;    
            }
            else{
               $interviewSchedule->candidatePhone='--';
            }
            if($interviewSchedule->opening_count<='0'){
                $interviewSchedule->opening_status='disabled';
            }
            else{

                $interviewSchedule->opening_status=' ';
            }
           
        }
        return view('override.details_dashboard.job_order_interview_scheduled_list',['interviewSchedules' =>$interviewSchedules,'owners'=>$owners,'companies'=>$companies]);
    }

    public function jobOrderInterviewScheduledListCsvView (Request $_request) {
        
        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }

        $filePath = public_path(). "/reports/";
        $interviewSchedules= DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_order_applicants.id as applicant_id','job_orders.title as title','job_order_applicant_statuses.creator_id')
        ->where('job_order_applicants.primary_status','Interview')
        ->whereIn('job_order_applicants.secondary_status',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round'])
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at');
        if($_request->input('owner')) {
          $interviewSchedules =$interviewSchedules->where('job_order_applicant_statuses.creator_id',$_request->input('owner'));
        }
        if($_request->input('company')) {
          $interviewSchedules =$interviewSchedules->where('company_id',$_request->input('company'));
        }
        if($_request->input('date')) {
          $var= str_replace('/', '-', $_request->input('date'));
          $date=date('Y-m-d', strtotime($var));
          $interviewSchedules =$interviewSchedules->whereDate('interview_date',$date);
        }
        $interviewSchedules=$interviewSchedules->get();

        $filename = $filePath. "Job Order Interview Scheduled List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Interview Scheduled List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Candidate Name','Contact Number','Company','Owner', 'Interview Scheduled Date ','Current Status'));
        $i = 1;
        foreach($interviewSchedules  as $interviewSchedule)
        {
            $interviewSchedule->companyName = DB::table('companies')->find($interviewSchedule->company_id)->name;
            $creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $interviewSchedule->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;
            $interviewSchedule->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$interviewSchedule->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $candidatePhone = $candidate->primary_phone;
            $interviewSchedule->candidateName=$candidateName;
            if(!empty($candidatePhone)){
               $interviewSchedule->candidatePhone=$candidatePhone;    
            }
            else{
               $interviewSchedule->candidatePhone='--';
            }
            if($interviewSchedule->interview_date) {
                $date =date('d/m/Y',strtotime($interviewSchedule->interview_date));          
            } else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$interviewSchedule->title,$interviewSchedule->candidateName,$interviewSchedule->candidatePhone,$interviewSchedule->companyName,$interviewSchedule->recruiterName,$date,$interviewSchedule->secondary_status));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order Interview Scheduled List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderSubmittedListFromDashboard() {
        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }
        $submits= DB::table('job_order_applicants')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id') 
        ->whereIn('job_order_applicants.secondary_status',['Submitted to Client','Submitted to client','Reschedule Submission'])
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_order_applicants.id as applicant_id','job_orders.title as title','job_orders.openings_available as opening_count');
        $submits =  $submits->get();
        /*->paginate(20);*/
        
        // $idArray = [];
        foreach($submits as $submit)
        {
            // $idArray[] = $submit->id;
            // $submit->jobOrderFollowupDate=DB::table('job_order_submission_history')->where('job_order_id',$submit->job_order_id)->where('active','1')->where('submission_status','Job Order Follow-up')->first()->date;
            // $submit->jobOrderResubmissionDate=DB::table('job_order_submission_history')->where('job_order_id',$submit->job_order_id)->where('active','1')->where('submission_status','Job Order Re-submission')->first()->date;
            $submit->jobOrderFollowupDate=DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$submit->id)->whereIn('new_secondary_status',['Submitted to Client','Submitted to client','Reschedule Submission'])->orderBy('id', 'desc')->first()->new_feedback_date;
            $submit->jobOrderScheduledFollowupDate=DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$submit->id)->whereIn('new_secondary_status',['Submitted to Client','Submitted to client','Reschedule Submission'])->orderBy('id', 'desc')->first()->new_scheduled_feedback_date;
            $submit->companyId = DB::table('companies')->find($submit->company_id)->id;
            $submit->companyName = DB::table('companies')->find($submit->company_id)->name;
            /*$creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $submit->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
            $creator_id = DB::table('job_order_applicants')
                ->where('id', $submit->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;
            $submit->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$submit->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $submit->candidateName=$candidateName;
            if($submit->opening_count<='0'){
                $submit->opening_status='disabled';
            }
            else{
                $submit->opening_status=' ';
            }
        }

        return view('override.details_dashboard.job_order_submitted_list',compact('submits'));
    }

    public function jobOrderSubmittedListCsvView () {
        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }

        $filePath = public_path(). "/reports/";
        $submits= DB::table('job_order_applicants')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id') 
        ->whereIn('job_order_applicants.secondary_status',['Submitted to Client','Reschedule Submission'])
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_order_applicants.id as applicant_id','job_orders.title as title')
        ->get();

        $filename = $filePath. "Job Order Submitted List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Submitted List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Candidate Name','Company','Owner','Submitted Date ','Followup Date','Current Status'));
        $i = 1;
        foreach($submits as $submit)
        {
           /* $submit->jobOrderFollowupDate=DB::table('job_order_submission_history')->where('job_order_id',$submit->job_order_id)->where('active','1')->where('submission_status','Job Order Follow-up')->first()->date;*/
            $submit->jobOrderFollowupDate=DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$submit->id)->whereIn('new_secondary_status',['Submitted to Client','Submitted to client','Reschedule Submission'])->orderBy('id', 'desc')->first()->new_feedback_date;
            /*$submit->jobOrderResubmissionDate=DB::table('job_order_submission_history')->where('job_order_id',$submit->job_order_id)->where('active','1')->where('submission_status','Job Order Re-submission')->first()->date;*/
            $submit->companyName = DB::table('companies')->find($submit->company_id)->name;
            /*$creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $submit->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
            $creator_id = DB::table('job_order_applicants')
                ->where('id', $submit->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;
            $submit->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$submit->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $submit->candidateName=$candidateName;
            if($submit->date_submitted) {
                $date =date('d/m/Y',strtotime($submit->date_submitted));          
            } else {
                $date = '--';
            }
            if($submit->jobOrderFollowupDate) {
                $fdate =date('d/m/Y',strtotime($submit->jobOrderFollowupDate));          
            } else {
                $fdate = '--';
            }
            if($submit->jobOrderResubmissionDate) {
                $redate =date('d/m/Y',strtotime($submit->jobOrderResubmissionDate));          
            } else {
                $redate = '--';
            }
            fputcsv($handle, array($i++,$submit->title,$submit->candidateName,$submit->companyName,$submit->recruiterName,$date,$fdate,$submit->secondary_status));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order Submitted List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderInterviewFeedbackListFromDashboard() {
        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }
        $owners=DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        $companies=DB::table('companies')->get();
        $feedbacks= DB::table('job_order_applicants')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_orders.title as title','job_orders.openings_available as opening_count','job_order_applicants.id as applicant_id','job_order_applicant_statuses.creator_id','job_orders.id as joborder_id')
        ->where('job_order_applicants.next_action','Get Interview Feedback')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at');
        //  if($_REQUEST['owner']) {
        //   $feedbacks =$feedbacks->where('job_order_applicant_statuses.creator_id',$_REQUEST['owner']);
        // }
        // if($_REQUEST['company']) {
        //   $feedbacks =$feedbacks->where('company_id',$_REQUEST['company']);
        // }
        // if($_REQUEST['date']) {
        //   $var= str_replace('/', '-', $_REQUEST['date']);
        //   $date=date('Y-m-d', strtotime($var));
        //   $feedbacks =$feedbacks->where('interview_followup_date',$date);
        //   $feedbacks =$feedbacks->orwhere('interview_reschedule_date',$date);
        // }
        //$feedbacks=$feedbacks->paginate(20);
        $feedbacks=$feedbacks->get();
        // $idArray = [];
        foreach($feedbacks as $feedback)
        {
            // $idArray[] = $feedback->id;
            $feedback->companyId = DB::table('companies')->find($feedback->company_id)->id;
            $feedback->companyName = DB::table('companies')->find($feedback->company_id)->name;
            /*$creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $feedback->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
            $creator_id = DB::table('job_order_applicants')
                ->where('id', $feedback->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;
            $feedback->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate=  DB::table('candidates')->where('id',$feedback->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $feedback->candidateName=$candidateName;
            if($feedback->opening_count<='0'){
                $feedback->opening_status='disabled';
            }
            else{
                $feedback->opening_status=' ';
            }
        }

        return view('override.details_dashboard.job_order_interview_feedback_list',['feedbacks' =>$feedbacks
            ,'owners'=>$owners,'companies'=>$companies]);
    }

    public function jobOrderInterviewFeedbackListCsvView (Request $_request) {
        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }

        $filePath = public_path(). "/reports/";
        $feedbacks= DB::table('job_order_applicants')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_orders.title as title','job_order_applicants.id as applicant_id','job_order_applicant_statuses.creator_id')
        ->where('job_order_applicants.next_action','Get Interview Feedback')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->whereNull('job_order_applicants.deleted_at');
        if($_request->input('owner')) {
          $feedbacks =$feedbacks->where('job_order_applicant_statuses.creator_id',$_request->input('owner'));
        }
        if($_request->input('company')) {
          $feedbacks =$feedbacks->where('company_id',$_request->input('company'));
        }
        if($_request->input('date')) {
          $var= str_replace('/', '-', $_request->input('date'));
          $date=date('Y-m-d', strtotime($var));
          $feedbacks =$feedbacks->where('interview_followup_date',$date);
          $feedbacks =$feedbacks->orwhere('interview_reschedule_date',$date);
        }
        $feedbacks =$feedbacks->get();
        $filename = $filePath. "Job Order Interview Feedback List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Interview Feedback List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Candidate Name', 'Company', 'Owner','Interview Feedback/Rescheduled Date ','Next Action'));
        $i = 1;
        foreach($feedbacks as $feedback)
        {
            $feedback->companyName = DB::table('companies')->find($feedback->company_id)->name;
           /* $creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $feedback->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
             $creator_id = DB::table('job_order_applicants')
                ->where('id', $feedback->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;
            $feedback->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$feedback->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $feedback->candidateName=$candidateName;
            if($feedback->interview_followup_date) {
                $date =date('d/m/Y',strtotime($feedback->interview_followup_date));          
            }
            elseif($feedback->interview_reschedule_date){
                $date =date('d/m/Y',strtotime($feedback->interview_reschedule_date));
            }
            else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$feedback->title,$feedback->candidateName,$feedback->companyName,$feedback->recruiterName,$date,$feedback->next_action));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order Interview Feedback List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderOfferedListFromDashboard() { 

        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }       
        $offers= DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->where('job_order_applicant_statuses.new_primary_status','Offer')
        ->whereNull('job_order_applicants.deleted_at')
        ->where('job_order_applicant_statuses.new_secondary_status','Offer Made')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->Groupby('job_order_applicants.id')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->select('job_order_applicants.*','job_orders.*','job_order_applicant_statuses.*','job_order_applicants.id as applicant_id','job_orders.openings_available as opening_count');
        $offers=$offers->get();
       // ->paginate(20);
        foreach($offers  as $offer)
        {
            $offer->companyId = DB::table('companies')->find($offer->company_id)->id;
            $offer->companyName = DB::table('companies')->find($offer->company_id)->name;
          /*  $creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $offer->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
            $creator_id = DB::table('job_order_applicants')
                         ->where('id', $offer->applicant_id)
                         ->orderBy('id', 'desc')
                         ->first()->creator_id;
            $offer->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$offer->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $offer->candidateName=$candidateName;
            if($offer->opening_count<='0'){
                $offer->opening_status='disabled';
            }
            else{
                $offer->opening_status=' ';
            }
        }
        return view('override.details_dashboard.job_order_offered_list',compact('offers'));
    }

    public function jobOrderOfferedListCsvView () {
        $filePath = public_path(). "/reports/";
        $offers= DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        ->where('job_order_applicant_statuses.new_primary_status','Offer')
        ->where('job_order_applicant_statuses.new_secondary_status','Offer Made')
        ->whereNull('job_order_applicants.deleted_at')
        ->Groupby('job_order_applicants.id')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->select('job_order_applicants.*','job_orders.*','job_order_applicant_statuses.*','job_order_applicants.id as applicant_id')

        ->get();
        $filename = $filePath. "Job Order Offered List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Offered List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Candidate Name','Company', 'Owner','Offered Date ','Current Status'));
        $i = 1;
        foreach($offers  as $offer)
        {
            $offer->companyName = DB::table('companies')->find($offer->company_id)->name;
            /*$creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $offer->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
             $creator_id = DB::table('job_order_applicants')
                         ->where('id', $offer->applicant_id)
                         ->orderBy('id', 'desc')
                         ->first()->creator_id;
            $offer->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$offer->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $offer->candidateName=$candidateName;
            if($offer->new_offer_confirmation_date) {
                $date =date('d/m/Y',strtotime($offer->new_offer_confirmation_date));          
            } else {
                $date = ' ';
            }
            fputcsv($handle, array($i++,$offer->title,$offer->candidateName,$offer->companyName,$offer->recruiterName,$date,$offer->new_secondary_status));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order Offered List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderJoiningListFromDashboard() {

        $hiringInProgressOrders = DB::table('job_orders')->where('status','Hiring In Progress')->get();
        $hiringInProgressorderIds = [];

        foreach ($hiringInProgressOrders as $hiringInProgressOrder) {
            $hiringInProgressorderIds[] = $hiringInProgressOrder->id;
        }     
        $today = date('Y-m-d', strtotime(NOW()));        
        $joins= DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        // ->where('job_order_applicants.primary_status','Place')
        // ->where('job_order_applicants.secondary_status','Joined')
        ->where('job_order_applicants.joining_date' ,'>=', $today)
        ->whereNull('job_order_applicants.deleted_at')
        ->whereIn('job_order_applicants.job_order_id',$hiringInProgressorderIds)
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.*','job_order_applicant_statuses.*','job_order_applicants.id as applicant_id','job_orders.openings_available as opening_count');
        $joins= $joins->get();
        //->paginate(20);
        foreach($joins  as $join)
        {
            $join->companyId = DB::table('companies')->find($join->company_id)->id;
            $join->companyName = DB::table('companies')->find($join->company_id)->name;
            /*$creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $join->applicant_id)
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
            $creator_id = DB::table('job_order_applicants')
                         ->where('id', $join->applicant_id)
                         ->orderBy('id', 'desc')
                         ->first()->creator_id;
            $join->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$join->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $join->candidateName=$candidateName;
            if($join->opening_count<='0'){
                $join->opening_status='disabled';
            }
            else{
                $join->opening_status=' ';
            }
        }
        return view('override.details_dashboard.job_order_joining_list',compact('joins'));
    }

    public function jobOrderJoiningListCsvView () {
        $today = date('Y-m-d', strtotime(NOW()));
        $filePath = public_path(). "/reports/";
        $joins= DB::table('job_order_applicants')
        ->join('job_order_applicant_statuses','job_order_applicant_statuses.job_order_applicant_id','=','job_order_applicants.id')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
        // ->where('job_order_applicants.primary_status','Place')
        // ->where('job_order_applicants.secondary_status','Joined')
        ->where('job_order_applicants.joining_date' ,'>=', $today)
        ->whereNull('job_order_applicants.deleted_at')
        ->groupBy('job_order_applicants.id')
        ->select('job_order_applicants.*','job_orders.*','job_order_applicant_statuses.*','job_order_applicants.id as applicant_id')
        ->get();
        $filename = $filePath. "Job Order Joining List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Joining List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Candidate Name','Company','Owner','Joining Date ','Current Status'));
        $i = 1;
        foreach($joins as $join)
        {
            $join->companyName = DB::table('companies')->find($join->company_id)->name;
            // $creator_id = DB::table('job_order_applicant_statuses')
            //     ->where('job_order_applicant_id', $join->applicant_id)
            //     ->orderBy('id', 'desc')
            //     ->first()->creator_id;
            $creator_id = DB::table('job_order_applicants')
                         ->where('id', $join->applicant_id)
                         ->orderBy('id', 'desc')
                         ->first()->creator_id;
            $join->recruiterName = DB::table('cms_users')->find($creator_id)->name;
            $candidate =  DB::table('candidates')->where('id',$join->candidate_id)->first();
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $join->candidateName=$candidateName;
            if($join->joining_date) {
                $date =date('d/m/Y',strtotime($join->joining_date));          
            } else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$join->title,$join->candidateName,$join->companyName,$join->recruiterName,$date,$join->secondary_status));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Scheduled Joining List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderIntrocallListFromDashboard() {
        $jobOrders =   DB::table('job_orders')->whereNotNull('intro_call_date')->whereNull('submission_date')->orderBy('updated_at','desc')->where('status', 'like', 'Intro Call Scheduled');
         $jobOrders= $jobOrders->get();
        //->paginate(20);
        foreach($jobOrders  as $jobOrder)
        {
            $jobOrder->companyId = DB::table('companies')->find($jobOrder->company_id)->id;
            $jobOrder->companyName = DB::table('companies')->find($jobOrder->company_id)->name;
            $jobOrder->recruiterName = DB::table('cms_users')->find($jobOrder->owner)->name;
        }
        return view('override.details_dashboard.job_order_introcall_list',compact('jobOrders'));
    }

    public function jobOrderIntrocallListCsvView () {
        $filePath = public_path(). "/reports/";
        $jobOrders =   DB::table('job_orders')->whereNotNull('intro_call_date')->whereNull('submission_date')->orderBy('updated_at','desc')->get();
        $filename = $filePath. "Job Order Introcall Scheduled List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Introcall Scheduled List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Company','Owner','Introcall Scheduled Date','Current Status'));
        $i = 1;
        foreach($jobOrders  as $jobOrder)
        {
            $jobOrder->companyName = DB::table('companies')->find($jobOrder->company_id)->name;
            $jobOrder->recruiterName = DB::table('cms_users')->find($jobOrder->owner)->name;
            if($jobOrder->intro_call_date) {
                $date =date('d/m/Y',strtotime($jobOrder->intro_call_date));          
            } else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$jobOrder->title,$jobOrder->companyName,$jobOrder->recruiterName ,$date,$jobOrder->status));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order Introcall Scheduled List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getJobOrderScheduledSubmissionListFromDashboard(Request $request) {
        
        $today = date('Y-m-d', strtotime(NOW()));
        $jobOrders =DB::table('job_orders')
                    ->join('job_order_submission_history', 'job_orders.id', '=', 'job_order_submission_history.job_order_id')
                    ->where('job_order_submission_history.active',1)
                    ->where('job_orders.status','Hiring In Progress')
                    ->where('job_order_submission_history.date','>=',$today)
                    ->orderBy('job_orders.updated_at','desc');
        $jobOrders=$jobOrders->get();
       /* $jobOrdersClone=Clone $jobOrders;
        if($_REQUEST['date'])
        {
        $date= str_replace('/', '-', $_REQUEST['date']);
        $filter_date=date('Y-m-d',strtotime($date));
        $jobOrders=$jobOrdersClone
                       ->where('job_order_submission_history.date','=',$filter_date)
                        ->orderBy('job_orders.updated_at','desc');
        $jobOrders=$jobOrders->get();
                        //->paginate(20);
        }
        else{
         $today = date('Y-m-d', strtotime(NOW()));
         $jobOrders=$jobOrdersClone->where('job_order_submission_history.date','>=',$today)
                               ->orderBy('job_orders.updated_at','desc');
         $jobOrders=$jobOrders->get();
                               //->paginate(20);   
        }*/
        foreach($jobOrders  as $jobOrder)
        {   
            $jobOrder->companyId = DB::table('companies')->find($jobOrder->company_id)->id;
            $jobOrder->companyName = DB::table('companies')->find($jobOrder->company_id)->name;
            $jobOrder->recruiterName = DB::table('cms_users')->find($jobOrder->owner)->name;
        }
        return view('override.details_dashboard.job_order_scheduled_submission_list',compact('jobOrders'));
    }

    public function jobOrderScheduledSubmissionListCsvView (Request $request) {
        $jobOrders =DB::table('job_orders')
                    ->join('job_order_submission_history', 'job_orders.id', '=', 'job_order_submission_history.job_order_id')
                    ->where('job_order_submission_history.active',1)
                    ->where('job_orders.status','Hiring In Progress');
        $jobOrdersClone=Clone $jobOrders;
        if($request->input('hiddendate'))
        {
        $date= str_replace('/', '-', $request->input('hiddendate'));
        $filter_date=date('Y-m-d',strtotime($date));
        $jobOrders= $jobOrdersClone
                    ->where('job_order_submission_history.date','=',$filter_date)
                    ->orderBy('job_orders.updated_at','desc')
                    ->get();
        }
        else{
         $today = date('Y-m-d', strtotime(NOW()));
         $jobOrders=$jobOrdersClone->where('job_order_submission_history.date','>=',$today)
                               ->orderBy('job_orders.updated_at','desc')
                               ->get();   
        }
        $filePath = public_path(). "/reports/";
        $filename = $filePath. "Job Order Scheduled Submission List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Job Order Scheduled Submission List'));
        fputcsv($handle, array('Sl No.', 'Job Order','Company','Owner','Submission Date'
            ,'Re-Submission/Follow up Date','Status'));
        $i = 1;
        foreach($jobOrders  as $jobOrder)
        {
            $jobOrder->companyName = DB::table('companies')->find($jobOrder->company_id)->name;
            $jobOrder->recruiterName = DB::table('cms_users')->find($jobOrder->owner)->name;

            if(($jobOrder) && ($jobOrder->submission_status != 'Submission')){
                $submissionDate=date('d/m/Y',strtotime($jobOrder->date));
                }
            else{
              $submissionDate='';  
            }
                        
             if($jobOrder->submission_status == SUBMISSION_RESUBMISSION){
                    $submissionType = 'Re-submission';
                }
                elseif($jobOrder->submission_status == SUBMISSION_FOLLOW_UP){
                    $submissionType = 'Follow-up' ;
                }
                elseif($jobOrder->submission_status =='Submission'){
                    $submissionType = 'Submission' ;
                }
                                                
            if($jobOrder->submission_date) {
                $date =date('d/m/Y',strtotime($jobOrder->submission_date));          
            } else {
                $date = ' ';
            }

            fputcsv($handle, array($i++,$jobOrder->title,$jobOrder->companyName,$jobOrder->recruiterName ,$date,$submissionDate,$submissionType ));
        }             
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Job Order Scheduled Submission List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getPendingEvents($_type=null) //Request $request,
    {
        //return 1;
        // $ownerWiseReports = [];
        $today = date('Y-m-d', strtotime(NOW()));
        $allEvents= DB::table('events')->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->get();
       /* $privilege=CRUDBooster::myPrivilegeId();
        if($privilege==3)
        {

            $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                if($allEvent->job_order->owner == CRUDBooster::myId()) {
                    $eventIds[] = $allEvent->id;  
                }
            }
        }
        elseif($privilege==4)
        {
            $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                if($allEvent->job_order->owner == CRUDBooster::myId()) {
                    $eventIds[] = $allEvent->id;  
                }
            }
        }
        else
        {
            $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                if($allEvent->job_order->owner) {
                    $eventIds[] = $allEvent->id;  
                }
            } 
        }*/
            // $events =  DB::table('events')->whereIn('id',$eventIds)->where('event_date','<=',$today)->orderBy('event_date','asc')->paginate(20);
        $eventIds = [];
        $events_ids=[];
        foreach($allEvents as $allEvent) {
            $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
            /*if($allEvent->job_order->owner) {
                $eventIds[] = $allEvent->id;  
            }*/
            if($allEvent->job_order) {
                $eventIds[] = $allEvent->id;  
            }
            //$eventIds[] = $allEvent->id;
        }

        $fullEvents =  DB::table('events')->whereIn('id',$eventIds)->get();

        $secondaryStatus = array("Declined by C2W","Rejected by client","Rejected for Interview","Waiting for Consensus","Rejected","Rejected Hirable","Offer Declined","Offer Withdrawn","No Show","Un Qualified","Rejected by the client");

        foreach ($fullEvents as $fullEvent) {
            $jobOrderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$fullEvent->job_order_id)->where('candidate_id', $fullEvent->candidate_id)->whereNull('deleted_at')->orderBy('updated_at','desc')->first(); /**/
            if($jobOrderApplicant){
                if(!in_array($jobOrderApplicant->secondary_status,$secondaryStatus)){
                        // $events[] = $fullEvent;
                    $events_ids[] = $fullEvent->id;
                }
            }
            elseif($fullEvent->type=='Submission'||$fullEvent->type=='Job Order Re-submission'||
                $fullEvent->type=='Job Order Follow-up'||$fullEvent->type=='Intro Call'){
                if($fullEvent->type=='Submission'||$fullEvent->type=='Job Order Re-submission'||
                    $fullEvent->type=='Job Order Follow-up'){
                    $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                    ->where('job_order_id',$fullEvent->job_order_id)
                    ->where('date',$fullEvent->event_date)
                    ->where('submission_status',$fullEvent->type)
                    ->where('active',1)
                    ->first();
                    if($jobOrderSubmissionHistory->active==1){
                        $events_ids[] = $fullEvent->id;    
                    }
                }
                elseif($fullEvent->type=='Intro Call'){
                   $events_ids[] = $fullEvent->id;  
                }
            }

        }
        $events_ids=array_unique($events_ids);
        if($_REQUEST['status'] || $_REQUEST['owner']) {
          
            $eventsIds=[];
            $statusEventsIds = [];
            $ownerEventIds = [];
            $events =  DB::table('events')->whereIn('id',$events_ids)->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->get();
            foreach($events  as $event) {
               $event ->job_order = \DB::table('job_orders')->find($event->job_order_id);
                if($event->type ==$_REQUEST['status']) {
                     $statusEventsIds[] = $event->id; 
                }
                if($event->owner_id == $_REQUEST['owner']) {
                    $ownerEventIds[] = $event->id;    
                }
                if($_REQUEST['status'] && $_REQUEST['owner']) {
                    $eventsIds = array_intersect($statusEventsIds,$ownerEventIds);
                }
                elseif($_REQUEST['status']) {
                    $eventsIds = $statusEventsIds;
                    
                }elseif($_REQUEST['owner']){
                   
                    $eventsIds = $ownerEventIds;
                    
                }
                $events_ids= array_unique($eventsIds);


            }
        }
        else{
            //return 1;
                $events_ids=$events_ids;
        }
        if(($_type == "csv_export")){
            $events =  DB::table('events')->whereIn('id',$events_ids)->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->get();
        }
        else{
            
            $events =  DB::table('events')->whereIn('id',$events_ids)->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->paginate(2000000);
           
           


           
            // {
            //     $query->selectRaw('max(created_at)')
            //           ->from('events')
            //           ->groupBy('job_order_id');
            // })->groupBy('job_order_id')->orderBy('id','asc')->paginate(20);
        }
      //  $events = DB::table('events')->where('status','pending')->orderBy('id', 'desc')->groupBy('id');

        foreach($events as $event) {
           
            $event->job_order = \DB::table('job_orders')->find($event->job_order_id);
            $event->company = \DB::table('companies')->find($event->job_order->company_id);
            if(!empty($event->candidate_id)) {
                $event->candidate = \DB::table('candidates')->find($event->candidate_id);
            }
            else{
                $event->candidate ='';  
            }
           /* $event->owner = DB::table('cms_users')->where('id',$event->job_order->owner)->first()->name;*/
            $event->owner = DB::table('cms_users')->where('id',$event->owner_id)->first()->name;

            // $ownerWiseReports[$event->owner_id.'_'.$event->owner][] = $event->id;

            if(!empty($event->candidate_id))
            {
                $jobOrderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$event->job_order_id)->where('candidate_id', $event->candidate_id)->whereNull('deleted_at')->first(); // ->select('next_action')
                $openings= \DB::table('job_orders')->find($event->job_order->id);
                $openings_available=$openings->openings_available;
                if($openings_available<=0){
                    $event->opening_status='inactive';
                }
                else{
                    $event->opening_status='active';
                }
                $event->job_order_applicant = $jobOrderApplicant;
                if(!empty($event->job_order_applicant))
                {
                    $event->job_order_applicant->lastActivity = DB::table('job_order_applicant_statuses')
                    ->where('job_order_applicant_id', $jobOrderApplicant->id)
                    ->orderBy('id', 'desc')
                    ->first();
                }
            }
            else{
                $event->job_order_applicant='' ;  
            }
        }
        $owners = DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        if(($_type == "csv_export")){
            // $this->pendingEventsListCsvView($events,$owners);
            $result['events'] = $events;
            $result['owners'] = $owners;
            return $result;
        }
        else{
            return view('override.details_dashboard.pendings_events',compact('events','owners','ownerWiseReports'));
        }
    }

    public function createJobOrderApplicantObject($_jobOrderApplicants,$_dateArray) {
        foreach ($_jobOrderApplicants as $jobOrderApplicant) {
            $jobOrderApplicant->candidateName = DB::table('candidates')->where('id',$jobOrderApplicant->candidate_id)->first()->first_name.' '.DB::table('candidates')->where('id',$jobOrderApplicant->candidate_id)->first()->last_name;            
            $jobOrder = DB::table('job_orders')->where('id',$jobOrderApplicant->job_order_id)->first();
            if($jobOrderApplicant->primary_status=='Submission' && ($jobOrderApplicant->secondary_status=='Submitted to Client'||$jobOrderApplicant->secondary_status=='Submitted to client')){
              $jobOrderApplicanId=$jobOrderApplicant->job_order_applicant_id;
               $creator_id = DB::table('job_order_applicants')->where('id',$jobOrderApplicanId)->where('primary_status',$jobOrderApplicant->primary_status)->where('secondary_status',$jobOrderApplicant->secondary_status)->first()->creator_id;
              $jobOrderApplicant->recruiterName = DB::table('cms_users')->where('id',$creator_id)->first()->name;
            }
            else{
               $jobOrderApplicant->recruiterName = DB::table('cms_users')->where('id', $jobOrderApplicant->applicant_creator_id)->first()->name;
            }
            //$jobOrderApplicant->status_created_at=DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$jobOrderApplicanId)->where('new_primary_status',$jobOrderApplicant->primary_status)->where('new_secondary_status',$jobOrderApplicant->secondary_status)->first()->created_at;
           
            $jobOrderApplicant->status_created_at=$jobOrderApplicant->applicant_created_at;
            $jobOrderApplicant->date = ($_dateArray[$jobOrderApplicant->id])? $_dateArray[$jobOrderApplicant->id] : '';
            $jobOrderApplicant->companyName = DB::table('companies')->where('id', $jobOrder->company_id)->first()->name;
            $jobOrderApplicant->companyId = DB::table('companies')->where('id', $jobOrder->company_id)->first()->id;
            $jobOrderApplicant->jobOrder = $jobOrder;
        }
        return $_jobOrderApplicants;
    }

    public function resumeParsing() {
        $name = $_FILES['resume_url']['name'];
        $tmp = $_FILES['resume_url']['tmp_name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        if($ext == "doc") {
            $content = $this->read_doc($tmp);
        } elseif($ext == "docx") {
            $content = $this->read_docx($tmp);
        } elseif($ext == "pdf") {
            include_once \public_path('pdf2text.php');      
            $content =  PdfParser::parseFile($tmp);
        } elseif($ext == "rtf") {
            include_once \public_path('rtf2text.php');
            $content =  rtf2text($tmp);
        }
        $text = str_replace(array(" ","\r","\t"), '', $content);
        $str= preg_replace('/(?<=\\w)(?=[A-Z])/'," $1",$content);
        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i",$str, $matches);
        $email=(implode(' ',$matches[0]));
        $candidate_id=$_POST["candidate_id"];
        if($candidate_id) {
            if($email!='')
            {
                $existingMail = DB::table('candidates')->where('id','!=',$candidate_id)->where('primary_email',$email)->first();   
            }

        } else {
            if($email!='')
            {
                $existingMail = DB::table('candidates')->where('primary_email', $email)->first();
            }

        }
        if($existingMail) {
            $email_status=json_encode(array('result1'=>$existingMail->id,'result2'=>'true','fullname'=>$existingMail->first_name.' '.$existingMail->last_name));
        }
        else {
    // $result['status'] = 'error';
            $email_status='false';
        }
    //  ***************  MOBILE  **************
        preg_match_all("/(?:(?:\+|0{0,2})91(\s*[\ -]\s*)?|[0]?)?[123456789]\d{9}|(\d[ -]?){10}\d$/", $text, $matches);
        if (count($matches[0])) {
            foreach ($matches[0] as $mob) {
                $mobile['mobile'][] = $mob;
            }
          if($candidate_id) {
            if($mobile['mobile'][0]!='')
            {
                $existingPhone = DB::table('candidates')->where('id','!=',$candidate_id)->where('primary_phone',$mobile['mobile'][0])->first();   
            }

        } else {
            if($mobile['mobile'][0]!='')
            {
                $existingPhone = DB::table('candidates')->where('primary_phone', $mobile['mobile'][0])->first();
            }

        }
        if($existingPhone) {
            $phone_status=json_encode(array('result1'=>$existingPhone->id,'result2'=>'true','fullname'=>$existingPhone->first_name.' '.$existingPhone->last_name));
        }
        else {
    // $result['status'] = 'error';
           $phone_status='false';
        }  
        }          
    //  ***************  DOB  **************           
        $date =$this->find_date($content);
        if ($date) {
            $records['dob'][] = $date['year'].'-'.$date['month'].'-'.$date['day'];
        }
    // *******************ZIP***************
        preg_match_all('/\b\d{6}(-\d{5})?\b/', $content,$matches);
        $zip=(implode(' ',$matches[0]));
        if(!empty($zip))
        {
            $url = file_get_contents('http://postalpincode.in/api/pincode/'.$zip);
            $result = json_decode($url,TRUE);
            $location=$result['PostOffice'];
            $city=$location[0]['Name'];
            $state=$location[0]['State'];
            $country=$location[0]['Country'];
            $array =array("dob"=>$records,"mobile"=>$mobile,"email"=>$email,"content"=>$content,"city"=>$city,"country"=>$country,"state"=> $state,"zip"=>$zip,"email_status"=>$email_status);
            echo json_encode( $array );
        }
        else{
            $array =array("dob"=>$records,"mobile"=>$mobile,"email"=>$email,"content"=>$content,"zip"=>'',"email_status"=>$email_status,"phone_status"=>$phone_status);
            echo json_encode( $array );   
        }     

    }

    public function find_date( $string ) {
        $shortenize = function( $string ) {
            return substr( $string, 0, 3 );
        };
    // Define month name:
        $month_names = array(
            "january",
            "february",
            "march",
            "april",
            "may",
            "june",
            "july",
            "august",
            "september",
            "october",
            "november",
            "december"
        );
        $short_month_names = array_map( $shortenize, $month_names );
    // Define day name
        $day_names = array(
            "monday",
            "tuesday",
            "wednesday",
            "thursday",
            "friday",
            "saturday",
            "sunday"
        );
        $short_day_names = array_map( $shortenize, $day_names );
    // Define ordinal number
        $ordinal_number = ['st', 'nd', 'rd', 'th'];
        $day = "";
        $month = "";
        $year = "";
    // Match dates: 01/01/2012 or 30-12-11 or 1 2 1985
        preg_match( '/([0-9]?[0-9])[\.\-\/ ]+([0-1]?[0-9])[\.\-\/ ]+([0-9]{2,4})/', $string, $matches );
        if ( $matches ) {
            if ( $matches[1] )
                $day = $matches[1];
            if ( $matches[2] )
                $month = $matches[2];
            if ( $matches[3] )
                $year = $matches[3];
        }
    // Match dates: Sunday 1st March 2015; Sunday, 1 March 2015; Sun 1 Mar 2015; Sun-1-March-2015
        preg_match('/(?:(?:' . implode( '|', $day_names ) . '|' . implode( '|', $short_day_names ) . ')[ ,\-_\/]*)?([0-9]?[0-9])[ ,\-_\/]*(?:' . implode( '|', $ordinal_number ) . ')?[ ,\-_\/]*(' . implode( '|', $month_names ) . '|' . implode( '|', $short_month_names ) . ')[ ,\-_\/]+([0-9]{4})/i', $string, $matches );
        if ( $matches ) {
            if ( empty( $day ) && $matches[1] )
                $day = $matches[1];
            if ( empty( $month ) && $matches[2] ) {
                $month = array_search( strtolower( $matches[2] ),  $short_month_names );
                if ( ! $month )
                    $month = array_search( strtolower( $matches[2] ),  $month_names );
                $month = $month + 1;
            }
            if ( empty( $year ) && $matches[3] )
                $year = $matches[3];
        }
    // Match dates: March 1st 2015; March 1 2015; March-1st-2015
        preg_match('/(' . implode( '|', $month_names ) . '|' . implode( '|', $short_month_names ) . ')[ ,\-_\/]*([0-9]?[0-9])[ ,\-_\/]*(?:' . implode( '|', $ordinal_number ) . ')?[ ,\-_\/]+([0-9]{4})/i', $string, $matches );
        if ( $matches ) {
            if ( empty( $month ) && $matches[1] ) {
                $month = array_search( strtolower( $matches[1] ),  $short_month_names );
                if ( ! $month )
                    $month = array_search( strtolower( $matches[1] ),  $month_names );
                $month = $month + 1;
            }
            if ( empty( $day ) && $matches[2] )
                $day = $matches[2];
            if ( empty( $year ) && $matches[3] )
                $year = $matches[3];
        }
    // Match month name:
        if ( empty( $month ) ) {
            preg_match( '/(' . implode( '|', $month_names ) . ')/i', $string, $matches_month_word );
            if ( $matches_month_word && $matches_month_word[1] )
                $month = array_search( strtolower( $matches_month_word[1] ),  $month_names );
    // Match short month names
            if ( empty( $month ) ) {
                preg_match( '/(' . implode( '|', $short_month_names ) . ')/i', $string, $matches_month_word );
                if ( $matches_month_word && $matches_month_word[1] )
                    $month = array_search( strtolower( $matches_month_word[1] ),  $short_month_names );
            }
            $month = $month + 1;
        }
    // Match 5th 1st day:
        if ( empty( $day ) ) {
            preg_match( '/([0-9]?[0-9])(' . implode( '|', $ordinal_number ) . ')/', $string, $matches_day );
            if ( $matches_day && $matches_day[1] )
                $day = $matches_day[1];
        }
    // Match Year if not already setted:
        if ( empty( $year ) ) {
            preg_match( '/[0-9]{4}/', $string, $matches_year );
            if ( $matches_year && $matches_year[0] )
                $year = $matches_year[0];
        }
        if ( ! empty ( $day ) && ! empty ( $month ) && empty( $year ) ) {
            preg_match( '/[0-9]{2}/', $string, $matches_year );
            if ( $matches_year && $matches_year[0] )
                $year = $matches_year[0];
        }
    // Day leading 0
        if ( 1 == strlen( $day ) )
            $day = '0' . $day;
    // Month leading 0
        if ( 1 == strlen( $month ) )
            $month = '0' . $month;
    // Check year:
        if ( 2 == strlen( $year ) && $year > 20 )
            $year = '19' . $year;
        else if ( 2 == strlen( $year ) && $year < 20 )
            $year = '20' . $year;
        $date = array(
            'year'  => $year,
            'month' => $month,
            'day'   => $day
        );
    // Return false if nothing found:
        if ( empty( $year ) && empty( $month ) && empty( $day ) )
            return false;
        else
            return $date;
    }

    public function read_doc($_fileName) {
        $fileHandle = fopen($_fileName, "r");
        $line = @fread($fileHandle, filesize($_fileName));   
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
        {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
            {

            } else {
                $outtext .= $thisline." ";
            }
        }
        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    public function read_docx($_fileName) {
        $striped_content = '';
        $content = '';
        $zip = zip_open($_fileName);
        if (!$zip || is_numeric($zip)) return false;
        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while
        zip_close($zip);
        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);
        return $striped_content;
    }

    public function jobOrderReSubmissionDate(Request $_request) {
        $jobOrderId = $_request->input('job_order_id');
        $resubmissionType = $_request->input('resubmission_type');
        $resubmissionDate = $_request->input('resubmission_date');

        $addHistory = $this->addOrderSubmissionHistory($jobOrderId, $resubmissionType, $this->mdt($_request, 'resubmission_date'));

        $lastestHistory = \DB::table('job_order_submission_history')->where('job_order_id', $jobOrderId)
        ->orderBy('id', 'desc')
        ->where('active', 1)
        ->first()->id;

        $excludedLatestHistories = \DB::table('job_order_submission_history')->where('job_order_id', $jobOrderId)->where('id', '!=', $lastestHistory)->get();

        foreach ($excludedLatestHistories as $excludedLatestHistory) {

            $existing = \DB::table('job_order_submission_history')
            ->where('id', $excludedLatestHistory->id)
            ->where('job_order_id', $jobOrderId)
            ->update([
                'active' => 0,
                'updated_at' => \DB::raw('NOW()')
            ]);
        }

        $events = \DB::table('events')->where('job_order_id', $jobOrderId)->whereIn('type',array('Submission','Job Order Re-submission','Job Order Follow-up'))->get();
        foreach ($events as $event) {
            $this->deleteEvent($event->type, $jobOrderId);
        }

        $this->addEvent($jobOrderId,$this->mdt($_request, 'resubmission_date'),$resubmissionType,'pending');
         if($_request->input('submission_status')=='submission'){

            return redirect('/admin/job-orders-scheduled-submission');

         }
         else{

           return redirect('/admin/job_order_applicants?job_order_id=' . $jobOrderId); 
         }
        
    }

    public function jobOrderReSubmissionDateByEvent(Request $_request) {
        $jobOrderId = $_request->input('job_order_id');
        $resubmissionType = $_request->input('resubmission_type');
        $resubmissionDate = $_request->input('resubmission_date');

        $addHistory = $this->addOrderSubmissionHistory($jobOrderId, $resubmissionType, $this->mdt($_request, 'resubmission_date'));

        $lastestHistory = \DB::table('job_order_submission_history')->where('job_order_id', $jobOrderId)
        ->orderBy('id', 'desc')
        ->where('active', 1)
        ->first()->id;

        $excludedLatestHistories = \DB::table('job_order_submission_history')->where('job_order_id', $jobOrderId)->where('id', '!=', $lastestHistory)->get();

        foreach ($excludedLatestHistories as $excludedLatestHistory) {

            $existing = \DB::table('job_order_submission_history')
            ->where('id', $excludedLatestHistory->id)
            ->where('job_order_id', $jobOrderId)
            ->update([
                'active' => 0,
                'updated_at' => \DB::raw('NOW()')
            ]);
        }

        $events = \DB::table('events')->where('job_order_id', $jobOrderId)->whereIn('type',array('Submission','Job Order Re-submission','Job Order Follow-up'))->get();
        foreach ($events as $event) {
            $this->deleteEvent($event->type, $jobOrderId);
        }

        $this->addEvent($jobOrderId,$this->mdt($_request, 'resubmission_date'),$resubmissionType,'pending');

        return redirect('admin/pending-joborder-events');
    }

    public function jobOrderReSubmissionDateByPendingEvent(Request $_request) {
        $jobOrderId = $_request->input('job_order_id');
        $resubmissionType = $_request->input('resubmission_type');
        $resubmissionDate = $_request->input('resubmission_date');

        $addHistory = $this->addOrderSubmissionHistory($jobOrderId, $resubmissionType, $this->mdt($_request, 'resubmission_date'));

        $lastestHistory = \DB::table('job_order_submission_history')->where('job_order_id', $jobOrderId)
        ->orderBy('id', 'desc')
        ->where('active', 1)
        ->first()->id;

        $excludedLatestHistories = \DB::table('job_order_submission_history')->where('job_order_id', $jobOrderId)->where('id', '!=', $lastestHistory)->get();

        foreach ($excludedLatestHistories as $excludedLatestHistory) {

            $existing = \DB::table('job_order_submission_history')
            ->where('id', $excludedLatestHistory->id)
            ->where('job_order_id', $jobOrderId)
            ->update([
                'active' => 0,
                'updated_at' => \DB::raw('NOW()')
            ]);
        }

        $events = \DB::table('events')->where('job_order_id', $jobOrderId)->whereIn('type',array('Submission','Job Order Re-submission','Job Order Follow-up'))->get();
        foreach ($events as $event) {
            $this->deleteEvent($event->type, $jobOrderId);
        }

        $this->addEvent($jobOrderId,$this->mdt($_request, 'resubmission_date'),$resubmissionType,'pending');

        return redirect('admin/pending-events');
    }

    public function addOrderSubmissionHistory($_jobOrderId,$_submissionType,$_submissionDate)
    {
        $jobOrderId = $_jobOrderId;
        $resubmissionType = $_submissionType;
        $resubmissionDate = $_submissionDate;

        \DB::table('job_order_submission_history')->insert([
            'job_order_id' => $jobOrderId,
            'submission_status' => $resubmissionType,
                'date' => $resubmissionDate, // $this->mdt($_request, 'resubmission_date'),
                'created_at' => \DB::raw('NOW()'),
                'updated_at' => \DB::raw('NOW()')
            ]);

    }

    public function getSubmissionHistory($_jobOrderId)
    {
        try {
            $submissionHistories = \DB::table('job_order_submission_history')->where('job_order_id',$_jobOrderId)->get();
        }
        catch(\Exception $e) {
            $this->setLastError("getting submission history failed :  could not find a job order matching the id  ".$e->getMessage());
            return false;
        }
        return $submissionHisories;
    }

    public function removeResubmissionFromEvents($_jobOrderId,$_submissionType)
    {
        // if($_submissionType == Re-submission"Job Order Re-submission")
        // if($_submissionType == Follow-up"Job Order Follow-up")
        $deleteEvent = $this->deleteEvent($_submissionType, $_jobOrderId);
    }

    public function sendInvoiceMail(Request $_request) {

        // $jobOrderApplicantsId = $_request->input('job_order_applicants_id');
        $candidate = DB::table('candidates')->find($_request->input('candidate_id'));
        $data['candidate_name'] = $_request->input('candidate_name');
        $data['job_order'] = $_request->input('job_order');
        $data['company_name'] = $_request->input('company_name');
        $data['joining_date'] = $_request->input('joining_date');
        $data['annual_ctc'] = $_request->input('annual_ctc');
        $data['service_charge'] = $_request->input('service_charge');
        $data['billing_contact'] = $_request->input('billing_contact');
        $data['recruiter_name'] = $_request->input('recruiter_name');
        $data['regards_name'] = $_request->input('regards_name');
        //$from_name = CRUDBooster::myName();
        //$from_email = CRUDBooster::me()->email; // from_mail@mail.com
        //$subject = 'Raise invoice - '.$_request->input('candidate_name');
        // inv@connecting2work.com  // 'from_email'=>$from_email,'from_name'=>$from_name,
        //$mailSend = CRUDBooster::sendEmail(['to'=>$candidate->primary_email,'data'=>$data,'template'=>'send_invoice','attachments'=>[]]);
       $mailSend = CRUDBooster::sendEmail(['to'=>env('FINANCE_MAIL'),'data'=>$data,'template'=>'send_invoice','attachments'=>[]]); 
       /*$Update= \DB::table('cms_email_templates')
            ->update([
                'cc_email' =>NULL
            ]);*/
        return "OK";
    }

    public function getPendingJoborderEvents()
    {   
        $today = date('Y-m-d', strtotime(NOW()));
        $jobOderEvents=array('Submission','Intro Call','Job Order Re-submission','Job Order Follow-up');
        $allEvents= DB::table('events')->where('event_date','<=',$today)->whereIn('type', $jobOderEvents)->where('status','pending')->orderBy('event_date','asc')->get();
        /*$privilege=CRUDBooster::myPrivilegeId();
        if($privilege==3)
        {

            $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                if($allEvent->job_order->owner == CRUDBooster::myId()) {
                    $eventIds[] = $allEvent->id;
                    if($allEvent->type=='Submission'||$allEvent->type=='Job Order Re-submission'||
                        $allEvent->type=='Job Order Follow-up'){
                        $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                        ->where('job_order_id',$allEvent->job_order_id)->where('date',$allEvent->event_date)
                        ->where('submission_status',$allEvent->type)->first();
                        if($jobOrderSubmissionHistory->active==1){
                            $eventIds[] = $allEvent->id;    
                        }
                    }
                }
            }
        }
        elseif($privilege==4)
        {
            $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                if($allEvent->job_order->owner == CRUDBooster::myId()) {
                    $eventIds[] = $allEvent->id;
                    if($allEvent->type=='Submission'||$allEvent->type=='Job Order Re-submission'||
                            $allEvent->type=='Job Order Follow-up'){
                            $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                        ->where('job_order_id',$allEvent->job_order_id)->where('date',$allEvent->event_date)
                        ->where('submission_status',$allEvent->type)->first();
                        if($jobOrderSubmissionHistory->active==1){
                            $eventIds[] = $allEvent->id;    
                        }
                    } 
                }
            }
        }
        else
        {
            $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                if($allEvent->job_order->owner) {
                    $eventIds[] = $allEvent->id;
                    if($allEvent->type=='Submission'||$allEvent->type=='Job Order Re-submission'||
                        $allEvent->type=='Job Order Follow-up'){
                        $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                        ->where('job_order_id',$allEvent->job_order_id)->where('date',$allEvent->event_date)
                        ->where('submission_status',$allEvent->type)->first();
                        if($jobOrderSubmissionHistory->active==1){
                            $eventIds[] = $allEvent->id;    
                        }
                    }
                }  
            }
        }*/
        $eventIds = [];

            foreach($allEvents as $allEvent) {
                $allEvent->job_order = \DB::table('job_orders')->find($allEvent->job_order_id);
                //if($allEvent->job_order->owner) {
                if($allEvent->job_order){
                    $eventIds[] = $allEvent->id;
                    if($allEvent->type=='Submission'||$allEvent->type=='Job Order Re-submission'||
                        $allEvent->type=='Job Order Follow-up'){
                        $jobOrderSubmissionHistory= \DB::table('job_order_submission_history')
                        ->where('job_order_id',$allEvent->job_order_id)->where('date',$allEvent->event_date)
                        ->where('submission_status',$allEvent->type)
                        ->where('active',1)
                        ->first();
                        if($jobOrderSubmissionHistory->active==1){
                            $eventIds[] = $allEvent->id;    
                        }
                    }
                }  
            } 
        $eventIds=array_unique($eventIds);
          if($_REQUEST['status'] || $_REQUEST['owner']) {
            $statusEventsIds = [];
            $ownerEventIds = [];
            $events =  DB::table('events')->whereIn('id',$eventIds)->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->get();
            foreach($events  as $event) {
               $event ->job_order = \DB::table('job_orders')->find($event->job_order_id);
                if($event->type ==$_REQUEST['status']) {
                     $statusEventsIds[] = $event->id; 
                }
                if($event->owner_id == $_REQUEST['owner']) {
                    $ownerEventIds[] = $event->id;    
                }
                if($_REQUEST['status'] && $_REQUEST['owner']) {
                    $eventsIds = array_intersect($statusEventsIds,$ownerEventIds);
                }
                elseif($_REQUEST['status']) {
                    $eventsIds = $statusEventsIds;
                }elseif($_REQUEST['owner']){
                    $eventsIds = $ownerEventIds;
                }
                $eventIds= array_unique($eventsIds);
            }
        }
        else{
            
               $eventIds=$eventIds;
        }
        $events =  DB::table('events')->whereIn('id',$eventIds)->whereIn('type', $jobOderEvents)->where('event_date','<=',$today)->where('status','pending')->orderBy('event_date','asc')->paginate(2000000);
        foreach($events as $event) {
            $event->job_order = \DB::table('job_orders')->find($event->job_order_id);

            $event->company = \DB::table('companies')->find($event->job_order->company_id);
            if(!empty($event->candidate_id)) {
                $event->candidate = \DB::table('candidates')->find($event->candidate_id);
            }
            else{
                $event->candidate ='';  
            }
            //$event->owner = DB::table('cms_users')->where('id',$event->job_order->owner)->first()->name;
            $event->owner = DB::table('cms_users')->where('id',$event->owner_id)->first()->name;
            if(!empty($event->candidate_id))
            {
                $jobOrderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$event->job_order_id)->where('candidate_id', $event->candidate_id)->whereNull('deleted_at')->first(); // ->select('next_action')
                $event->job_order_applicant = $jobOrderApplicant;
                if(!empty($event->job_order_applicant))
                {
                    $event->job_order_applicant->lastActivity = DB::table('job_order_applicant_statuses')
                    ->where('job_order_applicant_id', $jobOrderApplicant->id)
                    ->orderBy('id', 'desc')
                    ->first();
                }
            }
            else{
                $event->job_order_applicant='' ;  
            }
        }
        $owners = DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        return view('override.details_dashboard.pendings_job_order_events',compact('events','owners'));
    }
//Website Candidates -

    public function applyJoborder()
    {   
        $countries = DB::table('countries')->orderby('name','desc')->get();
        $states = DB::table('states')->orderby('name','desc')->get();
        $cities = DB::table('cities')->orderby('name','desc')->get();
        $postal_codes = DB::table('postal_codes')->orderby('name','desc')->get();
        $sources = DB::table('sources')->orderby('name','desc')->get();

        $industries = DB::table('industries')->orderby('name','asc')->get();
        $functional_areas = DB::table('industry_functional_areas')->orderby('name','asc')->get();
        $general_skills = DB::table('general_skills')->orderby('name','asc')->get();
        $qualification_levels = DB::table('qualification_levels')->orderby('qual_level','asc')->get();
        $qualifications = DB::table('qualifications')->orderby('qualification','asc')->get();
                        // List States
        if($_REQUEST['current_action']== 'list_states') {
            $states = DB::table('states')
            ->where('country_id', $_REQUEST['country_id'])
            ->orderby('name','desc')
            ->get();
            return $states;

        }

                        // List Cities
        if($_REQUEST['current_action']== 'list_cities') {
            $cities = DB::table('cities')
            ->where('state_id', $_REQUEST['state_id'])
            ->orderby('name','desc')
            ->get();
            return $cities;

        }

                        //List Functional Area Roles
        if($_REQUEST['current_action'] == 'list_functional_roles_skills') {
            $functional_area['roles'] = DB::table('industry_functional_area_roles')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            $functional_area['skills'] = DB::table('industry_functional_area_skills')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            return $functional_area;
        }

        if($_REQUEST['current_action'] == 'list_qualifications') {
            $qualifications = DB::table('qualifications')
            ->where('qualification_level_id', $_REQUEST['qualification_level_id'])
            ->orderby('qualification','desc')
            ->get();
            return $qualifications;
        }
        return view('override.front_end.apply_job',compact('countries','states','cities','postal_codes','industries','functional_areas','general_skills','qualification_levels','qualifications','sources'));
    }

    public function saveApplyJoborder(Request $request)
    { 
        if($request->input('job_order_id')==null)
        {
            $name = $request->file('resume')->getClientOriginalName();
            $filename = preg_replace('/\s+/', '_', $name);
            if($request->file('photo_url')){
                $image_name = $request->file('photo_url')->getClientOriginalName();
                $ifilename =preg_replace('/\s+/', '_',$image_name);
                $image_filename='/images/'.$ifilename;
                $image_upload=$request->file('photo_url')->move(
                    public_path() . '/images/', $image_filename 
                );
            }
            else{
                $image_filename='';
            }
            $result=\DB::table('website_candidates')
            ->insert([
                'key' =>  $request['key'],
                'first_name'=> $request['first_name'], 
                'last_name'=> $request['last_name'], 
                'birth_date'=> $request['birth_date'],
                'gender'=> $request['gender'],
                'religion' =>  $request['religion'],
                'expected_ctc'=> $request['expected_ctc'], 
                'preferred_city'=> $request['preferred_city'], 
                'first_job_start_date'=> $request['first_job_start_date'],
                'highest_qualification'=> $request['highest_qualification'], 
                'head_line'=> $request['head_line'], 
                'experience_years'=> $request['experience_years'],
                'experience_months'=> $request['experience_months'],
                'current_ctc'=> $request['current_ctc'],
                'can_relocate'=> $request['can_relocate'],
                'current_employer'=> $request['current_employer'],
                'current_designation'=> $request['current_designation'],
                'notice_period'=> $request['notice_period'],
                'current_city'=> $request['current_city'],
                'address'=> $request['address'],
                'country_id'=> $request['country_id'],
                'state_id'=> $request['state_id'],
                'city_id'=> $request['city_id'],
                'postal_code'=> $request['postal_code'],
                'primary_email'=> $request['primary_email'],
                'secondary_email'=> $request['secondary_email'],
                'primary_phone'=> $request['primary_phone'],
                'secondary_phone'=> $request['secondary_phone'],
                'photo_url'=> $image_filename ,
                'date_available'=> $request['date_available'],
                'web_site'=> $request['website'],
                'relationship_status'=> $request['relationship_status'],
                'general_skill'=> json_encode($request['general_skill_id']),
                'industry_id'=> json_encode($request['industry_id']),
                'industry_functional_area_id'=> json_encode($request['functional_area_id']),
                'industry_functional_area_role_id'=> json_encode($request['functional_area_role_id']),
                'industry_functional_area_skill_id'=>json_encode( $request['functional_area_skill_id']),
                'qualification_level_id'=> json_encode($request['qualification_level_id']),
                'qualification_id'=>json_encode($request['qualification_id']),
                'is_completed'=> json_encode($request['is_completed']),
                'completed_year'=> json_encode($request['completed_year']),
                'score'=>json_encode($request['score']),
                'created_at' => \DB::raw('NOW()'),
                'updated_at' => \DB::raw('NOW()'), 
                'update_status' => '0',
                'resume'=>'/resumes/'. $filename 
               
            ]);
            $upload=$request->file('resume')->move(
                public_path() . '/resumes/', $filename 
            );
            if ($result==true && $upload==true||$image_upload==true) {
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'success');
                $request->session()->push('job_message_content', 'Registered successfully! Login again to view the details.');
                return redirect('/status-message');
            } else {
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'danger');
                $request->session()->push('job_message_content', 'Registered failed!');
                return redirect('/status-message');
            }
        }
        else{
            $name = $request->file('resume')->getClientOriginalName();
            $filename = preg_replace('/\s+/', '_', $name);
            if($request->file('photo_url')){
                $image_name = $request->file('photo_url')->getClientOriginalName();
                $ifilename =preg_replace('/\s+/', '_',$image_name);
                $image_filename='/images/'.$ifilename;
                $image_upload=$request->file('photo_url')->move(
                    public_path() . '/images/', $image_filename 
                );
            }
            else{
                $image_filename='';
            }
            $candidate_id=\DB::table('website_candidates')
            ->insertGetId([
                'key' =>  $request['key'],
                'first_name'=> $request['first_name'], 
                'last_name'=> $request['last_name'], 
                'birth_date'=> $request['birth_date'],
                'gender'=> $request['gender'],
                'religion' =>  $request['religion'],
                'expected_ctc'=> $request['expected_ctc'], 
                'preferred_city'=> $request['preferred_city'], 
                'first_job_start_date'=> $request['first_job_start_date'],
                'highest_qualification'=> $request['highest_qualification'], 
                'head_line'=> $request['head_line'], 
                'experience_years'=> $request['experience_years'],
                'experience_months'=> $request['experience_months'],
                'current_ctc'=> $request['current_ctc'],
                'can_relocate'=> $request['can_relocate'],
                'current_employer'=> $request['current_employer'],
                'current_designation'=> $request['current_designation'],
                'notice_period'=> $request['notice_period'],
                'current_city'=> $request['current_city'],
                'address'=> $request['address'],
                'country_id'=> $request['country_id'],
                'state_id'=> $request['state_id'],
                'city_id'=> $request['city_id'],
                'postal_code'=> $request['postal_code'],
                'primary_email'=> $request['primary_email'],
                'secondary_email'=> $request['secondary_email'],
                'primary_phone'=> $request['primary_phone'],
                'secondary_phone'=> $request['secondary_phone'],
                'photo_url'=> $image_filename ,
                'date_available'=> $request['date_available'],
                'web_site'=> $request['website'],
                'relationship_status'=> $request['relationship_status'],
                'general_skill'=> json_encode($request['general_skill_id']),
                'industry_id'=> json_encode($request['industry_id']),
                'industry_functional_area_id'=> json_encode($request['functional_area_id']),
                'industry_functional_area_role_id'=> json_encode($request['functional_area_role_id']),
                'industry_functional_area_skill_id'=>json_encode( $request['functional_area_skill_id']),
                'qualification_level_id'=> json_encode($request['qualification_level_id']),
                'qualification_id'=>json_encode($request['qualification_id']),
                'is_completed'=> json_encode($request['is_completed']),
                'completed_year'=> json_encode($request['completed_year']),
                'score'=>json_encode($request['score']),
                'created_at' => \DB::raw('NOW()'),
                'updated_at' => \DB::raw('NOW()'), 
                'update_status' => '0',
                'resume'=>'/resumes/'. $filename
              
            ]);
            $upload=$request->file('resume')->move(
                public_path() . '/resumes/', $filename 
            );
            $title=\DB::table('job_orders')->find($request['job_order_id'])->title;
            $jobOrder=\DB::table('job_orders')->find($request['job_order_id']);
            $client= \DB::table('companies')->where('id', $jobOrder->company_id)->first()->name;
            $office= \DB::table('offices')->where('id', $jobOrder->office_id)->first();
            $cities=\DB::table('cities')->where('id', $office->city_id)->first();
            $job_location=$office->name.', '.$cities->name;  
            $openings= $jobOrder->openings_available;  
            $result=\DB::table('website_applications')
            ->insert([
                'web_candidate_id' => $candidate_id, 
                'job_order_id' =>  $request['job_order_id'],
                'title'=>  $title,
                'client'=> $client,
                'job_location'=> $job_location,
                'openings'=> $openings,
                'status' =>  'inactive' ,
                'remove_status'=>'not-removed' 
            ]);
            if ($result==true && $upload==true||$image_upload==true) {
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'success');
                $request->session()->push('job_message_content', 'Job applied successfully! Login again to view the details.');
                return redirect('/status-message');
            } else {
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'danger');
                $request->session()->push('job_message_content', 'Job apply failed!');
                return redirect('/status-message');
            }  
        }
    }

    public function associateWebsiteCandidates()
    {   
        $request= \DB::table('website_candidates')->where('id',$_REQUEST['website_candidate_id'])->first();
        $existingMail = \DB::table('candidates')->where('primary_email',$request->primary_email)->first();
        if(!empty($existingMail)) {
            $id=$existingMail->id;
            $highest_qualification_level= DB::table('qualifications')->find($request->highest_qualification)->qualification_level_id;
            $existCandidateUpdates=\DB::table('candidates')->where('id', $id)->update([
                'first_name'=> $request->first_name, 
                'last_name'=> $request->last_name, 
                'birth_date'=> $request->birth_date,
                'gender'=> $request->gender,
                'religion' =>  $request->religion,
                'expected_ctc'=> $request->expected_ctc, 
                'preferred_city'=> $request->preferred_city, 
                'first_job_start_date'=> $request->first_job_start_date,
                'highest_qualification'=> $request->highest_qualification,
                'highest_qualification_level'=> $highest_qualification_level, 
                'head_line'=> $request->head_line, 
                'experience_years'=> $request->experience_years,
                'experience_months'=> $request->experience_months,
                'current_ctc'=> $request->current_ctc,
                'can_relocate'=> $request->can_relocate,
                'current_employer'=> $request->current_employer,
                'current_designation'=> $request->current_designation,
                'notice_period'=> $request->notice_period,
                'current_city'=> $request->current_city,
                'address'=> $request->address,
                'country_id'=> $request->country_id,
                'state_id'=> $request->state_id,
                'city_id'=> $request->city_id,
                'postal_code'=> $request->postal_code,
                'primary_email'=> $request->primary_email,
                'secondary_email'=> $request->secondary_email,
                'primary_phone'=> $request->primary_phone,
                'secondary_phone'=> $request->secondary_phone,
                'photo_url'=>  ltrim($request->photo_url, '/'),
                'date_available'=> $request->date_available,
                'web_site'=> $request->web_site,
                'relationship_status'=> $request->relationship_status,
                'creator_id'=>CRUDBooster::myId(),
                'updated_at' =>\DB::raw('NOW()')
            ]);
            $this->addResume($id,$request->resume);
            DB::table('candidate_industries')->where('candidate_id',$id)->delete();
            DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->delete();
            DB::table('candidate_general_skills')->where('candidate_id',$id)->delete();
            DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$id)->delete();
            DB::table('candidate_qualifications')->where('candidate_id',$id)->delete();
            DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->delete();

            $industries = DB::table('industries')->WhereIn('id',json_decode($request->industry_id, true))->get();
            foreach ($industries as $industry) {
                DB::table('candidate_industries')->insert([
                    'candidate_id' => $id,
                    'industry_id' => $industry->id,
                    'industry' => $industry->name
                ]);
            }
            $roles=DB::table('industry_functional_area_roles')->WhereIn('id',json_decode($request->industry_functional_area_role_id, true))->get();
            foreach ($roles as $role) {
                DB::table('candidate_industry_functional_area_roles')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_role_id' => $role->id,
                    'role' => $role->name
                ]);
            }
            $areas=DB::table('industry_functional_areas')->WhereIn('id',json_decode($request->industry_functional_area_id, true))->get();
            foreach ($areas as  $area) {
                DB::table('candidate_industry_functional_areas')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_id' =>$area->id,
                    'industry_functional_area' => $area->name
                ]);
            }
            $skills=DB::table('industry_functional_area_skills')->WhereIn('id',json_decode($request->industry_functional_area_skill_id, true))->get();
            foreach ($skills as $skill) {
                DB::table('candidate_industry_functional_area_skills')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_skill_id' =>$skill->id,
                    'industry_functional_area_skill' => $skill->name
                ]);
            }
            $general_skills=DB::table('general_skills')->WhereIn('id',json_decode($request->general_skill, true))->get();
            foreach ($general_skills as $general_skill) {
                DB::table('candidate_general_skills')->insert(['candidate_id' => $id,
                    'general_skill' => $general_skill->id
                ]);
            }
            $qualification_levels=json_decode($request->qualification_level_id);
            $qualifications=json_decode($request->qualification_id);
            $is_completed=json_decode($request->is_completed);
            $years=json_decode($request->completed_year);
            $scores=json_decode($request->score);
            $i=0;
            foreach($qualification_levels as $qualification_level)
            {
                DB::table('candidate_qualifications')->insert(['candidate_id' => $id,
                    'qualification_id' =>$qualifications[$i] ,
                    'qualification_level_id' =>$qualification_levels[$i],
                    'is_completed' =>(empty($is_completed[$i])) ? '0' : $is_completed[$i],
                    'completed_year' =>$years[$i] ,
                    'score' =>$scores[$i] ,
                    'qualification' =>DB::table('qualifications')->find($qualifications[$i])->qualification,
                    'qualification_level' =>DB::table('qualification_levels')->find($qualification_levels[$i])->qual_level
                ]);
                $i++;
            }
            $jobOrderVacancy=DB::table('job_orders')->where('id',$_REQUEST['job_order_id'])
            ->first();
            $openings=$jobOrderVacancy->openings_available;
            if($openings<=0){
                CRUDBooster::redirect('/admin/view-applicants?job_order_id='.$_REQUEST['job_order_id'],"No Openings Available!Candidate cannot Associated to the Job Order","warning");
                $newCandidateInsert=\DB::table('candidates')->insertGetId([
                    'first_name'=> $request->first_name, 
                    'last_name'=> $request->last_name, 
                    'birth_date'=> $request->birth_date,
                    'gender'=> $request->gender,
                    'religion' =>  $request->religion,
                    'expected_ctc'=> $request->expected_ctc, 
                    'preferred_city'=> $request->preferred_city, 
                    'first_job_start_date'=> $request->first_job_start_date,
                    'highest_qualification'=> $request->highest_qualification,
                    'highest_qualification_level'=> $highest_qualification_level, 
                    'head_line'=> $request->head_line, 
                    'experience_years'=> $request->experience_years,
                    'experience_months'=> $request->experience_months,
                    'current_ctc'=> $request->current_ctc,
                    'can_relocate'=> $request->can_relocate,
                    'current_employer'=> $request->current_employer,
                    'current_designation'=> $request->current_designation,
                    'current_city'=> $request->current_city,
                    'address'=> $request->address,
                    'country_id'=> $request->country_id,
                    'state_id'=> $request->state_id,
                    'city_id'=> $request->city_id,
                    'postal_code'=> $request->postal_code,
                    'primary_email'=> $request->primary_email,
                    'secondary_email'=> $request->secondary_email,
                    'primary_phone'=> $request->primary_phone,
                    'secondary_phone'=> $request->secondary_phone,
                    'photo_url'=>  ltrim($request->photo_url, '/'),
                    'date_available'=> $request->date_available,
                    
                    'web_site'=> $request->web_site,
                    'relationship_status'=> $request->relationship_status,
                    'created_at' => \DB::raw('NOW()'),
                    'updated_at' => \DB::raw('NOW()'),
                    'creator_id' => CRUDBooster::myId()
                ]);
                
                $id=$newCandidateInsert;
            
            
            }
            else{  
                $existing = \DB::table('job_order_applicants')
                ->where('job_order_id', $_REQUEST['job_order_id'])
                ->where('candidate_id', $id)
                ->whereNull('deleted_at')
                ->first();
                if(!$existing) {
                    $newJobOrderApplicant =\DB::table('job_order_applicants')
                    ->insertGetId([
                        'job_order_id' =>$_REQUEST['job_order_id'],
                        'candidate_id' =>$id,
                        'primary_status' => 'Qualify',
                        'secondary_status' => 'Pending Review',
                        'next_action' => 'Qualify',
                        'created_at' => \DB::raw('NOW()'),
                        'updated_at' => \DB::raw('NOW()'),
                        'creator_id' => CRUDBooster::myId()
                    ]);
                    \DB::table('job_order_applicant_statuses')->insert([
                        'job_order_applicant_id' => $newJobOrderApplicant,
                        'prev_primary_status' => '',
                        'prev_secondary_status' => '',
                        'new_primary_status' => 'Qualify',
                        'new_secondary_status' => 'Pending Review',
                        'note' => '',
                        'creator_id' => CRUDBooster::myId(),
                        'created_at' => \DB::raw('NOW()')
                    ]);
                }
                else {
                    $existing = \DB::table('job_order_applicants')
                    ->where('job_order_id', $_REQUEST['job_order_id'])
                    ->where('candidate_id', $id)
                    ->update([
                        'primary_status' => 'Qualify',
                        'secondary_status' => 'Pending Review',
                        'next_action' => 'Qualify',
                        'created_at' => \DB::raw('NOW()'),
                        'updated_at' => \DB::raw('NOW()'),
                        'creator_id' => CRUDBooster::myId(),
                        'deleted_at' => null
                    ]);
                }
                DB::table('website_applications')->where('job_order_id', $_REQUEST['job_order_id'])->where('web_candidate_id',$_REQUEST['website_candidate_id'])->update(['status'=>'active']);
                CRUDBooster::redirect('/admin/view-applicants?job_order_id='.$_REQUEST['job_order_id'],"Candidate Associated to the Job Order","success");
            }

        }  
        else {

            $highest_qualification_level= DB::table('qualifications')->find($request->highest_qualification)->qualification_level_id;
            $newCandidateInsert=\DB::table('candidates')->insertGetId([
                'first_name'=> $request->first_name, 
                'last_name'=> $request->last_name, 
                'birth_date'=> $request->birth_date,
                'gender'=> $request->gender,
                'religion' =>  $request->religion,
                'expected_ctc'=> $request->expected_ctc, 
                'preferred_city'=> $request->preferred_city, 
                'first_job_start_date'=> $request->first_job_start_date,
                'highest_qualification'=> $request->highest_qualification,
                'highest_qualification_level'=> $highest_qualification_level, 
                'head_line'=> $request->head_line, 
                'experience_years'=> $request->experience_years,
                'experience_months'=> $request->experience_months,
                'current_ctc'=> $request->current_ctc,
                'can_relocate'=> $request->can_relocate,
                'current_employer'=> $request->current_employer,
                'current_designation'=> $request->current_designation,
                'current_city'=> $request->current_city,
                'address'=> $request->address,
                'country_id'=> $request->country_id,
                'state_id'=> $request->state_id,
                'city_id'=> $request->city_id,
                'postal_code'=> $request->postal_code,
                'primary_email'=> $request->primary_email,
                'secondary_email'=> $request->secondary_email,
                'primary_phone'=> $request->primary_phone,
                'secondary_phone'=> $request->secondary_phone,
                'photo_url'=>  ltrim($request->photo_url, '/'),
                'date_available'=> $request->date_available,
                'web_site'=> $request->web_site,
                'relationship_status'=> $request->relationship_status,
                'creator_id'=>CRUDBooster::myId(),
                'created_at' =>\DB::raw('NOW()'),
                'updated_at' =>\DB::raw('NOW()')
            ]);
           
            $id=$newCandidateInsert;
            $createdAt=date('Y-m-d H:i:s');
            DB::table('candidates')->where('id', $id)
            ->update(['updated_at' => $createdAt]);
            $this->addResume($id,$request->resume);
            $industries = DB::table('industries')->WhereIn('id',json_decode($request->industry_id, true))->get();
            foreach ($industries as $industry) {
                DB::table('candidate_industries')->insert([
                    'candidate_id' => $id,
                    'industry_id' => $industry->id,
                    'industry' => $industry->name
                ]);
            }
            $roles=DB::table('industry_functional_area_roles')->WhereIn('id',json_decode($request->industry_functional_area_role_id, true))->get();
            foreach ($roles as $role) {
                DB::table('candidate_industry_functional_area_roles')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_role_id' => $role->id,
                    'role' => $role->name
                ]);
            }
            $areas=DB::table('industry_functional_areas')->WhereIn('id',json_decode($request->industry_functional_area_id, true))->get();
            foreach ($areas as  $area) {
                DB::table('candidate_industry_functional_areas')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_id' =>$area->id,
                    'industry_functional_area' => $area->name
                ]);
            }
            $skills=DB::table('industry_functional_area_skills')->WhereIn('id',json_decode($request->industry_functional_area_skill_id, true))->get();
            foreach ($skills as $skill) {
                DB::table('candidate_industry_functional_area_skills')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_skill_id' =>$skill->id,
                    'industry_functional_area_skill' => $skill->name
                ]);
            }
            $general_skills=DB::table('general_skills')->WhereIn('id',json_decode($request->general_skill, true))->get();
            foreach ($general_skills as $general_skill) {
                DB::table('candidate_general_skills')->insert(['candidate_id' => $id,
                    'general_skill' => $general_skill->id
                ]);
            }
            $qualification_levels=json_decode($request->qualification_level_id);
            $qualifications=json_decode($request->qualification_id);
            $is_completed=json_decode($request->is_completed);
            $years=json_decode($request->completed_year);
            $scores=json_decode($request->score);
            $i=0;
            foreach($qualification_levels as $qualification_level)
            {
                DB::table('candidate_qualifications')->insert(['candidate_id' => $id,
                    'qualification_id' =>$qualifications[$i] ,
                    'qualification_level_id' =>$qualification_levels[$i],
                    'is_completed' =>(empty($is_completed[$i])) ? '0' : $is_completed[$i] ,
                    'completed_year' =>$years[$i] ,
                    'score' =>$scores[$i] ,
                    'qualification' =>DB::table('qualifications')->find($qualifications[$i])->qualification,
                    'qualification_level' =>DB::table('qualification_levels')->find($qualification_levels[$i])->qual_level
                ]);
                $i++;
            }
            $jobOrderVacancy=DB::table('job_orders')->where('id',$_REQUEST['job_order_id'])
            ->first();
            $openings=$jobOrderVacancy->openings_available;
            if($openings<=0){
                CRUDBooster::redirect('/admin/view-applicants?job_order_id='.$_REQUEST['job_order_id'],"No Openings Available! Candidate cannot Associated to the Job Order","warning");
            }
            else{
                $existing = \DB::table('job_order_applicants')
                ->where('job_order_id', $_REQUEST['job_order_id'])
                ->where('candidate_id', $id)
                ->whereNull('deleted_at')
                ->first();
                if(!$existing) {
                    $newJobOrderApplicant =\DB::table('job_order_applicants')
                    ->insertGetId([
                        'job_order_id' =>$_REQUEST['job_order_id'],
                        'candidate_id' =>$id,
                        'primary_status' => 'Qualify',
                        'secondary_status' => 'Pending Review',
                        'next_action' => 'Qualify',
                        'created_at' => \DB::raw('NOW()'),
                        'updated_at' => \DB::raw('NOW()'),
                        'creator_id' => CRUDBooster::myId()
                    ]);
                    \DB::table('job_order_applicant_statuses')->insert([
                        'job_order_applicant_id' => $newJobOrderApplicant,
                        'prev_primary_status' => '',
                        'prev_secondary_status' => '',
                        'new_primary_status' => 'Qualify',
                        'new_secondary_status' => 'Pending Review',
                        'note' => '',
                        'creator_id' => CRUDBooster::myId(),
                        'created_at' => \DB::raw('NOW()')
                    ]);
                }
                else {
                    $existing = \DB::table('job_order_applicants')
                    ->where('job_order_id', $_REQUEST['job_order_id'])
                    ->where('candidate_id', $id)
                    ->update([
                        'primary_status' => 'Qualify',
                        'secondary_status' => 'Pending Review',
                        'next_action' => 'Qualify',
                        'created_at' => \DB::raw('NOW()'),
                        'updated_at' => \DB::raw('NOW()'),
                        'creator_id' => CRUDBooster::myId(),
                        'deleted_at' => null
                    ]);
                }
                DB::table('website_applications')->where('job_order_id', $_REQUEST['job_order_id'])->where('web_candidate_id',$_REQUEST['website_candidate_id'])->update(['status'=>'active']);
                CRUDBooster::redirect('/admin/view-applicants?job_order_id='.$_REQUEST['job_order_id'],"Candidate Added and Associated to the Job Order","success");
            }
        }           

    }

    public function addResume($_id,$_file) {

        $actualFile = $_file;
        $ext = pathinfo($actualFile, PATHINFO_EXTENSION);
        if($ext == "doc") {
            $content = $this->read_doc(public_path().$actualFile);
        } elseif($ext == "docx") {
            $content = $this->read_docx(public_path().$actualFile);
        } elseif($ext == "pdf") {
            include_once \public_path('pdf2text.php');      
            $content =  PdfParser::parseFile(public_path().$actualFile);
        } elseif($ext == "rtf") {
            include_once \public_path('rtf2text.php');
            $content =  rtf2text(public_path().$actualFile);
        }
        $resume = ltrim($actualFile, '/');
        $deleteOldData=DB::table('candidate_resumes')->where('candidate_id',$_id)->delete();
        $addResume = DB::table('candidate_resumes')->insert(
            [
                'resume_url' => $resume,
                'candidate_id' => $_id,
            ]);
//Insert Resume Content
        $content = $this->cleanString($content);
        $content =  trim(preg_replace('/\s+/',' ',$content));
        $content = addslashes($content);
        DB::table('candidates')->where('id',$_id)->update(['resume_content' => "$content"]);
    }

    public function cleanString($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-@.]/', ' ', $string); // Removes special chars.
        return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
    }

    public function candidateRegister()
    {   
        if($_REQUEST['current_action']== 'check_email') {
            $existingMail = DB::table('website_candidates')->where('primary_email', $_REQUEST['email'])->first();
            if($existingMail) {
                return 'true';
            }
            else {
                return 'false';
            }

        }
        if($_REQUEST['current_action']== 'check_candidate_email') {
            $existingMail = DB::table('website_candidates')->where('id','!=',$_REQUEST['id'])->where('primary_email', $_REQUEST['email'])->first();
            if($existingMail) {
                return 'true';
            }
            else {
                return 'false';
            }

        }
        if($_REQUEST['current_action']== 'check_email_key') {
            $existingCandidate = DB::table('website_candidates')->where('primary_email', $_REQUEST['email'])->where('key', $_REQUEST['key'])->first();
            if($existingCandidate) {
                return $existingCandidate->id;
            }
            else {
                return 'false';
            }

        }

        return view('override.front_end.candidate_exist_or_new');
    }

    public function addcandidateDetails(Request $request)
    { 
        $email = $request['email'];
        if($request['job_order_id'])
        {
            $jobOrderVacancy=DB::table('job_orders')->where('id',$request['job_order_id'])
            ->first();
            $openings=$jobOrderVacancy->openings_available;
            if($openings<=0){
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_apply_level', 'info');
                $request->session()->push('job_message_apply_content', 'No Openings Available! Register to add the details.');
                return redirect('/status-message');    
            }
        }
        $countries = DB::table('countries')->orderby('name','desc')->get();
        $states = DB::table('states')->orderby('name','desc')->get();
        $cities = DB::table('cities')->orderby('name','desc')->get();
        $postal_codes = DB::table('postal_codes')->orderby('name','desc')->get();
        $sources = DB::table('sources')->orderby('name','desc')->get();

        $industries = DB::table('industries')->orderby('name','asc')->get();
        $functional_areas = DB::table('industry_functional_areas')->orderby('name','asc')->get();
        $general_skills = DB::table('general_skills')->orderby('name','asc')->get();
        $qualification_levels = DB::table('qualification_levels')->orderby('qual_level','asc')->get();
        $qualifications = DB::table('qualifications')->orderby('qualification','asc')->get();
// List States
        if($_REQUEST['current_action']== 'list_states') {
            $states = DB::table('states')
            ->where('country_id', $_REQUEST['country_id'])
            ->orderby('name','desc')
            ->get();
            return $states;

        }

// List Cities
        if($_REQUEST['current_action']== 'list_cities') {
            $cities = DB::table('cities')
            ->where('state_id', $_REQUEST['state_id'])
            ->orderby('name','desc')
            ->get();
            return $cities;

        }

//List Functional Area Roles
        if($_REQUEST['current_action'] == 'list_functional_roles_skills') {
            $functional_area['roles'] = DB::table('industry_functional_area_roles')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            $functional_area['skills'] = DB::table('industry_functional_area_skills')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            return $functional_area;
        }

        if($_REQUEST['current_action'] == 'list_qualifications') {
            $qualifications = DB::table('qualifications')
            ->where('qualification_level_id', $_REQUEST['qualification_level_id'])
            ->orderby('qualification','desc')
            ->get();
            return $qualifications;
        }
        if($request['job_order_id'])
        {
            $job_order_id=$request['job_order_id'];
            return view('override.front_end.candidate_add',compact('email','countries','states','cities','postal_codes','industries','functional_areas','general_skills','qualification_levels','qualifications','sources','job_order_id'));

        }
        else{
            return view('override.front_end.candidate_add',compact('email','countries','states','cities','postal_codes','industries','functional_areas','general_skills','qualification_levels','qualifications','sources'));   
        }

    }

    public function editCandidateDetails(Request $request)
    { 

        if($request['job_order_id'])
        {
            $jobOrderVacancy=DB::table('job_orders')->where('id',$request['job_order_id'])
            ->first();
            $openings=$jobOrderVacancy->openings_available;
            if($openings<=0){
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'info');
                $request->session()->push('job_message_content', 'No Openings Available! Login to view/update the details.');
                return redirect('/status-message');    
            }
        }
        if($_REQUEST['id'])
        {
            $id = $_REQUEST['id'];    
        }
        else{
            $id = $request['id'];  
        }
        if(empty($id))
        {
            $request->session()->forget('job_message_level');
            $request->session()->forget('job_message_content');
            $request->session()->forget('job_message_apply_level');
            $request->session()->forget('job_message_apply_content');
            $request->session()->push('job_message_level', 'info');
            $request->session()->push('job_message_content', 'Login again to view the details.');
            return redirect('/status-message');
        }
        $row = DB::table('website_candidates')->where('id',$id)->first();
        $countries = DB::table('countries')->orderby('name','desc')->get();
        $states = DB::table('states')->where('country_id',$row->country_id)->orderby('name','desc')->get();
        $cities = DB::table('cities')->where('state_id',$row->state_id)->orderby('name','desc')->get();
        $allCities = DB::table('cities')->orderby('name','desc')->get();
        $postal_codes = DB::table('postal_codes')->orderby('name','desc')->get();       
        $industries = DB::table('industries')->get();
        $functional_areas = DB::table('industry_functional_areas')->get();
        $general_skills= DB::table('general_skills')->get();
        $qualification_levels = DB::table('qualification_levels')->get();
        $functional_area_roles = DB::table('industry_functional_area_roles')->get();            
        $functional_area_skills = DB::table('industry_functional_area_skills')
        ->get();
        $qualifications = DB::table('qualifications')->get();
// List States
        if($_REQUEST['current_action']== 'list_states') {
            $states = DB::table('states')
            ->where('country_id', $_REQUEST['country_id'])
            ->orderby('name','desc')
            ->get();
            return $states;
        }

// List Cities
        if($_REQUEST['current_action']== 'list_cities') {
            $cities = DB::table('cities')
            ->where('state_id', $_REQUEST['state_id'])
            ->orderby('name','desc')
            ->get();
            return $cities;
        }

//List Functional Area Roles
        if($_REQUEST['current_action'] == 'list_functional_roles_skills') {
            $functional_area['roles'] = DB::table('industry_functional_area_roles')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            $functional_area['skills'] = DB::table('industry_functional_area_skills')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            return $functional_area;
        }

        if($_REQUEST['current_action'] == 'list_qualifications') {
            $qualifications = DB::table('qualifications')
            ->where('qualification_level_id', $_REQUEST['qualification_level_id'])
            ->orderby('qualification','desc')
            ->get();
            return $qualifications;
        }   
        if($request['job_order_id'])
        {
            $job_order_id=$request['job_order_id'];
            return view('override.front_end.candidate_edit',compact('id','row','countries','states','cities','postal_codes', 'allCities','industries','functional_areas','general_skills','qualification_levels','qualifications','functional_area_skills','functional_area_roles','job_order_id'));

        }
        else{
            return view('override.front_end.candidate_edit',compact('id','row','countries','states','cities','postal_codes', 'allCities','industries','functional_areas','general_skills','qualification_levels','qualifications','functional_area_skills','functional_area_roles'));   
        }


    }

    public function updateApplyJoborder(Request $request)
    { 
        if($request->input('job_order_id')==null)
        {
            if(!empty($request->file('photo_url'))){
                $image_name = $request->file('photo_url')->getClientOriginalName();
                $ifilename =preg_replace('/\s+/', '_',$image_name);
                $image_filename='/images/'.$ifilename;
                $image_upload=$request->file('photo_url')->move(
                    public_path() . '/images/', $image_filename 
                );
            }
            else{
                $image_filename=$request['photo_url_hidden'];   
            }
            if(!empty($request->file('resume'))){
                $rname = $request->file('resume')->getClientOriginalName();
                $rfilename = preg_replace('/\s+/', '_', $rname);
                $rfilename='/resumes/'. $rfilename;
                $upload=$request->file('resume')->move(
                    public_path() . '/resumes/', $rfilename
                );
            }
            else{
                $rfilename= $request['resume_hidden'];
            }
            $result=\DB::table('website_candidates')
            ->where('id', $request['candidate_id'])
            ->update([
                'key' =>  $request['key'],
                'first_name'=> $request['first_name'], 
                'last_name'=> $request['last_name'], 
                'birth_date'=> $request['birth_date'],
                'gender'=> $request['gender'],
                'religion' =>  $request['religion'],
                'expected_ctc'=> $request['expected_ctc'], 
                'preferred_city'=> $request['preferred_city'], 
                'first_job_start_date'=> $request['first_job_start_date'],
                'highest_qualification'=> $request['highest_qualification'], 
                'head_line'=> $request['head_line'], 
                'experience_years'=> $request['experience_years'],
                'experience_months'=> $request['experience_months'],
                'current_ctc'=> $request['current_ctc'],
                'can_relocate'=> $request['can_relocate'],
                'current_employer'=> $request['current_employer'],
                'current_designation'=> $request['current_designation'], 
                'notice_period'=> $request['notice_period'],
                'current_city'=> $request['current_city'],
                'address'=> $request['address'],
                'country_id'=> $request['country_id'],
                'state_id'=> $request['state_id'],
                'city_id'=> $request['city_id'],
                'postal_code'=> $request['postal_code'],
                'primary_email'=> $request['primary_email'],
                'secondary_email'=> $request['secondary_email'],
                'primary_phone'=> $request['primary_phone'],
                'secondary_phone'=> $request['secondary_phone'],
                'photo_url'=> $image_filename ,
                'date_available'=> $request['date_available'],
                'web_site'=> $request['website'],
                'relationship_status'=> $request['relationship_status'],
                'general_skill'=> json_encode($request['general_skill_id']),
                'industry_id'=> json_encode($request['industry_id']),
                'industry_functional_area_id'=> json_encode($request['functional_area_id']),
                'industry_functional_area_role_id'=> json_encode($request['functional_area_role_id']),
                'industry_functional_area_skill_id'=>json_encode( $request['functional_area_skill_id']),
                'qualification_level_id'=> json_encode($request['qualification_level_id']),
                'qualification_id'=>json_encode($request['qualification_id']),
                'is_completed'=> json_encode($request['is_completed']),
                'completed_year'=> json_encode($request['completed_year']),
                'score'=>json_encode($request['score']),
                'updated_at' => \DB::raw('NOW()'),
                'update_status' => '0',
                'resume'=> $rfilename
               
            ]);

            if ($result==true) {
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'success');
                $request->session()->push('job_message_content', 'Details updated successfully! Login again to view the details.');
                return redirect('/status-message');
            } else {
                
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'danger');
                $request->session()->push('job_message_content', 'Details updated failed !');
                return redirect('/status-message');
            }
        }
        else{
            if(!empty($request->file('photo_url'))){
                $image_name = $request->file('photo_url')->getClientOriginalName();
                $ifilename =preg_replace('/\s+/', '_',$image_name);
                $image_filename='/images/'.$ifilename;
                $image_upload=$request->file('photo_url')->move(
                    public_path() . '/images/', $image_filename 
                );
            }
            else{
                $image_filename=$request['photo_url_hidden'];   
            }
            if(!empty($request->file('resume'))){
                $rname = $request->file('resume')->getClientOriginalName();
                $rfilename = preg_replace('/\s+/', '_', $rname);
                $rfilename='/resumes/'. $rfilename;
                $upload=$request->file('resume')->move(
                    public_path() . '/resumes/', $rfilename
                );
            }
            else{
                $rfilename= $request['resume_hidden'];
            }
            $result=\DB::table('website_candidates')
            ->where('id', $request['candidate_id'])
            ->update([
                'key' =>  $request['key'],
                'first_name'=> $request['first_name'], 
                'last_name'=> $request['last_name'], 
                'birth_date'=> $request['birth_date'],
                'gender'=> $request['gender'],
                'religion' =>  $request['religion'],
                'expected_ctc'=> $request['expected_ctc'], 
                'preferred_city'=> $request['preferred_city'], 
                'first_job_start_date'=> $request['first_job_start_date'],
                'highest_qualification'=> $request['highest_qualification'], 
                'head_line'=> $request['head_line'], 
                'experience_years'=> $request['experience_years'],
                'experience_months'=> $request['experience_months'],
                'current_ctc'=> $request['current_ctc'],
                'can_relocate'=> $request['can_relocate'],
                'current_employer'=> $request['current_employer'],
                'current_designation'=> $request['current_designation'],
                'notice_period'=> $request['notice_period'],
                'current_city'=> $request['current_city'],
                'address'=> $request['address'],
                'country_id'=> $request['country_id'],
                'state_id'=> $request['state_id'],
                'city_id'=> $request['city_id'],
                'postal_code'=> $request['postal_code'],
                'primary_email'=> $request['primary_email'],
                'secondary_email'=> $request['secondary_email'],
                'primary_phone'=> $request['primary_phone'],
                'secondary_phone'=> $request['secondary_phone'],
                'photo_url'=> $image_filename ,
                'date_available'=> $request['date_available'],
                'web_site'=> $request['website'],
                'relationship_status'=> $request['relationship_status'],
                'general_skill'=> json_encode($request['general_skill_id']),
                'industry_id'=> json_encode($request['industry_id']),
                'industry_functional_area_id'=> json_encode($request['functional_area_id']),
                'industry_functional_area_role_id'=> json_encode($request['functional_area_role_id']),
                'industry_functional_area_skill_id'=>json_encode( $request['functional_area_skill_id']),
                'qualification_level_id'=> json_encode($request['qualification_level_id']),
                'qualification_id'=>json_encode($request['qualification_id']),
                'is_completed'=> json_encode($request['is_completed']),
                'completed_year'=> json_encode($request['completed_year']),
                'score'=>json_encode($request['score']),
                'updated_at' => \DB::raw('NOW()'),
                'update_status' => '0',
                'resume'=> $rfilename
                
            ]);
            $title=\DB::table('job_orders')->find($request['job_order_id'])->title;
            $jobOrder=\DB::table('job_orders')->find($request['job_order_id']);
            $client= \DB::table('companies')->where('id', $jobOrder->company_id)->first()->name;
            $office= \DB::table('offices')->where('id', $jobOrder->office_id)->first();
            $cities=\DB::table('cities')->where('id', $office->city_id)->first();
            $job_location=$office->name.', '.$cities->name;  
            $openings= $jobOrder->openings_available; 
            $existingApplicant= \DB::table('website_applications')->where('web_candidate_id',$request['candidate_id'])->where('job_order_id',$request['job_order_id'])->first();
            if($existingApplicant)
            {   
                $request->session()->forget('job_message_level');
                $request->session()->forget('job_message_content');
                $request->session()->forget('job_message_apply_level');
                $request->session()->forget('job_message_apply_content');
                $request->session()->push('job_message_level', 'success');
                $request->session()->push('job_message_content', 'Job already applied! Login again to view the details.');
                return redirect('/status-message');
            }
            else{
                $result=\DB::table('website_applications')
                ->insert([
                    'web_candidate_id' =>$request['candidate_id'], 
                    'job_order_id' =>  $request['job_order_id'],
                    'title'=>  $title,
                    'client'=> $client,
                    'job_location'=> $job_location,
                    'openings'=> $openings,
                    'status' =>  'inactive',
                    'remove_status'=>'not-removed'  
                ]);
                if ($result==true) {
                    $request->session()->forget('job_message_level');
                    $request->session()->forget('job_message_content');
                    $request->session()->forget('job_message_apply_level');
                    $request->session()->forget('job_message_apply_content');
                    $request->session()->push('job_message_level', 'success');
                    $request->session()->push('job_message_content', 'Job applied successfully! Login again to view the details.');
                    return redirect('/status-message');
                } else {
                    $request->session()->forget('job_message_level');
                    $request->session()->forget('job_message_content');
                    $request->session()->forget('job_message_apply_level');
                    $request->session()->forget('job_message_apply_content');
                    $request->session()->push('job_message_level', 'danger');
                    $request->session()->push('job_message_content', 'Job apply failed !');
                    return redirect('/status-message');
                }
            }

        }
    }

    public function saveWebsiteCandidatesDetails()
    { 
        $request= \DB::table('website_candidates')->where('id',$_REQUEST['id'])->first();
        DB::table('website_candidates')->where('id',$_REQUEST['id'])->update(['update_status'=>'1']); 
        $existingMail = \DB::table('candidates')->where('primary_email',$request->primary_email)->first();
        date_default_timezone_set('Asia/Kolkata');      
        $date=date("Y-m-d H:i:s");
        if(!empty($existingMail)) {
            $id=$existingMail->id;
            $highest_qualification_level= DB::table('qualifications')->find($request->highest_qualification)->qualification_level_id;
            $existCandidateUpdates=\DB::table('candidates')->where('id', $id)->update([
                'first_name'=> $request->first_name, 
                'last_name'=> $request->last_name, 
                'birth_date'=> $request->birth_date,
                'gender'=> $request->gender,
                'religion' =>  $request->religion,
                'expected_ctc'=> $request->expected_ctc, 
                'preferred_city'=> $request->preferred_city, 
                'first_job_start_date'=> $request->first_job_start_date,
                'highest_qualification'=> $request->highest_qualification,
                'highest_qualification_level'=> $highest_qualification_level, 
                'head_line'=> $request->head_line, 
                'experience_years'=> $request->experience_years,
                'experience_months'=> $request->experience_months,
                'current_ctc'=> $request->current_ctc,
                'can_relocate'=> $request->can_relocate,
                'current_employer'=> $request->current_employer,
                'current_designation'=> $request->current_designation,
                'current_city'=> $request->current_city,
                'address'=> $request->address,
                'country_id'=> $request->country_id,
                'state_id'=> $request->state_id,
                'city_id'=> $request->city_id,
                'postal_code'=> $request->postal_code,
                'primary_email'=> $request->primary_email,
                'secondary_email'=> $request->secondary_email,
                'primary_phone'=> $request->primary_phone,
                'secondary_phone'=> $request->secondary_phone,
                'photo_url'=>  ltrim($request->photo_url, '/'),
                'date_available'=> $request->date_available,
                'web_site'=> $request->web_site,
                'relationship_status'=> $request->relationship_status,
                'updated_at' =>\DB::raw('NOW()'),
                'creator_id' => CRUDBooster::myId() 

            ]);
            $this->addResume($id,$request->resume);
            DB::table('candidate_industries')->where('candidate_id',$id)->delete();
            DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->delete();
            DB::table('candidate_general_skills')->where('candidate_id',$id)->delete();
            DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$id)->delete();
            DB::table('candidate_qualifications')->where('candidate_id',$id)->delete();
            DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->delete();

            $industries = DB::table('industries')->WhereIn('id',json_decode($request->industry_id, true))->get();
            foreach ($industries as $industry) {
                DB::table('candidate_industries')->insert([
                    'candidate_id' => $id,
                    'industry_id' => $industry->id,
                    'industry' => $industry->name
                ]);
            }
            $roles=DB::table('industry_functional_area_roles')->WhereIn('id',json_decode($request->industry_functional_area_role_id, true))->get();
            foreach ($roles as $role) {
                DB::table('candidate_industry_functional_area_roles')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_role_id' => $role->id,
                    'role' => $role->name
                ]);
            }
            $areas=DB::table('industry_functional_areas')->WhereIn('id',json_decode($request->industry_functional_area_id, true))->get();
            foreach ($areas as  $area) {
                DB::table('candidate_industry_functional_areas')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_id' =>$area->id,
                    'industry_functional_area' => $area->name
                ]);
            }
            $skills=DB::table('industry_functional_area_skills')->WhereIn('id',json_decode($request->industry_functional_area_skill_id, true))->get();
            foreach ($skills as $skill) {
                DB::table('candidate_industry_functional_area_skills')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_skill_id' =>$skill->id,
                    'industry_functional_area_skill' => $skill->name
                ]);
            }
            $general_skills=DB::table('general_skills')->WhereIn('id',json_decode($request->general_skill, true))->get();
            foreach ($general_skills as $general_skill) {
                DB::table('candidate_general_skills')->insert(['candidate_id' => $id,
                    'general_skill' => $general_skill->id
                ]);
            }
            $qualification_levels=json_decode($request->qualification_level_id);
            $qualifications=json_decode($request->qualification_id);
            $is_completed=json_decode($request->is_completed);
            $years=json_decode($request->completed_year);
            $scores=json_decode($request->score);
            $i=0;
            foreach($qualification_levels as $qualification_level)
            {
                DB::table('candidate_qualifications')->insert(['candidate_id' => $id,
                    'qualification_id' =>$qualifications[$i] ,
                    'qualification_level_id' =>$qualification_levels[$i],
                    'is_completed' =>(empty($is_completed[$i])) ? '0' : $is_completed[$i],
                    'completed_year' =>$years[$i] ,
                    'score' =>$scores[$i] ,
                    'qualification' =>DB::table('qualifications')->find($qualifications[$i])->qualification,
                    'qualification_level' =>DB::table('qualification_levels')->find($qualification_levels[$i])->qual_level
                ]);
                $i++;
            }
            if($existCandidateUpdates>=0){
                CRUDBooster::redirect('admin/website_candidates',"Details Sucessfully Updated.","success");
            } 
        }  
        else {
            $highest_qualification_level= DB::table('qualifications')->find($request->highest_qualification)->qualification_level_id;
            $newCandidateInsert=\DB::table('candidates')->insertGetId([
                'first_name'=> $request->first_name, 
                'last_name'=> $request->last_name, 
                'birth_date'=> $request->birth_date,
                'gender'=> $request->gender,
                'religion' =>  $request->religion,
                'expected_ctc'=> $request->expected_ctc, 
                'preferred_city'=> $request->preferred_city, 
                'first_job_start_date'=> $request->first_job_start_date,
                'highest_qualification'=> $request->highest_qualification,
                'highest_qualification_level'=> $highest_qualification_level, 
                'head_line'=> $request->head_line, 
                'experience_years'=> $request->experience_years,
                'experience_months'=> $request->experience_months,
                'current_ctc'=> $request->current_ctc,
                'can_relocate'=> $request->can_relocate,
                'current_employer'=> $request->current_employer,
                'current_designation'=> $request->current_designation,
                'current_city'=> $request->current_city,
                'address'=> $request->address,
                'country_id'=> $request->country_id,
                'state_id'=> $request->state_id,
                'city_id'=> $request->city_id,
                'postal_code'=> $request->postal_code,
                'primary_email'=> $request->primary_email,
                'secondary_email'=> $request->secondary_email,
                'primary_phone'=> $request->primary_phone,
                'secondary_phone'=> $request->secondary_phone,
                'photo_url'=>  ltrim($request->photo_url, '/'),
                'date_available'=> $request->date_available,
                
                'web_site'=> $request->web_site,
                'relationship_status'=> $request->relationship_status,
                'created_at' => \DB::raw('NOW()'),
                'updated_at' => \DB::raw('NOW()'),
                'creator_id' => CRUDBooster::myId()
            ]);
            
            $id=$newCandidateInsert;
            // update-set
            $candidateCreated = DB::table('candidates')->select('created_at')->where('id', $id)->first();
            //dd($candidateCreated);
            //DB::table('candidates')->where('id',$id)->update(['updated_at' => $candidateCreated]);
            $this->addResume($id,$request->resume);
            $industries = DB::table('industries')->WhereIn('id',json_decode($request->industry_id, true))->get();
            foreach ($industries as $industry) {
                DB::table('candidate_industries')->insert([
                    'candidate_id' => $id,
                    'industry_id' => $industry->id,
                    'industry' => $industry->name
                ]);
            }
            $roles=DB::table('industry_functional_area_roles')->WhereIn('id',json_decode($request->industry_functional_area_role_id, true))->get();
            foreach ($roles as $role) {
                DB::table('candidate_industry_functional_area_roles')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_role_id' => $role->id,
                    'role' => $role->name
                ]);
            }
            $areas=DB::table('industry_functional_areas')->WhereIn('id',json_decode($request->industry_functional_area_id, true))->get();
            foreach ($areas as  $area) {
                DB::table('candidate_industry_functional_areas')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_id' =>$area->id,
                    'industry_functional_area' => $area->name
                ]);
            }
            $skills=DB::table('industry_functional_area_skills')->WhereIn('id',json_decode($request->industry_functional_area_skill_id, true))->get();
            foreach ($skills as $skill) {
                DB::table('candidate_industry_functional_area_skills')->insert([
                    'candidate_id' => $id,
                    'industry_functional_area_skill_id' =>$skill->id,
                    'industry_functional_area_skill' => $skill->name
                ]);
            }
            $general_skills=DB::table('general_skills')->WhereIn('id',json_decode($request->general_skill, true))->get();
            foreach ($general_skills as $general_skill) {
                DB::table('candidate_general_skills')->insert(['candidate_id' => $id,
                    'general_skill' => $general_skill->id
                ]);
            }
            $qualification_levels=json_decode($request->qualification_level_id);
            $qualifications=json_decode($request->qualification_id);
            $is_completed=json_decode($request->is_completed);
            $years=json_decode($request->completed_year);
            $scores=json_decode($request->score);
            $i=0;
            foreach($qualification_levels as $qualification_level)
            {
                DB::table('candidate_qualifications')->insert(['candidate_id' => $id,
                    'qualification_id' =>$qualifications[$i] ,
                    'qualification_level_id' =>$qualification_levels[$i],
                    'is_completed' =>(empty($is_completed[$i])) ? '0' : $is_completed[$i],
                    'completed_year' =>$years[$i] ,
                    'score' =>$scores[$i] ,
                    'qualification' =>DB::table('qualifications')->find($qualifications[$i])->qualification,
                    'qualification_level' =>DB::table('qualification_levels')->find($qualification_levels[$i])->qual_level
                ]);
                $i++;
            }

            if($id){
                CRUDBooster::redirect('admin/website_candidates',"New Candidate Successfully Created.","success");
            } else{
                CRUDBooster::redirect('admin/website_candidates',"New Candidate Successfully Not Created.","warning");
            }

        }     

    }

    public function loginAgain(Request $request) {
       
        return view('override.front_end.alert');
    }

    public function sendForgetKey() {
        if($_REQUEST['current_action']== 'send_key') {
            $existingEmail= DB::table('website_candidates')
            ->where('primary_email',$_REQUEST['email_id'])->first();
            if($existingEmail)
            {
                $template = DB::table('cms_email_templates')
                ->where('slug','forgot_key')->first(); 
                $slug=$template->slug;
                $data['email'] =  $_REQUEST['email_id'] ;
                $randomKey=$this->random_string(8);
                $data['password']  =$randomKey;
//$data['regards_name'] = CRUDBooster::myName();
                $keyReset=DB::table('website_candidates')->where('primary_email',$_REQUEST['email_id'])->update(['key'=>$randomKey]);
                //$mailSend = CRUDBooster::sendEmail(['to'=>'shajeeb@stacktreestudios.com','data'=>$data,'template'=>$slug,'attachments'=>[]]);
                $mailSend = CRUDBooster::sendEmail(['to'=>$_REQUEST['email_id'],'data'=>$data,'template'=>$slug,'attachments'=>[]]);
                if($keyReset){
                    return "OK";
                }
            }
            else{
                return "notExist";  
            }
        }
    }

    public function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
    public function candidate_email_sending()
    {
        // SEND EMAIL TO CANDIDATE - TODO
        if($_REQUEST['current_action']== 'email_to_candidate') {
            $candidate = DB::table('candidates')->find($_REQUEST['candidate_id']);
            $slug=$_REQUEST['email_template_id'];
            $data['candidate_name'] = $candidate->first_name. ' ' .$candidate->last_name ;
            if(!empty($_REQUEST['job_order_id']))
            {
                $job_order_details = DB::table('job_order_applicants')   
                                        ->where('job_order_applicants.candidate_id',$_REQUEST['candidate_id'])
                                        ->where('job_order_applicants.job_order_id',$_REQUEST['job_order_id'])
                                        ->whereNull('job_order_applicants.deleted_at')
                                        ->first();
            $job_orders = DB::table('job_orders')
                            ->where('job_orders.id',$_REQUEST['job_order_id'])
                            ->first();
            $contacts=DB::table('contacts')
                        ->where('contacts.company_id', $job_orders->company_id)
                        ->first();
            $companies= DB::table('companies')
                        ->where('companies.id', $job_orders->company_id)
                        ->first();
            $office= \DB::table('offices')->where('id',$job_orders->office_id)->first();
            $cities=\DB::table('cities')->where('id', $office->city_id)->first();
            $job_location=$office->name.', '.$cities->name;
            $data['contact']=$_REQUEST['contact']; 
            $data['mode_of_interview']=$_REQUEST['interview_mode']; 
            $data['venue']=$_REQUEST['venue']; 
            $data['job_order_name']=$job_orders->title;
            $data['company']= $companies->name;
            $data['company_address']=$companies->address;
            if(!empty($contacts->phone_work))
            {
            $data['owner_contact_number']=$contacts->phone_work;
            $data['company_contact_number']=$contacts->phone_work;   
            }
            else{
            $data['owner_contact_number']='Nil';
            $data['company_contact_number']='Nil';     
            }
            $data['owner_name']=$contacts->first_name.' '.$contacts->last_name;
            $data['position']=$contacts->title;
            $data['website']=$companies->web_site;
            $data['job_description']=$job_orders->description;
            $industries = DB::table('industries')->where('id', $job_orders->industry)->first();
            if(!empty($job_orders->industry)){
              $data['job_industry'] = $industries->name; 
            }else{
              $data['job_industry']=' ';
            }       
            $functionalAreas = DB::table('industry_functional_areas')
                                ->select('industry_functional_areas.*','job_order_industry_functional_areas.*')
                                ->join('job_order_industry_functional_areas','job_order_industry_functional_areas.industry_functional_area','=','industry_functional_areas.id')
                                ->where('job_order_industry_functional_areas.job_order_id',$_REQUEST['job_order_id'])
                                ->get();
            $job_area=' ';
            foreach($functionalAreas as $functionalArea){
                       
                $job_area.=' '.$functionalArea->name.",";

            }
            if(!empty($functionalAreas)){
              $data['job_area'] = rtrim($job_area,','); 
            }else{
              $data['job_area']=' ';
            } 
            $functional_area_role = DB::table('industry_functional_area_roles')->where('id', $job_orders->functional_area_role_id )->first();
            if(!empty($job_orders->functional_area_role_id)){
              $data['job_role'] = $functional_area_role->name; 
            }else{
              $data['job_role']=' ';
            }
            $functionalAreasSkills = DB::table('industry_functional_area_skills')
                                ->select('industry_functional_area_skills.*','job_order_industry_functional_area_skills.*')
                                ->join('job_order_industry_functional_area_skills','job_order_industry_functional_area_skills.industry_functional_area_skill','=','industry_functional_area_skills.id')
                                ->where('job_order_industry_functional_area_skills.job_order_id',$_REQUEST['job_order_id'])
                                ->get();
            $job_area_skills=' ';
            foreach($functionalAreasSkills as $functionalAreasSkill){
                       
                $job_area_skills.=' '.$functionalAreasSkill->name.",";

            }
            if(!empty($functionalAreasSkills)){
              $data['job_role_category'] = rtrim(rtrim($job_area_skills,','),','); 
            }else{
              $data['job_role_category']=' ';
            }
            $recruiter_name=DB::table('cms_users')->find($job_orders->recruiter)->name;
            $data['recruiter_name']=$recruiter_name;
            $data['location']= $job_location;
            if(!empty($job_order_details->interview_date))
            {
            $data['interview_date']=date("l, dS F, Y", strtotime($job_order_details->interview_date));
            }
            else{
             $data['interview_date']=' ';
            }
            $prev_interview_date= \DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$job_order_details->id)->where('new_primary_status','Interview')->whereIn('new_secondary_status',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round'])->orderBy('id', 'desc')->first();
          
            if(!empty($prev_interview_date->new_interview_date)&&($prev_interview_date->new_interview_date!='0000-00-00')){ 
                
              $data['time']= date("h:i A", strtotime($prev_interview_date->new_interview_date)); 
            }
            else{
              $data['time']= ' ';   
            } 
           
            if(!empty($job_order_details->interview_date)&&($prev_joining_date->prev_joining_date!='0000-00-00'))
            {
            $data['interview_time']=date("h:i: A", strtotime($job_order_details->interview_date));
            }
            else{
            $data['interview_time']=' ';
            }
            if(!empty($job_order_details->joining_date)&&($job_order_details->joining_date!='0000-00-00'))
            {
            $data['joining_date']=date("d/m/Y", strtotime($job_order_details->joining_date));
            }
            else{
            $data['joining_date']=' ';
            }
            
            }
            if($slug=='mail_to_candidate') 
            {
            $data['content']=$_REQUEST['comment']; 
            $data['subject']=$_REQUEST['subject'];  
            }
            else{
            $data['regards_name'] = CRUDBooster::myName();  
            }
            $from_name = CRUDBooster::myName();
            $from_email = CRUDBooster::me()->email; // from_mail@mail.com
            //$subject = 'Offer Letter - '.$candidate->first_name. ' ' .$candidate->last_name ;
            // inv@connecting2work.com  // 'from_email'=>$from_email,'from_name'=>$from_name,
            // CRUDBooster::sendEmail(['to'=>$candidate->primary_email,'data'=>$mail_content,'template'=>$template->slug,'attachments'=>[]])
            //$mailSend = CRUDBooster::sendEmail(['to'=>'shajeeb@stacktreestudios.com','data'=>$data,'template'=>$slug,'attachments'=>[]]);
             //return $data; 
            $mailSend = CRUDBooster::sendEmail(['to'=>$candidate->primary_email,'data'=>$data,'template'=>$slug,'attachments'=>[]]);
            return 'OK'; 
           

        }

        // GET EMAIL CONTENT
        if($_REQUEST['current_action']== 'get_email_content') {
          $template = DB::table('cms_email_templates')
            ->where('slug',$_REQUEST['email_template_id'])->first()->content;

            $candidate = DB::table('candidates')->find($_REQUEST['candidate_id']);

            $job_order_details = DB::table('job_order_applicants')   
                                        ->where('job_order_applicants.candidate_id',$_REQUEST['candidate_id'])
                                        ->where('job_order_applicants.job_order_id',$_REQUEST['job_order_id'])
                                        ->whereNull('job_order_applicants.deleted_at')
                                        ->first();
                                          
            if($candidate) {
                $template = str_replace('[candidate_name]', $candidate->first_name.' '.$candidate->last_name, $template);   
            }
            $template = str_replace('[candidate_name]', 'Candidate', $template);
            $job_orders = DB::table('job_orders')
                            ->where('job_orders.id',$_REQUEST['job_order_id'])
                            ->first();
            $template = str_replace('[job_order_name]',$job_orders->title, $template);
    
            $contacts=DB::table('contacts')
                        ->where('contacts.company_id', $job_orders->company_id)
                        ->first();
            $companies= DB::table('companies')
                        ->where('companies.id', $job_orders->company_id)
                        ->first();
            $office= \DB::table('offices')->where('id',$job_orders->office_id)->first();

            $template = str_replace('[company]',$companies->name, $template);

            if(!empty($companies->address))
            {
            $template = str_replace('[company_address]',$companies->address, $template);
            }
            else{
            $template = str_replace('[company_address]',' ', $template);  
            }
            if(!empty($contacts->phone_work)){
              $template = str_replace('[company_contact_number]',$contacts->phone_work, $template);
            }
            else{
              $template = str_replace('[company_contact_number]',' ', $template);   
            }

            if(!empty($contacts->first_name)||!empty($contacts->last_name))
            {
            $template = str_replace('[owner_name]',$contacts->first_name.' '.$contacts->last_name, $template);
            }
            else{
             $template = str_replace('[owner_name]',' ', $template);   
            }

            if(!empty($contacts->phone_work))
            {
            $template = str_replace('[owner_contact_number]',$contacts->phone_work, $template);
            }
            else{
             $template = str_replace('[owner_contact_number]',' ', $template);   
            }

            if(!empty($contacts->title))
            {
            $template = str_replace('[position]',$contacts->title, $template);
            }
            else{
             $template = str_replace('[position]',' ', $template);   
            }

            if(!empty($companies->web_site))
            {
            $template = str_replace('[website]',$companies->web_site, $template);
            }
            else{
             $template = str_replace('[website]',' ', $template);   
            }

            if(!empty($job_orders->description))
            {
            $template = str_replace('[job_description]',$job_orders->description, $template);
            }
            else{
             $template = str_replace('[job_description]',' ', $template);   
            }

            $industries = DB::table('industries')->where('id', $job_orders->industry)->first();
             if(!empty($industries)){
              $template = str_replace('[job_industry]',$industries->name, $template); 
            }else{
              $template = str_replace('[job_industry]',' ', $template);
            } 

            $template=str_replace('[venue]','<p style="margin-top: 0.07in; margin-bottom: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif" size="2">&nbsp;'.$companies->name.'</font></p><p id="company_address" style="margin-top: 0.07in; margin-bottom: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif" size="2">&nbsp;'.$companies->address.'</font></p><p id="company_contact_number" style="margin-top: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif"><font size="2"><u>&nbsp;<a href="tel:+91">Tel:+91</a></u></font></font><font face="Calibri, serif"><font size="2">&nbsp;'.$contacts->phone_work.'</font></font></p>',$template);

            $template=str_replace('[contact]','<p style="margin-top: 0.07in; margin-bottom: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif"><font size="2">&nbsp;'.$contacts->first_name.' '.$contacts->last_name.'</font></font></p><p><font face="Calibri, serif"><font size="2">&nbsp;'.$contacts->title.'</font></font></p><p><font face="Calibri, serif"><font size="2">&nbsp;'.$companies->name.'</font></font></p><p><font face="Calibri, serif"><font size="2">&nbsp;Contact Number : '.$contacts->phone_work.' </font></font></p>',$template);

            $functionalAreas = DB::table('industry_functional_areas')
                                ->select('industry_functional_areas.*','job_order_industry_functional_areas.*')
                                ->join('job_order_industry_functional_areas','job_order_industry_functional_areas.industry_functional_area','=','industry_functional_areas.id')
                                ->where('job_order_industry_functional_areas.job_order_id',$_REQUEST['job_order_id'])
                                ->get();
            $job_area=' ';
            foreach($functionalAreas as $functionalArea){
                       
                $job_area.=' '.$functionalArea->name.",";

            }
            if(!empty($functionalAreas)){
              $template = str_replace('[job_area]',rtrim($job_area,','), $template); 
            }else{
               $template = str_replace('[job_area]',' ', $template); 
            }
           
            $functional_area_role = DB::table('industry_functional_area_roles')->where('id', $job_orders->functional_area_role_id )->first();
            if(!empty($job_orders->functional_area_role_id)){
              $template = str_replace('[job_role]',$functional_area_role->name, $template); 
            }else{
              $template = str_replace('[job_role]',' ', $template);
            }
            $functionalAreasSkills = DB::table('industry_functional_area_skills')
                                ->select('industry_functional_area_skills.*','job_order_industry_functional_area_skills.*')
                                ->join('job_order_industry_functional_area_skills','job_order_industry_functional_area_skills.industry_functional_area_skill','=','industry_functional_area_skills.id')
                                ->where('job_order_industry_functional_area_skills.job_order_id',$_REQUEST['job_order_id'])
                                ->get();
            $job_area_skills=' ';
            foreach($functionalAreasSkills as $functionalAreasSkill){
                       
                $job_area_skills.=' '.$functionalAreasSkill->name.",";

            }
            if(!empty($functionalAreasSkills)){
              $template = str_replace('[job_role_category]',rtrim($job_area_skills,','), $template); 
            }else{
               $template = str_replace('[job_role_category]',' ', $template); 
            }
            if(!empty($job_orders->recruiter))
            {
            $recruiter_name=DB::table('cms_users')->find($job_orders->recruiter)->name;
            if(!empty($recruiter_name)){
            $template = str_replace('[recruiter_name]',$recruiter_name, $template);
            }
            }
            else{
            $template = str_replace('[recruiter_name]',' ', $template);   
            }

            $cities=\DB::table('cities')->where('id', $office->city_id)->first();
            $job_location=$office->name.', '.$cities->name;
            if(!empty($job_location)){
            $template = str_replace('[location]',$job_location, $template);
            }
            else{
            $template = str_replace('[location]',' ', $template);   
            }
            if(!empty($job_order_details->interview_date))
            {
            $template = str_replace('[interview_date]',date("l, dS F, Y", strtotime($job_order_details->interview_date)), $template);
            $template = str_replace('[interview_time]',date("h:i A", strtotime($job_order_details->interview_date)), $template);  
            }
            else{
            $template = str_replace('[interview_date]',' ', $template);
            $template = str_replace('[interview_time]',' ', $template);    
            }

            $prev_interview_date= \DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$job_order_details->id)->where('new_primary_status','Interview')->whereIn('new_secondary_status',['Interview Scheduled','Interview Rescheduled','Shortlisted for Next Round'])->orderBy('id', 'desc')->first();
          
            if(!empty($prev_interview_date->new_interview_date)&&($prev_interview_date->new_interview_date!='0000-00-00')){ 
                
                $template = str_replace('[time]',date("h:i A",strtotime($prev_interview_date->new_interview_date)), $template); 
            }
            else{
                $template = str_replace('[time]',' ', $template);   
            } 
            
            if(!empty($job_order_details->joining_date)&&($job_order_details->joining_date!='0000-00-00')){ 
               $template = str_replace('[joining_date]',date("d/m/Y", strtotime($job_order_details->joining_date)), $template);
            }
            else{
              $template = str_replace('[joining_date]',' ', $template);   
            }               
            $template = str_replace('[your_name]', \CRUDBooster::myName(), $template);
            $template = str_replace('[regards_name]', \CRUDBooster::myName(), $template);
            return $template;  

        }
    }

    
    public function updateEventJobCandOwnNames($_type,$_id)
    {

        $dbQuery = \DB::table('events');
        if($_type == 'job_order'){
            
            $jobOrderName = \DB::table('job_orders')->where('id',$_id)->first()->title;

            $dbQuery = $dbQuery->where('job_order_id',$_id)
                        ->update(['job_order_name' => $jobOrderName]);
        }
        if($_type == 'candidate'){

            $candidateName = \DB::table('candidates')->where('id',$_id)->first();

            $dbQuery = $dbQuery->where('candidate_id',$_id)
                        ->update(['candidate_name' => $candidateName->first_name." ".$candidateName->last_name]);
        }
        if($_type == 'owner'){

            $ownerName = \DB::table('cms_users')->where('id',$_id)->first()->name;

            $dbQuery = $dbQuery->where('owner_id',$_id)
                        ->update(['owner_name' => $ownerName]);
        }
        if($_type == 'company'){

            $jobOrders = \DB::table('job_orders')->where('company_id',$_id)->get();

            $jobOrderIds = [];
            if($jobOrders){
                foreach ($jobOrders as $jobOrder) {
                    $jobOrderIds[] = $jobOrder->id;
                }
            }

            $company = \DB::table('companies')->where('id',$_id)->first();

            $dbQuery = $dbQuery->whereIn('job_order_id',$jobOrderIds)
                        ->update(['company_name' => $company->name]);
    
        }

        return true;
    }

    public function updateEventNames()
    {
        $joborders = \DB::table('events')->select('job_order_id')->distinct()->get();
        if($joborders){
            foreach ($joborders as $joborder) {
                $this->updateEventJobCandOwnNames('job_order',$joborder->job_order_id);
            }
        }
        $candidates = \DB::table('events')->select('candidate_id')->distinct()->get();
        foreach ($candidates as $candidate) {
            if($candidate->candidate_id){
                $this->updateEventJobCandOwnNames('candidate',$candidate->candidate_id);
            }
        }
        $owners = \DB::table('events')->select('owner_id')->distinct()->get();
        if($owners){
            foreach ($owners as $owner) {
                $this->updateEventJobCandOwnNames('owner',$owner->owner_id);
            }
        }
        $joborders = \DB::table('events')->select('job_order_id')->distinct()->get();
        if($joborders){
            foreach ($joborders as $joborder) {
                $job_order = \DB::table('job_orders')->where('id',$joborder->job_order_id)->first();
                $this->updateEventJobCandOwnNames('company',$job_order->company_id);
            }
        }
    }

    public function getCandidateDetailsForEmail(Request $request) {
        $data = \DB::table('job_order_applicants')
            ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id')
            ->join('candidates', 'candidates.id', '=', 'job_order_applicants.candidate_id')
            ->select('job_order_applicants.*','job_orders.*', 'candidates.*')
            ->where('job_order_applicants.id',$request->input('candidate_applicant_id'))
            ->get();

        return $data;
    }

    public function getBulkCandidateStatusChange(Request $request) {  
        $applicants=$request->input('applicant_ids');
        $applicant_status=[];
        $next_action=$request->input('next_action');
        foreach($applicants as $applicant_id){
            $details=\DB::table('job_order_applicants')->where('job_order_applicants.id',$applicant_id)
                        ->first();
            if($details->next_action==$next_action){
            $applicant_status[]='Equal';
            }
            else{
                $applicant_status[]='Unequal';   
            }
        }
        return $applicant_status;
    }
    
    public function getJobOrderCount($_status)
    {
        $orders = \DB::table('job_orders')->where('status',$_status)->count();
        return $orders;
    }

    public function getjobOrderStatusForReports()
    {
        
        $data['new'] = $this->getJobOrderCount('New');
        $data['intro_call_scheduled'] = $this->getJobOrderCount('Intro Call Scheduled');
        $data['hiring_in_progress'] = $this->getJobOrderCount('Hiring In Progress');
        $data['on_hold'] = $this->getJobOrderCount('On Hold');
        $data['cancelled'] = $this->getJobOrderCount('Cancelled');
        $data['completed'] = $this->getJobOrderCount('Completed');

        return json_encode($data);
 
    }

    public function pendingEventsListCsvView () { // $_events,$_owners

        $pendEvents = $this->getPendingEvents('csv_export');
        $events = $pendEvents['events'];
        $owners = $pendEvents['owners'];

        $filePath = public_path(). "/reports/";
        $filename = $filePath. "Pending Events List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Pending Events List'));
        fputcsv($handle, array('Sl No.', 'Events','Company','Joborder','Candidate','Date','Next Action','Owner'));

        $i = 1;
        foreach($events as $event){
             $candidate = '';
            if(!empty($event->candidate)){
                $candidate = $event->candidate->first_name.' '.$event->candidate->last_name;
            }
            if(!empty($event->job_order_applicant)){
                if(($event->job_order_applicant->next_action != " ") || ($event->job_order_applicant->next_action != '-')){
                    $next_action = $event->job_order_applicant->next_action;
                }
                else{
                    $next_action = '-';
                }
                if($event->job_order_applicant->callback_date){
                    $next_action .= ", Call back on ".date("d/m/Y", strtotime($event->job_order_applicant->callback_date));
                }
                if($event->job_order_applicant->feedback_date){
                    $next_action .= ", Feedback on ".date("d/m/Y", strtotime($event->job_order_applicant->feedback_date));
                 }
                if($event->job_order_applicant->scheduled_interview_date){
                    $next_action .= ", Set interview on ".date("d/m/Y", strtotime($event->job_order_applicant->scheduled_interview_date));
                }
                if($event->job_order_applicant->scheduled_feedback_date){
                    $next_action .= ", Rescheduled for ".date("d/m/Y", strtotime($event->job_order_applicant->scheduled_feedback_date));
                }
                if($event->job_order_applicant->interview_reschedule_date){
                    $next_action .= ", Interview feedback rescheduled for ".date("d/m/Y", strtotime($event->job_order_applicant->interview_reschedule_date));
                }
                if($event->job_order_applicant->interview_date){
                    $next_action .= ", Interview round: ".$event->job_order_applicant->interview_round.", ";
                    $next_action .= " Interview on ".date("d/m/Y H:i:s A", strtotime($event->job_order_applicant->interview_date));
                }
                if($event->job_order_applicant->interview_followup_date){
                    $next_action .= ", Follow up on ".date("d/m/Y", strtotime($event->job_order_applicant->interview_followup_date));
                }
                if($event->job_order_applicant->confirm_offer_followup_date){
                    $next_action .= ", Follow up on ".date("d/m/Y", strtotime($event->job_order_applicant->confirm_offer_followup_date));
                }
                if($event->job_order_applicant->offer_confirmation_date){
                    $next_action .= ", Confirm on ".date("d/m/Y", strtotime($event->job_order_applicant->offer_confirmation_date));
                }
                if($event->job_order_applicant->joining_date){
                    $next_action .= ", Joining on ".date("d/m/Y", strtotime($event->job_order_applicant->joining_date));
                }
            }
            else{
                if($event->type==='Intro Call'&& $event->job_order->status==='Intro Call Scheduled'){
                    $next_action = "Submission";
                }
                if($event->type==='Submission'||$event->type==='Job Order Re-submission'|| $event->type==='Job Order Follow-up'&& $event->job_order->status==='Hiring In Progress'){

                    $resubmission_followup = DB::table('job_order_submission_history')
                    ->where('job_order_id', $event->job_order->id)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->first();
                    $pending_event=0;
                    if($resubmission_followup->submission_status == SUBMISSION_RESUBMISSION){
                        $submissionType = 'Re-submission';
                    }
                    elseif($resubmission_followup->submission_status == SUBMISSION_FOLLOW_UP){
                        $submissionType = 'Follow-up' ;
                    }
                    elseif($resubmission_followup->submission_status =='Submission'){
                        $submissionType = 'Submission' ;
                    }

                    if(($resubmission_followup) && ($resubmission_followup->submission_status != 'Submission')){
                        $next_action = $submissionType ." Date = ".$resubmission_followup->date;
                        $next_action .= ", Resubmission/Follow-Up Date";
                    }
                }
            }
            $owner = $event->owner;
            // $i, $event->type, $event->company->name , $event->job_order->title, $candidate, $event->event_date, $next_action, $owner

            fputcsv($handle, array($i++, $event->type, $event->company->name , $event->job_order->title, $candidate, $event->event_date, $next_action, $owner));
        }          
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Pending Events List.csv',$headers);
        ob_end_clean();
        return $response;
    }


    public function pendingJoborderEventsListCsvView () { // $_events,$_owners

        $pendEvents = $this->getPendingJoborderEvents('csv_export');
        $events = $pendEvents['events'];
        $owners = $pendEvents['owners'];

        $filePath = public_path(). "/reports/";
        $filename = $filePath. "Pending Joborder Events List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Pending Joborder Events List'));
        fputcsv($handle, array('Sl No.', 'Events','Company','Joborder','Date','Next Action','Owner'));

        $i = 1;
        foreach($events as $event){
           
                if($event->type==='Intro Call'&& $event->job_order->status==='Intro Call Scheduled'){
                    $next_action = "Submission";
                }
                if($event->type==='Submission'||$event->type==='Job Order Re-submission'|| $event->type==='Job Order Follow-up'&& $event->job_order->status==='Hiring In Progress'){

                    $resubmission_followup = DB::table('job_order_submission_history')
                    ->where('job_order_id', $event->job_order->id)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->first();
                  
                    if($resubmission_followup->submission_status == SUBMISSION_RESUBMISSION){
                        $submissionType = 'Re-submission';
                    }
                    elseif($resubmission_followup->submission_status == SUBMISSION_FOLLOW_UP){
                        $submissionType = 'Follow-up' ;
                    }
                    elseif($resubmission_followup->submission_status =='Submission'){
                        $submissionType = 'Submission' ;
                    }

                    if(($resubmission_followup) && ($resubmission_followup->submission_status != 'Submission')){
                        $next_action = $submissionType ." Date = ".$resubmission_followup->date;
                        $next_action .= ", Resubmission/Follow-Up Date";
                    }
                }
            
            $owner = $event->owner;
            // $i, $event->type, $event->company->name , $event->job_order->title, $candidate, $event->event_date, $next_action, $owner

            fputcsv($handle, array($i++, $event->type, $event->company->name , $event->job_order->title, $event->event_date, $next_action, $owner));
        }          
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Pending Joborder Events List.csv',$headers);
        ob_end_clean();
        return $response;
    }




    public function getSetUserStatus(Request $_request)
    {
        $updateStatus = \DB::table('cms_users')->where('id',$_request->user_id)->update(['status'=>$_request->status]);
        if($updateStatus){
            $message = "User Status Updated Successfully!..";
            $msgType = "success";
        }
        else{
            $message = "User Status Updation Failed!..";
            $msgType = "danger";
        }
        return redirect()->back()            
            ->with(['message'=>$message,'message_type'=>$msgType])
            ->withInput();
    }

    public function getCandidateJoinedListFromDashboard($_type=null)
    {

        $joined= DB::table('job_order_applicants')
        ->join('job_orders', 'job_orders.id', '=', 'job_order_applicants.job_order_id') 
        ->join('job_order_applicant_statuses', 'job_order_applicant_statuses.job_order_applicant_id', '=', 'job_order_applicants.id')
        ->where('job_order_applicants.secondary_status','Joined')
        // ->where('job_order_applicants.next_action','Send Invoice')
        ->whereNull('job_order_applicants.deleted_at')
        ->orderBy('job_order_applicants.updated_at','desc')
        ->select('job_order_applicants.*','job_orders.company_id as company_id', 'job_orders.recruiter as recruiter','job_order_applicants.id as applicant_id','job_orders.title as title','job_order_applicants.creator_id as applicant_creator_id','job_orders.id as joborder_id')
        ->where('job_order_applicant_statuses.new_secondary_status','Joined')
        ->where('job_order_applicant_statuses.new_primary_status','Place')
        ->whereNotNull('job_order_applicant_statuses.prev_joining_date')
        ->groupBy('job_order_applicant_statuses.job_order_applicant_id')
        ->orderBy('job_order_applicant_statuses.id','DESC');
        $joined =  $joined->get();  // $joined->paginate(20);

        foreach($joined as $joined_value)
        {

            $joined_value->candidateJoinedDate=DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$joined_value->applicant_id)->where('new_secondary_status','Joined')->where('new_primary_status','Place')->orderBy('id', 'desc')->first()->prev_joining_date;
            $joined_value->companyId = DB::table('companies')->find($joined_value->company_id)->id;
            $joined_value->companyName = DB::table('companies')->find($joined_value->company_id)->name;
            /*$creator_id = DB::table('job_order_applicant_statuses')
                ->where('job_order_applicant_id', $joined_value->applicant_id)
                ->where('new_secondary_status','Joined')->where('new_primary_status','Place')
                ->whereNotNull('prev_joining_date')
                ->orderBy('id', 'desc')
                ->first()->creator_id;*/
            $joined_value->recruiter = DB::table('cms_users')->find($joined_value->applicant_creator_id);
            // $candidate =  DB::table('candidates')->where('id',$joined_value->candidate_id)->first();
            if($_REQUEST['candidate']) {
                $candidate =  DB::table('candidates')->where('id',$_REQUEST['candidate'])->first();
            }
            else{
                $candidate =  DB::table('candidates')->where('id',$joined_value->candidate_id)->first();
            }
            $candidateName = $candidate->first_name.' '.$candidate->last_name;
            $joined_value->candidateName=$candidateName;
            $joined_value->lastActivity = DB::table('job_order_applicant_statuses')
                    ->where('job_order_applicant_id', $joined_value->applicant_id)
                    ->orderBy('id', 'desc')
                    ->first();
            $joined_value->job_order_applicant=\DB::table('job_order_applicants')->where('job_order_id',$joined_value->job_order_id)->where('candidate_id', $joined_value->candidate_id)->whereNull('deleted_at')->first(); // ->select('next_action')

        }

        return view('override.details_dashboard.candidate_joined_list',compact('joined'));
    }

    public function getOwnerReportsForPendingEvents()
    {
        $ownerWiseReports = [];
        $pendEvents = $this->getPendingEvents('csv_export');
        $events = $pendEvents['events'];
        $owners = $pendEvents['owners'];

        foreach($events as $event) {
            $event->owner = DB::table('cms_users')->where('id',$event->owner_id)->first()->name;
            $ownerWiseReports[$event->owner_id.'_'.$event->owner][] = $event->id;
        }

        // dd($ownerWiseReports);
        return json_encode($ownerWiseReports);
    }

    public function getDuplicateEmailInCSV()
    {
        // $query = \DB::select('select a1.id, a1.first_name, a1.last_name, a1.primary_email from candidates a1 inner join (  select first_name,last_name,primary_email,count(id) from candidates group by primary_email having count(*)>1 ) u1 on u1.primary_email = a1.primary_email order by a1.primary_email');
        $query = \DB::select('select a1.id, a1.primary_email, a1.first_name, a1.last_name, u1.count from candidates a1 inner join (  select primary_email,count(id) as count from candidates group by primary_email having count(*)>1 ) u1 on u1.primary_email = a1.primary_email order by a1.primary_email');
        $filePath = public_path(). "/reports/";
        $filename = $filePath. "Email Duplicates List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Email Duplicates List'));
        fputcsv($handle, array('Sl No.', 'Id', 'Primary Email', 'First Name', 'Last Name', 'Count'));
        $i = 1;
        // dump($query);
        foreach($query as $query_value){
            fputcsv($handle, array($i++,$query_value->id,$query_value->primary_email,$query_value->first_name,$query_value->last_name,$query_value->count));
            // dump($query_value);
            // dump(($i++, $query_value->id, $query_value->primary_email, $query_value->first_name, $query_value->last_name));
        }
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Email Duplicates List.csv',$headers);
        ob_end_clean();
        return $response;
    }

    public function getDuplicatePhoneInCSV()
    {
        // $query = \DB::select('select a1.id, a1.first_name, a1.last_name, a1.primary_email from candidates a1 inner join (  select first_name,last_name,primary_email,count(id) from candidates group by primary_email having count(*)>1 ) u1 on u1.primary_email = a1.primary_email order by a1.primary_email');
        $query = \DB::select('select a1.id, a1.primary_phone, a1.first_name, a1.last_name, u1.count from candidates a1 inner join (  select primary_phone,count(id) as count from candidates group by primary_phone having count(*)>1 ) u1 on u1.primary_phone = a1.primary_phone order by a1.primary_phone');
        $filePath = public_path(). "/reports/";
        $filename = $filePath. "Phone Duplicates List.csv";
        $handle = fopen($filename, 'w');
        fwrite($handle,pack("CCC",0xef,0xbb,0xbf));
        fputcsv($handle, array('','','','Phone Duplicates List'));
        fputcsv($handle, array('Sl No.', 'Id', 'Primary Phone', 'First Name', 'Last Name', 'Count'));
        $i = 1;
        // dump($query);
        foreach($query as $query_value){
            fputcsv($handle, array($i++,$query_value->id,$query_value->primary_email,$query_value->first_name,$query_value->last_name,$query_value->count));
            // dump($query_value);
            // dump(($i++, $query_value->id, $query_value->primary_email, $query_value->first_name, $query_value->last_name));
        }
        fclose($handle);
        $headers = array(
            'Cache-Control'=>'public', 
            'Content-Type'=>'application/octet-stream', 
            'Content-Type' => 'application/csv',
            'charset'=>'utf-8',
            'Content-Disposition'=>'attachment',
        );
        $response = Response::download($filename,'Phone Duplicates List.csv',$headers);
        ob_end_clean();
        return $response;
    }
    public function updateEventOwner(Request $_request){
        $update=\DB::table('job_order_applicants')
               ->where('id', $_request->applicant_id)
               ->update([
                'creator_id' => $_request->id   
            ]);
        $ownerName = \DB::table('cms_users')->where('id',$_request->id)->first();
        $event_update=\DB::table('events') 
                       ->where('id', $_request->event_id)
                       ->update([
                          'owner_id' =>$_request->id,
                          'owner_name' => $ownerName->name
                       ]);
        if($update=1 && $event_update=1){
        return 'ok' ;
        }
        else{
         return 'notok' ;
        }
    }
    public function updateEmailTemplate(Request $_request,$id){

        $update=\DB::table('cms_email_templates')
               ->where('id', $id)
               ->update([
                'name'=>$_request->name,
                'slug'=>$_request->slug,
                'subject'=>$_request->subject,
                'content'=>$_request->content,
                'description'=>$_request->description,
                'from_name'=>$_request->from_name,
                'from_email'=>$_request->from_email,
                'cc_email' =>$_request->cc_email,
                'updated_at' => \DB::raw('NOW()') 
            ]);
        CRUDBooster::redirect('/admin/email_templates',"The data has been updated !","success");
    }

    


/* db Migration */
/*    public function dbMigration($value='')
    {
        return view('override.db_migration.db_migration');
    }*/

}
