<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;
use Route;

class AdminJobOrdersController extends \crocodicstudio\crudbooster\controllers\CBController {

    public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "title";
		$this->limit = "20";
		$this->orderby = "id,desc";
		$this->global_privilege = false;
		$this->button_table_action = true;
		$this->button_bulk_action = true;
		$this->button_action_style = "button_icon";
		$this->button_add = true;
		$this->button_edit = true;
		$this->button_delete = false;
		$this->button_detail = false;
		$this->button_show = false;
		$this->button_filter = true;
		$this->button_import = false;
		$this->button_export = false;
		$this->table = "job_orders";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];
        $this->col[] = ["label"=>"Id","name"=>"id"];
		
        
		$this->col[] = ["label"=>"Title","name"=>"title","callback" => function($row) {
            $name=\DB::table('job_orders')->where('company_id', $row->id)->first()->name;
            return"<a href='/admin/job_order_applicants?job_order_id=".$row->id."'target='_blank'>".$row->title."</a>";
                  /* if(CRUDBooster::myPrivilegeId()==4){
                    return $name;    
                    }
                    else{
                   return"<a href='/admin/companies/detail/'".$row->company_id."'>".$name."</a>";
                    }*/
            }
    ];
		$this->col[] = ["label"=>"Company","name"=>"company_id","join"=>"companies,name","callback" => function($row) {
            $name=\DB::table('companies')->where('id', $row->company_id)->first()->name;
            return"<a href='/admin/companies/detail/".$row->company_id."'target='_blank'>".$name."</a>";
                  /* if(CRUDBooster::myPrivilegeId()==4){
                    return $name;    
                    }
                    else{
                   return"<a href='/admin/companies/detail/'".$row->company_id."'>".$name."</a>";
                    }*/
            }
    ];
        $this->col[] = ["label"=>"Status","name"=>"status"];
		// $this->col[] = ["label"=>"Openings","name"=>"num_vacancies"];
        // $this->col[] = ["label"=>"Start Date","name"=>"start_date"];
        $this->col[] = ["label"=>"Created","name"=>"created_at", "callback" => function($row) {
                    return date('Y-m-d', strtotime($row->created_at));  
                }
            ];
        $this->col[] = ["label"=>"Recruiter","name"=>"city",'width'=>'8%',"callback" =>
        function($row) {
           return \DB::table('cms_users')->find($row->recruiter)->name;
        }];
        
        $this->col[] = ["label"=>"Is Hot","name"=>"is_hot", "callback"=>function($row) {
                        return $row->is_hot==1?"<span class='btn-xs btn-danger'>Hot</span>":"-";
                        }];
        // $this->col[] = ["label"=>"Submission Date","name"=>"submission_date"];
        // $this->col[] = ["label"=>"Next Step","name"=>"Next Step"];
        $this->col[] = ["label"=>"Type","name"=>"type"];
        $this->col[] = ["label"=>"Age","name"=>"city","callback" =>
        function($row) {
            if($row->created_at) {
                $now = time(); // or your date as well
                $your_date = strtotime($row->created_at);
                $datediff = abs($now - $your_date);
                $numberDays = $datediff/86400;
                $numberDays = intval($numberDays);
                return $numberDays;
            }
        } ];


        $this->col[] = ["label"=>"P","name"=>"city", "callback" =>
            function($row) {
                $jobOrderApplicants = DB::table('job_order_applicants')->where('job_order_id', $row->id)->whereNull('deleted_at')->get();
                return count($jobOrderApplicants);
            }
        ];

        $this->col[] = ["label"=>"S","name"=>"city","callback" =>
        function($row) {
            $jobOrderApplicantIdCollection = DB::table('job_order_applicants')->where('job_order_id',$row->id)->get();
            $jobOrderApplicantId = [];
            foreach ($jobOrderApplicantIdCollection as $jobOrderApplicantIdCollection) {
                $jobOrderApplicantId[] = $jobOrderApplicantIdCollection->id; 
            }
            $jobOrderApplicantCount = DB::table('job_order_applicant_statuses')->whereIn('job_order_applicant_id',$jobOrderApplicantId)->where('prev_secondary_status','Submitted to Client')->get();
            return count($jobOrderApplicantCount);
        }];

        $this->col[] = ["label"=>"Application Url","name"=>"city",'width'=>'2%',"callback" =>
        function($row) {
           return '<div class="col-md-2">
        <a class="btn btn-primary btn-xs application-url" data-id="'.env('APP_URL').'/post-resume?job_order_id='.$row->id.'"data-toggle="modal" data-target="#application-modal"> Public URL</a>    
        </div>';
        }];
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];
		$this->form[] = ['label'=>'Company','name'=>'company_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'companies,name'];
		//$this->form[] = ['label'=>'Office','name'=>'office_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'offices,name','parent_select'=>'company_id'];
		//$this->form[] = ['label'=>'Industry','name'=>'industry','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industries,name'];
        $this->form[] = ['label'=>'Contact','name'=>'contact_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','dataquery'=>'select id as value, first_name as label from contacts']; 
        //'datatable'=>'contact,first_name'],'parent_select'=>'company_id',

		//$this->form[] = ['label'=>'Functional_area','name'=>'industry_functional_area','type'=>'select2','validation'=>'required','width'=>'col-sm-9','datatable'=>'industry_functional_areas,name'];
        //$this->form[] = ['label'=>'Site Id','name'=>'site_id','type'=>'select','validation'=>'required','width'=>'col-sm-10', 'dataenum'=>'1|ATS;0|Other'];

        $this->form[] = ['label'=>'Client Job Id','name'=>'client_job_id','type'=>'text','width'=>'col-sm-10','placeholder'=>'Client Reference Job Id'];

		$this->form[] = ['label'=>'Title','name'=>'title','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'Title of the joborder'];
		$this->form[] = ['label'=>'Description','name'=>'description','type'=>'text','width'=>'col-sm-10'];
        
        $this->form[] = ['label'=>'Notes','name'=>'notes','type'=>'text','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Type','name'=>'type','type'=>'select','validation'=>'required', 'width'=>'col-sm-10', 'dataenum'=>'C|C;H|H'];
        $this->form[] = ['label'=>'Duration','name'=>'duration','type'=>'text','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Rate Max','name'=>'rate_max','type'=>'text','width'=>'col-sm-10'];
        // $this->form[] = ['label'=>'CTC','name'=>'salary','type'=>'money','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required','width'=>'col-sm-10', 'dataenum'=>'Full|Full;OnHold|OnHold;Active|Active;Canceled|Canceled; Closed|Closed'];
        $this->form[] = ['label'=>'Is Hot','name'=>'is_hot','type'=>'select','validation'=>'required','width'=>'col-sm-10', 'dataenum'=>'0|No;1|Yes'];
        $this->form[] = ['label'=>'Openings','name'=>'num_vacancies','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'City','name'=>'city','type'=>'text','validation'=>'required','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'State','name'=>'state','type'=>'text','validation'=>'required','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Start Date','name'=>'start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Public','name'=>'public','type'=>'radio','dataenum'=>'0|No;1|Yes'];
		
        //$this->form[] = ['label'=>'Company Department','name'=>'company_department_id','type'=>'select','width'=>'col-sm-10','dataquery'=>'select company_department_id as value, name as label from company_department' ]; 
        //'datatable'=>'company_department,name', 'parent_select'=>'company_id',
        $this->form[] = ['label'=>'Is Admin Hidden','name'=>'is_admin_hidden','type'=>'radio','dataenum'=>'0|No;1|Yes'];
        $this->form[] = ['label'=>'Openings Available','name'=>'openings_available','type'=>'number','width'=>'col-sm-10'];
        // $this->form[] = ['label'=>'Candidate Mapping','name'=>'candidate_mapping','type'=>'text','width'=>'col-sm-10']; 
        // $this->form[] = ['label'=>'Experience','name'=>'Exp','type'=>'text','width'=>'col-sm-10'];
        // $this->form[] = ['label'=>'Submission Date','name'=>'Submission Date','type'=>'text','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Next Step','name'=>'Next Step','type'=>'text','width'=>'col-sm-10'];
        $this->form[] = ['label'=>'Owner','name'=>'owner','type'=>'select2','datatable'=>'cms_users,name'];
        $this->form[] = ['label'=>'Recruiter','name'=>'recruiter','type'=>'select2','datatable'=>'cms_users,name'];
        /*
        
		
		$this->form[] = ['label'=>'Expiry Date','name'=>'expiry_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Min Exp Years','name'=>'min_exp_years','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Max Exp Years','name'=>'max_exp_years','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Min Exp Months','name'=>'min_exp_months','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Max Exp Months','name'=>'max_exp_months','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Min Ctc','name'=>'min_ctc','type'=>'money','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		
		$this->form[] = ['label'=>'Reference Id','name'=>'reference_id','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		
        //$this->form[] = ['label'=>'Recruiter','name'=>'recruiter','type'=>'select2','datatable'=>'cms_users,name','relationship_table'=>'job_order_assignees'];
        */
		# END FORM DO NOT REMOVE THIS LINE

		# OLD START FORM
		//$this->form = [];
		//$this->form[] = ['label'=>'Company','name'=>'company_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'companies,name'];
		//$this->form[] = ['label'=>'Office','name'=>'office_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'offices,name','parent_select'=>'company_id'];
		//$this->form[] = ['label'=>'Industry','name'=>'industry','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'industries,name'];
		//$this->form[] = ['label'=>'Title','name'=>'title','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Description','name'=>'description','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Num Vacancies','name'=>'num_vacancies','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Start Date','name'=>'start_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Expiry Date','name'=>'expiry_date','type'=>'date','validation'=>'required|date','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Min Exp Years','name'=>'min_exp_years','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Max Exp Years','name'=>'max_exp_years','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Min Exp Months','name'=>'min_exp_months','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Max Exp Months','name'=>'max_exp_months','type'=>'number','validation'=>'required|min:0|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Min Ctc','name'=>'min_ctc','type'=>'money','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		//$this->form[] = ['label'=>'Max Ctc','name'=>'max_ctc','type'=>'money','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		//// $this->form[] = ['label'=>'Status','name'=>'status','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','dataenum'=>'New;Intro Call Scheduled;Hiring In Progress;On Hold;Cancelled;Completed'];
		//$this->form[] = ['label'=>'Reference Id','name'=>'reference_id','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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
        $this->addaction[] = ['label' => 'Process', 'url' => '/admin/job_order_applicants?job_order_id=[id]', 'color' => 'success'];
        /*$this->addaction[] = ['label' => 'General Skills', 'url' => '/admin/job_order_general_skills?job_order_id=[id]', 'color' => 'group-in-menu'];
        $this->addaction[] = ['label' => 'Functional Area Skills', 'url' => '/admin/job_order_industry_functional_area_skills?job_order_id=[id]', 'color' => 'group-in-menu'];
        $this->addaction[] = ['label' => 'Preferences', 'url' => '/admin/job_order_preferences?job_order_id=[id]', 'color' => 'group-in-menu'];
        $this->addaction[] = ['label' => 'Notes', 'url' => '/admin/job_order_notes?job_order_id=[id]', 'color' => 'group-in-menu'];
*/

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
        // $this->index_button[] = ['label'=>'Advanced Print','url'=>CRUDBooster::mainpath("print"),"icon"=>"fa fa-print"];


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
        $this->script_js = implode("\n", [
            file_get_contents(public_path() . '/js/modules/' . 'common.js'),
            file_get_contents(public_path() . '/js/modules/' . 'jo.js')
        ]);
        /*$this->script_js = " $(document).ready(function() {
                    $('a.application-url').on('click', function(){  // To get all <a> tag title
                        console.log('clickkk');
                     $('#application-modal').find('.p-application-url').text($(this).data('id'));  

            });
            $('#advanced_filter_modal').find('.form-group .row-filter-combo').each(function(){  // To get all <a> tag title
                        var getTitletxt =  $(this).find('strong').text();
                        var text='Application Url';
                        if(getTitletxt==text)
                        {    $(this).find('input[type=text],select,strong').hide();
                            
                        }

            });
         });";*/

        /*
        | ---------------------------------------------------------------------- 
        | Include HTML Code before index table 
        | ---------------------------------------------------------------------- 
        | html code to display it before index table
        | $this->pre_index_html = "<p>test</p>";
        |
        */
        $recruiters = DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        $option = '';
        
        foreach($recruiters as $recruiter) { 
            $option .= "<option ".(($_REQUEST['recruiter'] == $recruiter->id) ? 'selected': '')." value = $recruiter->id > $recruiter->name </option>";
        }
        $this->pre_index_html = null;
       
        $this->pre_index_html = "

        <div class='col-md-1  col-sm-12 assign-btn-container'>
        ".((CRUDBooster::myPrivilegeId()==4) ? ' ': '  <button class="btn btn-primary btn-xs btn-assign-recruiter" data-toggle="modal" data-target="#recruiter-assign-modal"> Assign Recruiter </button>')."      
        </div>
        <div class='col-md-8 col-sm-12 filter-group-jo'>
        
            <form method='get' action=".Request::fullUrl().">
            <div class='row'>
            <div class='col-md-2'>
            <div class='modal-body' id='recruiterId'>                   
            <select class = 'recruiter-jo form-control select2  form-control' id='recruiter' name='recruiter'  onchange = 'this.form.submit();'>
                <option value=''>Recruiter</option>
                $option
            </select>
          </div>
        </div>
        
                <div class='col-md-2'>
                    <select class='status-filter-jo form-control' name='status-filter' onchange = 'this.form.submit();'>
                        <option value = ''> Status </option>
                        <option ".(($_REQUEST['status-filter'] == 'New') ? 'selected': '')." value = 'New'> New </option>
                         <option ".(($_REQUEST['status-filter'] == 'Intro Call Scheduled') ? 'selected': '')." value = 'Intro Call Scheduled'> Intro Call Scheduled </option>
                        <option ".(($_REQUEST['status-filter'] == 'Hiring In Progress') ? 'selected': '')." value = 'Hiring In Progress'> Hiring In Progress </option>
                        <option ".(($_REQUEST['status-filter'] == 'On Hold') ? 'selected': '')." value = 'On Hold'> On Hold </option>
                        <option ".(($_REQUEST['status-filter'] == 'Cancelled') ? 'selected': '')." value = 'Cancelled'> Cancelled </option>
                        <option ".(($_REQUEST['status-filter'] == 'Completed') ? 'selected': '')." value = 'Completed'> Completed </option>
                    </select>
                </div>

        <div class='col-md-2' style='margin-left: 27px;
        inline-size: auto;'>

                My Orders   <span class=''> <input type = 'checkbox' name ='myOrders' onchange = 'this.form.submit();'".(($_REQUEST['myOrders']) ? 'checked': '')."/>
              </span>
              </div>
              <div class='col-md-2' style='
              inline-size: auto;'>

                Hot Orders <input type = 'checkbox' name ='hot_orders' onchange = 'this.form.submit();' ".(($_REQUEST['hot_orders']) ? 'checked': '')." />
                
                </div>
                
                </div>
               
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

        /*$recruiters = DB::table('cms_users')->where('id_cms_privileges',4)->get();*/
        $recruiters = DB::table('cms_users')->where('status',USER_ACTIVE)->get();
        $option = '';
        
        foreach($recruiters as $recruiter) { 
            $option .= "<option value = $recruiter->id > $recruiter->name </option>";
        }

        // dd($option);
        $this->post_index_html = null;
        $this->post_index_html = "<div class='col-md-12 col-sm-12 pull-right letter-filter-jo'>
            <form method='get' action='/admin/job_orders'>
                <a href = '/admin/job_orders?letter=a'> A </a>
                <a href = '/admin/job_orders?letter=b'> B </a>
                <a href = '/admin/job_orders?letter=c'> C </a>
                <a href = '/admin/job_orders?letter=d'> D </a>
                <a href = '/admin/job_orders?letter=e'> E </a>
                <a href = '/admin/job_orders?letter=f'> F </a>
                <a href = '/admin/job_orders?letter=g'> G </a>
                <a href = '/admin/job_orders?letter=h'> H </a>
                <a href = '/admin/job_orders?letter=i'> I </a>
                <a href = '/admin/job_orders?letter=j'> J </a>
                <a href = '/admin/job_orders?letter=k'> K </a>
                <a href = '/admin/job_orders?letter=l'> L </a>
                <a href = '/admin/job_orders?letter=m'> M </a>
                <a href = '/admin/job_orders?letter=n'> N </a>
                <a href = '/admin/job_orders?letter=o'> O </a>
                <a href = '/admin/job_orders?letter=p'> P </a>
                <a href = '/admin/job_orders?letter=q'> Q </a>
                <a href = '/admin/job_orders?letter=r'> R </a>
                <a href = '/admin/job_orders?letter=s'> S </a>
                <a href = '/admin/job_orders?letter=t'> T </a>
                <a href = '/admin/job_orders?letter=u'> U </a>
                <a href = '/admin/job_orders?letter=v'> V </a>
                <a href = '/admin/job_orders?letter=w'> W </a>
                <a href = '/admin/job_orders?letter=x'> X </a>
                <a href = '/admin/job_orders?letter=y'> Y </a>
                <a href = '/admin/job_orders?letter=z'> Z </a>
            </form>
        </div>
        <div class='modal fade' role='dialog' id='recruiter-assign-modal'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title'>Assign Recruiter</h4>
                    </div>
                    <div class='message-container'></div>
                    <div class='modal-body' id='recruiterId'>                   
                        <select class = 'form-control select2'>
                            <option value=''>Select Any Recruiter</option>
                            $option
                        </select>
                    </div>
                    <div class='clearfix'></div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-success btn-assign'>Assign</button>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Modal -->
<div id='application-modal' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>Public Url</h4>
      </div>
      <div class='modal-body'>
        <p class='p-application-url'>Some text in the modal.</p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>";
        
        
        
        /*
        | ---------------------------------------------------------------------- 
        | Include Javascript File 
        | ---------------------------------------------------------------------- 
        | URL of your javascript each array 
        | $this->load_js[] = asset("myfile.js");
        |
        */
        $this->load_js = array();
        $this->load_js[] = 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js';
        
        
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
        $this->style_css .= ".box-body.table-responsive.no-padding{padding-bottom: 15px !important;}
        ";
        $this->style_css .= ".filter-group-jo .status-filter-jo{width: 99px !important;margin-left: -13px !important; margin-top:-6px; height:30px}
        ";
        $this->style_css .= ".filter-group-jo .recruiter-jo{ margin-top: -22px !important ;width: 103px !important;margin-left: -78px !important; height:30px;}
        ";
        $this->style_css .= "#recruiter-assign-modal .modal-body .select2-container{width: 80% !important; height:34px;}";
        
        
        
        /*
        | ---------------------------------------------------------------------- 
        | Include css File 
        | ---------------------------------------------------------------------- 
        | URL of your css each array 
        | $this->load_css[] = asset("myfile.css");
        |
        */
        $this->load_css = array();
        $this->load_css[] = "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css";
        
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
        // dd($query);
       /* if(CRUDBooster::myPrivilegeName() === 'Recruiter') {
        	// $jobOrders = DB::table('job_orders')->where('recruiter', CRUDBooster::myId())->get();
        	// $joIDs = [];
        	// foreach ($jobOrders as $jobOrder) {
        	// 	$joIDs[] = $jobOrder->joborder_id;
        	// }
        	$query->where('recruiter',CRUDBooster::myId());
		}*/
        // elseif(CRUDBooster::myPrivilegeName()==='Manager'){
        // $query->where('owner',CRUDBooster::myId());    
        // }
        
        /*if($_REQUEST['myOrders']) {
           if(CRUDBooster::myPrivilegeName()==='Manager'){
        $query->where('owner',CRUDBooster::myId());    
        }
        if(CRUDBooster::myPrivilegeName() === 'Recruiter') {
        $query->where('recruiter',CRUDBooster::myId());   
        }
        else{
            $query->where('creator_id', CRUDBooster::myId());
         }
        }*/
          if($_REQUEST['myOrders']) {
            //dd(CRUDBooster::myId());
            $query->where('job_orders.owner',CRUDBooster::myId());
        }
        if($_REQUEST['hot_orders']) {
            $query->where('is_hot',1);
        }
        if($_REQUEST['letter']) {
            $query->where('title','Like',$_REQUEST['letter']."%");
        }
        if($_REQUEST['status-filter']) {
            //return 1;
            $query->where('job_orders.status',$_REQUEST['status-filter']);
        }
        if($_REQUEST['recruiter']) {
            //return 1;
            $query->where('recruiter',$_REQUEST['recruiter']);
        }
        $query->select('job_orders.*');
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
        /*$postdata['industry'] = DB::table('industries')->find($postdata['industry'])->name;
        $postdata['industry_functional_area'] = DB::table('industry_functional_areas')->find($postdata['industry_functional_area'])->name;
        $postdata['creator_id'] = CRUDBooster::myId();
        $postdata['status'] = 'New';*/
        
        $postdata['office_id'] = DB::table('offices')->where('company_id',$postdata['company_id'])->first()->id;
        $postdata['functional_area_role_id'] = $_REQUEST['functional_area_role'];

        $postdata['status'] = 'New';
        Session::put('general_skill',$_REQUEST['general_skill']);

        Session::put('functional_area',$_REQUEST['functional_area']);

        Session::put('functional_area_skill',$_REQUEST['functional_area_skill']);

        // $postdata['entered_by'] = CRUDBooster::myId();
        $postdata['industry'] = $_REQUEST['industry'];
        $postdata['creator_id'] = CRUDBooster::myId();
        $postdata['updated_at'] = now();
        $postdata['expiry_date'] = $_REQUEST['expiry_date'];
        $postdata['min_exp_years'] = $_REQUEST['min_exp_years'];
        $postdata['min_exp_months'] = $_REQUEST['min_exp_months'];
        $postdata['max_exp_years'] = $_REQUEST['max_exp_years'];
        $postdata['max_exp_months'] = $_REQUEST['max_exp_months'];
        $postdata['min_ctc'] = $_REQUEST['min_ctc'];
        $postdata['max_ctc'] = $_REQUEST['max_ctc'];

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
        $this->addToPivotTable($id);
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
        $created_at=DB::table('job_orders')->where('id',$id)->first()->created_at;
        $postdata['created_at']=$created_at;
        $postdata['office_id'] = DB::table('offices')->where('company_id',$postdata['company_id'])->first()->id;
        $postdata['functional_area_role_id'] = $_REQUEST['functional_area_role'];

        Session::put('general_skill',$_REQUEST['general_skill']);

        Session::put('functional_area',$_REQUEST['functional_area']);

        Session::put('functional_area_skill',$_REQUEST['functional_area_skill']);

        // $postdata['entered_by'] = CRUDBooster::myId();
        $postdata['is_hot'] = (( $postdata['is_hot'] == 1 ) ? 1 : 0);
        $postdata['public'] = (( $postdata['public'] == 1 ) ? 1 : 0);
        $postdata['openings_available']=$postdata['num_vacancies'];
        $postdata['rate_max'] = (( $postdata['rate_max']) ? $postdata['rate_max'] : ' ');
        $postdata['duration'] = (( $postdata['duration']) ? $postdata['duration'] : ' ');  
        $postdata['client_job_id'] =(( $postdata['client_job_id']) ? $postdata['client_job_id'] : ' ');
        $postdata['industry'] = $_REQUEST['industry'];
        $postdata['creator_id'] = CRUDBooster::myId();
        $postdata['updated_at'] = now();
        $postdata['expiry_date'] = $_REQUEST['expiry_date'];
        $postdata['min_exp_years'] = $_REQUEST['min_exp_years'];
        $postdata['min_exp_months'] = $_REQUEST['min_exp_months'];
        $postdata['max_exp_years'] = $_REQUEST['max_exp_years'];
        $postdata['max_exp_months'] = $_REQUEST['max_exp_months'];
        $postdata['min_ctc'] = $_REQUEST['min_ctc'];
        $postdata['max_ctc'] = $_REQUEST['max_ctc'];
        //dump($_REQUEST['description']);
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
        DB::table('job_order_general_skills')->where('job_order_id',$id)->delete();
        DB::table('job_order_industry_functional_areas')->where('job_order_id',$id)->delete();
        DB::table('job_order_industry_functional_area_skills')->where('job_order_id',$id)->delete();

        $eventJobNameUpdate = app('App\Http\Controllers\CustomController')->updateEventJobCandOwnNames('job_order',$id);
        
        $this->addToPivotTable($id);
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
    //Override getEdit for job order industry, functional area.
 //    public function getEdit($id){
	// 	$this->cbLoader();
	// 	$row = DB::table($this->table)->where('id',$id)->first();
	// 	//$industry = DB::table('industries')->where('name',$row->industry)->first();
	// 	//$industry_functional_area = DB::table('industry_functional_areas')->where('name',$row->industry_functional_area)->first();
	// 	//$row->industry = $industry->id;
	// 	//$row->industry_functional_area = $industry_functional_area->id;
	// 	Session::put('current_row_id',$id);
 //        $row->id = $row->id;
	// 	return view('crudbooster::default.form',compact('id','row','page_menu','page_title','command'));
	// }

	/*//Override getDetail for job order industry, functional area.
	public function getDetail($id)	{
		$this->cbLoader();
		$row = DB::table($this->table)->where($this->primary_key,$id)->first();

        $industry = DB::table('industries')->where('name',$row->industry)->first();
		$industry_functional_area = DB::table('industry_functional_areas')->where('name',$row->industry_functional_area)->first();
		$row->industry = $industry->id;
		$row->industry_functional_area = $industry_functional_area->id;
		if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_detail==FALSE) {
			CRUDBooster::insertLog(trans("crudbooster.log_try_view",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
			CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
		}

		$module     = CRUDBooster::getCurrentModule();

		$page_menu  = Route::getCurrentRoute()->getActionName();
		$page_title = trans("crudbooster.detail_data_page_title",['module'=>$module->name,'name'=>$row->{$this->title_field}]);
		$command    = 'detail';

		Session::put('current_row_id',$id);

		return view('crudbooster::default.form',compact('row','page_menu','page_title','command','id'));
	}
*/
    public function getAdd() {
        //Create an Auth
        if(!CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {    
            CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
        }

        $companies = DB::table('companies')->orderBy('name','asc')->get();
        
        $industries = DB::table('industries')->orderBy('name','asc')->get();
        
        $functionalAreas = DB::table('industry_functional_areas')->orderBy('name','asc')->get();

        $generalSkills = DB::table('general_skills')->orderBy('name','asc')->get();
        // $privilege=CRUDBooster::myPrivilegeId();
        // if($privilege==3)
        // {
        //   $users = DB::table('cms_users')->where('id',CRUDBooster::myId())->
        //   where('id_cms_privileges',3)->where('status',USER_ACTIVE)->orderBy('name','asc')->get(); 
        //   $recruiters = DB::table('cms_users')->where('id_cms_privileges',4)
        //   ->orderBy('name','asc')->get();   
        // }
        // elseif($privilege==4)
        // {
        //   $users = DB::table('cms_users')->where('id',CRUDBooster::myId())->
        //   where('id_cms_privileges',4)->where('status',USER_ACTIVE)->orderBy('name','asc')->get();
        //   $owners = DB::table('cms_users')->orderBy('name','asc')->get();   
        // }
        // else
        // {
            $users = DB::table('cms_users')->where('status',USER_ACTIVE)->orderBy('name','asc')->get();   
        // }
       

        $indianStates = DB::table('states')->orderBy('name','asc')->where('country_id',1)->get();

        $page_title = 'Add Job Order';
        $data = [];
        $data['page_title'] = 'Add Data';

        if($_REQUEST['current_action'] == 'list_contacts') {
            $contacts = DB::table('contacts')
            ->where('company_id', $_REQUEST['company_id'])
            ->orderby('first_name','asc')
            ->get();
            return $contacts;
        }

        if($_REQUEST['current_action'] == 'list_functional_roles_skills') {
            
            $functional_area['roles'] = DB::table('industry_functional_area_roles')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            $functional_area['skills'] = DB::table('industry_functional_area_skills')
            ->whereIn('industry_functional_area_id',$_REQUEST['functional_area_id'])
            ->get();

            return $functional_area;

        }

        if($_REQUEST['current_action']== 'list_cities') {
            $cities = DB::table('cities')
            ->where('state_id', $_REQUEST['state_id'])
            ->orderby('name','desc')
            ->get();
            return $cities;
        }        
        //Please use cbView method instead view method from laravel
        $this->cbView('override.job_orders.add',compact('data','companies','industries','functionalAreas','generalSkills','users','indianStates','page_title'));
    }


    public function getEdit($id) {

        $this->cbLoader();
        $page_title = 'Edit Job Order';
        $jobOrder = DB::table($this->table)->where($this->primary_key,$id)->first();
        $companies = DB::table('companies')->orderBy('name','asc')->get();        
        $industries = DB::table('industries')->orderBy('name','asc')->get();        
        $functionalAreas = DB::table('industry_functional_areas')->orderBy('name','asc')->get();
        $generalSkills = DB::table('general_skills')->orderBy('name','asc')->get();
        $privilege=CRUDBooster::myPrivilegeId();
        // if($privilege==3)
        // {
        //   $users = DB::table('cms_users')->where('id',CRUDBooster::myId())->
        //   where('id_cms_privileges',3)->where('status',USER_ACTIVE)->orderBy('name','asc')->get();
        //   $recruiters = DB::table('cms_users')->where('id_cms_privileges',4)
        //   ->orderBy('name','asc')->get();    
        // }
        // elseif($privilege==4)
        // {
        //   $users = DB::table('cms_users')->where('id',CRUDBooster::myId())->
        //   where('id_cms_privileges',4)->where('status',USER_ACTIVE)->orderBy('name','asc')->get(); 
        //   $owners = DB::table('cms_users')->orderBy('name','asc')->get();  
        // }
        // else
        // {
            $users = DB::table('cms_users')->where('status',USER_ACTIVE)->orderBy('name','asc')->get();   
        // }
        $indianStates = DB::table('states')->orderBy('name','asc')->where('country_id',1)->get();        
        $cities = DB::table('cities')->orderBy('name','asc')->where('state_id',$jobOrder->state)->get();
        $contacts = DB::table('contacts')
            ->where('company_id',$jobOrder->company_id)
            ->orderby('first_name','asc')
            ->get();
        
        $jobOrderGeneralSkills = DB::table('job_order_general_skills')->where('job_order_id',$jobOrder->id)->get();
        $jobOrder->generalSkillIds = [];        
        foreach ($jobOrderGeneralSkills as $generalSkill) {
            $jobOrder->generalSkillIds[] = $generalSkill->general_skill;
        }


        $jobOrderFunctionalAreas = DB::table('job_order_industry_functional_areas')->where('job_order_id',$jobOrder->id)->get();        
        $functionalAreaIds = [];
        foreach ($jobOrderFunctionalAreas as $jobOrderFunctionalAreas) {
            $functionalAreaIds[] = $jobOrderFunctionalAreas->industry_functional_area;
        }
        $jobOrder->functionalAreaIds = $functionalAreaIds;


        $jobOrderFunctionalAreaSkills = DB::table('job_order_industry_functional_area_skills')->where('job_order_id',$jobOrder->id)->get();        
        
        $jobOrder->functionalAreaSkillIds = [];
        foreach ($jobOrderFunctionalAreaSkills as $jobOrderFunctionalAreaSkill) {
            $jobOrder->functionalAreaSkillIds[] = $jobOrderFunctionalAreaSkill->industry_functional_area_skill;
        }

        
        $functionalAreaSkills = DB::table('industry_functional_area_skills')->whereIn('industry_functional_area_id',$functionalAreaIds)->get();
        
        $functionalAreaRoles = DB::table('industry_functional_area_roles')->whereIn('industry_functional_area_id',$functionalAreaIds)->get();

        $this->cbView('override.job_orders.edit',compact('jobOrder','data','companies','industries','functionalAreas','generalSkills','users','indianStates','cities','contacts','industry_functional_area','functionalAreaSkills','functionalAreaRoles','page_title'));
    }
    
    public function addToPivotTable($id) {
        foreach (Session::get('general_skill') as $general_skill) {
            DB::table('job_order_general_skills')->insert([
                'job_order_id' => $id,
                'general_skill' => $general_skill,
            ]);
        }

        foreach (Session::get('functional_area') as $functional_area) {
            DB::table('job_order_industry_functional_areas')->insert([
                'job_order_id' => $id,
                'industry_functional_area' => $functional_area,
            ]);
        }

        foreach (Session::get('functional_area_skill') as $functional_area_skill) {
            DB::table('job_order_industry_functional_area_skills')->insert([
                'job_order_id' => $id,
                'industry_functional_area_skill' => $functional_area_skill,
            ]);
        }
        Session::forget('general_skill');
        Session::forget('functional_area');
        Session::forget('functional_area_skill');
    }
}