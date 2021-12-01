<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
    function validateEmail(_email) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(_email)) {
            return true;
        }
        else {
            return false;
        }
    }

    function validatePhone(_phone) {
        var phoneno = /^\d{11}$/;
        if(_phone.match( /^\d{10}$/)||_phone.match(phoneno)||_phone.match(/^\+\d{12}$/)||_phone.match( /^\d{12}$/))  {
             return true;
        }  
        else
        {
            return false;
        }
    }

    function checkIsNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>