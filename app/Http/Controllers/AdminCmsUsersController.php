<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;

class AdminCmsUsersController extends \crocodicstudio\crudbooster\controllers\CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';	
		$this->button_show 		   = FALSE;
		$this->button_import 	   = FALSE;	
		$this->button_export 	   = FALSE;	
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		$this->col[] = array("label"=>"Name","name"=>"name");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Photo","name"=>"photo","image"=>1);
		$this->col[] = array("label"=>"Status","name"=>"status","callback"=> function($row) {
			if($row->status == 'Active') {
				return '<i class="fa fa-toggle-on text-success"></i> &nbsp;Active';
			} else {
				return '<i class="fa fa-toggle-off text-danger"></i> &nbsp;Inactive';
			}
		});

		$this->addaction = array();
		$this->addaction[] = ['label'=>'&nbsp;Set Active','url'=>"/custom/set-user-status?status=Active&user_id=[id]",'icon'=>'fa fa-toggle-on text-success','color'=>'success','showIf'=>"[status] == 'Inactive'"];
		$this->addaction[] = ['label'=>'&nbsp;Set Inactive','url'=>"/custom/set-user-status?status=Inactive&user_id=[id]",'icon'=>'fa fa-toggle-off text-danger','color'=>'warning','showIf'=>"[status] == 'Active'", 'confirmation' => true];
		$this->style_css = "
		.text-success{
			color:#3c763d;
			font-size:16px;
		}
		.text-danger{
			color:#a94442;
			font-size:16px;
		}
		.btn-warning .text-success{
			color:#3c763d;
		}
		.btn-warning .text-danger{
			color:yellow;
		}";
		$this->table_row_color[] = ["condition"=>"[status] == 'Inactive'","color"=>"warning"];
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array(); 		
		$this->form[] = array("label"=>"Name","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());		
		$this->form[] = array("label"=>"Photo","name"=>"photo","type"=>"upload","help"=>"Recommended resolution is 200x200px",'validation'=>'image|max:1000');											
		$this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name",'required'=>true);						
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		
		$this->form[] = array("label"=>"Status","name"=>"status","type"=>"select","dataenum"=>"Active|Active;Inactive|Inactive","required"=>true);
		# END FORM DO NOT REMOVE THIS LINE
		$this->script_js = "
        $(document).ready(function(){
        ".(isset($_REQUEST['m']) ? "$('.breadcrumb').hide()":"").
        "});";		
	}

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = trans("crudbooster.label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());		
		$this->cbView('crudbooster::default.form',$data);				
	}

	public function hook_after_edit($id) {

		$eventOwnNameUpdate = app('App\Http\Controllers\CustomController')->updateEventJobCandOwnNames('owner',$id);

	}

	public function hook_query_index(&$query) {
		
		//$query->where('id_cms_privileges','!=',1);
		$query->where('email','!=','monu@c2w.org');
	}

}
