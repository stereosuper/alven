(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["slider"],{

/***/ "./wp-content/themes/alven/src/js/components/slider.js":
/*!*************************************************************!*\
  !*** ./wp-content/themes/alven/src/js/components/slider.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const slider = () => {
    const slider = document.getElementById('slider');
    const nav = document.getElementById('slider-nav');

    if (!slider || !nav) return;

    const slides = slider.querySelectorAll('.slide');
    const btns = nav.querySelectorAll('button');

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                slides.forEach(slide => {
                    slide.classList.remove('on');
                });
                slider.querySelector('[data-startup="' + btn.dataset.slide + '"').classList.add('on');

                btns.forEach(elt => {
                    elt.classList.remove('on');
                });
                btn.classList.add('on');
                btn.blur();
            },
            false
        );
    });
};

/* harmony default export */ __webpack_exports__["default"] = (slider);


/***/ })

}]);
//# sourceMappingURL=slider.js.map?bf6e07f1596c9325f9eb89ec5a61d5b0