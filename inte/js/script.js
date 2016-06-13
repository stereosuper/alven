'use strict';

$(function(){

    /**** VARIABLES ****/

    var docHeight = $(document).height(), windowHeight = $(window).height(), windowWidth = $(window).width();

    var controller = new ScrollMagic.Controller(), lastScrollTop = 0, myScroll = $(document).scrollTop(), scrollDir = 0;

    var htmlTag = $('html'), body = $('body');
    var header = $('#header'), headerHeight = header.innerHeight();
    var mainContent = $('#mainContent'), main = $('#main');
    var readIndicator = $('#readIndicator');
    var buttons = $('.btn'), buttonsInvert = $('.btn-invert');
    var contentHeader = $('#contentHeader');
    var postSidebar = $('#postSidebar'), postSidebarTop = 0 /*postSidebarPos = 0,*/, postSidebarWidth = 0;
    var spotlightPost = $('#spotlightPost'), spotlightDrag = false;
    var related = $('#related');
    var menu = $('#menu-responsive');
    var portfolio = $('#portfolio');
    var team = $('.team');



    /**** INIT ****/

    function detectScrollDir(myScroll){
        var scrollDir = myScroll > lastScrollTop ? -1 : 1;
        lastScrollTop = myScroll;
        return scrollDir;
    }

    function setButtons(buttons){
        var i = 0, tlBeforeButtons = [], tlAfterButtons = [],
            mySplitTextBeforeButtons = [], mySplitTextAfterButtons = [],
            charsBeforeButtons = [], charsAfterButtons = [], nbButtons = buttons.length,
            textBtn;

        for(i; i<nbButtons; i++){
            textBtn = buttons.eq(i).html();
            buttons.eq(i).html('<span class="bg"></span><span class="before">'+textBtn+'</span><span class="after">'+textBtn+'</span>');

            tlBeforeButtons[i] = new TimelineMax();
            mySplitTextBeforeButtons[i] = new SplitText($('.before', buttons.eq(i)), {type:'words,chars'});
            charsBeforeButtons[i] = mySplitTextBeforeButtons[i].chars;

            tlAfterButtons[i] = new TimelineMax();
            mySplitTextAfterButtons[i] = new SplitText($('.after', buttons.eq(i)), {type:'words,chars'});
            charsAfterButtons[i] = mySplitTextAfterButtons[i].chars;
            TweenMax.set(charsAfterButtons[i], {y:40, opacity: 0});
        }

        buttons.hover(
            function(){
                var indexButtonHovered = buttons.index(this);
                tlBeforeButtons[indexButtonHovered].staggerTo(charsBeforeButtons[indexButtonHovered], 0.2, {y:-40, opacity: 0, ease:Cubic.easeIn}, 0.013);
                tlAfterButtons[indexButtonHovered].staggerTo(charsAfterButtons[indexButtonHovered], 0.2, {y:0, opacity: 1, delay: 0.1, ease:Cubic.easeIn}, 0.013);
            }, function(){
                var indexButtonHovered = buttons.index(this);
                tlBeforeButtons[indexButtonHovered].staggerTo(charsBeforeButtons[indexButtonHovered], 0.2, {y:0, opacity: 1, delay: 0.1, ease:Cubic.easeOut}, 0.013);
                tlAfterButtons[indexButtonHovered].staggerTo(charsAfterButtons[indexButtonHovered], 0.2, {y:40, opacity: 0, ease:Cubic.easeIn}, 0.013);
            }
        );
    }

    function setHeaderScroll(myScroll, scrollDir){
        if(mainContent.length && !htmlTag.hasClass('menu-open')){
            myScroll > mainContent.offset().top - headerHeight - 40 ? header.addClass('fixed') : header.removeClass('fixed');
            if(header.hasClass('fixed')){
                scrollDir < 0 ? header.addClass('on') : header.removeClass('on');
            }
        }

        if(readIndicator.length && (body.hasClass('single-post') || body.hasClass('page-template-default'))){
            var readingPercent = (myScroll-mainContent.offset().top)/(mainContent.innerHeight()-windowHeight);
            if(myScroll > mainContent.offset().top){
                TweenMax.set(readIndicator, {scaleX: readingPercent});
            }
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

    function setSidebarScroll(myScroll){
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
        TweenMax.set([menu.find('.menu-title'), menu.find('.menu-subtitle')], {y: '-100%', opacity: 0});
        TweenMax.set(menu.find('li'), {y: '-120%', opacity: 0});
    }


    function setPortfolio(poItem, nbPoItem, nbCol){
        var portfolioContent = '<div class="grid">', poItemIndex = 0,
            total = 0, i = 0, j = 0, ratio1 = 0.1, ratio2 = 0.4,
            transfered, nbTrItem = 0, poItems;

        /*function lightTransfered(x){
            if(x === nbTrItem){
                x = 0;
            }
            transfered.removeClass('on');
            setTimeout(function(){
                transfered.eq(x).addClass('on');
            }, 1500);
            setTimeout(lightTransfered, 3500, x+1);
        }*/

        function lightTransferedPoItems(y){
            var newElemNumber = Math.floor(Math.random() * nbPoItem);
            $('a', poItems).removeClass('on');
            setTimeout(function(){
                var aze = poItems.eq(y);
                $('a', aze).addClass('on');
            }, 1500);
            setTimeout(lightTransferedPoItems, 3500, newElemNumber);
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

        poItems = portfolio.find('.po-item');
        lightTransferedPoItems(0);
    }



    isMobile.any ? htmlTag.addClass('is-mobile') : htmlTag.addClass('is-desktop');

    setHeaderScroll(myScroll, scrollDir);

    if(buttons.length){
        setButtons(buttons);
        setScrollElmts(buttons);
    }
    if(buttonsInvert.length){
        setButtons(buttonsInvert);
        setScrollElmts(buttonsInvert);
    }

    if(mainContent.length && mainContent.find('img').length){
        var imgs = mainContent.find('img').not('.no-scroll');
        setScrollElmts(imgs);
    }

    if(postSidebar.length){
        postSidebarTop = postSidebar.offset().top;
        postSidebarWidth = postSidebar.innerWidth();
    }

    if(spotlightPost.length){
        setSpotlightPost();

        TweenMax.set(spotlightPost.find('.spotlight-post'), {y: '-120%'});

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

    if(portfolio.length){
        var poItem = portfolio.find('li'), nbPoItem = poItem.length, nbCol = 6;

        if(nbPoItem > nbCol){
            setPortfolio(poItem, nbPoItem, nbCol);
        }
    }

    if(team.length){
        var teamMember = team.find('.team-member');
        teamMember.on('click', function(e){
            e.preventDefault();
            var desc, heightDesc, liParent, tlTeam;
            liParent = $(this).closest('li');
            desc = $('.desc', liParent);
            heightDesc = desc.outerHeight();
            if(!team.hasClass('member-open')){
                TweenMax.set(team, {className:'+=member-open'});
                // open new
            }else{
                if(liParent.hasClass('open')){
                    // close current
                }else{
                    // close already open and open new
                }
            }

            tlTeam = new TimelineMax();
            TweenMax.set(liParent, {className:'+=open'});
            tlTeam.to(liParent, 0.25, {paddingBottom: heightDesc+'px'});
            tlTeam.to(desc, 0.25, {opacity: 1});
        });
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


    $(document).on('scroll', function(){
        var myScroll = $(document).scrollTop(), scrollDir = detectScrollDir(myScroll);

        setHeaderScroll(myScroll, scrollDir);

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
            setSidebarScroll(myScroll);
        }
    });

    $(window).on('resize', function(){
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
            postSidebarWidth = postSidebar.innerWidth();
        }

        if(spotlightPost.length){
            setSpotlightPost();
        }
	});

});

$(window).on('load', function(){
    var main = $('#main');
    var contentHeader = $('#contentHeader');

    function animTxt(splitText){
        splitText.split({type:'words'});
        TweenMax.staggerFrom(splitText.words, 0.3, {ease:Expo.easeInOut, opacity:0, y:100}, 0.03);
    }

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
});
