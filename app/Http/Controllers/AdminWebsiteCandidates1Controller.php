<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	
	class AdminWebsiteCandidates1Controller extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_edit = false;
			$this->button_delete = true;
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
            $this->col[] = ["label"=>"Create/Update","name"=>"update_status","callback" => function($row) {
			$existingMail = \DB::table('candidates')->where('primary_email', $row->primary_email)->first();
			$update_status=\DB::table('website_candidates')->where('primary_email', $row->primary_email)->first();
				if($existingMail) {
					if($update_status->update_status=='0'){
					return '<a class="btn btn-xs btn-primary" title="Update" href="/admin/save-candidate-details?id='.$row->id.'" style="width:90px;">Update Details</a>';	
					}
					else{
					return '<label">--</label>';	
					}
					
				}
				else {
					return '<a class="btn btn-xs btn-success check_create_new" title="Create New" href="/admin/save-candidate-details?id='.$row->id.'" style="width:90px;">Create New</a>';
				}
            }];

			$this->col[] = ["label"=>"Add To Joborder","name"=>"update_status","callback" => function($row) {
			
							$name=str_replace(array("'"), "\'",$row->first_name.' '.$row->last_name);
							return view('override.candidates.candidate_addtojoborder')->with('id',$row->id)->with('name',$name);
							//return view('candidate_addtojoborder');
							//return '<a class="btn btn-primary btn-xs application-url"   data-toggle="modal"  id="addMultipleCandidatesToJobOrder" data-target="#addCandidatesToJobOrder">Add To Joborder</a>    
						
						//';	
						
						
					
				}];
			
			# END COLUMNS DO NOT REMOVE THIS LINE
			
			
			$jobOrders=DB::table('job_orders')->get();
			$option = '';
			foreach($jobOrders as $jobOrder) { 
				$companyName = DB::table('companies')->find($jobOrder->company_id)->name;
			
			
				$option .= "<option value = $jobOrder->id > $jobOrder->id-$jobOrder->title($companyName) </option>";
			}
			
			$name=str_replace(array("'"), "\'",$row->first_name.' '.$row->last_name);
			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Birth Date','name'=>'birth_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Religion','name'=>'religion','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Expected Ctc','name'=>'expected_ctc','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Preferred City','name'=>'preferred_city','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'First Job Start Date','name'=>'first_job_start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Highest Qualification','name'=>'highest_qualification','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Head Line','name'=>'head_line','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Experience Years','name'=>'experience_years','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Experience Months','name'=>'experience_months','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Current Ctc','name'=>'current_ctc','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Can Relocate','name'=>'can_relocate','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Current Employer','name'=>'current_employer','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Current Designation','name'=>'current_designation','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Current City','name'=>'current_city','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Address','name'=>'address','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Country Id','name'=>'country_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'country,id'];
			$this->form[] = ['label'=>'State Id','name'=>'state_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'state,id'];
			$this->form[] = ['label'=>'City Id','name'=>'city_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'city,id'];
			$this->form[] = ['label'=>'Postal Code','name'=>'postal_code','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Primary Email','name'=>'primary_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Secondary Email','name'=>'secondary_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Primary Phone','name'=>'primary_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Secondary Phone','name'=>'secondary_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Photo Url','name'=>'photo_url','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Date Available','name'=>'date_available','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Web Site','name'=>'web_site','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Resume','name'=>'resume','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'General Skill','name'=>'general_skill','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Industry Id','name'=>'industry_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry,id'];
			$this->form[] = ['label'=>'Industry Functional Area Id','name'=>'industry_functional_area_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry_functional_area,id'];
			$this->form[] = ['label'=>'Industry Functional Area Role Id','name'=>'industry_functional_area_role_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry_functional_area_role,id'];
			$this->form[] = ['label'=>'Industry Functional Area Skill Id','name'=>'industry_functional_area_skill_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry_functional_area_skill,id'];
			$this->form[] = ['label'=>'Qualification Level Id','name'=>'qualification_level_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualification_level,id'];
			$this->form[] = ['label'=>'Qualification Id','name'=>'qualification_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualification,id'];
			$this->form[] = ['label'=>'Is Completed','name'=>'is_completed','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			$this->form[] = ['label'=>'Completed Year','name'=>'completed_year','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Score','name'=>'score','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Key','name'=>'key','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'First Name','name'=>'first_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Last Name','name'=>'last_name','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Birth Date','name'=>'birth_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Gender','name'=>'gender','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Religion','name'=>'religion','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Expected Ctc','name'=>'expected_ctc','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Preferred City','name'=>'preferred_city','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'First Job Start Date','name'=>'first_job_start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Highest Qualification','name'=>'highest_qualification','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Head Line','name'=>'head_line','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Experience Years','name'=>'experience_years','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Experience Months','name'=>'experience_months','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Current Ctc','name'=>'current_ctc','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Can Relocate','name'=>'can_relocate','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Current Employer','name'=>'current_employer','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Current Designation','name'=>'current_designation','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Current City','name'=>'current_city','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Address','name'=>'address','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Country Id','name'=>'country_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'country,id'];
			//$this->form[] = ['label'=>'State Id','name'=>'state_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'state,id'];
			//$this->form[] = ['label'=>'City Id','name'=>'city_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'city,id'];
			//$this->form[] = ['label'=>'Postal Code','name'=>'postal_code','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Primary Email','name'=>'primary_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Secondary Email','name'=>'secondary_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Primary Phone','name'=>'primary_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Secondary Phone','name'=>'secondary_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Photo Url','name'=>'photo_url','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Date Available','name'=>'date_available','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Web Site','name'=>'web_site','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Resume','name'=>'resume','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'General Skill','name'=>'general_skill','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Industry Id','name'=>'industry_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry,id'];
			//$this->form[] = ['label'=>'Industry Functional Area Id','name'=>'industry_functional_area_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry_functional_area,id'];
			//$this->form[] = ['label'=>'Industry Functional Area Role Id','name'=>'industry_functional_area_role_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry_functional_area_role,id'];
			//$this->form[] = ['label'=>'Industry Functional Area Skill Id','name'=>'industry_functional_area_skill_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industry_functional_area_skill,id'];
			//$this->form[] = ['label'=>'Qualification Level Id','name'=>'qualification_level_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualification_level,id'];
			//$this->form[] = ['label'=>'Qualification Id','name'=>'qualification_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'qualification,id'];
			//$this->form[] = ['label'=>'Is Completed','name'=>'is_completed','type'=>'radio','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'Array'];
			//$this->form[] = ['label'=>'Completed Year','name'=>'completed_year','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Score','name'=>'score','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Key','name'=>'key','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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
	        $this->script_js = " $(document).ready(function() {
	        	$.urlParam = function(name){
	        		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	        		if (results==null) {
	        			return null;
	        		}
	        		return decodeURI(results[1]) || 0;
	        	}
	        	var q=$.urlParam('q');
	        	var all=$.urlParam('all');
	        	var filter= $.urlParam('lasturl');
	        	$('#table_dashboard').find('tbody tr.warning').each(function(){ 
	        		var oldtext=$(this).find('td i.fa fa-search').text();
	        		var newtext = 'No New/Update Candidates & click ALL to view full Candidate list.' ;
	        		if(q||all||filter||q==0)
	        		{
	        			$(this).find('td i.fa fa-search').text(oldtext);

	        		}
	        		else{
	        			$(this).find('td').text(newtext);	
	        		}
	        		});
      
	        	$('#advanced_filter_modal').find('.form-group .row-filter-combo').each(function(){  // To get all <a> tag title
	        		var getTitletxt =  $(this).find('strong').text();
	        		var text='Create/Update';
	        		if(getTitletxt==text)
	        		{	 $(this).find('input[type=text],select,strong').hide();
	        			
	        		}

        });
		$('#table_dashboard #checkind').click(function() {
			if($('#table_dashboard #checkind').is(':checked')) {
			var candidateid=$(this).val();
			
			$('#candidateid').val(candidateid);
			$('#mailToMultipleCandidates').show();
			}
			else{
				$('#mailToMultipleCandidates').hide();
			}
		








		  })

        $('.check_create_new').on('click', function(event) {
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
	        
        	$this->pre_index_html = "<div class='col-sm-6 filter-group-jo all'>
        <form method='get' action=".Request::fullUrl().">
        All <input type = 'checkbox' name ='all' onchange = 'this.form.submit();' ".(($_REQUEST['all']) ? 'checked': '')."  />
        </form>    
        </div> 
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
	        $this->style_css = file_get_contents(public_path() . '/css/modules/' . 'common.css');
        	$this->style_css .= ".box-body.table-responsive.no-padding{padding-bottom: 15px !important;}";
        	$this->style_css .= ".all{width: 80px !important;}";
        	
        	
	        
	        
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
	        if($_REQUEST['all']){
	        $query->where('update_status','0');
	        $query->orwhere('update_status','1');
	        }else{
			$query->where('website_candidates.update_status','0');
	        }
	        $query->select('website_candidates.*'); 
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
         \DB::table('website_applications')->where('web_candidate_id',$id)->delete();
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
		$page_title = "Candidates Details&nbsp;&nbsp;";
		$this->cbView('override.candidates.web_applied_candidates_view',compact('page_title','row','industries','skills','roles','areas'));	
	}

	}