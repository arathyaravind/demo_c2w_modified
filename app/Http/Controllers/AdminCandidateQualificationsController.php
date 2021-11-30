<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminCandidateQualificationsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "candidate_qualifications";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Candidate","name"=>"candidate_id","join"=>"candidates,first_name", "callback" => function($row) {
					$candidate = DB::table('candidates')->find($row->candidate_id);
                    return $candidate->first_name." ".$candidate->last_name;  
                }];
			$this->col[] = ["label"=>"Qualification Level","name"=>"qualification_level"];
			$this->col[] = ["label"=>"Qualification","name"=>"qualification"];
			$this->col[] = ["label"=>"Score","name"=>"score"];
			$this->col[] = ["label"=>"Completed Year","name"=>"completed_year"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Candidate Id','name'=>'candidate_id','type'=>'hidden','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Qualification Level','name'=>'qualification_level_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualification_levels,qual_level'];
			// $this->form[] = ['label'=>'Qualification Level Order','name'=>'qualification_level_order','type'=>'hidden','width'=>'col-sm-9'];
			$this->form[] = ['label'=>'Qualification','name'=>'qualification','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualifications,qualification','parent_select' => 'qualification_level_id'];
			$this->form[] = ['label'=>'Is Completed','name'=>'is_completed','type'=>'radio','validation'=>'required','width'=>'col-sm-10','dataenum'=>'1|yes;0|no'];
			$this->form[] = ['label'=>'Completed Year','name'=>'completed_year','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Score','name'=>'score','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Candidate Id','name'=>'candidate_id','type'=>'hidden','width'=>'col-sm-9'];
			//$this->form[] = ['label'=>'Qualification Level','name'=>'qualification_level_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'1|yes;0|no'];
			//$this->form[] = ['label'=>'Qualification','name'=>'qualification','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Is Completed','name'=>'is_completed','type'=>'radio','validation'=>'required','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Completed Year','name'=>'completed_year','type'=>'number','validation'=>'integer|min:0','width'=>'col-sm-10','datatable'=>'qualification_levels,qual_level'];
			//$this->form[] = ['label'=>'Score','name'=>'score','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualifications,qualification','parent_select'=>'qualification_level_id'];
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
	        Session::put('candidate_id',$_REQUEST['candidate_id']);
	        $query->where('candidate_id',$_REQUEST['candidate_id']);    
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
	        $candidate_id = Session::get('candidate_id');
	    	
	    	$qualification = DB::table('qualifications')->find($postdata['qualification'])->qualification;
	    	
	    	$qualification_level = DB::table('qualification_levels')->find($postdata['qualification_level_id']);
	    	
	    	$duplicateQualification = DB::table('candidate_qualifications')->where('candidate_id',$candidate_id)->where('qualification',$qualification)->where('qualification_level',$qualification_level->qual_level)->where('score',$postdata['score'])->where('completed_year',$postdata['completed_year'])->where('completed_year',$postdata['completed_year'])->first();
	        if($duplicateQualification) {
	        	CRUDBooster::redirect(CRUDBooster::mainpath().'?candidate_id='.$candidate_id,"Already Exists","warning");
	        } else {		        
		        $postdata['qualification_id'] = $postdata['qualification'];
		        $postdata['qualification'] = $qualification;
		        $postdata['qualification_level'] =  $qualification_level->qual_level;
		        $postdata['candidate_id'] = $candidate_id;
		        // unset($postdata['qualification_level_id']);
	    	}
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
	        $candidate_id = Session::get('candidate_id');
	        $qualification_level = DB::table('candidate_qualifications')
                ->where('candidate_id', $candidate_id)
                ->first();
            $current_qualification =  DB::table('candidate_qualifications')->find($id);
   //          if($qualification_level->qualification_level!= $current_qualification->qualification_level || $qualification_level->qualification!= $current_qualification->qualification){
   //          	$update = DB::table('candidates')->where('id', $candidate_id)
   //          			->update(['highest_qualification_level' => $current_qualification->qualification_level,'highest_qualification' => $current_qualification->qualification]);
			// }
			// else {
			// 	$candidate = DB::table('candidates')->select('highest_qualification_level','highest_qualification')->find($candidate_id);
 		// 		if($candidate->highest_qualification_level!=$current_qualification->qualification_level){
   //          		if($candidate->highest_qualification!=$current_qualification->qualification){
   //          			$update = DB::table('candidates')->where('id', $candidate_id)
   //          					->update(['highest_qualification_level' => $current_qualification->qualification_level,'highest_qualification' => $current_qualification->qualification]);
   //          		}

   //          	}
			// }
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
	        $candidate_id = Session::get('candidate_id');
	    	$qualification = DB::table('qualifications')->find($postdata['qualification'])->qualification;
	    	
	    	$qualification_level = DB::table('qualification_levels')->find($postdata['qualification_level_id']);
	    	
	    	$duplicateQualification = DB::table('candidate_qualifications')
	    		->where('candidate_id',$candidate_id)
	    		->where('qualification',$qualification)
	    		->where('qualification_level',$qualification_level->qual_level)
	    		->where('score',$postdata['score'])
	    		->where('completed_year',$postdata['completed_year'])
	    		->where('completed_year',$postdata['completed_year'])
	    		->where('id','<>',$id)
	    		->first();

	        if($duplicateQualification) {
	        	CRUDBooster::redirect(CRUDBooster::mainpath().'?candidate_id='.$candidate_id,"Already Exists","warning");
	        } else {
	        	$postdata['qualification_id'] = $postdata['qualification'];
		        $postdata['qualification'] = $qualification;
		        $postdata['qualification_level'] =  $qualification_level->qual_level;
		        $postdata['candidate_id'] = $candidate_id;
		        unset($postdata['qualification_level_id']);
	    	}

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
	        $candidate_id = Session::get('candidate_id');
	        $qualification_level = DB::table('candidate_qualifications')
                ->where('candidate_id', $candidate_id)
               /* ->orderBy('qualification_level_order', 'desc')*/->first();
            $current_qualification =  DB::table('candidate_qualifications')->find($id);
            //if($qualification_level->qualification_level!= $current_qualification->qualification_level || $qualification_level->qualification!= $current_qualification->qualification){
   //          	$update = DB::table('candidates')->where('id', $candidate_id)
   //          			->update(['highest_qualification_level' => $current_qualification->qualification_level,'highest_qualification' => $current_qualification->qualification]);
			// }
			// else {
			// 	$candidate = DB::table('candidates')->select('highest_qualification_level','highest_qualification')->find($candidate_id);
 		// 		if($candidate->highest_qualification_level!=$current_qualification->qualification_level){
   //          		if($candidate->highest_qualification!=$current_qualification->qualification){
   //          			$update = DB::table('candidates')->where('id', $candidate_id)
   //          					->update(['highest_qualification_level' => $current_qualification->qualification_level,'highest_qualification' => $current_qualification->qualification]);
   //          		}

   //          	}
			// }
			
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
	        // Check  and update candidates table with highest qualification of the candidate before deleting
	        $candidate_id = Session::get('candidate_id');
	        $current_qualification =  DB::table('candidate_qualifications')->find($id);
            $candidate = DB::table('candidates')
            				->select('highest_qualification_level','highest_qualification')
            				->find($candidate_id);
            if($candidate) {
        		if($candidate->highest_qualification_level== $current_qualification->qualification_level && $candidate->highest_qualification== $current_qualification->qualification){
	            	$qualification_level = DB::table('candidate_qualifications')
	                					->where('candidate_id', $candidate_id)
	                					/*->orderBy('qualification_level_order', 'desc')*/->first();
	            	$update = DB::table('candidates')->where('id', $candidate_id)
	            			->update(['highest_qualification_level' => $qualification_level->qualification_level,'highest_qualification' => $qualification_level->qualification]);
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
	        
	    }



	    //By the way, you can still create your own method in here... :) 
	    public function getEdit($id) {
			
			$this->cbLoader();
			$row = DB::table('candidate_qualifications')->where('id',$id)->first();

			$qualification = DB::table('qualifications')->where('qualification',$row->qualification)->first();

			$qualification_level = DB::table('qualification_levels')->where('qual_level',$row->qualification_level)->first();

			$row->qualification = $qualification->id;
			$row->qualification_level_id = $qualification_level->id;
			
			Session::put('current_row_id',$id);

			return view('crudbooster::default.form',compact('id','row','page_menu','page_title','command'));
	  	}


	}