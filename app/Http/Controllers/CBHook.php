<?php 
namespace App\Http\Controllers;

use DB;
use Session;
use Request;
use CRUDBooster;

class CBHook extends Controller {

	/*
	| --------------------------------------
	| Please note that you should re-login to see the session work
	| --------------------------------------
	|
	*/
	public function afterLogin() {
		
		if(CRUDBooster::me()->status == 'Inactive'){
			// CRUDBooster::redirect('/admin/logout',"You are Inactive!..")->with('message', "You are Inactive!..");
			$me = CRUDBooster::me();
			CRUDBooster::insertLog(trans("crudbooster.log_logout",['email'=>$me->email]));

			Session::flush();
			CRUDBooster::redirect('/admin/login','You are Inactive!..');
			exit;
		}
	}
}