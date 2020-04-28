(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["forms"],{

/***/ "./wp-content/themes/alven/src/js/components/forms.js":
/*!************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/forms.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const contact = () => {
    const contact = document.getElementById('contact');

    if (!contact) return;

    contact.querySelectorAll('.open-form').forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                contact.querySelectorAll('.form-to-open').forEach(form => {
                    form.classList.remove('on');
                    form.parentNode.querySelector('.open-form').classList.remove('off');
                });
                btn.parentNode.querySelector('.form-to-open').classList.add('on');
                btn.classList.add('off');
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (contact);


/***/ })

}]);
//# sourceMappingURL=forms.js.map?28311692e3c879b65315896120b5284f