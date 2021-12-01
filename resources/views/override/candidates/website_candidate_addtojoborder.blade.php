<div id="addToJobOrderModal" class="modal fade" role="dialog">
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
                                                                                    <input type='hidden' name='candidateid' id="candidateid" />
                                                                                    <div class="candidate-modal-items cand-jo-select">
                                                                                    <select class='form-control select2' name="jo_id">
                                                                                            <option value="0">Job Orders (Company)</option>
                                                                                            <?php                                                                       	
			$jobOrders=DB::table('job_orders')->get();?>
                                                                                            @foreach($jobOrders as $jobOrder)
                                                                                            <?php $companyName = \DB::table('companies')->find($jobOrder->company_id)->name; ?>
                                                                                            <option value="{{$jobOrder->id}}">   {{$jobOrder->id.'-'.$jobOrder->title.' ('.$companyName.')'}} </option>
                                                                                            @endforeach





                 

                                                                                        </select>
                                                        
                                                                                    <div class="candidate-modal-items">
                                                                                        <button type="button" class="btn btn-success"  id="addCidsTojobOrderBtn" onclick="addCidsTojobOrder()"> Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <script type="text/javascript">

    $(window).on('load', function(event) {
        $('#preloader').delay(500).fadeOut(500);
    });


   






    window.onload = function() {
        $('.select2').select2();
  

        };



 

   

        function addCidsTojobOrder(){
          //var job_order_id =  $("#addToJobOrderModal").find('select[name="jo_id"]').val();
         // var candidate_id = $('#candidateid').val();
          //alert(candidate_id);
          //alert(job_order_id);
            $( "div.add-msg" ).text("");

            if($("#addToJobOrderModal").find('select[name="jo_id"]').val() == 0 ) {
                $( "div.add-msg" ).text( "No Job Order Selected!!" );
                return false;
            }
           

        
                 $.post('/candidate/add-to-joborder', {
                    candidate_id: $("#candidateid").val(),
                    job_order_id: $("#addToJobOrderModal").find('select[name="jo_id"]').val(),
                    current_action: 'add_to_joborder',
                }, function(_data) {
                  alert(_data);
                    if(_data=='mainfailed1') {
                        $( "div.add-msg" ).append( "<div class='text-danger'>No Openings Available and Candidate '"+candidate_id+"' cannot be added to Job Order.</div><br>" );
                    } 
                    if(_data=='mainfailed2') {
                        $( "div.add-msg" ).append( "<div class='text-danger'>No Openings Available and Candidate '"+candidate_id+"' already assigned to Job Order.</div>" );
                    }     
                    if(_data=='failed1') {
                        $( "div.add-msg" ).append( "Candidate '"+candidate_id+"' cannot be added to Job Order.<br>" );
                    }
                    if(_data=='failed2') {
                        $( "div.add-msg" ).append( "Candidate '"+candidate_id+"' already assigned to Job Order.<br>" );
                    }
                    if(_data=='success') {
                      //alert("okay");
                        $( "div.add-msg" ).append( "Candidate '"+candidate_id+"' added to the Job Order.<br>" );
                    }            
                });
          
        }

        

        function submit(){
            console.log('hi');
        }


       
     </script>