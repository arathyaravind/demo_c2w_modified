<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('admin/login');
});
Route::get('/candidate', function () {
    return redirect('candidates/candidate_addtojoborder');
});






Route::get('dashboard', [ 'as' => 'dashboard', 'uses' => 'CustomController@getDashboard']);
Route::get('/apply-job','CustomController@applyJoborder');
Route::post('/apply-job', 'CustomController@saveApplyJoborder');
Route::get('/post-resume', 'CustomController@candidateRegister');
Route::get('/register-candidate', 'CustomController@addcandidateDetails');
Route::post('/register-candidate', 'CustomController@addcandidateDetails');
Route::get('/view-candidate-details', 'CustomController@editCandidateDetails');
Route::post('/view-candidate-details', 'CustomController@editCandidateDetails');
Route::post('/edit-candidate-details', 'CustomController@updateApplyJoborder');
Route::post('/view-email-details', 'CustomController@getCandidateDetailsForEmail');
Route::post('/bulk-next-action-change', 'CustomController@getBulkCandidateStatusChange');
Route::get('/status-message', 'CustomController@loginAgain');
Route::get('/forget-key','CustomController@sendForgetKey');
Route::post('/admin/email_templates/edit-save/{id}', 'CustomController@updateEmailTemplate');
// custom routes
Route::post('/custom/set-intro-call-date', 			'CustomController@setIntroCallDate');
Route::post('/custom/set-intro-call-date-by-event', 'CustomController@setIntroCallDateByEvent');
Route::post('/custom/set-intro-call-date-by-pending-event', 'CustomController@setIntroCallDateByPendingEvent');
Route::post('/custom/set-submission-date-by-event', 'CustomController@setSubmissionDateByEvent');
Route::post('/custom/set-submission-date-by-pending-event', 'CustomController@setSubmissionDateByPendingEvent');
Route::get ('/custom/cancel-intro-call-date/{id}',	'CustomController@cancelIntroCallDate');
Route::post('/custom/set-submission-date',			'CustomController@setSubmissionDate');
Route::get ('/custom/get-applicant-details/{id}',	'CustomController@getJobOrderApplicantDetails');
Route::post('/custom/set-applicant-status',			'CustomController@setJobOrderApplicantStatus');
Route::get ('/custom/suggest/functional_area',		'CustomController@suggestFunctionalArea');
Route::get ('/custom/suggest/functional_area_skill','CustomController@suggestFunctionalAreaSkill');
Route::get ('/custom/suggest/general_skll',			'CustomController@suggestGeneralSkill');
Route::post('/custom/associate-candidate',			'CustomController@associateCandidate');
Route::post('/custom/unassociate-applicant',		'CustomController@unassociateCandidate');
Route::post('/custom/check-joborder-openings',		'CustomController@checkOpenings');
Route::get ('/custom/get-applicant-log/{id}',		'CustomController@getJobOrderApplicantLog');
Route::post('/custom/set-job-status',				'CustomController@setJobOrderStatus');
Route::post('/custom/change-owner',				    'AdminJobOrderApplicantsController@updateOwner');
Route::post('/candidate/add-to-joborder',			'AdminJobOrderApplicantsController@CandidateAddtocontroller');
Route::post('/custom/change-event-owner',		    'CustomController@updateEventOwner');
Route::get('/custom/calendar',				'CustomController@showCalendar');

Route::get('/custom/events',				'CustomController@getEvents');

Route::get('/custom/get-joborders-status',	'CustomController@getjobOrderStatusForReports');

Route::get('/custom/set-user-status',	'CustomController@getSetUserStatus');

Route::get('/custom/duplicate-emails-csv',	'CustomController@getDuplicateEmailInCSV');
Route::get('/custom/duplicate-phones-csv',	'CustomController@getDuplicatePhoneInCSV');

// Route::get('/custom/events-update/', 'CustomController@updateEventNames'); // for inserting the names in events table

Route::post('/custom/save-company-contact',			'CustomController@saveCompanyContact');
Route::post('/custom/update-company-contact/{id}',	'CustomController@updateCompanyContact');
Route::post('/custom/delete-company-contact/{id}',	'CustomController@deleteCompanyContact');

Route::post('/custom/save-company-note',		'CustomController@saveCompanyNote');
Route::post('/custom/update-company-note/{id}',	'CustomController@updateCompanyNote');
Route::post('/custom/delete-company-note/{id}',	'CustomController@deleteCompanyNote');

Route::post('/custom/save-company-industry',		'CustomController@saveCompanyIndustry');
Route::post('/custom/update-company-industry/{id}',	'CustomController@updateCompanyIndustry');
Route::post('/custom/delete-company-industry/{id}',	'CustomController@deleteCompanyIndustry');

Route::post('/custom/save-company-department',		'CustomController@saveCompanyDepartment');
Route::post('/custom/update-company-department/{id}',	'CustomController@updateCompanyDepartment');
Route::post('/custom/delete-company-department/{id}',	'CustomController@deleteCompanyDepartment');
Route::post('/custom/assign-jobOrders',	'CustomController@assignJobOrder');

Route::post('/custom/resubmission','CustomController@jobOrderReSubmissionDate');
Route::post('/custom/resubmission-event','CustomController@jobOrderReSubmissionDateByEvent');
Route::post('/custom/resubmission-pendingevent','CustomController@jobOrderReSubmissionDateByPendingEvent');
Route::post('/custom/set-invoice-mail',	'CustomController@sendInvoiceMail');
Route::post('/admin/candidates',	'AdminCandidatesController@getIndex');
Route::post('/custom/email-send',	'CustomController@candidate_email_sending');
Route::get('/custom/email-send',	'CustomController@candidate_email_sending');
Route::get('/candidates/CheckMailExists','AdminCandidatesController@CheckMailExists');
Route::get('/candidates/CheckPhoneExists','AdminCandidatesController@CheckPhoneExists');
Route::get('/test-doc','CustomController@testDoc');
Route::get('/parse-doc','CustomController@parseResume');

Route::get('/admin', function(){
	return redirect('/admin/dashboard');
});

Route::get('/admin/dashboard-add-candidates','CustomController@getCandidateListFromDashboard');
Route::get('/admin/candidates/generate_pdf/{id}','AdminCandidatesController@generatePdf');
//Route::get('/admin/candidateListPdfView','CustomController@candidateListPdfView');
Route::get('/admin/candidateListCsvView','CustomController@candidateListCsvView');
Route::get('/admin/dashboard-candidates-submission','CustomController@getCandidateSubmitListFromDashboard');

//Route::get('/admin/submittedcandidateListPdfView','CustomController@submittedCandidateListPdfView');
Route::get('/admin/submittedcandidateListCsvView','CustomController@submittedCandidateListCsvView');

Route::get('/admin/interview-candidates-scheduled','CustomController@getCandidateInterviewListFromDashboard');

//Route::get('/admin/interviewcandidateListPdfView','CustomController@getCandidateInterviewListPdfView');
Route::get('/admin/interviewcandidateListCsvView','CustomController@getCandidateInterviewListCsvView');

Route::get('/admin/offer-candidates-scheduled','CustomController@getCandidateOfferListFromDashboard');

//Route::get('/admin/offercandidateListPdfView','CustomController@getCandidateofferListPdfView');
Route::get('/admin/offercandidateListCsvView','CustomController@getCandidateofferListCsvView');

Route::get('/admin/interview-done-candidates','CustomController@getCandidateInterviewDoneListFromDashboard');

//Route::get('/admin/interview-done-candidates-pdf-view','CustomController@getCandidateInterviewDoneListPdfView');
Route::get('/admin/interview-done-candidates-csv-view','CustomController@getCandidateInterviewDoneListCsvView');
Route::get('/admin/interview-backout-candidates','CustomController@getCandidateInterviewBackoutListFromDashboard');

//Route::get('/admin/interview-backout-candidates-pdf-view','CustomController@getCandidateInterviewBackoutListPdfView');
Route::get('/admin/interview-backout-candidates-csv-view','CustomController@getCandidateInterviewBackoutListCsvView');


Route::get('/admin/joining-candidates','CustomController@getCandidateJoiningListFromDashboard');

//Route::get('/admin/joining-candidates-pdf-view','CustomController@getCandidateJoiningListPdfView');
Route::get('/admin/joining-candidates-csv-view','CustomController@getCandidateJoiningListCsvView');

Route::get('/admin/backout-candidates','CustomController@getCandidateBackoutListFromDashboard');

//Route::get('/admin/backout-candidates-pdf-view','CustomController@getCandidateBackoutListPdfView');
Route::get('/admin/backout-candidates-csv-view','CustomController@getCandidateBackoutListCsvView');

Route::get('/admin/rejected-candidates','CustomController@getCandidateRejectedListFromDashboard');

//Route::get('/admin/rejected-candidates-pdf-view','CustomController@getCandidateRejectedListPdfView');
Route::get('/admin/rejected-candidates-csv-view','CustomController@getCandidateRejectedListCsvView');
Route::get('/admin/job-orders','CustomController@getJobOrderListFromDashboard');
Route::get('/admin/job-orders-csv-view','CustomController@jobOrderListCsvView');
Route::get('/admin/job-orders-interview-scheduled','CustomController@getJobOrderInterviewScheduledListFromDashboard');
Route::get('/admin/job-orders-interview-scheduled-csv-view','CustomController@jobOrderInterviewScheduledListCsvView');
Route::get('/admin/job-orders-submitted','CustomController@getJobOrderSubmittedListFromDashboard');
Route::get('/admin/job-orders-submitted-csv-view','CustomController@jobOrderSubmittedListCsvView');
Route::get('/admin/job-orders-interview-feedback','CustomController@getJobOrderInterviewFeedbackListFromDashboard');
Route::get('/admin/job-orders-interview-feedback-csv-view','CustomController@jobOrderInterviewFeedbackListCsvView');
Route::get('/admin/job-orders-offered','CustomController@getJobOrderOfferedListFromDashboard');
Route::get('/admin/job-orders-offered-csv-view','CustomController@jobOrderOfferedListCsvView');
Route::get('/admin/job-orders-joining','CustomController@getJobOrderJoiningListFromDashboard');
Route::get('/admin/job-orders-joining-csv-view','CustomController@jobOrderJoiningListCsvView');
Route::get('/admin/job-orders-introcall-scheduled','CustomController@getJobOrderIntrocallListFromDashboard');
Route::get('/admin/job-orders-introcall-scheduled-csv-view','CustomController@jobOrderIntrocallListCsvView');
Route::get('/admin/job-orders-scheduled-submission','CustomController@getJobOrderScheduledSubmissionListFromDashboard');
Route::get('/admin/job-orders-scheduled-submission-scheduled-csv-view','CustomController@jobOrderScheduledSubmissionListCsvView');
Route::post('/admin/resume-parsing','CustomController@resumeParsing');
Route::get('/admin/associate-applicants','CustomController@associateWebsiteCandidates');
Route::get('/admin/save-candidate-details', 'CustomController@saveWebsiteCandidatesDetails');
Route::get('/admin/pending-events/{_type?}','CustomController@getPendingEvents');
Route::get('/admin/pending-joborder-events','CustomController@getPendingJoborderEvents');
Route::get('/admin/pending-events-csv-view','CustomController@pendingEventsListCsvView');
Route::get('/admin/pending-joborder-events-csv-view','CustomController@pendingJoborderEventsListCsvView');
Route::get('/admin/candidates-joined','CustomController@getCandidateJoinedListFromDashboard');
Route::get('/pending-events/owner-reports','CustomController@getOwnerReportsForPendingEvents');

Route::get('/admin/je-notifications', 'CustomController@JENotifications');
Route::get('/admin/e-notifications', 'CustomController@ENotifications');
Route::get('/admin/db-candidate-status', 'CustomController@dbCandidateStatus');
