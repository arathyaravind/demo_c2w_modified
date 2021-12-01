    @extends('crudbooster::admin_template')
    @section('content')
    @include('override.candidates._styles')
    <?php 
    if($_REQUEST['location']!='') {
        $location_name = explode('-', $_REQUEST['location']);
    }
    if($_REQUEST['functional_area']!='') {
        $industry_functional_area_name = explode('--', $_REQUEST['functional_area']);
    }
    $industry_functional_area_skill_names = [];
    $functional_area_skill_name = [];
    $functional_area_skill_ids = [];
    if($_REQUEST['functional_area_skills']!='') {
        foreach ($_REQUEST['functional_area_skills'] as $functional_area_skill) {
            $industry_functional_area_skill_names[] = explode('--', $functional_area_skill);
        } 
        foreach($industry_functional_area_skill_names as $industry_functional_area_skill_name) {
            $functional_area_skill_name[] = $industry_functional_area_skill_name[1];
        }
        foreach($industry_functional_area_skill_names as $industry_functional_area_skill_name) {
            $functional_area_skill_ids[] = $industry_functional_area_skill_name[0];
        }


    }

    $industry_functional_area_role_names = [];
    $functional_area_role_name = [];
    $functional_area_role_ids = [];
    if($_REQUEST['functional_area_roles']!='') {
        foreach ($_REQUEST['functional_area_roles'] as $functional_area_role) {
            $industry_functional_area_role_names[] = explode('--', $functional_area_role);
        } 

        foreach($industry_functional_area_role_names as $industry_functional_area_role_name) {
            $functional_area_role_name[] = $industry_functional_area_role_name[1];
        }
        foreach($industry_functional_area_role_names as $industry_functional_area_role_name) {
            $functional_area_role_ids[] = $industry_functional_area_role_name[0];
        }
        // dd($_REQUEST['functional_area_roles']);
    }

    if($_REQUEST['industry']!='') {
        $industry_name = explode('--', $_REQUEST['industry']);
    }
    ?>

    <div id="preloader" style="display: block;">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <button class="btn btn-success" data-toggle="collapse" data-target="#searchCandidate">Search Candidates</button> 
                <a class="btn btn-success" target="_blank" href="{{CRUDBooster::mainpath('add')}}">Add Candidate</a> 
                <button type="button" class="btn btn-success" id="addMultipleCandidatesToJobOrder" data-toggle="modal" data-toggle="modal" data-target="#addCandidatesToJobOrder">Add To JobOrder</button>
                <button type="button" class="btn btn-success" id="mailToMultipleCandidates" data-toggle="modal" data-toggle="modal" data-target="#emailToMultipleCandidates" style="margin-right: 6px;">Mail To Candidates</button>
                {{-- <a class="btn btn-success" id="downloadResume" target="_blank" href="/admin/candidates/download_pdf/">Download Resume</a>  --}}


                <!-- Modal -->
                <div id="addCandidatesToJobOrder" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-add-to-job">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Candidates to Job Order</h4>
                            </div>
                            <div class="modal-body">
                                <div class="candidate-modal-content">
                                    <div class="add-msg"></div>
                                    <div class="candidate-modal-items">Select Any Job Order</div>
                                    <div class="candidate-modal-items cand-jo-select">
                                        <select name="jo_c_id" class='form-control select2'>
                                            <option value="">Job Orders (Company)</option>
                                            @foreach($jobOrders as $jobOrder)
                                            <?php $multicompanyName = \DB::table('companies')->find($jobOrder->company_id)->name;?>
                                            <option value="{{$jobOrder->id}}">  
                                                {{ $jobOrder->id.'-'.$jobOrder->title.' ('.$multicompanyName.')'}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="candidate-modal-items">
                                        <button type="button" class="btn btn-success" id="addCidsTojobOrderBtn" onclick="addCidsTojobOrder()"> Submit</button>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Modal -->
                <!-- Modal Send Email -->
                <div id="emailToMultipleCandidates" class="modal fade close-check" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Send Email to Candidates</h4>
                            </div>
                            <div class="modal-body">
                                <div class="candidate-modal-content">
                                    <div class="single-send-msg"><p></p></div>
                                    <div class="candidate-modal-items"> Select Email Template
                                    </div>
                                    <div class="candidate-modal-items">
                                        <select name="c_email_template_id" id="c_email_template_id" onchange="getMailContentMultiCandidates()">
                                            <option value=" ">Select Email Template</option>
                                            <option value="mail_to_candidate">Mail To Candidate</option>
                                            <option value="update_resume">Request for Updated Resume</option>
                                            <option value="congratulation_mail">Congratulation mail</option>
                                        </select>
                                    </div>
                                    <div class="subject" style="display: none" >
                                        <div class="candidate-modal-items">Subject:
                                        </div>
                                        <div class="candidate-modal-items">
                                            <input type="text" class="col-md-12 subject-content"  name="subject" value=""/>
                                        </div><br/>
                                    </div>
                                    <div contenteditable="true" placeholder="Mail content here" class="c_mail_content" id="c_mail_content">

                                    </div>
                                    <div class="candidate-modal-items">
                                        <button type="button" class="btn btn-success" id="sendToMultipleCandidate" onclick="sendToMultipleCandidate()"> Submit</button>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Modal -->



                <div id="searchCandidate" class="collapse">

                
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#advance_box">Advance Search</a></li>
                        <li><a data-toggle="tab" href="#employment_box">Employment Details</a></li>
                        <li><a data-toggle="tab" href="#educational_box">Educational Details</a></li>
                        <li><a data-toggle="tab" href="#additional_box">Additional Details</a></li>

                      </ul>

                      <input type="hidden" name="location" id="checked_cid" value="{{$_REQUEST['checked_cid']}}">
                      
                      <form method="get" action="{{CRUDBooster::mainpath()}}" class="form-horizontal form-inline" id="search-form">
                        <div class="tab-content">
                            
                            <div id="advance_box" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label col-sm-4" for="q"><b>Any Keyword</b></label>
                                        <div class="col-sm-8">
                                          <input type="textbox" class="form-control" placeholder="Keyword" name="q" value="{{$_REQUEST['q']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label col-sm-4" for="must_q"><b> All Keyword <br>(Must Have)</b></label>
                                        <div class="col-sm-8">
                                          <input type="textbox" class="form-control" placeholder="Keyword" name="must_search" value="{{$_REQUEST['must_search']}}">
                                        </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="minExpY"><b>Total Experience <br> ( in Years)</b></label>
                                        <div class="col-sm-8">
                                        <input type="number" class="form-control" id="minExpY" placeholder="Min Experience" name="minExpY" min="0" max="100" step="0.1" value="{{$_REQUEST['minExpY']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group mt-10" style="text-align: center">
                                            <b>To</b>
                                    </div>
                                    <div class="col-md-5 form-group mt-10">
                                        <div class="col-sm-12">
                                           <input type="number" class="form-control" id="maxExpY" placeholder="Max Experience" name="maxExpY" min="0" max="100" step="0.1" value="{{$_REQUEST['maxExpY']}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="minCtc"><b>Annual Salary <br> ( In Lac )</b></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="minCtc" placeholder="Min Ctc" name="minCtc" min="0" value="{{$_REQUEST['minCtc']}}" step="0.1">
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group mt-10" style="text-align: center">
                                        <b>To</b>
                                    </div>
                                    <div class="col-md-5 form-group mt-10">
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="max_ctc" name="maxCtc" placeholder="Max Ctc" min="0" value="{{$_REQUEST['maxCtc']}}" step="0.1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Select Location</b></label>
                                        <div class="col-sm-8">
                                            <select id="location" class="form-control select2" multiple>
                                                <option value="">Select Location</option>
                                                @foreach($cities as $city)
                                                <option value="{{$city->id.'-'.$city->name}}" {{ str_contains($_REQUEST['location'], $city->id) ? 'selected': ''}} >{{$city->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="location" id="selected_location" value="{{$_REQUEST['location']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Search Resume</b></label>
                                        <div class="col-sm-8">
                                            <select name="fromResume" class="form-control" style="margin-left: -7px;">
                                                <option value="">Search Resume</option>
                                                <option value="entireResume" {{($_REQUEST['fromResume'] == 'entireResume') ? 'selected' : '' }} >Entire Resume</option>
                                                <option value="noResume" {{($_REQUEST['fromResume'] == 'noResume') ? 'selected' : '' }}>Not Resume</option>
                                            </select>   
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Functional Area</b></label>
                                        <div class="col-sm-8">
                                            <select name="functional_area" class="form-control" onchange="listFunctionalAreaRolesAndSkills(this.value)" >
                                                <option value="">Select Functional Area</option>
                                                @foreach($industry_functional_areas as $industry_functional_area)
                                                <option value='{{$industry_functional_area->id.'--'.$industry_functional_area->name}}'  {{ ($industry_functional_area_name[0] == $industry_functional_area->id) ? 'selected' :''}} >
                                                    {{$industry_functional_area->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-10">
                                        <div class="col-sm-12">
                                            <select name="functional_area_skills[]" class="form-control" id="functional_area_skills" multiple="multiple">
                                                @foreach($industry_functional_area_skills as $industry_functional_area_skill)
                                                <option value="{{$industry_functional_area_skill->id.'--'.$industry_functional_area_skill->name}}" {{ (in_array($industry_functional_area_skill->id, $functional_area_skill_ids)) ? 'selected':''}}>
                                                    {{$industry_functional_area_skill->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div id="employment_box" class="tab-pane fade">
                            
                                <div class="row" style="padding: 0px 30px;">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Industry</b></label>
                                        <div class="col-sm-8">
                                            <select name="industry" class="form-control">
                                                <option value="">Select Industry</option>
                                                @foreach($industries as $industry)
                                                <option value="{{$industry->id.'--'.$industry->name}}" {{ $industry->id== $industry_name[0]? 'selected': ''}} >
                                                    {{$industry->name}}
                                                </option>
                                                @endforeach 
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-10">
                                    </div>
                                </div>

                                <div class="row" style="padding: 0px 30px;">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Designation</b></label>
                                        <div class="col-sm-8">

                                            {{-- <select id="designation" class="form-control select2" multiple>
                                                @foreach($designations as $designation)
                                                <option value='{{$designation}}' {{ str_contains($_REQUEST['designation'], $designation) ? 'selected': ''}}>{{$designation}}
                                                </option>
                                                @endforeach
                                            </select> --}}
                                            
                                            <input type="text" class="form-control" name="designation" id="designation" value="{{$_REQUEST['designation']}}" placeholder="designation" >
                                            

                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-10">
                                    </div>
                                </div>
                                <div class="row mt-10" style="padding: 0px 30px;">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label col-sm-4" for="notice_period"><b>Notice Period<br> (in days)</b></label>
                                        <div class="col-sm-8">
                                          <input type="num" class="form-control" id="notice_period" placeholder="Notice period" name="notice_period" value="{{$_REQUEST['notice_period']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                   </div>
                                </div>

                            </div>
                            <div id="educational_box" class="tab-pane fade">

                                <div class="row" style="padding: 10px 30px;">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label" ><b>UG Qualification</b></label>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="btn btn-info qualifyUgBtn {{($_REQUEST['ugQualification'] == 'any') ? 'selectedBtn' : '' }}" id="anyUgBtn" onclick="getUgQualification('any','anyUgBtn')" > Any UG Qualification</div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="btn btn-info qualifyUgBtn {{($_REQUEST['ugQualification'] != 'any' && $_REQUEST['ugQualification'] != 'no'  && $_REQUEST['ugQualification'] != '' ) ? 'selectedBtn' : '' }}" id="specificUgBtn" onclick="getUgQualification('specific','specificUgBtn')"> Specified UG Qualification</div>
                                        <select id="ug_qualification_id" class="form-control" style="display:{{($_REQUEST['ugQualification'] != 'any' && $_REQUEST['ugQualification'] != 'no'  && $_REQUEST['ugQualification'] != '' ) ? 'block' : 'none' }};margin-top:15px" onchange="getSpecificQualification(this.value,'ug');">
                                            <option value="">Select Qualification</option>
                                            @foreach($ug_qualifications as $key => $value)
                                            <option value='{{$key}}'  {{($_REQUEST['ugQualification'] == $key) ? 'selected' : '' }} >
                                                {{$value}}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="btn btn-info qualifyUgBtn {{($_REQUEST['ugQualification'] == 'no') ? 'selectedBtn' : '' }}" id="noUgBtn" onclick="getUgQualification('no','noUgBtn')"> No UG Qualification</div>
                                    </div>
                                    <input type="hidden" id="ugQualification" name="ugQualification" >
                                    <input type="hidden" id="ugButtonClick" >
                                </div>

                                <div class="row mt-10" style="padding: 10px 30px;">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label" for="email"><b>PG Qualification</b></label>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="btn btn-info qualifyPgBtn  {{($_REQUEST['pgQualification'] == 'any') ? 'selectedBtn' : '' }}" id="anyPgBtn" onclick="getPgQualification('any','anyPgBtn')"> Any PG Qualification</div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="btn btn-info qualifyPgBtn {{($_REQUEST['pgQualification'] != 'any' && $_REQUEST['pgQualification'] != 'no'  && $_REQUEST['pgQualification'] != '' ) ? 'selectedBtn' : '' }}" id="specificPgBtn" onclick="getPgQualification('specific','specificPgBtn')"> Specified PG Qualification</div>
                                        <select id="pg_qualification_id" class="form-control" style="display:none;margin-top:15px" onchange="getSpecificQualification(this.value,'pg');">
                                            <option value="">Select Qualification</option>
                                            @foreach($pg_qualifications as $key => $value)
                                            <option value='{{$key}}' {{($_REQUEST['pgQualification'] == $key) ? 'selected' : '' }}  >
                                                {{$value}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <div class="btn btn-info qualifyPgBtn {{($_REQUEST['pgQualification'] == 'no') ? 'selectedBtn' : '' }}" id="noPgBtn" onclick="getPgQualification('no','noPgBtn')"> No PG Qualification</div>
                                    </div>
                                    <input type="hidden" id="pgQualification" name="pgQualification" >
                                    <input type="hidden" id="pgButtonClick" >
                                </div>

                            </div>
                            <div id="additional_box" class="tab-pane fade">
                                
                                <div class="row">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Gender</b></label>
                                        <div class="col-sm-8">
                                              <label class="radio-inline">
                                                <input type="radio" name="gender" value="Male" {{($_REQUEST['gender'] == 'Male') ? 'checked' : '' }} >Male
                                              </label>
                                              <label class="radio-inline">
                                                <input type="radio" name="gender" value="Female" {{($_REQUEST['gender'] == 'Female') ? 'checked' : '' }} >Female
                                              </label>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-10">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group mt-10">
                                        <label class="control-label col-sm-4" for="email"><b>Relationship Status</b></label>
                                         <div class="col-sm-8">
                                              <label class="radio-inline">
                                                <input type="radio" name="relationship_status" value="Married" {{($_REQUEST['relationship_status'] == 'Married') ? 'checked' : '' }} >Married
                                              </label>
                                              <label class="radio-inline">
                                                <input type="radio" name="relationship_status" value="Unmarried" {{($_REQUEST['relationship_status'] == 'Unmarried') ? 'checked' : '' }} >Unmarried
                                              </label>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mt-10">
                                        
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer" style="">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                       <div class="search-panel"> 
                                           <div class="search-keys">
                                               <input type="submit" class="btn btn-success float-right" value="Submit" id="submitBtn" onclick="submit()">
                                               <input type="reset" class="btn btn-info float-right" value="Reset" id="reset_search">  
                                           </div>
                                       </div>
                                    </div>
                               </div>
                            </div>

                        </div>

                      </form>

            
                    {{-- <form method="get" action="{{CRUDBooster::mainpath()}}" class="form-horizontal" id="search-form">
                        <div class="search-panel">
                            <div class="search-keys" style="width: 816px;">
                                <input type="text" class="col-md-8 form-control" id="search-box" placeholder="Keyword" name="q" value="{{$_REQUEST['q']}}">
                            </div>    
                        </div>
                        <div class="search-panel">
                            <div class="search-keys">
                                {{-- <input type="text" placeholder="Functional Area" name="functional_area" value="{{$_REQUEST['functional_area']}}">    
                                <select name="functional_area" class="form-control" onchange="listFunctionalAreaRolesAndSkills(this.value)" style="width: 400px;">
                                    <option value="">Select Functional Area</option>
                                    @foreach($industry_functional_areas as $industry_functional_area)
                                    <option value='{{$industry_functional_area->id.'--'.$industry_functional_area->name}}'  {{ ($industry_functional_area_name[0] == $industry_functional_area->id) ? 'selected' :''}} >
                                        {{$industry_functional_area->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="search-keys" style="width:406px;">
                                {{-- <input type="text" placeholder="Functional Area Skills" name="functional_area_skills" value="{{$_REQUEST['functional_area_skills']}}"> 

                                <select name="functional_area_skills[]" class="form-control" id="functional_area_skills" multiple="multiple">
                                    @foreach($industry_functional_area_skills as $industry_functional_area_skill)
                                    <option value="{{$industry_functional_area_skill->id.'--'.$industry_functional_area_skill->name}}" {{ (in_array($industry_functional_area_skill->id, $functional_area_skill_ids)) ? 'selected':''}}>
                                        {{$industry_functional_area_skill->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="search-panel">
                            <div class="search-keys" style="width:816px;">
                                <select name="functional_area_roles[]" id="functional_area_role" class="form-control" multiple="multiple">
                                    @foreach($industry_functional_area_roles as $industry_functional_area_role)
                                    <option value='{{$industry_functional_area_role->id.'--'.$industry_functional_area_role->name}}'{{ (in_array($industry_functional_area_role->id, $functional_area_role_ids)) ? 'selected':''}}>{{$industry_functional_area_role->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="search-panel">
                            <div class="search-keys">
                                {{-- <input type="text" placeholder="Industry" name="industry" value="{{$_REQUEST['industry']}}"> 
                                <select name="industry" class="form-control">
                                    <option value="">Select Industry</option>
                                    @foreach($industries as $industry)
                                    <option value="{{$industry->id.'--'.$industry->name}}" {{ $industry->id== $industry_name[0]? 'selected': ''}} >
                                        {{$industry->name}}
                                    </option>
                                    @endforeach 
                                </select>  
                            </div>
                            <div class="search-keys col-md-3">
                                <select name="location" class="form-control">
                                    <option value="">Select Location</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->id.'-'.$city->name}}" {{ $city->id== $location_name[0]? 'selected': ''}} >{{$city->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search-keys col-md-3">
                              <select name="fromResume" class="form-control" style="margin-left: -7px;">
                                    <option value="">Search Resume</option>
                                    <option value="entireResume" {{($_REQUEST['fromResume'] == 'entireResume') ? 'selected' : '' }} >Entire Resume</option>
                                    <option value="noResume" {{($_REQUEST['fromResume'] == 'noResume') ? 'selected' : '' }}>Not Resume</option>
                                </select>        
                            </div> 
                        </div>
                        <!-- </div> -->
                        <div class="search-panel"> 
                            <div class="search-keys" style="width: 150px">
                                Experience
                            </div>
                            <div class="search-keys">
                                <input type="number" class="form-control" placeholder="Min Years" name="minExpY" value="{{$_REQUEST['minExpY']}}" >  

                                <input type="number" class="form-control" placeholder="Min Months" name="minExpM" value="{{$_REQUEST['minExpM']}}" style="margin-top: 12px;">        
                            </div>
                            <div class="search-keys">
                                <input type="number" class="form-control" placeholder="Max Years" name="maxExpY" value="{{$_REQUEST['maxExpY']}}">     
                                <input type="number" class="form-control" placeholder="Max Months" name="maxExpM" value="{{$_REQUEST['maxExpM']}}" style="margin-top: 12px;">        
                            </div>
                        </div>
                        <div class="search-panel"> 
                            <div class="search-keys" style="width: 150px"> Name </div>
                            <div class="search-keys">
                                <input type="text" class="form-control" placeholder="First Name" name="firstName" value="{{$_REQUEST['firstName']}}" >  
                            </div>
                            <div class="search-keys">
                                <input type="text" class="form-control" placeholder="Last Name" name="lastName" value="{{$_REQUEST['lastName']}}">     
                            </div>
                        </div>  
                        <div class="search-panel"> 
                            <div class="search-keys">
                                <input type="submit" class="btn btn-success" value="Submit">
                                <input type="reset" class="btn btn-info" value="Reset" id="reset_search">  


                            </div>
                        </div>
                    </form> --}}
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <br>
                <table class='table table-striped table-bordered' id="example">
                    <tbody>
                       
                        @if($_REQUEST['functional_area']!='' || $_REQUEST['functional_area_skills']!='' || $_REQUEST['industry']!='' ||
                            $_REQUEST['minExpM']!='' || $_REQUEST['maxExpM']!='' || 
                            $_REQUEST['minExpY']!='' || $_REQUEST['maxExpY']!='' || $_REQUEST['location']!='' || $_REQUEST['firstName']!='' ||
                            $_REQUEST['lastName']!=''|| $_REQUEST['functional_area_roles']!='' ||
                            $_REQUEST['q']!='' || $_REQUEST['must_search']!=''  || $_REQUEST['relationship_status']!=''  ||$_REQUEST['gender']!=''  ||  $_REQUEST['minCtc']!='' || $_REQUEST['maxCtc']!='' || count($selected_location) > 0 || $_REQUEST['designation']!='' || $_REQUEST['ugQualification']!='' || $_REQUEST['pgQualification']!='' ) 
                            <tr>
                                <td> Searched for 

                                    {{-- {!!$_REQUEST['functional_area']!=''? '&nbsp;&nbsp;<b>Functional Area: </b>&nbsp;&nbsp;'. $industry_functional_area_name[1].' ' : ''!!}
                                    {!! $functional_area_skill_name ? '&nbsp;&nbsp;<b>Functional Area Skills: </b>&nbsp;&nbsp;'.implode(',  ',$functional_area_skill_name).'&nbsp;' : ''!!} 

                                    {!! $functional_area_role_name ? '&nbsp;&nbsp;<b>Functional Area Roles:</b>&nbsp;&nbsp;'.implode(',  ',$functional_area_role_name).' ' : ''!!}

                                    {!!$_REQUEST['industry']!=''? '&nbsp;&nbsp;<b>Industry: </b>&nbsp;&nbsp;'.$industry_name[1].' ' : ''!!} 
                                    {!!$_REQUEST['minExpY']!=''? '&nbsp;&nbsp;<b>Min Exp Years:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">'.$_REQUEST['minExpY'].' Years  </span>' : ''!!} 
                                    {!!$_REQUEST['minExpM']!=''? '&nbsp;&nbsp;<b>Min Exp Months:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">'.$_REQUEST['minExpM'].'</span> ' : ''!!} 
                                    {!!$_REQUEST['maxExpY']!=''? '&nbsp;&nbsp;<b>Max Exp Years: </b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">'.$_REQUEST['maxExpY'].' Years </span>' : ''!!}
                                    {!!$_REQUEST['maxExpM']!=''? '&nbsp;&nbsp;<b>Max Exp Months:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">'.$_REQUEST['maxExpM'].'</span> ' : ''!!} 

                                    {!!$_REQUEST['firstName']!=''? '&nbsp;&nbsp;<b>First Name:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">'.$_REQUEST['firstName'].'</span> ' : ''!!} 
                                    {!!$_REQUEST['lastName']!=''? '&nbsp;&nbsp;<b>Last Name:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">'.$_REQUEST['lastName'].'</span> ' : ''!!} --}}

                                    @if($_REQUEST['functional_area']!='')

                                    &nbsp;&nbsp;<b>Functional Area: </b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;"> {{ $industry_functional_area_name[1] }} <span onclick="removeSearch('functional_area','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span> 

                                    @endif

                                    @if($functional_area_skill_name !='' && $_REQUEST['functional_area_skills']!='')
                                           &nbsp;&nbsp;<b>Functional Area Skills : </b>
                                        
                                        @foreach ($functional_area_skill_name as $item)
                                             <span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;"> {{$item}} </span>
                                        @endforeach
                                    @endif


                                    @if(trim($_REQUEST['q'])!='')
                                      @php  $search_key =  explode(",",$_REQUEST['q']);  
                                      echo '&nbsp;&nbsp;<b>Any Keyword :</b>';
                                      @endphp
                                      @foreach ($search_key as $item)
                                         <span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;"> {{$item}} <span onclick="removeSearch('q','{{$item}}')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span> </span>
                                      @endforeach
                                    @endif

                                    @if(trim($_REQUEST['must_search'])!='')
                                        @php  $search_key =  explode(",",$_REQUEST['must_search']);  
                                           echo '&nbsp;&nbsp;<b>Must Have :</b>';
                                        @endphp
                                        @foreach ($search_key as $item)
                                            <span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;"> {{$item}} <span onclick="removeSearch('must_search','{{$item}}')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span> </span>
                                        @endforeach
                                    @endif


                                    @if($_REQUEST['minExpY']!='')

                                    &nbsp;&nbsp;<b> Min Exp Years:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['minExpY'] }} Years <span onclick="removeSearch('minExpY','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

                                    @endif
                                    @if($_REQUEST['relationship_status']!='')

&nbsp;&nbsp;<b> Relationship Status:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['relationship_status'] }} <span onclick="removeSearch('relationship_status','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

@endif
@if($_REQUEST['gender']!='')

&nbsp;&nbsp;<b> Gender:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['gender'] }} <span onclick="removeSearch('gender','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

@endif

                                    @if($_REQUEST['maxExpY']!='')

                                    &nbsp;&nbsp;<b> Max Exp Years:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['maxExpY'] }} Years <span onclick="removeSearch('maxExpY','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

                                    @endif

                                    @if($_REQUEST['minCtc']!='')

                                        &nbsp;&nbsp;<b> Min Ctc :</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['minCtc'] }} Lac <span onclick="removeSearch('minCtc','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

                                    @endif

                                    @if($_REQUEST['maxCtc']!='')

                                        &nbsp;&nbsp;<b> Max Ctc :</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['maxCtc'] }} Lac <span onclick="removeSearch('maxCtc','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

                                    @endif

                                    @if($selected_location !='' && count($selected_location) > 0)
                                    &nbsp;&nbsp;<b> City :</b>&nbsp;&nbsp;
                                        @foreach ($selected_location as $key => $item)
                                            <span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;"> {{$item}} <span onclick="removeSearch('location','{{$key}}')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span> </span>
                                        @endforeach
                                    @endif

                                    @if($_REQUEST['designation']!='')
                                        @php  $designation =  explode(",",$_REQUEST['designation']);  
                                        echo '&nbsp;&nbsp;<b>Designation :</b>';
                                        @endphp
                                        @foreach ($designation as $item)
                                        <span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;"> {{$item}} <span onclick="removeSearch('designation','{{$item}}')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span> </span>
                                        @endforeach
                                    @endif

                                    @if($_REQUEST['ugQualification']!='')

                                    &nbsp;&nbsp;<b> Ug Qualification:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['ugQualification'] }} <span onclick="removeSearch('ugQualification','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

                                    @endif

                                    @if($_REQUEST['pgQualification']!='')

                                    &nbsp;&nbsp;<b> Pg Qualification:</b>&nbsp;&nbsp;<span style="background-color: green; color: white;padding: 2px 10px;margin-left: 10px;cursor: pointer;">{{ $_REQUEST['pgQualification'] }} <span onclick="removeSearch('pgQualification','')" style="font-size: 10px;"> <i class="fa fa-times" aria-hidden="true"></i> </span>  </span>

                                    @endif
                                  

                                
                                </td>
                            </tr>


                            @endif


                            <br>
                            <tr style="margin-top:10px">
                                <td>
                                    <div class="row" style="background: #f9f9f9;padding: 10px 0px;margin: 0px -6px;margin-top:7px">
                                        
                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <div class="col-sm-1">
                                                   <input type="checkbox" name="all_check"  onchange="checkAll(this.checked)" style="float:left"> 
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label" style="font-weight:normal;margin-right:6px">Limit</label>
                                                        <div class="col-sm-8">
                                                            <select class='' name="limit" style="width: 100%;" onchange="changeLimit(this.value)">
                                                                <option value="20" {{($_REQUEST['limit'] == '20' || $_REQUEST['limit'] == '' ) ? 'selected' : '' }}>20</option>
                                                                <option value="50" {{($_REQUEST['limit'] == '50') ? 'selected' : '' }}>50</option>
                                                                <option value="100" {{($_REQUEST['limit'] == '100') ? 'selected' : '' }}>100</option>
                                                            </select>
                                                        </div>
                                                      </div>

                                                  
                                                </div>
                                                <div class="col-sm-7"> {{ $record_count }} Candidate(s) Found !! </div>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label" style="font-weight:normal;font-size: 13px;">Active in days </label>
                                                <div class="col-sm-8">
                                                    <select class='' name="active_in" style="width: 100%;" onchange="changeActiveInDays(this.value)">
                                                        <option value="">Please Select</option>
                                                        <option value="last_15_days" {{($_REQUEST['active_in'] == 'last_15_days') ? 'selected' : '' }}>Last 15 days</option>
                                                        <option value="last_month" {{($_REQUEST['active_in'] == 'last_month') ? 'selected' : '' }}>Last month</option>
                                                        <option value="last_2_month" {{($_REQUEST['active_in'] == 'last_2_month') ? 'selected' : '' }}>Last 2 month</option>
                                                        <option value="last_5_month" {{($_REQUEST['active_in'] == 'last_5_month') ? 'selected' : '' }}>Last 5 month</option>
                                                        <option value="last_year" {{($_REQUEST['active_in'] == 'last_year') ? 'selected' : '' }}>Last year</option>
                                                    </select>
                                                  
                                                </div>
                                              </div>
                                        </div>
                                        <div class="col-md-3" style="float:right;text-align:right">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-4 col-form-label" style="font-weight:normal;font-size: 13px;">Sort by </label>
                                                <div class="col-sm-8">
                                                    <select class='' name="sort" style="width: 100%;" onchange="changeSort(this.value)">
                                                        <option value="relavent" {{($_REQUEST['order'] == 'relavent' || $_REQUEST['order'] == '' ) ? 'selected' : '' }}>Relavent</option>
                                                        <option value="newly_added" {{($_REQUEST['order'] == 'newly_added') ? 'selected' : '' }}>Newly Added</option>
                                                    </select>
                                                  
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @if(count($result)==0)
                                <tr><td> Candidates Not Found !! </td></tr>
                            @else

                            @endif

                          
                            
                    </tbody>
                </table>


                            <table class='table table-striped table-bordered' id="example">
                                <tbody>
                            @foreach($result as $row)
                            <?php

                            $wordlist = array("is", "on", "the");
                            foreach ($wordlist as &$word) {
                                $word = '/\b' . preg_quote($word, '/') . '\b/';
                            }
                            $_REQUEST['q'] = preg_replace($wordlist,'',  $_REQUEST['q']);
                            //$_REQUEST['q']= preg_replace('/\b\w\b(\s|.\s)?/', '', $_REQUEST['q']);
                            ?>
                            <tr>
                                <td class="candidate-td">

                                    <div class="row">
                                        <!-- single box -->
                                        <div class="col-lg-12 row m-0 box cntnr">
                            
                                           <div class="row">
                                              
                                              <div class="col-md-8">
                                                    <div class="row">
                                                       <div class="col-lg-2 p-0">
                                                          @if($row->photo_url)
                                                             <img src="/{{$row->photo_url}}" class="img" alt="User" width="60">
                                                          @else
                                                             <img src="{{$row->gender == 'Male'? '/images/male.png' : '/images/females.png' }}" class="img" alt="User" width="60">
                                                          @endif

                                                        @if($row->current_designation !='')
                                                        <span style="text-align: center;display: block;font-size: 14px;text-transform: uppercase;padding: 5px;font-weight: bold;    color: #21a0da; word-break: break-word;">
                                                            @if($_REQUEST['must_search'] != '')
                                                              {!! highlight($row->current_designation,$_REQUEST['must_search']) !!}
                                                            @else 
                                                               {!! highlight($row->current_designation,$_REQUEST['q']) !!}
                                                            @endif
                                                            </span>




                                                        @endif

                                                       </div>
                                                       <div class="col-lg-10 p-0">
                                                          <div class="row" style="font-size:14px;padding-top: 10px;border-bottom: 1px solid gray;margin-left: 6px;">
                                                             <div class="col-md-3" style="padding: 0px;">
                                                                <input type="checkbox" name="cid[]" value="{{$row->id}}" id="{{$row->id}}" data-name="{{$row->first_name}} {{$row->last_name}}" onchange="showButtons()" style="">
                                                                @if(CRUDBooster::isUpdate() && $button_edit)
                                                                <a href='{{CRUDBooster::mainpath("detail/$row->id")}}' rel="Edit" target="_blank">
                                                                  <span class="head-name" style="font-size:20px">
                                                                      {!! highlight($row->first_name, $_REQUEST['q']) !!} 
                                                                      {!! highlight($row->last_name,$_REQUEST['q']) !!}

                                                                      @if(CRUDBooster::isUpdate() && $button_edit)
                                                                      
                                                                      <a href='{{CRUDBooster::mainpath("edit/$row->id")}}' style="font-size: 10px;padding: 0px 2px;"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                      
                                                                      @endif

                                                                      @if(CRUDBooster::isSuperadmin()&& CRUDBooster::isDelete() && $button_delete)
                                                                            <?php
                                                                            if($row->totalAssociation > 0)
                                                                            {
                                                                                $text='Do you want to Unassociate and Delete this Candidate?';   
                                                                            }
                                                                            else{
                                                                                $text='Do you want to Delete this Candidate?';  
                                                                            }
                                                                            ?>
                                                                            <a class="glyphicon glyphicon-trash" title="Delete" href="javascript:;" onclick="swal({   
                                                                                title: &quot;Are you sure ?&quot;,   
                                                                                text: &quot;{{$text}}&quot;,   
                                                                                type: &quot;warning&quot;,   
                                                                                showCancelButton: true,   
                                                                                confirmButtonColor: &quot;#ff0000&quot;,   
                                                                                confirmButtonText: &quot;Yes&quot;,  
                                                                                cancelButtonText: &quot;No&quot;,  
                                                                                closeOnConfirm: false }, 
                                                                                 function(){  location.href='{{"candidates/delete/$row->id"}}'});"></i>
                                                                            </a>
                                                                      @endif
                              
                                                                  </span>
                                                              </a>
                                                              @endif
                                                             </div>
                                                            
                                                             <div class="col-md-3">
                                                             <div class="row">
                                                             <div class="col-md-3">
                                                            
                                                             <img src="/images/exp.png" style="    width: 22px; height: 24px; text-align: left;  margin:0px; padding:0px;">
                                                          
                                                            </div>
                                                                            <div class="col-md-9" style="    margin:0px; padding:0px;">
                                                             {{ $row->experience_years }} years, {{$row->experience_months }} months
                                                                            </div>
                                                                            </div>
                                                                            
                                                                            </div>
                                                                            
                                                         
                                                             <div class="col-md-3" >
                                                             <div class="row">
                                                             <div class="col-md-3">
                                                            
                                                             <img src="/images/location.png" style=" width: 22px; height: 24px; text-align: left; margin:0px; padding:0px;">
                                                             
                                                                            </div>
                                                                            <div class="col-md-9" style="   margin:0px; padding:0px;">
                                                             {!! highlight($row->current_city_name, $_REQUEST['q']) !!}
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                          
                                                                            
                                                             <div class="col-md-3" >
                                                             <div class="row">
                                                             <div class="col-md-3">
                                                             
                                                             <img src="/images/salary.png" style=" width: 22px; height: 24px; text-align: left; margin:0px; padding:0px;">
                                                            
                                                                            </div>
                                                                            <div class="col-md-9" style="    margin:0px; padding:0px;">
                                                             {!! highlight('INR '.$row->current_ctc.' lakhs', $_REQUEST['q']) !!}
                                                                            </div>
                                                                           
                                                                            </div>
                                                                            </div>
                                                                            
                                                          </div>
                                                          
                                                          <div class="row" style="font-size:14px;margin-top:3px">
                                                     
                                                               <div class="col-md-3">
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>Current:</b>
                                                                    @if($row->current_designation =='')
                                                                       <i>Not Mentioned</i>
                                                                    @else
                                                                    @if($_REQUEST['must_search'] != '')
                                                                            {!! highlight($row->current_designation,$_REQUEST['must_search']).' at '.$row->current_employer !!}
                                                                        @else 
                                                                            {!! highlight($row->current_designation,$_REQUEST['q']).' at '.$row->current_employer !!}
                                                                        @endif                                                                  
                                                                          @endif
                                                                   </li>
                                                                </ul>
                                                             </div>
                                                             <?php
                                                                $row->prefCity = DB::table('cities')->where('id',$row->preferred_city)->first();
                                                                if($row->prefCity) {
                                                                    $row->prefCity = $row->prefCity->name;
                                                                }
                                                                else {
                                                                    $row->prefCity = '-';
                                                                }
                                                            ?>
                                                             <div class="col-md-3">
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>Pref Loc:</b>
                                                                   @if($_REQUEST['must_search'] != '')
                                                                            {!! highlight($row->prefCity,$_REQUEST['must_search']) !!}
                                                                        @else 
                                                                            {!! highlight($row->prefCity,$_REQUEST['q']) !!}
                                                                        @endif                                                                </li>
                                                                </ul>
                                                             </div>
                                                             <div class="col-md-3">
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>Notice Period:</b> {{($row->notice_period > 0)? $row->notice_period. ' days': ' - ' }}</li>
                                                                </ul>
                                                             </div>
                                                             <div class="col-md-3">
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>Education :</b>
                                                                   @if($_REQUEST['must_search'] != '')
                                                                        {!! highlight($row->highest_qualification,$_REQUEST['must_search']) !!}
                                                                    @else 
                                                                        {!! highlight($row->highest_qualification,$_REQUEST['q']) !!}
                                                                    @endif                                                                 
                                                                       @if(CRUDBooster::isUpdate() && $button_edit)
                                                                    <a class='glyphicon glyphicon-pencil' href='{{CRUDBooster::adminPath("candidate_qualifications?candidate_id=$row->id")}}' rel="Edit" title="Edit Qualifications" target="_blank"></a>
                                                                    @endif
                                                                   </li>
                                                                </ul>
                                                             </div>
                                                             <div class="col-md-12">
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>Area :</b>
                                                                    @foreach($row->candidate_industry_functional_areas as $area)
                                                                    @if($_REQUEST['must_search'] != '')
                                                                        {!! highlight($area->industry_functional_area,$_REQUEST['must_search']) !!}
                                                                    @else 
                                                                        {!! highlight($area->industry_functional_area,$_REQUEST['q']) !!}
                                                                    @endif
                                                                    
                                                                    @if(!$loop->last), @endif                                                                    @endforeach
                                                                    </li>
                                                                </ul>
                                                             </div>
                                                             <div class="col-md-12">
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>Roles :</b>                           
                                                                    @foreach($row->candidate_industry_functional_area_roles as $role)
                                                                    @if($_REQUEST['must_search'] != '')
                                                                            {!! highlight($role->role,$_REQUEST['must_search']) !!}
                                                                        @else 
                                                                            {!! highlight($role->role,$_REQUEST['q']) !!}
                                                                        @endif
                                                                        
                                                                        @if(!$loop->last), @endif                                                                        @endforeach
                                                                        @if(CRUDBooster::isUpdate() && $button_edit)
                                                                        <a class='glyphicon glyphicon-pencil' href='{{CRUDBooster::adminPath("candidate_industry_functional_area_roles?candidate_id=$row->id")}}' rel="Edit" target="_blank"></a>
                                                                    @endif                                                                   
                                                                    </li>
                                                                </ul>
                                                                <ul style="list-style: none;padding-left: 4px;margin-bottom:0px">
                                                                   <li><b>skills :</b>  
                                                                    @if($row->candidate_industry_functional_area_skills!= '')
                                                                    @foreach($row->candidate_industry_functional_area_skills as $skill)
                                                                    @if($industry_functional_area_skill_name[1]!='' && $industry_functional_area_skill_name[1] === $skill->industry_functional_area_skill)
                                                                    @if($_REQUEST['must_search'] != '')
                                                                            {!! highlight($skill->industry_functional_area_skill,$_REQUEST['must_search']) !!}
                                                                        @else 
                                                                            {!! highlight($skill->industry_functional_area_skill,$_REQUEST['q']) !!}
                                                                        @endif

                                                                    @endif

                                                                        @if($_REQUEST['must_search'] != '')
                                                                            {!! highlight($skill->industry_functional_area_skill,$_REQUEST['must_search']) !!}
                                                                        @else 
                                                                            {!! highlight($skill->industry_functional_area_skill,$_REQUEST['q']) !!}
                                                                        @endif
                                                                    (Exp: {{$skill->experience_years}} years &amp; {{$skill->experience_months}} months)@if(!$loop->last), @endif
                                                                    @endforeach
                                                                    @endif
                                                                   @if(CRUDBooster::isUpdate() && $button_edit)
                                                                   <a class='glyphicon glyphicon-pencil' href='{{CRUDBooster::adminPath("candidate_industry_functional_area_skills?candidate_id=$row->id")}}' rel="Edit" target="_blank"></a>
                                                                   @endif
                                                                   </li>
                                                                </ul>
                                                             </div>
                                                     
                                                          </div>
                                                       </div>
                                                    </div>
                            
                                              </div>
                                              <div class="col-md-4">
                                                    <div class="row">
                                                       <div class="col-md-6 block_3">
                                                       <div class="row">
                                                             <div class="col-md-12">
                                                        @if(!empty($row->primary_phone))
                                                            <button type="button" class=""><span class="pad5"> <i class="fa fa-phone" aria-hidden="true"></i>
                                                            @if($_REQUEST['must_search'] != '')
                                                                    {!! highlight($row->primary_phone,$_REQUEST['must_search']) !!}
                                                                @else 
                                                                    {!! highlight($row->primary_phone,$_REQUEST['q']) !!}
                                                                @endif
                                                            </span></button>
                                                        @endif
                                                        @if(!empty($row->secondary_phone))
                                                            <button type="button" class=""><span class="pad5"> <i class="fa fa-phone" aria-hidden="true"></i>
                                                            @if($_REQUEST['must_search'] != '')
                                                                    {!! highlight($row->secondary_phone,$_REQUEST['must_search']) !!}
                                                                @else 
                                                                    {!! highlight($row->secondary_phone,$_REQUEST['q']) !!}
                                                                @endif
                                                            </span></button>
                                                        @endif
                                                            </div>
                                                            </div>
                                                           
                                                            <div class="row">
                                                             <div class="col-md-12" style="word-break: break-all;">
                                                        @if(!empty($row->primary_email))
                                                           <button type="button" class=""><span class="pad5"> <i class="fa fa-envelope" aria-hidden="true"></i>     
                                                           @if($_REQUEST['must_search'] != '')
                                                                {!! highlight($row->primary_email,$_REQUEST['must_search']) !!}
                                                            @else 
                                                                {!! highlight($row->primary_email,$_REQUEST['q']) !!}
                                                            @endif
                                                           </span></button>
                                                        @endif
                                                        @if(!empty($row->secondary_email))
                                                             <button type="button" class=""><span class="pad5"> <i class="fa fa-envelope" aria-hidden="true"></i>     
                                                             @if($_REQUEST['must_search'] != '')
                                                                    {!! highlight($row->secondary_email,$_REQUEST['must_search']) !!}
                                                                @else 
                                                                    {!! highlight($row->secondary_email,$_REQUEST['q']) !!}
                                                                @endif  
                                                             </span></button>
                                                        @endif
                                                            </div></div>

                                                       </div>
                                                       <div class="col-md-6 block_4">
                                                             <a href="/admin/candidates/generate_pdf/{{$row->id}}" >Generate Pdf <i class="fa fa-angle-right"></i></a>

                                                             <a type="button" data-toggle="modal" data-toggle="modal" data-target="#addToJobOrderModal{{ $row->id}}" style="margin-right: 6px;">Add To JobOrder <i class="fa fa-angle-right"></i></a>

                                                             @if($row->resume_url && Storage::exists($row->resume_url))
                                                             <div class="row">
                                                                <div class=col-md-12>
                                                                    <a class="download_resume" href="/{{$row->resume_url}}" target="_blank">Download Resume <i class="fa fa-angle-right"></i></a>
                                                                </div>
                                                             </div>
                                                        
                                                            @endif
                                                     
                                                                <!-- Modal Add To Joborder -->
                                                                <div id="addToJobOrderModal{{ $row->id}}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-add-to-job">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Add Candidate to Job Order</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="candidate-modal-content">
                                                                                    <div class="add-msg"></div>
                                                                                    <div class="candidate-modal-items">Select Any Job Order</div>
                                                                                    <div class="candidate-modal-items cand-jo-select">
                                                                                        <select class='form-control select2' name="jo_id">
                                                                                            <option value="0">Job Orders (Company)</option>

                                                                                            @foreach($jobOrders as $jobOrder)
                                                                                            <?php $companyName = \DB::table('companies')->find($jobOrder->company_id)->name; ?>
                                                                                            <option value="{{$jobOrder->id}}">   {{$jobOrder->id.'-'.$jobOrder->title.' ('.$companyName.')'}} </option>
                                                                                            @endforeach

                                                                                        </select>
                                                                                    </div>
                                                                                    <?php $name=str_replace(array("'"), "\'",$row->first_name.' '.$row->last_name)?>
                                                                                    <div class="candidate-modal-items">
                                                                                        <button type="button" class="btn btn-success" id="addTojobOrderBtn" onclick="addTojobOrder({{ $row->id }}, '{{ $name }}')"> Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- End Modal -->
                                                              

                                                             <a type="button" data-toggle="modal" data-toggle="modal" data-target="#emailToCandidate{{ $row->id}}">Mail To Candidate <i class="fa fa-angle-right"></i></a>

                                                                 <!-- Modal Send Email -->
                                                                <div id="emailToCandidate{{ $row->id}}" class="modal fade close-check" role="dialog">
                                                                    <div class="modal-dialog">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close close-btn" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Send Email to Candidate</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="candidate-modal-content">
                                                                                    <div class="single-send-msg"><p></p></div>
                                                                                    <div class="candidate-modal-items"> Select Email Template
                                                                                    </div>
                                                                                    <div class="candidate-modal-items">
                                                                                        <select name="email_template_id" id="email_template_id" onchange="getMailContent({{ $row->id}})">
                                                                                            <option value=" ">Select Email Template</option>
                                                                                            <option value="mail_to_candidate">Mail To Candidate</option>
                                                                                            <option value="interview_call_letter">Interview Call Letter F2F</option>
                                                                                            <option value="interview_call_letter_telephonic">Interview Call Letter Telephonic</option>
                                                                                            <option value="interview_call_letter_skype">Interview Call Letter Skype</option>
                                                                                            <option value="send_jd">Send JD</option>
                                                                                            <option value="short_listed">Profile shortlisted for the interview</option>
                                                                                            <option value="profile_rejection">Profile rejection-C2W</option>
                                                                                            <option value="profile_rejection_client">Profile rejection-Client</option>
                                                                                            <option value="interview_turn">Interview - No Show</option>
                                                                                            <option value="joining_followup">Joining follow up mail</option>
                                                                                            <option value="offer_confirm">Offer confirmation mail</option>
                                                                                            <option value="update_resume">Request for Updated Resume</option>
                                                                                            <option value="congratulation_mail">Congratulation mail</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="job_order_show" style="display:none;">
                                                                                        <div class="candidate-modal-items"> Select Job Order
                                                                                        </div>
                                                                                        <div class="candidate-modal-items">
                                                                                            <select name="joborder_id" id="joborder_id" onchange="getMailContent({{ $row->id}})">
                                                                                                <option value="">Select Job Orders</option>
                                                                                                @if($row->totalAssociation > 0)
                                                                                                @foreach($row->latestAssociation as $jo)
                                                                                                <option value="{{$jo->job_order_id}}">  
                                                                                                    {{ $jo->job_order_id.'-'. $jo->title.' (Current Status-'.$jo->secondary_status.')'}}
                                                                                                </option>
                                                                                                @endforeach
                                                                                                @endif

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="subject" style="display: none" >
                                                                                        <div class="candidate-modal-items">Subject:
                                                                                        </div>
                                                                                        <div class="candidate-modal-items">
                                                                                        <input type="text" class="col-md-12 subject-content"  name="subject" value=""/>
                                                                                        </div><br/>
                                                                                    </div>
                                                                                    <div class="mode_of_interview" style="display: none">
                                                                                        <div class="candidate-modal-items">Mode Of Interview:
                                                                                        </div>
                                                                                        <div class="candidate-modal-items">
                                                                                        <select name="interview_mode" class="interview_mode col-md-6">
                                                                                        <option value=" ">Select Interview Mode</option>
                                                                                        <option value="Face To Face">Face To Face</option>
                                                                                        <option value="Skype">Skype</option>
                                                                                        <option value="Telephonic">Telephonic</option></select>
                                                                                        </div><br/>
                                                                                    </div>
                                                                                    <div contenteditable="true" placeholder="Mail content here" class="mail_content" 
                                                                                    id="mail_content">
                                                                                
                                                                                    </div>
                                                                                    <div class="candidate-modal-items">
                                                                                        <button type="button" class="btn btn-success" id="sendToCandidate" onclick="sendToCandidate({{ $row->id}})"> Submit</button>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- End Modal -->  

                                                             
                                                       </div>
                                                    </div>
                                              </div>
                                               
                            
                                           </div>
                            
                            
                                           <div class="row" style="margin-top:1px;font-size:14px">
                                                 <ul style="list-style: none;padding-right: 4px;padding-left: 5px;margin-bottom:5px;margin-left: 15px;">
                                                    <li><b>Industry :</b>

                                                        @foreach($row->candidate_industries as $industry)
                                                        @if($_REQUEST['must_search'] != '')
                                                                {!! highlight($industry->industry,$_REQUEST['must_search']) !!}
                                                            @else 
                                                                {!! highlight($industry->industry,$_REQUEST['q']) !!}
                                                            @endif                                                              @if(!$loop->last), @endif
                                                        @endforeach
                                                        @if(CRUDBooster::isUpdate() && $button_edit)
                                                           <a class='glyphicon glyphicon-pencil' href='{{CRUDBooster::adminPath("candidate_industries?candidate_id=$row->id")}}' rel="Edit" target="_blank"></a>
                                                        @endif
                                                    
                                                    </li>
                                                 </ul>
                                           </div>



                                        @if($row->totalAssociation > 0)
                                        
                                        <div class="panel-group col-lg-12" id="accordion" style="padding: 0px;margin-top: 5px;">
                                            <div class="panel panel-default" >
                                              <div class="panel-heading">
                                                <h4 class="panel-title" style="font-size: 12px;">
                                                  <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#assoc_collapse_{{$row->id}}" aria-expanded="false">
                                                    <b>TOTAL ASSOCIATIONS ({{$row->totalAssociation}})</b>
                                                  </a>
                                                </h4>
                                              </div>
                                              <div id="assoc_collapse_{{$row->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body" style="font-size: 11px;">
                          
                                                    <div class="row">
                                                        <div class="col-md-12"> 
                                                            <table class="table-candidate-details" width="100%">
                                                                <tbody><tr>
                                                                    <th width="15%">Title</th>
                                                                    <th width="20%">Company</th>
                                                                    <th width="20%">Office</th>
                                                                    <th width="10%">Owner</th>
                                                                    <th width="10%">Added On</th>
                                                                    <th width="10%">Current Status</th>
                                                                </tr>
                                                                @foreach($row->latestAssociation as $jo) 
                                                                <?php 
                                                                $creator= DB::table('job_order_applicant_statuses')
                                                                ->where('job_order_applicant_id', $jo->applicant_id)
                                                                ->orderBy('id', 'desc')
                                                                ->first();
                                                                $recruiter = \DB::table('cms_users')->find( $creator->creator_id); ?>
                                                                <tr>
                                                                    <td><a href='/admin/job_order_applicants?job_order_id={{$jo->job_order_id}}'>{{ $jo->title }}</a></td>
                                                                    <td>
                                                                        @if(CRUDBooster::myPrivilegeId()==4)
                                                                        <!-- <a href='/admin/companies/detail/{{$jo->company_id}}'>-->{{ $jo->company }}<!-- </a> -->
                                                                        @else
                                                                        <a href='/admin/companies/detail/{{$jo->company_id}}'>{{ $jo->company }}</a>
                                                                    @endif</td>
                                                                    <!-- <td><a href='/admin/companies/detail/{{$jo->company_id}}'>{{ $jo->company }}</a></td> -->
                                                                    <td><!-- <a href='/admin/offices/detail/{{$jo->office_id}}'> -->{{ $jo->office }}<!-- </a> --></td>
                                                                    <td><!-- <a href='/admin/users/detail/{{$recruiter->id}}'> -->{{ $recruiter->name }}<!-- </a> --></td>
                                                                    <td>{{ date("d/m/Y", strtotime($jo->addedOn)) }}</td>
                                                                    <td>{{ $jo->secondary_status }}</td>
                                                                </tr>
                                                                @endforeach
                                                            
                                                              </tbody>
                                                          </table>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </div>


                                       @endif
                            
                                        
                            
                                     </div>

                                     @endforeach


     


</tbody>
</table>
</div>
</div>
</div>

<!-- ADD A PAGINATION -->
<?php 
if(count($result)!=0)
{
?>
<p>{!!$result->appends(Request::all())->render()!!}</p>
                 
<?php
}
?>
@endsection
@push('bottom')
<style>
    .mail_body{
        border: 1px solid #bbb;
        padding: 6px 10px;
    }
    .hint {
        background: #fbfbfb;
        padding: 8px 28px;
        font-size: 98%;
        text-align:justify;
    }
    .mail_content {
        pointer-events: none;
    }
    .c_mail_content{
        pointer-events: none;
    }
    @-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
@include('override.candidates._scripts')
<script type="text/javascript">

    $(window).on('load', function(event) {
        $('#preloader').delay(500).fadeOut(500);
    });


    $("#minExpY").keyup(function(event) {
        var val = this.value;
   
        var result = val.split('.');
            
            if(result[0] <= 100){
                if(result[1] == 0 || result[1] > 12){
                var newVal = result[0];
                }else{
                var newVal = val;
                }
            }else{
                var newVal = '';
            }


        this.value = newVal;
    });

    $("#maxExpY").keyup(function(event) {
        var val = this.value;

        var result = val.split('.');
           
           if(result[0] <= 100){
               if(result[1] == 0 || result[1] > 12){
               var newVal = result[0];
               }else{
               var newVal = val;
               }
           }else{
               var newVal = '';
           }

        this.value = newVal;
    });

    $("#minCtc").keyup(function(event) {
        var val = this.value;

        if(!/[^a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val)){
            var newVal = '';
        }else{
            var newVal = val;
        }
        this.value = newVal;
    });

    $("#maxCtc").keyup(function(event) {
        var val = this.value;

        if(!/[^a-zA-Z!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val)){
            var newVal = '';
        }else{
            var newVal = val;
        }
        this.value = newVal;
    });


    function getUgQualification(type,id){

           $('.qualifyUgBtn').removeClass('selectedBtn');
           var ugButtonClick = $('#ugButtonClick').val();


            if(ugButtonClick == ''){
                $('#ugQualification').val(type);
                $('#'+id).addClass('selectedBtn');
                $('#ugButtonClick').val(type);

                if(type == 'specific'){
                    $('#ug_qualification_id').show();
                }else{
                    $('#ug_qualification_id').hide();
                }

            }else{
                if(ugButtonClick == type){
                    $('#ugQualification').val('');
                    $('#'+id).removeClass('selectedBtn');
                    $('#ugButtonClick').val('');

                    if(type == 'specific'){
                        $('#ug_qualification_id').hide();
                    }
                }else{
                    $('#ugQualification').val(type);
                    $('#'+id).addClass('selectedBtn');
                    $('#ugButtonClick').val(type);

                    if(type == 'specific'){
                        $('#ug_qualification_id').show();
                    }else{
                        $('#ug_qualification_id').hide();
                    }
                }
            }
  

    }

    function getPgQualification(type,id){

           $('.qualifyPgBtn').removeClass('selectedBtn');
           var pgButtonClick = $('#pgButtonClick').val();

           if(pgButtonClick == ''){
                $('#pgQualification').val(type);
                $('#'+id).addClass('selectedBtn');
                $('#pgButtonClick').val(type);

                if(type == 'specific'){
                    $('#pg_qualification_id').show();
                }else{
                    $('#pg_qualification_id').hide();
                }

            }else{
                if(pgButtonClick == type){
                    $('#pgQualification').val('');
                    $('#'+id).removeClass('selectedBtn');
                    $('#pgButtonClick').val('');

                    if(type == 'specific'){
                        $('#pg_qualification_id').hide();
                    }
                }else{
                    $('#pgQualification').val(type);
                    $('#'+id).addClass('selectedBtn');
                    $('#pgButtonClick').val(type);

                    if(type == 'specific'){
                        $('#pg_qualification_id').show();
                    }else{
                        $('#pg_qualification_id').hide();
                    }
                }
            }
    }

    function getSpecificQualification(value,type){
       
        if(type == 'ug'){
            $('#ugQualification').val(value);
        }else if(type == 'pg'){
            $('#pgQualification').val(value);
        }
    }

    function removeSearch(key,value){
         
         if(key == 'q'){
           
           var oldSearchKey = "{{$_REQUEST['q']}}";
           let myArray = oldSearchKey.split(",");
 
           const index = myArray.indexOf(value);
            if (index > -1) {
                myArray.splice(index, 1);
            }

            var newSearchKey = myArray.toString();
            var url = new URL(location.href);
            var search_params = url.searchParams;

            if(newSearchKey != ''){
                search_params.set('q', newSearchKey);
            }else{
                search_params.delete('q')
            }

            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;

        }else if(key == 'must_search'){

            var oldSearchKey = "{{$_REQUEST['must_search']}}";
            let myArray = oldSearchKey.split(",");
 
           const index = myArray.indexOf(value);
            if (index > -1) {
                myArray.splice(index, 1);
            }

            var newSearchKey = myArray.toString();
            var url = new URL(location.href);
            var search_params = url.searchParams;

            if(newSearchKey != ''){
                search_params.set('must_search', newSearchKey);
            }else{
                search_params.delete('must_search')
            }

            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;

        }else if(key == 'location'){
           
           var oldSearchKey = "{{$_REQUEST['location']}}";
           let myArray = oldSearchKey.split(",");
 
           const index = myArray.indexOf(value);
            if (index > -1) {
                myArray.splice(index, 1);
            }

            var newSearchKey = myArray.toString();
            var url = new URL(location.href);
            var search_params = url.searchParams;

            if(newSearchKey != ''){
                search_params.set('location', newSearchKey);
            }else{
                search_params.delete('location')
            }

            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;

        }else if(key == 'designation'){
           
           var oldSearchKey = "{{$_REQUEST['designation']}}";
           let myArray = oldSearchKey.split(",");
 
           const index = myArray.indexOf(value);
            if (index > -1) {
                myArray.splice(index, 1);
            }

            var newSearchKey = myArray.toString();
            var url = new URL(location.href);
            var search_params = url.searchParams;

            if(newSearchKey != ''){
                search_params.set('designation', newSearchKey);
            }else{
                search_params.delete('designation')
            }

            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;

        }else if(value == ''){

            var url = new URL(location.href);
            var search_params = url.searchParams;
            search_params.delete(key);
            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;

         }
    }



    window.onload = function() {
        $('.select2').select2();
    //$('.js-example-basic-multiple').select2();
    // functionalAreaSkills('');
    $("#mailToMultipleCandidates").hide();
    $("#addMultipleCandidatesToJobOrder").hide();
    $("#downloadResume").hide();
    $('#functional_area_skills').select2({
        placeholder: "Select Functional Skills",
        allowClear: true
    });

    $('#functional_area_role').select2({
        placeholder: "Select Functional Roles",
        allowClear: true,
    });

    $('#functional_area_role').on('change', function (evt) {
        $('.select2-selection__choice').removeAttr('title');
    });
    $('.close-check').on('hidden.bs.modal', function () {
            location.reload();
    });

    $('#location').select2({
        createSearchChoice: function (term) {
           console.log('hi');
       }
    });

    // $('#designation').select2();

    

    $('#location').on('change', function() {
      var selections = $("#location").select2('data');

        var Values = new Array();
        for (var i = 0; i < selections.length; i++) {
            if (selections[i].id) {
                var split_data = selections[i].id;
                var data = split_data.split("-");
                Values.push(data[0]);
            }
        }
        $('#selected_location').val(Values);
    })

    // $('#designation').on('change', function() {
    //   var selections = $("#designation").select2('data');

    //     var Values = new Array();
    //     for (var i = 0; i < selections.length; i++) {
    //         if (selections[i].id) {
    //             var split_data = selections[i].id;
    //             Values.push(split_data);
    //         }
    //     }
    //     $('#designations').val(Values);
    // })


            /*$('.cand-jo-select').each(function(){
                $('.select2').select2();
            });*/

            $("#reset_search").click(function(){
                //$('#search-form').submit();
                //$('#search-form')[0].reset();
                // $(':input','#search-form')
                //.not(':button, :submit, :reset, :hidden')
                //.val('')
                //.removeAttr('checked')
                //.removeAttr('selected');
                //$('#search-form input[type="text"]').val('');
                //$('#search-form select').val('');
                //$('input[type="text"], textarea').val('');
                //$('#search-form').find('input[type=text], select').val('');
                $( "select[name='functional_area']" ).val( " " );
                $('li.select2-selection__choice').remove();
                $('#functional_area_skills').select2({
                    placeholder: 'Select Functional Skills',
                });
                $('#functional_area_role').select2({    
                    placeholder: 'Select Functional Roles',
                });

                $('form[method="get"]').find(':input').not(':button, :submit, :reset, :hidden')
                .each(function() {
                    var inp = $(this);
                    if (inp.val()) {
                        inp.val('');
                    }
                    var uri = window.location.href.toString();
                    if (uri.indexOf("?") > 0) {
                        var clean_uri = uri.substring(0, uri.indexOf("?"));
                        window.history.replaceState({}, document.title, clean_uri);
                    }
                    $("#reset_search").attr("disabled", true);

                });

                window.location = window.location;   

            });
        };

        function showButtons() {

            
            if($("input[name='cid[]']").is(":checked")) {
                $("#mailToMultipleCandidates").show();
                $("#addMultipleCandidatesToJobOrder").show();
            }
            else {
                $("#mailToMultipleCandidates").hide();
                $("#addMultipleCandidatesToJobOrder").hide();
            }
        }

        // function functionalAreaSkills(functional_area_id) {
        //     $.get('{{CRUDBooster::mainpath()}}', {
        //         functional_area_id: functional_area_id,
        //         current_action: 'list_functional_area_skills',
        //     }, function(_dataSkills) {
        //         var select = $('form select[name= functional_area_skills]');
        //         select.empty();
        //         select.append('<option value="">Functional Area Skills</option>');
        //         $.each(_dataSkills,function(key, value) {
        //             select.append("<option value='" + value.id+"-"+value.name + "'>" + value.name + "</option>");
        //         });
        //     });
        // }

        function listFunctionalAreaRolesAndSkills(functional_area_id) {
            $.get('{{CRUDBooster::mainpath()}}', {
                functional_area_id: functional_area_id,
                current_action: 'list_functional_roles_skills',
            }, function(_dataFunctionalArea) {
                var selectRoles = $('#functional_area_role');
                selectRoles.empty();
                $.each(_dataFunctionalArea['roles'],function(key, value) {
                    selectRoles.append("<option value='" + value.id+"--"+value.name + "'>" + value.name + "</option>");
                });

                var select = $('#functional_area_skills');
                // console.log(select);
                select.empty();
                $.each(_dataFunctionalArea['skills'],function(key, value) {
                    select.append("<option value='" + value.id+"--"+value.name + "'>" + value.name + "</option>");
                });
            });
        }


        function addTojobOrder(candidate_id, _cname) {
            $( "div.add-msg" ).text("");
            if($("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val() == 0 ) {
                $( "div.add-msg" ).text( "No Job Order Selected!!" );
                return false;
            }
            $.get('{{CRUDBooster::mainpath()}}', {
                candidate_id: candidate_id,
                job_order_id: $("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val(),
                current_action: 'add_to_joborder',
            }, function(_data) {
             

                if(_data=='mainfailed1') {
                    $( "div.add-msg" ).html( "<div class='text-danger'>No Openings Available and Candidate '"+_cname+"' cannot be added to Job Order.</div>" );
                }
                if(_data=='mainfailed2') {
                    $( "div.add-msg" ).html( "<div class='text-danger'>No Openings Available and Candidate '"+_cname+"' already assigned to Job Order.</div>" );
                }
                if(_data=='failed1') {
                    $( "div.add-msg" ).text( "Candidate '"+_cname+"' cannot be added to Job Order." );
                }
                if(_data=='failed2') {
                    $( "div.add-msg" ).html( "Candidate '"+_cname+"' already assigned to Job Order." );
                }
                if(_data=='success') {
                    $( "div.add-msg" ).html( "Candidate '"+_cname+"' added to the Job Order." );
                }
            });
        }

        function addCidsTojobOrder(){
            $( "div.add-msg" ).text("");

            if(!$('select[name="jo_c_id"]').find(":selected").val()) {
                $( "div.add-msg" ).text( "No Job Order Selected!!" );
                return false;
            }

            $(':checkbox:checked').each(function(i){
                var cid = $(this).val();
                var cname = $(this).data('name');
               // alert(cid);
                $.get('{{CRUDBooster::mainpath()}}', {
                    candidate_ids: $(this).val(),
                    job_order_id: $('select[name="jo_c_id"]').find(":selected").val(),
                    current_action: 'add_cids_to_joborder',
                }, function(_data) {
                    if(_data=='mainfailed1') {
                        $( "div.add-msg" ).append( "<div class='text-danger'>No Openings Available and Candidate '"+cname+"' cannot be added to Job Order.</div><br>" );
                    } 
                    if(_data=='mainfailed2') {
                        $( "div.add-msg" ).append( "<div class='text-danger'>No Openings Available and Candidate '"+cname+"' already assigned to Job Order.</div>" );
                    }     
                    if(_data=='failed1') {
                        $( "div.add-msg" ).append( "Candidate '"+cname+"' cannot be added to Job Order.<br>" );
                    }
                    if(_data=='failed2') {
                        $( "div.add-msg" ).append( "Candidate '"+cname+"' already assigned to Job Order.<br>" );
                    }
                    if(_data=='success') {
                        $( "div.add-msg" ).append( "Candidate '"+cname+"' added to the Job Order.<br>" );
                    }            
                });
            });
        }

        $('.close-btn').click(function(){
            location.reload();
        });

        function getMailContent(candidate_id) {
            $( "div.single-send-msg p" ).html(' ');
            $(".mail_content").html("");
            $(".mail_content").removeClass('mail_body hint');
            $(".job_order_show").hide();
            var email_slug=$("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val();
            if(email_slug=='mail_to_candidate')
            {       
                $("#emailToCandidate"+candidate_id).find(".subject").show();
                $("#emailToCandidate"+candidate_id).find(".mode_of_interview").hide();
                $('.mail_content').css({'pointer-events':'auto'});
                $(".mail_content").keydown(function(event) { 
                    return true;
                });
            }
            else{
                if(email_slug=='interview_turn'){
                    $("#emailToCandidate"+candidate_id).find(".mode_of_interview").show(); 
                }else{
                   $("#emailToCandidate"+candidate_id).find(".mode_of_interview").hide();  
                }
                $("#emailToCandidate"+candidate_id).find(".subject").hide();
                $('.mail_content').css({'pointer-events':'none'});
                /*$(".mail_content").keydown(function(event) { 
                    return false;
                });*/ 
            }

            if(email_slug=='interview_call_letter'||email_slug=='send_jd'||email_slug=='short_listed'||email_slug=='profile_rejection'||email_slug=='joining_followup'||email_slug=='offer_confirm'||email_slug=='interview_call_letter_telephonic'||email_slug=='interview_call_letter_skype'||email_slug=='profile_rejection_client'||email_slug=='interview_turn')
            {
                $(".job_order_show").show();
                var job_order_id= $("#emailToCandidate"+candidate_id).find('select[name="joborder_id"]').val();
                if(job_order_id){
                    $.get('{{CRUDBooster::mainpath()}}', {
                        job_order_id:job_order_id,
                        candidate_id: candidate_id,
                        email_template_id: $("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val(),
                        current_action: 'get_email_content',
                    }, function(_data) {
                        if(_data!=''){
                            $(".mail_content").addClass('mail_body hint');
                            $(".mail_content").html(_data);
                        }
                        else{
                            $(".mail_content").removeClass('mail_body hint');
                        } 
                    //$("div.mail_content").innerHTML = _data;

                });
                }
            }
            else{
                $.get('{{CRUDBooster::mainpath()}}', {
                    candidate_id: candidate_id,
                    email_template_id: $("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val(),
                    current_action: 'get_email_content',
                }, function(_data) {
                    if(_data!=''){
                        $(".mail_content").addClass('mail_body hint');
                        $(".mail_content").html(_data);
                    }
                    else{
                        $(".mail_content").removeClass('mail_body hint');
                    } 
                    //$("div.mail_content").innerHTML = _data;

                });
            }
        }

        function sendToCandidate(candidate_id) {
            $( "div.single-send-msg p" ).html(' ');
            var mailcontent=$("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val();
            var job_order_id= $("#emailToCandidate"+candidate_id).find('select[name="joborder_id"]').val();
            var email_slug=$("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val();
            var contact=$("#emailToCandidate"+candidate_id).find('.mail_content table.contact-table').find('td.contact-details').html();
            var venue=$("#emailToCandidate"+candidate_id).find('.mail_content table.contact-table').find('td.venue').html();
            var interview_mode=$("#emailToCandidate"+candidate_id).find('select[name="interview_mode"]').val();
            if(email_slug=='interview_call_letter'||email_slug=='send_jd'||email_slug=='short_listed'||email_slug=='profile_rejection'||email_slug=='joining_followup'||email_slug=='offer_confirm'||email_slug=='interview_call_letter_telephonic'||email_slug=='interview_call_letter_skype'||email_slug=='profile_rejection_client'||email_slug=='interview_turn'||email_slug=='profile_rejection_client'){
                if(mailcontent!=0&&job_order_id!=0){
                     if(interview_mode==" "&& email_slug=='interview_turn'){
                        $( "div.single-send-msg p" ).html('No Mode of Interview Selected!');
                        return false;
                    }
                    $('#loadindDiv').show();
                    $.post('{{CRUDBooster::mainpath()}}', {
                        job_order_id:job_order_id,
                        candidate_id: candidate_id,
                        contact:contact,
                        venue:venue,
                        interview_mode:interview_mode,
                        email_template_id:$("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val(),
                        current_action: 'email_to_candidate',
                    }, function(_data) {
                        if(_data=='OK') {
                            //$( "div.single-send-msg p" ).append('<strong>Mail!</strong> Successfully sent to the Candidate.');
                            alert("Mail send Successfully!..");
                            window.location.reload();
                            $('#loadindDiv').hide();
                        }

                    });
                }
                else{
                    if(!mailcontent)
                    {
                        $( "div.single-send-msg p" ).html('No Email Template Selected!');
                    } 
                    if(!job_order_id)
                    {
                        $( "div.single-send-msg p" ).html('No JobOrder Selected!');    
                    }  
                }
            }
            else{
                if(mailcontent!=0){
                    if(email_slug=='mail_to_candidate')
                    {
                        var comment=$("#emailToCandidate"+candidate_id).find('#mail_content').html(); 
                        var subject=$("#emailToCandidate"+candidate_id).find('.subject .subject-content').val();
                        if(subject=="") {
                          
                          $( "div.single-send-msg p" ).html('No Subject Added!');
                          return false;
                        }
                    }
                    $('#loadindDiv').show();
                    $.post('{{CRUDBooster::mainpath()}}', {
                        candidate_id: candidate_id,
                        comment: comment,
                        subject:subject,
                        email_template_id:$("#emailToCandidate"+candidate_id).find('select[name="email_template_id"]').val(),
                        current_action: 'email_to_candidate',
                    }, function(_data) {
                        if(_data=='OK') {
                            //$( "div.single-send-msg p" ).append('<strong>Mail!</strong> Successfully sent to the Candidate.');
                             alert("Mail send Successfully!..");
                             window.location.reload();
                             $('#loadindDiv').hide();
                        }

                    });
                }
                else{
                    $( "div.single-send-msg p" ).html('No Email Template Selected!');

                }  
            }
        }

        function getMailContentMultiCandidates() {
            $( "div.single-send-msg p" ).html(' ');
            $(".c_mail_content").html("");
            $(".c_mail_content").removeClass('mail_body hint');
            var email_slug=$("#emailToMultipleCandidates").find('select[name="c_email_template_id"]').val();
            if(email_slug=='mail_to_candidate')
            {
                $("#emailToMultipleCandidates").find(".subject").show();
                $('.c_mail_content').css({'pointer-events':'auto'});
                $(".c_mail_content").keydown(function(event) { 
                    return true;
                });
            }
            else{
                $("#emailToMultipleCandidates").find(".subject").hide();
                $('.c_mail_content').css({'pointer-events':'none'});
                /*$(".c_mail_content").keydown(function(event) { 
                    return false;
                });*/ 
            }
            $(':checkbox:checked').each(function(i){
                var cid = $(this).val();
                $.get('{{CRUDBooster::mainpath()}}', {
                    candidate_ids: $(this).val(),
                    email_template_id: $("#emailToMultipleCandidates").find('select[name="c_email_template_id"]').val(),
                    current_action: 'get_multiple_email_content',
                }, function(_data) {
                    if(_data!=''){
                        $(".c_mail_content").addClass('mail_body hint');
                        $(".c_mail_content").html(_data);
                    }
                    else{
                        $(".c_mail_content").removeClass('mail_body hint');
                    }             
                });
            });
        }

        function sendToMultipleCandidate() {
            $( "div.single-send-msg p" ).html(' ');
            var mailcontent=$("#emailToMultipleCandidates").find('select[name="c_email_template_id"]').val();
            if(mailcontent!=0){
                if(mailcontent=='mail_to_candidate'){
                    var comment=$("#emailToMultipleCandidates").find('#c_mail_content').html();
                    var subject=$("#emailToMultipleCandidates").find('.subject .subject-content').val();
                        if(subject=="") {   
                          $( "div.single-send-msg p" ).html('No Subject Added!');
                          return false;
                        }  
                }
                $('#loadindDiv').show();
                var checkboxCount=$('input[type="checkbox"]:checked').length-1;
                $(':checkbox:checked').each(function(i){
                    var cid = $(this).val();
                    var cname = $(this).data('name');
                    $.post('{{CRUDBooster::mainpath()}}', {
                        candidate_id: $(this).val(),
                        comment: comment,
                        subject:subject,
                        email_template_id: $("#emailToMultipleCandidates").find('select[name="c_email_template_id"]').val(),
                        current_action: 'multiple_email_to_candidates',
                    }, function(_data) {
                        if(_data=='OK') {
                            if(checkboxCount==i){
                                alert("Mail send Successfully!..");
                                window.location.reload();
                                $('#loadindDiv').hide(); 
                            }
                            //$( "div.single-send-msg p" ).append("<strong>Mail!</strong> Successfully sent to the "+cname+" Candidate.<br>");
                            //alert("Mail send Successfully!..");
                            //window.location.reload();
                            //$('#loadindDiv').hide();
                        }

                    });
                });
                
            }
            else{
                $( "div.single-send-msg p" ).html('No Email Template Selected!'); 
            }

        }



        function changeLimit(limit){


            var url = new URL(location.href);
            var search_params = url.searchParams;
            if(limit != ''){
                search_params.set('limit', limit);
            }else{
                search_params.delete('limit')
            }
            url.search = search_params.toString();
            var newUrl = url.toString();

            window.location.href = newUrl;

        }

        function changeActiveInDays(val){

            var url = new URL(location.href);
            var search_params = url.searchParams;
            if(val != ''){
                search_params.set('active_in', val);
            }else{
                search_params.delete('active_in')
            }
            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;


        }


        function changeSort(val){

            var url = new URL(location.href);
            var search_params = url.searchParams;
            if(val != ''){
                search_params.set('order', val);
            }else{
                search_params.delete('order')
            }
            url.search = search_params.toString();
            var newUrl = url.toString();
            window.location.href = newUrl;

        }

  

        function checkAll(isChecked) {

            
            if(isChecked) {
                
                $('input[name="cid[]"]').each(function() { 
                    this.checked = true; 
                });
                $("#mailToMultipleCandidates").show();
                $("#addMultipleCandidatesToJobOrder").show();
                $("#downloadResume").show();

            } else {
                $('input[name="cid[]"]').each(function() {
                    this.checked = false;
                });
                $("#mailToMultipleCandidates").hide();
                $("#addMultipleCandidatesToJobOrder").hide();
                $("#downloadResume").hide();
            }
        }

        function submit(){
            console.log('hi');
        }


       
     </script>


 @endpush