 jQuery(document).ready(function($){
        var sectorsSelect,companySelect,searchInput,OrderSelect,OrderSelectValue,AdOrderSelect,ASOrderSelect,ExOrderSelect,AdOrderSelectValue,ASOrderSelectValue,ExOrderSelectValue;
        var urlToListingPage = 'https://www.esic.directory/esic-database.html';
        $("body").on("click touchstart","#show-filter",function(e) {
            e.preventDefault();
             $('#filter #selectDiv').slideToggle( "slow");
        });
        $("body").on("click touchstart","#filter_reset",function(e) {
            e.preventDefault();
            $(".module select").val($("module select option:first").val());
            $(".module input").val('');
        });
        $('#dateAddedOrderSelect').change(function(){
            OrderSelect = 'added_date';
            var selectvalue = $(this).val();
            $(".module .sortFilters select").val($(".module .sortFilters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
        });
        $('#assessmentOrderSelect').change(function(){
            OrderSelect = 'corporate_date';
            var selectvalue = $(this).val();
            $(".module .sortFilters select").val($(".module .sortFilters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
        });
        $('#expiryOrderSelect').change(function(){
            OrderSelect = 'expiry_date';
            var selectvalue = $(this).val();
            $(".module .sortFilters select").val($(".module .sortFilters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
        });
        $("body").on("click touchstart","#filter_search",function(e) {
            e.preventDefault();
            var clickBtn ='filter_search';
            callfilter(clickBtn);

        });
		 $('#location_search').keypress(function(e){
            if(e.which === 13)
                $('#filter_search').focus().click();
        });
        function callfilter(clickBtn){
                var page = $("#filter_search").data('val');
                searchInput = $('#location_search').val();
                if(searchInput=='' ){
                        sessionStorage.setItem("filter-searchInput",'');
                        sessionStorage.setItem("filter-sectorsSelectValue",'');
                        sessionStorage.setItem("filter-companySelect",'');
                        sessionStorage.setItem("filter-OrderSelect",'');
                        sessionStorage.setItem("filter-OrderSelectValue",'');
                }
                    sessionStorage.setItem("filter-searchInput",searchInput);
					 sessionStorage.setItem("home",1);
                    window.location.href = urlToListingPage;
                    return false;
        }
        $('.multi-item-carousel .item').each(function(){
            var next = $(this).next().next().next().next().next().next().next();
            if (!next.length) { next = $(this).siblings(':first');}
            next.children(':first-child').clone().appendTo($(this));
            if (next.next().length>0) { next.next().children(':first-child').clone().appendTo($(this));
            } else { $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
            }
        });
    });