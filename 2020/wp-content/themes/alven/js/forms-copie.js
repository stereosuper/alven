(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["forms-copie"],{

/***/ "./wp-content/themes/alven/src/js/components/forms copie.js":
/*!******************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/forms copie.js ***!
  \******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @stereorepo/sac */ "./node_modules/@stereorepo/sac/src/index.js");


const forms = () => {
    const fields = document.querySelectorAll('.js-field');

    if (!fields.length) return;

    Object(_stereorepo_sac__WEBPACK_IMPORTED_MODULE_0__["forEach"])(fields, field => {
        if (field.querySelector('.form-elt').value) field.querySelector('.label').classList.add('off');

        field.addEventListener(
            'focusin',
            () => {
                field.querySelector('.label').classList.add('off');
            },
            false
        );

        field.addEventListener(
            'focusout',
            () => {
                if (!field.querySelector('.form-elt').value) field.querySelector('.label').classList.remove('off');
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (forms);


/***/ })

}]);
//# sourceMappingURL=forms-copie.js.map?878d2d90c6b584552da7cbba051ca346