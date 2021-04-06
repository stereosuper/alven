(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["portfolio-search"],{

/***/ "./wp-content/themes/alven/src/js/components/portfolio-search.js":
/*!***********************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/portfolio-search.js ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");


const portfolio = () => {
    const portfolio = document.getElementById('portfolio');
    const search = document.getElementById('form-startup');

    if (!portfolio || !search) return;

    const input = search.querySelector('#search-startup');
    const links = portfolio.querySelectorAll('li');

    const filter = () => {
        Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(links, link => {
            link.dataset.name.includes(input.value) ? link.classList.remove('s-off') : link.classList.add('s-off');
        });
    };

    input.addEventListener('input', filter, false);
    search.addEventListener(
        'submit',
        e => {
            e.preventDefault();
            filter();
        },
        false
    );
};

/* harmony default export */ __webpack_exports__["default"] = (portfolio);


/***/ })

}]);
//# sourceMappingURL=portfolio-search.js.map?adc395894bdb8df9dac84b25fea0a65e