$(function(){

    var myScroll = 0, header = $('#header');

    /**** VARIABLES ****/


    /**** INIT ****/


    $(document).scroll(function(){
        myScroll = $(document).scrollTop();

        if($('#articleContent').length){
            if(myScroll > $('#articleContent').offset().top - header.height()/2){
                header.addClass('fixed');
            }else{
                header.removeClass('fixed');
            }
        }
    });

    $(window).resize(function(){
	});

	$(window).load(function(){
	});

});
