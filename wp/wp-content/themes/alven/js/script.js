'use strict';

var postSidebarTop = 0, postSidebarWidth = 0;

// globales car utilisée dans ajax.js
function setBtn(btn){
    var txt = btn.html();
    return '<span class="before">' + txt + '</span><span class="after">' + txt +'</span>';
}

var dragGallery = false;
function setGallery(gallery, windowWidth){
    var imgs = gallery.find('div'), width = 0,
        container = gallery.closest('.container-small').length ? gallery.closest('.container-small') : gallery.closest('.container');

    function detectVisibleImgs(){
        imgs.each(function(){
            var imgWidth = $(this).width(), imgPos = $(this).offset().left + imgWidth;
            imgPos > windowWidth || imgPos < imgWidth ? $(this).addClass('off') : $(this).removeClass('off');
        });
    }

    function hideOrShowControls(x){
        imgs.last().hasClass('off') ? $('#nextImg').removeClass('hidden') : $('#nextImg').addClass('hidden');
        imgs.eq(0).offset().left >= 0 ? $('#prevImg').addClass('hidden') : $('#prevImg').removeClass('hidden');
    }

    function slideGallery(dir){
        var x = gallery.data('x') ? gallery.data('x') : 0, newX = x;

        if(!TweenMax.isTweening(gallery)){
            imgs.each(function(){
                var imgPos = $(this).offset().left;
                imgPos < 10 ? $(this).addClass('hideLeft') : $(this).removeClass('hideLeft');
            });

            newX -= dir === 'right' ? imgs.not('.hideLeft').eq(0).offset().left : $('.hideLeft.off').last().offset().left;

            TweenMax.to(gallery, 0.3, {x: newX+'px', onComplete: function(){
                gallery.data('x', newX);
                detectVisibleImgs();
                hideOrShowControls(newX);
            }});
        }
    }

    if(windowWidth > 767 && !dragGallery){
        gallery.css('opacity', 0).imagesLoaded().always(function(){
            imgs.each(function(){ width += Math.ceil($(this).width()); });
            gallery.width(width).data('width', width);

            dragGallery = Draggable.create( gallery, {
                type: 'x',
                bounds: container,
                cursor: 'grab',
                throwProps: true,
                onDrag: detectVisibleImgs,
                onDragStart: function(){
                    gallery.addClass('grabbing');
                },
                onDragEnd: function(){
                    gallery.removeClass('grabbing');
                },
                onThrowComplete: function(){
                    gallery.data('x', this.x);
                    detectVisibleImgs();
                    hideOrShowControls(this.x);
                }
            } );

            detectVisibleImgs();

            TweenMax.to(gallery, 0.3, {opacity: 1});
        });

        if(!$('#nextImg').length){
            gallery.after('<button class="btn-arrow-only left hidden" id="prevImg">Previous image</button><button class="btn-arrow-only" id="nextImg">Next image</button>');
            $('#nextImg').on('click', function(e){
                e.preventDefault();
                $(this).blur();
                slideGallery('right');
            });
            $('#prevImg').on('click', function(e){
                e.preventDefault();
                $(this).blur();
                slideGallery('left');
            });
        }
    }else{
        if(Draggable.get(gallery) !== undefined){
            Draggable.get(gallery).kill();
        }
        dragGallery = false;
    }
}

var tlHeader = new TimelineMax({paused: true}).timeScale(4), tlHeaderDone = false;

$(function(){

    /**** VARIABLES ****/

    var docHeight = $(document).height(), windowHeight = $(window).height(), windowWidth = window.outerWidth, windowWidthOnReady = windowWidth;

    var controller = new ScrollMagic.Controller(), lastScrollTop = 0, myScroll = $(document).scrollTop(), scrollDir = 0;

    var htmlTag = $('html'), body = $('body');
    var header = $('#header'), headerHeight = header.innerHeight(), mainMenu = $('#menu-main');
    var mainContent = $('#mainContent'), main = $('#main');
    var readIndicator = $('#readIndicator');
    var buttons = $('.btn'), buttonsInvert = $('.btn-invert');
    var contentHeader = $('#contentHeader');
    var spotlightPost = $('#spotlightPost'), spotlightDrag = false;
    var postSidebar = $('#postSidebar');
    var related = $('#related');
    var menu = $('#menu-responsive');
    var portfolio = $('#portfolio'), animPortfolio1, animPortfolio2, portfolioItemScroll = [],
        portfolioFilters = $('#portfolioFilters'), portfolioFiltersTop = portfolioFilters.length ? portfolioFilters.offset().top : 0;
    var dropdowns = $('.dropdown');
    var team = $('.team'), teamDrag = false, teamMemberWidth, decalageMemberWidth, teamWidth, gridWidth, imgTeamHeight, offsetYtoScroll;
    var fadePage = $('#fadePage');
    var galleries = $('.gallery');



    /**** INIT ****/

    // return the url queries -> oParametre = [[query, value]]
    function getQuery(){
        var oParametre = [];
        for(var aItKey, nKeyId = 0, aCouples = window.location.search.substr(1).split('&'); nKeyId < aCouples.length; nKeyId++){
            aItKey = aCouples[nKeyId].split('=');
            oParametre[nKeyId] = [unescape(aItKey[0]), aItKey.length > 1 ? unescape(aItKey[1]) : ''];
        }
        return oParametre;
    }

    // Alternative au CSS object-fit
    // Fonction pour adapter la taille d'une image à son container
    // Basé sur le script de Primož Cigler https://medium.com/@primozcigler/neat-trick-for-css-object-fit-fallback-on-edge-and-other-browsers-afbc53bbb2c3#.n2teu1z9m
    function imgFit(){
        if(!Modernizr.objectfit && $('.img-fit').length){
            $('.img-fit').each(function(){
                var $container = $(this), imgUrl = $container.find('img').prop('src');
                if(imgUrl){
                    $container.css('backgroundImage', 'url(' + imgUrl + ')').addClass('compat-object-fit');
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

    // header animation on scroll + filters animation on scroll + readIndicator
    function setHeaderScroll(myScroll, scrollDir){
        if(mainContent.length && contentHeader.length && !htmlTag.hasClass('menu-open')){
            if (mainContent.hasClass('content-career')) {
                header.addClass('fixed')
            } else {
                myScroll > mainContent.offset().top - headerHeight - 40 ? header.addClass('fixed') : header.removeClass('fixed');
            }
            if(header.hasClass('fixed')){
                scrollDir < 0 ? header.addClass('on') : header.removeClass('on');
            }
        }

        if(portfolioFilters.length && windowHeight > 700 && windowWidth > 767){
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
            if(mainContent.innerHeight() > windowHeight){
                var readingPercent = (myScroll-mainContent.offset().top)/(mainContent.innerHeight()-windowHeight);
                TweenMax.set(readIndicator, {scaleX: readingPercent});
            }
        }
    }

    // add a current class to an anchor if we are on the targeted section
    function setAnchorLink(myScroll){
        var current = mainMenu.find('.anchor');
        if(current.length){
            var href = current.find('a').attr('href'), indexOfHash = href.indexOf('#');
            if(indexOfHash > -1){
                var hash = href.substring(indexOfHash);
                if($(hash).length){
                    var hashTop = $(hash).offset().top;
                    if(myScroll >= hashTop - 200 && myScroll <= (hashTop + $(hash).outerHeight() - 200)){
                        current.addClass('current-menu-item');
                    }else{
                        current.removeClass('current-menu-item');
                    }
                }
            }
        }
    }

    // set draggable spotglight posts, detect if they are in the viewport
    function setSpotlightPost(){
        var posts = spotlightPost.find('.spotlight-post'),
            spotlightWidth = spotlightPost.find('.container').innerWidth();

        function detectVisiblePosts(){
            var postWidth = posts.eq(0).innerWidth();
            posts.each(function(){
                var postPos = $(this).offset().left + postWidth;
                postPos > windowWidth || postPos < postWidth ? $(this).addClass('off') : $(this).removeClass('off');
            });
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
                    edgeResistance: 0.9,
                    snap: {
                        x: function(endValue){
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

    // animate sidebar on post pages
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

    // animate opacity on elmts on scroll
    function setScrollElmts(elmts){
        TweenMax.set(elmts, {opacity: 0});

        elmts.each(function(i){
            new ScrollMagic.Scene({ triggerElement: elmts[i] })
                .triggerHook(0.7)
                .setTween( TweenMax.to($(this), 0.25, {opacity: 1}) )
                //.addIndicators()
                .addTo(controller);
        });
    }

    // animate responsive menu elmts
    function setMenuElmts(){
        TweenMax.set([menu.find('.menu-title'), menu.find('.menu-subtitle')], {y: '-100%', opacity: 0});
        TweenMax.set(menu.find('li'), {y: '-120%', opacity: 0});
    }

    // create portfolio
    function setPortfolio(poItem, nbPoItem, nbCol, scroll){
        var portfolioContent = '<div class="grid">',
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

        if(scroll){
            setTimeout(function(){ $('html, body').animate({scrollTop: main.offset().top}, 400); }, 400);
        }
    }

    function filterPortfolio(data, url){
        var filteredPoItem, nbFilteredPoItem;

        // Filtre les poItem en ayant la possibilité de ne pas prendre en compte un filtre (pour griser les entrées d'un select)
        function filterItem(excludedFilterName) {
            return poItem.filter(function(){
                var elt = $(this), keepElt = true;
                data.forEach(function(e){
                    if(e[0] !== excludedFilterName){
                        if(e[1] !== 'all' && keepElt){
                            if($.inArray(e[1], $('a', elt).data(e[0]).split(',')) === -1){
                                keepElt = false;
                            }
                        }
                    }
                });
                return keepElt;
            });
        }

        filteredPoItem = filterItem(false);

        function disableImpossibleChoices(forFilterName) {
            var remainingFilters = [];
            var filteredPoItem = filterItem(forFilterName);

            // Je parcours tous mes éléments startup et je consolide dans un tableau les valeurs de filtre restant possibles
            filteredPoItem.each(function() {
                var $a = $(this).find('a');

                function appendToRemainingFilters(filterName) {
                    if (!(filterName in remainingFilters)) {
                        remainingFilters[filterName] = [];
                    }
                    var dataArray = $a.data(filterName).split(',');
                    dataArray.forEach(function(e) {
                        if (e !== '') {
                            remainingFilters[filterName][e] = true;
                        }
                    });
                }

                appendToRemainingFilters('investment');
                appendToRemainingFilters('field');
                appendToRemainingFilters('footprint');
            });

            var filterLists = portfolioFilters.find('.dropdown[data-filter='+forFilterName+']');
            filterLists.each(function(){
                var $this = $(this), filterName = $this.data('filter'), filterListValues = $this.find('li');

                filterListValues.each(function(){
                    var $this = $(this), value = $this.data(filterName);

                    if (value !== 'all') {
                        if (remainingFilters[filterName]) {
                            value in remainingFilters[filterName] ? $this.removeClass('empty') : $this.addClass('empty');
                        } else {
                            $this.addClass('empty');
                        }
                    }
                });
            });
        }

        disableImpossibleChoices('investment');
        disableImpossibleChoices('field');
        disableImpossibleChoices('footprint');

        nbFilteredPoItem = filteredPoItem.length;
        nbCol = windowWidth > 767 ? 6 : 3;
        portfolio.find('div.grid').remove();

        history.pushState(null, null, url);

        setPortfolio(filteredPoItem, nbFilteredPoItem, nbCol, 'scroll');
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
                thisBtn.siblings().removeClass('actif');
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
                        team.addClass('grabbing');
                    },
                    onDragEnd: function(){
                        team.removeClass('grabbing');
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
                        team.addClass('grabbing');
                    },
                    onDragEnd: function(){
                        team.removeClass('grabbing');
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

    function btnDescTeam(that){
        if(!TweenMax.isTweening(team.find('li')) && !TweenMax.isTweening(team.find('.desc')) && !TweenMax.isTweening($('.wrapper-btn-glob'))){
            // close already open and open new
            var currentLi = $('.team.member-open > li.open');
            currentDesc = $('.desc', currentLi);
            tlTeamCurrent = new TimelineMax();
            tlTeamCurrent.to(currentDesc, 0.25, {opacity: 0, visibility: 'hidden'}).set(currentLi, {className:'-=open'});
            if(that.hasClass('left')){
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
                tlTeamCurrent.to(descResponsive, 0.25, {opacity: 0, visibility: 'hidden'}).set(currentLi, {className:'-=open'});
                newLi = btnGlobClique.hasClass('left') ? currentLi.prev() : currentLi.next();
                offsetYtoScroll = newLi.offset().top-120;
                newDesc = $('.desc', newLi);

                tlTeamCurrent.set(newLi, {className:'+=open', onComplete: function(){
                    descResponsive.html(newDesc.html());

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

    // add class to label when input is filled
    function setLabelInput(){
        var thisInput = $(this);
        if(!thisInput.is('[type=submit]')){
            thisInput.val() ? thisInput.addClass('filled') : thisInput.removeClass('filled');
        }
    }

    // interactive forms
    function setFormSection(legend){
        var form = legend.parents('.form-to-open'), currentSection = legend.find('+ .form-section');

        form.find('legend').removeClass('active');
        TweenMax.to(form.find('.form-section'), 0.2, {height: 0, ease: Power2.easeInOut});

        legend.addClass('active');
        TweenMax.to(currentSection, 0.2, {height: currentSection.data('height'), ease: Power2.easeInOut, onComplete: function(){
            currentSection.find('.form-elt').eq(0).focus();
        }});
    }

    function openFormError(form){
        form.find('legend').addClass('active');
        form.find('.form-section').each(function(){
            TweenMax.to($(this), 0.2, {height: $(this).data('height')});
        }).find('.form-elt').each(function(){
            if($(this).attr('required') && !$(this).val()){
                $(this).addClass('invalid').closest('.form-section').addClass('invalid');
            }
        });
    }




    isMobile.any ? htmlTag.addClass('is-mobile') : htmlTag.addClass('is-desktop');

    if(!body.hasClass('home')){
        setHeaderScroll(myScroll, scrollDir);
    }
    imgFit();

    if(buttons.length){
        buttons.each(function(i){
            buttons.eq(i).html(setBtn(buttons.eq(i)));
        });
    }
    if(buttonsInvert.length){
        buttonsInvert.each(function(i){
            buttonsInvert.eq(i).html(setBtn(buttonsInvert.eq(i)));
        });
    }

    if(mainContent.length){
        if(mainContent.find('img').length){
            var imgs = mainContent.find('img').not('.no-scroll');
            setScrollElmts(imgs);
        }
        if(mainContent.find('.special-cat').length){
            setScrollElmts(mainContent.find('.special-cat'));
        }
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
            .addTo(controller);
    }

    if(related.length){
        var relatedPosts = related.find('.read-also-post');
        TweenMax.set(relatedPosts, {opacity: 0});

        new ScrollMagic.Scene({ triggerElement: '#related' })
            .triggerHook(0.7)
            .setTween( TweenMax.staggerTo(relatedPosts, 0.25, {opacity: 1}, 0.1) )
            .addTo(controller);
    }

    if(portfolio.length){
        var poItem = portfolio.find('li'), nbPoItem = poItem.length, nbCol = windowWidth > 767 ? 6 : 3,
            filters = [];

        if(window.location.search){
            // si il y a des paramètres, on les récupère
            filters = getQuery();
            // on vérifie que les paramètres correspondent bien a des filtres
            filters = filters.filter(function(e){
                return e[0] === 'investment' || e[0] === 'field' || e[0] === 'footprint';
            });
        }

        // on filtre ou on lance juste le portfolio
        filters.length ? setFiltersPortfolioOnLoad(filters) : setPortfolio(poItem, nbPoItem, nbCol);

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
            btnDescTeam($(this));
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

    // check all links if href contains an anchor
    // if yes, remove if there is the first part of the url
    // and add the scroll-anchor class to add smooth scroll on click
    if($('a').length){
        var currentSite = location.protocol+'//'+location.host,
            currentLocation = currentSite+location.pathname;
        $('a').each(function(){
            var href = $(this).attr('href'), indexOfHash = href.indexOf('#');
            if(href === '#' || $(this).attr('target') === '_blank'){
                return;
            }
            if(indexOfHash === 0){
                $(this).addClass('scroll-anchor');
            }else if(indexOfHash > -1){
                var thisLocation = href.substring(0, indexOfHash);
                if(thisLocation.slice(-1) !== '/'){
                    thisLocation += '/';
                }
                if(currentLocation === thisLocation){
                    $(this).attr('href', href.substring(indexOfHash)).addClass('scroll-anchor');
                }
            }else{
                if(href.indexOf(currentSite) === 0){
                    $(this).addClass('fade-page-link');
                }
            }
        });
    }


    // smooth scroll
    body.on('click', '.scroll-anchor', function(e){
        e.preventDefault();
        $('html, body').animate({scrollTop: $(this.hash).offset().top - 150}, 500);
        $(this).blur();
    });

    // fade page effect
    body.on('click', '.fade-page-link', function(e){
        if($(this).hasClass('ajax-load')){
            return;
        }

        if( e.ctrlKey || e.shiftKey || e.metaKey || (e.button && e.button === 1) ){ // on ouvre la page dans un nouel onlget en utlisant ctrl par ex
            return;
        }

        var href = $(this).attr('href');
        e.preventDefault();
        TweenMax.to(fadePage, 0.2, {opacity: 0, onComplete: function(){
            window.location.href = href;
        }});
    });


    if(mainMenu.length){
        // si le lien a la classe current menu item, c'est qu'il correspond a la page en cours
        var current = mainMenu.find('.current-menu-item');
        if(current.length){
            var href = current.find('a').attr('href'), indexOfHash = href.indexOf('#');
            // on cherche une ancre et s'il en a une, on lance la fonction qui l'activera au scroll
            if(indexOfHash > -1){
                current.removeClass('current-menu-item').addClass('anchor');
                setAnchorLink(myScroll);
            }
        }
    }

    // animate dropdown height on click
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

    // open/close menu on click on burger
    $('#burger').on('click', function(e){
        e.preventDefault();
        htmlTag.toggleClass('menu-open');
        if(htmlTag.hasClass('menu-open')){
            setTimeout(function(){
                var i = 0, nbMenu = menu.find('.menu-small').length;

                for(i; i<nbMenu; i++){
                    TweenMax.to(menu.find('.menu-title').eq(i), 0.25, {y: '0%', opacity: 1, z: 0.01, force3D: true});
                    TweenMax.to(menu.find('.menu-subtitle').eq(i), 0.25, {y: '0%', opacity: 1, z: 0.01, force3D: true}).delay(0.05);
                    TweenMax.staggerTo(menu.find('.menu-small').eq(i).find('li'), 0.25, {y: '0%', opacity: 1, z: 0.01, force3D: true}, 0.08);
                }
            }, 380);
        }else{
            setMenuElmts();
        }
    });


    if($('input').length){
        $(':input').each(setLabelInput).on('change', setLabelInput).on('focus', function(){
            $(this).attr('autocomplete', 'on');
            // because of f*cking mailjet which add autocomplete off on focus (whyyyyyyyy ?!!)
        });

        if($('label').length){
           $('label').not('[for=search-header]').css('opacity', 1);
        }

        if($('input[type=file]').length){
            var inputFile = $('input[type=file]');

            inputFile.each(function(){
                var inputFile = $(this);
                inputFile.after('<button type="button" class="inputFile btn-invert form-elt">' + $(this).siblings('label').html() + '</button>')
                         .css('display', 'none').siblings('label').css('display', 'none');

                $('.inputFile').on('click', function(e){
                    e.preventDefault();
                    inputFile.click();
                }).each(function(){
                    $(this).html(setBtn($(this)));
                });

                inputFile.on('change', function(){
                    $(this).siblings('.form-desc').html($(this)[0].files[0].name);
                });
            });
        }

        var formSearch = $('.form-search'), formSearchHeader = $('.form-search-header');
        formSearch.on('submit', function(e){
            var input = $(this).find('input');
            if(!input.val()){
                e.preventDefault();
                input.focus();
                if($(this).hasClass('form-search-header')){
                    $(this).toggleClass('on');
                }
            }
        });
        formSearchHeader.on('focusout', function(){
            $(this).find('input').val() ? $(this).addClass('on') : $(this).removeClass('on');
        }).on('submit', function(e){
            if(windowWidth <= 540){
                e.preventDefault();
                window.location.href = $(this).attr('action') + '?s=';
            }
        });


        var formsPitch = $('.form-to-open'), btnForm = $('.open-form');

        if(formsPitch.length){
            formsPitch.each(function(){
                $(this).find('.form-section').each(function(){
                    $(this).data('height', $(this).height()).css('height', 0);
                }).eq(0).css('height', $(this).find('.form-section').eq(0).data('height'));
            }).css({'display': 'none', 'opacity': 0}).each(function(){
                if($(this).hasClass('form-open-error')){
                    $(this).css({'display': 'block', 'opacity': 1}).siblings('button').css('display', 'none');
                    openFormError($(this));
                }
            });
            $('.form-wrkbl-to-open').css({'display': 'block', 'opacity': 1});
        }

        btnForm.on('click', function(e){
            var thisBtn = $(this), parent = thisBtn.parents('.interactive-block');

            e.preventDefault();

            TweenMax.to(parent.siblings().find('.form-to-open'), 0.2, {opacity: 0, ease: Power2.easeIn, onComplete: function(){
                if($('.interactive-block').hasClass('open')){
                    parent.siblings().find('.form-to-open').css('display', 'none');
                }
            }});

            parent.addClass('on').removeClass('off').siblings().removeClass('on').addClass('off');

            TweenMax.set(parent.siblings().find('.open-form'), {display: 'inline-block', delay: 0.3});
            TweenMax.to(parent.siblings().find('.open-form'), 0.3, {opacity: 1, delay: 0.3, ease: Power2.easeInOut});
            TweenMax.to(thisBtn, 0.3, {opacity: 0, ease: Power2.easeInOut, onComplete: function(){
                thisBtn.css('display', 'none');
            }});

            if($('.interactive-block').hasClass('open')){
                TweenMax.set(parent.find('.form-to-open'), {display: 'block', delay: 0.3});
            }
            TweenMax.to(parent.find('.form-to-open'), 0.2, {opacity: 1, delay: 0.3, ease: Power2.easeOut, onComplete: function(){
                parent.find('.form-to-open').find('.form-elt').eq(0).focus();
            }});

            if(!$('.interactive-block').hasClass('open')){
                parent.siblings().find('.form-to-open').slideUp(300, 'easeInQuad');
                parent.find('.form-to-open').delay(300).slideDown(300, 'easeOutQuad', function(){
                    if(windowWidth > 767){
                        $('.interactive-block').addClass('open').css('minHeight', parent.height());
                    }
                });
            }else{
                if(windowWidth <= 767){
                    $('.interactive-block').removeClass('open');
                }
            }

            $('html, body').animate({scrollTop: parent.offset().top}, 200);
        });
        formsPitch.on('click', 'legend', function(){
            setFormSection($(this));
        }).on('focusout', '.form-elt', function(){
            var thisForm = $(this).parents('.form-to-open');
            var nbSections = thisForm.find('.form-section').length, thisSection = $(this).closest('.form-section');
            var nbInputs = $(this).closest('.form-section').find('.form-elt').length;
            if(thisForm.find('.form-section').index(thisSection) < nbSections - 1){
                if($(this).parents('div').index() === nbInputs - 1){
                    setFormSection(thisForm.find('.form-section').eq(thisSection.index()).siblings('legend'));
                    $('html, body').animate({scrollTop: thisForm.offset().top}, 300);
                }
            }
        }).on('input change', '.form-elt', function(){
            var valid = true, submit = $(this).closest('.form-to-open').find('button[type=submit]');
            $(this).closest('.form-to-open').find('.form-elt').each(function(){
                if($(this).attr('required') && !$(this).val()){
                    valid = false;
                }
            });
            valid ? submit.addClass('on') : submit.removeClass('on');
        }).on('click', 'button[type=submit]', function(e){
            if(!$(this).hasClass('on')){
                var form = $(this).parents('.form-to-open');
                e.preventDefault();
                openFormError(form);
            }
        });
    }



    var newsletter = $('.subscribe-form');
    if(newsletter.length){
        newsletter.find('#email').attr('type', 'email').attr('placeholder', '').attr('required', true).after('<label for="email" style="opacity:1">Your email</label>');
        newsletter.append('<button type="submit" name="submit" class="btn-invert">Signup</button>');
        newsletter.find('.mailjet-subscribe').remove();
        newsletter.find('button').html(setBtn(newsletter.find('button')));
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

            // if(myScroll > 400 && tlHeaderDone){
            //     tlHeader.pause().reverse();
            //     tlHeaderDone = false;
            // }else{
            //     tlHeader.pause().play();
            //     tlHeaderDone = true;
            // }
        }

        if(postSidebar.length && mainContent.length && !isMobile.any){
            setSidebarScroll(myScroll);
        }

        if(mainMenu.length){
            setAnchorLink(myScroll);
        }
    });

    $(window).on('resize', function(){
        docHeight = $(document).height();
        windowHeight = $(window).height();
        windowWidth = window.outerWidth;

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

        if(windowWidthOnReady !== windowWidth){
            // Le resize se fait au moins sur la largeur, p-e sur la largeur et la hauteur
            if(team.length){
                if(team.hasClass('member-open')){
                    TweenMax.set($('.team.member-open > li.open .desc'), {clearProps:'all'});
                    TweenMax.set($('.team.member-open > li.open'), {className:'-=open', clearProps:'all'});
                    TweenMax.set($('.content-desc-responsive'), {clearProps:'all'});
                    TweenMax.set(team, {className:'-=member-open'});

                    liTeamOpen = $('.team.member-open > li.open');
                    descOpen = $('.desc', liTeamOpen);
                    heightDescOpen = descOpen.outerHeight();
                    TweenMax.set(liTeamOpen, {paddingBottom: heightDescOpen+'px', ease:Cubic.easeInOut});
                }
                teamPosition();
                updateBtnGlob();
            }
        }

        if(galleries.length){
            galleries.each(function(){
                setGallery($(this), $(window).width());
            });
        }
    });

});


$(window).on('load', function(){
    var main = $('#main');
    var contentHeader = $('#contentHeader');
    //var fadePage = $('#fadePage');
    var galleries = $('.gallery');
    var postSidebar = $('#postSidebar');
    var tweensHeader = [];
    var windowWidth = window.outerWidth;

    var line = $('.wrapper-video path');

    line.each(function(index) {
        tweensHeader[index] = new TweenMax.from(this, 0.1 , { opacity:0, x: 0});
    });

    tlHeader.play();
    tlHeaderDone = true;
    tweensHeader.forEach(function(element, index){
        tlHeader.add(element);
    });

    var tlBtween = tlHeader.tweenFromTo(0, tlHeader.duration(), {ease:Power4.easeOut});


    // TweenMax.staggerTo(line, 0.3, {ease:Expo.easeOut, autoAlpha: 0}, 0.03);

    function animTxt(splitText){
        splitText.split({type:'words'});
        TweenMax.staggerFrom(splitText.words, 0.3, {ease:Expo.easeInOut, opacity:0, y:100}, 0.03);
    }

    var video = $('#video');
    var source = video.find('source');

    if( video.length && windowWidth > 979 ){
        source.attr('src', source.data('src'));
        video[0].load();
        video[0].play();
    }

    if(contentHeader.length){
        if(contentHeader.find('h1').length){
            if($('body').hasClass('home')){
                TweenMax.fromTo(contentHeader.find('h1'), 0.3, {opacity: 0, y: 100}, {opacity: 1, y: 0, delay: 1});
            }else{
                TweenMax.fromTo(contentHeader.find('h1'), 0.3, {opacity: 0, y: 100}, {opacity: 1, y: 0});
            }
            
            // var splitText = new SplitText(contentHeader.find('h1'), {type:'words'});
            // contentHeader.find('h1').css('opacity', 1);
            // animTxt(splitText);
        }
        if(main.length){
            main.css('marginTop', Math.floor(contentHeader.outerHeight()));
        }
    }

    // if(fadePage.length){
    //     TweenMax.to(fadePage, 0.2, {opacity: 1});
    // }

    if(postSidebar.length){
        postSidebarTop = postSidebar.offset().top;
        postSidebarWidth = postSidebar.innerWidth();
    }

    if(galleries.length){
        galleries.each(function(){
            setGallery($(this), $(window).width());
        });
    }
});

