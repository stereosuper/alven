(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["search"],{

/***/ "./wp-content/themes/alven/src/js/components/search.js":
/*!*************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/search.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const header = () => {
    const burger = document.getElementById('burger');
    const close = document.getElementById('close');
    const nav = document.getElementById('nav');

    if (!burger || !nav || !close) return;

    burger.addEventListener(
        'click',
        () => {
            nav.classList.add('on');
        },
        false
    );

    close.addEventListener(
        'click',
        () => {
            nav.classList.remove('on');
        },
        false
    );
};

/* harmony default export */ __webpack_exports__["default"] = (header);


/***/ })

}]);
//# sourceMappingURL=search.js.map?da7ec1fb25a9b15ff960ab637ac61d03