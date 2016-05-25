$(function(){

    var myScroll = 0,
        header = $('#header'),
        mainContent = $('#mainContent'),
        readIndicator = $('#readIndicator'),
        docHeight = $(document).height(),
        windowHeight = $(window).height(),
        buttons = $('.btn');

    /**** VARIABLES ****/


    /**** INIT ****/

    if(buttons.length){
        var i = 0, nbButtons = buttons.length, letterArray = [],
            textBtn = '', j = 0, nbLetter = 0, newHtmlBtn = '',
            delay = 0;
        for(i; i<nbButtons; i++){
            textBtn = buttons.eq(i).html();
            letterArray = textBtn.split('');
            j = 0;
            nbLetter = letterArray.length;
            newHtmlBtn = '';
            delay = 0;
            for(j; j<nbLetter; j++){
                delay += 0.014;
                delay = Math.round(delay*1000) / 1000;
                newHtmlBtn += '<span style="transition-delay:'+delay+'s">'+letterArray[j]+'</span>';
            }
            buttons.eq(i).html('<span class="before">'+newHtmlBtn+'</span><span class="after">'+textBtn+'</span>');
        }
    }


    $(document).scroll(function(){
        myScroll = $(document).scrollTop();

        if(mainContent.length){
            myScroll > mainContent.offset().top - header.innerHeight() ? header.addClass('fixed') : header.removeClass('fixed');
        }

        if(readIndicator.length){
            var readingPercent = myScroll/(docHeight-windowHeight);
            TweenMax.set(readIndicator, {scaleX: readingPercent});
        }
    });

    $(window).resize(function(){
        docHeight = $(document).height();
        windowHeight = $(window).height();
	});

	$(window).load(function(){
        docHeight = $(document).height();
	});

});
