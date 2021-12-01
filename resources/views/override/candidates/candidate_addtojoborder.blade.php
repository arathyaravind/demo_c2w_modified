
    @include('override.candidates._styles')

  
<a type="button" class="btn btn-success" id="mailToMultipleCandidates" data-toggle="modal" data-toggle="modal" data-target="#addToJobOrderModal{{ $id}}" style="margin-right: 6px;">Add To Joborder</a>


  <!-- Modal Add To Joborder -->
  <div id="addToJobOrderModal{{ $id}}" class="modal fade" role="dialog">
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
                                                                                            <?php                                                                       	
			$jobOrders=DB::table('job_orders')->get();?>
                                                                                            @foreach($jobOrders as $jobOrder)
                                                                                            <?php $companyName = \DB::table('companies')->find($jobOrder->company_id)->name; ?>
                                                                                            <option value="{{$jobOrder->id}}">   {{$jobOrder->id.'-'.$jobOrder->title.' ('.$companyName.')'}} </option>
                                                                                            @endforeach





                 

                                                                                        </select>
                                                        
                                                                                    <div class="candidate-modal-items">
                                                                                        <button type="button" class="btn btn-success" id="addTojobOrderBtn" onclick="addTojobOrder({{ $id }}, '{{ $name }}')"> Submit</button>
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


   






    window.onload = function() {
        $('.select2').select2();
  

        };



 

   


        function addTojobOrder(candidate_id, _cname) {
           var job_order_id = $("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val();
          // alert(job_order_id);
            $( "div.add-msg" ).text("");
            if($("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val() == 0 ) {
                $( "div.add-msg" ).text( "No Job Order Selected!!" );
                return false;
            }
           // alert(candidate_id);
           $.post('/candidate/add-to-joborder', {
           // $.get('{{CRUDBooster::mainpath()}}', {
                candidate_id: candidate_id,
                job_order_id: $("#addToJobOrderModal"+candidate_id).find('select[name="jo_id"]').val(),
                current_action: 'add_to_joborder',
            }, function(_data) {
                //alert(_data);

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

        

        function submit(){
            console.log('hi');
        }


       
     </script>


 @endpush