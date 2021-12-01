$(document).ready(function() {
 $("form[method=get]").submit(function(e){
      var url = window.location.href;
      var url_pagination_removed = removeParam("page", url);  
      var q= $("input[name=q]").val();
      var filtercombo= $(".filter-combo ").val();
      if(q!= null && filtercombo==null )
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
 
    
	$('td .button_action').each(function() {
		if($(this).find('.btn-group-in-menu').length) {
			// var randid = "moredd_" + Math.ceil((Math.random(0,1) * 1000));
			var menu = $('<div class = "btn-group" />');
			menu.append('<button type = "button" class = "btn btn-xs btn-primary dropdown-toggle" data-toggle = "dropdown">More...<span class = "caret"></span></button>');
			var ul = $('<ul class = "dropdown-menu" role = "menu" />');
			$(this).find('.btn-group-in-menu').each(function() {
				ul.append('<li><a href = "' + this.href + '">' + $(this).text() + '</a></li>');
			});
			menu.append(ul);
			menu.insertBefore($(this).find('.btn-group-in-menu').first());
		}
	});
   $('a.application-url').on('click', function(){  // To get all <a> tag title
       $('#application-modal').find('.p-application-url').text($(this).data('id'));  
  });
  $('#advanced_filter_modal').find('.form-group .row-filter-combo').each(function(){  // To get all <a> tag title
        var getTitletxt =  $(this).find('strong').text();
        var text='Application Url';
        if(getTitletxt==text)
        {    $(this).find('input[type=text],select,strong').hide();
            
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
