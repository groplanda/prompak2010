(function($){
    $('#postFilter').on('change', 'input, select', function(){
        var $form = $(this).closest('form');

        $form.request();
    });

    $('.main-section').on('click', '.pagination > li > a', function (event) {
        var page = $(this).attr('href');

        var checked = [];
        $('.checkbox_cat:checked').each(function() {
            checked.push($(this).val());
        });

        var sorting = $('.sort_select').val();


        event.preventDefault();
        if ($(this).attr('href') != '#') {
            $("html, body").animate({scrollTop: 0}, "fast");
            
            $.request('onFilterPosts', {
                data: {
                    'filter[page]': page, 
                    'filter[categories]': checked, 
                    'filter[sort]': sorting
                },
                update: {
                    '@list.htm' : '#partialPosts',
                    '@pagination.htm': '#partialPaginate'
                },
            });
        }
    });
})(jQuery);