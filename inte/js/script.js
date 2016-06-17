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
    var team = $('.team'), teamDrag = false, teamMemberWidth, teamWidth, gridWidth, imgTeamHeight, teamMemberHeight;
    var h = $(window).height(), w = $(window).width(), nh = $(window).height(), nw = $(window).width();



    /**** INIT ****/

    function detectScrollDir(myScroll){
        var scrollDir = myScroll > lastScrollTop ? -1 : 1;
        lastScrollTop = myScroll;
        return scrollDir;
    }

    /*function setButtons(buttons){
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
    }*/

    function setBtn(btn){
        var txt = btn.html();
        return '<span class="before">' + txt + '</span><span class="after">' + txt +'</span>';
    }

    function setHeaderScroll(myScroll, scrollDir){
        if(mainContent.length && contentHeader.length && !htmlTag.hasClass('menu-open')){
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
                    throwProps: true,
                    edgeResistance:0.65,
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
                if(!$('.grid').hasClass('is-hovered')){
                    var aze = poItems.eq(y);
                    $('a', aze).addClass('on');
                }
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
        //setButtons(buttons);
        buttons.each(function(i){
            buttons.eq(i).html(setBtn(buttons.eq(i)));
        });
    }
    if(buttonsInvert.length){
        //setButtons(buttonsInvert);
        buttonsInvert.each(function(i){
            buttonsInvert.eq(i).html(setBtn(buttonsInvert.eq(i)));
        });
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

        portfolio.find('.po-item a').hover(
            function(){
                $(this).closest('.grid').addClass('is-hovered');
                $(this).addClass('link-hovered');
                portfolio.find('.po-item a').removeClass('on');
            }, function(){
                $(this).closest('.grid').removeClass('is-hovered');
                $(this).removeClass('link-hovered');
            }
        );
    }
    
    if(team.length){
        var teamMember = team.find('.team-member');
        var desc, heightDesc, liParent, tlTeam,
            currentLi, currentDesc, tlTeamCurrent,
            newLi, newDesc, heightNewDesc,
            liTeamOpen, descOpen, heightDescOpen, descResponsive = $('.content-desc-responsive'), heightDescResponsive;
        
        teamPosition();
        updateBtnGlob();

        teamMember.on('click', function(e){
            e.preventDefault();
            liParent = $(this).closest('li');
            desc = $('.desc', liParent);
            heightDesc = desc.outerHeight();
            if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob'))){
                if(!team.hasClass('member-open')){
                    TweenMax.set(team, {className:'+=member-open'});
                    // open new
                    tlTeam = new TimelineMax();
                    tlTeam.set(liParent, {className:'+=open'});
                    if($(window).width() > 979){
                        tlTeam.to(liParent, 0.5, {paddingBottom: heightDesc+'px', ease:Cubic.easeInOut});
                        tlTeam.to(desc, 0.25, {opacity: 1, visibility: 'visible', onComplete: function(){
                            $('html, body').animate( { scrollTop: liParent.offset().top-120 }, 200 );
                        }});
                    }else{
                        descResponsive.html(desc.html());
                        TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                        heightDescResponsive = descResponsive.outerHeight();
                        TweenMax.set(descResponsive, {height: '0', position: 'relative'});
                        tlTeam.to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut});
                        tlTeam.to(descResponsive, 0.25, {opacity: 1, visibility: 'visible', onComplete: function(){
                            $('html, body').animate( { scrollTop: liParent.offset().top-120 }, 200 );
                        }});

                        var teamMemberHeight = Math.max.apply(null, team.find('.team-member').map(function ()
                        {
                            return $(this).height();
                        }).get());
                        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: teamMemberHeight+10+'px', ease:Cubic.easeInOut});
                    }
                }else{
                    if(liParent.hasClass('open')){
                        // close current
                        var currentLi = $('.team.member-open > li.open');
                        currentDesc = $('.desc', currentLi);
                        tlTeamCurrent = new TimelineMax();
                        if($(window).width() > 979){
                            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'});
                            tlTeamCurrent.to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeInOut});
                        }else{
                            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0});
                            tlTeamCurrent.to(descResponsive, 0.5, {height: '0', visibility: 'hidden', ease:Cubic.easeInOut});
                        }
                        tlTeamCurrent.set(currentLi, {className:'-=open'});
                        tlTeamCurrent.set(team, {className:'-=member-open'});
                        //TweenMax.set($('.wrapper-btn-glob'), {clearProps:'height'});
                        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: '100%', ease:Cubic.easeInOut});
                    }else{
                        // close already open and open new
                        var currentLi = $('.team.member-open > li.open');
                        currentDesc = $('.desc', currentLi);
                        tlTeamCurrent = new TimelineMax();

                        if($(window).width() > 979){
                            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'});
                            tlTeamCurrent.set(currentLi, {className:'-=open'});

                            tlTeamCurrent.set(liParent, {className:'+=open'});
                            tlTeamCurrent.add('paddingAnimation')
                            .to(liParent, 0.25, {paddingBottom: heightDesc+'px', ease:Cubic.easeInOut}, 'paddingAnimation')
                            .to(currentLi, 0.25, {paddingBottom: '0', ease:Cubic.easeInOut}, 'paddingAnimation');
                            tlTeamCurrent.to(desc, 0.25, {opacity: 1, visibility: 'visible', onComplete: function(){
                                $('html, body').animate( { scrollTop: liParent.offset().top-120 }, 700);
                            }});
                        }else{
                            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0, visibility: 'hidden'});
                            tlTeamCurrent.set(currentLi, {className:'-=open'});

                            tlTeamCurrent.set(liParent, {className:'+=open', onComplete: function(){
                                descResponsive.html(desc.html());

                                TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                                heightDescResponsive = descResponsive.outerHeight();
                                TweenMax.set(descResponsive, {height: '0', position: 'relative'});
                            }});

                            tlTeamCurrent.to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut});
                            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 1, visibility: 'visible', onComplete: function(){
                                $('html, body').animate( { scrollTop: liParent.offset().top-120 }, 700);
                            }});
                        }
                    }
                }
            }
        });


        $('.btn-desc > li a').on('click', function(e){
            e.preventDefault();
            if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob'))){
                // close already open and open new
                var currentLi = $('.team.member-open > li.open');
                currentDesc = $('.desc', currentLi);
                tlTeamCurrent = new TimelineMax();
                tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'});
                tlTeamCurrent.set(currentLi, {className:'-=open'});
                if($(this).hasClass('left')){
                    if (currentLi.prev().length){
                        newLi = currentLi.prev();
                    }else{
                        newLi = team.find('> li').last();
                    }
                }else{
                    if (currentLi.next().length){
                        newLi = currentLi.next();
                    }else{
                        newLi = team.find('> li').first();
                    }
                }
                newDesc = $('.desc', newLi);
                heightNewDesc = newDesc.outerHeight();
                tlTeamCurrent.set(newLi, {className:'+=open'});
                tlTeamCurrent.add('paddingAnimation')
                .to(newLi, 0.25, {paddingBottom: heightNewDesc+'px', ease:Cubic.easeInOut}, 'paddingAnimation')
                .to(currentLi, 0.25, {paddingBottom: '0', ease:Cubic.easeInOut}, 'paddingAnimation');
                tlTeamCurrent.to(newDesc, 0.25, {opacity: 1, visibility: 'visible', onComplete: function(){
                    $('html, body').animate( { scrollTop: newLi.offset().top-120 }, 200 );
                }});
            }
        });

        $('.container-team .wrapper-btn-glob a').on('click', function(e){
            e.preventDefault();
            if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob'))){
                if($(this).hasClass('left')){
                    TweenMax.to(team, 0.25, {x: '+='+teamMemberWidth, ease:Cubic.easeInOut, onComplete: updateBtnGlob});
                }else{
                    TweenMax.to(team, 0.25, {x: '-='+teamMemberWidth, ease:Cubic.easeInOut, onComplete: updateBtnGlob});
                }
            }
        });
        
    }

    function updateBtnGlob(){
        if($(window).width() <= 979){
            var nbTeamMembers = $('.team > li').length;
            var teamLeft = team.offset().left-20;
            var teamRight = teamLeft+team.width();
            var containerTeamWidth = $('.container-team').width();
            if(nbTeamMembers > 5){
                TweenMax.set($('.wrapper-btn-glob.prev'), {className:'-=open'});
                TweenMax.set($('.wrapper-btn-glob.next'), {className:'-=open'});
                if(teamLeft < 0){
                    TweenMax.set($('.wrapper-btn-glob.prev'), {className:'+=open'});
                }
                if(teamRight > containerTeamWidth){
                    TweenMax.set($('.wrapper-btn-glob.next'), {className:'+=open'});
                }
            }else if(($(window).width() <= 767) && (nbTeamMembers > 3)){
                TweenMax.set($('.wrapper-btn-glob.prev'), {className:'-=open'});
                TweenMax.set($('.wrapper-btn-glob.next'), {className:'-=open'});
                if(teamLeft < 0){
                    TweenMax.set($('.wrapper-btn-glob.prev'), {className:'+=open'});
                }
                if(teamRight > containerTeamWidth){
                    TweenMax.set($('.wrapper-btn-glob.next'), {className:'+=open'});
                }
            }
        }else{
            TweenMax.set($('.wrapper-btn-glob'), {className:'-=open'});
        }
    }

    function teamPosition(){
        if($(window).width() <= 979){
            imgTeamHeight = team.find('.team-member img').eq(0).outerHeight();
            TweenMax.set($('.wrapper-btn-glob a'), {top: (imgTeamHeight/2)+'px'});

            if(!teamDrag){
                if($(window).width() <= 767){
                    teamMemberWidth = $('.container-team').width()/3;
                }else{
                    teamMemberWidth = $('.container-team').width()/5;
                }
                TweenMax.set($('.team > li'), {width: teamMemberWidth+'px'});

                teamWidth = 0;
                $('.team > li').each(function() {
                    teamWidth += $(this).outerWidth();
                });
                TweenMax.set(team, {width: teamWidth+'px'});

                gridWidth = teamMemberWidth;
                teamDrag = Draggable.create( '.team', {
                    type: 'x',
                    bounds: $('.container-team'),
                    cursor: 'grab',
                    throwProps: true,
                    edgeResistance: 0.65,
                    dragClickables: true,
                    snap: {
                        x: function(endValue) {
                            return Math.round(endValue / gridWidth) * gridWidth;
                        }
                    },
                    onThrowComplete: function(){
                        updateBtnGlob();
                    },
                    onDragStart: function(){
                        // close current
                        var currentLi = $('.team.member-open > li.open');
                        currentDesc = $('.desc', currentLi);
                        tlTeamCurrent = new TimelineMax();
                        if($(window).width() > 979){
                            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'});
                            tlTeamCurrent.to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeInOut});
                        }else{
                            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0});
                            tlTeamCurrent.to(descResponsive, 0.5, {height: '0', visibility: 'hidden', ease:Cubic.easeInOut});
                        }
                        tlTeamCurrent.set(currentLi, {className:'-=open'});
                        tlTeamCurrent.set(team, {className:'-=member-open'});
                        //TweenMax.set($('.wrapper-btn-glob'), {clearProps:'height'});
                        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: '100%', ease:Cubic.easeInOut});
                    }
                });
            }else{
                if($(window).width() <= 767){
                    teamMemberWidth = $('.container-team').width()/3;
                }else{
                    teamMemberWidth = $('.container-team').width()/5;
                }
                TweenMax.set($('.team > li'), {width: teamMemberWidth+'px'});
                teamWidth = 0;
                $('.team > li').each(function() {
                    teamWidth += $(this).outerWidth();
                });
                TweenMax.set(team, {width: teamWidth+'px'});

                gridWidth = teamMemberWidth;
                teamDrag = Draggable.create( '.team', {
                    type: 'x',
                    bounds: $('.container-team'),
                    cursor: 'grab',
                    throwProps: true,
                    edgeResistance: 0.65,
                    dragClickables: true,
                    snap: {
                        x: function(endValue) {
                            return Math.round(endValue / gridWidth) * gridWidth;
                        }
                    },
                    onThrowComplete: function(){
                        updateBtnGlob();
                    },
                    onDragStart: function(){
                        // close current
                        var currentLi = $('.team.member-open > li.open');
                        currentDesc = $('.desc', currentLi);
                        tlTeamCurrent = new TimelineMax();
                        if($(window).width() > 979){
                            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'});
                            tlTeamCurrent.to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeInOut});
                        }else{
                            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0});
                            tlTeamCurrent.to(descResponsive, 0.5, {height: '0', visibility: 'hidden', ease:Cubic.easeInOut});
                        }
                        tlTeamCurrent.set(currentLi, {className:'-=open'});
                        tlTeamCurrent.set(team, {className:'-=member-open'});
                        //TweenMax.set($('.wrapper-btn-glob'), {clearProps:'height'});
                        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: '100%', ease:Cubic.easeInOut});
                    }
                });
            }
        }else{
            if(teamDrag){
                TweenMax.set($('.team'), {clearProps:'all'});
                TweenMax.set($('.team > li'), {clearProps:'width'});
                teamDrag[0].disable();
            }
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
            main.css('marginTop', Math.floor(contentHeader.innerHeight()));
        }

        if(postSidebar.length){
            postSidebar.css({top: 0, width: '20%'}).removeClass('fixed fixedBot');
            postSidebarTop = postSidebar.offset().top;
            postSidebarWidth = postSidebar.innerWidth();
        }

        if(spotlightPost.length){
            setSpotlightPost();
        }

        if(team.length){
            if(team.hasClass('member-open')){
                liTeamOpen = $('.team.member-open > li.open');
                descOpen = $('.desc', liTeamOpen);
                heightDescOpen = descOpen.outerHeight();
                TweenMax.set(liTeamOpen, {paddingBottom: heightDescOpen+'px', ease:Cubic.easeInOut});
            }
            teamPosition();
            updateBtnGlob();
        }

        nh = $(window).height();
        nw = $(window).width();
        if (nw != w){
            // Le resize se fait au moins sur la largeur, p-e sur la largeur et la hauteur
            if(team.length){
                if(team.hasClass('member-open')){
                    TweenMax.set($('.team.member-open > li.open .desc'), {clearProps:'all'});
                    TweenMax.set($('.team.member-open > li.open'), {className:'-=open', clearProps:'all'});
                    TweenMax.set($('.content-desc-responsive'), {clearProps:'all'});
                    TweenMax.set(team, {className:'-=member-open'});
                }
            }
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
            main.css('marginTop', Math.floor(contentHeader.innerHeight()));
        }
        if(contentHeader.find('h1').length){
            var splitText = new SplitText(contentHeader.find('h1'), {type:'words'});
            contentHeader.find('h1').css('opacity', 1);
            animTxt(splitText);
        }
    }
});
