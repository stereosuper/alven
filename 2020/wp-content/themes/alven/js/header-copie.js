(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["header-copie"],{

/***/ "./wp-content/themes/alven/src/js/components/header copie.js":
/*!*******************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/header copie.js ***!
  \*******************************************************************/
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
//# sourceMappingURL=header-copie.js.map?713a370e18e23d60f288e61031b3289d