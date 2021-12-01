<link rel="stylesheet" href="/jquery-ui.min-ac.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style>
.table-jo-details {
	margin-bottom: 0;
}
.inilne-font-icon {
	display: inline-block;
	padding: 0 6px;
	font-size: 10px;
	color: #999;
	height: 100%;
	line-height: 100%;
	vertical-align: baseline;
}
.jo-link {
	color: indianred;
	cursor: pointer;
	font-size: 90%;
	font-weight: normal;
}
.jo-panel {
	margin-bottom: 10px;
}
.nb-weekly {
    text-align: center;
    margin-right:15px;
    font-size: 15px;
    font-weight: 600;
}
.jo-panel-heading {
	font-size: 16px;
	font-weight: bold;
	padding: 7px 8px;
}
.jo-panel-heading span.city {
	color: #338dbd;
}
.jo-status-row {
    margin-bottom: 10px;
    overflow: hidden;
}
.jo-status-row>div {
	border: 1px solid #ccc;
    text-align: center;
    padding-top: 8px;
    padding-bottom: 8px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #666;
    background: #fff;
}
.jo-status-row>div.current {
	background: #338dbd;
	color: #fff;
}
.jo-status-row>div:not(:last-child) {
	border-right: 0;
}
.jo-intro-call-done-p {
    margin-top: 15px;
    padding-top: 25px;
    border-top: 1px solid #ddd;
    padding-left: calc(20% - 30px);
    font-weight: normal;
    color: #288dbe;
    font-size: 15px;
}
.jo-buttons-top-right {
	position: absolute;
    right: 15px;
    top: 20px;
}
.jo-buttons-top-right>button {
    margin-left: 8px;
}
body .content-header .breadcrumb {
	display: none;
}
#status_modal>.modal-dialog,
#log_modal>.modal-dialog {
	width: 900px;
}
#filter_modal>.modal-dialog {
	width: 1200px;
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
#status_modal .jo-col-primary-status {
	width: 25%;
	float: left;
	padding-right: 9px;
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
#status_modal .task_qualify_notes  {
    border: 1px solid #bbb;
    padding: 6px 10px;
}
#status_modal .hint {
    background: #ddd;
    padding: 3px 10px;
    font-size: 95%;
    text-align: center;
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
.jo-search-fields-row {
    padding: 10px;
    padding-bottom: 0;
    overflow: hidden;
}
.jo-search-fields-row>div>.form-group {
	margin-bottom: 0;
}
.jo-search-fields-row>div:not(:last-child):not(:first-child)>.form-group>* {
	width: calc(100% - 10px);
    margin-left: 10px;
}
.jo-search-fields-row>div:last-child>.form-group>* {
	width: calc(100% - 10px);
    margin-left: 10px;
}
/*body .table-jo-details:not(.jo-log-table) tr td:last-child {
	text-align: right;
}*/
.table-jo-details.table-search-results {
	border-top: 1px solid #ddd;
    margin-top: 10px;
}
.ui-menu.ui-autocomplete {
    background: #fff;
    border: 1px solid #288dbe;
    color: #288dbe;
}
span.jo-submission-date {
    display: inline-block;
    margin-left: 23px;
    font-weight: normal;
}
span.jo-submission-date>span {
    font-weight: bold;
}
span.jo-submission-date>a {
	display: inline-block;
    margin-left: 15px;
    font-weight: normal;
}
.jo-filter-column {
    overflow: hidden;
    float: left;
    width: 15%;
    height:230px;
    border-right: 1px solid #ddd;
    margin-left: 6px;
}
.jo-filter-column:nth-child(4) {
	width: 18%;	
}
.jo-filter-column:last-child {
	border: 0;
}
.jo-filter-column label {
    font-weight: normal;
    display: block;
    margin-bottom: 4.2px;
    font-size: 12px;
}
.jo-filter-column label input[type="checkbox"] {
	margin: 0;
	vertical-align: sub;
}
.jo-filter-column label.level2 {
    padding-left: 16px;
}
.task_modal .conditional-task-field {
    display: none;
    padding-top: 6px;
}
.task_modal .task-field {
    padding-top: 6px;
}
button.btn.btn-xs.btn-primary.btn-applicant-task {
    display: block;
    font-size: 13px;
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
#status_modal input.smaller {
    width: 30%;
    display: inline-block;
    margin-right: 6px;
}
#status_modal select.smaller, #status_modal input.smaller {
    width: 30%;
    display: inline-block;
    margin-right: 6px;
}
#status_modal select.smallest, #status_modal input.smallest {
    width: 20%;
    display: inline-block;
    margin-right: 6px;
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
.task_modal .get-feedback-date {
    margin-top: 10px;
}
.key-word-input {
    width: 100% !important;  
    margin-left: 0px !important;
}

.table.stats-table th{
    border: solid 1px;
}
.table.stats-table .main-count td{
    border: solid 1px;   
}
.search-result-table-container{
    overflow-x: hidden;
}
#candidate-table-div #table-detail .candidate-tr-bg-color{
    background-color: #bdbaba;
}
#candidate-table-div #table-detail tbody tr:hover {
  background-color: #91bdda6e;
}

.align-left
{
    text-align: left !important;
}
.margin0
{
    margin:0px;
}
.btn-xs {
    margin: 1px ;
}
.email-btn
{
    margin: 0px 10px 0px 10px !important;
}
.email-detail-table
{
    border: 1px solid #ddd;
}
.email-detail-table>thead>tr>th
{
    border: 1px solid #ddd;
    text-align: center;
    font-weight: 600;
}

.email-detail-table>tbody>tr>td
{
    border: 1px solid #ddd;
    text-align: center;
    font-weight: 500;
}
@media (min-width: 992px){
.modal-lg {
    width: 1110px;
}
}

.email-detail-table-body{
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}
.email-detail-hed-txt{
    font-weight: 700;
}
.cursor-pointer
{
    cursor: pointer;
}

@media (min-width: 992px){
 .modal-add-to-job {
    width: 700px;
 }
}

.table-search-results>tbody>tr>:hover
{
    border: 1px solid #00acd6 !important;
    border-top: 2px solid #00acd6 !important;
    border-bottom: 2px solid #00acd6 !important;
}
.detail-box-height1 {
    min-height: 100px;
}
.closebtn-comment {
    cursor: pointer;
    position: absolute;
    top: -1px;
    right: 3px;
}
.popover-custom
{
    top: inherit !important;
    left: initial !important;
    z-index: 1000;
}
.pointer
{
    cursor: pointer;
}

.extra-content
{
    padding: 10px 14px 10px 12px;
}

.table-custom-bordered>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
}
.custom-table
{
    width: 99.9%
}
.margin0
{
    margin: 0px;
}
.associate-sec
{
    padding-right: 5px; padding-left: 5px;
}
.padding0
{
    padding: 0px;
}
.associate-section
{
    margin-top: 10px; margin-bottom: 10px;
}
.client-name
{
    padding: 0px; padding-bottom: 10px;    
}
.box-shadow
{
    -webkit-box-shadow: 0px 1px 6px 0px rgba(138,138,138,1); 
    -moz-box-shadow: 0px 1px 6px 0px rgba(138,138,138,1);
    box-shadow: 0px 1px 6px 0px rgba(138,138,138,1);
}
.box-title
{
    text-align: left !important; width: 15%; padding-right: 0px;
}
.photo-title
{
    color: #288dbe; font-size: 15px; padding-top: 10px; text-transform: uppercase;
}
.padding25
{
    padding: 25px;
}
.pad-left25
{
    padding-left: 25px;
}
.margin-bot0
{
    margin-bottom: 0px;
}
.pad-lef5
{
    padding-left: 5px;
}
.photo-section
{
    padding: 0px; text-align: center;
}
.margin-top30
{
    margin-top: 30px;
}
.detail-box
{
    border: 1px solid #ccc;padding: 10px 0px 10px 0px;
}
.icon-box
{
    padding-right: 10px;border-right: 1px solid #ccc;padding: 10px;
}
.pad10
{
    padding: 10px;
}
</style>