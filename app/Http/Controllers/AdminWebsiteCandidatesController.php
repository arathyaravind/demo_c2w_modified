<?php namespace App\Http\Controllers;
use Session;
use Request;
use DB;
use CRUDBooster;
class AdminWebsiteCandidatesController extends \crocodicstudio\crudbooster\controllers\CBController {

    public function cbInit() {

		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "web_candidate_id";
		$this->limit = "20";
		$this->orderby = "id,desc";
		$this->global_privilege = false;
		$this->button_table_action = true;
		$this->button_bulk_action = false;
		$this->button_action_style = "button_icon";
		$this->button_add = false;
		$this->button_edit = false;
		$this->button_delete = false;
        
		$this->button_detail = false;
		$this->button_show = false;
		$this->button_filter = true;
		$this->button_import = false;
		$this->button_export = false;
		$this->table = "website_applications";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];
		$this->col[] = ["label"=>"Job Order Id","name"=>"job_order_id","join"=>"job_orders,id"];
		$this->col[] = ["label"=>"Title","name"=>"title","callback" => function($row) {
            return"<a href='/admin/job_order_applicants?job_order_id=".$row->job_order_id."'>".$row->title."</a>"; 
            }];
        $this->col[] = ["label"=>"Client","name"=>"client"];
        $this->col[] = ["label"=>"Job Location","name"=>"job_location"];
        $this->col[] = ["label"=>"Openings Available","name"=>"openings","callback" => function($row) {
            $openings=\DB::table('job_orders')->find($row->job_order_id)->openings_available;
            DB::table('website_applications')->where('job_order_id',$row->job_order_id)->update(['openings'=> $openings]);
            return  $openings; 
            }];
            $this->col[] = ["label"=>"Associated","name"=>"openings","callback" => function($row) {
            $associated= DB::table('website_applications')->where('website_applications.job_order_id',$row->job_order_id) ->where('website_applications.status','active')->join('website_candidates','website_candidates.id','=','website_applications.web_candidate_id')->count();
            return  $associated; 
            }];
            $this->col[] = ["label"=>"To be Associated","name"=>"openings","callback" => function($row) {
            $unassociated= DB::table('website_applications')->where('website_applications.job_order_id',$row->job_order_id)->where('website_applications.status','inactive')->join('website_candidates','website_candidates.id','=','website_applications.web_candidate_id')->count();
            return $unassociated; 
            }];
		/*$this->col[] = ["label"=>"First Name","name"=>"web_firstname"];
		$this->col[] = ["label"=>"Last Name","name"=>"web_lastname"];
		$this->col[] = ["label"=>"Email","name"=>"web_email"];
		$this->col[] = ["label"=>"Contact Number","name"=>"web_phone"];*/
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];
		$this->form[] = ['label'=>'Job Order Id','name'=>'job_order_id','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'job_orders,id'];
		$this->form[] = ['label'=>'Job Order Name','name'=>'job_order_id','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10',"callback" => function($row) {
             return \DB::table('job_orders')->find($row->job_order_id)->title;
            }];
		/*$this->form[] = ['label'=>'Firstname','name'=>'web_firstname','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Lastname','name'=>'web_lastname','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Email','name'=>'web_email','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
		$this->form[] = ['label'=>'Contact Number','name'=>'web_phone','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];*/
		/*$this->form[] = ['label'=>'Web Resume','name'=>'web_resume','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];*/

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
        $this->addaction[] = ['label' => 'View Applicants', 'url' => "/admin/view-applicants?job_order_id=[job_order_id]"];

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
                    var newtext = 'No New Website Applications & click ALL to view full Application list.' ;
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
                    var text='Associated';
                    var othertext='To be Associated';
                    if(getTitletxt==text)
                    {    $(this).find('input[type=text],select,strong').hide();
                        
                    }
                    if(getTitletxt==othertext)
                    {    $(this).find('input[type=text],select,strong').hide();
                        
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
        $this->pre_index_html = NULL;
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
            $query->groupBy('website_applications.job_order_id');
            if($_REQUEST['all']){
            $query->where('website_applications.status','inactive');
            $query->orwhere('website_applications.status','active');
            }
            else{
                  $query->where('website_applications.status','inactive')->where('website_applications.remove_status','not-removed');
            }
            $query->select('website_applications.*'); 
          

          
      
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
         $website_applications= \DB::table('website_applications')->where('id',$id)->first();
         \DB::table('website_applications')->where('job_order_id',$website_applications->job_order_id)->delete();
         CRUDBooster::redirect('admin/website-applications',"Successfully delete the data.","success");
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
}