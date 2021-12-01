$(document).ready(function () {

    $('#table_dashboard tbody tr').each(function () {
        $(this).find('td:eq(2)').html(function() {
            return '<a href="' + $(this).closest('tr').find('a.btn.btn-xs.btn-success').first().attr('href') + '">' + $(this).text() + '</a>';
        });
    });
    $("#table_dashboard .checkbox").each(function () {
        $(this).attr('autocomplete', 'off');
        $(this).prop('checked', false);
    });
    $('#table_dashboard thead th').each(function () { 
    	$(this).find('a').attr('href','#');
    	$(this).find('i').remove();
    });
    $("[name='filter_column[job_orders.city][type]'").parent('div').parent('.row-filter-combo.row').hide();

    $(".btn-assign-recruiter").click(function(){
        $('#recruiterId .select2').val('');
        $('.message-container').hide();
    });

    $(".btn-assign").click(function(){
        var jobOrderIds = [];
        $('.checkbox').each(function(){
            if($(this).is(":checked")){
                jobOrderIds.push($(this).val());
            }
        });

        if(jobOrderIds.length == 0 ) {
            alert('Select Job Orders');
            return false;
        }

        if(!$('#recruiterId .select2').val()){
            alert('Select Recruiter!');
            return false;

        }
        $.post('/custom/assign-jobOrders',{
            recruiter_id : $('#recruiterId .select2').val(),
            jobOrder_ids : jobOrderIds
        },function(data){
            if( data['alreadyAssigned'].length > 0 || data['assignedJobOrder'].length > 0 ) {
                $( ".message-container" ).css('color','green');
                $.each(data['alreadyAssigned'], function( index, value ) {
                    $( ".message-container" ).show().append( "Job Order "+value.id+" - "+value.title+" already assigned!.<br>" );
                });

                $.each(data['assignedJobOrder'], function( index, value ) {
                    $( ".message-container" ).show().append( "Job Order "+value.id+" - "+value.title+" assigned!.<br>" );
                });
            }
            window.setTimeout(function(){location.reload()},2000)
        })
    });
    $('#recruiter-assign-modal .select2').select2();
});
