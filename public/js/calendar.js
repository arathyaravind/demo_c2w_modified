$(document).ready(function() {
    var eventFetchStatus = 1;
    var eventTypeArray = {};
    function getEvents(_start, _end, timezone, _callback) {
        eventTypeArray = {};
        eventFetchStatus = 0;
        $.ajax({
            url: "/custom/events?owner="+$('#owner').val()+"&status="+$('#status').val(),
            dataType: 'json',
            data: {
                start: _start.unix(),
                end: _end.unix()
            },
            success: function (_data) {
                var events = [];
                $.each(_data, function (idx, e) {
                    // var jobOrderUrl = '/admin/job_order_applicants?job_order_id=' + e.job_order_id;
                    var jobOrderUrl = '/admin/job_order_applicants?job_order_id=' + e.job_order_id +'&candidate_id='+ e.candidate_id;
                    if(e.candidate){
                        jobOrderUrl = jobOrderUrl+'&candidate_id='+e.candidate['id'];
                    }
                    events.push({
                        title: e.type + '<b>' + e.job_order_id + '</b>',
                        start: e.event_date,
                        url: jobOrderUrl,
                        raw: e
                    });
                    if(e.type in eventTypeArray) {
                        eventTypeArray[e.type] += 1;
                    } else {
                        eventTypeArray[e.type] = 1;
                    }
                });
                $('.event-stats-main').empty();
                var blockp; 
                var blockDiv; 
                if(Object.keys(eventTypeArray).length > 0) {
                    mainDiv = $('.event-stats-main');
                    blockp = $('<p/>').addClass('event-hed').text('Event Stats').appendTo(mainDiv);
                    blockDiv = $('<div>').addClass('row row-centered').appendTo(mainDiv);
                    $.each(eventTypeArray, function(eventType, eventCount) {
                        fdiv = $('<div onclick="setStatus(\''+eventType+'\')">').addClass('col-md-3 align-center col-centered-calender').attr('data-status',eventType).appendTo(blockDiv);
                        // fdiv = $('<div onclick="setStatus(\"'+eventType+'")">').addClass('col-md-3 align-center col-centered').attr('data-status',eventType).appendTo(blockDiv);
                        sdiv = $('<div>').addClass('calendar-count').appendTo(fdiv);
                        $('<h3/>').addClass('count align-center').text(eventCount).appendTo(sdiv);
                        $('<p/>').addClass('sub-text-count align-center').text(eventType).appendTo(sdiv);
                        $('</div>').appendTo(sdiv);
                        $('</div>').appendTo(fdiv);
                    });
                }
                _callback(events);
                eventFetchStatus = 1;
            }
        });
    }

    function renderEvent(_event, _element) {

        var holder = _element.find('.fc-content');

        _element.addClass(_event.raw.status);

        // clear it
        holder.empty();

        // type
        holder.append(
            $('<span/>').addClass('e-type').text(_event.raw.type)
                .append($('<span/>').addClass('e-assignees').text(_event.raw.assignees))
                .css("background-color", getStatusColour(_event.raw.type))
            // $('<span/>').addClass('e-type').text(_event.raw.type)
            //     .append($('<span/>').addClass('e-assignees').text(_event.raw.assignees))
            //     .css("background-color", _event.raw.colour)
        );

        // client
        holder.append($('<span/>').addClass('e-jo').text(_event.raw.company_name));

        // job order
        holder.append($('<span/>').addClass('e-jo').text(_event.raw.job_order_name));
        // holder.append($('<span/>').addClass('e-jo').text(_event.raw.job_order.title));

        // candidate
        holder.append($('<span/>').addClass('e-cand').text(_event.raw.candidate_name));
        // if(_event.raw.candidate) {
        //     holder.append($('<span/>').addClass('e-cand').text([_event.raw.candidate.first_name, _event.raw.candidate.last_name].join(' ')));
        // }

        //owner
        holder.append($('<span/>').addClass('e-jo').text(_event.raw.owner_name));
        // holder.append($('<span/>').addClass('e-jo').text('Owner: ' + ((_event.raw.owner == 'No owner')? 'No owner': _event.raw.owner.name)));
    }

    $('#calendar').fullCalendar({

        // value props
        // defaultView: 'basicWeek',
        defaultView: 'basicDay',
       // weekends: true,
       // hiddenDays: [0],
        allDaySlot: true,
        allDayText: "Day\nEvents",
        minTime: '09:00:00',
        maxTime: '19:00:00',
        height: 'auto',

        // function props
        events: getEvents,
        eventRender: renderEvent,

    });

    window.setInterval(function() {
        if(eventFetchStatus == 1) {
            $('#calendar').fullCalendar('refetchEvents');
        }
    },3000);
    // $('#calendar').fullCalendar('refetchEvents');
});

    // $('.event-stats-main .row-centered .col-centered').click(function(){
    function setStatus(_type){
        $('.filter-calendar #status').val(_type);
    }


function getStatusColour(_status) {
    var colour;
        switch(_status){
            case "Confirm Interview":
                colour = "#a0eac1";
            break;
            case "Submission":
                colour = "#e8d870";
            break;
            case "Intro Call":
                colour = "#e89b70";
            break;
            case "Set Interview":
                colour = "#d0b3ec";
            break;
            case "Call Back":
                colour = "#ef3c3c";
            break;
            case "Submit":
                colour = "#1e6b25";
            break;
            case "Get Submission Feedback":
                colour = "#73b70e";
            break;
            case "Interview Follow-up":
                colour = "#0d49bf";
            break; 
            case "Interview On Hold":
                colour = "rgb(208, 127, 127)";
            break;
            case "Offer Follow-up":
                colour = "rgba(3, 169, 244, 0.99)";
            break;
            case "Confirm Offer":
                colour = "#eb1bf5";
            break;
            case "Confirm Offer Follow-up":
                colour = "#585c5f";
            break;
            case "Confirm Joining":
                colour = "#0ea972";
            break;
            case "Interview":
                colour = "#6dc1d6";
            break;
            case "Rescheduled Interview":
                colour = "rgb(97, 31, 8)";
            break;
            case "Job Order Re-submission":
                colour = "#bb6993";
            break;
            case "Job Order Follow-up":
                colour = "rgb(155, 204, 73)";
            break;
            case "Interview Feedback Rescheduled":
                colour = "rgb(228, 161, 54)";
            break;
            case "Interview Next Round":
                colour = "#b37700";
            break;
            case "Confirm Attendance":
                colour = "#FFC0CB";
            break;
            default:
                colour = "#000000";
            break;
        }
        return  colour;
    }