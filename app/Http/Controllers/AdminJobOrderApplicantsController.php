<?php 
namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	// top of your controller
	ini_set('max_execution_time', 0);
	// Also you can increase memory
	ini_set('memory_limit','2048M');
	class AdminJobOrderApplicantsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "job_order_applicants";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Job Order Id","name"=>"job_order_id","join"=>"job_order,id"];
			$this->col[] = ["label"=>"Candidate Id","name"=>"candidate_id","join"=>"candidate,id"];
			$this->col[] = ["label"=>"Status","name"=>"status"];
			$this->col[] = ["label"=>"Creator Id","name"=>"creator_id","join"=>"creator,id"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Job Order Id','name'=>'job_order_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'job_order,id'];
			$this->form[] = ['label'=>'Candidate Id','name'=>'candidate_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'candidate,id'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Creator Id','name'=>'creator_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'creator,id'];
			$this->form[] = ['label'=>'Notes','name'=>'notes','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Job Order Id","name"=>"job_order_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"job_order,id"];
			//$this->form[] = ["label"=>"Candidate Id","name"=>"candidate_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"candidate,id"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Creator Id","name"=>"creator_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"creator,id"];
			//$this->form[] = ["label"=>"Notes","name"=>"notes","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
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

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

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

	    // custom list view
		public function getIndex() {
			if(!CRUDBooster::isView())  CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
			$jobOrderVacancy=DB::table('job_orders')->where('id', $_REQUEST['job_order_id'])->first();
			$vacanices=$jobOrderVacancy->num_vacancies;
			$places =DB::table('job_order_applicants')
											->select('job_order_applicants.*','job_orders.*')
											->join('job_orders','job_orders.id','=','job_order_applicants.job_order_id')
											->whereNull('job_order_applicants.deleted_at')
											->where('job_order_applicants.primary_status', 'Place')
											->where('job_order_applicants.secondary_status', 'Joined')
											->where('job_order_applicants.job_order_id', $_REQUEST['job_order_id'])
											->orderBy('job_order_applicants.id','desc')
											->count();
			$openings=$vacanices-$places;
			if($openings>=0){
			  $updateVacancy=DB::table('job_orders')->where('id', $_REQUEST['job_order_id'])->update(array('openings_available' => $openings));
			  if($openings=='0'){
			  	\DB::table('events')->where('job_order_id', $_REQUEST['job_order_id'])->whereNotNull('candidate_id')->delete();
			  }
			}						
			$data = [];
			$data['cities'] = DB::table('cities')->orderby('name','desc')->get();
			$data['industries'] = DB::table('industries')->orderby('name','desc')->get();
			$data['industry_functional_areas'] = DB::table('industry_functional_areas')->orderby('name','desc')->get();

			$industry_functional_area_skills = DB::table('industry_functional_area_skills')->groupby('name')->orderby('name','asc');

			$industry_functional_area_roles = DB::table('industry_functional_area_roles')->groupby('name')->orderby('name','asc');

			//To Prefill Functional Area Skill If Selected
			if(!($_REQUEST['functional_area'] == '' || $_REQUEST['current_action'] == 'list_functional_roles_skills')) {				
				$functional_area_id = explode('--', $_REQUEST['functional_area']);
				$industry_functional_area_skills = $industry_functional_area_skills->where('industry_functional_area_id',$functional_area_id);

				$industry_functional_area_roles = $industry_functional_area_roles->where('industry_functional_area_id',$functional_area_id);
			}

			$data['industry_functional_area_skills'] = $industry_functional_area_skills->get();

			$data['industry_functional_area_roles'] = $industry_functional_area_roles->get();
			$data['all_industry_functional_area_roles'] = DB::table('industry_functional_area_roles')->orderby('name','asc')->get();
			// -- load data --

			// job order
			$data['jobOrder'] = DB::table('job_orders')->where('id', $_REQUEST['job_order_id'])->first();
			$data['page_title'] = $data['jobOrder']->title;

			// company & office
			$data['company'] = DB::table('companies')->where('id', $data['jobOrder']->company_id)->first();
			$data['office'] = DB::table('offices')->where('id', $data['jobOrder']->office_id)->first();
			
			if($data['office']->city_id) {
				$data['office']->cityName = DB::table('cities')->where('id', $data['office']->city_id)->first()->name;
			}
			// functional area
			$functionalAreas = [];
			$rows = DB::table('job_order_industry_functional_areas')->where('job_order_id', $_REQUEST['job_order_id'])->get();
			foreach ($rows as $row) {
				// $functionalAreas[] = $row->industry_functional_area;
				$functionalAreas[] = DB::table('industry_functional_areas')->find($row->industry_functional_area)->name;
			}

			$data['functionalAreas'] = $functionalAreas;
			
			// skills
			$generalSkills = [];
			$rows = DB::table('job_order_general_skills')->where('job_order_id', $_REQUEST['job_order_id'])->get();
			foreach ($rows as $row) {
				// $generalSkills[] = $row->general_skill;
				$generalSkills[] = DB::table('general_skills')->find($row->general_skill)->name;
			}
			$data['generalSkills'] = $generalSkills;

			$functionalAreaSkills = [];
			$rows = DB::table('job_order_industry_functional_area_skills')->where('job_order_id', $_REQUEST['job_order_id'])->get();
			foreach ($rows as $row) {
				$functionalAreaSkills[] = DB::table('industry_functional_area_skills')->find($row->industry_functional_area_skill)->name;
			}
			$data['functionalAreaSkills'] = $functionalAreaSkills;
		
			$preferences = [];
			$rows = DB::table('job_order_preferences')->where('job_order_id', $_REQUEST['job_order_id'])->get();
			foreach ($rows as $row) {
				$preferences[] = $row->preference_name;
			}
			$data['preferences'] = $preferences;

			// applicants (mapped candidates)
			if($_REQUEST['secondary_status_filter'][0] != 'Associated' && count($_REQUEST['secondary_status_filter']) > 0 ) {
				$applicants = $this->getFilteredApplicant();
			} elseif($_REQUEST['secondary_status_filter'][0] != 'Associated') {
				$applicants = DB::table('job_order_applicants')
							->where('job_order_id', $_REQUEST['job_order_id'])
							->whereNull('deleted_at')
							->orderby('updated_at','desc')
							->get();
			} 
			elseif($_REQUEST['secondary_status_filter'][0] == 'Associated' && count($_REQUEST['secondary_status_filter']) > 0 ) {
				$applicants = $this->getFilteredApplicant();
			}
			else {
				return redirect("/admin/job_order_applicants?job_order_id=".$_REQUEST['job_order_id']);
			}
			if($_REQUEST['added_by'] && $_REQUEST['job_order_id']) {
				$applicants = DB::table('job_order_applicants')
							->where('job_order_id', $_REQUEST['job_order_id'])
							->where('creator_id', $_REQUEST['added_by'])
							->whereNull('deleted_at')
							->orderby('updated_at','desc')
							->get();
			} 
			foreach ($applicants as $applicant) {
				$applicant->details = DB::table('candidates')->where('id', $applicant->candidate_id)->first();
				
				$applicant->details->cityName = DB::table('cities')->where('id', $applicant->details->city_id)->first()->name;
				
				$applicant->details->stateName = DB::table('states')->where('id', $applicant->details->state_id)->first()->name;
				
				$applicant->generalSkills = DB::table('candidate_general_skills')->where('candidate_id', $applicant->candidate_id)->get();
				
				$applicant->functionalAreaSkills = DB::table('candidate_industry_functional_area_skills')->where('candidate_id', $applicant->candidate_id)->get();
				
				$applicant->highestQual = DB::table('qualification_levels')->where('id', $applicant->details->highest_qualification_level)->first();


				
				$applicant->creator = DB::table('cms_users')->where('id', $applicant->creator_id)->first()->name;
			
				$applicant->highestQual = DB::table('qualifications')->find($applicant->details->highest_qualification)->qualification;


				$applicant->prefCity = DB::table('cities')->where('id', $applicant->details->preferred_city)->first();
				if($applicant->prefCity) {
					$applicant->prefCity = $applicant->prefCity->name;
				}
				else {
					$applicant->prefCity = '-';
				}

				// last activity
				$applicant->lastActivity = DB::table('job_order_applicant_statuses')
				->where('job_order_applicant_id', $applicant->id)
				->orderBy('id', 'desc')
				->first();
				if($applicant->lastActivity) {
					$applicant->lastActivity->creator = DB::table('cms_users')->where('id', $applicant->lastActivity->creator_id)->first()->name;
				}
			}
			$data['applicants'] = $applicants;

			// search
			$data['searchResults'] = [];
			
			//$result = DB::table('candidates');
			if($_REQUEST['functional_area']==null && $_REQUEST['functional_area_skills']==null && 
				$_REQUEST['industry']==null && $_REQUEST['minExpY']==null && $_REQUEST['maxExpY']==null 
				&& $REQUEST['maxCtc']==null &&$_REQUEST['minCtc']==null && $_REQUEST['functional_area_roles']==null && $_REQUEST['q']==null) {
				$data['searchResults'] = [];
		} ///Search Listing
						else{
							
       								
							$cids = [];
				// Functional Area
							if($_REQUEST['functional_area']!=''&& $_REQUEST['q']=='') {
								dump("enter");
								$_functional_area = explode('--', $_REQUEST['functional_area']);
								$result_f_a = DB::table('candidate_industry_functional_areas')->select('candidate_id')->where('candidate_industry_functional_areas.industry_functional_area','like', '%' .$_functional_area[1].'%')->get();
								if($result_f_a) {
									foreach ($result_f_a as $_cids) {
										$cids[] = $_cids->candidate_id;
									}
								}
							}

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
								if($_REQUEST['location']!='') {
									$resumeCity = explode('-', $_REQUEST['location']);
									$resumeResults = $resumeResults->orWhere('candidates.resume_content','like','%'.$resumeCity[1].'%');
								}
								$resumeResults = $resumeResults->get();

								$resumeCid = [];
								foreach ($resumeResults as $resumeResult) {
									$resumeCid[] = 	$resumeResult->id;
								}
								$cids = array_merge($cids,$resumeCid);
							}

							$cids = array_unique($cids);
							//dump($cids);
							if($_REQUEST['q']==''){
									$result = DB::table('candidates');	
							}
							else{
								$result=[];
							}	
				// Experience years
							if($_REQUEST['minExpM']!='' || $_REQUEST['minExpY']!='' || $_REQUEST['maxExpM']!='' || $_REQUEST['maxExpY']!=''&& $_REQUEST['q']=='') {
								$minExp = 0;
								$maxExp = 150;
								if($_REQUEST['minExpY']!='' && $_REQUEST['minExpM']!='') {
									$minExp = ($_REQUEST['minExpY']*12)+$_REQUEST['minExpM'];
								}
								if($_REQUEST['minExpY']=='' && $_REQUEST['minExpM']!='') {
									$minExp = $_REQUEST['minExpM'];
								}
								if($_REQUEST['minExpY']!='' && $_REQUEST['minExpM']=='') {
									$minExp = $_REQUEST['minExpY']*12;
								}
								if($_REQUEST['maxExpY']!='' && $_REQUEST['maxExpM']!='') {
									$maxExp = ($_REQUEST['maxExpY']*12)+$_REQUEST['maxExpM'];
								}
								if($_REQUEST['maxExpY']=='' && $_REQUEST['maxExpM']!='') {
									$maxExp = $_REQUEST['maxExpM'];
								}
								if($_REQUEST['maxExpY']!='' && $_REQUEST['maxExpM']=='') {
									$maxExp = $_REQUEST['maxExpY']*12;
								}
								$result = $result->whereRaw('((candidates.experience_years*12)+candidates.experience_months) >='.$minExp)
								->whereRaw('((candidates.experience_years*12)+candidates.experience_months)<='.$maxExp);
							}

							/*if($_REQUEST['functional_area']!='' || $_REQUEST['functional_area_skills']!='' || $_REQUEST['industry']!=''||$_REQUEST['functional_area_roles']!=''&& $_REQUEST['q']==''){
								$result = $result->whereIn('candidates.id', $cids);

							}
*/
				// Location
							if($_REQUEST['location']!=''&& $_REQUEST['q']=='') {
								$city = explode('-', $_REQUEST['location']);
								$result = $result->where('candidates.current_city','=',$city[0]);
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
							if($_REQUEST['maxCtc'] != '' && $_REQUEST['q']=='') {
								$result = $result->where('candidates.current_ctc','<=',$_REQUEST['maxCtc']);
							}
				//Min Ctc
							if($_REQUEST['minCtc'] != ''&& $_REQUEST['q']=='') {
								$result = $result->where('candidates.current_ctc','>=',$_REQUEST['minCtc']);	
							}
							if(!empty($cids) && $_REQUEST['q']==''){
								$result = $result->whereIn('id',$cids);
							}
							if($_REQUEST['q']==''){
							   $result = $result
							          ->orderby('candidates.updated_at','desc')->paginate(10);
							}else{
								$result=[];
							}	
							if(trim($_REQUEST['q'])) {
								//dump($cids);
								 //                       $length = preg_match_all ('/[^ \.]/' ,$_REQUEST['q'], $matches);
        //                         if($length==2)
        //                         {
        //                         $search= str_replace(' ', '',$_REQUEST['q']);
        //                         }
								// else{
								// $search= str_replace(' ', ' ',$_REQUEST['q']);
								// }
								/*$result = $this->getCandidateFromSearchQuery(trim($_REQUEST['q']));*/
								$matched_ids=app('App\Http\Controllers\AdminCandidatesController')->getCandidateFromSearchQuery(trim($_REQUEST['q']),$_REQUEST['functional_area'],$_REQUEST['functional_area_skills'], $_REQUEST['industry'],$_REQUEST['functional_area_roles'],NULL);
								$matched_ids=array_merge($matched_ids,$matched_ids);
								$matched_ids=array_unique($matched_ids);
								$new_matched_array = array();
   								array_walk_recursive($matched_ids, function($a) use (&$new_matched_array) { $new_matched_array[] = $a; });
							if(!empty(array_filter($matched_ids)))	{
								$result = DB::table('candidates');	
				// Experience years
							if($_REQUEST['minExpM']!='' || $_REQUEST['minExpY']!='' || $_REQUEST['maxExpM']!='' || $_REQUEST['maxExpY']!='') {
								$minExp = 0;
								$maxExp = 150;
								if($_REQUEST['minExpY']!='' && $_REQUEST['minExpM']!='') {
									$minExp = ($_REQUEST['minExpY']*12)+$_REQUEST['minExpM'];
								}
								if($_REQUEST['minExpY']=='' && $_REQUEST['minExpM']!='') {
									$minExp = $_REQUEST['minExpM'];
								}
								if($_REQUEST['minExpY']!='' && $_REQUEST['minExpM']=='') {
									$minExp = $_REQUEST['minExpY']*12;
								}
								if($_REQUEST['maxExpY']!='' && $_REQUEST['maxExpM']!='') {
									$maxExp = ($_REQUEST['maxExpY']*12)+$_REQUEST['maxExpM'];
								}
								if($_REQUEST['maxExpY']=='' && $_REQUEST['maxExpM']!='') {
									$maxExp = $_REQUEST['maxExpM'];
								}
								if($_REQUEST['maxExpY']!='' && $_REQUEST['maxExpM']=='') {
									$maxExp = $_REQUEST['maxExpY']*12;
								}
								$result = $result->whereRaw('((candidates.experience_years*12)+candidates.experience_months) >='.$minExp)
								->whereRaw('((candidates.experience_years*12)+candidates.experience_months)<='.$maxExp);
							}

							/*if($_REQUEST['functional_area']!='' || $_REQUEST['functional_area_skills']!='' || $_REQUEST['industry']!=''||$_REQUEST['functional_area_roles']!=''){
								
								$result=$result->whereIn('candidates.id',$matched_ids[0]);

							}*/

				//Max Ctc
							if($_REQUEST['maxCtc'] != '') {
								$result = $result->where('candidates.current_ctc','<=',$_REQUEST['maxCtc']);
							}
				//Min Ctc
							if($_REQUEST['minCtc'] != '') {
								$result = $result->where('candidates.current_ctc','>=',$_REQUEST['minCtc']);
							}
							$result=$result->wherein('candidates.id',$new_matched_array);
							$result=$result->orderby('candidates.updated_at','desc')->paginate(10);
							}
							}
	
						
							$i=0;
							foreach ($result as $candidate) {
								$_current_city_name = DB::table('cities')->find($candidate->current_city)->name;
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
								$result[$i]->highest_qualification = DB::table('qualifications')->find($candidate->highest_qualification)->qualification;
								$i++;
							}
							$data['searchResults'] = $result;
						}
						
						if($_REQUEST['current_action']== 'list_functional_roles_skills') {
							if($_REQUEST['functional_area_id']!=''){
							$functional_area_id = explode('-', $_REQUEST['functional_area_id']);
							$functional_area['skills'] = DB::table('industry_functional_area_skills')->where('industry_functional_area_id',$functional_area_id[0])->orderby('name','asc')->get();

							$functional_area['roles'] = DB::table('industry_functional_area_roles')->where('industry_functional_area_id',$functional_area_id[0])->orderby('name','asc')->get();
							}
							return $functional_area;
						}

			$data['recruiter'] = DB::table('cms_users')->where('id', $data['jobOrder']->recruiter)->first();
			$data['owners'] = DB::table('cms_users')->where('status',USER_ACTIVE)->get();
			$countQuery = DB::table('job_order_applicants')->where('job_order_id', $_REQUEST['job_order_id'])->whereNull('deleted_at');

			$filterCount_pipelined = clone $countQuery;
			$filterCount_qualify = clone $countQuery;
			$filterCount_submission = clone $countQuery;
			$filterCount_interview = clone $countQuery;
			$filterCount_offer = clone $countQuery;
			$filterCount_place = clone $countQuery;
			$filterCount_associated = clone $countQuery;
			$filterCount_pending_review = clone $countQuery;
			$filterCount_reviewed = clone $countQuery;
			$filterCount_declined_by_c2w = clone $countQuery;
			$filterCount_qualified = clone $countQuery;
			$filterCount_submitted_to_client = clone $countQuery;
			$filterCount_approved_by_client = clone $countQuery;
			$filterCount_rejected_by_client = clone $countQuery;
			$filterCount_interview_to_be_Scheduled = clone $countQuery;
			$filterCount_interview_scheduled = clone $countQuery;
			$filterCount_interview_rescheduled = clone $countQuery;
			$filterCount_rejected_for_interview = clone $countQuery;
			$filterCount_interview_in_progress = clone $countQuery;
			$filterCount_interview_done = clone $countQuery;
			$filterCount_waiting_for_consensus = clone $countQuery;
			$filterCount_to_be_offered = clone $countQuery;
			$filterCount_on_hold = clone $countQuery;
			$filterCount_interview_feedback_rescheduled = clone $countQuery;
			$filterCount_rejected = clone $countQuery;
			$filterCount_rejected_hirable = clone $countQuery;
			$filterCount_offer_follow_up = clone $countQuery;
			$filterCount_offer_made = clone $countQuery;
			$filterCount_offer_accepted = clone $countQuery;
			$filterCount_offer_declined = clone $countQuery;
			$filterCount_offer_withdrawn = clone $countQuery;
			$filterCount_no_show = clone $countQuery;
			$filterCount_un_qualified = clone $countQuery;
			$filterCount_hired = clone $countQuery;
			$filterCount_converted_employee	 = clone $countQuery;
			$filterCount_callBack	 = clone $countQuery;
			$filterCount_BackedOut	 = clone $countQuery;
			$filterCount_Interview_BackedOut = clone $countQuery;
			$filterCount_Interview_Shortlisted = clone $countQuery;
			$filterCount_Joining_Extended = clone $countQuery;
			$filterCount_Reschedule_Submission = clone $countQuery;
			
			$data['count_pipelined'] = count($filterCount_pipelined->get());
			$data['count_qualify'] = count( $filterCount_qualify->where('primary_status','Qualify')->get());
			$data['count_submission'] = count( $filterCount_submission->where('primary_status','Submission')->get());
			$data['count_interview'] = count( $filterCount_interview->where('primary_status','Interview')->get());
			$data['count_offer'] = count( $filterCount_offer->where('primary_status','Offer')->get());
			$data['count_place'] = count( $filterCount_place->where('primary_status','Place')->get());
			

			// $data['count_associated'] = count( )->get());
			$data['count_pending_review'] = count( $filterCount_pending_review->where('secondary_status','Pending Review')->get());
			$data['count_callBack'] = count( $filterCount_callBack->where('primary_status','Qualify')->where('secondary_status','Schedule Call Back')->get());
			$data['count_reviewed'] = count( $filterCount_reviewed->where('secondary_status','Reviewed')->get());
			$data['count_declined_by_c2w'] = count( $filterCount_declined_by_c2w->where('secondary_status','Declined by C2W')->get());
			$data['count_qualified'] = count( $filterCount_qualified->where('secondary_status','Qualified')->get());
			$data['count_submitted_to_client'] = count( $filterCount_submitted_to_client->where('secondary_status','Submitted to client')->get());
			$data['count_approved_by_client'] = count( $filterCount_approved_by_client->where('secondary_status','Approved by the client')->get());
			$data['count_rejected_by_client'] = count( $filterCount_rejected_by_client->where('primary_status','Submission')->where('secondary_status','Rejected by the client')->get());
			/*$data['count_interview_to_be_Scheduled'] = count( $filterCount_interview_to_be_Scheduled->where('secondary_status','Interview to be Scheduled')->get());*/
			$data['count_interview_scheduled'] = count( $filterCount_interview_scheduled->where('secondary_status','Interview Scheduled')->get());
			$data['count_interview_rescheduled'] = count($filterCount_interview_rescheduled->where('secondary_status','Interview Rescheduled')->get());
			$data['count_rejected_for_interview'] = count( $filterCount_rejected_for_interview->where('secondary_status','Rejected for Interview')->get());
			$data['count_interview_in_progress'] = count( $filterCount_interview_in_progress->where('secondary_status','Interview in Progress')->get());
			$data['count_interview_done'] = count( $filterCount_interview_done->where('secondary_status','Interview Done')->get());
			$data['count_waiting_for_consensus'] = count( $filterCount_waiting_for_consensus->where('secondary_status','Waiting for Consensus')->get());
			$data['count_to_be_offered'] = count( $filterCount_to_be_offered->where('secondary_status','To be Offered')->get());
			$data['count_on_hold'] = count( $filterCount_on_hold->where('secondary_status','On Hold')->get());
			$data['count_on_interview_feedback_rescheduled']= count($filterCount_interview_feedback_rescheduled->where('primary_status','Interview')->where('secondary_status','Interview Feedback Rescheduled')->get());
			/*$data['count_rejected'] = count( $filterCount_rejected->where('primary_status','Interview')->where('secondary_status','Rejected')->get());*/
			$data['count_rejected'] = count( $filterCount_rejected->where('primary_status','Interview')->where('secondary_status','Rejected by the client')->get());
			$data['count_rejected_hirable'] = count( $filterCount_rejected_hirable->where('secondary_status','Rejected Hirable')->get());
			$data['count_offer_made'] = count( $filterCount_offer_made->where('secondary_status','Offer Made')->get());
			$data['count_offer_follow_up'] = count( $filterCount_offer_follow_up->where('secondary_status','Confirm Offer Follow Up')->get());
			$data['count_offer_accepted'] = count( $filterCount_offer_accepted->where('secondary_status','Offer Accepted')->get());
			$data['count_offer_declined'] = count( $filterCount_offer_declined->where('secondary_status','Offer Declined')->get());
			$data['count_offer_withdrawn'] = count( $filterCount_offer_withdrawn->where('secondary_status','Offer Withdrawn')->get());
			$data['count_no_show'] = count( $filterCount_no_show->where('secondary_status','No Show')->get());
			$data['count_un_qualified'] = count( $filterCount_un_qualified->where('secondary_status','Un Qualified')->get());
			$data['count_hired'] = count( $filterCount_hired->where('secondary_status','Joined')->get());
			$data['count_backed_out'] = count( $filterCount_BackedOut->where('primary_status','Place')->where('secondary_status','Backed Out')->get());
			$data['count_interview_backed_out'] = count($filterCount_Interview_BackedOut->where('primary_status','Interview')->where('secondary_status','Backed Out')->get());
			$data['count_joining_extended'] = count($filterCount_Joining_Extended->where('primary_status','Place')->where('secondary_status','Joining Extended')->get());
			$data['count_interview_shortlisted'] = count($filterCount_Interview_Shortlisted->where('primary_status','Interview')->where('secondary_status','Shortlisted for Next Round')->get());
			$data['count_reschedule_submission'] = count($filterCount_Reschedule_Submission->where('primary_status','Submission')->where('secondary_status','Reschedule Submission')->get());
			// $data['count_converted_employee'] = count( $filterCount_converted_employee->where('secondary_status','Converted Employee')->get());

			$data['resubmission_followup'] = DB::table('job_order_submission_history')
				->where('job_order_id', $_REQUEST['job_order_id'])
				->where('active', 1)
				->orderBy('id', 'desc')
				->first();
			return $this->cbView('override.job_order_applicants.main',$data);
		}
	    //By the way, you can still create your own method in here... :) 
		public function getFilteredApplicant() {
			$applicantQuery = DB::table('job_order_applicants')->where('job_order_id', $_REQUEST['job_order_id'])->whereNull('deleted_at');
			$applicantIds = [];
			foreach ($_REQUEST['secondary_status_filter'] as $secondary_status) {
				$filteredApplicantQuery = clone $applicantQuery;
				if($secondary_status == 'Backed Out' || $secondary_status =='Interview Backed Out') {
					if($secondary_status == 'Backed Out') {
						$applicants = $filteredApplicantQuery->where('primary_status','Place')->where('secondary_status',$secondary_status)->get();
					} 
					if($secondary_status =='Interview Backed Out') {
						$applicants = $filteredApplicantQuery->where('primary_status','Interview')->where('secondary_status','Backed Out')->get();
					}
				} 
			    else if($secondary_status == 'Rejected by the client' || $secondary_status =='Submission Rejected by the client') {
					if($secondary_status == 'Rejected by the client') {
						$applicants = $filteredApplicantQuery->where('primary_status','Interview')->where('secondary_status',$secondary_status)->get();
					} 
					if($secondary_status =='Submission Rejected by the client') {
						$applicants = $filteredApplicantQuery->where('primary_status','Submission')->where('secondary_status','Rejected by the client')->get();
					}
				}
				else {
					if($secondary_status == 'Associated'){
					   $applicants = $filteredApplicantQuery->get();
                    }
                    if($secondary_status!= 'Associated'){
                      $applicants = $filteredApplicantQuery->where('secondary_status',$secondary_status)->get();	
                    }
					
				}
			 
				foreach ($applicants as $applicant) {
					$applicantIds[] = $applicant->id;
				}
			}

			$filteredApplicants = $applicantQuery->whereIn('id',$applicantIds)->get();
			return $filteredApplicants;
		}
	public function updateOwner(){
		
		
		$update=\DB::table('job_order_applicants')
              ->where('id', $_REQUEST['applicant_id'])
              ->update([
                'creator_id' => $_REQUEST['id']   
            ]);

			$update2=\DB::table('events')
			->where('job_order_id',  $_REQUEST['job_order_id'])
			->where('candidate_id', $_REQUEST['candidate_id'])
			->update([
			 'owner_id' => $_REQUEST['id'],
			 'owner_name' =>$_REQUEST['owner_name']  
		 ]);
	
			
			
	
			
        if($update2=1){
        return 'ok'	;
        }
        else{
         return 'notok'	;
        }
	}
	public function CandidateAddtocontroller(Request $_request){
		//return 1;
							 $jobOrderVacancy=DB::table('job_orders')->where('id',$_request::input('job_order_id'))->first();
						
					        $openings=$jobOrderVacancy->openings_available;
					        	//check whether candidate already in joborder
							$checkJobOrders = DB::table('job_order_applicants')
							->where('candidate_id',$_request::input('candidate_id'))
							->where('job_order_id',$_request::input('job_order_id'))
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
						//	return 1;
					        else{
								//return 1;
							if(count($checkJobOrders)==0) {
								$addToJo = DB::table('job_order_applicants')->insertGetId(
									[
										'job_order_id' => $_request::input('job_order_id'),
										'candidate_id' => $_request::input('candidate_id'),
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
	}
