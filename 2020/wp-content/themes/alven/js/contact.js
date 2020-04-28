(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["contact"],{

/***/ "./wp-content/themes/alven/src/js/components/contact.js":
/*!**************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/contact.js ***!
  \**************************************************************/
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
//# sourceMappingURL=contact.js.map?21e4c4b690ab77f39ef1b76c12d39ee9