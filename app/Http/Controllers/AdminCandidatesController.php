<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;
use Route;
use PhpOffice\PhpWord;
use PdfParser;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

// top of your controller
ini_set('max_execution_time',0);
ini_set('LimitRequestLine', 10000);
// Also you can increase memory
ini_set('memory_limit','2048M');

class AdminCandidatesController extends \crocodicstudio\crudbooster\controllers\CBController {

	public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "first_name";
		$this->limit = "20";
		$this->orderby = "id,desc";
		$this->global_privilege = false;
		$this->button_table_action = true;
		$this->button_bulk_action = true;
		$this->button_action_style = "button_icon";
		$this->button_add = false;
		$this->button_edit = true;
		$this->button_delete =true;
		$this->button_detail = true;
		$this->button_show = false;
		$this->button_filter = true;
		$this->button_import = false;
		$this->button_export = false;
		$this->table = "candidates";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];
		$this->col[] = ["label"=>"First Name","name"=>"first_name"];
		$this->col[] = ["label"=>"Last Name","name"=>"last_name"];
		$this->col[] = ["label"=>"Birth Date","name"=>"birth_date"];
		$this->col[] = ["label"=>"Expected Ctc","name"=>"expected_ctc"];
		$this->col[] = ["label"=>"Preferred City","name"=>"preferred_city","join"=>"cities,name"];
		$this->col[] = ["label"=>"Highest Qualification_level","name"=>"highest_qualification_level","join"=>"qualification_levels,qual_level"];
		$this->col[] = ["label"=>"Experience Years","name"=>"experience_years"];
		$this->col[] = ["label"=>"Experience Months","name"=>"experience_months"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];
		$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Birth Date','name'=>'birth_date','type'=>'date','validation'=>'date','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'radio','validation'=>'required|min:1|max:255','width'=>'col-sm-4','dataenum'=>'Male;Female'];
		$this->form[] = ['label'=>'Relationship Status','name'=>'relationship_status','type'=>'radio','validation'=>'required|min:1|max:255','width'=>'col-sm-4','dataenum'=>'Married;Unmarried'];

		$this->form[] = ['label'=>'Religion','name'=>'religion','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Expected Ctc','name'=>'expected_ctc','type'=>'number','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Preferred City','name'=>'preferred_city','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cities,name'];
		$this->form[] = ['label'=>'First Job Start Date','name'=>'first_job_start_date','type'=>'date','validation'=>'date','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Head Line','name'=>'head_line','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Experience Years','name'=>'experience_years','type'=>'number','validation'=>'max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Experience Months','name'=>'experience_months','type'=>'number','validation'=>'max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Current Ctc','name'=>'current_ctc','type'=>'number','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Can Relocate','name'=>'can_relocate','type'=>'checkbox','validation'=>'min:1|max:255','width'=>'col-sm-4','dataenum'=>'1|yes;0|no'];
		$this->form[] = ['label'=>'Current Employer','name'=>'current_employer','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Current Designation','name'=>'current_designation','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Notice Period','name'=>'notice_period','type'=>'number','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Current City','name'=>'current_city','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cities,name'];
		$this->form[] = ['label'=>'Source','name'=>'source','type'=>'select2','validation'=>'min:1|max:255|required','width'=>'col-sm-4','datatable'=>'sources,name'];
		$this->form[] = ['label'=>'Category','name'=>'category','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Country','name'=>'country_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'countries,name'];
		$this->form[] = ['label'=>'State','name'=>'state_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'states,name','parent_select'=>'country_id'];
		$this->form[] = ['label'=>'City','name'=>'city_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'cities,name','parent_select'=>'state_id'];
		$this->form[] = ['label'=>'Postal Code','name'=>'postal_code','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'postal_codes,name'];
		$this->form[] = ['label'=>'Primary Email','name'=>'primary_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Primary Phone','name'=>'primary_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Secondary Email','name'=>'secondary_email','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Secondary Phone','name'=>'secondary_phone','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Website','name'=>'web_site','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Date Available','name'=>'date_available','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Photo','name'=>'photo_url','type'=>'upload','validation'=>'image','width'=>'col-sm-4'];
		$this->form[] = ['label'=>'Resume','name'=>'resume_url','type'=>'upload','width'=>'col-sm-4'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Birth Date','name'=>'birth_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'radio','validation'=>'required|min:1|max:255','width'=>'col-sm-4','dataenum'=>'Male;Female'];
			//$this->form[] = ['label'=>'Religion','name'=>'religion','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Expected Ctc','name'=>'expected_ctc','type'=>'number','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Preferred City','name'=>'preferred_city','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cities,name'];
			//$this->form[] = ['label'=>'First Job Start Date','name'=>'first_job_start_date','type'=>'date','validation'=>'date','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Head Line','name'=>'head_line','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Experience Years','name'=>'experience_years','type'=>'number','validation'=>'max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Experience Months','name'=>'experience_months','type'=>'number','validation'=>'max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Current Ctc','name'=>'current_ctc','type'=>'number','validation'=>'min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Can Relocate','name'=>'can_relocate','type'=>'checkbox','validation'=>'min:1|max:255','width'=>'col-sm-4','dataenum'=>'1|yes;0|no'];
			//$this->form[] = ['label'=>'Current Employer','name'=>'current_employer','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Current Designation','name'=>'current_designation','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Current City','name'=>'current_city','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'cities,name'];
			//$this->form[] = ['label'=>'Source','name'=>'source','type'=>'select2','validation'=>'min:1|max:255|required','width'=>'col-sm-4','datatable'=>'sources,name'];
			//$this->form[] = ['label'=>'Category','name'=>'category','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Country','name'=>'country_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'countries,name'];
			//$this->form[] = ['label'=>'State','name'=>'state_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'states,name','parent_select'=>'country_id'];
			//$this->form[] = ['label'=>'City','name'=>'city_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-4','datatable'=>'cities,name','parent_select'=>'state_id'];
			//$this->form[] = ['label'=>'Postal Code','name'=>'postal_code','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-4','datatable'=>'postal_codes,name'];
			//$this->form[] = ['label'=>'Primary Email','name'=>'primary_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Primary Phone','name'=>'primary_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Secondary Email','name'=>'secondary_email','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Secondary Phone','name'=>'secondary_phone','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Photo','name'=>'photo_url','type'=>'upload','validation'=>'image','width'=>'col-sm-4'];
			//$this->form[] = ['label'=>'Resume','name'=>'resume','type'=>'upload','width'=>'col-sm-4'];
			# OLD END FORM

			/* 
			| ---------------------------------------------------------------------- 
		    | Sub Module
		    | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
		    | 
		    */
		    $this->sub_module = array();


		    /* 
		    | ---------------------------------------------------------------------- 
		    | Add More Action Button / Menu
		    | ----------------------------------------------------------------------     
		    | @label       = Label of action 
		    | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
		    | @icon        = Font awesome class icon. e.g : fa fa-bars
		    | @color 	   = Default is primary. (primary, warning, succecss, info)     
		    | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
		    | 
		    */
		    $this->addaction = array();

		    $this->addaction[] = ['label' => 'Industries', 'url' => "/admin/candidate_industries?candidate_id=[id]", "color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'Functional Areas', 'url' => "/admin/candidate_industry_functional_areas?candidate_id=[id]", "color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'Functional Area Skills', 'url' => "/admin/candidate_industry_functional_area_skills?candidate_id=[id]","color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'Functional Area Roles', 'url' => "/admin/candidate_industry_functional_area_roles?candidate_id=[id]", "color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'General Skills', 'url' => "/admin/candidate_general_skills?candidate_id=[id]", "color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'Qualifications', 'url' => "/admin/candidate_qualifications?candidate_id=[id]", "color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'Resumes', 'url' => "/admin/candidate_resumes?candidate_id=[id]", "color" => "group-in-menu"];

		    $this->addaction[] = ['label' => 'Notes', 'url' => "/admin/candidate_notes?candidate_id=[id]", "color" => "group-in-menu"];                


		    /* 
		    | ---------------------------------------------------------------------- 
		    | Add More Button Selected
		    | ----------------------------------------------------------------------     
		    | @label       = Label of action 
		    | @icon 	   = Icon from fontawesome
		    | @name 	   = Name of button 
		    | Then about the action, you should code at actionButtonSelected method 
		    | 
		    */
		    $this->button_selected = array();


		    /* 
		    | ---------------------------------------------------------------------- 
		    | Add alert message to this module at overheader
		    | ----------------------------------------------------------------------     
		    | @message = Text of message 
		    | @type    = warning,success,danger,info        
		    | 
		    */
		    $this->alert        = array();


		    
		    /* 
		    | ---------------------------------------------------------------------- 
		    | Add more button to header button 
		    | ----------------------------------------------------------------------     
		    | @label = Name of button 
		    | @url   = URL Target
		    | @icon  = Icon from Awesome.
		    | 
		    */
		    $this->index_button = array();



		    /* 
		    | ---------------------------------------------------------------------- 
		    | Customize Table Row Color
		    | ----------------------------------------------------------------------     
		    | @condition = If condition. You may use field alias. E.g : [id] == 1
		    | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
		    | 
		    */
		    $this->table_row_color = array();     	          

		    
		    /*
		    | ---------------------------------------------------------------------- 
		    | You may use this bellow array to add statistic at dashboard 
		    | ---------------------------------------------------------------------- 
		    | @label, @count, @icon, @color 
		    |
		    */
		    $this->index_statistic = array();



		    /*
		    | ---------------------------------------------------------------------- 
		    | Add javascript at body 
		    | ---------------------------------------------------------------------- 
		    | javascript code in the variable 
		    | $this->script_js = "function() { ... }";
		    |
		    */
		    $this->script_js = NULL;
		    $this->script_js = file_get_contents(public_path() . '/js/modules/' . 'common.js');

		    /*
		    | ---------------------------------------------------------------------- 
		    | Include HTML Code before index table 
		    | ---------------------------------------------------------------------- 
		    | html code to display it before index table
		    | $this->pre_index_html = "<p>test</p>";
		    |
		    */
		    $this->pre_index_html = null;
		    
		    
		    
		    /*
		    | ---------------------------------------------------------------------- 
		    | Include HTML Code after index table 
		    | ---------------------------------------------------------------------- 
		    | html code to display it after index table
		    | $this->post_index_html = "<p>test</p>";
		    |
		    */
		    $this->post_index_html = null;
		    
		    
		    
		    /*
		    | ---------------------------------------------------------------------- 
		    | Include Javascript File 
		    | ---------------------------------------------------------------------- 
		    | URL of your javascript each array 
		    | $this->load_js[] = asset("myfile.js");
		    |
		    */
		    $this->load_js = array();
		    
		    
		    
		    /*
		    | ---------------------------------------------------------------------- 
		    | Add css style at body 
		    | ---------------------------------------------------------------------- 
		    | css code in the variable 
		    | $this->style_css = ".style{....}";
		    |
		    */
		    $this->style_css = NULL;
		    $this->style_css = file_get_contents(public_path() . '/css/modules/' . 'common.css');
		    
		    
		    /*
		    | ---------------------------------------------------------------------- 
		    | Include css File 
		    | ---------------------------------------------------------------------- 
		    | URL of your css each array 
		    | $this->load_css[] = asset("myfile.css");
		    |
		    */
		    $this->load_css = array();
		    
		    
		}


		/*
		| ---------------------------------------------------------------------- 
		| Hook for button selected
		| ---------------------------------------------------------------------- 
		| @id_selected = the id selected
		| @button_name = the name of button
		|
		*/
		public function actionButtonSelected($id_selected,$button_name) {
		    //Your code here	            
		}


		/*
		| ---------------------------------------------------------------------- 
		| Hook for manipulate query of index result 
		| ---------------------------------------------------------------------- 
		| @query = current sql query 
		|
		*/
		public function hook_query_index(&$query) {
		    //Your code here	            
		}

		/*
		| ---------------------------------------------------------------------- 
		| Hook for manipulate row of index table html 
		| ---------------------------------------------------------------------- 
		|
		*/    
		public function hook_row_index($column_index,&$column_value) {	        
			//Your code here
		}

		/*
		| ---------------------------------------------------------------------- 
		| Hook for manipulate data input before add data is execute
		| ---------------------------------------------------------------------- 
		| @arr
		|
		*/
		public function hook_before_add(&$postdata) {
			//Your code here
			// unset($postdata['qualification_level_id']);
			// $postal_code = DB::table('postal_codes')->find($postdata['postal_code'])->name;
			// $postdata['postal_code'] = $postal_code; 

			// $name = $postdata['resume_url'];
			// Session::put('resume_filename',$name);
			// unset($postdata['resume_url']);
			$first_name = preg_replace('/[^\w]/', '', $_REQUEST['first_name']);
			$last_name = preg_replace('/[^\w]/', '', $_REQUEST['last_name']);
			$postdata['first_name']=$first_name;
			$postdata['last_name']=$last_name;
			$postdata['highest_qualification_level'] = DB::table('qualifications')->find($_REQUEST['highest_qualification'])->qualification_level_id;
			$postdata['highest_qualification'] = $_REQUEST['highest_qualification'];
			$postdata['creator_id'] = $_REQUEST['creator_id'];

			$postdata['web_site'] = $_REQUEST['website'];
			$postdata['date_available'] = date('Y-m-d',strtotime($_REQUEST['date_available']));

			if($_REQUEST['assign_joborder_id']) {
				Session::put('assignJobOrderId',$_REQUEST['assign_joborder_id']);
			}
			$this->createSessionVariablesForCandidate($postdata['resume_url']);

			unset($postdata['resume_url']);
		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command after add public static function called 
		| ---------------------------------------------------------------------- 
		| @id = last insert id
		| 
		*/
		public function hook_after_add($id) {
			// update-set
			$candidateCreated = DB::table('candidates')->select('created_at')->where('id', $id)->first();
			DB::table('candidates')->where('id',$id)->update(['updated_at' => $candidateCreated->created_at]);
		    //Your code here
			$this->insertToCandidatePivotTable($id);
		    if(Session::get('assignJobOrderId')) {
		    	$jobOrderId = Session::get('assignJobOrderId');
				SESSION::forget('assignJobOrderId');
				 $jobOrderVacancy=DB::table('job_orders')->where('id',$jobOrderId)
        			->first();
        		$openings=$jobOrderVacancy->openings_available;
		        if($openings<=0){
						CRUDBooster::redirect('/admin/job_order_applicants?job_order_id='.$jobOrderId,"No Openings Available and Candidate Not Associated to the Job Order","warning");
		        } else{
		        	$addToJo=\DB::table('job_order_applicants')
							->insertGetId([
								'job_order_id' => $jobOrderId,
								'candidate_id' => $id,
								'primary_status' => 'Qualify',
								'secondary_status' => 'Pending Review',
								'next_action' => 'Qualify',
								'created_at' => \DB::raw('NOW()'),
								'updated_at' => \DB::raw('NOW()'),
								'creator_id' => CRUDBooster::myId()
							]);
					$statusAdd	=\DB::table('job_order_applicant_statuses')->insert([
				                    'job_order_applicant_id' => $addToJo,
				                    'prev_primary_status' => '',
				                    'prev_secondary_status' => '',
				                    'new_primary_status' => 'Qualify',
				                    'new_secondary_status' => 'Pending Review',
				                    'note' => '',
				                    'creator_id' => CRUDBooster::myId(),
				                    'created_at' => \DB::raw('NOW()')
				                ]);
						// Session::forget('assignJobOrderId');
						if($statusAdd){
					            CRUDBooster::redirect('/admin/job_order_applicants?job_order_id='.$jobOrderId,"Candidate Associated to the Job Order","success");
						}
						
		        }
						
					}
		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for manipulate data input before update data is execute
		| ---------------------------------------------------------------------- 
		| @postdata = input post data 
		| @id       = current id 
		| 
		*/
		public function hook_before_edit(&$postdata,$id) {
		    //Your code here
				// $postdata['highest_qualification_level'] = $postdata['qualification_level_id'];
				// unset($postdata['qualification_level_id']);
				// $postal_code = DB::table('postal_codes')->find($postdata['postal_code'])->name;
				// $postdata['postal_code'] = $postal_code;

				// $name = $postdata['resume_url'];
				// Session::put('resume_filename',$name);
				// unset($postdata['resume_url']);
			$candidate = DB::table('candidates')->where('id',$id)->first();
			$first_name = preg_replace('/[^\w]/', '', $postdata['first_name']);
			$last_name = preg_replace('/[^\w]/', '', $postdata['last_name']);
			$postdata['first_name']=$first_name;
			$postdata['last_name']=$last_name;
			$postdata['birth_date'] = ($postdata['birth_date'] ? $postdata['birth_date'] : '');
			$postdata['gender'] = ($postdata['gender'] ? $postdata['gender'] : '');
			$postdata['relationship_status'] = ($postdata['relationship_status'] ? $postdata['relationship_status'] : '');
			$postdata['secondary_email'] = ($postdata['secondary_email'] ? $postdata['secondary_email'] : '');
			$postdata['secondary_phone'] = ($postdata['secondary_phone'] ? $postdata['secondary_phone'] : '');
			$postdata['postal_code'] = ($postdata['postal_code'] ? $postdata['postal_code'] : '');
			$postdata['religion'] = ($postdata['religion'] ? $postdata['religion'] : '');
			$postdata['category'] = ($postdata['category'] ? $postdata['category'] : '');
			$postdata['source'] = ($postdata['source'] ? $postdata['source'] : '');
			$postdata['head_line'] = ($postdata['head_line'] ? $postdata['head_line'] : '');
			$postdata['can_relocate'] = ($postdata['can_relocate'] ? $postdata['can_relocate'] : '0');
			$postdata['first_job_start_date'] = ($postdata['first_job_start_date'] ? $postdata['first_job_start_date'] : null );


			$postdata['preferred_city'] = ($postdata['preferred_city'] ? $postdata['preferred_city'] : '');
			$postdata['current_employer'] = ($postdata['current_employer'] ? $postdata['current_employer'] : '');
			$postdata['current_designation'] = ($postdata['current_designation'] ? $postdata['current_designation'] : '');
			$postdata['notice_period'] = ($postdata['notice_period'] ? $postdata['notice_period'] : '');
			$postdata['photo_url'] = ($postdata['photo_url'] ? $postdata['photo_url'] : $candidate->photo_url );

			$postdata['highest_qualification_level'] = DB::table('qualifications')->find($_REQUEST['highest_qualification'])->qualification_level_id;
			$postdata['highest_qualification'] = $_REQUEST['highest_qualification'];

			$postdata['web_site'] = ($_REQUEST['website'] ) ? $_REQUEST['website'] :'';

			$postdata['date_available'] = ($_REQUEST['date_available'] ) ? date('Y-m-d',strtotime($_REQUEST['date_available'])): null ;
			$this->createSessionVariablesForCandidate($postdata['resume_url']);
			unset($postdata['resume_url']);
			$postdata['creator_id'] = $_REQUEST['creator_id'];
		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command after edit public static function called
		| ----------------------------------------------------------------------     
		| @id       = current id 
		| 
		*/
		public function hook_after_edit($id) {
		    //Your code here 
			// add resume
			// $resume_filename =  Session::get('resume_filename') ;
			// if($resume_filename!=''){
			// 	$addResume = DB::table('candidate_resumes')->insert(
			// 		[
			// 			'resume_url' => $resume_filename,
			// 			'candidate_id' => $id
			// 		]);
			// }
			DB::table('candidate_industries')->where('candidate_id',$id)->delete();
			DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->delete();
			DB::table('candidate_general_skills')->where('candidate_id',$id)->delete();
			DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$id)->delete();
			DB::table('candidate_qualifications')->where('candidate_id',$id)->delete();

			$existing_candidate_skills = DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->get();

			foreach ($existing_candidate_skills as $existing_candidate_skill) {
				$existingSkill[$existing_candidate_skill->industry_functional_area_skill_id] = "$existing_candidate_skill->experience_years/$existing_candidate_skill->experience_months";
			}
			Session::put('existing_skill',$existingSkill);
			DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->delete();

			$eventCandNameUpdate = app('App\Http\Controllers\CustomController')->updateEventJobCandOwnNames('candidate',$id);
			
			$this->insertToCandidatePivotTable($id);
		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command before delete public static function called
		| ----------------------------------------------------------------------     
		| @id       = current id 
		| 
		*/
		public function hook_before_delete($id) {
		    //Your code here
			DB::table('candidate_industries')->where('candidate_id',$id)->delete();
			DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->delete();
			DB::table('candidate_general_skills')->where('candidate_id',$id)->delete();
			DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$id)->delete();
			DB::table('candidate_qualifications')->where('candidate_id',$id)->delete();
			DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->delete();
			DB::table('candidate_resumes')->where('candidate_id',$id)->delete();
			$applicants=DB::table('job_order_applicants')->where('candidate_id',$id)->get();
			foreach($applicants as $applicant){
			DB::table('job_order_applicant_statuses')->where('job_order_applicant_id',$applicant->id)->delete();
			}
			DB::table('job_order_applicants')->where('candidate_id',$id)->delete();
			DB::table('events')->where('candidate_id',$id)->delete();
			DB::table('candidates')->where('id',$id)->delete();
			CRUDBooster::redirect('admin/candidates',"Delete the data success!","success");

		}

		/* 
		| ---------------------------------------------------------------------- 
		| Hook for execute command after delete public static function called
		| ----------------------------------------------------------------------     
		| @id       = current id 
		| 
		*/
		public function hook_after_delete($id) {
		    //Your code here

		}



		//By the way, you can still create your own method in here... :) 

		//   public function getEdit($id) {

			// $this->cbLoader();
			// $row = DB::table('candidates')->where('id',$id)->first();

			// $candidate_resume = DB::table('candidate_resumes')->orderby('id','desc')->where('candidate_id',$id)->first();
			// $row->resume_url = $candidate_resume->resume_url;

			// $postal_code = DB::table('postal_codes')->where('name',$row->postal_code)->first()->id;

			// $row->qualification_level_id = $row->highest_qualification_level;

			// $row->postal_code = $postal_code;

			// Session::put('current_row_id',$id);

			// return view('crudbooster::default.form',compact('id','row','page_menu','page_title','command'));
		// 	}



		public function getDetail($id)	{
			$this->cbLoader();
			$row = DB::table($this->table)->where($this->primary_key,$id)->first();
			$country = DB::table('countries')->find($row->country_id)->name;
			$state = DB::table('states')->find($row->state_id)->name;
			$city = DB::table('cities')->find($row->city_id)->name;
			$current_city = DB::table('cities')->find($row->current_city)->name;
			$preferred_city = DB::table('cities')->find($row->preferred_city)->name;
			$source = DB::table('sources')->find($row->source)->name;
			$highest_qualification_level = DB::table('qualification_levels')->find($row->highest_qualification_level)->qual_level;
			$highest_qualification = DB::table('qualifications')->find($row->highest_qualification)->qualification;

			$industries = [];
			$industry_functional_area = [];
			$general_skills = [];
			$candidate_industry_functional_area_roles = [];
			$candidate_industry_functional_area_skills = [];
			$candidate_qualifications = [];
			$candidate_jo = [];


			$industries = DB::table('candidate_industries')->where('candidate_id',$id)->get();
			$industry_functional_area = DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->get();
			$industry_functional_areas = DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->get();
			$general_skills = DB::table('candidate_general_skills')->where('candidate_id',$id)->get();
			if(CRUDBooster::myPrivilegeName() === 'Recruiter'){
			$jobOrders = DB::table('job_orders')
			->whereNotIn('status', ['Completed','Cancelled','On Hold','Intro Call Scheduled','New'])
			->where('recruiter',CRUDBooster::myId())
			->orderby('id','desc')->get();
        	}
			else{
			$jobOrders = DB::table('job_orders')
			->whereNotIn('status', ['Completed','Cancelled','On Hold','Intro Call Scheduled','New'])
			->orderby('id','desc')->get();	
			}
			// ADD CANDIDATE TO JOBORDER
						if($_REQUEST['current_action']== 'add_to_joborder') {
							
							$jobOrderVacancy=DB::table('job_orders')->where('id',$_REQUEST['job_order_id'])->first();
					        $openings=$jobOrderVacancy->openings_available;
					        	//check whether candidate already in joborder
							$checkJobOrders = DB::table('job_order_applicants')
							->where('candidate_id',$_REQUEST['candidate_id'])
							->where('job_order_id',$_REQUEST['job_order_id'])
							->whereNull('deleted_at')
							->get();
					        if($openings<=0){
					            if(count($checkJobOrders)>0){
					        	 return 'mainfailed2';
					            }
					            else{
					             return 'mainfailed1';	
					            }
					        } 
					        else{
							if(count($checkJobOrders)==0) {
								$addToJo = DB::table('job_order_applicants')->insertGetId(
									[
										'job_order_id' => $_REQUEST['job_order_id'],
										'candidate_id' => $_REQUEST['candidate_id'],
										'primary_status' => 'Qualify',
										'secondary_status' => 'Pending Review',
										'next_action' => 'Qualify',
										'created_at' => DB::raw('NOW()'),
										'updated_at' => DB::raw('NOW()'),
										'creator_id' => CRUDBooster::myId()
									]);
								\DB::table('job_order_applicant_statuses')->insert([
				                    'job_order_applicant_id' => $addToJo,
				                    'prev_primary_status' => '',
				                    'prev_secondary_status' => '',
				                    'new_primary_status' => 'Qualify',
				                    'new_secondary_status' => 'Pending Review',
				                    'note' =>'',
				                    'creator_id' => CRUDBooster::myId(),
				                    'created_at' => \DB::raw('NOW()')

				                ]);
								if($addToJo)
									return 'success';
								else 
									return 'failed1';
							}
							else {
								return 'failed2';
							}
					        }
				
						}
			$candidate_industry_functional_areas=DB::table('candidate_industry_functional_areas')->where('candidate_id',$id)->get();
			$candidate_industry_functional_area_roles = DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$id)->get();
			//$candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->get();
			$candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$id)->get();
			$candidate_qualifications = DB::table('candidate_qualifications')->where('candidate_id',$id)->get();
			$candidate_jo = DB::table('job_order_applicants')
			->select('job_order_applicants.*','companies.name as company','job_orders.*', 'offices.name as office','job_order_applicants.created_at as addedOn','job_order_applicants.creator_id as addedBy')
			->join('job_orders','job_orders.id','=','job_order_applicants.job_order_id')
			->join('companies','companies.id','=','job_orders.company_id')
			->join('offices','offices.id','=','job_orders.office_id')
			->join('cms_users','cms_users.id','=','job_order_applicants.creator_id')
			->where('job_order_applicants.candidate_id',$id)
			->whereNull('job_order_applicants.deleted_at')
			->orderBy('job_order_applicants.id','desc')
			->get();
			$candidate_association_count = count($candidate_jo);

			$row->country = $country;
			$row->state = $state;
			$row->city = $city;
			$row->source = $source;
			$row->highest_qualification_level = $highest_qualification_level;
			$row->highest_qualification = $highest_qualification;
			$row->current_city = $current_city;
			$row->preferred_city = $preferred_city;
			$row->industries = $industries;
			$row->industry_functional_areas = $industry_functional_areas;
			$row->general_skills= []; 
			
			foreach ($general_skills as $general_skill) {
				$row->general_skills[] = DB::table('general_skills')->find($general_skill->general_skill)->name;
			}

			$row->postal_code = DB::table('postal_codes')->find($row->postal_code)->name;
			$row->creator = DB::table('cms_users')->find($row->creator_id)->name;
			$row->candidate_industry_functional_area_roles = $candidate_industry_functional_area_roles;
			$row->candidate_industry_functional_areas = $candidate_industry_functional_areas;
			$row->candidate_industry_functional_area_skills = $candidate_industry_functional_area_skills;
			$row->candidate_qualifications = $candidate_qualifications;
			$row->candidate_jo = $candidate_jo;
			foreach($row->candidate_jo as $jo)
			{
			if(!empty($jo->candidate_id)) {
               $jo->candidate = \DB::table('candidates')->find($jo->candidate_id);
            }
            else{
             $jo->candidate ='';  
            }
			 if(!empty($jo->candidate_id))
            {
                $jo->job_order_applicant  = \DB::table('job_order_applicants')->where('job_order_id',$jo->job_order_id)->where('candidate_id', $jo->candidate_id)->whereNull('deleted_at')->first(); // ->select('next_action')
                if(!empty($jo->job_order_applicant ))
                {
                    $jo->job_order_applicant->lastActivity = DB::table('job_order_applicant_statuses')
                    ->where('job_order_applicant_id', $jo->job_order_applicant->id)
                    ->orderBy('id', 'desc')
                    ->first();
                }
            }
            else{
             $jo->job_order_applicant='' ;  
            }
        }
			$row->candidate_association_count = $candidate_association_count;

			$candidate_resume = DB::table('candidate_resumes')->orderby('id','desc')->where('candidate_id',$id)->first();
			$row->resume_url = $candidate_resume->resume_url;

			if($row->can_relocate == 1) {
				$row->can_relocate = 'Yes';
			} else {
				$row->can_relocate = 'No';
			}

			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_detail==FALSE) {
				CRUDBooster::insertLog(trans("crudbooster.log_try_view",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			}

			$module     = CRUDBooster::getCurrentModule();
			$page_menu  = Route::getCurrentRoute()->getActionName();
			$page_title = trans("crudbooster.detail_data_page_title",['module'=>$module->name,'name'=>$row->{$this->title_field}]);
			$command    = 'detail';

			Session::put('current_row_id',$id);
			//return view('crudbooster::default.form',compact('row','page_menu','page_title','command','id'));
			$this->cbView('override.candidates.main',compact('row','page_menu','page_title','command','id','industries','jobOrders'));
		}

		public function getIndex() {

			if(!CRUDBooster::isView()) CRUDBooster::denyAccess();

			$page_title = 'Candidates';
			$data = [];
			$data['page_title'] = 'Candidates';
			$cities = DB::table('cities')->orderby('name','asc')->get();
			$industries = DB::table('industries')->orderby('name','asc')->get();
			
			$industry_functional_areas = DB::table('industry_functional_areas')->orderby('name','asc')->get();

			$industry_functional_area_skills = DB::table('industry_functional_area_skills')->groupBy('name')->orderby('name','asc');

			$industry_functional_area_roles = DB::table('industry_functional_area_roles')->groupBy('name')->orderby('name','asc');

			//To Prefill Functional Area Skill If Selected
			if(!($_REQUEST['functional_area'] == '' || $_REQUEST['current_action'] == 'list_functional_roles_skills')) {				
				$functional_area_id = explode('--', $_REQUEST['functional_area']);
				$industry_functional_area_skills = $industry_functional_area_skills->where('industry_functional_area_id',$functional_area_id);

				$industry_functional_area_roles = $industry_functional_area_roles->where('industry_functional_area_id',$functional_area_id);
			}
		
			$industry_functional_area_skills = $industry_functional_area_skills->get();

			$industry_functional_area_roles = $industry_functional_area_roles->get();

			$designations = DB::table('candidates')->groupBy('current_designation')->whereNotNull('current_designation')->where('current_designation','!=','')->pluck('current_designation','current_designation');
			
			if(CRUDBooster::myPrivilegeName() === 'Recruiter'){
			$jobOrders = DB::table('job_orders')
			->whereNotIn('status', ['Completed','Cancelled','On Hold','Intro Call Scheduled','New'])
			->where('recruiter',CRUDBooster::myId())
			->orderby('id','desc')->get();
        	}
			else{
				
			$jobOrders = DB::table('job_orders')
			->whereNotIn('status', ['Completed','Cancelled','On Hold','Intro Call Scheduled','New'])
			->orderby('id','desc')->get();	
			}

			$email_templates = DB::table('cms_email_templates')->orderby('name','desc')->get();

			// echo '<pre>';print_r($_REQUEST['location']);exit;

		
		
			// Default Listing
			if($_REQUEST['functional_area']=='' && $_REQUEST['functional_area_skills']=='' && $_REQUEST['functional_area_roles']=='' && $_REQUEST['industry']=='' && $_REQUEST['fromResume']=='' && $_REQUEST['minExpY']=='' && $_REQUEST['minExpM']=='' && $_REQUEST['maxExpM']==''  && $_REQUEST['minCtc']==''  && $_REQUEST['maxCtc']=='' &&
				$_REQUEST['maxExpY']=='' && $_REQUEST['location']=='' && 
				$_REQUEST['firstName']=='' && $_REQUEST['lastName']=='' && $_REQUEST['ugQualification']=='' && $_REQUEST['pgQualification']=='' && $_REQUEST['gender']=='' &&  $_REQUEST['relationship_status']=='' && $_REQUEST['notice_period']=='' && (trim($_REQUEST['q']) =='' ) && (trim($_REQUEST['must_search']) =='' ) && $_REQUEST['designation']=='' )
				
				{

					
							if(isset($_REQUEST['limit']) && $_REQUEST['limit'] !=''){
								$limit = $_REQUEST['limit'];
							 }else{
								 $limit = 20;
							 }

							 if(isset($_REQUEST['order']) && $_REQUEST['order'] !=''){
								 if($_REQUEST['order'] == 'relavent'){
									$order = 'candidates.updated_at';
								 }elseif($_REQUEST['order'] == 'newly_added'){
									$order = 'candidates.created_at';
								 }
							 }else{
								 $order = 'candidates.updated_at';
							 }


							$result = DB::table('candidates');
							$result = $result->orderby($order,'desc');

							if(isset($_REQUEST['active_in']) && $_REQUEST['active_in'] !=''){

								if($_REQUEST['active_in'] == 'last_15_days'){
									$result = $result->where('candidates.updated_at','>=',Carbon::now()->subdays(15));
								}elseif($_REQUEST['active_in'] == 'last_month'){
									$result = $result->whereMonth('candidates.updated_at','=',Carbon::now()->subMonth()->month);
								}elseif($_REQUEST['active_in'] == 'last_2_month'){
									$dateS = Carbon::now()->startOfMonth()->subMonth(2);
									$dateE = Carbon::now(); 
									$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								}elseif($_REQUEST['active_in'] == 'last_5_month'){
									$dateS = Carbon::now()->startOfMonth()->subMonth(5);
									$dateE = Carbon::now(); 
									$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								}elseif($_REQUEST['active_in'] == 'last_year'){
									$dateS = Carbon::now()->startOfYear()->subYear();
									$dateE = Carbon::now(); 
									$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								}
		
							 }

							 $result = $result->paginate($limit);

							$i=0;
							foreach ($result as $candidate) {
								$_current_city_name = DB::table('cities')
								->find($candidate->current_city)->name;
								$result[$i]->current_city_name = $_current_city_name;
								$result[$i]->candidate_industries = DB::table('candidate_industries')
								->where('candidate_id','=', $candidate->id)
								->get();
								$result[$i]->candidate_industry_functional_areas = DB::table('candidate_industry_functional_areas')
								->where('candidate_id','=', $candidate->id)
								->get();
								$result[$i]->candidate_industry_functional_area_roles = DB::table('candidate_industry_functional_area_roles')
								->where('candidate_id','=', $candidate->id)
								->get(); 
								$result[$i]->candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')
								->where('candidate_id','=', $candidate->id)
								->get();
								$result[$i]->latestAssociation =DB::table('job_order_applicants')
											->select('job_order_applicants.*','companies.name as company','job_orders.*', 'offices.name as office','job_order_applicants.created_at as addedOn','job_order_applicants.id as applicant_id')
											->join('job_orders','job_orders.id','=','job_order_applicants.job_order_id')
											->join('companies','companies.id','=','job_orders.company_id')
											->join('offices','offices.id','=','job_orders.office_id')
											->join('cms_users','cms_users.id','=','job_order_applicants.creator_id')
											->where('job_order_applicants.candidate_id',$candidate->id)
											->whereNull('job_order_applicants.deleted_at')
											->orderBy('job_order_applicants.id','desc')
											->get();
								$result[$i]->totalAssociation = count($result[$i]->latestAssociation);
								$result[$i]->highest_qualification = DB::table('qualifications')->find($result[$i]->highest_qualification)->qualification;

								$candidate_resume = DB::table('candidate_resumes')->orderby('id','desc')->where('candidate_id',$candidate->id)->first();
								$result[$i]->resume_url = $candidate_resume->resume_url;
		
								
								$i++;
							}
						} 
			            //Search Listing
						else{	

						
						
							$cids = [];
							
							// Functional Area
							if($_REQUEST['functional_area']!=''&& $_REQUEST['q']=='') {
								$_functional_area = explode('--', $_REQUEST['functional_area']);
								$result_f_a = DB::table('candidate_industry_functional_areas')->select('candidate_id')->where('candidate_industry_functional_areas.industry_functional_area','like', '%' .$_functional_area[1].'%')->get();
								if($result_f_a) {
									foreach ($result_f_a as $_cids) {
										$cids[] = $_cids->candidate_id;
									}
								}
							}
							//return 1;
							// Functional Area Skills
							$skills_cids = [];
							if($_REQUEST['functional_area_skills']!=''&& $_REQUEST['q']=='') {
								foreach ($_REQUEST['functional_area_skills'] as $functional_area_skill) {
									$_functional_area_skill = explode('--', $functional_area_skill);
									
									$result_f_a_s = DB::table('candidate_industry_functional_area_skills')->select('candidate_id')->where('candidate_industry_functional_area_skills.industry_functional_area_skill','like', '%' .$_functional_area_skill[1].'%')->get();
									
									if($result_f_a_s) {
										foreach ($result_f_a_s as $_scids) {
											$skills_cids[] = $_scids->candidate_id;
										}
									}
								}
								$cids = array_merge($cids,$skills_cids);
							}

							# Functional Area Roles
							$role_ids = [];
							if($_REQUEST['functional_area_roles']!=''&& $_REQUEST['q']=='') {
								foreach ($_REQUEST['functional_area_roles'] as $functional_area_role) {
									$_functional_area_role = explode('--', $functional_area_role);
									$result_f_a_r = DB::table('candidate_industry_functional_area_roles')->select('candidate_id')->where('candidate_industry_functional_area_roles.industry_functional_area_role_id',$_functional_area_role[0])->get();
									
									if($result_f_a_r) {
										foreach ($result_f_a_r as $_scids) {
											$role_ids[] = $_scids->candidate_id;
										}

									}
								}
								$cids = array_merge($cids,$role_ids);

							}

							// Industry
							$industry_cids = [];
							if($_REQUEST['industry']!='' && $_REQUEST['q']=='') {
								$_industry = explode('--', $_REQUEST['industry']);
								$result_i = DB::table('candidate_industries')->select('candidate_id')->where('candidate_industries.industry','like', '%' .$_industry[1].'%')->get();
								if($result_i) {
									foreach ($result_i as $_icids) {
										$industry_cids[] = $_icids->candidate_id;
									}
								}
								$cids = array_merge($cids,$industry_cids);
							}

				            // Resume 
							if(($_REQUEST['fromResume'] == 'entireResume') && ($_functional_area[1] !=''|| $_functional_area_skill[1] !=''||  $_industry[1] !='' || $_REQUEST['location']!='') && $_REQUEST['q']=='') {
								$resumeResults = DB::table('candidates');
								if($_functional_area[1]) {
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$_functional_area[1].'%');
								}								
								if($_functional_area_skill[1]) {
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$_functional_area_skill[1].'%');
								}										
								if($_industry[1]) {
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$_industry[1].'%');
								}
								// if($_REQUEST['location']!='') {
								// 	$resumeCity = explode('-', $_REQUEST['location']);
								// 	$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$resumeCity[1].'%');
								// }
								$resumeResults = $resumeResults->get();

								$resumeCid = [];
								foreach ($resumeResults as $resumeResult) {
									$resumeCid[] = 	$resumeResult->id;
								}
								$cids = array_merge($cids,$resumeCid);
							}

							if($_REQUEST['industry']!='' && $_REQUEST['q']=='') {
								$_industry = explode('--', $_REQUEST['industry']);
								$result_i = DB::table('candidate_industries')->select('candidate_id')->where('candidate_industries.industry','like', '%' .$_industry[1].'%')->get();
								if($result_i) {
									foreach ($result_i as $_icids) {
										$industry_cids[] = $_icids->candidate_id;
									}
								}
								$cids = array_merge($cids,$industry_cids);
							}



							$cids = array_unique($cids);
								//dump($cids);
							if($_REQUEST['q']==''){
									$result = DB::table('candidates');	
							}
							else{
								//return $_REQUEST['q'];
								$result=[];
								
							}	


							// Experience years
							 if(($_REQUEST['minExpY']!='' ||  $_REQUEST['maxExpY']!='') && $_REQUEST['q']=='') {

								$minExp = 0;
								$maxExp = 150;

								if($_REQUEST['minExpY']!='' && is_numeric($_REQUEST['minExpY'])){
									$minExpY = explode(".",$_REQUEST['minExpY']);
									$minExpMnth = $minExpY[1] != '' ? $minExpY[1] : 0;
									$minExpyYear = $minExpY[0]*12;
									$minExp = $minExpyYear+$minExpMnth;
								}

								if($_REQUEST['maxExpY']!='' && is_numeric($_REQUEST['maxExpY'])){
									$maxExpY = explode(".",$_REQUEST['maxExpY']);
									$maxExpMnth = $maxExpY[1] != '' ? $maxExpY[1] : 0;
									$maxExpyYear = $maxExpY[0]*12;
									$maxExp = $maxExpyYear+$maxExpMnth;
								}

								$result = $result->whereRaw('((candidates.experience_years*12)+candidates.experience_months) >='.$minExp)
								->whereRaw('((candidates.experience_years*12)+candidates.experience_months)<='.$maxExp);

							}


							/*if($_REQUEST['functional_area']!='' || $_REQUEST['functional_area_skills']!='' || $_REQUEST['industry']!=''||$_REQUEST['functional_area_roles']!=''&& $_REQUEST['q']==''){
								$result = $result->whereIn('candidates.id', $cids);

							}*/
							// Location
							if($_REQUEST['location']!=''&& $_REQUEST['q']=='') {
							
								$locationArray = explode(',',$_REQUEST['location']);
								$result = $result->whereIn('candidates.current_city',$locationArray);
							}

							if($_REQUEST['designation']!=''&& $_REQUEST['q']=='') {
							
								$designationArray = explode(',',$_REQUEST['designation']);
								$result = $result->whereIn('candidates.current_designation',$designationArray);
							}

							// First name 
							if($_REQUEST['firstName']!=''&& $_REQUEST['q']=='') {
								$result = $result->where('candidates.first_name','like', '%' .$_REQUEST['firstName'].'%');
							}
							// Last name
							if($_REQUEST['lastName']!=''&& $_REQUEST['q']=='') {
								$result = $result->where('candidates.last_name','like', '%' .$_REQUEST['lastName'].'%');
							}

							
							//Max Ctc
							if($_REQUEST['maxCtc'] != '' && $_REQUEST['q']=='' ) {
								$result = $result->where('candidates.current_ctc','<=',($_REQUEST['maxCtc'] * 100000) );
							}
							//Min Ctc
							if($_REQUEST['minCtc'] != '' && $_REQUEST['q']=='') {
							
								$result = $result->where('candidates.current_ctc','>=',( $_REQUEST['minCtc'] * 100000) );	
							}
							//Gender
							if($_REQUEST['gender'] != ''&& $_REQUEST['q']=='') {
								//return 1;
								$result = $result->where('candidates.gender',$_REQUEST['gender']);	
							}
							if($_REQUEST['relationship_status'] != ''&& $_REQUEST['q']=='') {
								$result = $result->where('candidates.relationship_status',$_REQUEST['relationship_status']);	
							}

							//Notice Period
							if($_REQUEST['notice_period'] != ''&& $_REQUEST['q']=='') {
								$result = $result->where('candidates.notice_period',$_REQUEST['notice_period']);	
							}

							if($_REQUEST['ugQualification'] != ''&& $_REQUEST['pgQualification']=='') {
								
				
								if($_REQUEST['ugQualification'] == 'any'){
									
								
									
									// $result = $result->where('candidates.highest_qualification_level',1);
								
								
									
								}
								elseif($_REQUEST['ugQualification'] == 'no'){
									
									
									
									$result = $result->where('candidates.highest_qualification_level','!=',1);

								}else if($_REQUEST['ugQualification'] != 'no' && $_REQUEST['ugQualification'] != ''){
									

									$result = $result->where('candidates.highest_qualification_level',1)->where('candidates.highest_qualification',$_REQUEST['ugQualification']);
								}

								if($_REQUEST['pgQualification'] == 'any'){
									
									//return 1;
									$result = $result->where('candidates.highest_qualification_level',2);
								}
								elseif($_REQUEST['pgQualification'] == 'no'){
									
									$result = $result->where('candidates.highest_qualification_level','!=',2);

								}else if($_REQUEST['pgQualification'] != 'no' && $_REQUEST['pgQualification'] != ''){
									$result = $result->where('candidates.highest_qualification_level',2)->where('candidates.highest_qualification',$_REQUEST['pgQualification']);
								}
							
							}

							
							if(!empty($cids) && $_REQUEST['q']==''){
								$result = $result->whereIn('id',$cids);
							}

						
							if(isset($_REQUEST['limit']) && $_REQUEST['limit'] !=''){
                               $limit = $_REQUEST['limit'];
							}else{
								$limit = 20;
							}
							
							if(isset($_REQUEST['order']) && $_REQUEST['order'] !=''){
								if($_REQUEST['order'] == 'relavent'){
								   $order = 'candidates.updated_at';
								}elseif($_REQUEST['order'] == 'newly_added'){
								   $order = 'candidates.created_at';
								}
							}else{
								$order = 'candidates.updated_at';
							}


							if($_REQUEST['q']==''){
								
							   $result = $result->orderby($order,'desc');

							   if(isset($_REQUEST['active_in']) && $_REQUEST['active_in'] !=''){

								if($_REQUEST['active_in'] == 'last_15_days'){
									$result = $result->where('candidates.updated_at','>=',Carbon::now()->subdays(15));
								}elseif($_REQUEST['active_in'] == 'last_month'){
									$result = $result->whereMonth('candidates.updated_at','=',Carbon::now()->subMonth()->month);
								}elseif($_REQUEST['active_in'] == 'last_2_month'){
									$dateS = Carbon::now()->startOfMonth()->subMonth(2);
									$dateE = Carbon::now(); 
									$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								}elseif($_REQUEST['active_in'] == 'last_5_month'){
									$dateS = Carbon::now()->startOfMonth()->subMonth(5);
									$dateE = Carbon::now(); 
									$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								}elseif($_REQUEST['active_in'] == 'last_year'){
									$dateS = Carbon::now()->startOfYear()->subYear();
									$dateE = Carbon::now(); 
									$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								}
							 }
							
							 $result = $result->paginate($limit);

							}else{
								
								$result=[];
							}



							
							if(trim($_REQUEST['q']) || trim($_REQUEST['must_search'])) {
								// //return 1;

								// //dump($cids);
								//  //                       $length = preg_match_all ('/[^ \.]/' ,$_REQUEST['q'], $matches);
                                //  //                         if($length==2)
                                //    //                         {
                                //  //                         $search= str_replace(' ', '',$_REQUEST['q']);
                                //  //                         }
								// // else{
								// // $search= str_replace(' ', ' ',$_REQUEST['q']);
								// // }
								// /*$result = $this->getCandidateFromSearchQuery(trim($_REQUEST['q']));*/	



								if($_REQUEST['must_search'] != ''){

								
									$wordlist = array("is", "on", "the");
									foreach ($wordlist as &$word) {
										$word = '/\b' . preg_quote($word, '/') . '\b/';
									}
									$_query = preg_replace($wordlist,'', $_REQUEST['must_search']);
									$_query=str_replace(array(',', '-','_'), " ", $_query);
									$_query=str_replace(array("'"), "\'", $_query);
									$queries =explode(' ',$_query);
									$candidateIds = [];
									$filteredCandidates = [];
								
									$i = 0;
									//$queries=array_filter($queries);
									

								
									foreach($queries as $query) {
										$domain = ltrim(stristr($query, '@'), '@') . '.';
										$user   = stristr($query, '@', TRUE);
										if(!empty($user) &&!empty($domain) &&checkdnsrr($domain)){
							
											  $email='\"'.$query.'\"';
											  $query=$email;
											  $orQuery=$email;
										}
										else{
											 $orQuery=$query;
											 $query='"'.$query.'"';
										}
							
								
										if(strlen($orQuery)>1 && strlen($query)>1) {
											$cids = [];

											$candidatesDet =DB::table('candidates')
											    ->WhereRaw("MATCH(current_designation) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('current_designation','like', "%$orQuery%")
												->orWhereRaw("MATCH (first_name) AGAINST ('".$query."'IN BOOLEAN MODE)")
												->orWhere('first_name','like', "%$orQuery%")
												->orWhereRaw("MATCH (last_name) AGAINST ('".$query."'IN BOOLEAN MODE)")
												->orWhere('last_name','like', "%$orQuery%")
												// ->orWhereRaw('(CONCAT(candidates.first_name," ",candidates.last_name) like ?)', "%$orQuery%")
												->orWhereRaw("MATCH(religion) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('religion','like', "%$orQuery%")
												// ->orWhereRaw("MATCH(head_line) AGAINST('".$query."' IN BOOLEAN MODE)")
												// ->orWhere('head_line','like', "%$orQuery%")
												->orWhereRaw("MATCH(current_employer) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('current_employer','like', "%$orQuery%")
												
												->orWhereRaw("MATCH(category) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('category','like', "%$orQuery%")
												->orWhereRaw("MATCH(address) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('address','like', "%$orQuery%")
												->orWhereRaw("MATCH(primary_email) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('primary_email','like', "%$orQuery%")
												->orWhereRaw("MATCH(secondary_email) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('secondary_email','like', "%$orQuery%")
												->orWhereRaw("MATCH(primary_phone) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('primary_phone','like', "%$orQuery%") 
												->orWhereRaw("MATCH(secondary_phone) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('secondary_phone','like', "%$orQuery%")
												// ->orWhereRaw("MATCH(resume_content) AGAINST('".$query."' IN BOOLEAN MODE)")
												// ->orWhere('resume_content','like', "%$orQuery%")
												->get();

							
											foreach($candidatesDet as $candidate){
												$cids[] = $candidate->id;
											}
							
							
											$candidate_general_skills = DB::table('candidate_general_skills')
											->whereRaw("MATCH(general_skill) AGAINST('".$query."' IN BOOLEAN MODE)")
											->orWhere('general_skill','like', "%$orQuery%")
											->get();
											foreach($candidate_general_skills as $candidate_general_skill) {
												$cids[] = $candidate_general_skill->candidate_id; 
											}
							
											$candidate_industries = DB::table('candidate_industries')
											->whereRaw("MATCH(industry) AGAINST('".$query."' IN BOOLEAN MODE)")
											->orWhere('industry','like', "%$orQuery%")
											->get();
							
											foreach($candidate_industries as $candidate_industry) {
												$cids[] = $candidate_industry->candidate_id; 
											}
							
											
											$candidate_industry_functional_areas = DB::table('candidate_industry_functional_areas')
												->whereRaw("MATCH(industry_functional_area) AGAINST('".$query."' IN BOOLEAN MODE)")
												->orWhere('industry_functional_area','like', "%$orQuery%")
												->get();
											foreach($candidate_industry_functional_areas as $candidate_industry_functional_area) {
												$cids[] = $candidate_industry_functional_area->candidate_id; 
											}
							
											$candidate_industry_functional_area_roles = DB::table('candidate_industry_functional_area_roles')
											->whereRaw("MATCH(role) AGAINST('".$query."' IN BOOLEAN MODE)")
											->orWhere('role','like', "%$orQuery%")
											->get();
											foreach($candidate_industry_functional_area_roles as $candidate_industry_functional_area_role) {
												$cids[] = $candidate_industry_functional_area_role->candidate_id; 
											}
							
										$candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')->whereRaw("MATCH(industry_functional_area_skill) AGAINST('".$query."' IN BOOLEAN MODE)")
										->orWhere('industry_functional_area_skill','like', "%$orQuery%")
										->get();
											foreach($candidate_industry_functional_area_skills as $candidate_industry_functional_area_skill) {
												$cids[] = $candidate_industry_functional_area_skill->candidate_id; 
											}
							
											$candidate_qualifications = DB::table('candidate_qualifications')
											->whereRaw("MATCH(qualification) AGAINST('".$query."' IN BOOLEAN MODE)")
											->orWhere('qualification','like', "%$orQuery%")
											->get();
							
											foreach($candidate_qualifications as $candidate_qualification) {
												$cids[] = $candidate_qualification->candidate_id; 
											}
							
											$candidateIds[$i] = $cids;
											$i++;
										}
									}
				

									$filter_candidate[] = '';

									if(count($candidateIds) > 1){

										for ($i = 0; $i < (count($candidateIds) - 1 ) ; $i++) {
											if($candidateIds[$i+1]) {
												$filter_candidate = array_intersect($candidateIds[$i], $candidateIds[$i+1]);
											}
										}

									}else{
										$filter_candidate = ($candidateIds[0]) ? $candidateIds[0] : [];
									}

								
									$must_matched_ids=array_merge($filter_candidate,$filter_candidate);
									$must_matched_ids=array_unique($must_matched_ids);
									$new_matched_array = array();
									array_walk_recursive($must_matched_ids, function($a) use (&$new_matched_array) { $new_matched_array[] = $a; });

									

								}else{
									//return 1;

									$matched_ids=$this->getCandidateFromSearchQuery(trim($_REQUEST['q']),$_REQUEST['functional_area'],$_REQUEST['functional_area_skills'], $_REQUEST['industry'],$_REQUEST['functional_area_roles'],$_REQUEST['location']);
								
									$matched_ids=array_merge($matched_ids,$matched_ids);
									$matched_ids=array_unique($matched_ids);
									$new_matched_array = array();
									array_walk_recursive($matched_ids, function($a) use (&$new_matched_array) { $new_matched_array[] = $a; });

								}



								if($_REQUEST['must_search'] == ''){


										//dd(empty($matched_ids));
										if(!empty(array_filter($matched_ids)))	{


											$result = DB::table('candidates');	

											// Experience years
											if($_REQUEST['minExpY']!='' ||  $_REQUEST['maxExpY']!='') {

												$minExp = 0;
												$maxExp = 150;
				
												if($_REQUEST['minExpY']!='' && is_numeric($_REQUEST['minExpY'])){
													$minExpY = explode(".",$_REQUEST['minExpY']);
													$minExpMnth = $minExpY[1] != '' ? $minExpY[1] : 0;
													$minExpyYear = $minExpY[0]*12;
													$minExp = $minExpyYear+$minExpMnth;
												}
				
												if($_REQUEST['maxExpY']!='' && is_numeric($_REQUEST['maxExpY'])){
													$maxExpY = explode(".",$_REQUEST['maxExpY']);
													$maxExpMnth = $maxExpY[1] != '' ? $maxExpY[1] : 0;
													$maxExpyYear = $maxExpY[0]*12;
													$maxExp = $maxExpyYear+$maxExpMnth;
												}

												$result = $result->whereRaw('((candidates.experience_years*12)+candidates.experience_months) >='.$minExp)
												->whereRaw('((candidates.experience_years*12)+candidates.experience_months)<='.$maxExp);
				
											   }


												/*if($_REQUEST['functional_area']!='' || $_REQUEST['functional_area_skills']!='' || $_REQUEST['industry']!=''||$_REQUEST['functional_area_roles']!=''){
													
													$result=$result->whereIn('candidates.id',$matched_ids[0]);

												}*/

												// Location
												if($_REQUEST['location']!='') {
													$locationArray = explode(',',$_REQUEST['location']);
													$result = $result->whereIn('candidates.current_city',$locationArray);
												}

												if($_REQUEST['designation']!=''&& $_REQUEST['q']=='') {
													$designationArray = explode(',',$_REQUEST['designation']);
													$result = $result->whereIn('candidates.current_designation',$designationArray);
												}

												// First name 
												if($_REQUEST['firstName']!='') {
													$result = $result->where('candidates.first_name','like', '%' .$_REQUEST['firstName'].'%');
												}
												// Last name
												if($_REQUEST['lastName']!='') {
													$result = $result->where('candidates.last_name','like', '%' .$_REQUEST['lastName'].'%');
												}
												//Max Ctc
												if($_REQUEST['maxCtc'] != '' ) {
													$result = $result->where('candidates.current_ctc','<=',($_REQUEST['maxCtc'] * 100000));
												}
												//Min Ctc
												if($_REQUEST['minCtc'] != '') {
													$result = $result->where('candidates.current_ctc','>=',($_REQUEST['minCtc'] * 100000));
												}

												//Gender
												if($_REQUEST['gender'] != '') {
													//return 1;
													$result = $result->where('candidates.gender',$_REQUEST['gender']);	
												}

												if($_REQUEST['relationship_status'] != '') {
													$result = $result->where('candidates.relationship_status',$_REQUEST['relationship_status']);	
												}

												//Notice Period
												if($_REQUEST['notice_period'] != ''&& $_REQUEST['q']=='') {
													$result = $result->where('candidates.notice_period',$_REQUEST['notice_period']);	
												}


												if($_REQUEST['ugQualification'] != ''&& $_REQUEST['pgQualification']=='') {
													
													if($_REQUEST['ugQualification'] == 'any'){
													
														$result = $result->where('candidates.highest_qualification_level',1);
													}
													elseif($_REQUEST['ugQualification'] == 'no'){
														$result = $result->where('candidates.highest_qualification_level','!=',1);

													}else if($_REQUEST['ugQualification'] != 'no' && $_REQUEST['ugQualification'] != ''){
														$result = $result->where('candidates.highest_qualification_level',1)->where('candidates.highest_qualification',$_REQUEST['ugQualification']);
													}

													if($_REQUEST['pgQualification'] == 'any'){
														$result = $result->where('candidates.highest_qualification_level',2);
													}
													elseif($_REQUEST['pgQualification'] == 'no'){
														$result = $result->where('candidates.highest_qualification_level','!=',2);

													}else if($_REQUEST['pgQualification'] != 'no' && $_REQUEST['pgQualification'] != ''){
														$result = $result->where('candidates.highest_qualification_level',2)->where('candidates.highest_qualification',$_REQUEST['pgQualification']);
													}
												}

												if(isset($_REQUEST['limit']) && $_REQUEST['limit']==''){
													$limit = $_REQUEST['limit'];
												 }else{
													 $limit = 20;
												 }

												 if(isset($_REQUEST['order']) && $_REQUEST['order'] !=''){
													if($_REQUEST['order'] == 'relavent'){
													   $order = 'candidates.updated_at';
													}elseif($_REQUEST['order'] == 'newly_added'){
													   $order = 'candidates.created_at';
													}
												}else{
													$order = 'candidates.updated_at';
												}

								
												$result=$result->wherein('candidates.id',$new_matched_array);
												$result=$result->orderby($order,'desc');

												if(isset($_REQUEST['active_in']) && $_REQUEST['active_in'] !=''){

													if($_REQUEST['active_in'] == 'last_15_days'){
														$result = $result->where('candidates.updated_at','>=',Carbon::now()->subdays(15));
													}elseif($_REQUEST['active_in'] == 'last_month'){
														$result = $result->whereMonth('candidates.updated_at','=',Carbon::now()->subMonth()->month);
													}elseif($_REQUEST['active_in'] == 'last_2_month'){
					
														$dateS = Carbon::now()->startOfMonth()->subMonth(2);
														$dateE = Carbon::now(); 
														$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
					
													}elseif($_REQUEST['active_in'] == 'last_5_month'){
							
														$dateS = Carbon::now()->startOfMonth()->subMonth(5);
														$dateE = Carbon::now(); 
														$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
					
													}elseif($_REQUEST['active_in'] == 'last_year'){
					
														$dateS = Carbon::now()->startOfYear()->subYear();
														$dateE = Carbon::now(); 
														$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
														
													}
							
												 }
					
												 $result = $result->paginate($limit);
												//dd($result);
											}

								    	}else{
											

												    //dd(empty($matched_ids));
													if(!empty(array_filter($must_matched_ids)))	{


														$result = DB::table('candidates');	

														// Experience years
														if($_REQUEST['minExpY']!='' ||  $_REQUEST['maxExpY']!='') {

															$minExp = 0;
															$maxExp = 150;
							
															if($_REQUEST['minExpY']!='' && is_numeric($_REQUEST['minExpY'])){
																$minExpY = explode(".",$_REQUEST['minExpY']);
																$minExpMnth = $minExpY[1] != '' ? $minExpY[1] : 0;
																$minExpyYear = $minExpY[0]*12;
																$minExp = $minExpyYear+$minExpMnth;
															}
							
															if($_REQUEST['maxExpY']!='' && is_numeric($_REQUEST['maxExpY']) ){
																$maxExpY = explode(".",$_REQUEST['maxExpY']);
																$maxExpMnth = $maxExpY[1] != '' ? $maxExpY[1] : 0;
																$maxExpyYear = $maxExpY[0]*12;
																$maxExp = $maxExpyYear+$maxExpMnth;
															}

															$result = $result->whereRaw('((candidates.experience_years*12)+candidates.experience_months) >='.$minExp)
															->whereRaw('((candidates.experience_years*12)+candidates.experience_months)<='.$maxExp);
							
														}


															/*if($_REQUEST['functional_area']!='' || $_REQUEST['functional_area_skills']!='' || $_REQUEST['industry']!=''||$_REQUEST['functional_area_roles']!=''){
																
																$result=$result->whereIn('candidates.id',$matched_ids[0]);

															}*/

															// Location
															if($_REQUEST['location']!='') {
																$locationArray = explode(',',$_REQUEST['location']);
																$result = $result->whereIn('candidates.current_city',$locationArray);
															}

															if($_REQUEST['designation']!=''&& $_REQUEST['q']=='') {
																$designationArray = explode(',',$_REQUEST['designation']);
																$result = $result->whereIn('candidates.current_designation',$designationArray);
															}

															// First name 
															if($_REQUEST['firstName']!='') {
																$result = $result->where('candidates.first_name','like', '%' .$_REQUEST['firstName'].'%');
															}
															// Last name
															if($_REQUEST['lastName']!='') {
																$result = $result->where('candidates.last_name','like', '%' .$_REQUEST['lastName'].'%');
															}
															//Max Ctc
															if($_REQUEST['maxCtc'] != '' ) {
																$result = $result->where('candidates.current_ctc','<=',($_REQUEST['maxCtc'] * 100000));
															}
															//Min Ctc
															if($_REQUEST['minCtc'] != '' ) {
																$result = $result->where('candidates.current_ctc','>=',($_REQUEST['minCtc'] * 100000));
															}

															//Gender
															if($_REQUEST['gender'] != '') {
																$result = $result->where('candidates.gender',$_REQUEST['gender']);	
															}

															if($_REQUEST['relationship_status'] != '') {
																$result = $result->where('candidates.relationship_status',$_REQUEST['relationship_status']);	
															}

															//Notice Period
															if($_REQUEST['notice_period'] != ''&& $_REQUEST['q']=='') {
																$result = $result->where('candidates.notice_period',$_REQUEST['notice_period']);	
															}


															if($_REQUEST['ugQualification'] != ''&& $_REQUEST['pgQualification']=='') {
																
																if($_REQUEST['ugQualification'] == 'any'){
																	$result = $result->where('candidates.highest_qualification_level',1);
																}
																elseif($_REQUEST['ugQualification'] == 'no'){
																	$result = $result->where('candidates.highest_qualification_level','!=',1);

																}else if($_REQUEST['ugQualification'] != 'no' && $_REQUEST['ugQualification'] != ''){
																	$result = $result->where('candidates.highest_qualification_level',1)->where('candidates.highest_qualification',$_REQUEST['ugQualification']);
																}

																if($_REQUEST['pgQualification'] == 'any'){
																	$result = $result->where('candidates.highest_qualification_level',2);
																}
																elseif($_REQUEST['pgQualification'] == 'no'){
																	$result = $result->where('candidates.highest_qualification_level','!=',2);

																}else if($_REQUEST['pgQualification'] != 'no' && $_REQUEST['pgQualification'] != ''){
																	$result = $result->where('candidates.highest_qualification_level',2)->where('candidates.highest_qualification',$_REQUEST['pgQualification']);
																}
															}

															if(isset($_REQUEST['limit']) && $_REQUEST['limit']==''){
																$limit = $_REQUEST['limit'];
															 }else{
																 $limit = 20;
															 }


															 if(isset($_REQUEST['order']) && $_REQUEST['order'] !=''){
																if($_REQUEST['order'] == 'relavent'){
																   $order = 'candidates.updated_at';
																}elseif($_REQUEST['order'] == 'newly_added'){
																   $order = 'candidates.created_at';
																}
															}else{
																$order = 'candidates.updated_at';
															}

												
															$result=$result->wherein('candidates.id',$new_matched_array);
															$result=$result->orderby($order,'desc');

															if(isset($_REQUEST['active_in']) && $_REQUEST['active_in'] !=''){

																if($_REQUEST['active_in'] == 'last_15_days'){
																	$result = $result->where('candidates.updated_at','>=',Carbon::now()->subdays(15));
																}elseif($_REQUEST['active_in'] == 'last_month'){
																	$result = $result->whereMonth('candidates.updated_at','=',Carbon::now()->subMonth()->month);
																}elseif($_REQUEST['active_in'] == 'last_2_month'){
								
																	$dateS = Carbon::now()->startOfMonth()->subMonth(2);
																	$dateE = Carbon::now(); 
																	$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								
																}elseif($_REQUEST['active_in'] == 'last_5_month'){
										
																	$dateS = Carbon::now()->startOfMonth()->subMonth(5);
																	$dateE = Carbon::now(); 
																	$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
								
																}elseif($_REQUEST['active_in'] == 'last_year'){
								
																	$dateS = Carbon::now()->startOfYear()->subYear();
																	$dateE = Carbon::now(); 
																	$result = $result->whereBetween('candidates.updated_at',[$dateS,$dateE]);
																	
																}
										
															 }
								
															 $result = $result->paginate($limit);
														
														}else{

															$result = [];
														}

												}
												
								
						         	}	

									
							$i=0;
							foreach ($result as $candidate) {
								$_current_city_name = DB::table('cities')
								->find($candidate->current_city)->name;
								$result[$i]->current_city_name = $_current_city_name;
								$result[$i]->candidate_industries = DB::table('candidate_industries')
								->where('candidate_id','=', $candidate->id)
								->get();
								$result[$i]->candidate_industry_functional_areas = DB::table('candidate_industry_functional_areas')
								->where('candidate_id','=', $candidate->id)
								->get();
								$result[$i]->candidate_industry_functional_area_roles = DB::table('candidate_industry_functional_area_roles')
								->where('candidate_id','=', $candidate->id)
								->get(); 
								$result[$i]->candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')
								->where('candidate_id','=', $candidate->id)
								->get();
								// $result[$i]->totalAssociation = count(DB::table('job_order_applicants')->where('candidate_id',$candidate->id)->whereNull('deleted_at')->get());
								/*$result[$i]->latestAssociation = DB::table('job_order_applicants')->where('candidate_id',$candidate->id)->whereNull('deleted_at')->orderby('id','desc')->get();*/
							$result[$i]->latestAssociation =DB::table('job_order_applicants')
											->select('job_order_applicants.*','companies.name as company','job_orders.*', 'offices.name as office','job_order_applicants.created_at as addedOn','job_order_applicants.id as applicant_id')
											->join('job_orders','job_orders.id','=','job_order_applicants.job_order_id')
											->join('companies','companies.id','=','job_orders.company_id')
											->join('offices','offices.id','=','job_orders.office_id')
											->join('cms_users','cms_users.id','=','job_order_applicants.creator_id')
											->where('job_order_applicants.candidate_id',$candidate->id)
											->whereNull('job_order_applicants.deleted_at')
											->orderBy('job_order_applicants.id','desc')
											->get();
								$result[$i]->totalAssociation = count($result[$i]->latestAssociation);
								$result[$i]->highest_qualification = DB::table('qualifications')->find($result[$i]->highest_qualification)->qualification;
								$i++;
							}
						}
					

			            // GET FUNCTIONAL AREA SKILLS ON FUNCTIONAL AREA
						if($_REQUEST['current_action']== 'list_functional_roles_skills') {
							if($_REQUEST['functional_area_id']!=''){
								$functional_area_id = explode('-',$_REQUEST['functional_area_id']);
								
							$functional_area['skills'] = DB::table('industry_functional_area_skills')->where('industry_functional_area_id',$functional_area_id[0])->orderby('name','asc')->get();

							$functional_area['roles'] = DB::table('industry_functional_area_roles')->where('industry_functional_area_id',$functional_area_id[0])->orderby('name','asc')->get();
							}
							return $functional_area;
						}
						
			            // ADD CANDIDATE TO JOBORDER
						if($_REQUEST['current_action']== 'add_to_joborder') {
						
							//return 1;
							$jobOrderVacancy=DB::table('job_orders')->where('id',$_REQUEST['job_order_id'])->first();
					        $openings=$jobOrderVacancy->openings_available;
					        	//check whether candidate already in joborder
							$checkJobOrders = DB::table('job_order_applicants')
							->where('candidate_id',$_REQUEST['candidate_id'])
							->where('job_order_id',$_REQUEST['job_order_id'])
							->whereNull('deleted_at')
							->get();
					        if($openings<=0){
					        	if(count($checkJobOrders)>0){
					        	 return 'mainfailed2';
					            }
					            else{
					             return 'mainfailed1';	
					            }  
					        } 
					        else{
							
							if(count($checkJobOrders)==0) {
								$addToJo = DB::table('job_order_applicants')->insertGetId(
									[
										'job_order_id' => $_REQUEST['job_order_id'],
										'candidate_id' => $_REQUEST['candidate_id'],
										'primary_status' => 'Qualify',
										'secondary_status' => 'Pending Review',
										'next_action' => 'Qualify',
										'created_at' => DB::raw('NOW()'),
										'updated_at' => DB::raw('NOW()'),
										'creator_id' => CRUDBooster::myId()
									]);
								\DB::table('job_order_applicant_statuses')->insert([
				                    'job_order_applicant_id' => $addToJo,
				                    'prev_primary_status' => '',
				                    'prev_secondary_status' => '',
				                    'new_primary_status' => 'Qualify',
				                    'new_secondary_status' => 'Pending Review',
				                    'note' => '',
				                    'creator_id' => CRUDBooster::myId(),
				                    'created_at' => \DB::raw('NOW()')
				                ]);
								if($addToJo)
									return 'success';
								else 
									return 'failed1';
							}
							else {
								return 'failed2';
							}
					        }
				
						}
						
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
						$data['venue']=$_REQUEST['venue'];
						$data['mode_of_interview']=$_REQUEST['interview_mode']; 
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
                
                $template = str_replace('[time]',date("h:i A", strtotime($prev_interview_date->new_interview_date)), $template); 
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
            $template=str_replace('[venue]','<p style="margin-top: 0.07in; margin-bottom: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif" size="2">&nbsp;'.$companies->name.'</font></p><p id="company_address" style="margin-top: 0.07in; margin-bottom: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif" size="2">&nbsp;'.$companies->address.'</font></p><p id="company_contact_number" style="margin-top: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif"><font size="2"><u>&nbsp;<a href="tel:+91">Tel:+91</a></u></font></font><font face="Calibri, serif"><font size="2">&nbsp;'.$contacts->phone_work.'</font></font></p>',$template);

           $template=str_replace('[contact]','<p style="margin-top: 0.07in; margin-bottom: 0.07in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><font face="Calibri, serif"><font size="2">&nbsp;'.$contacts->first_name.' '.$contacts->last_name.'</font></font></p><p><font face="Calibri, serif"><font size="2">&nbsp;'.$contacts->title.'</font></font></p><p><font face="Calibri, serif"><font size="2">&nbsp;'.$companies->name.'</font></font></p><p><font face="Calibri, serif"><font size="2">&nbsp;Contact Number : '.$contacts->phone_work.' </font></font></p>',$template);          
            $template = str_replace('[your_name]', \CRUDBooster::myName(), $template);
            $template = str_replace('[regards_name]', \CRUDBooster::myName(), $template);
            return $template;

        }
		
        // GET MULTIPLE EMAIL CONTENT
		if($_REQUEST['current_action']== 'get_multiple_email_content') {
			$template = DB::table('cms_email_templates')
			->where('slug',$_REQUEST['email_template_id'])->first()->content;
			/*$candidate = DB::table('candidates')->find($_REQUEST['candidate_ids']);
			if($candidate) {
				$template = str_replace('[candidate_name]', $candidate->first_name.' '.$candidate->last_name, $template);	
			}
			$template = str_replace('[candidate_name]', 'Candidate', $template);
			$template = str_replace('[your_name]', \CRUDBooster::myName(), $template);
			$template = str_replace('[regards_name]', \CRUDBooster::myName(), $template);*/
			return $template;

		}
		
		// ADD MULTIPLE CANDIDATES TO JOBORDER
		if($_REQUEST['current_action']== 'add_cids_to_joborder') {
			$cid = $_REQUEST['candidate_ids'];
			$jobOrderVacancy=DB::table('job_orders')->where('id',$_REQUEST['job_order_id'])->first();
			$openings=$jobOrderVacancy->openings_available;
			//check whether candidate already in joborder
			$checkJobOrders = DB::table('job_order_applicants')
			->where('candidate_id',$cid)
			->where('job_order_id',$_REQUEST['job_order_id'])
			->whereNull('deleted_at')
			->get();
			
			if($openings<=0){
				if($cid){
					if(count($checkJobOrders)>0){
					    return 'mainfailed2';
					}
					else{
					    return 'mainfailed1';	
					} 
				}
			}
			else if($openings<=0 && count($checkJobOrders)>0) {
				if($cid){
					return 'mainfailed2';
				}
			}
			else{
			if(count($checkJobOrders)==0) {
				$addToJo = DB::table('job_order_applicants')->insertGetId(
					[
						'job_order_id' => $_REQUEST['job_order_id'],
						'candidate_id' => $cid,
						'primary_status' => 'Qualify',
						'secondary_status' => 'Pending Review',
						'next_action' => 'Qualify',
						'created_at' => DB::raw('NOW()'),
						'updated_at' => DB::raw('NOW()'),
						'creator_id' => CRUDBooster::myId()
					]);
				\DB::table('job_order_applicant_statuses')->insert([
					'job_order_applicant_id' => $addToJo,
					'prev_primary_status' => '',
					'prev_secondary_status' => '',
					'new_primary_status' => 'Qualify',
					'new_secondary_status' => 'Pending Review',
					'note' => '',
					'creator_id' => CRUDBooster::myId(),
					'created_at' => \DB::raw('NOW()')
				]);
				if($addToJo){
					return 'success';
				}
				else {
					return 'failed1';
				}
			}
			else {
				return 'failed2';
			}


		}
	
	}

		// SEND MULTIPLE EMAILS FOR MULTIPLE CANDIDATES - TODO
		if($_REQUEST['current_action']== 'multiple_email_to_candidates') {
			$candidate = DB::table('candidates')->find($_REQUEST['candidate_id']);
			$slug=$_REQUEST['email_template_id'];
			if($slug=='mail_to_candidate') 
		    {
		    $data['content']=$_REQUEST['comment'];	
		    $data['subject']=$_REQUEST['subject']; 
		    }
		    else{
		    $data['candidate_name'] = $candidate->first_name. ' ' .$candidate->last_name ;
			$data['regards_name'] = CRUDBooster::myName();	
		    }
			$from_name = CRUDBooster::myName();
			$from_email = CRUDBooster::me()->email; // from_mail@mail.com
			$subject = 'Offer Letter - '.$candidate->first_name. ' ' .$candidate->last_name ;
			// inv@connecting2work.com  // 'from_email'=>$from_email,'from_name'=>$from_name,
			// CRUDBooster::sendEmail(['to'=>$candidate->primary_email,'data'=>$mail_content,'template'=>$template->slug,'attachments'=>[]])
			//$mailSend = CRUDBooster::sendEmail(['to'=>'shajeeb@stacktreestudios.com','data'=>$data,'template'=>$slug,'attachments'=>[]]);
			$mailSend = CRUDBooster::sendEmail(['to'=>$candidate->primary_email,'data'=>$data,'template'=>$slug,'attachments'=>[]]);

			return "OK";
		}

		//echo '<pre>';print_r($result); exit;

		/*//print_r($result); exit;
		if (is_array($result)){
			//$record_count =0;
//print_r($result); //exit;
		}else{

		}*/ 
		if(count($result)!=0){
				$record_count =$result->total();
		}else{
			$record_count =0;
		}

		$ug_qualifications = DB::table('qualifications')->orderby('qualification','asc')->where('qualification_level_id',1)->pluck('qualification','id');
		$pg_qualifications = DB::table('qualifications')->orderby('qualification','asc')->where('qualification_level_id',2)->pluck('qualification','id');

		$seachUg = '';
		if($_REQUEST['ugQualification'] != 'any' && $_REQUEST['ugQualification'] != 'no' && $_REQUEST['ugQualification'] != '') {
			$seachUg = DB::table('qualifications')->where('qualification_level_id',1)->where('qualification',$_REQUEST['ugQualification'])->first();
			// dd($seachUg);
		}
		$selected_location = array();

		if($_REQUEST['location']!='') {
							
		    
			$locationArray = explode(',',$_REQUEST['location']);
			foreach ($locationArray as $key => $value) {
				
				$selected_city = DB::table('cities')->select('name','id')->where('id',$value)->first();
				$selected_location[$selected_city->id] = $selected_city->name;
			}

		}


		if($_REQUEST['designation']!='') {
							
			$locationArray = explode(',',$_REQUEST['designation']);
			foreach ($locationArray as $key => $value) {
				
				$selected_city = DB::table('candidates')->select('current_designation')->where('current_designation',$value)->first();
				$selected_designation[$selected_city->current_designation] = $selected_city->current_designation;
			}
		}



		//$record_count =$result->total();
		//$record_count =count($result);
		//$this->cbView('override.candidates.listing',$data);
		$this->cbView('override.candidates.listing',compact('result','cities','jobOrders','industries','industry_functional_areas','industry_functional_area_skills','industry_functional_area_roles', 'email_templates','record_count','page_title','ug_qualifications','pg_qualifications','selected_location','designations','selected_designation'));
	}


	public function getAdd() {
	  	//Create an Auth
		if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {    
			CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
		}
		$this->cbLoader();
		$page_title = 'Add Candidate';

		$data = [];
		// $data['page_title'] = 'Add Data';
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

		$creators = [];
		$privilege_name = CRUDBooster::myPrivilegeName();
		$privilege_id = CRUDBooster::myPrivilegeId();

	  	// List users as per current user's privilege
		if($privilege_name === 'Recruiter'){
	  		//Only current user will be in creator list
			$creators =  DB::table('cms_users')->where('id',CRUDBooster::myId())->get();
		}
		else{
			$creators =  DB::table('cms_users')->where('id_cms_privileges','>=',$privilege_id)->get();
		}


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


	  	//Please use cbView method instead view method from laravel
		$this->cbView('override.candidates.add',compact('data','countries','states','cities','postal_codes','sources','creators', 'industries','functional_areas','general_skills','qualification_levels','qualifications','page_title'));
	}

	public function getEdit($id) {

		if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {    
			CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
		}

		$this->cbLoader();
		$page_title = 'Edit Candidate';
		$candidate = DB::table('candidates')->where('id',$id)->first();
		$candidate_resume = DB::table('candidate_resumes')->orderby('id','desc')->where('candidate_id',$id)->first();
		$candidate->resume_url = $candidate_resume->resume_url;
		
		$functional_areaIds = [];
		$candidate_qualification_levels = [];
		// $postal_code = DB::table('postal_codes')->where('name',$candidate->postal_code)->first()->id;

		$candidate->qualification_level_id = $candidate->highest_qualification_level;
		
		$allQualifications = DB::table('qualifications')->get();

		// $candidate->postal_code = $postal_code;

		$candidate_generalSkills = DB::table('candidate_general_skills')->where('candidate_id',$candidate->id)->get();
		$candidate->generalSkillIds = [];
		foreach ($candidate_generalSkills as $generalSkill) {
			$candidate->generalSkillIds[] = $generalSkill->general_skill;
		}

		$candidate_industries = DB::table('candidate_industries')->where('candidate_id',$candidate->id)->get();	
		$candidate->industryIds = [];		
		foreach ($candidate_industries as $industry) {
			$candidate->industryIds[] = $industry->industry_id;
		}

		$candiate_functional_areas = DB::table('candidate_industry_functional_areas')->where('candidate_id',$candidate->id)->get();
		foreach ($candiate_functional_areas as $functional_area) {
			$functional_areaIds[] = $functional_area->industry_functional_area_id;
		}

		$candidate->functional_areaIds = $functional_areaIds;

		$candidate_functional_area_roles = DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$candidate->id)->get();		
		$functional_area_roleIds = [];
		foreach ($candidate_functional_area_roles as $functional_area_role) {
			$functional_area_roleIds[] = $functional_area_role->industry_functional_area_role_id;
		}
		$candidate->functional_area_roleIds = $functional_area_roleIds;

		$candidate_functional_area_skills = DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$candidate->id)->get();
		
		$functional_area_skillIds = [];
		foreach ($candidate_functional_area_skills as $functional_area_skill) {
			$functional_area_skillIds[] = $functional_area_skill->industry_functional_area_skill_id;
		}
		$candidate->functional_area_skillIds = $functional_area_skillIds;

		$candidate_qualifications = DB::table('candidate_qualifications')->where('candidate_id',$candidate->id)->get();

		foreach ($candidate_qualifications as $qualification) {
			$candidate_qualification_levels[] = $qualification->qualification_level_id;	
		}


		$functional_area_roles = DB::table('industry_functional_area_roles')->whereIn('industry_functional_area_id',$functional_areaIds)->get();			
		$functional_area_skills = DB::table('industry_functional_area_skills')->whereIn('industry_functional_area_id',$functional_areaIds)->get();
		$candidate->qualifications = $candidate_qualifications;

		$qualifications = DB::table('qualifications')->whereIn('qualification_level_id',$candidate_qualification_levels)->get();

		Session::put('current_candidate_id',$id);		  
		$data = [];
		$data['page_title'] = 'Edit Data';		  	
		$countries = DB::table('countries')->orderby('name','desc')->get();
		$states = DB::table('states')->where('country_id',$candidate->country_id)->orderby('name','desc')->get();
		$cities = DB::table('cities')->where('state_id',$candidate->state_id)->orderby('name','desc')->get();
		$allCities = DB::table('cities')->orderby('name','desc')->get();
		$postal_codes = DB::table('postal_codes')->orderby('name','desc')->get();
		$sources = DB::table('sources')->orderby('name','desc')->get();		  	
		$industries = DB::table('industries')->get();
		$functional_areas = DB::table('industry_functional_areas')->get();
		$general_skills = DB::table('general_skills')->get();
		$qualification_levels = DB::table('qualification_levels')->get();
		$creators = [];
		$privilege_name = CRUDBooster::myPrivilegeName();
		$privilege_id = CRUDBooster::myPrivilegeId();

	  	// List users as per current user's privilege
		if($privilege_name === 'Recruiter'){
	  		//Only current user will be in creator list
			$creators =  DB::table('cms_users')->where('id',CRUDBooster::myId())->get();
		}
		else{
			$creators =  DB::table('cms_users')->where('id_cms_privileges','>=',$privilege_id)->get();
		}


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


	  	//Please use cbView method instead view method from laravel
		$this->cbView('override.candidates.edit',compact('id','candidate','data','countries','states','cities','allCities','postal_codes','sources','creators', 'industries','functional_areas','general_skills','qualification_levels','qualifications','functional_area_skills','functional_area_roles','allQualifications','page_title'));
	}

	public function insertToCandidatePivotTable($id){

		$resume_filename =  Session::get('resume_filename') ;
			if($resume_filename!=''){
		// 		$addResume = DB::table('candidate_resumes')->insert(
		// 			[
		// 				'resume_url' => $resume_filename,
		// 				'candidate_id' => $id
		// 			]);
			$this->addResume($id);
			}

		foreach (Session::get('general_skill_id') as $general_skill) {
			DB::table('candidate_general_skills')->insert(['candidate_id' => $id,
				'general_skill' => $general_skill,
			]);
		}


		foreach (Session::get('industry_id') as $industry_id) {
			DB::table('candidate_industries')->insert([
				'candidate_id' => $id,
				'industry_id' => $industry_id,
				'industry' => DB::table('industries')->find($industry_id)->name
			]);
		}  


		foreach (Session::get('functional_area_id') as $functional_area_id) {
			DB::table('candidate_industry_functional_areas')->insert([
				'candidate_id' => $id,
				'industry_functional_area_id' => $functional_area_id,
				'industry_functional_area' => DB::table('industry_functional_areas')->find($functional_area_id)->name
			]);
		}



		foreach (Session::get('functional_area_role_id') as $functional_area_role_id) {
			DB::table('candidate_industry_functional_area_roles')->insert([
				'candidate_id' => $id,
				'industry_functional_area_role_id' => $functional_area_role_id,
				'role' => DB::table('industry_functional_area_roles')->find($functional_area_role_id)->name
			]);
		}


		foreach (Session::get('functional_area_skill_id') as $functional_area_skill_id) {

			$existingSkill = Session::get('existing_skill');
			
			if(isset($existingSkill) && array_key_exists($functional_area_skill_id,$existingSkill)) {
				$exp = explode ("/",$existingSkill[$functional_area_skill_id]);
				DB::table('candidate_industry_functional_area_skills')->insert([
					'candidate_id' => $id,
					'industry_functional_area_skill_id' => $functional_area_skill_id,
					'industry_functional_area_skill' => DB::table('industry_functional_area_skills')->find($functional_area_skill_id)->name,
					'experience_years' =>(($exp[0]) ? $exp[0] : null),
					'experience_months'=>(($exp[1]) ? $exp[1] : null)
				]);
			} else {
				DB::table('candidate_industry_functional_area_skills')->insert([
					'candidate_id' => $id,
					'industry_functional_area_skill_id' => $functional_area_skill_id,
					'industry_functional_area_skill' => DB::table('industry_functional_area_skills')->find($functional_area_skill_id)->name
				]);
			}
		}
		$i = 0;
		$qualification = Session::get('qualification_id');
		$is_completed = Session::get('is_completed');
		$completed_year = Session::get('completed_year');
		$score = Session::get('score');
		foreach( Session::get('qualification_level_id') as $qualificationLevel) {
			if($qualification[$i] && $qualificationLevel) {
				DB::table('candidate_qualifications')->insert([
					'candidate_id' => $id,
					'qualification_id' => $qualification[$i],
					'qualification_level_id' => $qualificationLevel,
					'completed_year' => $completed_year[$i],
					'is_completed' => (($is_completed[$i] == '1' ) ? '1':'0' ),
					'score' => $score[$i],
					'qualification'=> DB::table('qualifications')->find($qualification[$i])->qualification,
					'qualification_level'=> DB::table('qualification_levels')->find($qualificationLevel)->qual_level,
				]);
			}
			$i++;
		}
		Session::forget('existing_skill');
		Session::forget('general_skill_id');
		Session::forget('industry_id');
		Session::forget('functional_area_id');
		Session::forget('functional_area_role_id');
		Session::forget('functional_area_skill_id');
		Session::forget('qualification_level_id');
		Session::forget('resume_filename');
	}

	public function createSessionVariablesForCandidate($_resumeUrl){
		Session::put('resume_filename',$_resumeUrl);
		Session::put('general_skill_id',$_REQUEST['general_skill_id']);
		Session::put('industry_id',$_REQUEST['industry_id']);
		Session::put('functional_area_id',$_REQUEST['functional_area_id']);
		Session::put('functional_area_role_id',$_REQUEST['functional_area_role_id']);
		Session::put('functional_area_skill_id',$_REQUEST['functional_area_skill_id']);

		Session::put('qualification_level_id', $_REQUEST['qualification_level_id']);
		Session::put('qualification_id', $_REQUEST['qualification_id']);
		//Session::put('is_completed', $_REQUEST['is_completed']);
		Session::put('is_completed', $_REQUEST['is-completed-hidden']);
		Session::put('completed_year', $_REQUEST['completed_year']);
		Session::put('score', $_REQUEST['score']);
	}
	
	public function CheckMailExists() {
		if($_REQUEST['id']) {
			$existingMail = DB::table('candidates')->where('id','!=',$_REQUEST['id'])->where('primary_email', $_REQUEST['email'])->first();
		} else {
			$existingMail = DB::table('candidates')->where('primary_email', $_REQUEST['email'])->first();
		}
		if($existingMail) {
			// $result['status'] = 'exists';
			return json_encode(array('result1'=>$existingMail->id,'result2'=>'true','fullname'=>$existingMail->first_name.' '.$existingMail->last_name));
		}
		else {
			// $result['status'] = 'error';
			return 'false';
		}
		// return $result;
	}
	public function CheckPhoneExists() {
		if($_REQUEST['id']) {
			$existingPhone = DB::table('candidates')->where('id','!=',$_REQUEST['id'])->where('primary_phone', $_REQUEST['phone'])->first();
		} else {
			$existingPhone = DB::table('candidates')->where('primary_phone', $_REQUEST['phone'])->first();
		}
		if($existingPhone) {
			// $result['status'] = 'exists';
			return json_encode(array('result1'=>$existingPhone->id,'result2'=>'true','fullname'=>$existingPhone->first_name.' '.$existingPhone->last_name));
		}
		else {
			// $result['status'] = 'error';
			return 'false';
		}
		// return $result;
	}

	public function addResume($_id) {

		$actualFile = Session::get('resume_filename');
		$ext = pathinfo($actualFile, PATHINFO_EXTENSION);		
		$directory = pathinfo($actualFile, PATHINFO_DIRNAME);
		$nameWithoutExtension = pathinfo($actualFile, PATHINFO_FILENAME);
		
		if($ext == "doc") {
			$content = $this->read_doc(storage_path('app/').$actualFile);
		} elseif($ext == "docx") {
			$content = $this->read_docx(storage_path('app/').$actualFile);
		} elseif($ext == "pdf") {
			include_once \public_path('pdf2text.php');		
			$content =  PdfParser::parseFile(storage_path('app/'.$actualFile));
		} elseif($ext == "rtf") {
			include_once \public_path('rtf2text.php');
			$content =  rtf2text(storage_path('app/'.$actualFile));
		}

		$newName = $directory.'/'.$_id.'-'.time().'-'.$nameWithoutExtension.'.'.$ext;
		rename(storage_path('app/').$actualFile,storage_path('app/').$newName);
		$addResume = DB::table('candidate_resumes')->insert(
					[
						'resume_url' => $newName,
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


    public function getCandidateFromSearchQuery($_query,$functional_area,$functional_area_skills,$industry,$functional_area_roles,$location) {
		$cidDet = [];
		$cidGen = [];
		$cidInd = [];
		$cidFunctionalArea = [];
		$cidFunctionalAreaRole = [];
		$cidFunctionalAreaSkill = [];
		$cidQualification = [];
		$wordlist = array("is", "on", "the");
		foreach ($wordlist as &$word) {
    		$word = '/\b' . preg_quote($word, '/') . '\b/';
		}
        $_query = preg_replace($wordlist,'', $_query);
        $_query=str_replace(array(',', '-','_'), " ", $_query);
        $_query=str_replace(array("'"), "\'", $_query);
    	$queries =explode(' ',$_query);
    	$candidateIds = [];
    	$filteredCandidates = [];
    
    	$i = 0;
		//$queries=array_filter($queries);
		
	
		foreach($queries as $query) {
			$domain = ltrim(stristr($query, '@'), '@') . '.';
            $user   = stristr($query, '@', TRUE);
            if(!empty($user) &&!empty($domain) &&checkdnsrr($domain)){

              	$email='\"'.$query.'\"';
              	$query=$email;
              	$orQuery=$email;
            }
			else{
				 $orQuery=$query;
				 $query='"'.$query.'"';
			}

	
			if(strlen($orQuery)>1 && strlen($query)>1) {
	    		$cids = [];
				/*$candidatesDet = DB::table('candidates')
								->where('first_name','like',"%$query%")
								->orWhere('last_name','like',"%$query%")
								->orWhereRaw("(CONCAT(candidates.first_name,' ',candidates.last_name) like ?)", ['%'.$query.'%'])
								->orWhere('religion','like',"%$query%")
								->orWhere('head_line','like',"%$query%")
								->orWhere('current_employer','like',"%$query%")
								->orWhere('current_designation','like',"%$query%")
								->orWhere('category','like',"%$query%")
								->orWhere('address','like',"%$query%")
								->orWhere('primary_email','like',"%$query%")
								->orWhere('secondary_email','like',"%$query%")
								->orWhere('primary_phone','like',"%$query%")
								->orWhere('secondary_phone','like',"%$query%")
								->orWhere('resume_content','like',"%$query%")
								->get();*/
                   // select * from `candidate_qualifications` where MATCH(qualification) AGAINST('"M.Tech"' IN BOOLEAN MODE) or `qualification` like "%M.Tech%" 
				$candidatesDet =DB::table('candidates')
					->whereRaw("MATCH (first_name) AGAINST ('".$query."'IN BOOLEAN MODE)")
					->orWhere('first_name','like', "%$orQuery%")
					->orWhereRaw("MATCH (last_name) AGAINST ('".$query."'IN BOOLEAN MODE)")
					->orWhere('last_name','like', "%$orQuery%")
					// ->orWhereRaw('(CONCAT(candidates.first_name," ",candidates.last_name) like ?)', "%$orQuery%")
					->orWhereRaw("MATCH(religion) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('religion','like', "%$orQuery%")
					// ->orWhereRaw("MATCH(head_line) AGAINST('".$query."' IN BOOLEAN MODE)")
					// ->orWhere('head_line','like', "%$orQuery%")
					->orWhereRaw("MATCH(current_employer) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('current_employer','like', "%$orQuery%")
					->orWhereRaw("MATCH(current_designation) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('current_designation','like', "%$orQuery%")
					->orWhereRaw("MATCH(category) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('category','like', "%$orQuery%")
					->orWhereRaw("MATCH(address) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('address','like', "%$orQuery%")
					->orWhereRaw("MATCH(primary_email) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('primary_email','like', "%$orQuery%")
					->orWhereRaw("MATCH(secondary_email) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('secondary_email','like', "%$orQuery%")
					->orWhereRaw("MATCH(primary_phone) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('primary_phone','like', "%$orQuery%") 
					->orWhereRaw("MATCH(secondary_phone) AGAINST('".$query."' IN BOOLEAN MODE)")
					->orWhere('secondary_phone','like', "%$orQuery%")
					// ->orWhereRaw("MATCH(resume_content) AGAINST('".$query."' IN BOOLEAN MODE)")
					// ->orWhere('resume_content','like', "%$orQuery%")
				    ->get();

		    	foreach($candidatesDet as $candidate){
		    		$cids[] = $candidate->id;
				}


		    	//$candidate_general_skills = DB::table('candidate_general_skills')->where('general_skill','Like',"%$query%")->get();
		    	$candidate_general_skills = DB::table('candidate_general_skills')
		    	->whereRaw("MATCH(general_skill) AGAINST('".$query."' IN BOOLEAN MODE)")
		    	->orWhere('general_skill','like', "%$orQuery%")
		    	->get();
		    	foreach($candidate_general_skills as $candidate_general_skill) {
		    		$cids[] = $candidate_general_skill->candidate_id; 
		    	}

		    	/*$candidate_industries = DB::table('candidate_industries')->where('industry','Like',"%$query%")->get();*/
		    	$candidate_industries = DB::table('candidate_industries')
		    	->whereRaw("MATCH(industry) AGAINST('".$query."' IN BOOLEAN MODE)")
		    	->orWhere('industry','like', "%$orQuery%")
		    	->get();

		    	foreach($candidate_industries as $candidate_industry) {
		    		$cids[] = $candidate_industry->candidate_id; 
		    	}

		    	/*$candidate_industry_functional_areas = DB::table('candidate_industry_functional_areas')->where('industry_functional_area','Like',"%$query%")->get();*/
		    	$candidate_industry_functional_areas = DB::table('candidate_industry_functional_areas')
		    	    ->whereRaw("MATCH(industry_functional_area) AGAINST('".$query."' IN BOOLEAN MODE)")
		    	    ->orWhere('industry_functional_area','like', "%$orQuery%")
		    	    ->get();
		    	foreach($candidate_industry_functional_areas as $candidate_industry_functional_area) {
		    		$cids[] = $candidate_industry_functional_area->candidate_id; 
		    	}

		    	/*$candidate_industry_functional_area_roles = DB::table('candidate_industry_functional_area_roles')->where('role','Like',"%$query%")->get();*/
		    	$candidate_industry_functional_area_roles = DB::table('candidate_industry_functional_area_roles')
		    	->whereRaw("MATCH(role) AGAINST('".$query."' IN BOOLEAN MODE)")
		    	->orWhere('role','like', "%$orQuery%")
		    	->get();
		    	foreach($candidate_industry_functional_area_roles as $candidate_industry_functional_area_role) {
		    		$cids[] = $candidate_industry_functional_area_role->candidate_id; 
		    	}

		    /*	$candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')->where('industry_functional_area_skill','Like',"%$query%")->get();*/
		    $candidate_industry_functional_area_skills = DB::table('candidate_industry_functional_area_skills')->whereRaw("MATCH(industry_functional_area_skill) AGAINST('".$query."' IN BOOLEAN MODE)")
		    ->orWhere('industry_functional_area_skill','like', "%$orQuery%")
		    ->get();
		    	foreach($candidate_industry_functional_area_skills as $candidate_industry_functional_area_skill) {
		    		$cids[] = $candidate_industry_functional_area_skill->candidate_id; 
		    	}

		    	/*$candidate_qualifications = DB::table('candidate_qualifications')->where('qualification','Like',"%$query%")->get();*/
		    	$candidate_qualifications = DB::table('candidate_qualifications')
		    	->whereRaw("MATCH(qualification) AGAINST('".$query."' IN BOOLEAN MODE)")
		    	->orWhere('qualification','like', "%$orQuery%")
                //dump($candidate_qualifications->toSql());
                //dd($candidate_qualifications->getBindings());
		    	->get();

		    	foreach($candidate_qualifications as $candidate_qualification) {
		    		$cids[] = $candidate_qualification->candidate_id; 
		    	}

		    	$candidateIds[$i] = $cids;
		    	$i++;
		    }
		}

						
	
	

	    if(count($candidateIds) > 1 ) {
		    // for ($i = 0; $i < (count($candidateIds) - 1 ) ; $i++) {
		    // 	if($candidateIds[$i+1]) {
		    // 		$filteredCandidates = array_intersect($candidateIds[$i], $candidateIds[$i+1]);
		    // 	}
			// }
			$filteredCandidates = $candidateIds;
		} else {
			$filteredCandidates = ($candidateIds[0]) ? $candidateIds[0] : [];
		}


	
		$sortedCandidates=[];
		$sortedFilteredCandidates=[];
		$sortedCandidates[]=$filteredCandidates;
		$sortedFiltered=[];
		



		$area_cids = [];
		// Functional Area
			if($functional_area!=' ') {
				$_functional_area = explode('--', $functional_area);
				$result_f_a = DB::table('candidate_industry_functional_areas')->select('candidate_id')->where('candidate_industry_functional_areas.industry_functional_area','like', '%' .$_functional_area[1].'%')->get();
				if($result_f_a) {
					foreach ($result_f_a as $_cids) {
						$area_cids[] = $_cids->candidate_id;
					}
				}
			}

		if(count($area_cids) > 1 ) {
			
			$sortedFilteredCandidates[] =array_intersect($filteredCandidates,$area_cids);
	    }
	    $sortedFiltered[0]=$sortedFilteredCandidates;	
		// Functional Area Skills
							$skills_cids = [];
							if($functional_area_skills!='') {
								foreach ($functional_area_skills as $functional_area_skill) {
									$_functional_area_skill = explode('--', $functional_area_skill);
									
									$result_f_a_s = DB::table('candidate_industry_functional_area_skills')->select('candidate_id')->where('candidate_industry_functional_area_skills.industry_functional_area_skill','like', '%' .$_functional_area_skill[1].'%')->get();
									
									if($result_f_a_s) {
										foreach ($result_f_a_s as $_scids) {
											$skills_cids[] = $_scids->candidate_id;
										}
									}
								}
							}
		if(count($skills_cids) > 1 ) {
			
			$sortedFilteredCandidates=array_intersect($filteredCandidates,$skills_cids);
	    }
	    $sortedFiltered[1]=$sortedFilteredCandidates;
				# Functional Area Roles
							$role_ids = [];
							if($functional_area_roles!='') {
								foreach ($functional_area_roles as $functional_area_role) {
									$_functional_area_role = explode('--', $functional_area_role);
									$result_f_a_r = DB::table('candidate_industry_functional_area_roles')->select('candidate_id')->where('candidate_industry_functional_area_roles.industry_functional_area_role_id',$_functional_area_role[0])->get();
									
									if($result_f_a_r) {
										foreach ($result_f_a_r as $_scids) {
											$role_ids[] = $_scids->candidate_id;
										}

									}
								}
								

							}
		if(count($role_ids) > 1 ) {
	   	  $sortedFilteredCandidates =array_intersect($filteredCandidates,$role_ids);
	    }
		$sortedFiltered[2]=$sortedFilteredCandidates;
				// Industry
							$industry_cids = [];
							if($industry!='') {
								$_industry = explode('--', $industry);
								$result_i = DB::table('candidate_industries')->select('candidate_id')->where('candidate_industries.industry','like', '%' .$_industry[1].'%')->get();
								if($result_i) {
									foreach ($result_i as $_icids) {
										$industry_cids[] =$_icids->candidate_id;
									}
								}
								
							}
		if(count($industry_cids) > 1 ) {
	   	 $sortedFilteredCandidates=array_intersect($filteredCandidates,$industry_cids);
	    }
	    $sortedFiltered[3]=$sortedFilteredCandidates;
				// Resume 
							$resumeCid = [];
							if(($_REQUEST['fromResume'] == 'entireResume') && ($_functional_area[1] !=''|| $_functional_area_skill[1] !=''||  $_industry[1] !='' || $location!='')) {
								$resumeResults = DB::table('candidates');
								if($_functional_area[1]) {
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$_functional_area[1].'%');
								}								
								if($_functional_area_skill[1]) {
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$_functional_area_skill[1].'%');
								}										
								if($_industry[1]) {
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$_industry[1].'%');
								}
								// if($location!='') {
								// 	$resumeCity = explode('-', $_REQUEST['location']);
								// 	$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$resumeCity[1].'%');
								// }
								$resumeResults = $resumeResults->get();

								foreach ($resumeResults as $resumeResult) {
									$resumeCid[] = 	$resumeResult->id;
								}
							}
	   if(count($resumeCid) > 1 ) {
	   	 $sortedFilteredCandidates=array_intersect($filteredCandidates,$resumeCid);
	   }
	   $sortedFiltered[4]=$sortedFilteredCandidates;
        //dump($sortedFiltered);
	    if(count($sortedFiltered) > 1 ) {
		    for ($i = 0; $i < (count($sortedFiltered) - 1 ) ; $i++) {
		    	if(count($sortedFiltered[$i+1])>0 && count($sortedFiltered[$i])>0){
		    		$sortedFilteredCandidates= array_intersect($sortedFiltered[$i], $sortedFiltered[$i+1]);
		    	}
		    }
		}
		//dd($sortedFilteredCandidates);
    	//$candidates = DB::table('candidates')->whereIn('id',$filteredCandidates);
    	if($_query!=''&&$functional_area==''&& $functional_area_skills==''&&$industry==''&&$functional_area_roles==''&&$location==''){
    		$candidates=$sortedCandidates;
    	}
    	else{
    		$candidates= $sortedFilteredCandidates;
    	}
    	return $candidates;
	}
	
	public function generatePdf($id) {
//return 1;
		$candidate        = DB::table('candidates')->where('id',$id)->first();
		$current_city_name = DB::table('cities')->find($candidate->current_city)->name;
		$candidate_qualifications = DB::table('candidate_qualifications')->where('candidate_id',$candidate->id)->get();
		$candidate_industry_functional_areas = DB::table('candidate_industry_functional_areas')->where('candidate_id',$candidate->id)->get();
		$roles = DB::table('candidate_industry_functional_area_roles')->where('candidate_id',$candidate->id)->get();
		$skills = DB::table('candidate_industry_functional_area_skills')->where('candidate_id',$candidate->id)->get();
		$pdf    = PDF::loadView('override.candidates.generate_pdf',compact('candidate','current_city_name','candidate_qualifications','candidate_industry_functional_areas','roles','skills'));
    	// return view('override.candidates.generate_pdf',compact('candidate','current_city_name','candidate_qualifications','candidate_industry_functional_areas','roles','skills'));
	   
	    $pdf_name = $candidate->first_name.'_'.$candidate->last_name.'_'.Carbon::today()->toDateString().'.pdf';
		$pdf = PDF::loadView('override.candidates.generate_pdf',compact('candidate','current_city_name','candidate_qualifications','candidate_industry_functional_areas','roles','skills'))->setOptions(['defaultFont' => 'sans-serif']);

		return $pdf->download($pdf_name);
        
	}


	public function downloadPdf() {
		 
		dd($_REQUEST);
	}
}