(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["startup"],{

/***/ "./wp-content/themes/alven/src/js/components/startup.js":
/*!**************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/startup.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap/ScrollToPlugin.js */ "./node_modules/gsap/ScrollToPlugin.js");



gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].registerPlugin(gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_1__["ScrollToPlugin"]);

const startup = () => {
    const portfolio = document.getElementById('portfolio');

    if (!portfolio) return;

    const wrapper = document.getElementById('startup');
    const links = portfolio.querySelectorAll('.ajax-load');

    const closeStartup = () => {
        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(wrapper, 0.5, {
            height: 0,
            onComplete: () => {
                wrapper.innerHTML = '';
                wrapper.style.height = '';
            }
        });

        history.pushState(
            {
                id: 'portfolio'
            },
            '',
            window.location.origin + window.location.pathname
        );
    };

    const openStartup = (html, href, name) => {
        wrapper.innerHTML = html;
        gsap__WEBPACK_IMPORTED_MODULE_0__["gsap"].to(window, { duration: 0.8, scrollTo: '#startup' });
        history.pushState({ id: name }, '', href);

        wrapper.querySelector('#close').addEventListener('click', closeStartup, false);
    };

    const loadStartup = (href, name) => {
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
                loadStartup(link.href, link.dataset.name);
            },
            false
        );
    });

    if (window.location.pathname === '/portfolio/' && window.location.hash) {
        loadStartup(window.location.href, window.location.hash.replace('#', ''));
    }
};

/* harmony default export */ __webpack_exports__["default"] = (startup);


/***/ })

}]);
//# sourceMappingURL=startup.js.map?7d6cf0258824524f0dd1bc7172a1c1e7