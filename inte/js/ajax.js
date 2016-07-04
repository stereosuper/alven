$(function(){

    /**
     * Gère tous les comportements liés au chargement en ajax des pages
     * @returns {undefined}
     */
    function handleAjaxOpen() {
        var $ajaxContainer = $( '#ajaxContainer' );
        var $ajaxDisappear = $( '#ajaxDisappear' );

        /**
         * Ferme la portion de page ajax
         * @param {type} data
         * @param {type} href
         * @param {type} callback si on passe ici un pointeur de fonction, elle sera excutée
         * @returns {undefined}
         */
        function wipeAjaxContainer(data, href, callback) {
            $ajaxContainer.removeClass('open').slideUp(400, function() {
                if (callback) {
                    callback(data, href);
                }
            });

            if($ajaxDisappear.length){
                $ajaxDisappear.slideDown(300);
            }

            if($('#portfolioFilters').length){
                $('#portfolioFilters').removeClass('fixed single-on');
            }
        }

        /**
         * Ouvre la portion de page ajax
         * @param {type} data
         * @param {type} href
         * @returns {undefined}
         */
        function openAjaxContainer(data, href) {
            $ajaxContainer.hide().empty().append(data).slideDown(300).addClass('open');

            if($ajaxContainer.find('.btn-invert').length){
                $ajaxContainer.find('.btn-invert').each(function(i){
                    $ajaxContainer.find('.btn-invert').eq(i).html(setBtn($ajaxContainer.find('.btn-invert').eq(i)));
                });
            }

            if($ajaxContainer.find('.gallery').length){
                $ajaxContainer.find('.gallery').each(function(){
                    setGallery($(this));
                });
            }

            if($ajaxDisappear.length){
                $ajaxDisappear.slideUp(300);
            }

            if($('#portfolioFilters').length && $(window).height() > 700 && $(window).width() > 767){
                $('#portfolioFilters').addClass('fixed single-on');
            }

            $('#closePortfolio').on('click', function(e){
                e.preventDefault();
                wipeAjaxContainer();
                $.address.value('');
            });

            $.address.value(href.replace(/^.*\/\/[^\/]+/, ''));
        }

        /**
         * Charge en ajax l'url passée en paramètre
         *
         * @param {type} href
         * @returns {undefined}
         */
        function loadUrlAjax(href) {

            $.get( href, function( data ) {

                /*
                 * Première façon de faire : on séquence le scrollto et l'ouverture du bloc
                 */
                $.scrollTo($ajaxContainer, 300, {
                  onAfter: function() {
                    if ($ajaxContainer.hasClass('open')) {
                        wipeAjaxContainer(data, href, openAjaxContainer);
                    } else {
                        openAjaxContainer(data, href);
                    }
                  }
                });

                /*
                 * Seconde façon : on scroll et on ouvre le bloc dans le même temps
                 */
                /*$.scrollTo($ajaxContainer, 300);
                if ($ajaxContainer.hasClass('open')) {
                    wipeAjaxContainer(data, href, openAjaxContainer);
                } else {
                    openAjaxContainer(data, href);
                }*/
            });
        }

        // Lorsqu'on recharge la page et qu'elle a un segment d'url ajax, on relance les scripts d'ouverture
        $.address.externalChange(function(e) {
            var href = e.value;

            if (href && href!='' && href != '/') {
                loadUrlAjax(href);
            } else {
                if ($ajaxContainer.hasClass('open')) {
                    wipeAjaxContainer();
                }
            }
        });

        // Gère le click sur les liens ajax
        $('body').on('click', 'a.ajax-load', function(){
            var $link = $(this);
            var href = $link.attr('href');

            loadUrlAjax(href);

            return false;
        });
    }

    // Init

    handleAjaxOpen();

});
