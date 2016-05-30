$(function(){

    var myScroll = 0, scrollDir = 0, lastScrollTop = 0,
        header = $('#header'), headerHeight = header.innerHeight(),
        mainContent = $('#mainContent'),
        readIndicator = $('#readIndicator'),
        docHeight = $(document).height(),
        windowHeight = $(window).height(),
        buttons = $('.btn'),
        buttonsInvert = $('.btn-invert'),
        main = $('#main'),
        contentHeader = $('#contentHeader'),
        postSidebar = $('#postSidebar'),
        postSidebarTop = 0 /*postSidebarPos = 0,*/;

    /**** VARIABLES ****/


    /**** INIT ****/

    function detectScrollDir(){
        scrollDir = myScroll > lastScrollTop ? -1 : 1;
        lastScrollTop = myScroll;
    }



    function setButtons(buttons){
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
                delay += 0.013;
                delay = Math.round(delay*1000) / 1000;
                if(letterArray[j] === ' '){
                    letterArray[j] = '&nbsp;';
                }
                newHtmlBtn += '<span style="transition-delay:'+delay+'s">'+letterArray[j]+'</span>';
            }
            buttons.eq(i).html('<span class="bg"></span><span class="before">'+newHtmlBtn+'</span><span class="after">'+newHtmlBtn+'</span>');
        }
    }

    function animTxt(splitText){
        splitText.split({type:'words'});
        TweenMax.staggerFrom(splitText.words, 0.3, {ease:Expo.easeInOut, opacity:0, y:100}, 0.03);
    }

    function setSidebarScroll(){
        var sidebarMargin = 20, sidebarHeight = postSidebar.innerHeight(),
            contentTop = mainContent.offset().top, contentHeight = mainContent.innerHeight();

        if(sidebarHeight < contentHeight + sidebarMargin*2 && sidebarHeight + headerHeight + sidebarMargin < windowHeight){
            if(myScroll >= postSidebarTop - headerHeight - sidebarMargin){
                if(myScroll + sidebarHeight + headerHeight + sidebarMargin > contentTop + contentHeight - sidebarMargin){
                    postSidebar.css({top: contentHeight - sidebarMargin - sidebarHeight + 20}).removeClass('fixed').addClass('fixedBot');
                }else{
                    postSidebar.css({top: headerHeight + sidebarMargin, width: postSidebar.innerWidth()}).removeClass('fixedBot').addClass('fixed');
                }

                if(myScroll > (contentHeight+contentTop)/2){
                    postSidebar.find('li').eq(0).find('.img').addClass('off');
                    postSidebar.find('li').eq(1).find('.img').addClass('on');
                }else{
                    postSidebar.find('li').eq(0).find('.img').removeClass('off');
                    postSidebar.find('li').eq(1).find('.img').removeClass('on');
                }
            }else{
                postSidebar.css({top: 0}).removeClass('fixed fixedBot');
            }
            /*if(windowHeight >= sidebarHeight*2 + headerHeight){
                if(myScroll >= contentTop && myScroll >= windowHeight/2 - sidebarHeight/2){
                    if(myScroll + sidebarHeight + headerHeight + sidebarMargin > contentTop + contentHeight - sidebarHeight/2 - sidebarMargin){
                        postSidebar.css({top: contentHeight - sidebarMargin - sidebarHeight + 20}).removeClass('fixed').addClass('fixedBot');
                    }else{
                        postSidebar.css({top: windowHeight/2 - sidebarHeight/2 + headerHeight - sidebarMargin, width: postSidebar.innerWidth()}).removeClass('fixedBot').addClass('fixed');
                    }
                }else{
                    postSidebar.css({top: 0}).removeClass('fixed fixedBot');
                }
            }*/
        }else{
            postSidebar.css({top: 0}).removeClass('fixed fixedBot');
        }
    }

    if(buttons.length){
        setButtons(buttons);
    }
    if(buttonsInvert.length){
        setButtons(buttonsInvert);
    }

    $('input').on('change', function(){
        $(this).val() ? $(this).addClass('filled') : $(this).removeClass('filled');
    });


    $(document).scroll(function(){
        myScroll = $(document).scrollTop();
        detectScrollDir();

        if(mainContent.length){
            myScroll > mainContent.offset().top - headerHeight - 40 ? header.addClass('fixed') : header.removeClass('fixed');
            if(header.hasClass('fixed')){
                scrollDir < 0 ? header.addClass('on') : header.removeClass('on');
            }
        }

        if(readIndicator.length){
            var readingPercent = (myScroll-mainContent.offset().top)/(mainContent.innerHeight()-windowHeight);
            if(myScroll > mainContent.offset().top){
                TweenMax.set(readIndicator, {scaleX: readingPercent});
            }
        }

        if(contentHeader.length){
            if(contentHeader.find('.img').length){
                TweenMax.set(contentHeader.find('.img'), {y: '-'+myScroll/40+'%'});
                TweenMax.set(contentHeader.find('h1'), {y: '-'+myScroll/4+'%'});
            }
        }

        if(postSidebar.length && mainContent.length){
            setSidebarScroll();
        }
    });

    $(window).resize(function(){
        docHeight = $(document).height();
        windowHeight = $(window).height();

        if(main.length && contentHeader.length){
            main.css('marginTop', contentHeader.innerHeight());
        }

        if(postSidebar.length){
            postSidebar.css({top: 0, width: '20%'}).removeClass('fixed fixedBot');
        }
	});

	$(window).load(function(){
        docHeight = $(document).height();

        if(contentHeader.length){
            if(main.length){
                main.css('marginTop', contentHeader.innerHeight());
            }
            if(contentHeader.find('h1').length){
                var splitText = new SplitText(contentHeader.find('h1'), {type:'words'});
                contentHeader.find('h1').css('opacity', 1);
                animTxt(splitText);
            }
        }

        if(postSidebar.length){
            postSidebarTop = postSidebar.offset().top;
            //postSidebarPos = postSidebar.position().top;
        }
	});

});
