<link rel="stylesheet" href="/jquery-ui.min-ac.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
.table-candidate-details {
    margin-bottom: 0;
}
.select2-selection__rendered {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 13px;
  padding: 0px 5px 5px 5px !important;
}
.select2-results__options{
        font-size:14px !important;
 }
.btn-experience {
    background-color: #ffffff;
    color: #444;
    border-color: #ddd;
}
.btn-scroll {
   max-height:230px; 
   overflow-y:scroll;
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
.candidate-link {
    color: indianred;
    cursor: pointer;
    font-size: 90%;
    font-weight: normal;
}
.candidate-panel {
    margin-bottom: 10px;
}
.candidate-panel-heading {
    font-size: 16px;
    font-weight: bold;
    padding: 7px 8px;
}
.candidates-status-row {
    margin-bottom: 10px;
    overflow: hidden;
}
.candidates-status-row>div {
    border: 0px solid #ccc;
    text-align: left;
    padding-top: 1px;
    padding-bottom: 1px;
    /*overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;*/
    color: #666;
}
.candidates-status-row>div.photo {
    border: 0px solid #ccc;
}
.candidates-status-row>div.title {
    font-weight: bold;
}
.title-main {
    font-weight: bold;
    border: 0px solid #ccc;
    text-align: left;
    padding-top: 2px;
    padding-bottom: 2px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #288dbe;
}

.head-name {
    color:#288dbe;
    font-size: 1.7em; 
}
.candidate-title {
    color:#288dbe;
    font-size: 1.2em; 
}

a.detail-collapse.collapsed:before {
    content:'More' ;
}
a.detail-collapse:before {
    content:'Less' ;
}
.img-thumbnail {
    max-width: 80%;
}
.search-panel {
    width: 100%;
    display: inline-block;
}

.search-keys {
    float: right;
    margin-right: 16px;
}

.field-class {
    width: 89px;
}

/*.modal-footer {
    border-top-color: #e2a3a3;
}
.modal-header {
    border-bottom-color: #e2a3a3;
}*/

.candidate-modal-content {
    display: inline-block;
    width:100%;
    background-color: #cccccc;
}
.candidate-modal-items {
    margin: 10px;
    padding: 5px;
}
.add-msg,.single-send-msg {
    color:  #006400;
    margin: 10px;
}
.keyword-style {
    background-color: #88E872;
}
hr.small-div {
    border-color: #9494947a;
    margin: 5px 0;
}
.smaller-text {
    font-size: 90%;
}
.well.well-sm.smaller-text:not(.auto-height) {
    /*min-height: 135px;*/
    min-height: 100px;
    margin-bottom: 0;
}
.candidate-td {
    border: none!important;
}
/* .candidate-td:hover {
    border: 1px solid #02c1ef !important;
} */
.candidate-td a.glyphicon.glyphicon-pencil{
    font-size: 80%;
    margin: -3px;
    margin-left: 6px;
    padding: 3px;
    border: 1px solid #ccc;
    border-radius: 3px;
    background: #fff;
    vertical-align: text-top;
    opacity: 0.6;
}
.candidate-td a.glyphicon.glyphicon-trash {
    font-size: 80%;
    margin: -3px;
    margin-left: 6px;
    padding: 3px;
    border: 1px solid #ccc;
    border-radius: 3px;
    background: #fff;
    vertical-align: text-top;
    opacity: 0.6;
}
.candidate-td a.glyphicon.glyphicon-trash:hover {
    color: #000;
    border-color: #000;
    opacity: 1;
}
.candidate-td a.glyphicon.glyphicon-pencil:hover {
    color: #000;
    border-color: #000;
    opacity: 1;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    color: #000;
}
.validate-error{
    border: 1px solid rgba(255, 0, 0, 0.97) !important;
}
.candidate-edit-resume-container {
    margin: 2px; 
    min-height: 120px;
}
.candidate-edit-resume-container a .icon-resume {
    font-size: 40px;
    padding: 35px;
}

.select2.select2-container{
    width: 100% !important;
}
.well.well-sm.smaller-text.recent-association {
    min-height: 132px;
    margin: 3px;

}
.well.well-sm.smaller-text .table-responsive table {
    background-color: transparent;
    width: 100%;
}

.well.well-sm.smaller-text .table-responsive th, .well.well-sm.smaller-text .table-responsive td{
    text-align: center;
    width: 50%;
    border: 1px solid #000;
}
.well.well-sm.smaller-text .table-bordered table {
    background-color: transparent;
    width: 100%;
}

.well.well-sm.smaller-text .table-bordered th, .well.well-sm.smaller-text .table-bordered td{
    text-align: center;
    width: 17%;
    border: 1px solid #000;
}
.select2-container .select2-search__field {
    width: 100% !important;
}
.alert a {
    text-decoration: none !important;
}
.resume_height{
    height:50px!important;
}
.custom-text-margin
{
  margin-top: 3px;
  margin-bottom: 3px;
}
.margin-top15
{
    margin-top: 15px;
}
.margin-top10
{
    margin-top: 10px;
}
.padding0
{
    padding: 0px;
}
@media (min-width: 992px){
 .modal-add-to-job {
    width: 700px;
 }
}
.detail-box
{
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    padding: 10px;
}
.margin0
{
    margin: 0px;
}
.padding-left
{
    padding-left: 0px;
}
.padding-right
{
    padding-right: 0px;
}
.detail-box-height
{
    min-height: 114px;
}
.table-custom-bordered{
    border: 1px solid #ddd;
}
.table-custom-bordered>tbody>tr>th
{
border: 1px solid #ddd;
}
.table-custom-bordered>tbody>tr>td
{
border: 1px solid #ddd;
}
.cand-jo-select {
    /*width: 250px;*/
    background-color: #f0f0f0;
    padding: 10px;
    border: 1px solid #ccc;
    /*margin-left: 3px;*/
}
.select2-container .select2-selection--single {
    height: 34px;
}
input[type="date"].form-control
 {
      line-height: inherit;
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
    border: 1px solid #ccc;
}
.icon-box
{
    padding-right: 10px;border-right: 1px solid #ccc;padding: 10px;
}
.pad10
{
    padding: 10px;
}
.search-detail-padding{
    padding: 10px 0px 10px 0px;
}


.cntnr{
	margin-top: 50px;
    padding: 0px 7rem;
	width: 98%;
	margin: 0px auto;
	margin-left: 16px;
}
.box{
	padding: 8px;
    border: 1px solid #e7e7e7;
    background: #fff;
    transition: box-shadow .3s ease-in-out;
    margin-bottom: 8px !important;
    box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.22);
	-webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.22);
	-moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.22);
}
.box:hover{
	box-shadow: none;
    padding:6px;
    border: 1px solid #ca493fd9;
}
.box img{
	width: 100px;
	/* max-width: 100%; */
	/* height: 100%; */
	/* border: 1px solid #fef4f485; */
	border-radius: 50%;
	/* padding: 1px 0px; */
	/* margin: 4px auto; */
	margin: 16px auto;
	text-align: center;
	display: block;
	height: 100px;
}
.box .block_2{
	border-right: 2px solid #e7e7e7;
}
.box .block_2 h5{
	font-weight: 700;
	color: #434040;
	margin-bottom: 5px;
}
.box .block_2 h6{
	color: black;
    font-weight: 100;
    font-size: 14px;
    line-height: 14px;
}
.box .block_4{
	/* padding: 0 0 0 8px; */
}
.box .block_4 a{
	font-size: 12px;
    font-weight: 600;
    padding: 7px 15px;
    color: white;
    background: #00a65a;
    border: none;
    width: 100%;
    margin-bottom: 5px;
    display: block;
    text-align: center;
    cursor: pointer;
}
.box .block_4 button{
	font-size: 12px;
    font-weight: 600;
    padding: 7px 15px;
    color: white;
    background: #00a65a;
    border: none;
    margin-bottom: 5px;
}

.box .block_4 .download_resume{
	font-size: 13px;
    font-weight: 600;
    padding: 7px 15px;
    color: white;
    background: #00a65a;
    border: none;
    width: 100%;
    margin-bottom: 5px;
    display: block;
    text-align: center;
}

.box .block_4 a.button{
	font-size: 12px;
    font-weight: 600;
    padding: 7px 15px;
    color: white;
    background: #00a65a;
    border: none;
    width: 100%;
    margin-bottom: 5px;
}
.box .block_4 i{
	float: right;
	font-size: 17px;
}
.box .block_3{
	padding: 0 7px 0 7px;
}
.box .block_3 button , .box .block_3 button:focus {
	font-size: 13px;
	padding: 10px 7px;
	color: #21a0d9;
	background: #d4eefc;
	border: none;
	width: 100%;
	margin-bottom: 3px;
	font-weight: 700;
	line-height: 14px;
}
.box .block_3 .non_bg{
	background: none !important;
	color: #999999 !important;
}
.box .block_3 .more_dt{
	background: none !important;
	color: black !important;
}
.box .block_3 .more_dt2{
	background: #dae3cd !important;
	color: black !important;
}
.box .block_3 hr{
	margin-top: 5px;
    margin-bottom: 0;
}
div#searchCandidate {
    margin-top: 14px;
    background: white;
    padding: 0px 0px;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: white;
    cursor: default;
    background-color:#00c0ef;
    border: 1px solid #00c0ef;
    border-bottom-color: transparent;
}
.tab-content {
    padding: 5px 10px;
}
.form-inline .form-control {
    width: 100%;
}
.form-horizontal .control-label {
    font-weight: normal;
    font-size: 14px;
    text-align: left;
}
.mt-10 {
    margin-top:10px;
}

.selectedBtn{
    background-color: red!important;
    border:1px solid red!important;
}
.form-group {
    margin-bottom: 0px;
}
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 0px; 
}
.qualifyUgBtn, .qualifyPgBtn {
    background-color: #00a65a;
    border-color: #00a65a;
}

div#preloader {
    display: block;
}

#preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: white;
    z-index: 999999;
}

#preloader .preloader {
    width: 50px;
    height: 50px;
    display: inline-block;
    padding: 0;
    text-align: left;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -25px;
    margin-top: -25px
}

#preloader .preloader span {
    position: absolute;
    display: inline-block;
    width: 50px;
    height: 50px;
    border-radius: 100%;
    background-color: #01412b;
    -webkit-animation: preloader 1.3s linear infinite;
    animation: preloader 1.3s linear infinite
}

#preloader .preloader span:last-child {
    animation-delay: -0.8s;
    -webkit-animation-delay: -0.8s
}

@keyframes preloader {
    0% {
        -webkit-transform: scale(0, 0);
        transform: scale(0, 0);
        opacity: .5
    }
    100% {
        -webkit-transform: scale(1, 1);
        transform: scale(1, 1);
        opacity: 0
    }
}

@-webkit-keyframes preloader {
    0% {
        -webkit-transform: scale(0, 0);
        opacity: .5
    }
    100% {
        -webkit-transform: scale(1, 1);
        opacity: 0
    }
}
.btn-info:active {
    background-color: #ff0000;
    border-color: red;
}

.btn-info:hover {
    background-color: #00a65a;
    border-color: #00a65a;
}
</style>