<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Route;
	
	class AdminCompanyContactsController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "contacts";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"First Name","name"=>"first_name"];
			$this->col[] = ["label"=>"Last Name","name"=>"last_name"];
			$this->col[] = ["label"=>"Email","name"=>"email1"];
			$this->col[] = ["label"=>"Phone","name"=>"phone_work"];
			$this->col[] = ["label"=>"Cell","name"=>"phone_cell"];
			//$this->col[] = ["label"=>"Type","name"=>"type"];
			$this->col[] = ["label"=>"Company Name","name"=>"company_name"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Company','name'=>'company_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-7','datatable'=>'companies,name'];
			//$this->form[] = ['label'=>'Office','name'=>'office_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-7','datatable'=>'offices,name','parent_select'=>'company_id'];
			$this->form[] = ['label'=>'Department','name'=>'office_department_id','type'=>'select','width'=>'col-sm-7','datatable'=>'office_departments,name','parent_select'=>'company_id'];
			$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|string|min:1|max:70','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Title','name'=>'title','type'=>'text','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Email 1','name'=>'email1','type'=>'email','validation'=>'required|max:255|email|unique:contacts','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Email 2','name'=>'email2','type'=>'email','validation'=>'max:255|email|unique:contacts','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Phone Work','name'=>'phone_work','type'=>'number','width'=>'col-sm-7','validation'=>'required'];
			$this->form[] = ['label'=>'Phone Cell','name'=>'phone_cell','type'=>'text','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Phone Other','name'=>'phone_other','type'=>'text','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'text','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'City','name'=>'city','type'=>'select2','width'=>'col-sm-7','datatable'=>'cities,name'];
			$this->form[] = ['label'=>'Notes','name'=>'notes','type'=>'textarea','width'=>'col-sm-7'];
			$this->form[] = ['label'=>'Type','name'=>'type','type'=>'select','width'=>'col-sm-7','dataenum'=>'Primary;Secondary;Other'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','width'=>'col-sm-7','dataenum'=>'1|Active;0|Inactive'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Company','name'=>'company_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-7','datatable'=>'companies,name', 'value'=> old('company_id')];
			//$this->form[] = ['label'=>'Office','name'=>'office_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-7','datatable'=>'offices,name','parent_select'=>'company_id', 'value'=> old('office_id')];
			//$this->form[] = ['label'=>'Name','name'=>'name','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-7','value'=> old('name')];
			//$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:contacts','width'=>'col-sm-7','value'=> old('email')];
			//$this->form[] = ['label'=>'Phone','name'=>'phone','type'=>'text','validation'=>'required','width'=>'col-sm-7', 'value'=> old('phone')];
			//$this->form[] = ['label'=>'Type','name'=>'type','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-7','dataenum'=>'Primary;Secondary;Other', 'value'=> old('type')];
			//$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-7','placeholder'=>'You can only enter the number only', 'value'=> old('status')];
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
	        $this->script_js = "
		        $(document).ready(function(){
					$('.form-horizontal').submit(function(e) {
							$(this).find('.validate-error').removeClass('validate-error');
						if(!$.trim($('#first_name').val())) {
							$(this).find('#first_name').addClass('validate-error').focus();
							return false;
						}
						if(!$.trim($('#last_name').val())) {
							$(this).find('#last_name').addClass('validate-error').focus();
							return false;
						}
						if(!$.trim($('#phone_work').val())) {
							$(this).find('#phone_work').addClass('validate-error').focus();
							return false;
						}
					})
				});
			";


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
	        $this->style_css = ".validate-error{
    			border: 1px solid rgba(255, 0, 0, 0.97) !important;
			}";
	        
	        
	        
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
	        $company_name = DB::table('companies')->find($postdata['company_id'])->name;
	        $postdata['company_name'] = $company_name;
	        //$office_name = DB::table('offices')->find($postdata['company_id'])->name;
	        //$postdata['office_id'] = $postdata['company_id'];
	        //get office id from office_department_id
	        $office_id =  DB::table('office_departments')->find($postdata['office_department_id'])->office_id;
	        $postdata['office_id'] = $office_id;
	        $office_name = DB::table('offices')->find($office_id)->name;
	        $postdata['office_name'] = $office_name;
	        $postdata['entered_by'] = CRUDBooster::myId();
	        $postdata['date_created'] = now();
	        $contacts = DB::table('contacts')->where(
	        	[
				    ['company_id','=',$postdata['company_id']],
				    ['office_id','=',$postdata['office_id']],
				    ['email1','=',$postdata['email1']],
				    ['phone_work','=',$postdata['phone_work']],
				    ['first_name','=',$postdata['first_name']],
				    ['last_name','=',$postdata['last_name']],
				])->get();
	        if(count($contacts)>0) {
	        	CRUDBooster::redirect(CRUDBooster::mainpath("add/"), "The contact details already exists for the company","warning");
	        }
	        /*else {
	        	if($postdata['type'] === 'Primary' || $postdata['type'] ==='Secondary'){
	        		$contacts = DB::table('contacts')->where(
			        	[
						    ['company_id','=',$postdata['company_id']],
						    ['office_id','=',$postdata['office_id']],
						    ['type','=',$postdata['type']],
						])->get();
			        if(count($contacts)>0) {
			        	CRUDBooster::redirect(CRUDBooster::mainpath("add/"), "The ".$postdata['type']." details already exists,please choose a different contact type","warning");
			        }
	        	}
	        	
	        }*/
	   
	        			
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        
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
	        $company_name = DB::table('companies')->find($postdata['company_id'])->name;
	        $postdata['company_name'] = $company_name;
	        $office_id =  DB::table('office_departments')->find($postdata['office_department_id'])->office_id;
	        $postdata['office_id'] = $office_id;
	        $office_name = DB::table('offices')->find($office_id)->name;
	        $postdata['office_name'] = $office_name;
	        $postdata['date_modified'] = now();

			$postdata['office_department_id'] = (trim($postdata['office_department_id'])) ? $postdata['office_department_id'] : null; 
			$postdata['title'] = (trim($postdata['title'])) ? $postdata['title'] : null; 
			$postdata['email2'] = (trim($postdata['email2'])) ? $postdata['email2'] : null; 
			$postdata['phone_cell'] = (trim($postdata['phone_cell'])) ? $postdata['phone_cell'] : null; 
			$postdata['phone_other'] = (trim($postdata['phone_other'])) ? $postdata['phone_other'] : null; 
			$postdata['address'] = (trim($postdata['address'])) ? $postdata['address'] : null; 
			$postdata['city'] = (trim($postdata['city'])) ? $postdata['city'] : null; 
			$postdata['notes'] = (trim($postdata['notes'])) ? $postdata['notes'] : null; 
			$postdata['type'] = (trim($postdata['type'])) ? $postdata['type'] : null; 
			$postdata['status'] = (trim($postdata['status'])) ? $postdata['status'] : null; 
	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	     
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
			// Get Log Activities
			$contact = DB::table($this->table)->where($this->primary_key,$id)->first();
			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_detail==FALSE) {
				CRUDBooster::insertLog(trans("crudbooster.log_try_view",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			}

			$module     = CRUDBooster::getCurrentModule();
			$page_menu  = Route::getCurrentRoute()->getActionName();
			$page_title = trans("crudbooster.detail_data_page_title",['module'=>$module->name,'name'=>$row->{$this->title_field}]);
			$command    = 'detail';
			$city = DB::table("cities")->find($contact->city)->name;
			$department = DB::table("office_departments")->find($contact->office_department_id)->name;
			$this->cbView('override.companies.contact_detail',compact('contact','page_menu','page_title','command','city','department'));
		}	
	    
	}