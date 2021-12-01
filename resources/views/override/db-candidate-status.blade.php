<div class="panel-heading panel-hed-cus">Candidate Status</div>
<div class="panel-body">
    <form method ='get' class='row form-border'>
        <div class="form-group col-md-4 pad-rig5">
            <label for="">Date :</label>
            <input type="text" class="form-control date-picker" autocomplete="off" id="fromdate" value="{{$_REQUEST['fromDate']}}" name='fromDate'>
        </div>
        <div class="form-group col-md-3 to-input">
            <label for="">To :</label>
            <input type="text" class="form-control date-picker" autocomplete="off" id="todate" value="{{$_REQUEST['toDate']}}"name='toDate'>
        </div>
        <div class="form-group col-md-5 pad-lef0">
            <label for="">Owner :</label>
            <select class="form-control" name="recruiter" id="recruiter">
                <option value=""> Select Owner</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->id }}"{{ $_REQUEST['recruiter'] == $owner->id ? 'selected' : ''}}>{{$owner->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 align-right">
            <button type="button" id="btn_candidate_status" class="btn btn-primary">Submit</button>
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        </div>
    </form>
    <div class="applicant-process-details-container col-md-12">
        <div class="row list-candidate">
            <div class='col-md-6 pad0 candidate-sta'>
                <a href ="/admin/dashboard-add-candidates?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Candidates Added
                </a>
            </div>
            <div class="col-md-6">
                <div class="numberCircle1">{{ $data['candidatesAdded'] }}</div>
            </div>
        </div>
        <div class="row list-candidate">
            <div class='col-md-6 pad0 candidate-sta'>
                <a href ="/admin/dashboard-candidates-submission?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Submission
                </a>
            </div>
            <div class="col-md-6">
                <div class="numberCircle1">{{ $data['submission'] }}</div>
            </div>
        </div>
        <div class="row list-candidate">
            <div class='col-md-6 pad0 candidate-sta'>
                <a href ="/admin/interview-candidates-scheduled?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Interview Scheduled
                </a>
            </div>
            <div class="col-md-6">
                <div class="numberCircle1">{{ $data['interviewScheduled'] }}</div>
            </div>
        </div>
        <div class="row list-candidate">
            <div class="col-md-3 pad0 candidate-sta">
                <a href ="/admin/interview-done-candidates?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Interview Done
                </a>
            </div>
            <div class="col-md-3">
                <div class="numberCircle1">{{ $data['interviewsDone'] }}</div>
            </div>
            <div class="col-md-3 pad0 candidate-sta">
                <a href ="/admin/interview-backout-candidates?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Interview Backout
                </a>
            </div>
            <div class ="col-md-3">
                <div class="numberCircle1">
                    {{ $data['interviewsBackout'] }}
                </div>
            </div>
        </div>
        <div class="row list-candidate">
            <div class='col-md-3 pad0 candidate-sta'>
                <a href ="/admin/offer-candidates-scheduled?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Offer Made
                </a>
            </div>
            <div class="col-md-3">
                <div class="numberCircle1">{{ $data['offerMade'] }}</div>
            </div>
            <div class="col-md-3 pad0 candidate-sta">
                <a href ="/admin/rejected-candidates?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Rejected
                </a>
            </div>
            <div class ="col-md-3">
                <div class="numberCircle1">{{ $data['rejected'] }}</div>
            </div>
        </div>

        <div class="row list-candidate">
            <div class='col-md-3 pad0 '>
                <a href ="/admin/joining-candidates?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Joining
                </a>
            </div>
            <div class="col-md-3">
                <div class="numberCircle1">{{ $data['joining'] }}</div>
            </div>
            <div class="col-md-3 pad0">
                <a href ="/admin/backout-candidates?fromDate={{$_REQUEST['fromDate']}}&toDate={{$_REQUEST['toDate']}}&recruiter={{$_REQUEST['recruiter']}}" target="_blank" class="bold-black">
                    Backouts
                </a>
            </div>
            <div class ="col-md-3">
                <div class="numberCircle1">{{ $data['joiningBackout'] }} </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.date-picker').datepicker({
        // format: 'yyyy-mm-dd',
        format: 'dd/mm/yyyy',
    });
    $(document).find('#btn_candidate_status').on('click', function() {
        var query = {
            fromDate: $(document).find("#fromdate").val(),
            toDate: $(document).find("#todate").val(),
            recruiter: $(document).find("#recruiter").val()
        }
        $.get("/admin/db-candidate-status?" + $.param(query), function(_result) {
            $('#db-candidate-status').html(_result);
        });
    });
</script>
