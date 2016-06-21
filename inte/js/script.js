'use strict';

$(function(){

    /**** VARIABLES ****/

    var docHeight = $(document).height(), windowHeight = $(window).height(), windowWidth = $(window).width(), windowWidthOnReady = windowWidth;

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
    var team = $('.team'), teamDrag = false, teamMemberWidth, decalageMemberWidth, teamWidth, gridWidth, imgTeamHeight, teamMemberHeight, offsetYtoScroll;



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
            transfered, nbTrItem = 0, poItems, colCta = 3, posCta;

        function lightTransferedPoItems(y){
            var poItemsNotTransfered = portfolio.find('.po-item:not(.transfered)'), poItemNotTransfered = portfolio.find('li:not(.transfered)'), nbPoItemNotTransfered = poItemNotTransfered.length;
            var newElemNumber = Math.floor(Math.random() * nbPoItemNotTransfered);
            poItems.find('a').removeClass('on');
            setTimeout(function(){
                if(!portfolio.find('div.grid').hasClass('is-hovered') && !poItemsNotTransfered.eq(y).hasClass('cta')){
                    poItemsNotTransfered.eq(y).find('a').addClass('on');
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

        var currentNb,
            firstNbItem = Math.ceil(ratio1*nbPoItem),
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

        if(nbCol === 3){
            arrayCols = [
                firstNbItem + Math.floor(secondNbItem/2),
                Math.ceil(secondNbItem/2) + Math.ceil(lastNbItem/3),
                Math.ceil(lastNbItem/3) + Math.floor(lastNbItem/3)
            ];
            colCta = 1;
        }

        for(i; i<nbCol; i++){
            total += arrayCols[i];
        }
        if(total > nbPoItem){
            arrayCols[nbCol-2] -= 1;
        }

        currentNb = 0;
        i = 0;
        for(i; i<nbCol; i++){
            portfolioContent += '<div class="po-item-col col-2">';
            j = 0;
            posCta = colCta === 1 ? Math.floor(arrayCols[i]/2) : arrayCols[i]-1;
            for(j; j<arrayCols[i]; j++){
                if(i === colCta && j === posCta){
                    portfolioContent += '<div class="po-item cta">'+$('#ctaPortfolio').html()+'</div>';
                }
                if($('ul.grid > li').eq(currentNb).hasClass('transfered')){
                    portfolioContent += '<div class="po-item transfered">'+portfolio.find('li').eq(j+poItemIndex).html()+'</div>';
                }else{
                    portfolioContent += '<div class="po-item">'+portfolio.find('li').eq(j+poItemIndex).html()+'</div>';
                }
                currentNb++;
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
        poItems = portfolio.find('.po-item');
        lightTransferedPoItems(0);

        poItems.find('a').on('mouseenter', function(){
            if(!$(this).closest('.po-item').hasClass('cta')){
                $(this).closest('.po-item').addClass('link-hovered').closest('.grid').addClass('is-hovered');
                poItems.find('a').removeClass('on');
            }
        }).on('mouseleave', function(){
            $(this).closest('.po-item').removeClass('link-hovered').closest('.grid').removeClass('is-hovered');
        });
    }


    function updateBtnGlob(){
        if($(window).width() <= 979){
            var nbTeamMembers = $('.team > li').length;
            var teamLeft = team.offset().left-20;
            var teamRight = teamLeft+team.width();
            var containerTeamWidth = $('.container-team').width();
            var posiLiOpen = 0;
            var offsetLiOpen = 0;

            if(team.find('li').hasClass('open')){
                posiLiOpen = team.find('> li.open').position().left;
                offsetLiOpen = team.find('> li.open').offset().left;
            }
            if(($(window).width() > 767) && (nbTeamMembers > 5)){
                TweenMax.set($('.wrapper-btn-glob.prev'), {className:'-=open'});
                TweenMax.set($('.wrapper-btn-glob.next'), {className:'-=open'});
                if(teamLeft < -Math.ceil(teamMemberWidth*2)){
                    TweenMax.set($('.wrapper-btn-glob.prev'), {className:'+=open'});
                }
                if(Math.ceil(teamRight+teamMemberWidth*2) > containerTeamWidth){
                    TweenMax.set($('.wrapper-btn-glob.next'), {className:'+=open'});
                }
            }else if(($(window).width() <= 767) && (nbTeamMembers > 3)){
                TweenMax.set($('.wrapper-btn-glob.prev'), {className:'-=open'});
                TweenMax.set($('.wrapper-btn-glob.next'), {className:'-=open'});
                if(teamLeft < -Math.ceil(teamMemberWidth)){
                    TweenMax.set($('.wrapper-btn-glob.prev'), {className:'+=open'});
                }
                if(Math.ceil(teamRight+teamMemberWidth) > containerTeamWidth){
                    TweenMax.set($('.wrapper-btn-glob.next'), {className:'+=open'});
                }
            }
        }else{
            TweenMax.set($('.wrapper-btn-glob'), {className:'-=open'});
        }
    }

    function closeBtnGlob(){
        TweenMax.set($('.wrapper-btn-glob'), {className:'-=open'});
    }

    function teamPosition(){
        if($(window).width() <= 979){
            imgTeamHeight = team.find('.team-member img').eq(0).outerHeight();
            TweenMax.set($('.wrapper-btn-glob a'), {top: (imgTeamHeight/2)+'px'});
            if(!teamDrag){
                if($(window).width() <= 767){
                    teamMemberWidth = $('.container-team').width()/3;
                    decalageMemberWidth = teamMemberWidth;
                }else{
                    teamMemberWidth = $('.container-team').width()/5;
                    decalageMemberWidth = teamMemberWidth*2;
                }
                TweenMax.set($('.team > li'), {width: teamMemberWidth+'px'});

                teamWidth = 0;
                $('.team > li').each(function() {
                    teamWidth += $(this).outerWidth();
                });
                teamWidth += (decalageMemberWidth*2);
                TweenMax.set(team, {width: teamWidth+'px', padding: '0 '+decalageMemberWidth+'px', x: -decalageMemberWidth});

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
                    onDragStart: function(){
                        closeBtnGlob();
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
                        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: '100%', ease:Cubic.easeInOut});
                    }
                });
            }else{
                if($(window).width() <= 767){
                    teamMemberWidth = $('.container-team').width()/3;
                    decalageMemberWidth = teamMemberWidth;
                }else{
                    teamMemberWidth = $('.container-team').width()/5;
                    decalageMemberWidth = teamMemberWidth*2;
                }
                TweenMax.set($('.team > li'), {width: teamMemberWidth+'px'});
                teamWidth = 0;
                $('.team > li').each(function() {
                    teamWidth += $(this).outerWidth();
                });
                teamWidth += (decalageMemberWidth*2);
                TweenMax.set(team, {width: teamWidth+'px', padding: '0 '+decalageMemberWidth+'px', x: -decalageMemberWidth});

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
                    onDragStart: function(){
                        closeBtnGlob();
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

    function openTeamMember(teamClique){
        liParent = teamClique.closest('li');
        desc = $('.desc', liParent);
        heightDesc = desc.outerHeight();
        if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob'))){
            if(!team.hasClass('member-open')){
                offsetYtoScroll = liParent.offset().top-120;
                TweenMax.set(team, {className:'+=member-open'});
                // open new
                tlTeam = new TimelineMax();
                tlTeam.set(liParent, {className:'+=open'});
                updateBtnGlob();
                if($(window).width() > 979){
                    tlTeam.add('paddingAnimation')
                    .to(liParent, 0.5, {paddingBottom: heightDesc+'px', ease:Cubic.easeOut}, 'paddingAnimation')
                    .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'paddingAnimation');
                    tlTeam.to(desc, 0.25, {opacity: 1, visibility: 'visible'});
                }else{
                    descResponsive.html(desc.html());
                    TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                    heightDescResponsive = descResponsive.outerHeight();
                    TweenMax.set(descResponsive, {height: '0', position: 'relative'});

                    tlTeam.add('heightAnimation')
                    .to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut}, 'heightAnimation')
                    .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'heightAnimation');
                    tlTeam.to(descResponsive, 0.25, {opacity: 1, visibility: 'visible'});

                    var teamMemberHeight = Math.max.apply(null, team.find('.team-member').map(function ()
                    {
                        return $(this).height();
                    }).get());
                    TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: teamMemberHeight+10+'px', ease:Cubic.easeInOut});

                    // Centrer cliqué
                    posiLiClique = liParent.position().left;
                    containerTeamWidth = $('.container-team').width();
                    posiToGo = posiLiClique-containerTeamWidth/2+liParent.outerWidth()/2;
                    TweenMax.to(team, 0.5, {x:-posiToGo, ease:Cubic.easeOut, onComplete: updateBtnGlob});
                }
            }else{
                if(liParent.hasClass('open')){
                    // close current
                    closeCurrentTeamMember();
                }else{
                    // close already open and open new
                    var currentLi = $('.team.member-open > li.open');
                    currentDesc = $('.desc', currentLi);
                    tlTeamCurrent = new TimelineMax();

                    if($(window).width() > 979){
                        if(currentLi.offset().top < liParent.offset().top){
                            offsetYtoScroll = team.offset().top+liParent.position().top-parseFloat(currentLi.css('paddingBottom'))-120;
                        }else{
                            offsetYtoScroll = team.offset().top+liParent.position().top-120;
                        }

                        tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'});
                        tlTeamCurrent.set(currentLi, {className:'-=open'});


                        tlTeamCurrent.set(liParent, {className:'+=open'});
                        tlTeamCurrent.add('paddingAnimation')
                        .to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeInOut}, 'paddingAnimation')
                        .to(liParent, 0.25, {paddingBottom: heightDesc+'px', ease:Cubic.easeIn}, 'paddingAnimation')
                        .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'paddingAnimation');

                        tlTeamCurrent.to(desc, 0.25, {opacity: 1, visibility: 'visible'});
                    }else{
                        offsetYtoScroll = liParent.offset().top-120;

                        tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0, visibility: 'hidden'});
                        tlTeamCurrent.set(currentLi, {className:'-=open'});

                        tlTeamCurrent.set(liParent, {className:'+=open', onComplete: function(){
                            descResponsive.html(desc.html());

                            TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                            heightDescResponsive = descResponsive.outerHeight();
                            TweenMax.set(descResponsive, {height: '0', position: 'relative'});

                            tlTeamCurrent.add('heightAnimation')
                            .to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut}, 'heightAnimation')
                            .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'heightAnimation');
                            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 1, visibility: 'visible'});

                            // Centrer cliqué
                            posiLiClique = liParent.position().left;
                            containerTeamWidth = $('.container-team').width();
                            posiToGo = posiLiClique-containerTeamWidth/2+liParent.outerWidth()/2;
                            TweenMax.to(team, 0.5, {x:-posiToGo, ease:Cubic.easeOut, onComplete: updateBtnGlob});
                        }});
                        
                    }
                }
            }
        }
    }

    function closeCurrentTeamMember(){
        closeBtnGlob();
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
        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: '100%', ease:Cubic.easeInOut});
    }

    function btnDescTeam(){
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
            if(currentLi.offset().top < newLi.offset().top){
                offsetYtoScroll = team.offset().top+newLi.position().top-parseFloat(currentLi.css('paddingBottom'))-120;
            }else{
               offsetYtoScroll = newLi.offset().top-120;
            }
            newDesc = $('.desc', newLi);
            heightNewDesc = newDesc.outerHeight();
            tlTeamCurrent.set(newLi, {className:'+=open'});
            tlTeamCurrent.add('paddingAnimation')
            .to(newLi, 0.25, {paddingBottom: heightNewDesc+'px', ease:Cubic.easeIn}, 'paddingAnimation')
            .to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeOut}, 'paddingAnimation')
            .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'paddingAnimation');
            tlTeamCurrent.to(newDesc, 0.25, {opacity: 1, visibility: 'visible'});
        }
    }

    function btnGlobTeam(btnGlobClique){
        if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob')) && !TweenMax.isTweening(team)){
            updateBtnGlob();
            if(btnGlobClique.closest('.wrapper-btn-glob').hasClass('open')){
                if(btnGlobClique.hasClass('left')){
                    TweenMax.to(team, 0.25, {x: '+='+teamMemberWidth, ease:Cubic.easeInOut});
                }else{
                    TweenMax.to(team, 0.25, {x: '-='+teamMemberWidth, ease:Cubic.easeInOut});
                }
            }

            if(($(window).width() <= 979) && (team.hasClass('member-open')) && btnGlobClique.closest('.wrapper-btn-glob').hasClass('open')){
                // On passe au suivant ou au précédent
                var currentLi = $('.team.member-open > li.open');
                currentDesc = $('.desc', currentLi);
                tlTeamCurrent = new TimelineMax();
                tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0, visibility: 'hidden'});
                tlTeamCurrent.set(currentLi, {className:'-=open'})
                if(btnGlobClique.hasClass('left')){
                    newLi = currentLi.prev();
                }else{
                    newLi = currentLi.next();
                }
                offsetYtoScroll = newLi.offset().top-120;
                newDesc = $('.desc', newLi);

                tlTeamCurrent.set(newLi, {className:'+=open', onComplete: function(){
                    descResponsive.html(desc.html());

                    TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                    heightDescResponsive = descResponsive.outerHeight();
                    TweenMax.set(descResponsive, {height: '0', position: 'relative'});
                    tlTeamCurrent.add('heightAnimation')
                    .to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut}, 'heightAnimation')
                    .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'heightAnimation');
                    tlTeamCurrent.to(descResponsive, 0.25, {opacity: 1, visibility: 'visible', onComplete: updateBtnGlob});
                }});
            }else{
                closeBtnGlob();
            }
        }
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
        var poItem = portfolio.find('li'), nbPoItem = poItem.length, nbCol = windowWidth > 767 ? 6 : 3;

        if(nbPoItem > nbCol){
            setPortfolio(poItem, nbPoItem, nbCol);
        }
    }

    if(team.length){
        var teamMember = team.find('.team-member');
        var desc, heightDesc, liParent, tlTeam,
            currentLi, currentDesc, tlTeamCurrent,
            newLi, newDesc, heightNewDesc,
            liTeamOpen, descOpen, heightDescOpen, descResponsive = $('.content-desc-responsive'), heightDescResponsive, posiLiClique, containerTeamWidth, posiToGo;

        teamPosition();
        updateBtnGlob();

        teamMember.on('click', function(e){
            e.preventDefault();
            openTeamMember($(this));
        });


        $('.btn-desc > li a').on('click', function(e){
            e.preventDefault();
            btnDescTeam();
        });

        $('.container-team .wrapper-btn-glob a').on('click', function(e){
            e.preventDefault();
            btnGlobTeam($(this));
        });

        $('.container-team').on('click', '.btn-cross', function(e){
            e.preventDefault();
            closeCurrentTeamMember();
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
            //TweenMax.set(contentHeader.find('h1'), {y: '-'+myScroll/4+'px'});
            myScroll > 20 ? TweenMax.to(contentHeader.find('h1'), 0.2, {y: '-50px', opacity: 0}) : TweenMax.to(contentHeader.find('h1'), 0.2, {y: '0px', opacity: 1});
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
            main.css('marginTop', Math.floor(contentHeader.outerHeight()));
        }

        if(postSidebar.length){
            postSidebar.css({top: 0, width: '20%'}).removeClass('fixed fixedBot');
            postSidebarTop = postSidebar.offset().top;
            postSidebarWidth = postSidebar.innerWidth();
        }

        if(spotlightPost.length){
            setSpotlightPost();
        }

        if(portfolio.length){
            var newNbCol = windowWidth > 767 ? 6 : 3;

            if(newNbCol !== nbCol && portfolio.find('div.grid')){
                portfolio.find('div.grid').remove();
                nbCol = newNbCol;
                setPortfolio(poItem, nbPoItem, nbCol);
            }
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

        if(windowWidthOnReady != windowWidth){
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
    var team = $('.team');

    function animTxt(splitText){
        splitText.split({type:'words'});
        TweenMax.staggerFrom(splitText.words, 0.3, {ease:Expo.easeInOut, opacity:0, y:100}, 0.03);
    }

    if(contentHeader.length){
        if(contentHeader.find('h1').length){
            var splitText = new SplitText(contentHeader.find('h1'), {type:'words'});
            contentHeader.find('h1').css('opacity', 1);
            animTxt(splitText);
        }
        if(main.length){
            setTimeout(function(){
                main.css('marginTop', Math.floor(contentHeader.outerHeight()));
                console.log(contentHeader.outerHeight());
            }, 10);
        }
    }
});

/*$('.team-member img').one('load', function() {
    var team = $('.team');
    var imgTeamHeight = team.find('.team-member img').eq(0).outerHeight();
    TweenMax.set($('.wrapper-btn-glob a'), {top: (imgTeamHeight/2)+'px'});
    console.log(imgTeamHeight);
}).each(function() {
    if(this.complete) $(this).load();
});*/
