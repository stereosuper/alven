(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["startup"],{

/***/ "./wp-content/themes/alven/src/js/components/startup.js":
/*!**************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/startup.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var whatwg_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! whatwg-fetch */ "./node_modules/whatwg-fetch/fetch.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap/ScrollToPlugin.js */ "./node_modules/gsap/ScrollToPlugin.js");
/* harmony import */ var _gallery__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./gallery */ "./wp-content/themes/alven/src/js/components/gallery.js");
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");
//fetch polyfill





gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].registerPlugin(gsap_ScrollToPlugin_js__WEBPACK_IMPORTED_MODULE_2__["ScrollToPlugin"]);




const startup = () => {
    const portfolio = document.getElementById('portfolio');

    if (!portfolio) return;

    const wrapper = document.getElementById('startup');
    const links = portfolio.querySelectorAll('.ajax-load');

    const closeStartup = () => {
        gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].to(wrapper, 0.5, {
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
        gsap__WEBPACK_IMPORTED_MODULE_1__["gsap"].to(window, { duration: 0.8, scrollTo: '#startup' });
        history.pushState({ id: name }, '', href);

        wrapper.querySelector('#close').addEventListener('click', closeStartup, false);

        Object(_gallery__WEBPACK_IMPORTED_MODULE_3__["default"])();
    };

    const loadStartup = (href, name) => {
        window
            .fetch(alven_ajax.ajax_url + '?action=alven_portfolio_ajax&name=' + name, {
                method: 'POST'
            })
            .then(response => response.text())
            .then(html => openStartup(html, href, name))
            .catch(ex => console.error('Error', ex.message));
    };

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_4__["forEach"])(links, link => {
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
//# sourceMappingURL=startup.js.map?0bb885f636b06c9825b8a7c6b0ea6cbc