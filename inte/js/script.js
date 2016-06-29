'use strict';

// globale car utilisée dans ajax.js
function setBtn(btn){
    var txt = btn.html();
    return '<span class="before">' + txt + '</span><span class="after">' + txt +'</span>';
}

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
    var portfolio = $('#portfolio'), animPortfolio1, animPortfolio2, portfolioItemScroll = [],
        portfolioFilters = $('#portfolioFilters'), portfolioFiltersTop = portfolioFilters.length ? portfolioFilters.offset().top : 0;
    var dropdowns = $('.dropdown');
    var team = $('.team'), teamDrag = false, teamMemberWidth, decalageMemberWidth, teamWidth, gridWidth, imgTeamHeight, /*teamMemberHeight, */offsetYtoScroll;



    /**** INIT ****/

    function getQuery(){
        var oParametre = [];
        for (var aItKey, nKeyId = 0, aCouples = window.location.search.substr(1).split("&"); nKeyId < aCouples.length; nKeyId++) {
            aItKey = aCouples[nKeyId].split("=");
            oParametre[nKeyId] = [unescape(aItKey[0]), aItKey.length > 1 ? unescape(aItKey[1]) : ""];
        }
        return oParametre;
    }

    // Alternative au CSS object-fit
    // Fonction pour adapter la taille d'une image à son container
    // Basé sur le script de Primož Cigler https://medium.com/@primozcigler/neat-trick-for-css-object-fit-fallback-on-edge-and-other-browsers-afbc53bbb2c3#.n2teu1z9m
    function imgFit(){
        if (!Modernizr.objectfit && $('.img-fit').length) {
            $('.img-fit').each(function () {
            var $container = $(this), imgUrl = $container.find('img').prop('src');
            if (imgUrl) {
              $container
                .css('backgroundImage', 'url(' + imgUrl + ')')
                .addClass('compat-object-fit');
            }
          });
        }
    }

    function detectScrollDir(myScroll){
        var scrollDir = myScroll > lastScrollTop ? -1 : 1;
        lastScrollTop = myScroll;
        return scrollDir;
    }

    function closeDropdown(dropdown){
        dropdown.css('height', dropdown.data('height')).removeClass('on');
    }

    function setHeaderScroll(myScroll, scrollDir){
        if(mainContent.length && contentHeader.length && !htmlTag.hasClass('menu-open')){
            myScroll > mainContent.offset().top - headerHeight - 40 ? header.addClass('fixed') : header.removeClass('fixed');
            if(header.hasClass('fixed')){
                scrollDir < 0 ? header.addClass('on') : header.removeClass('on');
            }
        }

        if(portfolioFilters.length){
            var triggerTop = portfolioFiltersTop - headerHeight + 200;
            if(!portfolioFilters.hasClass('single-on')){
                myScroll > portfolioFiltersTop - headerHeight ? portfolioFilters.addClass('fixed') : portfolioFilters.removeClass('fixed');
            }else{
                triggerTop -= 400;
            }
            if(myScroll > triggerTop){
                scrollDir < 0 ? portfolioFilters.addClass('on') : portfolioFilters.removeClass('on');
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
                postPos > windowWidth || postPos < postWidth ? posts.eq(i).addClass('off') : posts.eq(i).removeClass('off');
            }
        }

        detectVisiblePosts();

        if(windowWidth < spotlightWidth){
            if(!spotlightDrag){
                var gridWidth = Math.round($('#spotlightDrag').find('.spotlight-post').first().innerWidth());
                spotlightDrag = Draggable.create( '#spotlightDrag', {
                    type: 'x',
                    bounds: spotlightPost,
                    cursor: 'grab',
                    throwProps: true,
                    edgeResistance:0.9,
                    snap: {
                        x: function(endValue) {
                            return Math.round(endValue / gridWidth) * gridWidth;
                        }
                    },
                    onDrag: detectVisiblePosts,
                    onDragStart: function(){
                        spotlightPost.find('.container').addClass('grabbing');
                    },
                    onDragEnd: function(){
                        spotlightPost.find('.container').removeClass('grabbing');
                    },
                    onThrowComplete: detectVisiblePosts
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
            currentNb = 0, i = 0, transfered,
            nbTrItem = 0, poItems, nbItemByCol = [];

        function lightTransferedPoItems(y, old){
            var poItemsNotTransfered = poItems.not('.transfered'), poItemNotTransfered = portfolio.find('li').not('.transfered'), nbPoItemNotTransfered = poItemNotTransfered.length;
            var newElemNumber = Math.floor(Math.random() * nbPoItemNotTransfered);
            poItems.find('a').removeClass('on');
            poItemsNotTransfered.eq(old).find('a').addClass('off');
            animPortfolio1 = setTimeout(function(){
                if(!portfolio.find('div.grid').hasClass('is-hovered') && !poItemsNotTransfered.eq(y).hasClass('cta')){
                    poItemsNotTransfered.eq(y).find('a').addClass('on').removeClass('off');
                }
            }, 1500);
            animPortfolio2 = setTimeout(lightTransferedPoItems, 3500, newElemNumber, y);
        }

        // On se donne un modèle de répartition
        // Pour chaque nombre de colonne souhaité, on donne le modèle de répartition
        // La maquette présentait sur 6 colonnes 5, 7, 7, 6, 6, 6 éléments
        // ce qu'on peut réduire à -2, 0, 0, -1, -1, -1
        // sachant que le total doit être inférieur à 0 pour ne pas avoir plus d'emplacement que d'éléments à placer
        var repartitionModel = {
            3 : [-1, 0, -1],
            6 : [-2, 0, 0, -1, -1, -1]
        };

        var unaffectedPriorityModel = {
            3 : [1, 2, 0],
            6 : [2, 3, 4, 1, 5, 0]
        };

        // On calcule la répartition normale (nombre d'élément divisé par nombre de colonne, arrondi inférieur)
        var straightRepartition =  Math.ceil(nbPoItem / nbCol);

        // On répartit dans un tableau le nombre d'élément
        var arrayCols = [];
        i = 0;
        for (i; i<nbCol ; i++) {
            arrayCols[i] = straightRepartition + repartitionModel[nbCol][i];
        }

        // On calcule le nombre d'éléments n'ayant pas encore été placé
        var unaffectedElementsCount = nbPoItem - arrayCols.reduce(function(a, b) { return a + b; }, 0);

        // On place les éléments non affectés dans les colonnes par priorité
        i = 0;
        for (i; i<unaffectedElementsCount ; i++) {
            var columnIndex = unaffectedPriorityModel[nbCol][i%nbCol];
            arrayCols[columnIndex] ++;
        }

        var colCta = nbCol === 3 ? 1 : 3, posCta = nbCol === 3 ? 3 : 2;

        clearTimeout(animPortfolio1);
        clearTimeout(animPortfolio2);
        if(portfolioItemScroll.length){
            for(i; i<portfolioItemScroll.length; i++){
                portfolioItemScroll[i].destroy(true);
            }
        }

        i = 0;
        for(i; i<nbCol; i++){
            nbItemByCol[i] = [];
            portfolioContent += '<div class="po-item-col col-2"></div>';
        }
        portfolioContent += '</div>';
        portfolio.find('.container').append(portfolioContent);



        while(currentNb < nbPoItem){
            i = 0;
            for(i; i<nbCol; i++){
                var itemContent = '';
                nbItemByCol[i] ++;
                if(poItem.eq(currentNb).length && arrayCols[i] >= nbItemByCol[i]){
                    if(i === colCta && nbItemByCol[i] === posCta){
                        itemContent = '<div class="po-item cta">'+$('#ctaPortfolio').html()+'</div>';
                    }
                    if(poItem.eq(currentNb).hasClass('transfered')){
                        itemContent += '<div class="po-item transfered">'+poItem.eq(currentNb).html()+'</div>';
                    }else{
                        itemContent += '<div class="po-item">'+poItem.eq(currentNb).html()+'</div>';
                    }
                    portfolio.find('.po-item-col').eq(i).append(itemContent);
                    currentNb++;
                }
            }

        }

        TweenMax.set(portfolio.find('.po-item'), {opacity: 0, y: '30%', scale: 0.8});
        i = 0;
        for(i; i<nbPoItem+1; i++){
            portfolioItemScroll[i] = new ScrollMagic.Scene({ triggerElement: portfolio.find('.po-item')[i] })
                .triggerHook(0.9)
                .setTween( TweenMax.to(portfolio.find('.po-item').eq(i), 0.25, {opacity: 1, y: '0%', scale: 1}) )
                //.addIndicators()
                .addTo(controller);
        }

        transfered = portfolio.find('div.grid').find('.transfered');
        nbTrItem = transfered.length;
        poItems = portfolio.find('.po-item');
        lightTransferedPoItems(0, -1);

        poItems.find('a').on('mouseenter', function(){
            if(!$(this).closest('.po-item').hasClass('cta')){
                $(this).closest('.po-item').addClass('link-hovered').closest('.grid').addClass('is-hovered');
                poItems.find('a').removeClass('on');
                $(this).removeClass('off');
            }
        }).on('mouseleave', function(){
            $(this).closest('.po-item').removeClass('link-hovered').closest('.grid').removeClass('is-hovered');
            $(this).addClass('off');
        });
    }

    function filterPortfolio(data, url){
        var filteredPoItem, nbFilteredPoItem;

        filteredPoItem = poItem.filter(function(){
            var elt = $(this), keepElt = true;
            data.forEach(function(e, i){
                if(e[1] !== 'all' && keepElt){
                    if($.inArray(e[1], $('a', elt).data(e[0]).split(',')) === -1){
                        keepElt = false;
                    }
                }
            });
            return keepElt;
        });

        nbFilteredPoItem = filteredPoItem.length;
        nbCol = windowWidth > 767 ? 6 : 3;
        portfolio.find('div.grid').remove();

        history.pushState(null, null, url);

        setPortfolio(filteredPoItem, nbFilteredPoItem, nbCol);
    }

    function setFiltersPortfolio(){
        var thisBtn = $(this);
        if(!thisBtn.hasClass('actif')){
            var data = [], filterLists = portfolioFilters.find('.dropdown'),
                url = window.location.origin + window.location.pathname + '?';

            thisBtn.siblings().removeClass('actif');
            thisBtn.addClass('actif').clone().prependTo(thisBtn.parents('.dropdown'));
            thisBtn.remove();

            filterLists.each(function(i){
                var filterName = $(this).data('filter');
                data[i] = [filterName, $(this).find('.actif').data(filterName)];

                if(i !== 0){ url += '&'; }
                url += data[i][0] + '=' + data[i][1];
            });

            filterPortfolio(data, url);
        }
    }

    function setFiltersPortfolioOnLoad(filters){
        var filterLists = portfolioFilters.find('.dropdown');

        filterLists.each(function(i){
            var thisDropdown = filterLists.eq(i);
            if(filters[i] !== undefined){
                var thisBtn = thisDropdown.find('[data-'+filters[i][0]+'='+filters[i][1]+']');
                thisBtn.addClass('actif').clone().prependTo(thisDropdown);
                thisBtn.remove();
            }else{
                var thisFilter = thisDropdown.data('filter');
                filters[i] = [thisFilter, thisDropdown.find('.actif').data(thisFilter)];
            }
        });

        filterPortfolio(filters, window.location.href);
    }


    function updateBtnGlob(){
        if(windowWidth <= 979){
            var nbTeamMembers = $('.team > li').length;
            var teamLeft = team.offset().left-20, teamRight = teamLeft+team.width();
            var containerTeamWidth = $('.container-team').width();
            var posiLiOpen = 0;
            var offsetLiOpen = 0;

            if(team.find('li').hasClass('open')){
                posiLiOpen = team.find('> li.open').position().left;
                offsetLiOpen = team.find('> li.open').offset().left;
            }
            if(windowWidth > 767 && nbTeamMembers > 5){
                TweenMax.set([$('.wrapper-btn-glob.btn-prev'), $('.wrapper-btn-glob.btn-next')], {className:'-=open'});
                if(teamLeft < -Math.ceil(teamMemberWidth*2)){
                    TweenMax.set($('.wrapper-btn-glob.btn-prev'), {className:'+=open'});
                }
                if(Math.ceil(teamRight+teamMemberWidth*2) > containerTeamWidth){
                    TweenMax.set($('.wrapper-btn-glob.btn-next'), {className:'+=open'});
                }
            }else if(windowWidth <= 767 && nbTeamMembers > 3){
                TweenMax.set([$('.wrapper-btn-glob.btn-prev'), $('.wrapper-btn-glob.btn-next')], {className:'-=open'});
                if(teamLeft < -Math.ceil(teamMemberWidth)){
                    TweenMax.set($('.wrapper-btn-glob.btn-prev'), {className:'+=open'});
                }
                if(Math.ceil(teamRight+teamMemberWidth) > containerTeamWidth){
                    TweenMax.set($('.wrapper-btn-glob.btn-next'), {className:'+=open'});
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
        if(windowWidth <= 979){
            imgTeamHeight = team.find('.team-member img').eq(0).outerHeight();
            TweenMax.set($('.wrapper-btn-glob a'), {top: (imgTeamHeight/2)+'px'});
            if(!teamDrag){
                if(windowWidth <= 767){
                    teamMemberWidth = $('.container-team').width()/3;
                    decalageMemberWidth = teamMemberWidth;
                }else{
                    teamMemberWidth = $('.container-team').width()/5;
                    decalageMemberWidth = teamMemberWidth*2;
                }
                TweenMax.set(team.find('> li'), {width: teamMemberWidth+'px'});

                teamWidth = 0;
                team.find('> li').each(function(){ teamWidth += $(this).outerWidth(); });
                teamWidth += (decalageMemberWidth*2);
                TweenMax.set(team, {width: teamWidth+'px', padding: '0 '+decalageMemberWidth+'px', x: -decalageMemberWidth});

                gridWidth = teamMemberWidth;
                teamDrag = Draggable.create( '.team', {
                    type: 'x',
                    bounds: $('.container-team'),
                    cursor: 'grab',
                    throwProps: true,
                    edgeResistance: 0.9,
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
                        if(windowWidth > 979){
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
                if(windowWidth <= 767){
                    teamMemberWidth = $('.container-team').width()/3;
                    decalageMemberWidth = teamMemberWidth;
                }else{
                    teamMemberWidth = $('.container-team').width()/5;
                    decalageMemberWidth = teamMemberWidth*2;
                }
                TweenMax.set(team.find('> li'), {width: teamMemberWidth+'px'});
                teamWidth = 0;
                team.find('> li').each(function(){ teamWidth += $(this).outerWidth(); });
                teamWidth += (decalageMemberWidth*2);
                TweenMax.set(team, {width: teamWidth+'px', padding: '0 '+decalageMemberWidth+'px', x: -decalageMemberWidth});

                gridWidth = teamMemberWidth;
                teamDrag = Draggable.create( '.team', {
                    type: 'x',
                    bounds: $('.container-team'),
                    cursor: 'grab',
                    throwProps: true,
                    edgeResistance: 0.9,
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
                TweenMax.set(team, {clearProps:'all'});
                TweenMax.set(team.find('> li'), {clearProps:'width'});
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
                if(windowWidth > 979){
                    tlTeam.add('paddingAnimation')
                        .to(liParent, 0.5, {paddingBottom: heightDesc+'px', ease:Cubic.easeOut}, 'paddingAnimation')
                        .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'paddingAnimation')
                        .to(desc, 0.25, {opacity: 1, visibility: 'visible'});
                }else{
                    descResponsive.html(desc.html());
                    TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                    heightDescResponsive = descResponsive.outerHeight();
                    TweenMax.set(descResponsive, {height: '0', position: 'relative'});

                    tlTeam.add('heightAnimation')
                        .to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut}, 'heightAnimation')
                        .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'heightAnimation')
                        .to(descResponsive, 0.25, {opacity: 1, visibility: 'visible'});

                    var teamMemberHeight = Math.max.apply(null, team.find('.team-member').map(function (){
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

                    if(windowWidth > 979){
                        offsetYtoScroll = team.offset().top+liParent.position().top-120;
                        if(currentLi.offset().top < liParent.offset().top){
                            offsetYtoScroll -= parseFloat(currentLi.css('paddingBottom'));
                        }

                        tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'}).set(currentLi, {className:'-=open'});


                        tlTeamCurrent.set(liParent, {className:'+=open'})
                            .add('paddingAnimation')
                            .to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeInOut}, 'paddingAnimation')
                            .to(liParent, 0.25, {paddingBottom: heightDesc+'px', ease:Cubic.easeIn}, 'paddingAnimation')
                            .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'paddingAnimation');

                        tlTeamCurrent.to(desc, 0.25, {opacity: 1, visibility: 'visible'});
                    }else{
                        offsetYtoScroll = liParent.offset().top-120;

                        tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0, visibility: 'hidden'}).set(currentLi, {className:'-=open'});

                        tlTeamCurrent.set(liParent, {className:'+=open', onComplete: function(){
                            descResponsive.html(desc.html());

                            TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                            heightDescResponsive = descResponsive.outerHeight();
                            TweenMax.set(descResponsive, {height: '0', position: 'relative'});

                            tlTeamCurrent
                                .add('heightAnimation')
                                .to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut}, 'heightAnimation')
                                .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'heightAnimation')
                                .to(descResponsive, 0.25, {opacity: 1, visibility: 'visible'});

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
        if(windowWidth > 979){
            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'}).to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeInOut});
        }else{
            tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0}).to(descResponsive, 0.5, {height: '0', visibility: 'hidden', ease:Cubic.easeInOut});
        }
        tlTeamCurrent.set(currentLi, {className:'-=open'}).set(team, {className:'-=member-open'});
        TweenMax.to($('.wrapper-btn-glob'), 0.5,{height: '100%', ease:Cubic.easeInOut});
    }

    function btnDescTeam(){
        if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob'))){
            // close already open and open new
            var currentLi = $('.team.member-open > li.open');
            currentDesc = $('.desc', currentLi);
            tlTeamCurrent = new TimelineMax();
            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'}).set(currentLi, {className:'-=open'});
            if($(this).hasClass('left')){
                newLi = currentLi.prev().length ? currentLi.prev() : team.find('> li').last();
            }else{
                newLi = currentLi.next().length ? currentLi.next() : team.find('> li').first();
            }
            if(currentLi.offset().top < newLi.offset().top){
                offsetYtoScroll = team.offset().top+newLi.position().top-parseFloat(currentLi.css('paddingBottom'))-120;
            }else{
                offsetYtoScroll = newLi.offset().top-120;
            }
            newDesc = $('.desc', newLi);
            heightNewDesc = newDesc.outerHeight();
            tlTeamCurrent.set(newLi, {className:'+=open'}).add('paddingAnimation')
                .to(newLi, 0.25, {paddingBottom: heightNewDesc+'px', ease:Cubic.easeIn}, 'paddingAnimation')
                .to(currentLi, 0.5, {paddingBottom: '0', ease:Cubic.easeOut}, 'paddingAnimation')
                .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'paddingAnimation')
                .to(newDesc, 0.25, {opacity: 1, visibility: 'visible'});
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

            if(windowWidth <= 979 && team.hasClass('member-open') && btnGlobClique.closest('.wrapper-btn-glob').hasClass('open')){
                // On passe au suivant ou au précédent
                var currentLi = $('.team.member-open > li.open');
                currentDesc = $('.desc', currentLi);
                tlTeamCurrent = new TimelineMax();
                tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0, visibility: 'hidden'}).set(currentLi, {className:'-=open'})
                newLi = btnGlobClique.hasClass('left') ? currentLi.prev() : currentLi.next();
                offsetYtoScroll = newLi.offset().top-120;
                newDesc = $('.desc', newLi);

                tlTeamCurrent.set(newLi, {className:'+=open', onComplete: function(){
                    descResponsive.html(desc.html());

                    TweenMax.set(descResponsive, {height: 'auto', position: 'absolute'});
                    heightDescResponsive = descResponsive.outerHeight();
                    TweenMax.set(descResponsive, {height: '0', position: 'relative'});
                    tlTeamCurrent.add('heightAnimation')
                        .to(descResponsive, 0.5, {height: heightDescResponsive+'px', ease:Cubic.easeInOut}, 'heightAnimation')
                        .to(window, 0.5, {scrollTo:{y:offsetYtoScroll}, ease:Cubic.easeOut}, 'heightAnimation')
                        .to(descResponsive, 0.25, {opacity: 1, visibility: 'visible', onComplete: updateBtnGlob});
                }});
            }else{
                closeBtnGlob();
            }
        }
    }



    isMobile.any ? htmlTag.addClass('is-mobile') : htmlTag.addClass('is-desktop');

    setHeaderScroll(myScroll, scrollDir);
    imgFit();

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

        if(window.location.search){
            var filters = getQuery();
            setFiltersPortfolioOnLoad(filters);
        }else{
            setPortfolio(poItem, nbPoItem, nbCol);
        }

        portfolioFilters.on('click', 'li', setFiltersPortfolio);
    }

    if(team.length){
        var teamMember = team.find('.team-member');
        var desc, heightDesc, liParent, tlTeam,
            currentDesc, tlTeamCurrent,
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

    dropdowns.on('click', function(){
        var dropdown = $(this), height = 2, siblings = dropdowns.not(dropdown);
        if(dropdown.hasClass('on')){
            closeDropdown(dropdown);
        }else{
            dropdown.data('height', dropdown.css('height')).find('li').each(function(){
                height += $(this).outerHeight();
            });
            dropdown.css('height', height).addClass('on');
        }
        siblings.each(function(){ closeDropdown($(this)); });
    });

    $('#burger').on('click', function(e){
        e.preventDefault();
        htmlTag.toggleClass('menu-open');
        if(htmlTag.hasClass('menu-open')){
            setTimeout(function(){
                var i = 0, nbMenu = menu.find('.menu-small').length;

                for(i; i<nbMenu; i++){
                    TweenMax.to(menu.find('.menu-title').eq(i), 0.25, {y: '0%', opacity: 1, z: 0.01, force3d: true});
                    TweenMax.to(menu.find('.menu-subtitle').eq(i), 0.25, {y: '0%', opacity: 1, z: 0.01, force3d: true}).delay(0.05);
                    TweenMax.staggerTo(menu.find('.menu-small').eq(i).find('li'), 0.25, {y: '0%', opacity: 1, z: 0.01, force3d: true}, 0.08);
                }
            }, 380);
        }else{
            setMenuElmts();
        }
    });

    function setLabelInput(){
        $(this).val() ? $(this).addClass('filled') : $(this).removeClass('filled');
    }

    if($('input').length){
        $('input').each(setLabelInput).on('change', setLabelInput);

        if($('label').length){
           $('label').css('opacity', 1);
        }
    }


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

        if(dropdowns.length){
            dropdowns.each(function(){ closeDropdown($(this)); });
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
    //var team = $('.team');

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
            main.css('marginTop', Math.floor(contentHeader.outerHeight()));
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
