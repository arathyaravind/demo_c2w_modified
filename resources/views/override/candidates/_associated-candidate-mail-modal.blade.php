 <!-- Modal Send Email -->
                                        <div id="emailToCandidate{{$jo->job_order_id}}" class="modal fade close-check" role="dialog">
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
                                                            <select name="email_template_id" id="email_template_id" onchange="getMailContent({{$jo->candidate_id}},{{$jo->job_order_id}})">
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
                                                        </select>
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
                                                        <div contenteditable="true" placeholder="Mail content here" class="mail_content" id="mail_content">
                                                        </div>
                                                        <div class="candidate-modal-items">
                                                    <button type="button" class="btn btn-success" id="sendToCandidate" onclick="sendToCandidate({{
                                                    	$jo->candidate_id}},{{$jo->job_order_id}})"> Submit</button>
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
                                         <!-- End Modal -->
                                        <div id='loadindDiv' style="position: fixed; width: 100%; height: 100%; background: rgba(4, 4, 4, 0.6); top: 0; left: 0; z-index: 10000; text-align: center; display: none;">
  <div style="border-top: 16px solid #49a9c5; border-bottom: 16px solid #005495; border-radius: 50%; width: 105px; height: 105px; animation: spin 2s linear infinite; margin-top: 20%; margin-left: 45%; -webkit-animation: spin 2s linear infinite;"></div>
  {{-- <img src="{{URL::asset('images/loading.gif')}}" style="margin-top: 15%; width: 150px;"> --}}
  {{--  border: 16px solid rgba(104, 104, 104, 0);  --}}

</div>
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
.mail_content{
    pointer-events: none;
}
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome and Opera */
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
<script>
	function getMailContent(candidate_id,job_order_id) {
        $( "div.single-send-msg p" ).html(' ');
        $(".mail_content").html("");
        $(".mail_content").removeClass('mail_body hint');
        var email_template_id=$("#emailToCandidate"+job_order_id).find('select[name="email_template_id"]').val();
        if(email_template_id=='mail_to_candidate')
        {   
            $("#emailToCandidate"+job_order_id).find(".mode_of_interview").hide(); 
            $("#emailToCandidate"+job_order_id).find(".subject").show();
            $('.mail_content').css({'pointer-events':'auto'});
            $(".mail_content").keydown(function(event) { 
            return true;
            });
        }
        else{

         if(email_template_id=='interview_turn'){
                $("#emailToCandidate"+job_order_id).find(".mode_of_interview").show(); 
            }else{
               $("#emailToCandidate"+job_order_id).find(".mode_of_interview").hide();  
            }
         $("#emailToCandidate"+job_order_id).find(".subject").hide();
         $('.mail_content').css({'pointer-events':'none'});

        /* $(".mail_content").keydown(function(event) { 
            return false;
            });*/ 
        }
        $.get('/custom/email-send', {
            job_order_id:job_order_id,
            candidate_id: candidate_id,
            email_template_id: $("#emailToCandidate"+job_order_id).find('select[name="email_template_id"]').val(),
            current_action: 'get_email_content',
        }, function(_data) {
            if(_data!=''){
            $(".mail_content").addClass('mail_body hint noselect');
            $(".mail_content").html(_data);
            }
            else{
            $(".mail_content").removeClass('mail_body hint noselect');
            } 
            //$("div.mail_content").innerHTML = _data;
            
        });
        
    }
    function sendToCandidate(candidate_id,job_order_id) {
     $( "div.single-send-msg p" ).html(' ');
     var contact=$("#emailToCandidate"+job_order_id).find('.mail_content table.contact-table').find('td.contact-details').html();
     var venue=$("#emailToCandidate"+job_order_id).find('.mail_content table.contact-table').find('td.venue').html();
     var mailcontent=$("#emailToCandidate"+job_order_id).find('select[name="email_template_id"]').val();
     var interview_mode=$("#emailToCandidate"+job_order_id).find('select[name="interview_mode"]').val();
     var email_slug=$("#emailToCandidate"+job_order_id).find('select[name="email_template_id"]').val();
        if(mailcontent!=0){
        	if(mailcontent=='mail_to_candidate'){

            var comment=$("#emailToCandidate"+job_order_id).find('#mail_content').html(); 
            var subject=$("#emailToCandidate"+job_order_id).find('.subject .subject-content').val();
            if(subject=="") {
                $( "div.single-send-msg p" ).html('No Subject Added!');
                return false;
            }
            }
             if(mailcontent=="interview_turn"){
             if(interview_mode==" "){
                $( "div.single-send-msg p" ).html('No Mode of Interview Selected!');
                return false;
            }
           }
            $('#loadindDiv').show();
            $.post('/custom/email-send', {
                job_order_id:job_order_id,
                candidate_id: candidate_id,
                contact:contact,
                venue:venue,
                comment: comment,
                subject:subject,
                interview_mode:interview_mode,
                email_template_id:$("#emailToCandidate"+job_order_id).find('select[name="email_template_id"]').val(),
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
      

</script>