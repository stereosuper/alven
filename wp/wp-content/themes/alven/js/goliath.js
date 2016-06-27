$(function(){

    /**
     * Gère tous les comportements liés au chargement en ajax des pages
     * @returns {undefined}
     */
    function handleAjaxOpen() {
        var $links = $('a.ajax-load');
        var $ajaxContainer = $( "#ajaxContainer" );
        var $nonAjaxContainer = $( "#nonAjaxContainer" );

        /**
         * Ferme la portion de page ajax
         * @param {type} data
         * @param {type} href
         * @param {type} callback si on passe ici un pointeur de fonction, elle sera excutée
         * @returns {undefined}
         */
        function wipeAjaxContainer(data, href, callback) {
            $nonAjaxContainer
                .fadeIn('slow')
            ;

            $ajaxContainer
                .removeClass('open')
                .slideUp('slow', function() {
                    if (callback) {
                        callback(data, href);
                    }
                })
            ;
        }

        /**
         * Ouvre la portion de page ajax
         * @param {type} data
         * @param {type} href
         * @returns {undefined}
         */
        function openAjaxContainer(data, href) {
            $ajaxContainer
                .hide()
                .html(data)
                .slideDown('slow')
                .addClass('open')
            ;

            $nonAjaxContainer
                .fadeOut('slow')
            ;

            $('a.btn-close').on('click', function() {
                wipeAjaxContainer();
                $.address.value('');

                return false;
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
                $.scrollTo($ajaxContainer, 400, {
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
                $.scrollTo($ajaxContainer, 400);
                if ($ajaxContainer.hasClass('open')) {
                    wipeAjaxContainer();
                } else {
                    openAjaxContainer();
                }
                 */
            });
        }

        // Lorsqu'on recharge la page et qu'elle a un segment d'url ajax, on relance les scripts d'ouverture
        $.address.externalChange(function(event) {
            var href = event.value;

            if (href && href!='' && href != '/') {
                loadUrlAjax(href);
            } else {
                if ($ajaxContainer.hasClass('open')) {
                    wipeAjaxContainer();
                }
            }
        });

        // Gère le click sur les liens ajax
        $links.click(function() {
            var $link = $(this);
            var href = $link.attr('href');

            loadUrlAjax(href);

            return false;
        });
    }

    // Init

    handleAjaxOpen();

});