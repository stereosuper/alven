$(function(){

    function handleAjaxOpen() {
        var $links = $('a.ajax-load');

        $links.click(function() {
            var $link = $(this);
            var href = $link.attr('href');

            $('#ajaxContainer').load(href);

            return false;
        });
    }

    // Init

    handleAjaxOpen();

});