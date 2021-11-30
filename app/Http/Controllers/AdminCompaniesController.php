<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Route;
	use Redirect;

	class AdminCompaniesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			//$this->orderby = "company_id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "companies";
			$this->primary_key = "id";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Name","name"=>"name"];
			$this->col[] = ["label"=>"City","name"=>"city","join"=>"cities,name"];
			//$this->col[] = ["label"=>"Contract Rate","name"=>"Service Charge"];
			$this->col[] = ["label"=>"Contract Rate","name"=>"contract_rate"];
           /* $this->col[] = ["label"=>"Primary Contact","name"=>"primary_contact_name"];
            $this->col[] = ["label"=>"Primary Contact Phone","name"=>"primary_contact_phone"];
            $this->col[] = ["label"=>"Primary Contact Email","name"=>"primary_contact_email"];*/

			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|min:1|max:70','width'=>'col-sm-5'];
			/*$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Web Site','name'=>'url','type'=>'text','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'State','name'=>'state','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			$this->form[] = ['label'=>'Postal Code','name'=>'zip','type'=>'text','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Phone 1','name'=>'phone1','type'=>'text','validation'=>'required','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Phone 2','name'=>'phone2','type'=>'text','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Key Technologies','name'=>'key_technologies','type'=>'text','width'=>'col-sm-8'];
			$this->form[] = ['label'=>'Contract Rate','name'=>'Service Charge','type'=>'text','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Replacement Term','name'=>'Replacement Term','type'=>'text','width'=>'col-sm-3'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','width'=>'col-sm-5'];*/
			$this->form[] = ['label'=>'Web Site','name'=>'web_site','type'=>'text','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Founded Date','name'=>'founded_date','type'=>'date','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Team Strength','name'=>'team_strength','type'=>'number','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Contract Rate','name'=>'contract_rate','step'=>'0.01','type'=>'number','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Replacement Term','name'=>'replacement_term','type'=>'text','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Logo','name'=>'logo_url','type'=>'upload','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Caption','name'=>'caption','type'=>'text','width'=>'col-sm-5'];
            //$this->form[] = ['label'=>'Department','name'=>'department','type'=>'text','width'=>'col-sm-5'];
            //$this->form[] = ['label'=>'Industry','name'=>'industry_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'industries,name'];
            $this->form[] = ['label'=>'Key Technologies','name'=>'key_technologies','type'=>'text','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
            //$this->form[] = ['label'=>'Country','name'=>'country_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'countries,name'];
            //$this->form[] = ['label'=>'State','name'=>'state_id','type'=>'select','width'=>'col-sm-5','datatable'=>'states,name','parent_select'=>'country_id'];
            $this->form[] = ['label'=>'State','name'=>'state_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'states,name','validation'=>'required'];
            $this->form[] = ['label'=>'City','name'=>'city','type'=>'select2','width'=>'col-sm-5','datatable'=>'cities,name','parent_select'=>'state_id','validation'=>'required'];
            //$this->form[] = ['label'=>'City','name'=>'city','type'=>'select2','width'=>'col-sm-5','datatable'=>'cities,name'];
            $this->form[] = ['label'=>'Postal Code','name'=>'zip','type'=>'select2','width'=>'col-sm-5','datatable'=>'postal_codes,name'];
            //$this->form[] = ['label'=>'Notes','name'=>'notes','type'=>'textarea','width'=>'col-sm-5'];
            $this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','width'=>'col-sm-5'];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Web Site','name'=>'web_site','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Founded Date','name'=>'founded_date','type'=>'date','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Team Strength','name'=>'team_strength','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Contract Rate','name'=>'contract_rate','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Logo','name'=>'logo_url','type'=>'upload','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Caption','name'=>'caption','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Primary Contact Name','name'=>'primary_contact_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Primary Contact Email','name'=>'primary_contact_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Primary Contact Phone','name'=>'primary_contact_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Secondary Contact Name','name'=>'secondary_contact_name','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Secondary Contact Email','name'=>'secondary_contact_email','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Secondary Contact Phone','name'=>'secondary_contact_phone','type'=>'text','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','validation'=>'required','width'=>'col-sm-5'];
			//$this->form[] = ['label'=>'Country','name'=>'country_id','type'=>'select2','validation'=>'required','width'=>'col-sm-5','datatable'=>'countries,name'];
			//$this->form[] = ['label'=>'State','name'=>'state_id','type'=>'select2','validation'=>'required','width'=>'col-sm-5','datatable'=>'states,name'];
			//$this->form[] = ['label'=>'City','name'=>'city_id','type'=>'select2','validation'=>'required','width'=>'col-sm-5','datatable'=>'cities,name'];
			//$this->form[] = ['label'=>'Postal Code','name'=>'postal_code_id','type'=>'select2','width'=>'col-sm-5','datatable'=>'postal_codes,name'];
			//$this->form[] = ['label'=>'Status','name'=>'status','type'=>'number','validation'=>'required','width'=>'col-sm-5'];
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
	        // $this->addaction[] = ['label' => 'Offices', 'url' => "/admin/offices?company_id=[id]"];
	        // $this->addaction[] = ['label' => 'Industries', 'url' => "/admin/company_industries?company_id=[id]"];
	        // $this->addaction[] = ['label' => 'Notes', 'url' => "/admin/company_notes?company_id=[id]"];

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
	        $this->script_js = "$(document).ready(function(){
					$('.form-horizontal').submit(function() {
						if( (!$.trim($('#name').val())) && (!$.trim($('#address').val()))) {
							$('#name').val('');
							$('#address').val('');
							$(this).find('#name').css('border','1px solid red').focus();
							$(this).find('#address').css('border','1px solid red');
							return false;
						}
						if(!$.trim($('#name').val())) {
							$('#name').val('');
							$(this).find('#name').css('border','1px solid red').focus();
							$(this).find('#address').css('border','1px solid #d2d6de');
							return false;
						}
						if(!$.trim($('#address').val())) {
							$('#address').val('');
							$(this).find('#address').css('border','1px solid red').focus();
							$(this).find('#name').css('border','1px solid #d2d6de');
							return false;
						}
					});
				})";


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
	      	//   //Your code here

	      	$duplicateCompany = DB::table('companies')->where('name',$postdata['name'])->where('address',$postdata['address'])->first();
	      	
	      	if($duplicateCompany) {
	      		// CRUDBooster::redirect(CRUDBooster::mainpath("add/"),"Check number 1","info")->withInput()->send();
	      		CRUDBooster::back(CRUDBooster::mainpath("add/"),"Company Already Exists..!","warning");
	        	// return back()->with(['message'=>'Already Exists','message_type'=>'warning'])->withInput()->send();
	        }

	      	$postdata['team_strength'] = empty(trim($_REQUEST['team_strength']))? 0 : $postdata['team_strength'];
	    	$postdata['contract_rate'] = empty(trim($_REQUEST['contract_rate']))? 0 : $postdata['contract_rate'];
	    	$postdata['city'] = empty(trim($_REQUEST['city']))? 0 : $postdata['city'] ;
	    	$postdata['state'] = empty(trim($_REQUEST['state']))? 0 : $postdata['state'] ;
	    	$postdata['web_site'] = empty(trim($_REQUEST['web_site']))? null : $postdata['web_site'];
	    	$postdata['replacement_term'] = empty(trim($_REQUEST['replacement_term']))? null : $postdata['replacement_term'];
	    	$postdata['caption'] = empty(trim($_REQUEST['caption']))? null: $postdata['caption'];
	    	$postdata['key_technologies'] = empty(trim($_REQUEST['key_technologies']))? null : $postdata['key_technologies'];
	    	$postdata['status'] = empty(trim($_REQUEST['status']))? null : $postdata['status'];
	    	$postal_code = DB::table('postal_codes')->find($postdata['zip'])->name;
	      	$postdata['zip'] = $postal_code;
	      	$postdata['state'] = $postdata['state_id'];
	      	$postdata['founded_date'] = empty($_REQUEST['founded_date'])? null : $postdata['founded_date'];

	      	$default_office_id = DB::table('offices')->insertGetId([
	         	'name' => $postdata['name'], 
	         	'started_date' => $postdata['founded_date'], 
			    'address' => $postdata['address'], 
			    'country_id' => $postdata['country'], 
			    'state_id' => $postdata['state'], 
			    'city_id' => $postdata['city'], 
			    'postal_code' => $postal_code,
				'is_default' => 1
		   	]);
		   	Session::put('default_office_id',$default_office_id);
	        Session::put('notes',$postdata['notes']);
	        
			unset($postdata['country_id'],$postdata['state_id'],$postdata['notes']);
			
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        // //Your code here
	        $office_id = Session::get('default_office_id');
	        $notes = Session::get('notes');
	        
	        $company = DB::table('companies')->find($id);
	        $office = DB::table('offices')->find($office_id);

	        if($office!= ''){
	        	DB::table('offices')->where('id', $office_id)->update([
	        		'company_id' => $id, 'status'=> 1, 'updated_at'=>new \DateTime()
	        	]);
	        }
	       
	        if($notes!=''){
	        	DB::table('company_notes')->insert(
	         	    [
	         	    'company_id'=> $id , 
	         	    'note'=> $notes,
	         	    'created_on' => now(),
					'created_by' => CRUDBooster::myId()
	         	]);
	        	/*DB::table('office_notes')->insert(
	         	    [
	         	    'office_id'=> $office_id , 
	         	    'note'=> $notes,
	         	]);*/
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
	      	
	      	// $duplicateCompany = DB::table('companies')->where('name',$postdata['name'])->where('web_site',$postdata['web_site'])->where('id','!=',$id)->first();
	      	// if($duplicateCompany) {
	      	$duplicateCompany = DB::table('companies')->where('name',$postdata['name'])->where('address',$postdata['address'])->where('id','!=',$id);
	      	if($duplicateCompany->count()) {
	        	// CRUDBooster::redirect(CRUDBooster::mainpath("edit/$id"),"Company Exists..!","warning");
	        	CRUDBooster::back(CRUDBooster::mainpath("edit/$id"),"Company Already Exists..!","warning");
	        }

	    	$postdata['team_strength'] = empty(trim($_REQUEST['team_strength']))? 0 : $postdata['team_strength'];
	    	$postdata['contract_rate'] = empty(trim($_REQUEST['contract_rate']))? 0 : $postdata['contract_rate'];
	    	$postdata['city'] = empty(trim($_REQUEST['city']))? 0 : $postdata['city'] ;
	    	$postdata['state'] = empty(trim($_REQUEST['state']))? 0 : $postdata['state'] ;
	    	$postdata['web_site'] = empty(trim($_REQUEST['web_site']))? null : $postdata['web_site'];
	    	$postdata['replacement_term'] = empty(trim($_REQUEST['replacement_term']))? null : $postdata['replacement_term'];
	    	$postdata['caption'] = empty(trim($_REQUEST['caption']))? null: $postdata['caption'];
	    	$postdata['key_technologies'] = empty(trim($_REQUEST['key_technologies']))? null : $postdata['key_technologies'];
	    	$postdata['status'] = empty(trim($_REQUEST['status']))? null : $postdata['status'];
	    	$postal_code = DB::table('postal_codes')->find($postdata['zip'])->name;
	      	$postdata['zip'] = $postal_code;
	      	$postdata['state'] = $postdata['state_id'];
	      	$postdata['founded_date'] = empty($_REQUEST['founded_date'])? null : $postdata['founded_date'];

      		if(empty(trim($_REQUEST['name']))){
				return redirect()->back()->withErrors(['name' => ['Please fill the Company Name.']])->withInput()->send();
	      	}
	      	if(empty(trim($_REQUEST['address']))){
	      		return redirect()->back()->withErrors(['address' => ['Please fill the Address.']])->withInput()->send();
	      	}

	      	$default_office_id = DB::table('offices')->where('company_id',$id)->where('is_default',1)->first();
	      	

	      	if($default_office_id!='') {
	      		DB::table('offices')->where('id', $default_office_id->id)->update([
	        		'name' => $postdata['name'], 
	         		'started_date' => $postdata['founded_date'], 
			    	'address' => $postdata['address'], 
			    	'country_id' => $postdata['country'], 
			    	'state_id' => $postdata['state'], 
			    	'city_id' => $postdata['city'], 
			   	 	'postal_code' => $postal_code,
	        		'updated_at'=>new \DateTime()
	        	]);
	      	}
	      	Session::put('default_office_id',$default_office_id->id);
	        Session::put('notes',$postdata['notes']);
	        
			unset($postdata['country_id'],$postdata['state_id'],$postdata['notes']);

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        $office_id = Session::get('default_office_id');
	        $notes = Session::get('notes');

	        $company_notes = DB::table('company_notes')->where('company_id',$id)->get();
	        if($company_notes!=''){
	        	foreach ($company_notes as $company_note) {
	        		if($notes!=''){
	        			if($company_note->note!=$notes){
	        				DB::table('company_notes')->insert(
				         	    [
				         	    'company_id'=> $id , 
				         	    'note'=> $notes,
				         	    'created_on' => now(),
								'created_by' => CRUDBooster::myId()
				         	]);
				        	/*DB::table('office_notes')->insert(
				         	    [
				         	    'office_id'=> $office_id , 
				         	    'note'=> $notes,
				         	]);*/
	        			}
	        		}
	        	}
	        }

	        $eventOwnNameUpdate = app('App\Http\Controllers\CustomController')->updateEventJobCandOwnNames('company',$id);
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



	    //By the way, you can still create your own method in here... :) 
	    public function getDetail($id)	{
			$this->cbLoader();

			// Company Details
			$company = DB::table($this->table)->where($this->primary_key,$id)->first();
			$cities = DB::table('cities')->get();
			$company->city = DB::table("cities")->find($company->city)->name;
			$company->state = DB::table("states")->find($company->state)->name;
			// JobOrders
			$joborders = DB::table('job_orders')
                ->select('companies.name as company','job_orders.*', 'offices.name as office','cms_users.name as recruiter')
                ->join('companies','companies.id','=','job_orders.company_id')
                ->join('offices','offices.id','=','job_orders.office_id')
                ->join('cms_users','cms_users.id','=','job_orders.recruiter')
                ->where('companies.id',$id)
                ->get();
			$company->jo_count = count($joborders); 
			// Company Contacts
            $contacts = DB::table('contacts')->where('company_id',$id)->get();
            $company->contact_count = count($contacts);
            // Company Industry
            $company_industries = DB::table('company_industries')->where('company_id',$id)->get();
            $company->industries_count = count($company_industries); 

            $company_notes = DB::table('company_notes')
            				->select('company_notes.*', 'cms_users.name as created_by' )
            				->join('cms_users','cms_users.id','=','company_notes.created_by')
                			->where('company_notes.company_id',$id)->get();
            $company->note_count = count($company_notes); 
            
            // Offices
            $office_ids = DB::table('offices')->select('offices.id')
                ->where('offices.company_id',$id)->get();
            $office = DB::table('offices')
                ->where('offices.company_id',$id)
                ->first();
            //foreach ($offices as $office) {
            /*$office->mappedIndustries = DB::table('office_industries')
                ->where('office_id', $office->id)
                ->get();*/
            $office->company_departments = DB::table('office_departments')
            	->select('office_departments.*', 'cms_users.name as created_by' )
        		->leftJoin('cms_users','cms_users.id','=','office_departments.created_by')
            	->where('office_id',$office->id)->get();
            //	}
            $company->office_count = count($offices); 
            if($office->company_departments!=''){
            	$company->department_count = count($office->company_departments); 
            }
            else {
            	$company->department_count = 0;
            }
            
            $industries = DB::table('industries')->get();
			
            // Get Log Activities

			/*if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_detail==FALSE) {
				CRUDBooster::insertLog(trans("crudbooster.log_try_view",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			}*/

			$module     = CRUDBooster::getCurrentModule();
			$page_menu  = Route::getCurrentRoute()->getActionName();
			$page_title = trans("crudbooster.detail_data_page_title",['module'=>$module->name,'name'=>$row->{$this->title_field}]);
			$command    = 'detail';

			Session::put('current_row_id',$id);

			$this->cbView('override.companies.detail',compact('row','page_menu','page_title','command','id','company','joborders','contacts', 'office','company_industries','company_notes','industries','cities'));
		}	

		public function getEdit($id){
			$this->cbLoader();
			$row             = DB::table($this->table)->where($this->primary_key,$id)->first();

			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {
				CRUDBooster::insertLog(trans("crudbooster.log_try_edit",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			}


			$page_menu       = Route::getCurrentRoute()->getActionName();
			$page_title 	 = trans("crudbooster.edit_data_page_title",['module'=>CRUDBooster::getCurrentModule()->name,'name'=>$row->{$this->title_field}]);
			$command 		 = 'edit';
			Session::put('current_row_id',$id);
			$row->state_id = $row->state;
			$row->zip = DB::table('postal_codes')->where('name',$row->zip)->first()->id;
			return view('crudbooster::default.form',compact('id','row','page_menu','page_title','command'));

		}

	}