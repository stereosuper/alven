(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["startup"],{

/***/ "./wp-content/themes/alven/src/js/components/startup.js":
/*!**************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/startup.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const startup = () => {
    const portfolio = document.getElementById('portfolio');

    if (!portfolio) return;

    const wrapper = document.getElementById('startup');
    const links = portfolio.querySelectorAll('.ajax-load');

    const openStartup = (html, href, name) => {
        wrapper.innerHTML = html;

        wrapper.querySelector('#close').addEventListener(
            'click',
            () => {
                wrapper.innerHTML = '';
                history.pushState(
                    {
                        id: 'portfolio'
                    },
                    '',
                    window.location.origin + window.location.pathname
                );
            },
            false
        );

        history.pushState({ id: name }, '', href);
    };

    const loadUrl = (href, name) => {
        fetch(alven_ajax.ajax_url + '?action=alven_portfolio_ajax&name=' + name, {
            method: 'POST'
        })
            .then(response => response.text())
            .then(html => openStartup(html, href, name))
            .catch(ex => console.error('Error', ex.message));
    };

    links.forEach(link => {
        link.addEventListener(
            'click',
            e => {
                e.preventDefault();
                loadUrl(link.href, link.dataset.name);
            },
            false
        );
    });

    if (window.location.pathname === '/portfolio/' && window.location.hash) {
        loadUrl(window.location.href, window.location.hash.replace('#', ''));
    }
};

/* harmony default export */ __webpack_exports__["default"] = (startup);


/***/ })

}]);
//# sourceMappingURL=startup.js.map?e35f13a571432a1e4b082112b0312094