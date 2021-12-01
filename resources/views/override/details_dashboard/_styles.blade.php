<link rel="stylesheet" href="/jquery-ui.min-ac.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
	.button_margin{
		margin-bottom:1%
	}
    
    span.jo-date-highlight {
        display: block;
        padding: 0 6px;
        background: #c5ef98;
        margin-top: 3px;
        border-radius: 3px;
        font-size: 12px;
    }
    span.jo-date-highlight.jo-date-highlight-blue {
        background: #cfe5f9;
    }
    span.jo-date-highlight.jo-date-highlight-gray {
        background: #999;
        color: #fff;
    }
    button.btn.btn-xs.btn-primary.btn-applicant-task {
        display: block;
        font-size: 13px;
    }

    #status_modal select, 
	.task_modal select,
	#status_modal input,
	.task_modal input {
	    width: 100%;
	    display: block;
	    height: 32px;
	    line-height: 32px;
	    padding-left: 8px;
	}
	#status_modal input {
	    background: #f7f7f7;
	    border: 1px solid #ccc;
	}
	
	#status_modal .jo-col-secondary-status {
		width: 40%;
		float: left;
		padding-right: 9px;
	}
	#status_modal .jo-col-next-action {
		width: 35%;
		float: left;
	}
	#status_modal span.modal-top-label,
	#log_modal span.modal-top-label,
	.task_modal span.modal-top-label {
	    display: inline-block;
	    width: 80px;
	    font-weight: bold;
	    color: #777;
	}
	#status_modal #status_notes,
	.task_modal textarea {
		width: 100%;
	    margin-top: 10px;
	    padding: 3px 10px;
	    resize: vertical;
	    margin-bottom: 0px;
	    height: 70px;
	}
	.task_modal .conditional-task-field {
	    display: none;
	    padding-top: 6px;
	}
	.task_modal select.smaller, .task_modal input.smaller {
		width: 30%;
		display: inline-block;
		margin-right: 6px;
	}
	.task_modal select.smallest, .task_modal input.smallest {
	    width: 20%;
	    display: inline-block;
	    margin-right: 6px;
	}
	.datepicker table {
		font-size: 13px!important;  
	}
	#highlight{
	background-color:rgb(230, 192, 197);   
	}

	.filter-section
	{
	margin: 0px;
    position: fixed;
    right: 0px;
    z-index: 1000;
	}

	.filter-select
	{
		width: 250px;
    background-color: #f0f0f0;
    padding: 10px;
    border: 1px solid #ccc;
    margin-left: 3px;

	}
	.search-fixed-pace
	{
		height: 56px;
	}

	.affix {
    top: 10px;
    right: 30px;
    z-index: 1000 !important;
  }

  .affix + .container-fluid {

    padding-top: 0px;
  }

  .select2-container .select2-selection--single {  
   height: 34px;
  }

.filter-reset-btn{
	margin      : 0;
	padding     : 0;
	border      : 0;
	background  : transparent;
	font-family : inherit;
	font-size   : 1em;
	cursor      : pointer;
}
.filter-reset-btn span{
	padding: 6px 12px;
    line-height: 30px;
    color: white;
    text-shadow: 0 0 2px black;
    /* border: 1px solid rgb(249, 84, 84); */
    border-radius: 4px;
    background: rgb(222, 74, 74);
    background-image: linear-gradient( rgb(121, 115, 115),rgb(232, 103, 103) 50%,rgb(212, 71, 71) 50%,rgb(113, 58, 58));
}
.margin-top15
{
	margin-top: 15px;
}
.padding0
{
	padding: 0px
}

</style>