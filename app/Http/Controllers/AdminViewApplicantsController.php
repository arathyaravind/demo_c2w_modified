<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminViewApplicantsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "first_name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "website_candidates";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"First Name","name"=>"first_name"];
			$this->col[] = ["label"=>"Last Name","name"=>"last_name"];
			$this->col[] = ["label"=>"Email","name"=>"primary_email","callback" => function($row) {
				$existingMail = \DB::table('candidates')->where('primary_email', $row->primary_email)->first();
				if($existingMail) {
					return $row->primary_email.'&nbsp;<a href="#" style="color: #75d422!important;" title="Email Already Exist!."><span class="glyphicon glyphicon-info-sign"></span></a>';
				}
				else {
					return $row->primary_email;
				}
            }];
			$this->col[] = ["label"=>"Contact Number","name"=>"primary_phone"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			/*$this->form = [];
			$this->form[] = ['label'=>'Web Firstname','name'=>'web_firstname','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Web Lastname','name'=>'web_lastname','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Web Email','name'=>'web_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Web Phone','name'=>'web_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Web Resume','name'=>'web_resume','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];*/
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Job Order Id","name"=>"job_order_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"job_order,id"];
			//$this->form[] = ["label"=>"Web Firstname","name"=>"web_firstname","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Web Lastname","name"=>"web_lastname","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Web Email","name"=>"web_email","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Web Phone","name"=>"web_phone","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Web Resume","name"=>"web_resume","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
	    	$this->addaction[] = ['label' => 'Associate', 'url' => "/admin/associate-applicants?job_order_id=[job_order_id]&&website_candidate_id=[web_candidate_id]",'name' => 'Associate' ,"showIf"=>"[status] == 'inactive'" ];
			$this->addaction[] = ['label' => 'Associated',"showIf"=>"[status] == 'active'" ];	
	       
	       
	       
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
	        $this->script_js = " $(document).ready(function() {
	        	$('.button_action').find('a').each(function(){  // To get all <a> tag title
	        		var getTitletxt = $(this).attr('title');
	        		var associate='Associated';
	        		var check_associate='Associate';
	        		if(getTitletxt==associate)
	        		{	 $(this).addClass('associate');
	        			 $(this).removeClass('btn');
	        			 $(this).removeClass('btn-xs ');
	        			 $(this).removeClass('btn-primary'); 
	        			 $(this).removeAttr('onclick');
	        			 $(this).removeAttr('href');	
	        		}
	        		if(getTitletxt==check_associate)
	        		{	 $(this).addClass('check_associate');
	        		}

        });
           $('.check_associate').on('click', function(event) {
				if(!$(this).hasClass('visited'))
			    {
			        $(this).addClass('visited')
			        return true;
			    }
			    else
			    {
			        $(this).removeAttr('href'); // optional
			        // some other code here
			        return false;
			    }
       });
     });";
            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        $job_order_name = DB::table('job_orders')->find($_REQUEST['job_order_id'])->title;
	        $this->pre_index_html = "<p>
		<a title='Return' href='/admin/website-applications'> 
			<i class='fa fa-chevron-circle-left '></i>
			Back To List Data Website Applications
		</a>
		</p>
		<div class='col-md-12 col-sm-12 pull-left filter-group-jo'><p style='width:545px; font-family: auto; font-size: 25px;'><b><u>".$job_order_name."</u></b></p></div>
		";
	        
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
	        $this->style_css = ".associate{padding-right:5px;}";
	        $this->style_css = file_get_contents(public_path() . '/css/modules/' . 'common.css');
            $this->style_css .= ".box-body.table-responsive.no-padding{padding-bottom: 15px !important;}
        ";
            $this->style_css .= ".filter-group-jo .status-filter-jo{width: 150px !important;}
        ";
	        
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
	    Session::put('job_order_id',$_REQUEST['job_order_id']);
	    $query->orderby('website_applications.id','desc');
	    $query->where('job_order_id',$_REQUEST['job_order_id']);
	    $query->join('website_applications','website_applications.web_candidate_id','=','website_candidates.id');
        $query->select('website_candidates.*','website_applications.*','website_candidates.id'); 
        $candidates=$query->get();
     	foreach($candidates as $candidate){
        $existingMail = \DB::table('candidates')->where('primary_email',$candidate->primary_email)->first();
        if($existingMail) {
        $id=$existingMail->id;
        $existingJoborderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$_REQUEST['job_order_id'])->where('candidate_id',$id)->whereNull('job_order_applicants.deleted_at')->first();
        $existingRemovedJoborderApplicant = \DB::table('job_order_applicants')->where('job_order_id',$_REQUEST['job_order_id'])->where('candidate_id',$id)->wherenotNull('job_order_applicants.deleted_at')->first();
           if($existingJoborderApplicant){ 
              DB::table('website_applications')->where('job_order_id',$candidate->job_order_id)->where('web_candidate_id',$candidate->web_candidate_id)->update(['status'=>'active']); 
          }
          else{
          	DB::table('website_applications')->where('web_candidate_id',$candidate->web_candidate_id)
          	->where('job_order_id',$candidate->job_order_id)->update(['status'=>'inactive']); 
          }
          if($existingRemovedJoborderApplicant){
          	 DB::table('website_applications')->where('web_candidate_id',$candidate->web_candidate_id)->where('job_order_id',$candidate->job_order_id)->update(['remove_status'=>'removed']); 
          }
        }
	    }
	
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
	    $request= \DB::table('website_candidates')->where('id',$id)->first();
	    $website_applications= \DB::table('website_applications')->where('web_candidate_id',$id)->first();
	    Session::put('job_order_id',$website_applications->job_order_id);
	    $job_order_id= Session::get('job_order_id');
        $existingMail = \DB::table('candidates')->where('primary_email',$request->primary_email)->first();
        if($existingMail) {
        $candidate_id=$existingMail->id;
	    $jobOrderApplicant = \DB::table('job_order_applicants')
       	->where('job_order_id',$website_applications->job_order_id)
       	->where('candidate_id',$candidate_id)->first();
       	if($jobOrderApplicant)
       	{
        \DB::table('events')->where('job_order_id',$website_applications->job_order_id)->where('candidate_id',$candidate_id)->delete();

        \DB::table('job_order_applicants')
       	->where('job_order_id',$website_applications->job_order_id)->where('candidate_id',$candidate_id)
        ->update([
            'deleted_at' => \DB::raw('NOW()')
        ]);

        \DB::table('job_order_applicant_statuses')
        ->insert([
            'job_order_applicant_id' => $jobOrderApplicant->id,
            'prev_primary_status' => $jobOrderApplicant->primary_status,
            'prev_secondary_status' => $jobOrderApplicant->secondary_status,
            'new_primary_status' => $jobOrderApplicant->primary_status,
            'new_secondary_status' => 'Deleted',
            'note' => '',
            'prev_callback_date' => $jobOrderApplicant->callback_date,
            'prev_scheduled_feedback_date' => $jobOrderApplicant->scheduled_feedback_date,
            'prev_interview_date' => $jobOrderApplicant->interview_date,
            'prev_interview_confirmation_date' => $jobOrderApplicant->interview_confirmation_date,
            'prev_interview_followup_date' => $jobOrderApplicant->interview_followup_date,
            'prev_offer_confirmation_date' => $jobOrderApplicant->offer_confirmation_date,
            'prev_joining_date' => $jobOrderApplicant->joining_date,
            'creator_id' => CRUDBooster::myId(),
            'created_at' => \DB::raw('NOW()')
        ]);
         \DB::table('website_applications')->where('id',$website_applications->id)->delete();
    	 CRUDBooster::redirect('/admin/view-applicants?job_order_id='.$job_order_id,"Successfully delete the Applicant.","success");
    	}
    	else{
    	 \DB::table('website_applications')->where('id',$website_applications->id)->delete();
    	 CRUDBooster::redirect('/admin/view-applicants?job_order_id='.$job_order_id,"Successfully delete the Applicant.","success");
    }
    }
    
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
	     public function getDetail($id)	{
		$this->cbLoader();
		$row = DB::table($this->table)->where($this->primary_key,$id)->first();
		$row->job_order_id= Session::get('job_order_id');
		$row->job_order_name=\DB::table('job_orders')->find($row->job_order_id)->title;
		$row->highest_qualification = DB::table('qualifications')->find($row->highest_qualification)->qualification;
		$row->country = DB::table('countries')->find($row->country_id)->name;
		$row->state = DB::table('states')->find($row->state_id)->name;
		$row->city = DB::table('cities')->find($row->city_id)->name;
		$row->current_city= DB::table('cities')->find($row->current_city)->name;
		$row->preferred_city = DB::table('cities')->find($row->preferred_city)->name;
		$row->postal_code = DB::table('postal_codes')->find($row->postal_code)->name;
		if($row->can_relocate == 1) {
				$row->can_relocate = 'Yes';
			} else {
				$row->can_relocate = 'No';
			}
		$industries = DB::table('industries')->WhereIn('id',json_decode($row->industry_id, true))->get();
		$skills=DB::table('industry_functional_area_skills')->WhereIn('id',json_decode($row->industry_functional_area_skill_id, true))->get();
		$roles=DB::table('industry_functional_area_roles')->WhereIn('id',json_decode($row->industry_functional_area_role_id, true))->get();
		$areas=DB::table('industry_functional_areas')->WhereIn('id',json_decode($row->industry_functional_area_id, true))->get();
		$existingMail = \DB::table('candidates')->where('primary_email',$row->primary_email)->first();
        if($existingMail) {
        $id=$existingMail->id;
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
		$row->candidate_jo = $candidate_jo;
		//dd($row->candidate_jo);
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
		}

		$page_title = "Applicant Details &nbsp;&nbsp;";
		$this->cbView('override.candidates.applied_candidates_view',compact('page_title','row','industries','skills','roles','areas'));	
	}
	}