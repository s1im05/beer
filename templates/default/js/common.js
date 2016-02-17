(function(w, u){
    $(function(){
        $('#search_btn').on('click', function(e){
            e.preventDefault();
            $('#search').trigger('submit');
        });
        
        $('#search').on('submit', function(e){
            if ($('#search_query').val() === '') {
                e.preventDefault();
            } else if ($('#search_query').val().length < 3) {
                e.preventDefault();
            } else {
                $(this).attr('action', '/search/'+$('#search_query').val());
            }
        });
        
        $(document).on('click tap', '.btn-radio > .btn', function(e){ // btn group => radio btns
            var jqParent    = $(this).parent('.btn-radio');
            $(jqParent.data('target')).val($(this).data('value'));
            jqParent.find('.btn.btn-primary').toggleClass('btn-primary btn-default');
            $(this).toggleClass('btn-primary btn-default');
        }).on('keypress', 'form', function(e){ // submit all forms on ctrl+enter
            if (e.ctrlKey && e.keyCode === 13){
                $(this).submit();
            }
        }).on('keydown', 'body', function(e){
            if (e.ctrlKey && e.keyCode === 37){ // larr
                $('.pagination:first > .active').prev('li').find('a')[0].click();
            }
            if (e.ctrlKey && e.keyCode === 39){ // rarr
                $('.pagination:first > .active').next('li').find('a')[0].click();
            }
        });
    });    
})(window, jQuery);