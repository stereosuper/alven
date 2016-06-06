$(function(){

    var htmlTag = $('html'), body = $('body'),
        myScroll = 0, scrollDir = 0, lastScrollTop = 0,
        header = $('#header'), headerHeight = header.innerHeight(),
        mainContent = $('#mainContent'),
        readIndicator = $('#readIndicator'),
        docHeight = $(document).height(),
        windowHeight = $(window).height(),
        windowWidth = $(window).width(),
        buttons = $('.btn'),
        buttonsInvert = $('.btn-invert'),
        main = $('#main'),
        contentHeader = $('#contentHeader'),
        postSidebar = $('#postSidebar'),
        postSidebarTop = 0 /*postSidebarPos = 0,*/, postSidebarWidth = 0,
        spotlightPost = $('#spotlightPost'),
        spotlightDrag = false,
        related = $('#related'),
        menu = $('#menu-responsive'),
        portfolio = $('#portfolio'),
        controller = new ScrollMagic.Controller();

    /**** VARIABLES ****/


    /**** INIT ****/

    function detectScrollDir(){
        scrollDir = myScroll > lastScrollTop ? -1 : 1;
        lastScrollTop = myScroll;
    }



    function setButtons(buttons){
        var i = 0, nbButtons = buttons.length, letterArray = [],
            textBtn = '', j = 0, nbLetter = 0, newHtmlBtn = '', newHtmlBtnAfter = '',
            delay = 0;
        for(i; i<nbButtons; i++){
            textBtn = buttons.eq(i).html();
            letterArray = textBtn.split('');
            j = 0;
            nbLetter = letterArray.length;
            newHtmlBtn = '';
            newHtmlBtnAfter = '';
            delay = 0;
            for(j; j<nbLetter; j++){
                delay += 0.013;
                delay = Math.round(delay*1000) / 1000;
                if(letterArray[j] === ' '){
                    letterArray[j] = '&nbsp;';
                    newHtmlBtn += '</span><span class="word">';
                    newHtmlBtnAfter += '</span><span class="word">';
                }
                newHtmlBtn += '<span style="transition-delay:'+delay+'s">'+letterArray[j]+'</span>';
                newHtmlBtnAfter += '<span style="transition-delay:'+(delay+0.15)+'s">'+letterArray[j]+'</span>';
            }
            buttons.eq(i).html('<span class="bg"></span><span class="before"><span class="word">'+newHtmlBtn+'</span></span><span class="after"><span class="word">'+newHtmlBtnAfter+'</span></span>');
        }
    }

    function setSpotlightPost(){
        var posts = spotlightPost.find('.spotlight-post'),
            spotlightWidth = spotlightPost.find('.container').innerWidth();

        function detectVisiblePosts(){
            var i = 0, nbPosts = posts.length, postWidth = posts.eq(0).innerWidth();
            for(i; i<nbPosts; i++){
                var postPos = posts.eq(i).offset().left + postWidth;
                if(postPos > windowWidth || postPos < postWidth){
                    posts.eq(i).addClass('off');
                }else{
                    posts.eq(i).removeClass('off');
                }
            }
        }

        detectVisiblePosts();

        if(windowWidth < spotlightWidth){
            if(!spotlightDrag){
                spotlightDrag = Draggable.create( '#spotlightDrag', {
                    type: 'x',
                    bounds: spotlightPost,
                    cursor: 'grab',
                    onDrag: detectVisiblePosts,
                    onDragStart: function(){
                        spotlightPost.find('.container').addClass('grabbing');
                    },
                    onDragEnd: function(){
                        spotlightPost.find('.container').removeClass('grabbing');
                    }
                } );
            }else{
                spotlightDrag[0].enable();
            }
        }else{
            if(spotlightDrag){
                spotlightDrag[0].disable();
                TweenMax.set(spotlightDrag, {x: '0px'});
            }
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
                    postSidebar.css({top: contentHeight - sidebarMargin - sidebarHeight + 20, width: postSidebarWidth}).removeClass('fixed').addClass('fixedBot');
                }else{
                    postSidebar.css({top: headerHeight + sidebarMargin, width: postSidebarWidth}).removeClass('fixedBot').addClass('fixed');
                }

                if(myScroll > (contentHeight+contentTop)/2){
                    postSidebar.find('li').eq(0).find('.img').addClass('off');
                    postSidebar.find('li').eq(1).find('.img').addClass('on');
                }else{
                    postSidebar.find('li').eq(0).find('.img').removeClass('off');
                    postSidebar.find('li').eq(1).find('.img').removeClass('on');
                }
            }else{
                postSidebar.css({top: 0, width: postSidebarWidth}).removeClass('fixed fixedBot');
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

    function setScrollElmts(elmts){
        var nbElmts = elmts.length, i = 0;

        TweenMax.set(elmts, {opacity: 0});

        for(i; i<nbElmts; i++){
            new ScrollMagic.Scene({ triggerElement: elmts[i] })
                .triggerHook(0.7)
                .setTween( TweenMax.to(elmts.eq(i), 0.25, {opacity: 1}) )
                //.addIndicators()
                .addTo(controller);
        }
    }

    function setMenuElmts(){
        TweenMax.set(menu.find('.menu-title'), {y: '-100%', opacity: 0});
        TweenMax.set(menu.find('.menu-subtitle'), {y: '-100%', opacity: 0});
        TweenMax.set(menu.find('li'), {y: '-120%', opacity: 0});
    }


    function setPortfolio(poItem, nbPoItem, nbCol){
        var portfolioContent = '<div class="grid">', poItemIndex = 0,
            total = 0, i = 0, j = 0, ratio1 = 0.1, ratio2 = 0.4,
            transfered, nbTrItem = 0;

        function lightTransfered(x){
            if(x === nbTrItem){
                x = 0;
            }
            transfered.removeClass('on');
            setTimeout(function(){
                transfered.eq(x).addClass('on');
            }, 1500);
            setTimeout(lightTransfered, 3500, x+1);
        }

        if(nbPoItem > 37){
            ratio1 += 0.02;
            ratio2 -= 0.02;
        }
        if(nbPoItem > 60){
            ratio1 += 0.05;
            ratio2 -= 0.05;
        }

        var firstNbItem = Math.ceil(ratio1*nbPoItem),
            secondNbItem = Math.ceil(ratio2*nbPoItem),
            lastNbItem = nbPoItem - (firstNbItem + secondNbItem),
            arrayCols = [
                firstNbItem,
                Math.floor(secondNbItem/2),
                Math.ceil(secondNbItem/2),
                Math.ceil(lastNbItem/3),
                Math.ceil(lastNbItem/3),
                Math.floor(lastNbItem/3)
            ];

        for(i; i<nbCol; i++){
            total += arrayCols[i];
        }
        if(total > nbPoItem){
            arrayCols[4] -= 1;
        }

        i = 0;
        for(i; i<nbCol; i++){
            portfolioContent += '<div class="po-item-col col-2">';
            j = 0;
            for(j; j<arrayCols[i]; j++){
                if(i === 3 && j === arrayCols[i]-1){
                    portfolioContent += '<div class="po-item cta">'+$('#ctaPortfolio').html()+'</div>';
                }
                portfolioContent += '<div class="po-item">'+portfolio.find('li').eq(j+poItemIndex).html()+'</div>';
            }
            poItemIndex += j;
            portfolioContent += '</div>';
        }
        portfolioContent += '</div>';
        portfolio.find('.container').append(portfolioContent);

        TweenMax.set(portfolio.find('.po-item'), {opacity: 0, y: '30%', scale: 0.8});
        i = 0;
        for(i; i<nbPoItem+1; i++){
            new ScrollMagic.Scene({ triggerElement: portfolio.find('.po-item')[i] })
                .triggerHook(0.9)
                .setTween( TweenMax.to(portfolio.find('.po-item').eq(i), 0.25, {opacity: 1, y: '0%', scale: 1}) )
                //.addIndicators()
                .addTo(controller);
        }

        transfered = portfolio.find('div.grid').find('.transfered');
        nbTrItem = transfered.length;
        //lightTransfered(0);
    }



    isMobile.any ? htmlTag.addClass('is-mobile') : htmlTag.addClass('is-desktop');

    if(buttons.length){
        setButtons(buttons);
        setScrollElmts(buttons);
    }
    if(buttonsInvert.length){
        setButtons(buttonsInvert);
        setScrollElmts(buttonsInvert);
    }

    if(spotlightPost.length){
        setSpotlightPost();

        TweenMax.set(spotlightPost.find('.spotlight-post'), {y: '-100%'});

        new ScrollMagic.Scene({ triggerElement: '#spotlightPost' })
            .triggerHook(0.9)
            .setTween( TweenMax.staggerTo(spotlightPost.find('.spotlight-post'), 0.25, {y: '0%'}, 0.1) )
            //.addIndicators()
            .addTo(controller);
    }

    if(related.length){
        var relatedPosts = related.find('.read-also-post');
        TweenMax.set(relatedPosts, {opacity: 0});

        new ScrollMagic.Scene({ triggerElement: '#related' })
            .triggerHook(0.7)
            .setTween( TweenMax.staggerTo(relatedPosts, 0.25, {opacity: 1}, 0.1) )
            //.addIndicators()
            .addTo(controller);
    }

    if(mainContent.length){
        if(mainContent.find('img').length){
            var imgs = mainContent.find('img').not('.no-scroll');
            setScrollElmts(imgs);
        }
    }

    if(portfolio.length){
        var poItem = portfolio.find('li'), nbPoItem = poItem.length, nbCol = 6;

        if(nbPoItem > nbCol){
            setPortfolio(poItem, nbPoItem, nbCol);
        }
    }

    if(menu.length){
        setMenuElmts();
    }


    $('#burger').on('click', function(e){
        e.preventDefault();
        htmlTag.toggleClass('menu-open');
        if(htmlTag.hasClass('menu-open')){
            setTimeout(function(){
                var i = 0, nbMenu = menu.find('.menu-small').length;

                for(i; i<nbMenu; i++){
                    TweenMax.to(menu.find('.menu-title').eq(i), 0.25, {y: '0%', opacity: 1});
                    TweenMax.to(menu.find('.menu-subtitle').eq(i), 0.25, {y: '0%', opacity: 1}).delay(0.05);
                    TweenMax.staggerTo(menu.find('.menu-small').eq(i).find('li'), 0.25, {y: '0%', opacity: 1}, 0.08);
                }
            }, 380);
        }else{
            setMenuElmts();
        }
    });

    $('input').on('change', function(){
        $(this).val() ? $(this).addClass('filled') : $(this).removeClass('filled');
    });


    $(document).scroll(function(){
        myScroll = $(document).scrollTop();
        detectScrollDir();

        if(mainContent.length && !htmlTag.hasClass('menu-open')){
            myScroll > mainContent.offset().top - headerHeight - 40 ? header.addClass('fixed') : header.removeClass('fixed');
            if(header.hasClass('fixed')){
                scrollDir < 0 ? header.addClass('on') : header.removeClass('on');
            }
        }

        if(readIndicator.length && (body.hasClass('single') || body.hasClass('page-template-default'))){
            var readingPercent = (myScroll-mainContent.offset().top)/(mainContent.innerHeight()-windowHeight);
            if(myScroll > mainContent.offset().top){
                TweenMax.set(readIndicator, {scaleX: readingPercent});
            }
        }

        if(contentHeader.length && !isMobile.any){
            TweenMax.set(contentHeader.find('h1'), {y: '-'+myScroll/4+'px'});
            if(contentHeader.find('.img').length){
                TweenMax.set(contentHeader.find('.img'), {y: '-'+myScroll/40+'%'});
            }
            if(contentHeader.find('.menu-home').length){
                TweenMax.set(contentHeader.find('.menu-home'), {y: '-'+myScroll/4+'px'});
            }
        }

        if(postSidebar.length && mainContent.length && !isMobile.any){
            setSidebarScroll();
        }
    });

    $(window).resize(function(){
        docHeight = $(document).height();
        windowHeight = $(window).height();
        windowWidth = $(window).width();

        if(windowWidth > 979){
            htmlTag.removeClass('menu-open');
        }

        if(main.length && contentHeader.length){
            main.css('marginTop', contentHeader.innerHeight());
        }

        if(postSidebar.length){
            postSidebar.css({top: 0, width: '20%'}).removeClass('fixed fixedBot');
            postSidebarTop = postSidebar.offset().top;
            postSidebarWidth = postSidebar.innerWidth() - 1;
        }

        if(spotlightPost.length){
            setSpotlightPost();
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
            postSidebarWidth = postSidebar.innerWidth() - 1;
            //postSidebarPos = postSidebar.position().top;
        }
	});

});
