    $(document).ready(function(){
      $("form[method=get]").submit(function(e){
        var url = window.location.href;
        var url_pagination_removed = removeParam("page", url);  
        var q= $("input[name=q]").val();
        var filtercombo= $(".filter-combo").val();
        $("#submitBtn").attr("disabled", true);
        $("#submitBtn").value('Processing ....');

        $('#preloader').show();

        if(q!=null && filtercombo==null )
        {
          $("form[method=get]").attr("action", url_pagination_removed).submit();      
        }
        if(filtercombo!=null)
        {
          $("input[name=page]").val(" ");		
        } 
        else{
        }
      });
    });

    function removeParam(key, sourceURL) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            rtn = rtn + "?" + params_arr.join("&")+"&page=1";
        }
        return rtn;
    }
  
